<input type="hidden" name="wl.id" value="<?php
					echo  isset($_POST["wl_id"])?$_POST["wl_id"]:'';?>"/>
				<input type="text" class="getdata textInput" data-type="wl" name="wl.jd" value="<?php
					echo  isset($_POST["wl_wl"])?$_POST["wl_wl"]:'';?>" suggestFields="wl"  lookupGroup="wl" />
				<a class="btnLook default"style="display:inline-block;float:none;vertical-align:top;" lookupGroup="wl">选择用户</a>