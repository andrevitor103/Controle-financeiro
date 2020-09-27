<?php 
	require 'pages/header.php';
?>
<?php

	include 'config.php';
	include 'lancamentos.class.php';
	$lancamentos = new lancamentos($pdo);

?>


<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

 

      function drawChart() {

		var data = google.visualization.arrayToDataTable([
      		
          ['Task', 'Hours per Day'],
          ['Work',    0]
        ]);
        
        <?php 

      	$lancamento = $lancamentos->analisarCategoria();
      	foreach($lancamento as $item):	

      	?>

        data.addRows([
        	['<?php echo $item['categoria'] ?>', <?php echo $item['total'] ?> ]
        	]);

    <?php endforeach; ?>

        var options = {

          title: 'Lanches mais pedidos:',
          is3D: true, //graficos em 3D;

        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>









<?php
	require 'pages/footer.php';
?>