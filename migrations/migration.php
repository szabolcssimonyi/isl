<?php
header('charset=ISO-8859-2');
class MigrationExecutor{
    private $statements=[];
    private $resources=[];
    private $config;
    function __construct() {
        $this->config=require(__DIR__ . '/../config/main.php');
        $this->loadStatements();
        $this->loadResources();
    }
    
    private function connect(){
        try{
            $db=new PDO("mysql:host={$this->config['host']};charset=utf8mb4",$this->config['username'],$this->config['password']);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $db->exec("DROP DATABASE IF EXISTS `{$this->config['db']}`");
            $db->exec("CREATE DATABASE `{$this->config['db']}`  /*!40100 DEFAULT CHARACTER SET utf8  COLLATE utf8_hungarian_ci */");
            $db->exec("use `{$this->config['db']}`");
            return $db;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            return false;
        }
    }
    
    private function loadStatements(){
        foreach(glob('./updates/*.sql') as $path){
            $this->statements=array_merge($this->statements,  explode(";",file_get_contents($path)));
        }
    }
    
    private function loadResources(){
        foreach (glob('./updates/tables/*.csv') as $file){
            list($path,$pos)=  explode('_', basename($file,".csv"));
            $this->resources[$pos]=$file;
        }
        ksort($this->resources);
    }            
    
    private function executeStatements($db){
        foreach($this->statements as $statement){
           if(strlen(trim($statement))===0){
               continue;
           }
           echo PHP_EOL.$statement. PHP_EOL. PHP_EOL;
           echo 'executed, rows affected: '.$db->exec($statement). PHP_EOL. PHP_EOL;
        }
    }
    
    private function executeResourses($db){
        foreach($this->resources as $resource){
            $content=file_get_contents($resource);
            $table=explode('_',basename($resource,'.csv'))[0];
            $rows=explode(PHP_EOL, $content);
            $header=array_shift($rows);
            $header=  '`'.implode("`,`", explode(";", $header)).'`';
            echo "insert rows into {$table}".PHP_EOL;
            foreach ($rows as $row){
                $cells=  explode(';', $row);
                if(count(explode(',', $header)) !== count($cells)){
                    continue;
                }
                $str="INSERT INTO {$table}({$header}) VALUES('".implode("','", $cells)."')";
                echo $str.PHP_EOL;
                $db->exec($str);
            }
        }
    }
    
    public function execute(){
        if(count($this->statements)===0 || ($db=$this->connect())=== false){
            echo "A migráció csatlakozási vagy végrehajtási hiba miatt megszakadt!";
            return;
        }
        try{
            
            $db->beginTransaction();

            $this->executeStatements($db);            
            $this->executeResourses($db);
            
            $db->commit();
            
        } catch (PDOException $ex) {
            echo  PHP_EOL.$ex->getMessage().PHP_EOL;
        }
    }
}

$migrator=new MigrationExecutor();
$migrator->execute();

?>