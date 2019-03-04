<?php
//base start
require "../../hzb/config.php";
require R.'hzb/inc/load.php';
//base end
//check add
$jur=$base->getJur(md5($_COOKIE["username"]),"name",$_GET["J"]);
$J->type($jur, "add");

?>

<div class="pageContent">
	
	<form method="post" action="vchat/dbaction.php?action=add&J=<?php echo $_GET["J"];?>" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="57">
			<dl>
				<dt>编号：</dt>
				<dd>
				<input type="text" name="code" style="width:100%;" class="required " />
				</dd>
				
				
			</dl>
			<dl>
				<dt>标题：</dt>
				<dd>
					<input type="text" name="title" style="width:100%;" class="required " />
					
				</dd>
			
			</dl>
			<dl>
				<dt>内容：</dt>
				<dd>
					<input type="text" name="content" style="width:100%;"  class="required " />
					
				</dd>
				
			</dl>
	<dl>
				<dt>模板ID：</dt>
				<dd>
					<input type="text" name="tempid" style="width:100%;"  class="required " />
					
				</dd>
				
			</dl>
			<dl>
				<dt>效果：</dt>
				<dd>
					<input type="text" name="exp" style="width:100%;"  class="required " />
					
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