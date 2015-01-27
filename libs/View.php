<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class View {

    function __construct() {
        //echo 'this is the view';
    }

    public function render($name, $noInclude = false)
    {
        require 'views/' . $name . '.php';    
    }

}