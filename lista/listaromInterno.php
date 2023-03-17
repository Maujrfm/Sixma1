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
$tipo=$_GET['tipo'];
$marca=$_GET['marca'];
$codimp=$_GET['codimp'];

include '../inc/conexao.inc.php';
if($codimp==0)
{
		if($tipo!="")
		{
			$valida=1;
			if($marca!="")
			{
				$valida=2;
			}//marca
		}//tipo

 		 else
 		{
	 
		 echo "<script> alert('Por favor preencha todos os dados'); 
	 		</script> \n";
		
		 }
}//ifradio

elseif($codimp==1)
{
	$valida=3;
}//elseifradio

if($valida==1)
	{
	 
	 		echo "<script> alert('Por favor preencha a marca'); 
	 		</script> \n";
		
 	}//elseifvalida1
if($valida==2)
{
	
	$sqlconsrein="select os_numserie_prod, tipo, produto, marca, modelo from vw_os where cod_tipo_reg<3 and cod_marca='".$marca."' and cod_tipo='".$tipo."'order by tipo asc , modelo asc ;";
	$rscons=pg_query($conexao,$sqlconsrein);
	echo "<form name=\"romaneio\" action=\"../confirma/confirmaromInterno.php\" method=\"post\">";
    echo "<table border=\"1\" width=\"100%\" >";
	echo "<thead class=\"imprimir\"><tr>";
	echo "<th align=\"center\" valign=\"middle\" colspan=\"6\" width=\"10%\">
	<img src=\"../img/Logo.png\" width=\"203\" height=\"101\" alt=\"Sixma\"  style=\"float: left;\"/>
	<br><h1> Relatório de OS  </h1></th></tr></thead>";
    echo "<tr>";
    echo "<th>Numero de Serie</th>";
    echo "<th>Tipo</th>";
    echo "<th>Produto</th>";
    echo "<th>Marca</th>";
    echo "<th>Modelo</th>";
	echo "<th>Opção</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{		
	echo "<tr>
	<td width=\"20%\" align=\"center\" id=\"cod\">".$impcons['os_numserie_prod']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['tipo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['produto']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['marca']."
	<input type=\"hidden\" name=\"marca\" value=".$marca.">
	<input type=\"hidden\" name=\"tipo\" value=".$tipo.">
	</td>
	<td width=\"20%\" align=\"center\">".$impcons['modelo']."</td>
	<td align=\"center\">
	<input type=\"checkbox\" name=\"check[]\" value=".$impcons['os_numserie_prod'].">
	</td></tr>";
	
	
	}//while
	echo "<tr><td colspan=\"6\" align=\"right\"> <input type=\"submit\" value=\"imprimir\"></form>";
	echo "</td></tr></table>";
	
}//ifvalida2

if($valida==3)
{
	if($tipo!=""&&$marca!="")
	{
	$sqlconsrom="select * from vw_romaneio where cod_marca='".$marca."' and cod_tipo='".$tipo."' and rom_status='".$codimp."' ;";
	}//camposvazios
	elseif($tipo!="")
	{
	$sqlconsrom="select * from vw_romaneio where cod_tipo='".$tipo."' and rom_status='".$codimp."' ;";
	}//elseif
	else
	{
	$sqlconsrom="select * from vw_romaneio where rom_status='".$codimp."'  ;";
	}//else
	$rsrom=pg_query($conexao,$sqlconsrom);
	echo "<table border=\"1\" width=\"100%\" >";
    echo "<tr>";
	echo "<th>Data</th>";
    echo "<th>Tipo</th>";
    echo "<th>Marca</th>";
    echo "<th>Codigo do Romaneio</th>";
    echo "</tr>";
	while($improm=pg_fetch_array($rsrom))
	{		
	$data=$improm['rom_data'];
	echo "<tr>
	<td width=\"20%\" align=\"center\">".date('d/m/Y',strtotime($data))."</td>
	<td width=\"20%\" align=\"center\">".$improm['tipo']."</td>
	<td width=\"20%\" align=\"center\">".$improm['marca']."
	</td>
	<td width=\"20%\" align=\"center\" id=\"cod\"><a href=\"../imprime/reimprimeRom.php?codigo=".$improm['cod_romaneio']."\">".$improm['cod_romaneio']."</a></tr>";
	
	
	}//while
	echo "</table>";
	
}//valida3



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