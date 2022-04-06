<?php

namespace Core\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;

class SSOService extends BaseService
{
    function getAccessToken()
    {
        try {
            $client = new Client();
            $res = $client->request('POST', env('APP_URL') . 'oauth/token', [
                RequestOptions::JSON => [
                    'client_id' => env('CLIENT_ID'),
                    'client_secret' => env('CLIENT_SECRET'),
                    'grant_type' => 'client_credentials'
                ],
                'headers' => ['Accept' => 'application/json'],
            ]);

            return json_decode($res->getBody()->getContents());
        }catch (\Exception $exc){
            dd($exc->getMessage());
            throw $exc;
        }
    }
}
