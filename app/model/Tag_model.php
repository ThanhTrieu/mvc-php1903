<?php 
namespace App\Model;

// ngan cam truy cap bat hop phap
if(!defined('ROOT_PATH')){
	die('Can not access');
}

// model se ke thua class dabatase de ket noi toi mysql
use App\Config\Database;
use \PDO;

class Tag_model extends Database
{
	public function __construct()
	{
		// trieu goi dc bien ket noi ($db) tu class database
		parent::__construct();
	}

	// viet ham kiem tra xem name tag da ton tai trong db chua?
	public function checkExitsNameTag($nameTag)
	{
		$flagCheck = false;
		$sql = "SELECT * FROM tags AS a WHERE a.name_tag = :nameTag";
		$stmt = $this->db->prepare($sql);
		if($stmt){
			$stmt->bindParam(':nameTag', $nameTag, PDO::PARAM_STR);
			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					$flagCheck = true;
				}
			}
			$stmt->closeCursor();
		}
		return $flagCheck;
	}

	public function addDataTag($name, $desc)
	{
		$flagAdd = false;
		$status = 1;
		$ct = date('Y-m-d H:i:s');
		$ut = null;

		$sql = "INSERT INTO tags(name_tag, description, status, created_at, updated_at) VALUES(:name, :descTag, :status, :ct, :ut)";
		$stmt = $this->db->prepare($sql);
		if($stmt){
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':descTag', $desc, PDO::PARAM_STR);
			$stmt->bindParam(':status', $status, PDO::PARAM_INT);
			$stmt->bindParam(':ct', $ct, PDO::PARAM_STR);
			$stmt->bindParam(':ut', $ut, PDO::PARAM_STR);
			if($stmt->execute()){
				$flagAdd = true;
			}
			$stmt->closeCursor();
		}
		return $flagAdd;
	}
}





