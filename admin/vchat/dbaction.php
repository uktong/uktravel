<?php
//base start
require "../../hzb/config.php";
require R.'hzb/inc/load.php';
//base end
$action=@$_GET["action"];


switch ($action){
    case "config":
            $update=$db->update("uk_vchatconfig", $_POST,"id=1");
            if ($update){
                die('{ "statusCode":"200", "message":"修改成功！", "navTabId":"vchatconfig", "rel":"", "callbackType":"forward", "forwardUrl":"", "confirmMsg":"" }');
            }
        else{
            die('{ "statusCode":"300", "message":"修改失败！", "navTabId":"vchatconfig", "rel":"", "callbackType":"forward", "forwardUrl":"", "confirmMsg":"" }');
            
        }
        break;
    case "add":
        $insert=$db->insert("uk_vchatmsgtemp", $_POST);
        if ($insert){
            die('{ "statusCode":"200", "message":"添加成功！", "navTabId":"vchatmsgtemp", "rel":"", "callbackType":"forward", "forwardUrl":"", "confirmMsg":"" }');
        }
        else{
            die('{ "statusCode":"300", "message":"添加失败！", "navTabId":"vchatmsgtemp", "rel":"", "callbackType":"forward", "forwardUrl":"", "confirmMsg":"" }');
            
        }
        break;
    case "edit":
        $update=$db->update("uk_vchatmsgtemp", $_POST,"id='".$_GET["tempid"]."'");
        if ($update){
            die('{ "statusCode":"200", "message":"修改成功！", "navTabId":"vchatmsgtemp", "rel":"", "callbackType":"forward", "forwardUrl":"", "confirmMsg":"" }');
        }
        else{
            die('{ "statusCode":"300", "message":"修改失败！", "navTabId":"vchatmsgtemp", "rel":"", "callbackType":"forward", "forwardUrl":"", "confirmMsg":"" }');
            
        }
        break;
}
