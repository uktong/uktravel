<?php
//base start
require "../../hzb/config.php";
require R.'hzb/inc/load.php';
//base end



if(isset($_POST["numPerPage"])){
    $numPerPage=$_POST["numPerPage"];
    $pageNum=$_POST["pageNum"];
}

?>

<form id="pagerForm" method="post" action="xtgl/user.php">
<!-- 	<input type="hidden" name="status" value="${param.status}"> -->
<!-- 	<input type="hidden" name="keywords" value="${param.keywords}" /> -->
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="<?php echo $numPerPage;?>" />
<!-- 	<input type="hidden" name="orderField" value="${param.orderField}" /> -->
</form>



<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" href="xtgl/adduser.php" target="dialog" mask="true" width="500" height="112"><span>添加</span></a></li>
			
		</ul>
	</div>
	<table class="table" width="100%" layoutH="98" style="word-break:break-all; word-wrap:break-all;">
		<thead>
			<tr>
				<th align="center">序号</th>
				<th align="center">登录账号</th>
				<th align="center">姓名</th>

				<th align="center">启用标志</th>
				<th align="center">操作</th>
			</tr>
		</thead>
		<tbody id="datacontent" >
			<?php 
			

			$result=$db->tabledata($pageNum,$numPerPage,"uk_admin","*","1=1","id");
			$resultnum=$result["amount"];
			$resultnowarray=$result["result"];
			for($a=0;$a<count($resultnowarray);$a++){
			    
			?>
			  <tr  >
			<td ><?php echo ($a+1);?>
			</td><td ><?php echo $resultnowarray[$a]['username'];?>
            </td><td ><?php echo $resultnowarray[$a]['realname'];?>
		

</td><td ><?php 
if($resultnowarray[$a]['state']==0){
    echo "<p style='color:red;line-height:22px;'>禁用</p>";
}else{
    echo "<p style='color:green;line-height:22px;'>开启</p>";
}
?>
			</td>
			<td><a href="xtgl/qxgl.php?unicode=<?php echo $resultnowarray[$a]['unicode'];?>" style="color:blue;" target="dialog" mask="true"  width="800" height="610" rel="qxgl">权限管理</a>
			<a  href="xtgl/edituser.php?unicode=<?php echo $resultnowarray[$a]["unicode"];?>" style="color:blue;" target="dialog" mask="true" width="500" height="112"rel="edituser" >修改</a>
	
			</td>
			
			</tr>
<?php			
}
 
    ?>
		</tbody>
	</table>
	<div class="panelBar">
		<div class="pages">
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value},'jbsxBox')">
		
				<option value="20" <?php if($numPerPage==20){echo "selected='selected'";}?>>20</option>
				<option value="50"<?php if($numPerPage==50){echo "selected='selected'";}?>>50</option>
				<option value="100"<?php if($numPerPage==100){echo "selected='selected'";}?>>100</option>
				<option value="150"<?php if($numPerPage==150){echo "selected='selected'";}?>>150</option>
				<option value="200"<?php if($numPerPage==200){echo "selected='selected'";}?>>200</option>
				<option value="250"<?php if($numPerPage==250){echo "selected='selected'";}?>>250</option>
			</select>
			<span>条，共<?php echo $resultnum; ?>条</span>
		</div>

		<div class="pagination" targetType="navTab" totalCount="<?php echo $resultnum; ?>" numPerPage="<?php echo $numPerPage;?>" pageNumShown="10" currentPage="<?php echo $pageNum;?>"></div>

	</div>
</div>