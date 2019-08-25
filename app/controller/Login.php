<?php
namespace App\Controller;

// ngan cam truy cap bat hop phap
if(!defined('ROOT_PATH')){
	die('Can not access');
}

// nap Controller base
use App\Controller\Controller;
use App\Model\Login_model;

class Login extends Controller
{
	private $_loginModel;

	public function index()
	{

		//load header
		$header = [];
		$header['title'] = 'Login user';
		$this->loadHeader($header);
		// nap vao 1 view tu thu muc view
		$this->loadView('login/index_view');
		// load footer
		$this->loadFooter();
	}

	public function handle()
	{
		if(isset($_POST['btnLogin'])){
			$user = $_POST['user'] ?? '';
			$user = strip_tags($user);

			$pass = $_POST['pass'] ?? '';
			$pass = strip_tags($pass);

			if($user && $pass){
				$this->_loginModel = new Login_model;
				$chkLogin = $this->_loginModel->checkLoginUser($user, $pass);
				if($chkLogin){
					header("Location:?c=home");
				} else {
					header("Location:?c=login&state=err");
				}
			} else {
				header("Location:?c=login&state=fail");
			}

		}
	}
}