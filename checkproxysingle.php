<?php
require("needlogin.php");
require("mysql.php");

$alivecheck=easymysql_select('sysinfo', array('key'=>'checkproxy'));
easymysql_update('proxy',array('id'=>$_GET['id']),array('checktoken'=>0,'status'=>2));
easymysql_update('sysinfo', array('key'=>'checkproxy'), array('value'=>'check'));

header("Location: proxy.php?p=".intval($_GET['p']));