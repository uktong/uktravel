<?php
//base start
require "../../../hzb/config.php";
require R.'hzb/inc/load.php';
//base end

if(isset($_POST["numPerPage"])){
    $numPerPage=$_POST["numPerPage"];
    $pageNum=$_POST["pageNum"];
}
?>


<form id="pagerForm" method="post" action="data/takeback/user.php">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="<?php echo $numPerPage;?>" />
</form>




<div class="pageContent">

	<table class="table" layoutH="45" targetType="dialog" width="100%">
		<thead>
			<tr>
				<th align="center">头像</th>
				<th align="center">微信昵称</th>
				<th align="center">姓名</th>
				<th align="center">联系方式</th>
				<th align="center">酒店</th>
				<th align="center">酒店电话</th>
				<th align="center">状态</th>
				<th align="center">查找带回</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			
			    $resultarray=$db->select("uk_user", "*", "1=1 order by id");
			    $resultnum=count($resultarray);
			    @$sr=($pageNum-1)*$numPerPage;
			    $resultnowarray=array_slice($resultarray,$sr,$numPerPage);
			for($a=0;$a<count($resultnowarray);$a++){
			    
			?>
			  <tr  >
			<td ><img style="width:40px;height: 40px;" src="<?php echo $resultnowarray[$a]['headimgurl'];?>"/>
            </td><td ><?php echo $resultnowarray[$a]['nickname'];?>
            </td><td ><?php echo $resultnowarray[$a]['realname'];?>
			</td><td  ><?php echo $resultnowarray[$a]['telephone'];?>
</td><td  ><?php echo $resultnowarray[$a]['hotel'];?>
</td><td ><?php echo $resultnowarray[$a]['hotelphone'];?>
</td><td ><?php echo $resultnowarray[$a]['state'];?>
			</td><td  >
			<a class="btnSelect" href="javascript:$.bringBack({id:'<?php echo $resultnowarray[$a]['openid'];?>', user:'<?php echo $resultnowarray[$a]['realname'];?>'})" title="选择">选择</a></td>
<?php			
}
 
    ?>
			
					

		</tbody>
	</table>

<?php require R.'admin/temp/table/dialog_footer.php';?>
</div>