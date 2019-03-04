<?php
//base start
require "../../hzb/config.php";
require R.'hzb/inc/load.php';
//base end
//check add
$jur=$base->getJur(md5($_COOKIE["username"]),"name",$_GET["J"]);
$J->type($jur, "edit");
$user=$db->select("uk_user ", "getmoneypic", "openid='".$_GET['openid']."'")[0];

?>

<div class="pageContent">
	
	<form method="post"  class="pageForm required-validate"
	 enctype="multipart/form-data" onsubmit="return iframeCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="57">
	
					<img alt="收款码"  style=" margin:0;width:312px;height: 422px;"  src="http://i1.umei.cc/uploads/tu/201902/10128/v11v1a6zvb.jpg">
		
		</div>
		<div class="formBar">
			<ul>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
	
</div>