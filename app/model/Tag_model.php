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

	public function getDataTagsByPage($start, $rows, $keyword = '')
	{
		$data = [];
		$key = "%".$keyword."%";

		$sql = "SELECT * FROM tags AS a WHERE a.name_tag LIKE :nameTag OR a.description LIKE :descTag ORDER BY a.created_at DESC, a.id ASC LIMIT :start,:rows";

		$stmt = $this->db->prepare($sql);
		if($stmt){
			$stmt->bindParam(':nameTag', $key, PDO::PARAM_STR);
			$stmt->bindParam(':descTag', $key, PDO::PARAM_STR);
			$stmt->bindParam(':start', $start, PDO::PARAM_INT);
			$stmt->bindParam(':rows', $rows, PDO::PARAM_INT);
			
			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		return $data;
	}

	public function updateDataTagById($idTag, $nameTag, $descTag, $status)
	{
		$ut = date('Y-m-d H:i:s');
		$flagUp = false;
		$sql = "UPDATE tags AS a SET a.name_tag = :name, a.description = :descTag, a.status = :status, a.updated_at = :ut WHERE a.id = :id";
		$stmt = $this->db->prepare($sql);
		if($stmt){
			$stmt->bindParam(':name', $nameTag, PDO::PARAM_STR);
			$stmt->bindParam(':descTag', $descTag, PDO::PARAM_STR);
			$stmt->bindParam(':status', $status, PDO::PARAM_INT);
			$stmt->bindParam(':ut', $ut, PDO::PARAM_STR);
			$stmt->bindParam(':id', $idTag, PDO::PARAM_INT);
			if($stmt->execute()){
				$flagUp = true;
			}
			$stmt->closeCursor();
		}
		return $flagUp;
	}

	public function checkUpddateNameTag($id, $name)
	{
		$flagCheck = false;
		$sql = "SELECT * FROM tags AS a WHERE a.name_tag = :name AND a.id <> :id";
		$stmt = $this->db->prepare($sql);
		if($stmt){
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);

			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					$flagCheck = true;
				}
			}
			$stmt->closeCursor();
		}
		return $flagCheck;
	}

	public function getInfoDataTagById($id)
	{
		$data = [];
		$sql = "SELECT * FROM tags AS a WHERE a.id = :id";
		$stmt = $this->db->prepare($sql);
		if($stmt){
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		return $data;
	}

	public function deleteTagById($id)
	{
		$flagDel = false;
		$sql = "DELETE FROM tags WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		if($stmt){
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			if($stmt->execute()){
				$flagDel = true;
			}
			$stmt->closeCursor();
		}
		return $flagDel;
	}

	public function getAllDataTags($keyword = '')
	{
		$data = [];
		$key = "%".$keyword."%";

		$sql = "SELECT * FROM tags AS a WHERE a.name_tag LIKE :nameTag OR a.description LIKE :descTag ORDER BY a.created_at DESC, a.id ASC";

		$stmt = $this->db->prepare($sql);
		if($stmt){
			$stmt->bindParam(':nameTag', $key, PDO::PARAM_STR);
			$stmt->bindParam(':descTag', $key, PDO::PARAM_STR);
			
			if($stmt->execute()){
				if($stmt->rowCount() > 0){
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		return $data;
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





