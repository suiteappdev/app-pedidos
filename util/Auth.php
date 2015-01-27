<?php
/**
 * 
 */
class Auth{
    
    public static function handleLogin()
    {
        @session_start();
        if(!isset($_SESSION['loggedIn']))
            $_SESSION['loggedIn'] = false;

        $logged = $_SESSION['loggedIn'];
        if ($logged == false) {
            session_destroy();
            exit;
        }
    }
    
}