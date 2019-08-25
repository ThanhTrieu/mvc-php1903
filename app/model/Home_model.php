<?php 
namespace App\Model;

// ngan cam truy cap bat hop phap
if(!defined('ROOT_PATH')){
	die('Can not access');
}

class Home_model
{
	public function getAllDataUsers()
	{
		$data = [
			[
				'id' => 1,
				'name' => 'Nguyen Van A',
				'gender' => 1,
				'age' => 20,
				'address' => 'Ha Noi',
				'email' => 'test@gmail.com',
				'money' => 200000
			],
			[
				'id' => 2,
				'name' => 'Nguyen Thi B',
				'gender' => 0,
				'age' => 18,
				'address' => 'Ha Noi',
				'email' => 'demo@gmail.com',
				'money' => 300000
			],
			[
				'id' => 3,
				'name' => 'Nguyen Van C',
				'gender' => 1,
				'age' => 22,
				'address' => 'Hai Duong',
				'email' => 'demo12@gmail.com',
				'money' => 100000
			]
		];

		return $data;
	}
}