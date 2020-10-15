<?php


class config{

	public $pdo ;
	
			
	public function db(){
		$this->pdo = new PDO('mysql:host=localhost;dbname=ssip;charset=utf8mb4','root','');
		return $this->pdo;
	}

}



?>