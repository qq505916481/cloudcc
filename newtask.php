<?php
require("needlogin.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CloudCC - 添加新任务</title>

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
		      <li class="active"><a href="task.php">CC任务</a></li>
		      <li><a href="proxy.php">代理信息</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="logout.php">退出</a></li>
		    </ul>
		  </div><!-- /.navbar-collapse -->
	  </div>
	</nav>
  <body style="background-color: #eee; padding-top: 70px;">

    <div class="container">
    <form method="post" action="taskadd.php">
		<div class="panel panel-default">
		<div class="panel-heading">添加一个新任务</div>
		<div class="panel-body">
			<?php if($_GET['msg'])
			{
				?>
			<div class="alert alert-warning">
				填写错误：<?php echo(htmlspecialchars($_GET['msg']));?>
			</div>
				<?php
			}?>
				<table class="table table-striped">
					<tr>
						<td style="width: 20%;">任务名称</td>
						<td style="width: 80%;">
								<input type="text" class="form-control" placeholder="任务名称..." name="taskname">
						</td>
					</tr>
					<tr>
						<td style="width: 20%;">任务URL</td>
						<td style="width: 80%;">
								<input type="text" class="form-control" placeholder="http://www.xxx.com" name="taskurl">
						</td>
					</tr>
					<tr>
						<td style="width: 20%;">请求方式</td>
						<td style="width: 80%;">
							  <input type="radio" name="method" value="GET"> GET方式  <input type="radio" name="method" value="POST"> POST方式
						</td>
					</tr>
					<tr>
						<td style="width: 20%;">POST附加数据</td>
						<td style="width: 80%;">
							<div class="form-group">
						    <textarea name="postdata" class="form-control" rows="4" placeholder="POST时的参数，形如a=123123&b=123123，需要手动进行url编码，否则会Bad request。GET方式请直接写在url内。使用GET时，此处无效。"></textarea>
						  </div>
						</td>
					</tr>
					<tr>
						<td style="width: 20%;">Cookies</td>
						<td style="width: 80%;">
							<div class="form-group">
						    <textarea name="cookies" class="form-control" rows="4" placeholder="如果需要附加Cookies请在这里填写，形如a=123123; b=123123;，需要手动进行url编码，否则会Bad request。"></textarea>
						  </div>
						</td>
					</tr>
					<tr>
						<td style="width: 20%;">代理数量</td>
						<td style="width: 80%;"><input type="text" class="form-control" placeholder="代理数量..填写一个整数" name="proxynum"></td>
					</tr>
					<tr>
						<td style="width: 20%;">时间长度</td>
						<td style="width: 80%;">
							<input type="text" style="width: 10%; display: inline;" class="form-control" placeholder="小时" name="hour">小时，
							<input type="text" style="width: 10%; display: inline;" class="form-control" placeholder="分钟" name="minunte">分钟，
							<input type="text" style="width: 10%; display: inline;" class="form-control" placeholder="秒" name="second">秒
						</td>
					</tr>
				</table>
		</div>
		</div>
			
		<div class="panel panel-default">
		<div class="panel-heading">一切准备就绪了……</div>
		<div class="panel-body">
			<table class="table table-hover">
				<tr>
					<td>确认新建</td>
					<td><input type="submit" class="btn btn-success btn" value="新建并开始打击"></td>
				</tr>
				<tr>
					<td>取消操作</td>
					<td><a href="task.php"><button type="button" class="btn btn-default btn">返回</button></a></td>
				</tr>
			</table>
		</div>
		</div>
		</form>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>