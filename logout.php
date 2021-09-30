<?php
session_start();
require_once 'vendor/autoload.php';
$config = [
    'callback' => 'https://nexus.dev.doozycodsys.com/index.php',
    'keys'     => [
                    'id' => '78fg1ed7xkb0z2',
                    'secret' => 'npYmtpQjDbxseXjA'
                ],
    'scope'    => 'r_liteprofile r_emailaddress',
];

$adapter = new Hybridauth\Provider\LinkedIn( $config );
$adapter->disconnect();
session_destroy();
$newURL='index.php';
header('Location: '.$newURL);