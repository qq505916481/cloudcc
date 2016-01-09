<?php
require("needlogin.php");
require("mysql.php");

$inputstr=$_POST['proxy'];

$success=0;
$fail=0;
$readded=0;

$inputstr=str_replace("\r", "", $inputstr);

$strarr=explode("\n", $inputstr);

$i=0;

while($i<count($strarr))
{
	$res=explode(":",$strarr[$i]);
	if(strval(intval($res[1]))!=$res[1])
	{
		$fail++;
	}
	else if($res[0].":".intval($res[1])!=$strarr[$i])
	{
		$fail++;
	}
	else if(intval($res[1])>65535 || intval($res[1])<1)
	{
		$fail++;
	}
	else
	{
		$checkresult=easymysql_select('proxy',array("ip"=>$res[0]));
		if($checkresult["ip"]==$res[0])
		{
			$readded++;
		}
		else
		{
			easymysql_insert('proxy', array(
				"ip"=>$res[0],
				"port"=>$res[1],
				"status"=>3,
				"checked"=>"None",
				"taskid"=>0
			));
			$success++;
		}
	}
	$i++;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>代理添加完成!</title>

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
		<div class="alert alert-info">
      <h1>Process Finished!</h1>
	  <h3>代理添加处理完毕！添加了<?php echo(count($strarr)); ?>个代理，其中成功<?php echo($success);?>个，失败<?php echo($fail);?>个，重复<?php echo($readded);?>个.</h3>
	  <small id="ShowDiv">Powered by Angelic47. 系统将在3秒后将会转向代理界面</small>
	  </div>
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
			document.getElementById('ShowDiv').innerHTML = 'Powered by Angelic47. 系统将在'+num+'秒后将会转向代理界面' ;
			if(num == 0) { window.location = URL; }
			}
			Load('proxy.php');
		</script>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>