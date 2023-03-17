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
$marca=$_GET['marca'];

if($dataini!=""&&$marca!="")
{
	$valida=1;
	if($datafim!="")
	{	
	$valida=2;
	}//datafim
}//dataini
if($valida==1)
{
	$sqlconsrom="select cod_romaneio,marca,tipo,rom_data from vw_romaneio where rom_status=2 and cod_marca='".$marca."' and rom_data>='".$dataini."' order by rom_data desc, tipo desc  ;";
	$rscons=pg_query($conexao,$sqlconsrom);
    echo "<table border=\"1\" width=\"100%\" >";
	echo "<thead class=\"imprimir\"><tr>";
	echo "<th align=\"center\" valign=\"middle\" colspan=\"5\" width=\"10%\">
	<img src=\"../img/Logo.png\" width=\"203\" height=\"101\" alt=\"Sixma\"  style=\"float: left;\"/>
	<br><h1> Relatório de Romaneio  </h1></th></tr></thead>";
    echo "<tr>";
    echo "<th width=\"10%\">Codigo da Romaneio</th>";
    echo "<th width=\"30%\">Marca</th>";
    echo "<th width=\"30%\">Tipo</th>";
    echo "<th width=\"30%\">Data</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
		$data=$impcons['rom_data'];
	echo "<tr>
	<td width=\"10%\" align=\"center\" id=\"cod\">
	".$impcons['cod_romaneio']."</td>
	<td width=\"30%\" align=\"center\">".$impcons['marca']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['tipo']."</td>
	<td width=\"20%\" align=\"center\">".date('d/m/Y',strtotime($data))."</td>
	</tr>";
	}
	echo "</table>";
}//valida1
elseif($valida==2)
{
	$sqlconsrom="select cod_romaneio,marca,tipo,rom_data from vw_romaneio where rom_status=2 and cod_marca='".$marca."' and rom_data>='".$dataini."' and rom_data<='".$datafim."' order by rom_data desc, tipo desc  ;";
	$rscons=pg_query($conexao,$sqlconsrom);
    echo "<table border=\"1\" width=\"100%\" >";
	echo "<thead class=\"imprimir\"><tr>";
	echo "<th align=\"center\" valign=\"middle\" colspan=\"5\" width=\"10%\">
	<img src=\"../img/Logo.png\" width=\"203\" height=\"101\" alt=\"Sixma\"  style=\"float: left;\"/>
	<br><h1> Relatório de Romaneio  </h1></th></tr></thead>";
    echo "<tr>";
    echo "<th width=\"10%\">Codigo da Romaneio</th>";
    echo "<th width=\"30%\">Marca</th>";
    echo "<th width=\"30%\">Tipo</th>";
    echo "<th width=\"30%\">Data</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
		$data=$impcons['rom_data'];
	echo "<tr>
	<td width=\"10%\" align=\"center\" id=\"cod\">
	".$impcons['cod_romaneio']."</td>
	<td width=\"30%\" align=\"center\">".$impcons['marca']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['tipo']."</td>
	<td width=\"20%\" align=\"center\">".date('d/m/Y',strtotime($data))."</td>
	</tr>";
	}
	echo "</table>";
}//valida2
else
{
	if($marca=="")
	{
	echo "<script> alert('Selecione uma marca'); </script>";
	}
	else
	{
	echo "<script> alert('Selecione uma data'); </script>";
	}
}
 pg_close($conexao);
?>
<body>
</body>
</html>