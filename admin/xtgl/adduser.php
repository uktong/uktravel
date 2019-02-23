 <div class="pageContent">
<!-- db/gsxx.php?type=ajax&action=charu -->
<?php 
require "../../hzb/config.php";
require R.'hzb/inc/load.php';

?>
 <form  onsubmit="return validateCallback(this,dialogAjaxDone);" class="pageForm" action="xtgl/dbaction.php?action=add" method="post"  enctype="multipart/form-data">
                <table cellpadding="0" border="0" cellspacing="0" class="edittable">
            <tbody>
                <tr>
                 <td align="right" class="editcellmessage" style="width:15%;">用户帐号：</td>
                   <td align="left" class="editcell" style="width:30%;"><input name="username"  id="txtUserAccount" type="text" ltype="text" ligerui="{width:180}" validate="{remote:'/YTDF/user/validateAccout/SysMng.UserList/?userid=0',messages:{remote:'用户帐号已经存在!'}}" /></td>
                     <td align="left" class="editcellverify" style="width:5%;"><div class="l-verify-star"></div></td>
                    <td align="right"  class="editcellmessage" style="width:15%;">登录密码：</td>
                     <td align="left"  class="editcell" style="width:30%;">
                         <input name="password" type="password" id="txtUserPwd" ltype="text" ligerui="{width:160}" validate="{required:true}" />
                         
                    </td>
                    <td align="left"  class="editcellverify" style="width:5%;"></td>
                </tr>
                <tr>
                 <td align="right" class="editcellmessage" style="width:15%;">用户姓名：</td>
                   <td align="left" class="editcell" style="width:30%;"><input name="realname" class="required "   id="txtUserName" type="text" ltype="text" ligerui="{width:180}" validate="{required:true}" /></td>
                     <td align="left" class="editcellverify" style="width:5%;"></td>
                    <td align="right"  class="editcellmessage" style="width:15%;">是否启用：</td>
                     <td align="left"  class="editcell" style="width:30%;">
                    开启<input type="radio" name="state" checked value="1"> 关闭 <input type="radio" name="state" value="0">
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