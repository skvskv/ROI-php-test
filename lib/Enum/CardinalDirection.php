<?php

namespace lib\Enum;


class CardinalDirection extends Enum
{
    const N = 0;
    const E = 1;
    const S = 2;
    const W = 3;

    function rotateRight(){
        $this->shiftNext(true);
    }

    function rotateLeft(){
        $this->shiftPrev(true);
    }
}