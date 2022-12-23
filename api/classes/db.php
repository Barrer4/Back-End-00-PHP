<?php
define('ROOT_URL', 'http://localhost/peliculas/');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'moviesdb');
define('APP_NAME', 'Net+ Prime');

$db = new PDO('mysql:host=127.0.0.1;dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

//db Attributes
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

