<?php

class UsersController extends ControllerBase{
    public function __construct($config) {
        parent::__construct($config);
    }
    
    public function indexAction() {
        $model=$this->createModel();
        $data=$model->getItems();
        if($data===false){
            $this->errorAction();
            return;
        }
        $this->renderView('index', ['model'=>$data,'title'=>'Felhasználók']);
    }
    
    public function downloadsAction(){
        $model=$this->createModel();
        $data=$model->getDownloads();
        if($data===false){
            $this->errorAction();
            return;
        }
        $this->renderView('index',['model'=>$data,'title'=>'Letöltések']);
    }
    public function favoritesAction(){
        $model=$this->createModel();
        $data=$model->getFavorites();
        if($data===false){
            $this->errorAction();
            return;
        }
        $this->renderView('index',['model'=>$data,'title'=>'Kedvenc feladatlapok']);
    }
}