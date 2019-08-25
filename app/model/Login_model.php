<?php 
namespace App\Model;

// ngan cam truy cap bat hop phap
if(!defined('ROOT_PATH')){
	die('Can not access');
}

class Login_model
{
	public function checkLoginUser($user ,$pass)
	{
		if($user === 'admin' && $pass === '123'){
			return true;
		}
		return false;
	}
}