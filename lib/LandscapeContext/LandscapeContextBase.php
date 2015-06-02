<?php

namespace lib\LandscapeContext;


abstract class LandscapeContextBase {

    /**
     * row-col indexing
     * @var null | array
     */
    protected $boundaries;

    abstract protected function assignBoundariesFrom($boundaries);
    abstract function isValidBoundaries($boundaries);
    abstract function isValidCoordinates($position);

    /**
     * Boundaries - Xmin, Xmax, Ymin, Ymax, ...
     * @param array $boundaries
     * @throws PositionBadBoundariesException
     */
    public function __construct($boundaries)
    {
        if ($this->isValidBoundaries($boundaries)){
            $this->assignBoundariesFrom($boundaries);
        } else {
            throw new PositionBadBoundariesException();
        }
    }
}