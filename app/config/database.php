<?php
namespace App\Config;

use \PDO;

class Database 
{
	protected $db;

	public function __construct()
	{
		$this->db = $this->connection();
	}

	protected function connection()
	{
		//connect to mysql
		try {
		    $dbh = new PDO('mysql:host=localhost;dbname=lphp1903e;charset=utf8','root','');
		    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		    return $dbh;

		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}

	public function __destruct()
	{
		// close connect to mysql
		$this->db = null;
	}
}