<?php
    session_start ();
    require_once "GoogleAPI/Vendor/autoload.php";
    $gClient = new Google_Client ();
    $gClient -> setClientId ("1026878642222-5bhj7nr3tid095vh77aqbidghf0opu6g.apps.googleusercontent.com");
    $gClient -> setClientSecret ("bnIu6afREijzMCAoWhfByMdJ");
    $gClient -> setApplicationName ("RMCGoogle");
    $gClient -> setRedirectUrl ("http://localhost/startbootstrap-modern-business/php/home.php")

?>
