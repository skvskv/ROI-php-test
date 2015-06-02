<?php

namespace lib\LandscapeContext;


class Landscape2DPoint extends LandscapePointBase
{
    const X = 0;
    const Y = 1;
    const XMin = 0;
    const XMax = 1;
    const YMin = 2;
    const YMax = 3;

    /**
     * Position itself
     * @var array
     */
    protected $position = [self::X => null, self::Y => null];

    /**
     * @param array $position
     */
    protected function assignPositionFrom($position)
    {
        if (is_null($position)) { return ; }
        if(is_array($position))
        {
            $this->position = array_intersect_key($position, $this->position);
        }
        else{
            throw new \InvalidArgumentException();
        }
    }
}