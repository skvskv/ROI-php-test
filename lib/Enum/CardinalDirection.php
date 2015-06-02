<?php

namespace lib\Enum;


class CardinalDirection extends Enum
{
    const E = 0;
    const N = 90;
    const W = 180;
    const S = 270;
//
//    const E = 0;
//    const N = 1;
//    const W = 2;
//    const S = 3;


    function rotateRight(){
        $this->shiftPrev(true);
    }

    function rotateLeft(){
        $this->shiftNext(true);
    }

    function asVector()
    {
        $result = [ constant("lib\LandscapeContext\Landscape2DPoint::X") => round( cos( 2*M_PI*$this->getAssociatedValue()/360 ), 6),
                    constant("lib\LandscapeContext\Landscape2DPoint::Y") => round( sin( 2*M_PI*$this->getAssociatedValue()/360 ), 6)
        ];
        return $result;
    }
}