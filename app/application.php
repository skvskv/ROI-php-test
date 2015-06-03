<?php

require_once "bootstrap.php";

$mgr = new \lib\RealmContext\RealmManager();

$scriptStrings = [];

$output =
    $mgr->executeScript(
        $scriptStrings
    );

echo $output;
