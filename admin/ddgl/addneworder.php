<?php
//base start
require "../../hzb/config.php";
require R.'hzb/inc/load.php';
//base end
//check add
$jur=$base->getJur(md5($_COOKIE["username"]),"name",$_GET["J"]);
$J->type($jur, "add");
$orderstate=$db->select("uk_base", "*", "type='orderstate' order by sort limit 0,3");
$travelstate=$db->select("uk_base", "*", "type='travelstate'  order by sort ");
?>

<div class="pageContent">
	
	<form method="post" action="ddgl/dbaction.php?action=add&J=<?php echo $_GET["J"];?>" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="57">
			<dl>
				<dt>订单号：</dt>
				<dd>
					系统自动生成
				<input type="hidden" name="onlycode" value="<?php echo date("YmdHis").rand(10000,99999);?>"/>
				</dd>
				<dt>发布人：</dt>
				<dd>
					<?php require R.'admin/temp/search/user.php';?>
				
				</dd>
				
			</dl>
			<dl>
				<dt>客户姓名：</dt>
				<dd>
					<input type="text" name="cusname" class="required " />
					
				</dd>
				<dt>联系方式：</dt>
				<dd>
					<input type="text" name="cusphone" class="required " />
					
				</dd>
			</dl>
			<dl>
				<dt>成人数量：</dt>
				<dd>
					<input type="text" name="adultamount" value="0" class="required " />
					
				</dd>
				<dt>儿童数量：</dt>
				<dd>
					<input type="text" name="chdamount" value="0" class="required " />
					
				</dd>
			</dl>
	<dl>
				<dt>预计线路：</dt>
				<dd>
					<input type="text" name="travelroad"  class="required " />
					
				</dd>
				<dt>出发时间：</dt>
				<dd>
					<input type="text" name="starttime" value="<?php echo $tomorrow;?>" mindate="<?php echo $today;?>" class="date textInput required  valid " />
					<a class="inputDateButton" href="javascript:;">选择</a>
				</dd>
			</dl>
			<dl>
				<dt>备注：</dt>
				<dd>
					<input type="text" name="remark"  class="required " />
					
				</dd>
				<dt>行程状态：</dt>
				<dd>
					
					<select class="combox" name="travelstate" >
					<?php foreach ($travelstate as $a){?>
						<option value="<?php echo $a["value"];?>"><?php echo $a["name"];?></option>
						
						<?php }?>
					</select>
				</dd>
			</dl>
			<dl>
				<dt>需求状态：</dt>
				<dd>
					<select class="combox" name="state" >
					<?php foreach ($orderstate as $a){?>
						<option value="<?php echo $a["value"];?>"><?php echo $a["name"];?></option>
						
						<?php }?>
					</select>
					
				</dd>
				<dt>提成金额：</dt>
				<dd>
					<input type="text" name="orderbackmoney" class="required "  />
					
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