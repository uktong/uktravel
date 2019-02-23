 <div class="pageContent">

<?php 
require "../../hzb/config.php";
require R.'hzb/inc/load.php';

$getmsg=$db->select("uk_admin","*","unicode=".$_GET["unicode"])[0];
?>
 <form  onsubmit="return validateCallback(this,dialogAjaxDone);" class="pageForm" action="xtgl/dbaction.php?action=edit&unicode=<?php echo $_GET["unicode"]; ?>" method="post"  enctype="multipart/form-data">
              <table cellpadding="0" border="0" cellspacing="0" class="edittable">
            <tbody>
                <tr>
                 <td align="right" class="editcellmessage" style="width:15%;">用户帐号：</td>
                   <td align="left" class="editcell" style="width:30%;"><input name="username" 
                     type="text"  value="<?php echo $getmsg["username"];?>" /></td>
                     <td align="left" class="editcellverify" style="width:5%;"><div class="l-verify-star"></div></td>
                    <td align="right"  class="editcellmessage" style="width:15%;">登录密码：</td>
                     <td align="left"  class="editcell" style="width:30%;">
                         <input name="password" type="text" 
                          value="<?php echo $getmsg["password"];?>" />
                      
                    </td>
                    <td align="left"  class="editcellverify" style="width:5%;"></td>
                </tr>
                <tr>
                 <td align="right" class="editcellmessage" style="width:15%;">用户姓名：</td>
                   <td align="left" class="editcell" style="width:30%;">
                   <input name="realname" class="required "  type="text"  value="<?php echo $getmsg["realname"];?>" /></td>
                     <td align="left" class="editcellverify" style="width:5%;"></td>
                    <td align="right"  class="editcellmessage" style="width:15%;">是否启用：</td>
                     <td align="left"  class="editcell" style="width:30%;">

                    开启<input type="radio" name="state" <?php echo $getmsg["state"]=="1"?"checked='checked'":"";?> value="1"> 关闭 <input type="radio" <?php echo $getmsg["state"]=="0"?"checked='checked'":"";?> name="state" value="0">
                     </td>
                    <td align="left"  class="editcellverify" style="width:5%;"></td>

                </tr>
                
                </tbody>
         </table>
               



         

<div class="formBar" >
			<ul>
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
			</ul>
		</div>
 
  </form></div>