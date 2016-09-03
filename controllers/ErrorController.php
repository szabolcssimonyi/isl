<?php

class ErrorController extends ControllerBase{
    
    public function __construct() {
        parent::__construct(['target'=>'Error','action'=>'index']);
    }
 
}