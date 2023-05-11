<?php

namespace App\Service\TheOneApi;

use GuzzleHttp\Client;

class TheOneApiCaller
{
    public function callApi($url) {
        $client = new Client();
        $res = $client->get(TheOneApiConsts::BASE_URL . $url, [
            'headers' => [
                'Authorization' => "Bearer " . TheOneApiConsts::API_KEY
                ]
        ]);
        if($res->getStatusCode() >= 400 ) {
            throw new \Exception("STATUS CODE: " . $res->getStatusCode());
        }
        $response = json_decode($res->getBody()->getContents());
        return $response;
    }
}
