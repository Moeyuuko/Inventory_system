<?php
session_start();
include(".Config.php");
function logout() {
    unset ( $_SESSION ['user'] );
    if (! empty ( $_COOKIE ['username'] ) || ! empty ( $_COOKIE ['password'] )) 
    {
        setcookie ( "username", null, time () - 3600 * 24 * 365 );
        setcookie ( "password", null, time () - 3600 * 24 * 365 );
    }
}

logout();

if (isset($_GET['req_url'])){
    header ( "location:" . $_GET['req_url'] );
} else {
    header ( "location:" . $ROOT_DIR );
}
?>