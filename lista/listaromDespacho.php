<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<style media="print">
.nao_imprimir{display:none}
</style>
<style type="text/css">
ul#menu {
	margin: 0; /* retira o recuo para alguns browsers */
	padding: 0; /* retira o recuo para outros browsers */
	list-style-type: none; /* retira o marcador de listas*/
}
#fonte {
	color : lightGreen;
	font-family : Verdana, Arial, Helvetica;
	font-size : 12pt;
	text-align : center;
"
}
#fonte2 {
	color : lightGreen;
	font-family : Verdana, Arial, Helvetica;
	font-size : 12pt;
	text-align : center;
	font-weight: bold;
"
}
#texto {
	text-align: center;
}
</style>
</head>
<body>
<?php 
session_start();
if(isset($_SESSION['login']))
{
$valida=0;
$codrom=$_GET['romaneio'];
$codimp=$_GET['codimp'];

include '../inc/conexao.inc.php';
if($codimp==0)
{
		if($codrom!="")
		{
			$valida=1;
		}//rom
 		 else
 		{
	 
		 echo "<script> alert('Por favor preencha todos os dados'); 
	 		</script> \n";
		
		 }
}//ifradio

elseif($codimp==1)
{
	$valida=2;
}//elseifradio

if($valida==1)
{
	
	$sqlconsrein="select * from vw_romaneio where cod_romaneio='".$codrom."' ;";
	$rscons=pg_query($conexao,$sqlconsrein);
	$impcons=pg_fetch_array($rscons);
	echo "<form name=\"romaneio\" action=\"../confirma/confirmaromDespacho.php\" method=\"post\">";
    echo "<table border=\"1\" width=\"100%\" >";
	echo "<thead class=\"imprimir\"><tr>";
	echo "<th align=\"center\" valign=\"middle\" colspan=\"6\" width=\"10%\">
	<img src=\"../img/Logo.png\" width=\"203\" height=\"101\" alt=\"Sixma\"  style=\"float: left;\"/>
	<br><h1> Relatório de OS  </h1></th></tr></thead>";
    echo "<tr>";
    echo "<th>Codigo do Romaneio</th>";
	echo "<th>Data</th>";
    echo "<th>Tipo</th>";
    echo "<th>Marca</th>";
    echo "<th>Nota Fiscal</th>";
	echo "<th>Volumes</th>";
    echo "</tr>";
	echo "<tr>
	<td width=\"20%\" align=\"center\" id=\"cod\">".$impcons['cod_romaneio']."<input type=\"hidden\" name=\"codrom\" value=".$codrom."></td>";
	echo "<td width=\"20%\" align=\"center\">".date('d/m/Y',strtotime($impcons['tipo']))."</td>";
	echo "<td width=\"20%\" align=\"center\">".$impcons['tipo']."</td>";
	echo "<td width=\"20%\" align=\"center\">".$impcons['marca']."</td>";
	echo "<td width=\"20%\" align=\"center\">
	<input type=\"text\" name=\"nf\" autocomplete=\"off\"></td>";
	echo "<td width=\"20%\" align=\"center\">
	<input type=\"text\" name=\"qtdv\" autocomplete=\"off\"></td></tr>";
	echo "<tr><td colspan=\"6\" align=\"right\"> <input type=\"submit\" value=\"imprimir\"></form>";
	echo "</td></tr></table>";
	
}//ifvalida2

if($valida==2)
{
	$sqlconsrein="select * from vw_romaneio where cod_romaneio='".$codrom."' ;";
	$rscons=pg_query($conexao,$sqlconsrein);
	$impcons=pg_fetch_array($rscons);
	echo "<form name=\"romaneio\" action=\"../confirma/confirmaromDespacho.php\" method=\"post\">";
    echo "<table border=\"1\" width=\"100%\" >";
	echo "<thead class=\"imprimir\"><tr>";
	echo "<th align=\"center\" valign=\"middle\" colspan=\"6\" width=\"10%\">
	<img src=\"../img/Logo.png\" width=\"203\" height=\"101\" alt=\"Sixma\"  style=\"float: left;\"/>
	<br><h1> Relatório de OS  </h1></th></tr></thead>";
    echo "<tr>";
    echo "<th>Codigo do Romaneio</th>";
	echo "<th>Data</th>";
    echo "<th>Tipo</th>";
    echo "<th>Marca</th>";
    echo "<th>Nota Fiscal</th>";
	echo "<th>Volumes</th>";
    echo "</tr>";
	echo "<tr>
	<td width=\"20%\" align=\"center\" id=\"cod\">".$impcons['cod_romaneio']."<input type=\"hidden\" name=\"codrom\" value=".$codrom."></td>";
	echo "<td width=\"20%\" align=\"center\">".date('d/m/Y',strtotime($impcons['tipo']))."</td>";
	echo "<td width=\"20%\" align=\"center\">".$impcons['tipo']."</td>";
	echo "<td width=\"20%\" align=\"center\">".$impcons['marca']."</td>";
	echo "<td width=\"20%\" align=\"center\">
	<input type=\"hidden\" name=\"nf\" value=".$impcons['rom_nf'].">
	".$impcons['rom_nf']."</td>";
	echo "<td width=\"20%\" align=\"center\">
	<input type=\"text\" name=\"qtdv\" autocomplete=\"off\"></td></tr>";
	echo "<tr><td colspan=\"6\" align=\"right\"> <input type=\"submit\" value=\"imprimir\"></form>";
	echo "</td></tr></table>";
	
}//valida2



?>
</body>

<?php
pg_close($conexao);
 }
 else
 {
	 
	 echo "<script> alert('Por favor Faça Login'); 
	 	window.location='../index.php';  
		</script> \n";
		
 }

 ?>
</html>