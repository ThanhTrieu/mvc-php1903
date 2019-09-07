<?php 
session_start();

if(file_exists('route/web.php')){
	define('ROOT_PATH', 'index.php');
	require_once 'app/helper/common_helper.php';
	require_once 'route/web.php';
} else {
	echo "Website dang duoc nang cap";
}