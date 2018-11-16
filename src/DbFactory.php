<?php
namespace eBaocd\DataBase;

class DbFactory
{
    protected static $db = null;
	protected static $dbCfg = null;
	public static function Create($configname = 'db')
	{
		//避免重复创建连接
		global $APP_G;
		if($APP_G[$configname]['dbtype'] == 'mssql')
		{
			$sqltype = '\\eBaocd\\DataBase\\Pdo\\Mssql';
		}else{
			$sqltype = '\\eBaocd\\DataBase\\Pdo\\Mysql';
		}

		if (null === self::$dbCfg){self::$dbCfg = $configname;}
		//if (null === self::$db) {self::$db = new Pdo_Mysql($G_X[self::$dbCfg]);}
		if ($configname !== self::$dbCfg){
			self::$dbCfg = $configname;
			self::$db = new $sqltype($APP_G[self::$dbCfg]);
		}elseif(null === self::$db) {
			self::$db = new $sqltype($APP_G[self::$dbCfg]);
		}
		return self::$db;
	}
}
?>