<?php
require("needlogin.php");
require("mysql.php");

$alivecheck=easymysql_select('sysinfo', array('key'=>'checkproxy'));
if($alivecheck['value']=='free')
{
	easymysql_update('sysinfo', array('key'=>'checkproxy'), array('value'=>'check'));
}

header("Location: index.php");