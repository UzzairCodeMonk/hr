<?php

namespace Datakraf\Traits;

use GuzzleHttp\Client;
use SimpleXMLElement as XML;

trait ApiRequestable
{


    public $baseUrl = 'http://127.0.0.1:3333/';
    public $version = 'api/v1/';

    public function createClientInstance()
    {
        return new Client();
    }

    public function makeRequest($requestType, $endpoint)
    {
        $client = $this->createClientInstance();

        $request = $client->request($requestType, $this->baseUrl . $this->version . $endpoint);

        return $request->getBody();

    }
}