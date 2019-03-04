<?php
//base start
require "../../hzb/config.php";
require R.'hzb/inc/load.php';
//base end
//check add
$jur=$base->getJur(md5($_COOKIE["username"]),"name",$_GET["J"]);
$J->type($jur, "edit");
$user=$db->select("uk_user ", "*", "openid='".$_GET['openid']."'")[0];

?>

<div class="pageContent">
	
	<form method="post" action="yhgl/dbaction.php?openid=<?php echo $_GET['openid']; ?>&action=edit&J=<?php echo $_GET["J"];?>" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="57">
			
			<dl>
				<dt>姓名：</dt>
				<dd>
					<input type="text" name="realname" class="required " value="<?php echo $user["realname"];?>" />
					
				</dd>
				<dt>手机：</dt>
				<dd>
					<input type="text" name="telephone" class="required " value="<?php echo $user["telephone"];?>" />
					
				</dd>
			</dl>
			<dl>
				<dt>酒店：</dt>
				<dd>
					<input type="text" name="hotel"  class="required "  value="<?php echo $user["hotel"];?>"/>
					
				</dd>
				<dt>酒店电话：</dt>
				<dd>
					<input type="text" name="hotelphone"  class="required " value="<?php echo $user["hotelphone"];?>"/>
					
				</dd>
			</dl>
	<dl>
				<dt>状态：</dt>
				<dd>
					<select name="state" class="combox">
					<option value="0" <?php if($user["state"]==0) echo "selected";?>>关闭</option>
					<option value="1" <?php if($user["state"]==1) echo "selected";?>>开启</option>
					</select>
				</dd>
				
			</dl>
			<dl>
				
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
</div>