<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
   <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
   <meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

</head>
<body >
<script type="text/javascript">


</script>
<?php
session_start();
$code=$_GET['code'];
//	header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx7a5e0d8bf5cda8ee&redirect_uri=http%3A%2F%2Fwx.uktong.cn%2Ffeiniu%2Flogin.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect");


$appid = 'wx7a5e0d8bf5cda8ee';  
$secret = '45a89d49b0e879dfb0dc8971b9b82180';  
  
  
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?grant_type=authorization_code&appid=".$appid."&secret=".$secret."&code=".$code.""; 

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
if (isset($mresArr->errcode)) {
    echo '<h1>错误：</h1>'.$mresArr->errcode;
    echo '<br/><h2>错误信息：</h2>'.$mresArr->errmsg;
    exit;
}

//$mresArr=json_encode($mresArr);
//5.关闭curl

if($mresArr->openid!=""){
		
	require_once 'db/db.php';
$checkhad=mysqli_query($con,"select * from wx_user where openid='".$mresArr->openid."' ");

$rows=mysqli_fetch_array($checkhad);

if(count($rows)==0){
if(isset($_GET["lastuser"])){

$lastuser=$_GET["lastuser"];
$hotel=json_decode(select("hotel","wx_user","openid='".$lastuser."'"),true);
	if($mresArr->openid!=""&&$mresArr->openid!=null){
		mysqli_query($con,"insert into wx_user(openid,nickname,sex,province,city,country,headimgurl,lastpeople,hotel)values(
'".$mresArr->openid."',
'".$mresArr->nickname."',
'".$mresArr->sex."',
'".$mresArr->province."',
'".$mresArr->city."',
'".$mresArr->country."',
'".$mresArr->headimgurl."',
'".$lastuser."',
'".$hotel[0]['hotel']."')");
	}
}else{
 	if($mresArr->openid!=""&&$mresArr->openid!=null){
		mysqli_query($con,"insert into wx_user(openid,nickname,sex,province,city,country,headimgurl)values(
'".$mresArr->openid."',
'".$mresArr->nickname."',
'".$mresArr->sex."',
'".$mresArr->province."',
'".$mresArr->city."',
'".$mresArr->country."',
'".$mresArr->headimgurl."'
)");
	}
//
// die("<script>mui.alert('您未授权使用本服务,请到已授权使用本服务的酒店前台进行咨询!')</script>");
//
}
	

}else{
mysqli_query($con,"update  wx_user set  nickname='".$mresArr->nickname."',sex='".$mresArr->sex."',province='".$mresArr->province."',city='".$mresArr->city."',country='".$mresArr->country."',headimgurl='".$mresArr->headimgurl."' 
where openid='".$mresArr->openid."'");

}



if($rows['telephone']==''||$rows['realname']==''){
	header("location:setphone.php");
}else{
if(isset($_GET['urlto'])){
header("location:".$_GET['urlto']."");
}else{
header("location:newukbus/index.php");
}
	
}


}else{

	die("<script>mui.alert('微信信息授权失败！请微信搜索并关注“成都优客通”公众号！')</script>");
}


?>
</body>
</html>