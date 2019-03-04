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
$orderstate=$db->select("uk_base", "*", "type='orderstate' order by sort");
$travelstate=$db->select("uk_base", "*", "type='travelstate' order by sort");
?>



<div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" id="pagerForm" action="<?php echo $jur["url"]."?J=".$_GET["J"]; ?>" method="post" >
	<div class="searchBar">
	
		<table class="searchContent">
			<tr>
				
				
				
				<td class="dateRange">
					按发布日期:
						<input name="startDate" class="date readonly" readonly="readonly" type="text" value="<?php
					echo  isset($_POST["startDate"])?$_POST["startDate"]:$firstday;?>">
					<span class="limit">-</span>
					<input name="endDate" class="date readonly" readonly="readonly" type="text" value="<?php echo isset($_POST["endDate"])?$_POST["endDate"]:$lastday;?>">
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
			<li><a class="add" href="ddgl/addneworder.php<?php echo "?J=".$_GET["J"];?>" mask="true" target="dialog" width="760" height="380" rel="addneworder"><span>发布信息</span></a></li>
			<li><a class="edit" href="ddgl/editorder.php?orderid={orderlist}&<?php echo "J=".$_GET["J"];?>" target="dialog" mask="true"  width="760" height="380"><span>修改</span></a></li>
			<li><a class="icon" href="ddgl/payorder.php?orderid={orderlist}&<?php echo "J=".$_GET["J"];?>" target="dialog" mask="true"  width="980" height="480" rel="payorder"><span>支付佣金</span></a></li>
			<li><a class="delete" href="action/delete.php?action=ddlb&orderid={orderlist}&<?php echo "J=".$_GET["J"];?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
			
		</ul>
	</div>
	 <?php 
			 $sql="";
			 if(isset($_POST["search"])){
			    
			     if($_POST["startDate"]!=""){
			         $startdate=$_POST["startDate"];
			         $enddate=$_POST["endDate"]!=""?$_POST["endDate"]:date("Y-m-d",time());
			         $sql.=" and a.cratetime between '".$startdate." 00:00:00' and '".$enddate." 23:59:59' ";
			     }
			    
			 }else{
			     $sql.=" and a.cratetime between '".$firstday."  00:00:00' and '".$lastday."  23:59:59'";
			  
			 }
			     $result=$db->tabledata($pageNum,$numPerPage,"uk_orders as a left join uk_user as b on a.user=b.openid","a.*,b.realname,b.hotel,b.state as userstate","1=1 ".$sql." order by a.cratetime desc","a.onlycode");
			     $resultnum=$result["amount"];
			     $resultnowarray=$result["result"];
			     ?>


	<table class="table" width="100%" layoutH="138" style="word-break:break-all; word-wrap:break-all;">
		<thead>
			<tr>
				<th align="center">序号</th>
				<th align="center">订单号</th>
				<th align="center">酒店</th>
				<th align="center">发布人</th>
				<th align="center">客人姓名</th>
				<th align="center">联系方式</th>
				<th align="center">成人数量</th>
				<th align="center">儿童数量</th>
				<th align="center">预计线路</th>
				<th align="center">预计出行时间</th>
				<th align="center">需求状态</th>
				<th align="center">行程状态</th>
				<th align="center">发布时间</th>
			</tr>
		</thead>
		<tbody>
			 <?php 
			 for ($a=0;$a<count($resultnowarray);$a++){
			     $line=$resultnowarray[$a];
			     
			     foreach ($orderstate as $os){
			         if ($os["value"]==$line["state"]){
			             $ostate="<a style='color:".$os["color"].";'>".$os["name"]."</a>";
			         }
			     }
			     foreach ($travelstate as $ts){
			         if ($ts["value"]==$line["travelstate"]){
			             $tstate="<a style='color:".$ts["color"].";'>".$ts["name"]."</a>";
			         }
			     }
			     ?>
			     <tr target="orderlist" rel="<?php echo $line["orderid"];?>">
			     <td><?php echo $a+1;?></td>
			     <td><?php echo $line["orderid"];?></td>
			     <td><?php echo $line["hotel"];?></td>
			     <td><?php echo $line["realname"];?></td>
			     <td><?php echo $line["cusname"];?></td>
			     <td><?php echo $line["cusphone"];?></td>
			     <td><?php echo $line["adultamount"];?></td>
			     <td><?php echo $line["chdamount"];?></td>
			     <td><?php echo $line["travelroad"];?></td>
			     <td><?php echo $line["starttime"];?></td>
			     <td><?php echo $ostate;?></td>
			     <td><?php echo $tstate;?></td>
			     <td><?php echo $line["cratetime"];?></td>

			     </tr>
			     
			     
			     
			     <?php 
			 }
		
 
    ?>
		</tbody>
	</table> 
<?php require R.'admin/temp/table/default_footer.php';?>
</div>