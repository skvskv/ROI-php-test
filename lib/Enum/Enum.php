<?php

namespace lib\Enum;


use lib\LandscapeContext\LandscapePointBase;

abstract class Enum {

    /**
     * @var null | int
     */
    private $index = null;

    /**
     * @var null | array
     */
    static protected $constants = null;

    /**
     * @var array
     */
    static protected $forwardIndex;

    /**
     * @var array
     */
    static protected $reverseIndex;

    /**
     * @param string $constName
     * @throws EnumException
     */
    final function __construct( $constName ) {
        $className = get_called_class();
        $constName = mb_strtoupper( $constName );
        if ( constant( "{$className}::{$constName}" )  === NULL ) {
            throw new EnumException( 'The \''.$constName.'\' value is not a member of the \''.$className.'\' enum.' );
        }
        static::initArraysWhenNecessary();
        $this->index = static::$reverseIndex[ $constName ];
    }

    /**
     * @return string
     */
    final function __toString() {
        $result = static::$forwardIndex[ $this->index ];
        return $result;
    }

    /**
     * @return string
     */
    final function get()
    {
        return $this->__toString();
    }

    final function getAssociatedValue()
    {
        return static::$constants[static::$forwardIndex[ $this->index ]];
    }

    static protected function initArrays()
    {
        $reflectionClass = new \ReflectionClass(get_called_class());
        static::$constants = $reflectionClass->getConstants();
        static::$forwardIndex = array_keys(static::$constants);
        static::$reverseIndex = array_flip(static::$forwardIndex);
    }

    static protected function initArraysWhenNecessary()
    {
        if (!is_array(static::$constants)) { static::initArrays(); }
    }

    /**
     * @return array
     */
    static function asArray()
    {
        self::initArraysWhenNecessary();
        $result = static::$constants;

        return $result;
    }

    /**
     * @param bool $allowUnderflow
     * @throws EnumUnderflowException
     */
    function shiftPrev($allowUnderflow=false)
    {
        $idx = $this->index-1;
        if(!array_key_exists($idx, static::$forwardIndex))
        {
            if ($allowUnderflow===true)
            {
                $this->index = -1+count(static::$forwardIndex);
            } else {
                throw new EnumUnderflowException();
            }
        } else {
            $this->index = $idx;
        }
    }

    /**
     * @param bool $allowOverflow
     * @throws EnumOverflowException
     */
    function shiftNext($allowOverflow=false)
    {
        $idx = $this->index+1;
        if(!array_key_exists($idx, static::$forwardIndex))
        {
            if ($allowOverflow===true)
            {
                $this->index = 0;
            } else {
                throw new EnumOverflowException();
            }
        } else {
            $this->index = $idx;
        }
    }
}
