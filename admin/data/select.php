<?php
require "../../hzb/config.php";
require R.'hzb/inc/load.php';

if(isset($_GET["inputValue"])){
    $name=$_GET["inputValue"];
}else {
    $name=$_POST["inputValue"];
}
if($name!=""){
switch ($_GET["type"]){
    case "user":
        $data=$db->select("uk_user", "openid as id,realname as user", "realname like '%".$name."%' or openid like '%".$name."%' 
or nickname like '%".$name."%' limit 0,10");
        break;
  
}
}
echo json_encode($data);
