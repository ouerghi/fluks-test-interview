<?php
require_once 'vendor/autoload.php';
use Guzzle\Http\Client;

class Question                      
{
	/**
	 * @param string $pattern the pattern to search for in the forum page
	 *
	 * @return count of question or -1 on error
	 */
	function count( $text ) {
		// return variable default value
		$result = 0;

        $text = trim($text);
        if ($text == '') 
            return -1;

// setup the Guzzle CLient object
	
                
$client = new Client();
$request = $client->get("https://www.fluksaqua.com/fr/forum/{$text}");
 

		 //send the request
		$response = $request->send();

		// get the body of the response
		$content = \GuzzleHttp\json_encode($response->getBody());
                
               // var_dump($content);exit; 

		// search the pattern
		$res = preg_match('/([0-9]+) Questions sur ([0-9]+)/', $content,$matches);

		// test the result

		// compute the result
		$total = isset($matches[2]) ? $matches[2] : 0;
		return $total;
	}
        
       
}
