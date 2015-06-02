<?php

namespace lib\LandscapeContext;


abstract class LandscapePointBase
{
    const BAD_ARGUMENT_FOR_CONSTRUCTOR = "() : argument should be an instance of ";
    protected $position;

    /**
     * @var LandscapeContextBase
     */
    protected $landscapeContext;

    abstract protected function assignPositionFrom($position);

    /**
     * Boundaries - Xmin, Xmax, Ymin, Ymax, ...
     * @param array $landscapeContext
     * @throws PositionBadBoundariesException
     */
    function __construct(LandscapeContextBase $landscapeContext)
    {
        $this->landscapeContext = $landscapeContext;
    }

    /**
     * @param $position
     * @throws PositionOutOfBoundariesException
     */
    function setPosition($position)
    {
        if($this->landscapeContext->isValidCoordinates($position))
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