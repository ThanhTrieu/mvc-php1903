<?php 
if(file_exists('route/web.php')){
	require_once 'route/web.php';
} else {
	echo "Website dang duoc nang cap";
}