<?php

namespace App\Controllers;

use App\Services\SsoClientService;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected SsoClientService $sso;

    public function __construct()
    {
        $this->sso = new SsoClientService();
    }

    public function login(): string
    {
        // Render page with a button that goes to SSO authorize URL
        $authorizeUrl = $this->sso->buildAuthorizeUrl();
        return view('auth/login', ['authorizeUrl' => $authorizeUrl]);
    }

    public function callback(): RedirectResponse
    {
        $code = (string) $this->request->getGet('code');
        $state = (string) $this->request->getGet('state');
        if (!$code) {
            return redirect()->to('/')->with('error', 'Kode otorisasi tidak ditemukan.');
        }

        try {
            $token = $this->sso->exchangeCode($code);
            $accessToken = $token['access_token'] ?? null;

            if (!$accessToken) {
                throw new \RuntimeException('Access token kosong');
            }
            $profile = $this->sso->me($accessToken);
        } catch (\Throwable $e) {
            return redirect()->to('/')->with('error', 'Login SSO gagal: ' . $e->getMessage());
        }
        // Simpan ke session sederhana
        session()->set([
            'isLoggedIn'   => true,
            'access_token' => $accessToken,
            'user'         => $profile,
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Anda telah logout.');
    }
}
