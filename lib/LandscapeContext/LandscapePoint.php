<?php

namespace lib\LandscapeContext;


abstract class LandscapePoint {

    protected $position;
    protected $boundaries;

    /**
     * Boundaries - Xmin, Xmax, Ymin, Ymax, ...
     * @param array $boundaries
     * @throws PositionBadBoundariesException
     */
    function __construct($boundaries)
    {
        if ($this->isValidBoundaries($boundaries)){
            $this->assignBoundariesFrom($boundaries);
        } else {
            throw new PositionBadBoundariesException();
        }
    }

    abstract function isValidBoundaries($boundaries);
    abstract function isValidCoordinates($position);

    /**
     * @param array $boundaries
     */
    private function assignBoundariesFrom($boundaries)
    {
        $this->boundaries = array_intersect_key($boundaries, $this->boundaries);
    }

    private function assignPositionFrom($position)
    {
        $this->position = array_intersect_key($position, $this->position);
    }

    /**
     * @param $position
     * @throws PositionOutOfBoundariesException
     */
    function setPosition($position)
    {
        if($this->isValidCoordinates($position))
        {
            $this->assignPositionFrom($position);
        } else {
            throw new PositionOutOfBoundariesException();
        }
    }

    /**
     * @return mixed
     */
    function getPosition()
    {
        return $this->position;
    }
}