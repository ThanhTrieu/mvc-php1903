<?php

require 'public/bootstrap/Bootstrap.php';
new Bootstrap\Bootstrap;

// tiep nhan cac request nguoi dung gui len
// index.php?c=home&m=index
// index.php/home/index
// c : ten controller
// m: ten method tuong ung cua controller day
$c = $_GET['c'] ?? 'Home';
$m = $_GET['m'] ?? 'index';

$nameController = "App\Controller\\" . $c;
// khoi tao doi tuong cho controler
$controller = new $nameController;
// tu dong goi cac phuong thuc nam trong controller
$controller->$m();

