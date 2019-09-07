<?php 
namespace App\Model;

// ngan cam truy cap bat hop phap
if(!defined('ROOT_PATH')){
	die('Can not access');
}

// model se ke thua class dabatase de ket noi toi mysql
use App\Config\Database;
use \PDO;

class Home_model extends Database
{
	public function __construct()
	{
		// trieu goi dc bien ket noi ($db) tu class database
		parent::__construct();
	}

	public function getAllDataUsers()
	{
		$data = [];
		// su dung thu vien PDO de query va execute data tu mysql
		$sql = "SELECT * FROM admins";
		// di kiem tra tinh hop le - xem co loi gi tu tring mysql ko?
		$stmt = $this->db->prepare($sql);
		if($stmt){
			// thuc thi cau lenh sql
			if($stmt->execute()){
				// kiem tra xem co du lieu tra ve ko?
				if($stmt->rowCount() > 0){
					// lay du lieu ve
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
					// $stmt->fetchAll(PDO::FETCH_ASSOC);
					// tra ve mang da chieu ma key cua mang chinh la cac truong nam trong db
				}
			}
			// neu con lenh sql nua thi se tiep tuc thuc thi
			$stmt->closeCursor();
		}
		return $data;
	}
}