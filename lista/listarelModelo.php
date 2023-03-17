<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sixma</title>
<style media="print">
.imprimir{
	position: relative; 
	left: 50%;
	display:table-header-group;
}
</style>
<style >
thead{
	display:none;
}
</style>
</head>
<?php
include '../inc/conexao.inc.php';

$modelo=$_GET['modelo'];

if($modelo!="")
{
	$sqlconsmod="select * from vw_os where cod_modelo=".$modelo." order by cliente asc,cod_os desc  ;";
	$rscons=pg_query($conexao,$sqlconsmod);
    echo "<table border=\"1\" width=\"100%\" >";
	echo "<thead class=\"imprimir\"><tr>";
	echo "<th align=\"center\" valign=\"middle\" colspan=\"5\" width=\"10%\">
	<img src=\"../img/Logo.png\" width=\"203\" height=\"101\" alt=\"Sixma\"  style=\"float: left;\"/>
	<br><h1> Relatório de OS  </h1></th></tr></thead>";
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
	echo "<tr>
	<td width=\"10%\" align=\"center\" id=\"cod\">
	".$impcons['cod_os']."</td>
	<td width=\"30%\" align=\"center\">".$impcons['cliente']."</td>
	<td width=\"20%\" align=\"center\">".date('d/m/Y',strtotime($data))."</td>
	<td width=\"20%\" align=\"center\">".$impcons['marca']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['modelo']."</td></tr>";
	}
	echo "</table>";
}
else
{
	echo "<script> alert('Selecione um modelo'); </script>";
}
 pg_close($conexao);
?>
<body>
</body>
</html>