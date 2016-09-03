<?php
require_once __DIR__ .'/../controllers/ControllerBase.php';
require_once __DIR__ .'/../controllers/ErrorController.php';
require_once __DIR__ .'/../models/ModelBase.php';
require_once __DIR__ .'/../interfaces/IModel.php';

class Application
{
    private $controllerPath=__DIR__ .'/../controllers/';
    private $controller=false;
    private $formats=['html','row'];

    public function __construct($config) {
        if(($result=$this->validate($config))!==false){
            $this->controller=$this->createController($result);
        }
        else{
            $this->controller=new ErrorController();
        }
    }
       
    private function validate($config){
        $target=htmlspecialchars($config['target']);
        $action=htmlspecialchars($config['action']);
        $format=htmlspecialchars($config['format']);
        if(!in_array($format, $this->formats)){
            $format='html';
        }

        $path=$this->controllerPath.$target.'Controller.php';
        if(file_exists($path)){
            return ['target'=>$target,'action'=>$action,'format'=>$format];
        }
        return false;
    }
    
    private function createController($params){        
        if(!class_exists($params['target'].'Controller')){
            $path=$this->controllerPath.$params['target'].'Controller.php';
            require_once $path;
        }
        if(class_exists($params['target'].'Controller')){
            $reflaction=new ReflectionClass($params['target'].'Controller');
            if(!$reflaction->isAbstract() && $reflaction->implementsInterface("IController")){
                return  $reflaction->newInstance($params);                            
            }
        }
        return false;
    }
    
    public function getController(){
        return $this->controller;
    }
    
    public function run(){
        $this->controller->run();
    }
    
}

