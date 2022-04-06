<?php

namespace Authenticator\Tests\Controllers;

use Tests\TestCase;

class AuthenticatorControllerTest extends TestCase {

    public function testOauthToken()
    {

        $response = $this->withHeaders([
            'Content-Type' => 'application/json'
        ])->json('POST', '/oauth/token', [
                "grant_type" => "client_credentials",
                "client_id" => env('CLIENT_ID'),
                "client_secret" => env('CLIENT_SECRET')
            ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
                'token_type', 'expires_in', 'access_token'
        ]);

    }

    public function testAuthorization() {
        $response = $this->get('/api/portal/produtos/consultar-produtos-protheus?cpf=31601751893');
        $response->assertExactJson(['error' => 1, 'mensagem' => 'Acesso Negado!']);
    }

    public function testAuthorizationNoScopeEdebeOn() {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json'
        ])->json('POST', '/oauth/token', [
            "grant_type" => "client_credentials",
            "client_id" => env('CLIENT_ID'),
            "client_secret" => env('CLIENT_SECRET')
        ]);
        $token = $response->decodeResponseJson();
        $response = $this->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $token['access_token']
            ])->json('GET', '/api/edebe-on/get-url');

        $response->assertStatus(403);
        $response->assertJsonFragment(['message' => 'Invalid scope(s) provided.']);
    }

}
