<?php
/**
 * Created by PhpStorm.
 * User: Mobelite
 * Date: 26/02/2019
 * Time: 16:17
 */

namespace Question\fluks;


use DOMDocument;
use DOMXPath;

class FetchDom
{
    CONST PATTERN_CLASS_CSS = 'text-18 font-weight-bold text-secondary title text-truncate';
    /**
     * @var GetInstance
     */
    private $instance;
    /**
     * @var string
     */
    private $text;

    /**
     * FetchDom constructor.
     * @param GetInstance $instance
     * @param string $text
     */
    public function __construct(GetInstance $instance, string $text)
   {

       $this->instance = $instance;
       $this->text = $text;
   }

    /**
     * @return \DOMNodeList
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTitles()
   {
       //get the body of the request
       $content = $this->instance->getInstance($this->text);
       //Creates a new DOMXPath object
       $html = new DOMDocument();
       //load the html from body of request
       @$html->loadHTML($content);
       //instance xpath
       $xpath = new DOMXPath($html);
       //xpath's query function returns a dom node
       //search in the dom recover according to the class key
       return $domTitle = $xpath->query("//div[@class='".FetchDom::PATTERN_CLASS_CSS."']");
   }
}