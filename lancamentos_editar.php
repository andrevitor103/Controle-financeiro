
<?php
	include 'pages/header.php';
?>
<?php 
	include 'config.php';
	include 'lancamentos.class.php';
	$lancamento = new Lancamentos($pdo);
	$totalRegistros = 0;
	$dados = null;
	if(!empty($_GET['grupo'])){
		$grupo = $_GET['grupo'];
		$item = $lancamento->verDetalheDaCompra($grupo);
	}

	if(!empty($_GET['id'])){
		$id = $_GET['id'];
		$lancamento->alterarVencimento($id);
	}

?>	
	
<body>
	<main>
	 	<div class="container">	
			<section id="lancamentos_editar">
				<form method="POST" onload="alterarLbl();">
					<label> Descricao: </label><br>
					<input type="text" name="descricao" value="<?php echo $item[0]['descricao']; ?>"><br><br>
					<label id="lblVencimento"></label><br>
					<?php
						foreach($item as $itens):
					?>
					<input type="text" name="id" value="<?php echo $itens['id']; ?>" hidden>

					<input type="date" id="vencimento" name="vencimento" value="<?php echo $itens['vencimento']; ?>"><br><br>
					<?php 
						$totalRegistros = $totalRegistros + 1;
						$dados = trim($dados.','.$itens['vencimento']);
					?>
					
				<?php endforeach; ?>
				<input type="text" name="total" value="<?php echo $totalRegistros; ?>" hidden>
				<input type="text" name="vencimentos" value="<?php echo $dados; ?>" hidden>
				<button class="botao--salvar" type="submit">Salvar</button>
				</form>
			</section>
		</div>	
	</main>

		<script type="text/javascript">
		window.onload = alterarLbl;
		function alterarLbl() {
		var total = '<?php echo $totalRegistros; ?>';
		if(total <= 1){
			document.getElementById("lblVencimento").innerHTML = "<label>"+ "Vencimento" + "</label>" ;
		}else{
			document.getElementById("lblVencimento").innerHTML = "<label>"+ "Vencimentos" + "</label>" ;
		}
		
		}
	</script>

<?php
	include 'pages/footer.php';
?>
	