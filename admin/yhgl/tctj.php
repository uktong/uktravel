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
	 <?php 
			 $sql="";
			 if(isset($_POST["search"])){
			    
			     $sql.=$_POST["nickname"]!=""?" and a.nickname like '%".$_POST["nickname"]."%'":"";
			     $sql.=$_POST["realname"]!=""?" and a.realname like '%".$_POST["realname"]."%'":"";
			     $sql.=$_POST["telephone"]!=""?" and a.telephone like '%".$_POST["telephone"]."%'":"";
			     $sql.=$_POST["hotel"]!=""?" and a.hotel like '%".$_POST["hotel"]."%'":"";
			     
			    
			 }
			     $result=$db->tabledata($pageNum,$numPerPage,"uk_user  as a left join uk_orders as b on a.openid=b.user","a.*,count(b.orderid) as total,sum(b.orderbackmoney) as money","1=1 ".$sql." group by a.openid order by a.id desc","a.id");
			     $resultnum=$result["amount"];
			     $resultnowarray=$result["result"];
			     
			     //总统计
			     $alltotal=0;
			     $allmoney=0;
			     $count=$db->select("uk_user  as a left join uk_orders as b on a.openid=b.user", "count(b.orderid) as total,sum(b.orderbackmoney) as money"
						    , "1=1 ".$sql." group by a.openid order by a.id desc");
			     foreach ($count as $a){
			         $alltotal+=$a["total"];
			         $allmoney+=$a["money"];
			     }
			     //排序+单页统计
			     $sumtotal=0;
			     $summoney=0;
			     if(count($resultnowarray)>0){
			     foreach ($resultnowarray as $key => $row)
			     {
			         $volume[$key]  = $row['total'];
			         $sumtotal+=$row['total'];
			         $summoney+=$row["money"];
			     }
			     array_multisort($volume, SORT_DESC,  $resultnowarray);
			     }
			     ?>


	<table class="table" width="100%" layoutH="108" style="word-break:break-all; word-wrap:break-all;">
		<thead>
			<tr>
				<th align="center">序号</th>
				<th align="center">头像</th>
				<th align="center">微信昵称</th>
				<th align="center">姓名</th>
				<th align="center">手机</th>
				<th align="center">酒店</th>
				<th align="center">酒店电话</th>
				<th align="center">单量</th>
				<th align="center">提成</th>
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
			     <td><?php echo $line["total"];?></td>
			      <td><?php echo $line["money"];?></td>
			     </tr>
			     <?php 
			 }
		
 
    ?><tr class="tfoot">
		 <th>本页合计</th>
		  <th></th>
		    <th></th>
		      <th></th>
		        <th></th>
		          <th></th>
		            <th></th>
		              <th><?php echo $sumtotal;?></th>
		                <th><?php echo $summoney;?></th>
		</tr><tr class="tfoot">
		 <th >查询总计</th>
		  <th></th>
		    <th></th>
		      <th></th>
		        <th></th>
		          <th></th>
		            <th></th>
		              <th><?php echo $alltotal;?></th>
		                <th><?php echo $allmoney;?></th>
		</tr>
		</tbody>
	</table> 
<?php require R.'admin/temp/table/default_footer.php';?>
</div>