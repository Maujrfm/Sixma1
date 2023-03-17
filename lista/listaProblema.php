<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lista Produtos</title>
</head>
<?php
$cod_produto = $_GET['produto'];

include '../inc/conexao.inc.php';
$sqlprob = "select * from tb_problema where cod_produto='".$cod_produto."' and cod_problema>1 ;";
$rsprob = pg_query($conexao,$sqlprob);

/*$impprob1=pg_fetch_array($rsprob)
	 echo "<script> alert('cod_problema =".$impprob1['cod_problema']."prob_descricao = ".$impprob1['prob_descricao']." '); 
		//</script> \n";*/
		
		
	echo "<option selected=\"selected\"> </option>";
	 while($des_prob=pg_fetch_array($rsprob))
	 {
echo"<option value=\"".$des_prob['cod_problema']."\">". $des_prob['prob_descricao']."</option>";
	} 
	echo "<option value=\"1\">OUTROS </option>";
	?>




<body>
</body>
</html>