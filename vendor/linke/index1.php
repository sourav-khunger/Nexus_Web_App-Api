<?php
require_once 'config.php';
 
try {
    $adapter->authenticate();
    $userProfile = $adapter->getUserProfile();
    print_r($userProfile);
}
catch( Exception $e ){
    echo $e->getMessage() ;
}