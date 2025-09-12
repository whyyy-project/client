<?php

namespace App\Services;

use CodeIgniter\HTTP\URI;
use GuzzleHttp\Client;

class SsoClientService
{
    protected Client $http;
    protected string $baseUrl;
    protected string $clientId;
    protected string $clientSecret;
    protected string $redirectUri;

    public function __construct()
    {
        $this->http = new Client([
            'timeout' => 10,
            'http_errors' => false,
        ]);

        $this->baseUrl      = rtrim(env('SSO_BASE_URL', ''), '/');
        $this->clientId     = (string) env('SSO_CLIENT_ID', '');
        $this->clientSecret = (string) env('SSO_CLIENT_SECRET', '');
        $this->redirectUri  = (string) env('SSO_REDIRECT_URI', '');
    }

    public function buildAuthorizeUrl(array $params = []): string
    {
        $query = array_merge([
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
            'response_type' => 'code',
            'state' => bin2hex(random_bytes(16)),
        ], $params);

        $uri = new URI($this->baseUrl . '/auth');
        $uri->setQuery(http_build_query($query));
        return (string) $uri;
    }

    public function exchangeCode(string $code): array
    {
        $resp = $this->http->post($this->baseUrl . '/api/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'redirect_uri' => $this->redirectUri,
                'code' => $code,
            ],
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        $data = json_decode((string) $resp->getBody(), true) ?: [];
        if ($resp->getStatusCode() >= 400) {
            $msg = $data['message'] ?? ($data['error'] ?? 'HTTP ' . $resp->getStatusCode());
            throw new \RuntimeException('Token exchange failed: ' . $msg);
        }
        return $data;
    }

    public function me(string $accessToken): array
    {
        $resp = $this->http->get($this->baseUrl . '/api/me', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ],
        ]);
        $data = json_decode((string) $resp->getBody(), true) ?: [];
        if ($resp->getStatusCode() >= 400) {
            $msg = $data['message'] ?? ($data['error'] ?? 'HTTP ' . $resp->getStatusCode());
            throw new \RuntimeException('Fetch /me failed: ' . $msg);
        }
        return $data;
    }
}
