<?php

namespace lib\RealmEntities;


use lib\Enum\CardinalDirection;
use lib\LandscapeContext\LandscapePointBase;
use lib\LandscapeContext\PositionOutOfBoundariesException;

//abstract class Rover implements ILandscapePositionedObject
class Rover implements ILandscapePositionedObject
{
    /**
     * @var CardinalDirection
     */
    private $direction;

    /**
     * @var LandscapePointBase
     */
    private $landscapePoint;

    function __construct(CardinalDirection $direction, LandscapePointBase $landscapePoint)
    {
        $this->setDirection($direction);
        $this->setLandscapePoint($landscapePoint);
        $this->landscapePoint->getLandscapeContext()->putObject($this);
    }

    private function setDirection(CardinalDirection $direction)
    {
        $this->direction = $direction;
    }

    private function setLandscapePoint(LandscapePointBase $landscapePoint)
    {
        $this->landscapePoint = $landscapePoint;
    }

    /**
     * @return LandscapePointBase
     */
    function getLandscapePoint()
    {
        $result = clone $this->landscapePoint;
        return $result;
    }

    /**
     * @return CardinalDirection
     */
    function getDirection()
    {
        $result = clone $this->direction;
        return $result;
    }

    private function rotateRight()
    {
        $this->direction->rotateRight();
    }

    private function rotateLeft()
    {
        $this->direction->rotateLeft();
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

    function moveAhead()
    {
        $lc = $this->landscapePoint->getLandscapeContext();
        try {
            $tpt = $lc->getTargetPoint($this);
            $lc->removeObject($this);
            $this->setLandscapePoint($tpt);
            $lc->putObject($this);
        } catch (PositionOutOfBoundariesException $e){
            // Oops, the rover've reached the plateau boundary!
            // It doesn't want to fall, so it would just ignore the movement
        }
    }

    function Idle(){

    }

    function getType(){
        return static::TERRESTRIAL;
    }

    /**
     * @param string $commands
     */
    function executeCommands($commands)
    {
        // Assuming the string is ANSI string - otherwise
        // string iteration would be far too slow and complex
        $commandsStrLen = strlen($commands);
        $commandPointer = null;
        $command = null;
        for($commandPointer=0; $commandPointer<$commandsStrLen; $commandPointer++)
        {
            $command = $commands[$commandPointer];
            $this->executeCommand($command);
        }
    }

    private function executeCommand($commandLiteral)
    {
        switch($commandLiteral)
        {
            case 'M':
                $this->moveAhead();
                break;
            case 'L':
            case 'R':
                $this->rotate($commandLiteral);
                break;
            default:
                ;
        }
    }
}