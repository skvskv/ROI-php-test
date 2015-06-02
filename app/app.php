<?php

require_once "bootstrap.php";

// ----------------------------
/*    $parr = null;
    for ($i = 0; $i < 6; $i++) {
        for ($j = 0; $j < 6; $j++) {
            $parr[$i][$j] = '';
        }
    }
    $parr[3][2] = 'Z';
    $arr = SplFixedArray::fromArray($parr);

    var_dump($arr->count());
    var_dump($arr->current());
    var_dump($arr[3][2]);
*/



// ---------------------------
//$pt = new \lib\LandscapeContext\Landscape2DPoint(['XMin' => 0, 'XMax' => 1, 'YMin' => 2, 'YMax' => 3 ]);
//$pt->setPosition(['X'=>1, 'Y'=>2]);
//var_dump($pt);

//$pt = new \lib\LandscapeContext\Landscape2DPoint([0,1,2,3]);
//$pt->setPosition([1,2]);
//var_dump($pt);

//------------------------------
//$pt = new \lib\LandscapeContext\Landscape2DPoint(
//    new \lib\LandscapeContext\Landscape2DContext([0,1,2,3])
//);
//$pt->setPosition([1,2]);
    //$pt->setPosition([22,2]);
    //$pt->setPosition([-1,2]);
    //$pt->setPosition([1,200]);
    //$pt->setPosition([1,-2]);
    //$pt->setPosition([100,-2]);
//var_dump($pt);


//--------------------------------
//$arr = \lib\Enum\CardinalDirection::asArray();
//var_dump($arr);
//var_dump( array_slice($arr, 2) );


$cd = new \lib\Enum\CardinalDirection('W');
echo $cd."\n";
$cd->rotateRight();
echo $cd."\n";
$cd->rotateLeft();
echo $cd."\n";
