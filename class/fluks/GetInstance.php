<?php
/**
 * Created by PhpStorm.
 * User: Ouerghi Mahdi
 * Date: 26/02/2019
 * Time: 15:46
 */

namespace Question\fluks;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GetInstance
{

    CONST URL = 'https://www.fluksaqua.com';
    /**
     * @var Client
     */
    private $client;

    public  function __construct()
    {
        $this->client = new Client(['base_uri' => GetInstance::URL]);
    }

    /**
     * @param $text
     * @return \Psr\Http\Message\StreamInterface
     * @throws GuzzleException
     */
    public  function getInstance($text){
        // setup the Guzzle Client object
        // Create a client with a base URI
        // Send a request to baseUrl + uri (fr/forum/{text})
        $response = $this->client->request('GET', "fr/forum/{$text}");
        // get the body of the response
            return $body = $response->getBody();
    }
}