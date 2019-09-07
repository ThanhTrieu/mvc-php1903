<?php 
namespace App\Model;

// ngan cam truy cap bat hop phap
if(!defined('ROOT_PATH')){
	die('Can not access');
}
use App\Config\Database;
use \PDO;

class Login_model extends Database
{
	public function __construct()
	{
		parent::__construct();
	}

	public function checkLoginUser($user, $pass)
	{
		$data = [];
		$sql = "SELECT * FROM admins AS a WHERE a.username = :user AND a.password = :pass AND a.status = 1 LIMIT 1";
		$stmt = $this->db->prepare($sql);
		if($stmt){
			// kiem tra tham so truyen vao cau lenh sql
			$stmt->bindParam(':user', $user, PDO::PARAM_STR);
			$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
			// thuc thi cau lenh
			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		return $data;
	}
}