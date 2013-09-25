<?php
chdir('..');
include 'vendor/autoload.php';
$api = new Frontend('myrealm');
$api->main();
