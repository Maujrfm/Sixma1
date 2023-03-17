<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Lista Produtos</title>
</head>
<?php
$cod_produto = $_GET['produto'];
$cod_tipo = $_GET['tipo'];
$cod_marca = $_GET['marca'];

include '../inc/conexao.inc.php';

$rsmod = pg_query($conexao,"select * from tb_modelo where cod_produto = '$cod_produto' and cod_tipo = '$cod_tipo' and cod_marca = '$cod_marca' ");
?>
 <option selected> </option> 
 <?php while($regmod = pg_fetch_object($rsmod)):?>
 <option value="<?php echo $regmod->cod_modelo?>">
 <?php echo $regmod->mod_descricao ?></option>
<?php endwhile;  pg_close($conexao);?>
<body>
</body>
</html>