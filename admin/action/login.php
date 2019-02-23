<?php
require "../../hzb/config.php";
require R.'hzb/class/db.class.php';
$username=$_POST["username"];
$password=$_POST["password"];
$code=$_POST["code"];

if(md5($code)!=$_COOKIE["verification"]){
    echo <<<alert

<script>alert("验证码错误！请重新输入！");
history.go(-1);
</script>

alert;
}else{
        $usermsg=$db->select("uk_admin ", "*", "username='".$username."' and password='".$password."' and state=1");
      if(count($usermsg)!=0){

            setcookie("unicode", $usermsg[0]["unicode"], $cookielife, "/");
            setcookie("username", $username, $cookielife, "/");
//             require 'savecache.php';
            $url->to("admin/index.php");
        }else{
        echo <<<alert
        
            <script>alert("账号或密码错误，请重新输入！");
            history.go(-1);
            </script>
            
alert;
    }
}
