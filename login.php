<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
   <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
   <meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
   <link href="css/mui.min.css" rel="stylesheet" />
<title>酒店微信登录</title>
<script src="js/mui.min.js"></script>
		
</head>
<body >
<?php
session_start();
require 'db/db.php';
$code=$_GET['code'];
if(isset($_GET["hotelid"])){
$_SESSION["hotelid"]=$_GET["hotelid"];
$vchat=json_decode(select('*','vchat_config'," hotelid='".$_GET["hotelid"]."'"),true);
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?grant_type=authorization_code&appid=".$vchat[0]["appid"]."&secret=".$vchat[0]['secret']."&code=".$code.""; 

}else if(isset($_SESSION['appid'])){
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?grant_type=authorization_code&appid=".$_SESSION["appid"]."&secret=".$_SESSION['secret']."&code=".$code.""; 

}else{

 die("<script>mui.alert('系统错误!请您重新操作!')</script>");

}

$ch = curl_init($url);
//3.设置参数
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//跳过证书验证
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
//4.调用接口
$res = curl_exec($ch);
if(curl_errno($ch)){
    var_dump(curl_error($ch));
}
$resArr = json_decode($res,1);
 //var_dump($resArr);
//5.关闭curl
curl_close($ch);

$_SESSION["code"]=$code;
$user_info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$resArr['access_token']."&openid=".$resArr['openid']."&lang=zh_CN"; 

$mresArr = json_decode(file_get_contents($user_info_url));
	
//$isfocus_url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$resArr['access_token']."&openid=".$resArr['openid']."&lang=zh_CN"; 
//$isfocus = json_decode(file_get_contents($isfocus_url));
if (isset($mresArr->errcode)) {
    echo '<h1>错误：</h1>'.$mresArr->errcode;
    echo '<br/><h2>错误信息：</h2>'.$mresArr->errmsg;
    exit;
}

//$mresArr=json_encode($mresArr);
//5.关闭curl

if($mresArr->openid!=""){

//if($isfocus->subscribe !== 1){
//	header("location:https://mp.weixin.qq.com/mp/profile_ext?action=home&__biz=".$vchat[0]["biz"]."==#wechat_redirect");
//}else{
$checkhad=mysqli_query($con,"select * from user where openid='".$mresArr->openid."'  ");

$rows=mysqli_fetch_array($checkhad);

if(count($rows)==0){
if(isset($_GET["lastuser"])){

$lastuser=$_GET["lastuser"];
$hotel=json_decode(select("hotel","user","openid='".$lastuser."'"),true);
	if($mresArr->openid!=""&&$mresArr->openid!=null){
		mysqli_query($con,"insert into user(openid,nickname,sex,province,city,country,headimgurl,lastpeople,hotel)values(
'".$mresArr->openid."',
'".$mresArr->nickname."',
'".$mresArr->sex."',
'".$mresArr->province."',
'".$mresArr->city."',
'".$mresArr->country."',
'".$mresArr->headimgurl."',
'".$lastuser."',
'".$_SESSION['hotelid']."')");
}
}else{
/*
 	if($mresArr->openid!=""&&$mresArr->openid!=null){
		mysqli_query($con,"insert into user(openid,nickname,sex,province,city,country,headimgurl,hotel)values(
'".$mresArr->openid."',
'".$mresArr->nickname."',
'".$mresArr->sex."',
'".$mresArr->province."',
'".$mresArr->city."',
'".$mresArr->country."',
'".$mresArr->headimgurl."',
'".$_SESSION['hotelid']."'
)");
	}
*/
 die("<script>mui.alert('您未授权使用本服务,请到已授权使用本服务的酒店前台进行咨询!')</script>");

}
	

}else{
mysqli_query($con,"update  user set  nickname='".$mresArr->nickname."',sex='".$mresArr->sex."',province='".$mresArr->province."',city='".$mresArr->city."',country='".$mresArr->country."',headimgurl='".$mresArr->headimgurl."' 
where openid='".$mresArr->openid."'");

}
/*
if(isset($_GET["preferential"])){
	$checkcode=mysqli_query($con,"select * from fn_preferential where code='".$_GET["preferential"]."' and state=0 ");
	$code=mysqli_fetch_array($checkcode);
	if(count($code)!=0){
		$_SESSION["preferential"]=$code['code'];
		$_SESSION["amount"]=$code['amount'];
	}
	
}
*/
$_SESSION["openid"]=$mresArr->openid;
$_SESSION["headimgurl"]=$mresArr->headimgurl;


if($rows['telephone']==''||$rows['realname']==''){
	header("location:setphone.php");
}else{
if(isset($_GET['urlto'])){
header("location:".$_GET['urlto']."");
}else{
header("location:home.php?hotelid=".$_SESSION['hotelid']);
}
	
}

//}

}else{

	die("<script>mui.alert('微信信息授权失败！请微信搜索并关注“成都优客通”公众号！')</script>");
}


?>
</body>
</html>