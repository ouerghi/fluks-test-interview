<?php
use Question\fluks\Question;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase
{

  public function testCountEmptyString()
  {
      /** @var Question $obj */
      $obj = new Question;

    $res = $obj->count('');
    $ref = -1;
    $this->assertEquals($res, $ref);

    $actual = $obj->count(' ');
    $expected = -1;
      $this->assertEquals($expected, $actual);
  }
    public function testCountPompeString()
    {
        /** @var Question $obj */
        $obj = new Question;

        $res = $obj->count('pompe');
        $ref = 300;
        $this->assertEquals($res, $ref);

        $actual = $obj->count('  pompe ');
        $expected = 300;
        $this->assertEquals($expected, $actual);
    }

    /**
     *
     */
    public function testList()
    {
        $file = file_get_contents("source.html");
        $this->assertNotFalse(strpos($file, 'Cherche pompe pour prélèvement d\'eau dans piézomètre'));
        $this->assertFalse(strpos($file, 'hdfsjhg'));
        //preg_match('title text-truncate/', $file, $matches);
        //preg_match('/^title text-truncate/im', $file, $matches);
        preg_match('/([0-9]+) Questions sur ([0-9]+)/', $file,$matches);

        $this->assertEquals(300,$matches[2]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testClientRequest()
    {
        // Create a mock and queue two responses.
        $file = file_get_contents("source.html");
        $mock = new MockHandler([
            new Response(200, [] , $file)
        ]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $questions = new Question();
        $request = $client->request('GET', 'https://www.fluksaqua.com/fr/forum/pompe/');
        $result = $questions->list('pompe');
        $this->assertEquals(30, $result[0]);
    }

}
