<?php    
    
	if(!empty($_GET['codigo'])){
	$cod = $_GET['codigo'];
    $xml= file_get_contents($cod);
    if (!$xml) {
        echo "Erro ao abrir arquivo!";
        exit;
    }
    preg_match_all('/totalNumb txtMaxspan/', $xml, $conteudo);
    preg_match_all('/txtTopo/', $xml, $conteudo);
    $teste = stripos($xml, 'totalNumb txtMax');
    $teste2 = stripos($xml, 'class="');
    $razao = stripos($xml, 'txtTopo');
    $razao2 = stripos($xml, 'class="');
    $emissao = stripos($xml, 'Emissão: </strong>');
    echo '<pre>';
    // print_r($xml);
    // var_dump($conteudo);
    // var_dump($teste);



    $txt = '';
    $total = 0;
	while($total <= 40){
		$txt = trim($txt.$xml[$teste][0]);
		$teste = $teste + 1;
		$total = $total + 1;
	}

    $total = 0;
    $txt2 = '';
    while($total <= 40){
        $txt2 = $txt2.$xml[$razao][0];
        $razao = $razao + 1;
        $total = $total + 1;
    }


    $txt2 = $txt2;
    //var_dump($txt2);


    // print_r($xml[$teste][0]);
    // var_dump($txt);

    $valor2 = stripos($txt2, '"');
    $parada2 = 0;
    $i2 = 2;
    $totalNota2 = '';
    while($parada2 <= 20){

        if($txt2[$valor2+$i2] == '<'){
            $parada2 = 26;
            break;
        }
        #echo $txt2[$valor2+$i2].'<br>';
        $parada2 = $parada2 + 1;
        $totalNota2 = $totalNota2.$txt2[$valor2+$i2];
        $i2 = $i2 + 1;
    }



    $valor = stripos($txt, '">');
    $parada = 0;
    $i = 2;
    $totalNota = '';
    while($parada <= 16){

    	if($txt[$valor+$i] == '<'){
    		$parada = 20;
    		break;
    	}
    	// echo $txt[$valor+$i].'<br>';
    	$parada = $parada + 1;
    	$totalNota = $totalNota.$txt[$valor+$i];
    	$i = $i + 1;
    }

    $totalNota2 = trim($totalNota2);


    //header('Location: qrCodeEnviar.php');
    

    // var_dump($totalNota);

    $totalNota = str_replace(",",  ".", $totalNota);

    echo "<div style='margin-left: 240px; border: 1px solid black; width: 280px; text-align: center;'><div style='background-color: red; width: 260px; margin: 0 auto; padding: 10px;'><h2> Valor total da compra </h2></div><p style='color:red;font-size: 26px;'>$totalNota</p></div>";

    echo "<div style='margin-left: 240px; border: 1px solid black; width: 280px; text-align: center;'><div style='background-color: red; width: 260px; margin: 0 auto; padding: 10px;'><h2> Razao Social </h2></div><p style='color:red;font-size: 26px;'>$totalNota2</p></div>";



    header("Location: lancamentos_submit.php?descricao=".$totalNota2."&valor=".$totalNota);

// Segunda maneira de conseguir os dados

// $ch = curl_init();
// $timeout = 0;
// curl_setopt($ch, CURLOPT_URL, 'http://www.fazenda.pr.gov.br/nfce/qrcode/?p=41200907493739000202652100000236141400364348%7C2%7C1%7C2%7C04116BB49C4DC501C5D6A8A7BF3CE75CFDF62CEF');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
// $conteudo = curl_exec ($ch);
// curl_close($ch);
// echo $conteudo;
}else{
	header('Location: qrCodeEnviar.php');
}


    ?>

