
<?php
	include 'pages/header.php';
	include 'config.php';
	include 'lancamentos.class.php';
	include 'banco.class.php';	
	$lancamentos = new Lancamentos($pdo);
	$bancos = new Bancos($pdo);

?>
<body>
	<main>
	 	<div class="container">	
			<section id="formulario">
			<form method="GET" action="qrCode.php">
				<label>Codigo</label><br>
				(<a href="http://zxing.appspot.com/scan?ret=http://192.168.0.104/dashboard/AndreAdamsControles/qrCode.php?codigo={CODE}">Leitor</a>):
				<input type="text" name="codigo"><br><br>
				<button> Salvar </button><br>
			</form>
			</section>

			<script type="text/javascript">
				function ver(){
					alert(document.getElementById("banco").value);	
				}
				
			</script>

		</div>	
	</main>