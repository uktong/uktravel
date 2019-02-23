
<input type="hidden" name="hotel.id" value="<?php
echo  isset($_POST["hotel_id"])?$_POST["hotel_id"]:'';?>"/>
<input type="text" class="getdata textInput" data-type="hotel" name="hotel.hotel" value="<?php
echo  isset($_POST["hotel_hotel"])?$_POST["hotel_hotel"]:'';?>" suggestFields="hotel"   lookupGroup="hotel" />
<a class="btnLook default" style="display:inline-block;float:none;vertical-align:top;"  lookupGroup="hotel">选择组团社</a>