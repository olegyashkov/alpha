<?php

class Db {

	static $instance =false;

	static public function connect()
	{
		self::$instance = new mysqli(DB_HOST ,DB_USER ,DB_PASS, DB_NAME);
	}

	static public function disconnect()
	{
		if(self::$instance)
			self::$instance->close();
	}
}