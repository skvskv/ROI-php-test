<?php

namespace lib\RealmEntities;


interface ILandscapePositionedObject
{
    const TERRESTRIAL = 100;
    const AIRBORNE = 101;

    /**
     * @return \lib\LandscapeContext\LandscapePointBase
     */
    function getLandscapePoint();

    /**
     * @return \lib\Enum\CardinalDirection
     */
    function getDirection();

    /**
     * @return int
     */
    function getType();
}