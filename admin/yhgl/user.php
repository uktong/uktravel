<?php
//base start
require "../../hzb/config.php";
require R.'hzb/inc/load.php';
//base end

//getpageJur

$jur=$base->getJur(md5($_COOKIE["username"]),"name",$_GET["J"]);
$usermsg=$base->data(md5($_COOKIE["username"]))[0];

if(isset($_POST["numPerPage"])){
    $numPerPage=$_POST["numPerPage"];
    $pageNum=$_POST["pageNum"];
}

?>



<div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" id="pagerForm" action="<?php echo $jur["url"]."?J=".$_GET["J"]; ?>" method="post" >
	<div class="searchBar">
	
		<table class="searchContent">
			<tr>
				
				
				
				<td>
					微信名:
						<input name="nickname"  type="text" value="<?php echo  isset($_POST["nickname"])?$_POST["nickname"]:"";?>">
				</td>
			<td>
					姓名:
						<input name="realname"  type="text" value="<?php echo  isset($_POST["realname"])?$_POST["realname"]:"";?>">
				</td>
				<td>
					手机:
						<input name="telephone"  type="text" class="phone" value="<?php echo  isset($_POST["telephone"])?$_POST["telephone"]:"";?>">
				</td>
				<td>
					酒店:
						<input name="hotel"  type="text" value="<?php echo  isset($_POST["hotel"])?$_POST["hotel"]:"";?>">
				</td>
				<td><div class="buttonActive"><div class="buttonContent"><button type="submit">搜索</button></div></div></td>
			</tr>
		</table>
		<input name="search"  type="hidden" size="30" value="yes"/>
		<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="<?php echo $numPerPage;?>" />
		
	</div>
	</form>
</div>
<div class="pageContent">

	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="edit" href="yhgl/edituser.php?openid={userlist}&<?php echo "J=".$_GET["J"];?>" target="dialog" mask="true"  width="760" height="210"><span>修改</span></a></li>
			<li><a class="icon" href="yhgl/showuserpic.php?openid={userlist}&<?php echo "J=".$_GET["J"];?>" target="dialog" mask="true"  width="340" height="520" rel="showuserpic"><span>查看支付码</span></a></li>
			
		</ul>
	</div>
	 <?php 
			 $sql="";
			 if(isset($_POST["search"])){
			    
			     $sql.=$_POST["nickname"]!=""?" and nickname like '%".$_POST["nickname"]."'%":"";
			     $sql.=$_POST["realname"]!=""?" and realname like '%".$_POST["realname"]."'%":"";
			     $sql.=$_POST["telephone"]!=""?" and telephone like '%".$_POST["telephone"]."'%":"";
			     $sql.=$_POST["hotel"]!=""?" and hotel like '%".$_POST["hotel"]."%'":"";
			     
			    
			 }
			     $result=$db->tabledata($pageNum,$numPerPage,"uk_user","*","1=1 ".$sql." order by id desc","id");
			     $resultnum=$result["amount"];
			     $resultnowarray=$result["result"];
			     ?>


	<table class="table" width="100%" layoutH="138" style="word-break:break-all; word-wrap:break-all;">
		<thead>
			<tr>
				<th align="center">序号</th>
				<th align="center">头像</th>
				<th align="center">微信昵称</th>
				<th align="center">姓名</th>
				<th align="center">手机</th>
				<th align="center">酒店</th>
				<th align="center">酒店电话</th>
				<th align="center">状态</th>
			</tr>
		</thead>
		<tbody>
			 <?php 
			 for ($a=0;$a<count($resultnowarray);$a++){
			     $line=$resultnowarray[$a];
			     
			     
			     ?>
			     <tr target="userlist" rel="<?php echo $line["openid"];?>">
			     <td><?php echo $a+1;?></td>
			     <td><img src="<?php echo $line["headimgurl"];?>"></td>
			     <td><?php echo $line["nickname"];?></td>
			     <td><?php echo $line["realname"];?></td>
			     <td><?php echo $line["telephone"];?></td>
			     <td><?php echo $line["hotel"];?></td>
			     <td><?php echo $line["hotelphone"];?></td>
			     <td><?php echo statebetext($line["state"]);?></td>

			     </tr>
			     
			     
			     
			     <?php 
			 }
		
 
    ?>
		</tbody>
	</table> 
<?php require R.'admin/temp/table/default_footer.php';?>
</div>