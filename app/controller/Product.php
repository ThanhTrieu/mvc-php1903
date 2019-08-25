<?php
namespace App\Controller;

// ngan cam truy cap bat hop phap
if(!defined('ROOT_PATH')){
	die('Can not access');
}

// nap Controller base
use App\Controller\Controller;

class Product extends Controller
{
	public function index()
	{

		//load header
		$header = [];
		$header['title'] = 'This is product';
		$this->loadHeader($header);
		// nap vao 1 view tu thu muc view
		$this->loadView('product/index_view');
		// load footer
		$this->loadFooter();
	}
}