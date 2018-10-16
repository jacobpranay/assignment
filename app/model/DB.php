<?php

namespace App\model;

use PDO;

class DB{

    protected $connection;

    protected $brandList;

    protected $modelList;

    function __construct(){
        try {
            DEFINE('DBUSER','root');
            DEFINE('DBPW','');
            DEFINE('DBHOST','localhost');
            DEFINE('DBNAME','assignment');
            date_default_timezone_set('Asia/Kolkata');
            $this->connection = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPW);
        }catch(PDOExecption $e){
            echo $e->message();
        }
    }

    public function query($sql,$type,$data=array()){
        if(!$this->connection){
            return false;
        }
        try {
            $db = $this->connection->prepare($sql);
            if($data){
                foreach ($data as $key =>$value) {
                    $db->bindValue(":$key",$value);
                }
            }
            $this->connection->beginTransaction();
            $db->execute();
            // echo $db->errorCode();
          //   var_dump($db->errorInfo());
            if(strcmp($type,'insert')===0){
                $result  = $this->connection->lastInsertId();
            }
            $this->connection->commit();
            if(strcmp($type,'select')===0){
                $i=1;
                $query_result = array();
                //  if($db->rowCount()==1){
                //      $query_result[] = $db->fetch(PDO::FETCH_ASSOC);
                //  }else if($db->rowCount()>1){
                while ($row = $db->fetchAll(PDO::FETCH_ASSOC)){
                    $query_result = $row;
                    $i++;
                }
                // }
            }

            if(strcmp($type,'insert')===0){
                return $result;
            }else if(strcmp($type,'update')===0){
                return 1;
            }else{
                return $query_result;
            }
        }catch(PDOExecption $e){
            $this->connection->rollback();
            error_log($e);
            return 0;
        }
    }

    // Get all the brands from the Database
    public function getBrands(){
        $sql = "SELECT `ID`,`brandName` FROM `Brands`";
        $this->brandList = $this->query($sql,'select');
        return ($this->brandList) ? $this->brandList : [];
    }

    //Get all the Models for a Brand
    public function getModelsByBrand($brand){
        $sql = "SELECT `ID`,`modelName`,`modelImage`,`modelDesc` FROM `Models` WHERE `BrandID`=:brandId";
        $this->modelList = $this->query($sql,'select',array('brandId'=>$brand));
        return ($this->modelList) ? $this->modelList : [];
    }


    public static function escape($str){
        return trim(htmlentities(stripslashes(strip_tags($str))));
    }

   public function getBrandCount(){
       return count($this->brandList);
   }

   public function getModelCount(){
    return count($this->modelList);
   }
 

}
