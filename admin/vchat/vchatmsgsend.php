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
				<td class="dateRange">
					标题:
						<input name="title"   type="text" value="<?php
					echo  isset($_POST["title"])?$_POST["title"]:"";?>">
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
			<li><a class="add" href="vchat/addmsg.php<?php echo "?J=".$_GET["J"];?>" mask="true" target="dialog" width="400" height="360" rel="addneworder"><span>发送信息</span></a></li>
			<li><a class="edit" href="vchat/editmsg.php?tempid={msglist}&<?php echo "J=".$_GET["J"];?>" target="dialog" mask="true"  width="400" height="260"><span>修改</span></a></li>
			<li><a class="delete" href="action/delete.php?action=vchatmsg&msgid={msglist}&<?php echo "J=".$_GET["J"];?>" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
		</ul>
	</div>
	 <?php 
			 $sql="";
// 			 if(isset($_POST["search"])){
// 			     if($_POST["title"]!=""){
// 			         $sql.=" and title like '%".$_POST["title"]."'%";
// 			     }
// 			 }
			     $result=$db->tabledata($pageNum,$numPerPage,"uk_vchatmsg","*","1=1 ".$sql." ","id");
			     $resultnum=$result["amount"];
			     $resultnowarray=$result["result"];
			     ?>
	<table class="table" width="100%" layoutH="138" style="word-break:break-all; word-wrap:break-all;">
		<thead>
			<tr>
				<th align="center">序号</th>
				<th align="center">模板</th>
				<th align="center">发送时间</th>
				<th align="center">对象</th>
				<th align="center">页面跳转</th>
				<th align="center">内容</th>
			</tr>
		</thead>
		<tbody>
			 <?php 
			 for ($a=0;$a<count($resultnowarray);$a++){
			     $line=$resultnowarray[$a];
			     ?>
			     <tr target="msglist" rel="<?php echo $line["id"];?>">
			     <td><?php echo $a+1;?></td>
			     <td><?php echo $line["tempid"];?></td>
			     <td><?php echo $line["sendtime"];?></td>
			     <td><?php echo $line["userid"];?></td>
			     <td><?php echo $line["tourl"];?></td>
			     <td style="width:400px;"><?php echo $line["content"];?></td>
			     </tr>
			     <?php 
			 }
    ?>
		</tbody>
	</table> 
<?php require R.'admin/temp/table/default_footer.php';?>
</div>