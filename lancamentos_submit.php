<?php

	include 'config.php';
	include 'lancamentos.class.php';
	$lancamento = new Lancamentos($pdo);


	if(!empty($_GET['descricao'])){
		$descricao = $_GET['descricao'];
		$valor = $_GET['valor'];
		$parcela = 1;
		$banco = 2;
		$vencimento = '2020-09-26';
		$categoria = 'despesas';
		$grupo = $lancamento->verUltimoGrupo();
		$grupo[0] = $grupo[0] + 1;
		$lancamento->lancarConta($descricao, $valor, $banco, $parcela, $vencimento, $grupo[0], $categoria);
		header('Location: lista_lancamentos.php');
	}

	else if(!empty($_POST['descricao'])){
		$descricao = $_POST['descricao'];
		$valor = $_POST['valor'];
		$parcela = $_POST['parcela'];
		$banco = $_POST['banco'];
		$vencimento = $_POST['vencimento'];
		$categoria = $_POST['categoria'];
		$grupo = $lancamento->verUltimoGrupo();
		$grupo[0] = $grupo[0] + 1;
		echo $grupo[0];

		$lancamento->lancarConta($descricao, $valor, $banco, $parcela, $vencimento, $grupo[0], $categoria);
		// header('Location: lancamentos.php');

	}else{
		echo 'erro';
	}