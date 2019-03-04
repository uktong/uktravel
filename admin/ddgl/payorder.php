<?php
//base start
require "../../hzb/config.php";
require R.'hzb/inc/load.php';
//base end
//check add
$jur=$base->getJur(md5($_COOKIE["username"]),"name",$_GET["J"]);
$J->type($jur, "edit");
$order=$db->select("uk_orders as a left join uk_user as b on a.user=b.openid", "a.*,b.realname", "a.orderid='".$_GET['orderid']."'")[0];
$orderstate=$db->select("uk_base", "*", "type='orderstate' order by sort");
$travelstate=$db->select("uk_base", "*", "type='travelstate' order by sort");
?>

<div class="pageContent">
	
	<form method="post" action="ddgl/dbaction.php?orderid=<?php echo $_GET['orderid']; ?>&action=uploadpic&J=<?php echo $_GET["J"];?>" class="pageForm required-validate"
	 enctype="multipart/form-data" onsubmit="return iframeCallback(this,navTabAjaxDone)">
		<div class="pageFormContent nowrap" layoutH="57">
			<dl>
				<dt>订单号：</dt>
				<dd>
					<?php echo $_GET['orderid'];?>
				</dd>
				<dt>提成金额：</dt>
				<dd>
					<?php echo $order["orderbackmoney"];?>
				</dd>
			</dl>
			<dl>
				<dt>行程状态：</dt>
				<dd>
					<?php 
					foreach ($travelstate as $ts){
					    if ($ts["value"]==$order["travelstate"]){
					        echo "<span style='color:".$ts["color"].";'>".$ts["name"]."</span>";
					    }
					}
					?>
				</dd>
				<dt>需求状态：</dt>
				<dd>
					<?php foreach ($orderstate as $os){
					    if ($os["value"]==$order["state"]){
					        echo "<span style='color:".$os["color"].";'>".$os["name"]."</span>";
					    }
					}?>
				</dd>
			</dl>
			<dl>
				<dt>收款码：</dt>
				<dd>
					<img alt="收款码"  style="width:200px;"  src="http://i1.umei.cc/uploads/tu/201902/10128/v11v1a6zvb.jpg">
				</dd>
				<dt>支付凭证：</dt>
				<dd>
					
					<?php if ($order["state"]==3){
					    ?>
					    <img alt="支付凭证"  style="width:200px;"  src="<?php echo "http://".$serverurl."/".$sitedoc."/admin/userpic/".$order["backmoneyfile"];?>">
					    <?php 
					    
					}else{?>
					<div class="upload-wrap">
					<input type="file" name="imgfile" accept="image/*">
					</div>
					<?php }?>
				
				</dd>
			</dl>
		</div>
		<div class="formBar">
			<ul><?php if ($order["state"]!=3){
					    ?>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
				<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
				<?php }?>
			</ul>
		</div>
	</form>
	
</div>