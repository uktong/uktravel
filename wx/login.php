<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
   <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
   <meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
   <link href="css/mui.min.css" rel="stylesheet" />
<title>优客通-飞牛巴士</title>
<script src="js/mui.min.js"></script>
		
</head>
<body >
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
var_dump($mresArr);

?>
</body>
</html>