<?php

namespace lib\LandscapeContext;


//use lib\Enum\CardinalDirection;
use lib\RealmEntities\ILandscapePositionedObject;

class Landscape2DContext extends LandscapeContextBase
{
    const X = 0;
    const Y = 1;
    const XMin = 0;
    const XMax = 1;
    const YMin = 2;
    const YMax = 3;

    /**
     * row-col indexing
     * @var null | array
     */
    protected $field;

    /**
     * Simple rectangular boundary
     * @var array
     */
    protected $boundaries = [self::XMin => null, self::XMax => null, self::YMin => null, self::YMax => null ];

    protected function init()
    {

    }

    /**
     * @param $boundaries
     * @return bool
     */
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

    /**
     * @param array $boundaries
     */
    protected function assignBoundariesFrom($boundaries)
    {
        $this->boundaries = array_intersect_key($boundaries, $this->boundaries);
    }

    /**
     * @param $position
     * @return bool
     */
    function isValidCoordinates($position)
    {
        $result = false;
        if(is_array($position)){
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

        return $result;
    }

    /**
     * @param ILandscapePositionedObject $object
     * @return LandscapePointBase
     * @throws PositionOutOfBoundariesException
     * @throws \Exception
     */
    function getTargetPoint(ILandscapePositionedObject $object)
    {
        $startPoint = $object->getLandscapePoint();
        $movementDirection = $object->getDirection();
        $result = $startPoint;
        $newPoint = clone $startPoint;
        $newPosition = addArrayComponents($newPoint->getPosition(), $movementDirection->asVector());
        $newPoint->setPosition($newPosition);
        if(!isset($this->field[$newPosition[self::X]][$newPosition[self::Y]]))
        {
            $result = $newPoint;
        } else {
            if (!is_array($this->field[$newPosition[self::X]][$newPosition[self::Y]]))
            {
                $result = $newPoint;
            } else {
                switch ($object->getType())
                {
                    case ILandscapePositionedObject::AIRBORNE:
                        $result = $newPoint;
                        break;
                    case ILandscapePositionedObject::TERRESTRIAL:
                        foreach ($this->field[$newPosition[self::X]][$newPosition[self::Y]] as $k => $v)
                        {
                            if($v->getType()===ILandscapePositionedObject::TERRESTRIAL){ $result = $startPoint; }
                        }
                        break;
                    default:
                        throw new \Exception("Unknown LandBasedObject type");
                }
            }
        }

        return $result;
    }

    protected function doPutObject(ILandscapePositionedObject $object)
    {
        $position = $object->getLandscapePoint()->getPosition();
        $this->field[$position[self::X]][$position[self::Y]][] = $object;
    }

    protected function doRemoveObject(ILandscapePositionedObject $object)
    {
        $position = $object->getLandscapePoint()->getPosition();
        foreach ($this->field[$position[self::X]][$position[self::Y]] as $k => $v)
        {
            if ($v == $object) { unset( $this->field[$position[self::X]][$position[self::Y]][$k] ); }
        }
    }

}