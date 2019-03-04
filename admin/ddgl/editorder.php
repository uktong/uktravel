<?php
//base start
require "../../hzb/config.php";
require R.'hzb/inc/load.php';
//base end
//check add
$jur=$base->getJur(md5($_COOKIE["username"]),"name",$_GET["J"]);
$J->type($jur, "edit");
$order=$db->select("uk_orders as a left join uk_user as b on a.user=b.openid", "a.*,b.realname", "a.orderid='".$_GET['orderid']."'")[0];
$orderstate=$db->select("uk_base", "*", "type='orderstate' order by sort limit 0,3");
$travelstate=$db->select("uk_base", "*", "type='travelstate' order by sort");
?>

<div class="pageContent">
	
	<form method="post" action="ddgl/dbaction.php?orderid=<?php echo $_GET['orderid']; ?>&action=edit&J=<?php echo $_GET["J"];?>" class="pageForm required-validate" onsubmit="return validateCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="57">
			<dl>
				<dt>订单号：</dt>
				<dd>
					<?php echo $_GET['orderid'];?>
				</dd>
				<dt>发布人：</dt>
				<dd>
					<input type="hidden" name="user.id" value="<?php echo  $order["user"];?>"/>
				<input type="text" class="getdata textInput" suggestUrl="data/select.php?type=user" 
				 name="user.user" value="<?php echo  $order["realname"];?>" suggestFields="user"  lookupGroup="user" />
				<a class="btnLook default" href="data/takeback/user.php" style="display:inline-block;float:none;vertical-align:top;" lookupGroup="user">选择用户</a>
				</dd>
				
			</dl>
			<dl>
				<dt>客户姓名：</dt>
				<dd>
					<input type="text" name="cusname" class="required " value="<?php echo $order["cusname"];?>" />
					
				</dd>
				<dt>联系方式：</dt>
				<dd>
					<input type="text" name="cusphone" class="required " value="<?php echo $order["cusphone"];?>" />
					
				</dd>
			</dl>
			<dl>
				<dt>成人数量：</dt>
				<dd>
					<input type="text" name="adultamount"  class="required "  value="<?php echo $order["adultamount"];?>"/>
					
				</dd>
				<dt>儿童数量：</dt>
				<dd>
					<input type="text" name="chdamount"  class="required " value="<?php echo $order["chdamount"];?>"/>
					
				</dd>
			</dl>
	<dl>
				<dt>预计线路：</dt>
				<dd>
					<input type="text" name="travelroad"  class="required " value="<?php echo $order["travelroad"];?>" />
					
				</dd>
				<dt>出发时间：</dt>
				<dd>
					<input type="text" name="starttime" value="<?php echo $order["starttime"];?>" mindate="<?php echo $today;?>" class="date textInput required  valid " />
					<a class="inputDateButton" href="javascript:;">选择</a>
				</dd>
			</dl>
			<dl>
				<dt>备注：</dt>
				<dd>
					<input type="text" name="remark"  class="required " value="<?php echo $order["remark"];?>" />
					
				</dd>
				<dt>行程状态：</dt>
				<dd>
					
					<select class="combox" name="travelstate" >
					<?php foreach ($travelstate as $a){?>
						<option value="<?php echo $a["value"];?>" <?php if($a["value"]==$order["travelstate"]) echo "selected";?>><?php echo $a["name"];?></option>
						
						<?php }?>
					</select>
				</dd>
			</dl>
			<dl>
				<dt>需求状态：</dt>
				<dd>
				<?php if($order["state"]>2){
					    echo "<p style='color:green'>提成已发放</p>";
					}else{?>
					<select class="combox" name="state" >
					<?php
					
					foreach ($orderstate as $a){?>
						<option value="<?php echo $a["value"];?>" <?php if($a["value"]==$order["state"]) echo "selected";?>><?php echo $a["name"];?></option>
						
						<?php }?>
					</select>
					<?php }?>
				</dd>
				<dt>提成金额：</dt>
				<dd>
					<input type="text" name="orderbackmoney" class="required " value="<?php echo $order["orderbackmoney"];?>"  />
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