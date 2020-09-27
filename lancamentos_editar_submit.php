<?php

include 'config.php';
include 'lancamentos.class.php';
$lancamentos = new Lancamentos($pdo);
$total = 1;

if($_POST['id']){
	$newVencimento = $_POST['vencimento'];
	$vencimento = $_POST['vencimentos'];
	$vencimentos = explode(',', $vencimento);
	$descricao = $_POST['descricao'];
	$id = $_POST['id'];

	while($total < count($vencimentos)){
		echo $vencimentos[$total].'<br>';
		echo $descricao.'<br>';
		$total = $total + 1;
	}
}