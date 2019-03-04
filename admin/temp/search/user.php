<input type="hidden" name="user.id" value="<?php
					echo  isset($_POST["user_id"])?$_POST["user_id"]:'';?>"/>
				<input type="text" class="getdata textInput" suggestUrl="data/select.php?type=user"  name="user.user" value="<?php
					echo  isset($_POST["user_user"])?$_POST["user_user"]:'';?>" suggestFields="user"  lookupGroup="user" />
				<a class="btnLook default" href="data/takeback/user.php" style="display:inline-block;float:none;vertical-align:top;" lookupGroup="user">选择用户</a>