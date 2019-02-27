<?php
require 'vendor/autoload.php';
//require('Questionss.php');

if (count($argv)!= 3) {
    echo "CLI to request FluksAqua forum search page \n";
    echo "usage: ".$argv[0]." <count|list> <text>\n";
    exit();
}


/** @var \Question\fluks\Question $obj */
$obj = new \Question\fluks\Question();

/** @var array $result */
$result = $obj->list($argv[2]);

switch ($argv[1]) {
    case 'count':
        try {
            /** @var string $argv */
            echo "count for '{$argv[2]}' = " . $obj->count($argv[2]) . "\n";
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $e->getMessage();
        }
        break;

    case 'list':
        try {
            echo "title for '{$argv[2]}'  (" . $result[0] . '/' . $obj->count($argv[2]) . ") :\n";
            foreach ($result[1] as $res){
                echo '- '.trim($res)."\r\n";
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $e->getMessage();
        }

        break;

    default:
        echo "usage ".$argv[0]." <count|list> \n";
        break;
}

#