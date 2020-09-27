
<?php
	include 'pages/header.php';
?>
<?php 
	include 'config.php';
	include 'lancamentos.class.php';
	$lancamento = new Lancamentos($pdo);

	if(!empty($_GET['id'])){
		$lancamento->pagarConta($_GET['id']);
	}

?>
<body>
	<main>
	 	<div class="container">	
			<section id="lancamentos">
				<p id="teste"></p>

				<table class="table">
					<thead class="table_th--black">
					<tr>
						<th class="table--th--itens">id</th>
						<th class="table--th--itens">Descricao</th>
						<th class="table--th--itens">Valor</th>
						<th class="table--th--itens">Banco</th>
						<th class="table--th--itens">Parcela</th>
						<th class="table--th--itens">Vencimento</th>
						<th class="table--th--itens">status</th>
						<th class="table--th--itens">Ações</th>
					</tr>
					</thead>
					<?php
						$itens = $lancamento->getAll();
						foreach($itens as $item):
					?>
					<tbody>

						<?php 
						if($item['STATUS'] == 'ativa'):
						?>
						<tr class="table_td--item"> 
						<?php else: ?>
						<tr class="table_td--item--pago">
						<?php endif; ?>

						<td class="table--td--acao--links"><a href="lancamentos_detalhes.php?grupo=<?php echo $item['grupo'] ?>"><?php echo $item['id'] ?></a></td>
						<td><?php echo $item['descricao'] ?></td>
						<td><?php echo $item['valor'] ?></td>
						<td><?php echo $item['banco'] ?></td>
						<td><?php echo $item['parcela'] ?></td>
						<td class="table--td--acao--links"><a href="lancamentos_editar.php?grupo=<?php echo $item['grupo'] ?>"><?php echo $item['data'] ?></a></td>
						<td><?php echo $item['STATUS'] ?></td>
						<?php if($item['STATUS'] == 'ativa'): ?>	
						<td class="table--td_td--botoes"><a href="lista_lancamentos.php?id=<?php echo $item['id']; ?>"><button class="table--td_td--botoes--acao"> Pagar </button></a></td>
					<?php else: ?>
						<td class="table--td_td--botoes"><a href="lista_lancamentos.php?id=<?php echo $item['id']; ?>"><button class="table--td_td--botoes--acao--pago"> paga </button></a></td>
					<?php endif; ?>
				</div>
					</tr>
					</tbody>
				<?php endforeach;  ?>
				</table>

			</section>

		</div>	
	</main>
<?php
	include 'pages/footer.php';
?>
	