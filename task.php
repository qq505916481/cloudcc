<?php
require("needlogin.php");
require("mysql.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CloudCC - 任务管理</title>

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
		<div class="panel panel-default">
		<div class="panel-heading">任务列表</div>
		<div class="panel-body">
				<table class="table table-striped">
					<tr>
						<th>#</th>
						<th>任务名称</th>
						<th>目标URL</th>
						<th>类型</th>
						<th>附加数据</th>
						<th>代理数量</th>
						<th>持续时间</th>
						<th>完成度</th>
						<th>操作</th>
					</tr>
					<?php
						$result=easymysql_select_adv('task', array());
						$i=0;
						while($i<count($result))
						{
						if($result[$i]['waitdelete']==0)
						{
					?>
					<tr>
						<td><?php echo($result[$i]['id']);?></td>
						<td><?php echo(htmlspecialchars($result[$i]['name']));?></td>
						<td><?php echo(htmlspecialchars($result[$i]['url']));?></td>
						<td><?php echo(htmlspecialchars($result[$i]['method']));?></td>
						<td><?php if($result[$i]['data']&&$result[$i]['cookie'])echo("Data&Cookie");else if($result[$i]['data'])echo("Data");else if($result[$i]['cookie'])echo("Cookie");else echo("无");?></td>
						<td><?php echo($result[$i]['proxy']);?></td>
						<td><?php echo($result[$i]['time']);?></td>
						<td>
							<div class="progress progress-striped active">
							  <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo(intval((floatval(time()-intval($result[$i]['addtime']))/floatval(intval($result[$i]['endtime'])-intval($result[$i]['addtime'])))*100)>100?100:intval((floatval(time()-intval($result[$i]['addtime']))/floatval(intval($result[$i]['endtime'])-intval($result[$i]['addtime'])))*100));?>%">
							    <span class="sr-only"><?php echo(intval((floatval(time()-intval($result[$i]['addtime']))/floatval(intval($result[$i]['endtime'])-intval($result[$i]['addtime'])))*100)>100?100:intval((floatval(time()-intval($result[$i]['addtime']))/floatval(intval($result[$i]['endtime'])-intval($result[$i]['addtime'])))*100));?></span>
							  </div>
							</div>
						</td>
						<td><button type="button" class="btn btn-danger btn-xs" onclick="deletethis(<?php echo($result[$i]['id']);?>);">删除</button></td>
					</tr>
					<?php
						}
						$i++;
						}
					 ?>
				</table>
		</div>
		</div>
			
		<div class="panel panel-default">
		<div class="panel-heading">操作</div>
		<div class="panel-body">
			<script>
				function deleteall(evt)
				{
					if(confirm("你确定要删除所有已经结束的任务吗？\n一旦删除不可撤销！"))
					{
						window.location="taskdelfinished.php";
					}
				}
				function deletethis(id)
				{
					if(confirm("你确定要删除所选的任务么？\n一旦删除不可撤销！"))
					{
						window.location="taskdelete.php?id="+id;
					}
				}
			</script>
    				<table class="table table-hover">
    					<tr>
    						<td>新建任务</td>
    						<td><a href="newtask.php"><button type="button" class="btn btn-warning btn-sm">点击新建</button></a></td>
    					</tr>
    					<tr>
    						<td>自动清理</td>
    						<td><a onclick="deleteall();" href="#"><button type="button" class="btn btn-danger btn-sm">删除已结束的任务</button></a></td>
    					</tr>
    				</table>
		</div>
		</div>
			
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>