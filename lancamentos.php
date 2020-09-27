
<?php
	include 'pages/header.php';
	include 'config.php';
	include 'lancamentos.class.php';
	include 'banco.class.php';	
	$lancamentos = new Lancamentos($pdo);
	$bancos = new Bancos($pdo);
?>
<body>
	<main id="lancamentos--main">
	 	<div class="container">	
			<section id="formulario">
			<form method="POST" action="lancamentos_submit.php">
				<label>Descricao</label><br>
				<input type="text" name="descricao"><br>
				<label>Valor</label><br>
				<input type="number" name="valor"><br>
				<label>Banco</label><br>
				<select name="banco" id="banco">
					<?php 
					$banco = $bancos->getAll();
					foreach($banco as $item):
					var_dump($item);
					?>
					<option value="<?php echo $item['id'] ?>"><?php echo $item['descricao']?></option>
					<?php endforeach; ?>
				</select><br>
				<label>Emissao</label><br>
				<input type="date" name="vencimento"><br>
				<label>Categoria</label><br>
				<input type="text" name="categoria"><br>
				<label>quantas vezes</label><br>
				<input type="text" name="parcela"><br><br>
				<button id="salvar"> Salvar </button><br>
			</form>
			</section>

			<script type="text/javascript">
				function ver(){
					alert(document.getElementById("banco").value);	
				}
				
			</script>

		</div>	
	</main>
<?php
	include 'pages/footer.php';
?>
	