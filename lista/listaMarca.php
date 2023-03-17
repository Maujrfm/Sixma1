<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lista Produtos</title>
</head>
<?php
$cod_produto = $_GET['produto'];

include '../inc/conexao.inc.php';

$rsprod = pg_query($conexao,"select * from vw_juncao where cod_produto = '$cod_produto'");
?>
 <option selected> </option> 
 <?php while($regprod = pg_fetch_object($rsprod)):?>
 <option value="<?php echo $regprod->cod_marca?>">
 <?php echo $regprod->marca ?></option>
<?php endwhile; pg_close($conexao); ?>
<body>
</body>
</html>