<?php
//require 'model/DB.php';
use App\model\DB;
require_once 'vendor/autoload.php';
$DB = new DB;



if(isset($_GET['brandID'])){
    $result = '';
    $brandID = $DB->escape($_GET['brandID']);
    if(!empty($brandID)){
       echo json_encode($DB->getModelsByBrand($brandID));
       
    }else{
        return;
    }
}
