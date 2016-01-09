<?php
require("needlogin.php");
require("mysql.php");

if(!$_POST['taskname'])
{
	header("Location: newtask.php?msg=必须填写任务名称");
	die();
}

if(!$_POST['taskurl'])
{
	header("Location: newtask.php?msg=必须填写任务URL");
	die();
}

if(!stristr($_POST['taskurl'],"http://"))
{
	$_POST['taskurl']="http://".$_POST['taskurl'];
}

if($_POST['method']!="POST" && $_POST['method']!="GET")
{
	header("Location: newtask.php?msg=请求方式必须为GET或POST");
	die();
}

if(intval($_POST['proxynum'])<=0)
{
	header("Location: newtask.php?msg=代理数量必须是大于0的一个整数");
	die();
}

$times=intval($_POST['hour'])*3600+intval($_POST['minunte'])*60+intval($_POST['second']);

if($times<=0)
{
	header("Location: newtask.php?msg=任务时间要大于等于1秒");
	die();
}

easymysql_insert("task", array(
		"name"=>$_POST['taskname'],
		"url"=>$_POST['taskurl'],
		"method"=>$_POST['method'],
		"data"=>$_POST['postdata'],
		"proxy"=>intval($_POST['proxynum']),
		"time"=>intval($_POST['hour'])."小时".intval($_POST['minunte'])."分钟".intval($_POST['second'])."秒",
		"addtime"=>time(),
		"cookie"=>$_POST['cookies'],
		"endtime"=>time()+$times
	));

header("Location: task.php");