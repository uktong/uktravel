<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title></title>
    <script src="js/mui.min.js"></script>
    <link href="css/mui.min.css" rel="stylesheet"/>
	<script src="js/jquery-1.8.1.min.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">
      	mui.init();
    </script>
</head>
<body>
	<header class="mui-bar mui-bar-nav">
		<h1 class="mui-title">标题</h1>
	</header>
	
	<div class="mui-content">
		
	</div>
	<nav class="mui-bar mui-bar-tab">
		<a class="mui-tab-item mui-active">
			<span class="mui-icon mui-icon-home"></span>
			<span class="mui-tab-label">首页</span>
		</a>
		<a class="mui-tab-item">
			<span class="mui-icon mui-icon-phone"></span>
			<span class="mui-tab-label">电话</span>
		</a>
		<a class="mui-tab-item">
			<span class="mui-icon mui-icon-email"></span>
			<span class="mui-tab-label">邮件</span>
		</a>
		<a class="mui-tab-item">
			<span class="mui-icon mui-icon-gear"></span>
			<span class="mui-tab-label">设置</span>
		</a>
	</nav>
	<script type="text/javascript">
		//启用双击监听
		var geturl=window.location.search.substr(1);
		mui.init({
			gestureConfig:{
				doubletap:true
			},
			subpages:[{
				url:'contentlist.php?'+geturl,
				id:'contentlist.php',
				styles:{
					top: '45px',
					bottom: '0px',
				}
			}]
		});
	
		var contentWebview = null;
		document.querySelector('header').addEventListener('doubletap',function () {
			if(contentWebview==null){
				contentWebview = plus.webview.currentWebview().children()[0];
			}
			contentWebview.evalJS("mui('#pullrefresh').pullRefresh().scrollTo(0,0,100)");
		});
	</script>
</body>
</html>