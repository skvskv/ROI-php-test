<?php

    function array_has_keys($keynames = [], $haystack=[])
    {
        $result = null;
        if( !is_array($keynames) or !is_array($haystack)){
            throw new InvalidArgumentException(__FUNCTION__."() arguments MUST be arrays.\n");
        }
        $result = (count($haystack)>0);
        foreach ($keynames as $keyname) {
            $result = ($result and array_key_exists($keyname, $haystack));
        }

        return $result;
    }

    function addArrayComponents($masterArray, $additionsArray)
    {
        $result = null;
        foreach ($masterArray as $k => $v) {
            $result[$k] = $v + $additionsArray[$k];
        }

        return $result;
    }
