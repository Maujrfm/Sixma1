<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lista Produtos</title>
</head>
<body>
<?php
$cod_tipo = $_GET['tipo'];
include '../inc/conexao.inc.php';
$rstipo = pg_query($conexao,"select * from tb_produto where cod_tipo = '$cod_tipo'");

?> 
<option selected> </option> 
<?php while($regtipo = pg_fetch_object($rstipo)):?>
<option value="<?php echo $regtipo->cod_produto?>"><?php echo $regtipo->prod_descricao ; ?></option>
<?php endwhile; 
 pg_close($conexao);?>

</body>
</html>