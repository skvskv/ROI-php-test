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


//------------------------------------------
$cd = new \lib\Enum\CardinalDirection('W');
//$cd = new \lib\Enum\CardinalDirection('N');
//$cd = new \lib\Enum\CardinalDirection('E');
//$cd = new \lib\Enum\CardinalDirection('S');
echo $cd."\n";
$cd->rotateRight();
echo $cd."\n";
$cd->rotateLeft();
echo $cd."\n";
var_dump($cd->asVector());


//------------------------------------------
$lc = new \lib\LandscapeContext\Landscape2DContext([0,5,0,5]);
$pt = new \lib\LandscapeContext\Landscape2DPoint($lc);
$pt->setPosition([1,3]);
//$npt = $lc->getTargetPoint($pt, $cd);
//var_dump($npt);
$rvr = new \lib\RealmEntities\Rover(
    new \lib\Enum\CardinalDirection('W'),
    new \lib\LandscapeContext\Landscape2DPoint($lc, [1,3])
);

var_dump($rvr);
$rvr->moveAhead();
var_dump($rvr);
$rvr->moveAhead();
var_dump($rvr);
$rvr2 = new \lib\RealmEntities\Rover(
    new \lib\Enum\CardinalDirection('S'),
    new \lib\LandscapeContext\Landscape2DPoint($lc, [0,4])
);
$rvr2->moveAhead();
var_dump($rvr2);