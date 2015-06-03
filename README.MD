Brief about
=========================
This is a test task for ROI by Konstantin Shpolvind


Prerequisites
------------
    - PHP 5.5 or above
    - PHPUnit     (developed under version 4.6.6)
    - Composer    (developed under version 1.0-dev)


Deployment instructions
------------------
    - Clone from github
    - run 'composer install' command


Test run / Proof of Concept
---------------
    - cd to deployment directory
    - run 'phpunit  --bootstrap bootstrap.php lib/'


Internals
---------------
The \lib\RealmContext\RealmManager::executeScript method does all work,
and takes a multiline text or array of single-line strings as its input.
