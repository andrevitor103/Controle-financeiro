<?php 


	class Bancos {
		private $pdo;


		public function __construct($pdo){
			$this->pdo = $pdo;
		}


		public function getAll(){
			$sql = "SELECT * FROM banco";
			$sql = $this->pdo->query($sql);
			if($sql->RowCount() > 0 ){
				return $sql->fetchall();
			}else{
				return $sql->array();
			}
		}

		public function cadastrarBanco($descricao){
			$sql = "INSERT INTO banco(descricao) VALUES(:descricao)";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':descricao',$descricao);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}


	}

