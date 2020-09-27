<?php

	class lancamentos {
		private $pdo;



		public function __construct($pdo){

			$this->pdo = $pdo;
			
		}

		public function getAll(){
			$sql = "SELECT A.*, DATE_FORMAT(A.vencimento,'%d/%m/%Y') as `data`, b.descricao as `banco` FROM lancamentos_financeiros A
			INNER JOIN banco B on A.banco = B.id order by a.id";
			$sql = $this->pdo->query($sql);

			if($sql->RowCount() > 0){

				return $sql->fetchAll();

			}else{
				return array();
			}
			
		}


		public function LancarConta($descricao, $valor, $banco, $parcela, $vencimento, $grupo, $categoria){
			$vencimento = str_replace("-", "/", $vencimento);
			$i = 1;
			$flag = 1;
			$dias = 30;
			$numParcela = 1;
			$valorParcela = $valor/$parcela;
			while($i <= $parcela){
			$sql = "INSERT INTO lancamentos_financeiros(descricao, vencimento, STATUS, valor, parcela, banco,grupo,categoria) VALUES(:descricao, STR_TO_DATE(:vencimento, '%Y/%m/%d'), 'ativa',:valor,:parcela, :banco, :grupo, :categoria)";
			//echo date( 'd/m/Y', strtotime('+'.$dias*$i.' days',strtotime($vencimento)));
			//var_dump($vencimento);
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':descricao', $descricao);
			$sql->bindValue(':vencimento', $vencimento);
			$sql->bindValue(':valor', $valorParcela);
			$sql->bindValue(':parcela', $numParcela);
			$sql->bindValue(':banco', $banco);
			$sql->bindValue(':grupo', $grupo);
			$sql->bindValue(':categoria', $categoria);
			$i = $i + 1;
			$numParcela = $numParcela + 1;
			$vencimento = date( 'Y/m/d', strtotime('+ 30 days',strtotime($vencimento)));
			if($sql->execute()){
				$flag = $flag + 1;
			}		
		}	
			
			if($flag <> $i){
				echo $flag.$i;
				return true;
			}else{
				return false;
			}
		
		}

		public function alterarConta($descricao, $vencimento, $id){
			$sql = "UPDATE lancamentos_financeiros SET descricao = :descricao, vencimento = :vencimento WHERE id in(:id)";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':descricao', $descricao);
			$sql->bindValue(':vencimento', $vencimento);
			$sql->bindValue(':id', $id);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function pagarConta($id){
			$sql = "UPDATE lancamentos_financeiros SET STATUS = 'menos uma' WHERE id = :id";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':id', $id);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}

		}

		public function verUltimoGrupo(){
			$sql = "SELECT grupo FROM lancamentos_financeiros GROUP BY grupo ORDER BY grupo DESC LIMIT 1";
			$sql = $this->pdo->query($sql);
			if(!empty($sql)){
				return $sql->fetch();
			}else{
				return 1;
			}
		}

		public function verDetalheDaCompra($grupo){
			$sql = "SELECT *, DATE_FORMAT(vencimento,'%d/%m/%Y') as `data` FROM lancamentos_financeiros WHERE grupo IN(:grupo)";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':grupo', $grupo);
			if($sql->execute()){
				return $sql->fetchall();
			}else{
				return $sql->array();
			}
			
		}



		/*      dashboards         */

		public function analisarCategoria(){
			$sql = "SELECT categoria, SUM(valor) AS `total`  FROM lancamentos_financeiros WHERE STATUS IN('ativa') GROUP BY categoria";
			$sql = $this->pdo->prepare($sql);
			$sql->execute();

			if($sql->rowCount() > 0){
				return $sql->fetchAll();
			}else{
				return $sql->array();
			}
		}

		public function analisarBanco(){
			$sql = "SELECT B.descricao, SUM(A.valor) AS `total`  FROM lancamentos_financeiros A, banco B WHERE A.banco = B.id AND A.`STATUS` IN('ativa') GROUP BY A.banco";
			$sql = $this->pdo->prepare($sql);
			$sql->execute();

			if($sql->rowCount() > 0){
				return $sql->fetchAll();
			}else{
				return $sql->array();
			}
		}

		public function analisarBancoMes($mes){
			$sql = "SELECT B.descricao, SUM(A.valor) AS `total`  FROM lancamentos_financeiros A, banco B WHERE A.banco = B.id AND MONTH(A.vencimento) = :mes AND A.`STATUS` IN('ativa') GROUP BY A.banco";
			$sql = $this->pdo->prepare($sql);
			$sql->bindValue(':mes',$mes);
			$sql->execute();

			if($sql->rowCount() > 0){
				return $sql->fetchAll();
			}else{
				return $sql->array();
			}
		}



		


	}