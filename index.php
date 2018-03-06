<?php

require_once 'config.php';



//$mysqli = new mysqli(DB_HOST ,DB_USER ,DB_PASS, DB_NAME);

//$db = mysqli_connect(DB_HOST ,DB_USER ,DB_PASS, DB_NAME);

// if (!$db) {
//     die('Ошибка подключения (' . mysqli_connect_errno() . ') '
//             . mysqli_connect_error());
// }
$classes = array_slice(scandir(PATH_CLASSES),2);
// var_dump($classes);
// exit;
foreach ($classes as $class) 
	require_once PATH_CLASSES.$class;

unset($classes, $class);


Db::connect();

// require_once 'functions.php';
require_once 'router.php';

Db::disconnect();
//$mysqli->close();
//mysqli_close($db);