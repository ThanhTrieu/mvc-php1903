<?php
namespace App\Controller;

// ngan cam truy cap bat hop phap
if(!defined('ROOT_PATH')){
	die('Can not access');
}

class Controller
{
	protected function loadHeader($header = [] )
	{
		$title = $header['title'] ?? '';
		$meta  = $header['meta'] ?? '';
		$content = $header['content'] ?? '';

		require_once 'app/view/partials/header_view.php';
	}

	protected function loadFooter()
	{
		require_once 'app/view/partials/footer_view.php';
	}

	protected function loadView($path, $data = [])
	{
		// bien key cua mang thanh 1 bien o ben ngoai view
		extract($data);
		$path = "app/view/".$path.".php";
		require_once $path;

		// $path : duong vien cua file view
		// $data: du lieu do ra ngoai file view
	}

	public function __call($req, $res)
	{
		header("Location:upgrade.php");
	}
}