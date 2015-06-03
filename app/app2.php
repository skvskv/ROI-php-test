<?php

require_once "bootstrap.php";

$mgr = new \lib\RealmContext\RealmManager();

$output =
    $mgr->executeScript(
        [
            '5 5',
            '1 2 N',
            'LMLMLMLMM',
            '3 3 E',
            'MMRMMRMRRM'
        ]
    );

echo $output;
