<?php
require_once '../hzb/config.php';
require_once R.'hzb/inc/load.php';
$api=$_GET;
$data=array();
if (empty($api["key"])){
    $data["succuss"]=false;
    $data["errmsg"]="无KEY值";
    die(json_encode($data));
}
// $checkkey=$db->select("uk_apipass ", "*", "state=1");
if($api["key"]!=88888888){
    $data["succuss"]=false;
    $data["errmsg"]="无效KEY值";
    die(json_encode($data));
}
// $data=$db->select("uk_admin", "*", "unicode=".$checkkey["user"]);

if(empty($api["action"])){
    $data["succuss"]=false;
    $data["errmsg"]="无action";
    die(json_encode($data));
}

//获取数据

//登录
switch ($api["action"]){
    case "login":
        if(!empty($_POST["openid"])){
        $checkuser=$db->select("uk_user","openid","openid='".$_POST["openid"]."'");
        if(count($checkuser)==0){//插入新用户信息
                  $insert=$db->insert("uk_user", $_POST);
                  if($insert){
                      $userdata=$db->select("uk_user","*","openid='".$_POST["openid"]."'");
                      $data=$userdata;
                      $data["succuss"]=true;
                  }
            }else{//更新并获取用户信息
                $updata=$db->update("uk_user", $_POST, "openid='".$_POST["openid"]."'");
                if($updata){
                    $userdata=$db->select("uk_user","*","openid='".$_POST["openid"]."'");
                    $data=$userdata;
                    $data["succuss"]=true;
                }
            }
        }else{
            $data["succuss"]=false;
            $data["errmsg"]="无openid";
        }
        break;
    case "updateuser":
        if(!empty($_POST["openid"])){
            $updata=$db->update("uk_user", $_POST, "openid='".$_POST["openid"]."'");
            if($updata){
                $userdata=$db->select("uk_user","*","openid='".$_POST["openid"]."'");
                $data=$userdata;
                $data["succuss"]=true;
            }else{
                $data["succuss"]=false;
                $data["errmsg"]="用户信息更新失败";
            }
        }else{
            $data["succuss"]=false;
            $data["errmsg"]="无openid";
        }
        break;
    case "chargelist":
        if(is_numeric($_GET["s"])){
            $chargedata=$db->select("uk_orders as a left join uk_user as b on a.user=b.openid","a.*,b.headimgurl,b.telephone,b.hotel","1=1 order by a.cratetime desc limit ".(int)$_GET["s"].",".(int)$_GET["e"]);
            $countchargesbymonth=$db->select("uk_orders","count(orderid) as amount,user","state=1 and cratetime between '".$firstday." 00:00:00' and '".$lastday." 23:59:59' group by user ");
            
                foreach ($chargedata as $b){
                    foreach ($countchargesbymonth as $a){
                            if($b["user"]==$a["user"]){
                                $chargedata["monthcount"]=$a["amount"];
                            }
                        }
                    if ($b["user"]!=$_GET["user"]){
                       
                        $chargedata["hotel"]=hidemainword($chargedata["hotel"], 2);
                        $chargedata["cusname"]=hidemainword($chargedata["cusname"], 1,false);
                    }
                }
            $data["charges"]=$chargedata;
            $data["succuss"]=true;
        }else{
            $data["succuss"]=false;
            $data["errmsg"]="请传入正确的条数";
        }
        break;
    case "chargeinfo":
        if(!empty($_GET["user"])&&!empty($_GET["orderid"])){
            $chargeinfo=$db->select("uk_orders as a left join uk_user as b on a.user=b.openid","a.*,b.headimgurl,b.telephone,b.hotel","a.orderid='".$_GET["orderid"]."'");
            if ($chargeinfo[0]["user"]!=$_GET["user"]){
                $chargedata["hotel"]=hidemainword($chargedata["hotel"], 2);
                $chargedata["cusname"]=hidemainword($chargedata["cusname"], 1,false);
            }
        }else{
            $data["succuss"]=false;
            $data["errmsg"]="请传入正确的参数";
        }
        break;
    case "addcharge":
        if(!empty($_POST["user"])&&!empty($_POST["cusphone"])&&!empty($_POST["cusname"])){
            $_POST["orderid"]=date("YmdHis").rand(10000,99999);
            $_POST["cratetime"]=date("Y-m-d H:i:s");
            $insert=$db->insert("uk_orders", $_POST);
            if ($insert){
                $data["succuss"]=true;
                $data["orderid"]=$_POST["orderid"];
            }else{
                $data["succuss"]=false;
                $data["errmsg"]="添加失败";
            }
        }else{
            $data["succuss"]=false;
            $data["errmsg"]="请传入正确的参数";
        }
        break;
    case "editcharge":
        if(!empty($_GET["orderid"])){
            $update=$db->update("uk_orders", $_POST,"orderid='".$_GET["orderid"]."'");
            if ($update){
                $data["succuss"]=true;
                $data["orderid"]=$_GET["orderid"];
            }else{
                $data["succuss"]=false;
                $data["errmsg"]="修改失败";
            }
        }else{
            $data["succuss"]=false;
            $data["errmsg"]="请传入正确的参数";
        }
        break;
        
}
echo json_encode($data);



