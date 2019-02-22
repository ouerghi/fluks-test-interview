<?php
require('Question.php');

if (count($argv)!= 3) {
	echo "CLI to request FluksAqua forum search page \n";
	echo "usage: ".$argv[0]." <count|list> <text>\n";
	exit();
}

$obj = new Question();

switch ($argv[1]) {
	case 'count':
	echo "count for '{$argv[2]}' = ".$obj->count($argv[2])."\n";
	break;
	
	case 'list':
	echo "A implementer : lister les N premiers titres de question\n";
	break;
	
	default:
	echo "usage ".$argv[0]." <count|list> \n";
	break;
}

#