<?php

namespace Question\fluks;

class Question
{

    /**
     * @var GetInstance
     */
    private $instance;

    public function __construct()
    {
        $this->instance = new GetInstance();
    }

    /**
     * @param $text
     * @return int
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    function count( $text ) {

        $text = trim($text);
        if ($text == '')
            return -1;

        //get the instance of client http
        $content = $this->instance->getInstance($text);


        // search the pattern
         preg_match('/([0-9]+) Questions sur ([0-9]+)/', $content,$matches);

        // test the result

        // compute the result
        $total = isset($matches[2]) ? $matches[2] : 0;
        return $total;
    }

    /**
     * @param $text
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list($text)
    {
        // initiate the class for browsing the dom url
        $dom = new FetchDom($this->instance, $text);

        // get the result of query
        $domContentTitle = $dom->getTitles();

        $i = 0;
        //get the titles and insert them in the result array
        foreach ($domContentTitle as $title) {
            $result[$i++] = $title->nodeValue;
        }
        /** @var array $result */
        return [$i,$result];
    }


}