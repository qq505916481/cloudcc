<?php

//2.数据库配置
//这里设置了数据库的一些信息，根据需要修改

//2.2 数据库服务器
define("DB_HOST","127.0.0.1");

//2.3 数据库用户名
define("DB_USERNAME","root");

//2.4 数据库密码
define("DB_PASSWD","");

//2.5 数据库名称
define("DB_NAME","cloudcc");

//2.6 数据库前缀
define("DB_PRE","pre_");

//2.7 数据库编码
define("DB_CHARSET","utf8");

//2.8 长连接设置
//true为长链接，false为短连接
define("DB_ATTR_PERSISTENT",true);



//开始创建PDO对象
$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
$dboptions = array(
	PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '.DB_CHARSET,
	PDO::ATTR_PERSISTENT => DB_ATTR_PERSISTENT,
);
try
{ 
	$dbh = new PDO($dsn,DB_USERNAME,DB_PASSWD,$dboptions);
//	$dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
}
catch (PDOException $e) 
{ 
	if(SYS_DEBUG)die("ERROR: Database exception - ".$e->getMessage());
} 

//获取PDO的Handler函数
function Get_DB_Handler()
{
	global $dbh;
	return $dbh;
}

//集成easymysql

//mysql的select
function easymysql_select($table,$column)
{
	$pdohandler=Get_DB_Handler();
	//处理sql
	$sql = "SELECT * FROM `".DB_PRE.$table."`";
	if(count($column)>0)
	{
		$sql .= " WHERE";
		$i=0;
		foreach($column as $key=>$val)
		{
			if($i!=0)$sql .= " AND";
			$sql .= " `".$key."` = :".$key;
			$i++;
		}
	}
	$sql .= ";";
	$paramshandler=$pdohandler->prepare($sql);
	if(count($column)>0)
	{
		foreach($column as $key=>$val)
		{
			$paramshandler->bindValue(":".$key,$val);
		}
	}
	$paramshandler->execute();
	$result=$paramshandler->fetchALL(PDO::FETCH_ASSOC);
	return $result[0];
}

//mysql的delete
function easymysql_delete($table,$column)
{
	$pdohandler=Get_DB_Handler();
	//处理sql
	$sql = "DELETE FROM `".DB_PRE.$table."`";
	if(count($column)>0)
	{
		$sql .= " WHERE";
		$i=0;
		foreach($column as $key=>$val)
		{
			if($i!=0)$sql .= " AND";
			$sql .= " `".$key."` = :".$key;
			$i++;
		}
	}
	$sql .= ";";
	$paramshandler=$pdohandler->prepare($sql);
	if(count($column)>0)
	{
		foreach($column as $key=>$val)
		{
			$paramshandler->bindValue(":".$key,$val);
		}
	}
	$paramshandler->execute();
}

//mysql的insert
function easymysql_insert($table,$column)
{
	$pdohandler=Get_DB_Handler();
	//处理sql
	$sql = "INSERT INTO `".DB_PRE.$table."` (";
	$i=0;
	foreach($column as $key=>$val)
	{
		$i++;
		$sql .= "`".$key."`";
		if($i<count($column))$sql .=",";
	}
	$sql .= ") VALUES (";
	$i=0;
	foreach($column as $key=>$val)
	{
		$i++;
		$sql .= ":".$key;
		if($i<count($column))$sql .=",";
	}
	$sql .= ");";
	$paramshandler=$pdohandler->prepare($sql);
	foreach($column as $key=>$val)
	{
		$paramshandler->bindValue(":".$key,$val);
	}
	$paramshandler->execute();
}

//mysql的update
function easymysql_update($table,$column,$new_column)
{
	$pdohandler=Get_DB_Handler();
	//处理sql
	$sql = "UPDATE `".DB_PRE.$table."` SET ";
	$i=0;
	foreach($new_column as $key=>$val)
	{
		$i++;
		$sql .= "`".$key."` = :new_".$key;
		if($i<count($new_column))$sql .=",";
	}
	if(count($column)>0)
	{
		$sql .= " WHERE";
		$i=0;
		foreach($column as $key=>$val)
		{
			if($i!=0)$sql .= " AND";
			$sql .= " `".$key."` = :".$key;
			$i++;
		}
	}
	$sql .= ";";
	$paramshandler=$pdohandler->prepare($sql);
	if(count($column)>0)
	{
		foreach($column as $key=>$val)
		{
			$paramshandler->bindValue(":".$key,$val);
		}
	}
	foreach($new_column as $key=>$val)
	{
		$paramshandler->bindValue(":new_".$key,$val);
	}
	$paramshandler->execute();
}

//mysql的select 返回多数组
function easymysql_select_adv($table,$column)
{
	$pdohandler=Get_DB_Handler();
	//处理sql
	$sql = "SELECT * FROM `".DB_PRE.$table."`";
	if(count($column)>0)
	{
		$sql .= " WHERE";
		$i=0;
		foreach($column as $key=>$val)
		{
			if($i!=0)$sql .= " AND";
			$sql .= " `".$key."` = :".$key;
			$i++;
		}
	}
	$sql .= ";";
	$paramshandler=$pdohandler->prepare($sql);
	if(count($column)>0)
	{
		foreach($column as $key=>$val)
		{
			$paramshandler->bindValue(":".$key,$val);
		}
	}
	$paramshandler->execute();
	$result=$paramshandler->fetchALL(PDO::FETCH_ASSOC);
	return $result;
}
