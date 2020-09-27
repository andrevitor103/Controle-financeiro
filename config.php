<?php


	try{
		$pdo = new PDO("mysql:dbname=dbcontrole_contas; host=localhost","root","");
	}catch(PDOException $e){
		echo "Erro: ".$e->getMessage();
		exit();
		
	}