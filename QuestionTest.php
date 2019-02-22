<?php
require('Question.php');

use PHPUnit_Framework_TestCase;

class QuestionTest extends PHPUnit_Framework_TestCase
{
  public function testCountEmptyString()
  {
    $obj = new Question;

    $res = $obj->count('');
    $ref = -1;
    $this->assertEquals($res, $ref);

    $actual = $obj->count(' ');
    $expected = -1;
      $this->assertEquals($expected, $actual);
  }
}
