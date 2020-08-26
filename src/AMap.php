<?php

namespace Zimutech;

use GuzzleHttp\Client;

class AMap
{
    private $key;
    private $client;

    public function __construct(string $key)
    {
        $this->key = $key;
        $this->client = new Client();
    }

    public function getAdCodeFromIp(string $ip) : string
    {
        $output = $this->client
            ->get('https://restapi.amap.com/v3/ip?parameters', [
                'query' => [
                    'key' => $this->key,
                    'ip' => $ip
                ]
            ])
            ->getBody()
            ->getContents();

        $output = json_decode($output, true);
        $adcode = $output['adcode'];

        if(!is_array($adcode)) {
            return $adcode;
        } else {
            return '0';
        }
    }
}