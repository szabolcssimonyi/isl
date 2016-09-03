<?php
require_once __DIR__ .'/../interfaces/IController.php';
class ControllerBase implements IController{
    
    private $modelPath=__DIR__ .'/../models/';
    private $viewPath=__DIR__ .'/../views/';
    protected $target=false;
    protected $action=false;
    protected $format='html';
    protected $layout="main";
    
    public function __construct($config) {
        $this->target=strtolower($config['target']);
        $this->format=$config['format'];
        $rc=new ReflectionClass($this->target.'Controller');
        if($rc->hasMethod($config['action'].'Action')){
            $method = new \ReflectionMethod($this, $config['action'].'Action');
            if ($method->isPublic()){
                $this->action =  strtolower($config['action']);
                return;;
            }            
        }
        $this->action="error";
        $this->target="error";
    }
    
    protected function createModel($params=[]){
        if(!class_exists($this->modelPath.$this->target.'.php')){
            $path=$this->modelPath.$this->target.'.php';
            require_once $path;
        }
        if(class_exists($this->target)){
            $reflaction=new ReflectionClass($this->target);
            if(!$reflaction->isAbstract() && $reflaction->implementsInterface("IModel")){
                $params['target']=$this->target;
                return  $reflaction->newInstance($params);                            
            }
        }
        return false;
    }
    
    public function errorAction(){
        $this->action="error";
        $this->target="error";
        return $this->renderView($this->action);
    }
    
    public function indexAction(){        
        return $this->renderView($this->action);
    }
    
    public function renderView($view,$params=[]){
        $content=$this->renderPartial($view,$params);
        if($this->format==='row'){
            echo $content;
            return;
        }
        $layout=$this->renderLayout(['content'=>$content,'params'=>$params]);
        echo $layout;
    }
    
    protected function renderPartial($view,$params=[]){
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        $path=$this->viewPath.$this->target.'/'.$view.'.php';
        if(file_exists($path)){
            require($path);
        }
        else{
            require $this->viewPath.'error.php';
        }
        return ob_get_clean();
    }
    
    protected function renderLayout($params=[]){
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        $layout=$this->viewPath.'layout/'.$this->layout.'.php';
        if(file_exists($layout)){
            require($layout);
        }
        return ob_get_clean();
    }
    
    public function run(){
        call_user_func_array([$this, $this->action.'Action'],[]);
    }

    public function getModel() {
        return $this->createModel();
    }

}

