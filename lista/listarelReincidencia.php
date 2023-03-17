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

	$verifica=0;
 	$tipo=$_GET['tipo'];
	$produto=$_GET['produto'];
 	$marca=$_GET['marca'];
	$modelo=$_GET['modelo'];
	$numserie=$_GET['numserie'];
	

if($tipo!="")
{
	$verifica=1;
	if($produto!="")
	{
		$verifica=2;
		if($marca!="")
		{
			$verifica=6;
			if($modelo!="")
			{
				$verifica=4;
			}//if(modelo)
		}//if(marca)
	}//if(produto)
}//if(tipo)
elseif($marca!="")
		{
			$verifica=3;
			if($numserie!="")
			{
				$verifica=5;
			}//if(numserie)	
		}//elseif(marca)
else
{	
	$sqlconsrein="select os_numserie_prod, tipo, produto, marca, modelo, count(*) from vw_os
group by os_numserie_prod, tipo, produto, marca, modelo order by os_numserie_prod;";
	$rscons=pg_query($conexao,$sqlconsrein);
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
	echo "<th>Quantidade</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
	if($impcons['count']>1)
	{
	echo "<tr>
	<td width=\"20%\" align=\"center\" id=\"cod\">
	<a href=\"imprimeReincind.php?numserie=".$impcons['os_numserie_prod']."\">
	".$impcons['os_numserie_prod']."</a></td>
	<td width=\"20%\" align=\"center\">".$impcons['tipo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['produto']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['marca']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['modelo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['count']."</td></tr>";}
	}
	echo "</table>";
}		
if($verifica==1)
{
	$sqlconsrein="select os_numserie_prod, tipo, produto, marca, modelo, count(*) from vw_os where cod_tipo='".$tipo."'
group by os_numserie_prod, tipo, produto, marca, modelo order by os_numserie_prod;";
	$rscons=pg_query($conexao,$sqlconsrein);
    echo "<table border=\"1\" width=\"100%\" >";
	echo "<thead class=\"imprimir\"><tr>";
	echo "<th align=\"center\" valign=\"middle\" colspan=\"6\" width=\"10%\">
	<img src=\"img/Logo.png\" width=\"203\" height=\"101\" alt=\"Sixma\"  style=\"float: left;\"/>
	<br><h1> Relatório de OS  </h1></th></tr></thead>";
    echo "<tr>";
    echo "<th>Numero de Serie</th>";
    echo "<th>Tipo</th>";
    echo "<th>Produto</th>";
    echo "<th>Marca</th>";
    echo "<th>Modelo</th>";
	echo "<th>Quantidade</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
	if($impcons['count']>1)
	{
	echo "<tr>
	<td width=\"20%\" align=\"center\" id=\"cod\">
	<a href=\"imprimeReincind.php?numserie=".$impcons['os_numserie_prod']."\">
	".$impcons['os_numserie_prod']."</a></td>
	<td width=\"20%\" align=\"center\">".$impcons['tipo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['produto']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['marca']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['modelo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['count']."</td></tr>";}
	}
	echo "</table>";
}//verifica1
if($verifica==2)
{
	$sqlconsrein="select os_numserie_prod, tipo, produto, marca, modelo, count(*) from vw_os where cod_tipo='".$tipo."' and cod_produto='".$produto."'
group by os_numserie_prod, tipo, produto, marca, modelo order by os_numserie_prod;";
	$rscons=pg_query($conexao,$sqlconsrein);
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
	echo "<th>Quantidade</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
	if($impcons['count']>1)
	{
	echo "<tr>
	<td width=\"20%\" align=\"center\" id=\"cod\">
	<a href=\"../imprime/imprimeReincind.php?numserie=".$impcons['os_numserie_prod']."\">
	".$impcons['os_numserie_prod']."</a></td>
	<td width=\"20%\" align=\"center\">".$impcons['tipo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['produto']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['marca']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['modelo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['count']."</td></tr>";}
	}
	echo "</table>";
}//verifica2
if($verifica==3)
{
	$sqlconsrein="select os_numserie_prod, tipo, produto, marca, modelo, count(*) from vw_os where cod_marca='".$marca."'
group by os_numserie_prod, tipo, produto, marca, modelo order by os_numserie_prod;";
	$rscons=pg_query($conexao,$sqlconsrein);
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
	echo "<th>Quantidade</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
	if($impcons['count']>1)
	{
	echo "<tr>
	<td width=\"20%\" align=\"center\" id=\"cod\">
	<a href=\"../imprime/imprimeReincind.php?numserie=".$impcons['os_numserie_prod']."\">
	".$impcons['os_numserie_prod']."</a></td>
	<td width=\"20%\" align=\"center\">".$impcons['tipo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['produto']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['marca']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['modelo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['count']."</td></tr>";}
	}
	echo "</table>";
}//verifica3
if($verifica==4)
{
	$sqlconsrein="select os_numserie_prod, tipo, produto, marca, modelo, count(*) from vw_os where cod_modelo='".$modelo."'
group by os_numserie_prod, tipo, produto, marca, modelo order by os_numserie_prod;";
	$rscons=pg_query($conexao,$sqlconsrein);
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
	echo "<th>Quantidade</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
	if($impcons['count']>1)
	{
	echo "<tr>
	<td width=\"20%\" align=\"center\" id=\"cod\">
	<a href=\"../imprime/imprimeReincind.php?numserie=".$impcons['os_numserie_prod']."\">
	".$impcons['os_numserie_prod']."</a></td>
	<td width=\"20%\" align=\"center\">".$impcons['tipo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['produto']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['marca']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['modelo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['count']."</td></tr>";}
	}
	echo "</table>";
}//verifica4
if($verifica==5)
{
	$sqlconsrein="select os_numserie_prod, tipo, produto, marca, modelo, count(*) from vw_os where os_numserie_prod='".$numserie."'
group by os_numserie_prod, tipo, produto, marca, modelo order by os_numserie_prod;";
	$rscons=pg_query($conexao,$sqlconsrein);
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
	echo "<th>Quantidade</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
	if($impcons['count']>1)
	{
	echo "<tr>
	<td width=\"20%\" align=\"center\" id=\"cod\">
	<a href=\"../imprime/imprimeReincind.php?numserie=".$impcons['os_numserie_prod']."\">
	".$impcons['os_numserie_prod']."</a></td>
	<td width=\"20%\" align=\"center\">".$impcons['tipo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['produto']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['marca']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['modelo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['count']."</td></tr>";}
	}
	echo "</table>";
}//verifica5
if($verifica==6)
{
	$sqlconsrein="select os_numserie_prod, tipo, produto, marca, modelo, count(*) from vw_os where cod_marca='".$marca."' and cod_produto='".$produto."'
group by os_numserie_prod, tipo, produto, marca, modelo order by os_numserie_prod;";
	$rscons=pg_query($conexao,$sqlconsrein);
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
	echo "<th>Quantidade</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
	if($impcons['count']>1)
	{
	echo "<tr>
	<td width=\"20%\" align=\"center\" id=\"cod\">
	<a href=\"../imprime/imprimeReincind.php?numserie=".$impcons['os_numserie_prod']."\">
	".$impcons['os_numserie_prod']."</a></td>
	<td width=\"20%\" align=\"center\">".$impcons['tipo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['produto']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['marca']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['modelo']."</td>
	<td width=\"20%\" align=\"center\">".$impcons['count']."</td></tr>";}
	}
	echo "</table>";
}//verifica6


 pg_close($conexao);
?>
<body>
</body>
</html>