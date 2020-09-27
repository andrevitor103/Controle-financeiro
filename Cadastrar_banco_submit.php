<?php

	include 'config.php';
	include 'banco.class.php';
	$bancos = new Bancos($pdo);

	if(!empty($_POST['descricao'])){
		$descricao = $_POST['descricao'];
		$bancos->cadastrarBanco($descricao);
	}else{
		header('Location: cadastrar_banco.php');
	}