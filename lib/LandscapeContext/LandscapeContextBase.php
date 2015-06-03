<?php

namespace lib\LandscapeContext;


// TODO: Should be represented by two interfaces?

use lib\RealmEntities\ILandscapePositionedObject;

abstract class LandscapeContextBase {

    protected $boundaries;

    abstract protected function assignBoundariesFrom($boundaries);
    abstract function isValidBoundaries($boundaries);
    abstract function isValidCoordinates($position);
    abstract function getTargetPoint(ILandscapePositionedObject $object);
    abstract protected function doPutObject(ILandscapePositionedObject $object);
    abstract protected function doRemoveObject(ILandscapePositionedObject $object);
    abstract protected function init();

    /**
     * Boundaries - Xmin, Xmax, Ymin, Ymax, ...
     * @param array $boundaries
     * @throws PositionBadBoundariesException
     */
    function __construct($boundaries)
    {
        if ($this->isValidBoundaries($boundaries)){
            $this->assignBoundariesFrom($boundaries);
            $this->init();
        } else {
            throw new PositionBadBoundariesException();
        }
    }

    function isPointLiesHere(LandscapePointBase $point)
    {
        $result = ( $point->getLandscapeContext() === $this);
        return $result;
    }

    function putObject(ILandscapePositionedObject $object)
    {
        if($this->isPointLiesHere($object->getLandscapePoint()))
        {
            $this->doPutObject($object);
        } else {
            throw new LandscapePointFromAnotherLandscapeContextException();
        }
    }

    function removeObject(ILandscapePositionedObject $object)
    {
        if($this->isPointLiesHere($object->getLandscapePoint()))
        {
            $this->doRemoveObject($object);
        } else {
            throw new LandscapePointFromAnotherLandscapeContextException();
        }
    }

}