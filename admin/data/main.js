$(function(){
	$(".getdata").bind('input propertychange', function() {
		$(this).attr("suggestUrl","data/select.php?name="+$(this).val()+"&type="+$(this).attr("data-type"));
		if($(this).val()==""){
			$(this).prev("input").val("");
		}
	});
	$(".default").click(function() {
		$(this).attr("href","data/takeback/"+$(this).attr("lookupGroup")+".php");
	});
	
	

});
