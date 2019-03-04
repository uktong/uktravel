<?php
//base start
require "../../hzb/config.php";
require R.'hzb/inc/load.php';
//base end
$action=@$_GET["action"];


switch ($action){
    case "add":
        $_POST["user"]=$_POST["user_id"];
        unset($_POST["user_id"]);
        unset($_POST["user_user"]);
        
        $_POST["orderid"]=date("YmdHis").rand(10000,99999);
        $_POST["cratetime"]=date("Y-m-d H:i:s");
       $check=$db->select("uk_orders", "*", "onlycode='".$_POST['onlycode']."'");
       if (count($check)==0){
           $insert=$db->insert("uk_orders", $_POST);
           if ($insert){
               die('{ "statusCode":"200", "message":"添加成功！", "navTabId":"ddlb", "rel":"", "callbackType":"forward", "forwardUrl":"", "confirmMsg":"" }');
           }
       }else{
           die('{ "statusCode":"300", "message":"重复添加！", "navTabId":"", "rel":"", "callbackType":"forward", "forwardUrl":"", "confirmMsg":"" }');
           
       }
        break;
    case "edit":
        $_POST["user"]=$_POST["user_id"];
        unset($_POST["user_id"]);
        unset($_POST["user_user"]);
        
        
            $update=$db->update("uk_orders", $_POST,"orderid='".$_GET["orderid"]."'");
            if ($update){
                die('{ "statusCode":"200", "message":"修改成功！", "navTabId":"ddlb", "rel":"", "callbackType":"forward", "forwardUrl":"", "confirmMsg":"" }');
            }
        else{
            die('{ "statusCode":"300", "message":"修改失败！", "navTabId":"", "rel":"", "callbackType":"forward", "forwardUrl":"", "confirmMsg":"" }');
            
        }
        break;
    case "uploadpic":
        var_dump($_FILES);
        if (isset($_FILES['imgfile'])
        && is_uploaded_file($_FILES['imgfile']['tmp_name']))
        {
            $imgFile = $_FILES['imgfile'];
            $upErr = $imgFile['error'];
            $imgFileName = date("YmdHis").rand(1000,9999).".png";
            $imgSize = $imgFile['size'];
            $imgTmpFile = $imgFile['tmp_name'];
            move_uploaded_file($imgTmpFile, '../userpic/'.$imgFileName);
            $data=array();
            $data["state"]="3";
            $data["backmoneyfile"]=$imgFileName;
            $update=$db->update("uk_orders", $data,"orderid='".$_GET["orderid"]."'");
            die('{ "statusCode":"200", "message":"修改成功！", "navTabId":"payorder", "rel":"", "callbackType":"forward", "forwardUrl":"", "confirmMsg":"" }');
            
        }
        else
        {
            die('{ "statusCode":"300", "message":"文件上传失败！", "navTabId":"payorder", "rel":"", "callbackType":"forward", "forwardUrl":"", "confirmMsg":"" }');
            
        }


        break;
}
