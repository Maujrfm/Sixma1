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
$valida=0;
$dataini=$_GET['dataini'];
$datafim=$_GET['datafim'];

if($dataini!="")
{
	$valida=1;
	if($datafim!="")
	{	
	$valida=2;
	}//datafim
}//dataini
if($valida==1)
{
	$sqlconsdt="select * from vw_os where os_data>='".$dataini."' order by os_data desc,cod_os desc  ;";
	$rscons=pg_query($conexao,$sqlconsdt);
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
elseif($valida==2)
{
	$sqlconsdt="select * from vw_os where os_data>='".$dataini."' and os_data<='".$datafim."' order by cliente asc,cod_os desc  ;";
	$rscons=pg_query($conexao,$sqlconsdt);
    echo "<table border=\"1\" width=\"100%\" >";
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
	echo "<tr><td align=\"center\" id=\"cod\">".$impcons['cod_os']."</td><td align=\"center\">".$impcons['cliente']."</td><td align=\"center\">".date('d/m/Y',strtotime($data))."</td><td align=\"center\">".$impcons['marca']."</td><td align=\"center\">".$impcons['modelo']."</td></tr>";
	}
	echo "</table>";
}
else
{
	echo "<script> alert('Selecione uma data'); </script>";
}
 pg_close($conexao);
?>
<body>
</body>
</html>