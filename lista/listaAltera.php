<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sixma</title>
</head>
<?php
include '../inc/conexao.inc.php';
$verifica=0;
$codos=$_GET['codos'];
$cliente=$_GET['cliente'];

if($cliente!="")
{
	$sqlconscli="select * from vw_os where cod_cliente=".$cliente." and cod_tipo_reg<6 order by os_data desc,cod_os desc  ;";
	$rscons=pg_query($conexao,$sqlconscli);
	$verifica=1;
}
elseif($codos!="")
{
	$sqlconscod="select * from vw_os where cod_os=".$codos." and cod_tipo_reg<6 order by os_data desc  ;";
	$rscons=pg_query($conexao,$sqlconscod);
	$verifica=1;
}
if($verifica=="1")
{
    echo "<table border=\"1\" width=\"100%\">";
    echo "<tr>";
    echo "<th>Codigo da OS</th>";
    echo "<th>Cliente</th>";
    echo "<th>Data</th>";
    echo "<th>Marca</th>";
    echo "<th>Modelo</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
		$data=$impcons['os_data'];
	echo "<tr><td align=\"center\" id=\"cod\"><a href=\"alterarOs.php?codigo=".$impcons['cod_os']."\">".$impcons['cod_os']."</a></td><td align=\"center\">".$impcons['cliente']."</td><td align=\"center\">".date('d/m/Y',strtotime($data))."</td><td align=\"center\">".$impcons['marca']."</td><td align=\"center\">".$impcons['modelo']."</td></tr>";
	}
	echo "</table>";
}
else
{
	echo "<script> alert('Digite um codigo ou selecione um cliente'); </script>";
}
 pg_close($conexao);
?>
<body>
</body>
</html>