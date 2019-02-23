<?php

$action=@$_GET["action"];
switch ($action){

    case "add":
        add();
        break;

    case "edit":
        edit();
        break;
}
function add(){
    //base start
    require "../../hzb/config.php";
    require R.'hzb/inc/load.php';
    //base end

    $checkname=$db->select("uk_admin","*","username='".$_POST["username"]."'");
    if(count($checkname)<1){
        $_POST["unicode"]=date("YmdHis").rand(1000,9999);
        if($db->insert("uk_admin",$_POST)){
            $allqx=$db->select("uk_jur", "*", "1=1");
          
            //62,1,1,1,0,3,1
            $str="";
            foreach ($allqx as $a){
                $str.=$a["id"].",0,0,0,0,99,0|";
            }
            
            $jur=array();
            
            $jur["userid"]=$_POST["unicode"];
            $jur["Jurisdiction"]=substr($str,0,strlen($str)-1);
            $db->insert("uk_adminjur",$jur);
        die('{ "statusCode":"200", "message":"添加成功！", "navTabId":"yhgl", "rel":"", "callbackType":"closeCurrent", "forwardUrl":"", "confirmMsg":"" }');
        }else{
            die('{ "statusCode":"300", "message":"添加失败！", "navTabId":"yhgl", "rel":"", "callbackType":"", "forwardUrl":"", "confirmMsg":"" }');
        }
    }else{
        die('{ "statusCode":"300", "message":"添加失败！已存在相同账号", "navTabId":"yhgl", "rel":"", "callbackType":"", "forwardUrl":"", "confirmMsg":"" }');
        
    }
}

function edit(){
    //base start
    require "../../hzb/config.php";
    require R.'hzb/inc/load.php';
    //base end


    $unicode=$_GET["unicode"];
    $checkname=$db->select("uk_admin","*","unicode='".$unicode."'");
    if(count($checkname)>0){
        if($db->update("uk_admin",$_POST,"unicode='".$unicode."'")){
          
            die('{ "statusCode":"200", "message":"修改成功！", "navTabId":"yhgl", "rel":"", "callbackType":"closeCurrent", "forwardUrl":"", "confirmMsg":"" }');
        }else{
            die('{ "statusCode":"300", "message":"修改失败！", "navTabId":"yhgl", "rel":"", "callbackType":"", "forwardUrl":"", "confirmMsg":"" }');
        }
    }else{
        die('{ "statusCode":"300", "message":"修改失败！无此账号", "navTabId":"yhgl", "rel":"", "callbackType":"", "forwardUrl":"", "confirmMsg":"" }');
        
    }
    
}