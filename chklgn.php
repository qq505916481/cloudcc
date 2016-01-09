<?php
session_start();
if($_SESSION['cloudcc_username'])
{
	header("Location: index.php");
	die();
}

require("mysql.php");

$result=easymysql_select('users',array('username'=>$_POST['username'],'password'=>md5(md5($_POST['password']).'s4661a2!l83t%@!1)1!!')));
if(!$result['username'])header("Location: login.php?error=1");
else
{
	$_SESSION['cloudcc_username']=$result['username'];
	header("Location: login.php");
}