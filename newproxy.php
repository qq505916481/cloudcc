<?php
require("needlogin.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CloudCC - 添加代理</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="http://bootstrap.evget.com/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <div class="container">
		  <div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		      <span class="sr-only">切换导航栏</span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand" href="index.php">CloudCC</a>
		  </div>
		
		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		    <ul class="nav navbar-nav">
		      <li><a href="index.php">主页</a></li>
		      <li><a href="task.php">CC任务</a></li>
		      <li class="active"><a href="proxy.php">代理信息</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="logout.php">退出</a></li>
		    </ul>
		  </div><!-- /.navbar-collapse -->
	  </div>
	</nav>
  <body style="background-color: #eee; padding-top: 70px;">

    <div class="container">
		<div class="panel panel-default">
		<div class="panel-heading">添加代理</div>
		<div class="panel-body">
			<form method="post" action="proxyadd.php">
			<table class="table table-striped">
				<tr>
					<td style="width: 20%;">批量添加</td>
					<td style="width: 80%;">
						<div class="form-group">
					    <textarea name="proxy" class="form-control" rows="24" placeholder="一行一个代理，格式：“IP地址:端口号”，如“127.0.0.1:3128”。只支持HTTP代理。"></textarea>
					  </div>
					</td>
				</tr>
			</table>
		</div>
		</div>
			
		<div class="panel panel-default">
		<div class="panel-heading">操作</div>
		<div class="panel-body">
			<table class="table table-hover">
				<tr>
					<td>确认添加</td>
					<td><input type="submit" class="btn btn-success btn" value="添加进系统"></td>
				</tr>
				<tr>
					<td>取消操作</td>
					<td><a href="proxy.php"><button type="button" class="btn btn-default btn">返回</button></a></td>
				</tr>
			</table>
    	</form>
		</div>
		</div>
			
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>