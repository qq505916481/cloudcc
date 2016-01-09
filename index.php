<?php
session_start();
if(!$_SESSION['cloudcc_username'])
{
	header("Location: login.php");
	die();
}
require("mysql.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CloudCC - 主页</title>

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
		      <li class="active"><a href="index.php">主页</a></li>
		      <li><a href="task.php">CC任务</a></li>
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
  			<div class="panel-heading">系统状态</div>
  			<div class="panel-body">
    				<table class="table table-hover">
    					<tr>
    						<td>当前代理数量</td>
    						<td>
    							<?php
								$pdohandler=Get_DB_Handler();
								$sql = "SELECT COUNT(*) AS a FROM `".DB_PRE."proxy`";
								$paramshandler=$pdohandler->prepare($sql);
								$paramshandler->execute();
								$result=$paramshandler->fetchALL(PDO::FETCH_ASSOC);
								echo($result['0']['a']);
								?>
    						</td>
    					</tr>
    					<tr>
    						<td>在线代理数量</td>
    						<td>
    							<?php
								$pdohandler=Get_DB_Handler();
								$sql = "SELECT COUNT(*) AS a FROM `".DB_PRE."proxy` WHERE status = 0";
								$paramshandler=$pdohandler->prepare($sql);
								$paramshandler->execute();
								$result=$paramshandler->fetchALL(PDO::FETCH_ASSOC);
								echo($result['0']['a']);
								?>
    						</td>
    					</tr>
    					<tr>
    						<td>上次存活检测</td>
    						<td>
    							<?php
    								$lastcheck=easymysql_select('sysinfo', array('key'=>'lastcheck'));
									echo($lastcheck['value']);
								?>
    						</td>
    					</tr>
    					<tr>
    						<td>CC任务数量</td>
    						<td>
    							<?php
								$pdohandler=Get_DB_Handler();
								$sql = "SELECT COUNT(*) AS a FROM `".DB_PRE."task`";
								$paramshandler=$pdohandler->prepare($sql);
								$paramshandler->execute();
								$result1=$paramshandler->fetchALL(PDO::FETCH_ASSOC);
								$pdohandler=Get_DB_Handler();
								$sql = "SELECT COUNT(*) AS a FROM `".DB_PRE."task` WHERE `endtime` > UNIX_TIMESTAMP(NOW())";
								$paramshandler=$pdohandler->prepare($sql);
								$paramshandler->execute();
								$result2=$paramshandler->fetchALL(PDO::FETCH_ASSOC);
								echo($result2['0']['a']."/".$result1['0']['a']);
								?>
    						</td>
    					</tr>
    				</table>
  			</div>
			</div>
			
			<div class="panel panel-default">
  			<div class="panel-heading">快速操作</div>
  			<div class="panel-body">
    				<table class="table table-hover">
    					<tr>
    						<td>新建CC任务</td>
    						<td><a href="newtask.php"><button type="button" class="btn btn-primary">点击新建</button></a></td>
    					</tr>
    					<tr>
    						<td>管理CC任务</td>
    						<td><a href="task.php"><button type="button" class="btn btn-info">进入管理</button></a></td>
    					</tr>
    					<tr>
    						<td>添加代理</td>
    						<td><a href="newproxy.php"><button type="button" class="btn btn-warning">点击添加</button></a></td>
    					</tr>
    					<tr>
    						<td>检测存活</td>
    						<td>
    							<?php
    								$alivecheck=easymysql_select('sysinfo', array('key'=>'checkproxy'));
									if($alivecheck['value']=='free')
									{
										?>
    							<a href="checkproxy.php"><button type="button" class="btn btn-success">立即检测</button></a>
    							<a href="checkproxyforce.php"><button type="button" class="btn btn-danger">强制全部重测</button></a>
										<?php
									}
									else echo("正在验证...");
    							?>
    						</td>
    					</tr>
    				</table>
  			</div>
			</div>
			
			<div class="panel panel-default">
  			<div class="panel-heading">Daemon状态</div>
  			<div class="panel-body">
  			<?php
  				$ccdaemon=easymysql_select('daemon', array("daemon"=>"ccdaemon"));
				$checkdaemon=easymysql_select('daemon', array("daemon"=>"checkdaemon"));
  			?>
    				<table class="table table-hover">
    					<tr>
    						<td>验证Daemon</td>
    						<td>
    							<?php
    								if((time()-intval($checkdaemon['time']))>60)
									{
										echo('<span class="label label-warning">连接断开</span>');
									}
									else echo('<span class="label label-success">工作正常!版本'.$checkdaemon['version'].'</span>');
    							?>
    						</td>
    					</tr>
    					<tr>
    						<td>CC Daemon</td>
    						<td>
    							<?php
    								if((time()-intval($ccdaemon['time']))>60)
									{
										echo('<span class="label label-warning">连接断开</span>');
									}
									else echo('<span class="label label-success">工作正常!版本'.$ccdaemon['version'].'</span>');
    							?>
    						</td>
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