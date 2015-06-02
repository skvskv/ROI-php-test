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
     * @param LandscapeContextBase $landscapeContext
     */
    function __construct(LandscapeContextBase $landscapeContext, $position=null)
    {
        $this->landscapeContext = $landscapeContext;
        $this->assignPositionFrom($position);
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

    /**
     * @return LandscapeContextBase
     */
    function getLandscapeContext()
    {
        $result = $this->landscapeContext;
        return $result;
    }
}