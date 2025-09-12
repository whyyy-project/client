<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GirioneSSOController extends Controller
{
    public function redirect(Request $request)
    {
        $base = rtrim(config('services.girione.base_url'), '/');
        $authorize = $base . '/auth';
        $clientId = config('services.girione.client_id');
        $redirectUri = config('services.girione.redirect');
        $state = Str::random(16);
        $nonce = Str::random(16);

        // store state/nonce in session for validation
        session([
            'girione_state' => $state,
            'girione_nonce' => $nonce,
        ]);

        // also store as httpOnly cookies (fallback if session cookie tidak terbaca)
        $stateCookie = cookie(
            name: 'girione_state',
            value: $state,
            minutes: 10,
            path: null,
            domain: null,
            secure: false,
            httpOnly: true,
            raw: false,
            sameSite: 'lax'
        );
        $nonceCookie = cookie(
            name: 'girione_nonce',
            value: $nonce,
            minutes: 10,
            path: null,
            domain: null,
            secure: false,
            httpOnly: true,
            raw: false,
            sameSite: 'lax'
        );

        $query = http_build_query([
            'response_type' => 'code',
            'client_id' => $clientId,
            'redirect_uri' => $redirectUri,
            'state' => $state,
            'nonce' => $nonce,
        ]);

        return redirect()->away($authorize . '?' . $query)
            ->withCookie($stateCookie)
            ->withCookie($nonceCookie);
    }

    public function callback(Request $request)
    {
        $code = $request->query('code');
        $state = $request->query('state');
        $sessionState = session('girione_state');
        $cookieState = $request->cookie('girione_state');
        $stateMismatch = false;

        // Untuk debugging: jangan hentikan alur hanya karena state mismatch,
        // tetap lanjutkan agar kita bisa melihat data dari Girione.
        if (!$code) {
            abort(400, 'Invalid request: code is missing');
        }
        if (!$state || ($state !== $sessionState && $state !== $cookieState)) {
            $stateMismatch = true;
            Log::warning('Girione SSO state mismatch', [
                'query_state' => $state,
                'session_state' => $sessionState,
                'cookie_state' => $cookieState,
            ]);
        }

        $base = rtrim(config('services.girione.base_url'), '/');
        $tokenUrl = $base . '/api/token';
        $clientId = config('services.girione.client_id');
        $clientSecret = config('services.girione.client_secret');
        $redirectUri = config('services.girione.redirect');

        // Exchange code -> tokens
        $resp = Http::asForm()->acceptJson()->post($tokenUrl, [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri' => $redirectUri,
        ]);

        if (!$resp->ok()) {
            Log::warning('Girione token exchange failed', ['status' => $resp->status(), 'body' => $resp->body()]);
            return response()->json([
                'error' => 'token_exchange_failed',
                'status' => $resp->status(),
                'body' => $resp->json() ?? $resp->body(),
                'query' => $request->query(),
                'state_mismatch' => $stateMismatch,
                'session_state' => $sessionState,
                'cookie_state' => $cookieState,
            ], 401);
        }

        $data = $resp->json();
        $accessToken = $data['access_token'] ?? null;
        if (!$accessToken) {
            return response()->json([
                'error' => 'access_token_missing',
                'token_response' => $data,
                'query' => $request->query(),
                'state_mismatch' => $stateMismatch,
                'session_state' => $sessionState,
                'cookie_state' => $cookieState,
            ], 401);
        }

        // Fetch user profile from SSO
        $meUrl = $base . '/api/me';
        $meResp = Http::withToken($accessToken)->acceptJson()->get($meUrl);
        if (!$meResp->ok()) {
            return response()->json([
                'error' => 'failed_fetch_me',
                'status' => $meResp->status(),
                'body' => $meResp->json() ?? $meResp->body(),
                'token_response' => $data,
                'query' => $request->query(),
                'state_mismatch' => $stateMismatch,
                'session_state' => $sessionState,
                'cookie_state' => $cookieState,
            ], 401);
        }
        $me = $meResp->json();
        
        // Untuk permintaan Anda: tampilkan data yang dikirim Girione
        // (payload /me dan token) agar bisa diverifikasi di client.
        return response()->json([
            'query' => $request->query(),
            'state_mismatch' => $stateMismatch,
            'session_state' => $sessionState,
            'cookie_state' => $cookieState,
            'token' => $data,
            'me' => $me,
        ]);
    }
}
