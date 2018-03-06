<?php

require_once 'config.php';

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, 'prestashop');

//$email = mysqli_real_escape_string($db, $email);




// while ($row = mysqli_fetch_assoc($result)) {
// 	var_dump($row);
// 	# code...
// }

require_once 'functions.php';
require_once 'router.php';

mysqli_close($db);