<?php
require_once '../interfaces/IModel.php';

abstract class ModelBase implements IModel{
    
    protected $config;
    protected $params;
    protected $query;
    protected $data;
    protected $db;
    public $error;
    abstract function getQuery();
        

    public function __construct($params=[]) {
        $this->config=require(__DIR__ . '/../config/main.php');
        $this->params=$params;
        $this->query=$this->getQuery();
        $this->data=$this->getData();
    }
    
    protected function connect(){
        if($this->db!==null){
            return true;
        }
        try{            
            $this->db=new PDO("mysql:host={$this->config['host']};dbname={$this->config["db"]};charset=utf8mb4",$this->config['username'],$this->config['password']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return true;
        } catch (PDOException $ex) {
            $this->error=$ex->getMessage();
            return false;
        }
    }
    protected function escape($val){
        return htmlspecialchars($val);
    }
    protected function getLimits(){
        $from=isset($_REQUEST["from"]) && is_numeric($this->escape($_REQUEST["from"])) ? $this->escape($_REQUEST["from"]) : 0;
        $to=isset($_REQUEST["to"]) && is_numeric($this->escape($_REQUEST["to"])) ? $this->escape($_REQUEST["to"]) : 100;
        return ['from'=>$from,'to'=>$to];
    }
    
    public function getItems() {
        if(!$this->connect()){
            return false;
        }
        $stm=$this->db->prepare($this->query);
        $stm->execute($this->data);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getData() {
        return $this->getLimits();
    }
}