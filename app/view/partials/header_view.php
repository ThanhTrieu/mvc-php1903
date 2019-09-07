<?php if(!defined('ROOT_PATH')) die('Can not access'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $title; ?></title>
	<link rel="stylesheet" href="public/css/bootstrap.min.css">
	<script type="text/javascript" src="public/js/jquery-3.4.1.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">Navbar</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="?c=home">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="?c=product">Product</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="?c=contact">Contact</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="?c=tag">Tags</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="?c=login">Login</a>
	      </li>
	  </div>
	</nav>
	<main style="min-height: 800px;">
		<div class="container">