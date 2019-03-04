<?php
//base start
require "../../hzb/config.php";
require R.'hzb/inc/load.php';
//base end
//check add
$jur=$base->getJur(md5($_COOKIE["username"]),"name",$_GET["J"]);
$J->type($jur, "add");
$temp=$db->select("uk_vchatmsgtemp", "*", "1=1");
?>

<div class="pageContent">
	
	<form method="post" action="vchat/dbaction.php?action=add&J=<?php echo $_GET["J"];?>" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="57">
			<dl>
				<dt>选择模板：</dt>
				<dd>
				<select class="combox" name="tempid" onchange="selecttemp($(this))" style="width:100%;">
				<option value="">------</option>
				<?php foreach ($temp as $t){?>
				<option value="<?php echo $t["tempid"];?>"><?php echo $t["title"];?></option>
				<?php }?>
				</select>
				</dd>
				
				
			</dl>
			<div id="addmsgbox"></div>
			
			
		</div>
		<div class="formBar">
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
			</ul>
		</div>
	</form>
	
</div>