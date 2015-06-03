<?php

namespace lib\RealmContext;


use lib\Enum\CardinalDirection;
use lib\LandscapeContext\Landscape2DContext;
use lib\LandscapeContext\Landscape2DPoint;
use lib\RealmEntities\Rover;

class RealmManager {

    /**
     * @var null | Landscape2DContext
     */
    private $plateau = null;

    /**
     * @var array
     */
    private $rovers = [];

    /**
     * @var array
     */
    private $roversCommands = [];

    private function createPlateau($plateauInitStringInput)
    {
        $plateauInitString = trim($plateauInitStringInput, ' ');
        $plateauInitCoords = explode(' ', $plateauInitString);
        $xmax = $plateauInitCoords[0];
        $ymax = $plateauInitCoords[1];
        $this->plateau = new Landscape2DContext([0, $xmax, 0, $ymax]);
    }

    private function addRover($roverInitStringInput)
    {
        $roverInitString = trim($roverInitStringInput, ' ');
        $roverInitArray = explode(' ', $roverInitString);
        $coordX = $roverInitArray[0];
        $coordY = $roverInitArray[1];
        $directionLiteral = $roverInitArray[2];

        $this->rovers[] = new Rover(
            new CardinalDirection($directionLiteral),
            new Landscape2DPoint($this->plateau, [$coordX, $coordY])
        );

    }

    /**
     * @param array $scriptTextLinesArray
     * @return string
     */
    function executeScript($scriptTextLinesArray)
    {
        reset($scriptTextLinesArray);
        $plateauInitStringInput = current($scriptTextLinesArray);
        $this->createPlateau($plateauInitStringInput);
        $roverInitString = null;
        $roverCommand = null;

        while( next($scriptTextLinesArray)!==false )
        {
            $roverInitString = current($scriptTextLinesArray);
            if($roverInitString==='') continue;
            $roverCommand = next($scriptTextLinesArray);
            $this->addRover($roverInitString);
            $this->roversCommands[] = $roverCommand;
        }

        foreach($this->roversCommands as $roverNo => $command)
        {
            $this->rovers[$roverNo]->executeCommands($command);
        }

        return $this->produceOutput();
    }

    /**
     * @return string
     */
    private function produceOutput()
    {
        $result = "";
        foreach ($this->rovers as $roverIndex => $rover) {
            $result .= $this->getRoverStateOutput($rover). "\n";
        }

        return $result;
    }

    /**
     * @param Rover $rover
     * @return string
     */
    private function getRoverStateOutput(Rover $rover)
    {
        $result = null;
        $directionLiteral = $rover->getDirection()."";
        $coordinates = $rover->getLandscapePoint()->getPosition();
        $result = "". $coordinates[0]. " ". $coordinates[1]. " ". $directionLiteral;

        return $result;
    }
}