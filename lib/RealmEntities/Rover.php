<?php

namespace lib\RealmEntities;


use lib\Enum\CardinalDirection;

abstract class Rover
{
    /**
     * @var CardinalDirection
     */
    private $direction;

    function __construct(CardinalDirection $direction)
    {
        $this->setDirection($direction);
    }

    function setDirection(CardinalDirection $direction)
    {
        $this->direction = $direction;
    }

    function rotateRight()
    {
        $this->direction->rotateRight();
    }

    function rotateLeft()
    {
        $this->rotateLeft();
    }

    function rotate($directionLiteral)
    {
        $directionLiteral = mb_strtoupper($directionLiteral);
        switch($directionLiteral)
        {
            case 'R':
                $this->rotateRight();
                break;
            case 'L':
                $this->rotateLeft();
                break;
            default:
                throw new RoverBadTurnDirectionException();
        }
    }

    abstract function moveAhead();

}