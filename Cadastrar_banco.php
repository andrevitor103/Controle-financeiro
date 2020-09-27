<?php 
	
	include 'pages/header.php';
	

?>
<body>
	<main>
		<div class="container">
			<section id="formulari_banco">
				<form method="POST" action="Cadastrar_banco_submit.php">
					<label> Descricao: </label><br>
					<input type="text" name="descricao"><br><br>
					<button>Salvar</button>
				</form>	
			</section>
		</div>
	</main>
</body>



<?php
	
	include 'pages/footer.php';

?>