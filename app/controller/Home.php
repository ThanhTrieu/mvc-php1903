<?php
namespace App\Controller;

// ngan cam truy cap bat hop phap
if(!defined('ROOT_PATH')){
	die('Can not access');
}

// nap Controller base
use App\Controller\Controller;
// nap Model
use App\Model\Home_model;

class Home extends Controller
{
	private $_db;
	public function __construct()
	{
		$this->_db = new Home_model;
	}

	public function index()
	{
		//index.php?c=home&m=index
		// xu ly du lieu
		$data = [];
		$listUser = $this->_db->getAllDataUsers();
		$data['name'] = 'Test';
		$data['info'] = $listUser;

		//load header
		$header = [];
		$header['title'] = 'Home - dashboard';
		$this->loadHeader($header);
		// nap vao 1 view tu thu muc view
		// truyen ca mang $data ra ngoai view
		$this->loadView('home/index_view', $data);
		// load footer
		$this->loadFooter();
	}
}