<?php

namespace App\Controller;

use GuzzleHttp\Client;
use function GuzzleHttp\Promise\all;
use Question\fluks\FetchDom;
use Question\fluks\GetInstance;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FluksController extends AbstractController
{
    /**
     * @Route("/fluks", name="fluks", options={"expose"=true})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function index(Request $request)
    {
        //get body content of request
        $body = $request->getContent();
        /** @var string $body */
        $data = json_decode($body, true);
        if (!$data && empty($data)){
            throw new \Exception('parameter in request not found');
        }
        $text = $data['text'];
        //get client guzzle
        $instance = new GetInstance();
        // initiate the class for browsing the dom url
        $dom = new FetchDom($instance, $text);

        // get the result of query
        $domContentTitle = $dom->getTitles();
        //get the titles and insert them in the result array
        $i=0;
        foreach ($domContentTitle as $k => $title) {
            $title = trim($title->nodeValue);
            $result[$i++] = $title;
        }
        $result = ['count' => $i, 'data' => $result];
        /** @var array $result */

          $response = $this->json($result);

        //$response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
