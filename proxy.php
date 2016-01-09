<?php
require("needlogin.php");
require("mysql.php");
require("page.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CloudCC - 代理管理</title>

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
		<div class="panel-heading">代理列表</div>
		<div class="panel-body">
			<script>
				function deleteall(evt)
				{
					if(confirm("你确定要删除所有已经失效的代理吗？\n一旦删除不可撤销！"))
					{
						window.location="proxydeletedead.php";
					}
				}
				function deletethis(id)
				{
					if(confirm("你确定要删除所选的代理么？\n一旦删除不可撤销！"))
					{
						window.location="proxydelete.php?id="+id;
					}
				}
			</script>
				<table class="table table-striped">
					<tr>
						<th>#</th>
						<th>代理IP</th>
						<th>端口号</th>
						<th>存活</th>
						<th>最后检测</th>
						<th>任务</th>
						<th>操作</th>

					</tr>
					<?php
					$i=0;
					$_GET['p']=intval($_GET['p']);
					if($_GET['p']<=0)$_GET['p']=1;
					$pdohandler=Get_DB_Handler();
					$sql = "SELECT * FROM `".DB_PRE."proxy` LIMIT ".(10*($_GET['p']-1)).",10";
					$paramshandler=$pdohandler->prepare($sql);
					$paramshandler->execute();
					$result=$paramshandler->fetchALL(PDO::FETCH_ASSOC);
					$sql = "SELECT COUNT(*) AS a FROM `".DB_PRE."proxy`";
					$paramshandler=$pdohandler->prepare($sql);
					$paramshandler->execute();
					$result2=$paramshandler->fetchALL(PDO::FETCH_ASSOC);
					while($i<count($result))
					{
						?>
					<tr>
						<td><?php echo($result[$i]['id']);?></td>
						<td><?php echo(htmlspecialchars($result[$i]['ip']));?></td>
						<td><?php echo($result[$i]['port']);?></td>
						<td>
							<?php
								switch($result[$i]['status'])
								{
									case 0:
										echo('<span class="label label-success">Alive!</span>');
										break;
									case 1:
										echo('<span class="label label-danger">Dead..</span>');
										break;
									case 2:
										echo('<span class="label label-primary">Checking...</span>');
										break;
									default:
										echo('<span class="label label-warning">Unknow</span>');
										break;
								}
							?>
						</td>
						<td><?php echo(htmlspecialchars($result[$i]['checked']));?></td>
						<td>
							<?php
								if($result[$i]['taskid']!=0)
								{
									echo("#".$result[$i]['taskid'].":".$result[$i]['taskname']);
								}
								else echo("空闲");
							?>
						</td>
						<td>
							<button type="button" class="btn btn-danger btn-xs" onclick="deletethis(<?php echo($result[$i]['id']);?>);">删除</button>
							<a href="checkproxysingle.php?id=<?php echo($result[$i]['id']);?>&p=<?php echo($_GET['p']);?>"><button type="button" class="btn btn-primary btn-xs">重新验证</button></a>
						</td>
					</tr>
						<?php
						$i++;
					}
					?>
				</table>
		</div>
		</div>
			
		<div class="panel panel-default">
		<div class="panel-heading">操作</div>
		<div class="panel-body">
    				<table class="table table-hover">
    					<tr>
    						<td>添加代理</td>
    						<td><a href="newproxy.php"><button type="button" class="btn btn-warning btn-sm">点击添加</button></a></td>
    					</tr>
    					<tr>
    						<td>自动清理</td>
    						<td><a href="#" onclick="deleteall();"><button type="button" class="btn btn-danger btn-sm">删除已失效的代理</button></a></td>
    					</tr>
    				</table>
		</div>
		</div>
		<ul class="pagination">
		<?php
			$param = array('totalRows'=>$result2[0]['a'],'pageSize'=>'10','currentPage'=>@$_GET['p'],'baseUrl'=>'proxy.php','className'=>'active');
			$page = new Page($param);
			echo($page->pagination());
		?>
		</ul>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>