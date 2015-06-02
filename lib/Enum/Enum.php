<?php

namespace lib\Enum;


abstract class Enum {

    /**
     * @var mixed
     */
    private $theValue = null;

    /**
     * @var mixed
     */
    private $theName = null;

    /**
     * @var null | array
     */
    static protected $constants = null;

    /**
     * @param string $constName
     * @throws EnumException
     */
    final public function __construct( $constName ) {
        $className = get_called_class();

        $constName = strtoupper( $constName );
        if ( constant( "{$className}::{$constName}" )  === NULL ) {
            throw new EnumException( 'The \''.$constName.'\' value is not a member of the \''.$className.'\' enum.' );
        }
        $this->theName = $constName;
        $this->theValue = constant( "{$className}::{$constName}" );
    }

    final public function __toString() {
        return $this->theName;
    }

    final public function get()
    {
        return $this->__toString();
    }

    static public function asArray()
    {
        $result = null;
        if (is_array(static::$constants)){
            $result = static::$constants;
        } else {
            $refl = new \ReflectionClass(get_called_class());
            static::$constants = $refl->getConstants();
            $result = static::$constants;
        }

        return $result;
    }
}
