<?php
//base start
require "../../hzb/config.php";
require R.'hzb/inc/load.php';
//base end
if(empty($_POST["tempid"])){
    die("<span style='color:red'>请您选择正确的模板</span>");
}
$temp=$db->select("uk_vchatmsgtemp", "*", "tempid='".$_POST["tempid"]."'")[0];


$content=explode("|",$temp["content"]);
?>
<dl>
<dt>用户：</dt>
<dd>
<input type="text" style="width:100%;"  class="required " />
</dd>
</dl>

<dl>
<dt>页面跳转：</dt>
<dd>
<input type="text" style="width:100%;"  class="required " />
</dd>
</dl>


<?php foreach ($content as $a){?>
<dl>
<dt><?php echo $a?>：</dt>
<dd>
<input type="text" style="width:100%;"  class="required " />
</dd>
</dl>

<?php }?>
