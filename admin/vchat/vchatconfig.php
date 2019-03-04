<?php
//base start
require "../../hzb/config.php";
require R.'hzb/inc/load.php';
//base end
//check add
$jur=$base->getJur(md5($_COOKIE["username"]),"name",$_GET["J"]);
$J->type($jur, "edit");
$config=$db->select("uk_vchatconfig", "*", "1=1")[0];
?>

<div class="pageContent">
	
	<form method="post" action="vchat/dbaction.php?action=config&J=<?php echo $_GET["J"];?>" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="77">
			<dl>
				<dt>微信号：</dt>
				<dd>
					<input type="text" name="vchatname" class="required " style="width:100%;" value="<?php echo $config["vchatname"];?>"  />
				</dd>
				
				
			</dl>
			<dl>
				<dt>appid：</dt>
				<dd>
					<input type="text" name="appid" class="required" style="width:100%;"  value="<?php echo $config["appid"];?>"/>
					
				</dd>
				
			</dl>
			<dl>
				<dt>secret：</dt>
				<dd>
					<input type="text" name="secret" value="<?php echo $config["secret"];?>" class="required" style="width:100%;" />
					
				</dd>
				
			</dl>
			<dl>
			<dt>商户ID：</dt>
				<dd>
					<input type="text" name="MCHID" value="<?php echo $config["MCHID"];?>" class="required" style="width:100%;" />
					
				</dd>
			</dl>
	<dl>
				<dt>KEY：</dt>
				<dd>
					<input type="text" name="vKEY" value="<?php echo $config["vKEY"];?>"  class="required" style="width:100%;" />
					
				</dd>
			
			</dl>
			
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
	
</div>