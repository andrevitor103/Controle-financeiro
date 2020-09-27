<?php
	include 'pages/header.php';
	include 'config.php';
	include 'lancamentos.class.php';
	$lancamento = new Lancamentos($pdo);
	$total = 0;
	if(!empty($_GET['grupo'])){
		$grupo = $_GET['grupo'];
	}
?>
	<body>
		<main>
			<div class="container">
				<section id="lancamentos_detalhes">
					<?php if(!empty($_GET['grupo'])): ?>
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
					</tr>
				</thead>
					<?php
						$itens = $lancamento->verDetalheDaCompra($grupo);
						foreach($itens as $item):
					?>
					<tbody>
					
						<?php 
						if($item['STATUS'] == 'ativa'):
						?>
						<tr class="table_td--item"> 
						<?php else: ?>
						<tr class="table_td--item--pago--detalhes">
						<?php endif; ?>
						
						<td><?php echo $item['id'] ?></td>
						<td><?php echo $item['descricao'] ?></td>
						<td><?php echo $item['valor'] ?></td>
						<td><?php echo $item['banco'] ?></td>
						<td><?php echo $item['parcela'] ?></td>
						<td><?php echo $item['data'] ?></td>
						<td><?php echo $item['STATUS'] ?></td>
						<?php if($item['STATUS'] == 'ativa'):
							$total = $item['valor'] + $total; 
						endif;
							?>
					</tr>
					</tbody>
				<?php endforeach;  ?>
						<tr class="table_td--item">
						<td>Total</td>
						<td></td>
						<td id="total_compra"><?php echo round($total,00); ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						</tr>
				</table>
				<?php else: ?>
					<span class="mensagem_detalhe--erro"><a href="lista_lancamentos.php"><p> Sem dados para mostrar </p></a></span>
				<?php endif; ?>
				</section>
			</div>
		</main>
	</body>


<?php
	include 'pages/footer.php';
?>