<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>欢迎回来~请登录~</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="http://bootstrap.evget.com/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <form class="form-signin" role="form" method="post" action="chklgn.php">
        <h2 class="form-signin-heading">Welcome back!</h2>
        <input name="username" type="text" class="form-control" placeholder="用户名" required autofocus>
        <input name="password" type="password" class="form-control" placeholder="密码" required>
		<?php 
			if($_GET['error']==1)
			{
				?>
		<div class="alert alert-warning">
			这账号名或密码不对呀……进不去！
		</div>
				<?php
			}
			else if($_SESSION['cloudcc_username'])
			{
				?>
		<div class="alert alert-success">
			<div id="ShowDiv">登录成功！欢迎回来！系统将会在3秒后跳转...</div>
					<script language="javascript">
			var secs = 3; //倒计时的秒数 
			var URL;
			function Load(url){
			URL = url;
			for(var i=secs;i>=0;i--) 
			{ 
			   window.setTimeout('doUpdate(' + i + ')', (secs-i) * 1000); 
			} 
			}
			function doUpdate(num) 
			{ 
			document.getElementById('ShowDiv').innerHTML = '登录成功！欢迎回来！系统将会在'+num+'秒后跳转...' ;
			if(num == 0) { window.location = URL; }
			}
			Load('index.php');
		</script>
		</div>
				<?php
			}?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">开门！</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
