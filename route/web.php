<?php
// ngan cam truy cap bat hop phap
if(!defined('ROOT_PATH')){
	die('Can not access');
}


require 'public/bootstrap/Bootstrap.php';
new Bootstrap\Bootstrap;

// tiep nhan cac request nguoi dung gui len
// index.php?c=home&m=index
// index.php/home/index
// c : ten controller
// m: ten method tuong ung cua controller day
$c = ucfirst($_GET['c'] ?? 'home');
$m = $_GET['m'] ?? 'index';

$nameController = "App\Controller\\" . $c;
$checkNameController = str_replace('\\', '/', trim($nameController, '\\')) . '.php';
if(file_exists($checkNameController)){
	// khoi tao doi tuong cho controler
	$controller = new $nameController;
	// tu dong goi cac phuong thuc nam trong controller
	$controller->$m();
} else {
	header("Location:upgrade.php");
}



