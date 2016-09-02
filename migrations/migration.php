<?php

class MigrationExecutor{
    private $statements=[];
    private $config;
    function __construct() {
        $this->config=require(__DIR__ . '/../config/main.php');
        foreach(glob('./updates/*.sql') as $path){
            $this->statements=array_merge($this->statements,  explode(";",file_get_contents($path)));
        }
    }
    
    private function connect(){
        try{
            $db=new PDO("mysql:host={$this->config['host']};charset=utf8mb4",$this->config['username'],$this->config['password']);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $db->exec("DROP DATABASE IF EXISTS `{$this->config['db']}`");
            $db->exec("CREATE DATABASE `{$this->config['db']}` /*!40100 DEFAULT CHARACTER SET utf8mb4 */");
            $db->exec("use `{$this->config['db']}`");
            return $db;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }            
    }
    
    public function execute(){
        if(count($this->statements)===0 || ($db=$this->connect())=== false){
            echo "A migráció csatlakozási vagy végrehajtási hiba miatt megszakadt!";
            return;
        }
        try{
            
            $db->beginTransaction();

            foreach($this->statements as $statement){
                if(strlen(trim($statement))===0){
                    continue;
                }
                echo PHP_EOL.$statement. PHP_EOL. PHP_EOL;
                echo 'executed, rows affected: '.$db->exec($statement). PHP_EOL. PHP_EOL;
            }
            
            $db->commit();
            
        } catch (PDOException $ex) {
            echo  PHP_EOL.$ex->getMessage().PHP_EOL;
        }
    }
}

$migrator=new MigrationExecutor();
$migrator->execute();

?>