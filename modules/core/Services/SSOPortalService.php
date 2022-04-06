<?php

namespace Core\Services;

use Core\Models\DbFramework\Dbo\User;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class SSOPortalService extends BaseService
{
    function getAccessTokenFromSSO($username, $password)
    {
        $client = new Client();
        $res = $client->request('POST', env('URL_PORTAL_EDEBE') . 'sso/connect/token', [
            RequestOptions::FORM_PARAMS => [
                'username' => $username,
                'password' => $password,
                'grant_type' => 'custom',
                'scope' => 'openid email profile read write offline_access'
            ],
            'headers' =>
                ['Authorization' => "Basic " . env('UNIQUE_KEY_EDEBEAPI'),
                 'Accept' => 'application/json',
                 'Content-Type' => 'application/x-www-form-urlencoded'],
        ]);
        return json_decode($res->getBody()->getContents());
    }

    function getProfileFromTokenSSO($token)
    {
        $client = new Client();
        $res = $client->request('GET', env('URL_PORTAL_EDEBE') . 'api/perfil', [
            RequestOptions::QUERY => [
                'authToken' => $token,
                'appId' => 'storeFront'
            ]
        ]);
        return json_decode($res->getBody()->getContents());
    }

    function getEntitlementsWeb($token)
    {
        $client = new Client();
        $res = $client->request('POST', env('URL_PORTAL_EDEBE') . 'api/entitlementsWeb2', [
            RequestOptions::QUERY => [
                'token' => $token,
                'appId' => 'storeFront'
            ]
        ]);
        $xml = simplexml_load_string($res->getBody()->getContents());
        return json_decode(json_encode($xml));
    }

    public function decodeTokenSSOPortal($token) {
        $parser = new Parser();
        $token = $parser->parse((string) $token);
        $idUserPortal = $token->getClaim('sub');
        return User::find($idUserPortal);
    }
}
