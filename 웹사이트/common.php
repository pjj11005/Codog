<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount($_SERVER["DOCUMENT_ROOT"].'/firm-affinity-384813-firebase-adminsdk-ltf11-2aba40255c.json')
    ->withDatabaseUri('https://firm-affinity-384813-default-rtdb.firebaseio.com/');


$database = $factory->createDatabase();
?>