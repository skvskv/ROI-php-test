<?php

namespace lib\LandscapeContext;


class Landscape2DPoint extends LandscapePoint
{
    const X = 0;
    const Y = 1;
    const XMin = 0;
    const XMax = 1;
    const YMin = 2;
    const YMax = 3;
    protected $position = [self::X => null, self::Y => null];
    protected $boundaries = [self::XMin => null, self::XMax => null, self::YMin => null, self::YMax => null ];
    function isValidBoundaries($boundaries)
    {
        $result = false;
        if(is_array($boundaries)){
            if(array_has_keys(array_keys($this->boundaries), $boundaries)){
                if(
                    ($this->boundaries[self::XMin]<=$this->boundaries[self::XMax]) and ($this->boundaries[self::YMin]<=$this->boundaries[self::YMax])
                )
                {
                    $result = true;
                }
            }
        }

        return $result;
    }

    function isValidCoordinates($position)
    {
        $result = false;
        if(is_array($position)){
            if(array_has_keys(array_keys($this->position), $position)){
                if(
                        !is_null($position[self::X]) and !is_null($position[self::Y])
                            and
                        ($this->boundaries[self::XMin]<=$position[self::X]) and ($position[self::X]<=$this->boundaries[self::XMax])
                            and
                        ($this->boundaries[self::YMin]<=$position[self::Y]) and ($position[self::Y]<=$this->boundaries[self::YMax])
                    )
                    {
                        $result = true;
                    }
            }
        }

        return $result;
    }

}