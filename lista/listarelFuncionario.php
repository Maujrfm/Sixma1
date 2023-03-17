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
$funcionario=$_GET['funcionario'];
$operacao=$_GET['operacao'];



if($dataini!=""&&$funcionario!="")
{
	$valida=1;
	$sqlnomefun="select fun_nome from tb_funcionario where cod_funcionario='".$funcionario."' ;";
	$rsnomefun=pg_query($conexao,$sqlnomefun);
	$impnomefun=pg_fetch_array($rsnomefun);
	$nome=$impnomefun['fun_nome'];
	if($datafim!="")
	{	
		$valida=2;
		if($operacao!="")
		{	
		$valida=4;
		}//operacao completo
	}//datafim sem operacao
	elseif($operacao!="")
	{	
	$valida=3;
	}//operacaosem dt fim
}//dataini
if($valida==1)
{
	$contope=0;
	$sqlconsfun="select cod_tipo_reg,tipo,count(*) from vw_registro where cod_funcionario='".$funcionario."' and reg_data>='".$dataini."' group by tipo,cod_tipo_reg order by cod_tipo_reg  ;";
	$rscons=pg_query($conexao,$sqlconsfun);
    echo "<table border=\"1\" width=\"100%\" >";
	echo "<thead class=\"imprimir\"><tr>";
	echo "<th align=\"center\" valign=\"middle\" colspan=\"5\" width=\"10%\">
	<img src=\"../img/Logo.png\" width=\"203\" height=\"101\" alt=\"Sixma\"  style=\"float: left;\"/>
	<br><h1> Relatório do Colaborador: <br> ".$nome."  </h1></th></tr></thead>";
    echo "<tr>";
    echo "<th width=\"75%\" align=\"center\">Tipo de Registro</th>";
    echo "<th width=\"25%\" align=\"center\">Quantidade</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
	echo "<tr>
	<td width=\"75%\" align=\"center\" id=\"cod\">
	".$impcons['tipo']."</td>
	<td width=\"25%\" align=\"center\">".$impcons['count']."</td>
	</tr>";
	$contope=$contope+$impcons['count'];
	}
	echo "<tr><th align=\"center\">Total de Operações realizadas</th><th align=\"center\">".$contope."</th>";
	echo "</table>";

}//valida1
elseif($valida==2)
{
	$contope=0;
	$sqlconsfun="select cod_tipo_reg,tipo,count(*) from vw_registro where cod_funcionario='".$funcionario."' and reg_data>='".$dataini."' and reg_data<='".$datafim."' group by tipo,cod_tipo_reg order by cod_tipo_reg  ;";
	$rscons=pg_query($conexao,$sqlconsfun);
    echo "<table border=\"1\" width=\"100%\" >";
	echo "<thead class=\"imprimir\"><tr>";
	echo "<th align=\"center\" valign=\"middle\" colspan=\"5\" width=\"10%\">
	<img src=\"../img/Logo.png\" width=\"203\" height=\"101\" alt=\"Sixma\"  style=\"float: left;\"/>
	<br><h1> Relatório do Colaborador: <br> ".$nome."  </h1></th></tr></thead>";
    echo "<tr>";
    echo "<th width=\"75%\" align=\"center\">Tipo de Registro</th>";
    echo "<th width=\"25%\" align=\"center\">Quantidade</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
	echo "<tr>
	<td width=\"75%\" align=\"center\" id=\"cod\">
	".$impcons['tipo']."</td>
	<td width=\"25%\" align=\"center\">".$impcons['count']."</td>
	</tr>";
	$contope=$contope+$impcons['count'];
	}
	echo "<tr><th align=\"center\">Total de Operações realizadas</th><th align=\"center\">".$contope."</th>";
	echo "</table>";

}//valida2
elseif($valida==3)
{
	$sqlconsfun="select cod_os,tipo,reg_data from vw_registro where cod_funcionario='".$funcionario."' and cod_tipo_reg='".$operacao."' and reg_data>='".$dataini."' order by cod_tipo_reg asc, cod_os desc ; ";
	$rscons=pg_query($conexao,$sqlconsfun);
    echo "<table border=\"1\" width=\"100%\" >";
	echo "<thead class=\"imprimir\"><tr>";
	echo "<th align=\"center\" valign=\"middle\" colspan=\"5\" width=\"10%\">
	<img src=\"../img/Logo.png\" width=\"203\" height=\"101\" alt=\"Sixma\"  style=\"float: left;\"/>
	<br><h1> Relatório do Colaborador: <br> ".$nome."  </h1></th></tr></thead>";
    echo "<tr>";
    echo "<th width=\"20%\">Codigo da OS</th>";
    echo "<th width=\"60%\">Tipo</th>";
    echo "<th width=\"20%\">Data</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
		$data=$impcons['reg_data'];
	echo "<tr>
	<td width=\"20%\" align=\"center\" id=\"cod\">
	".$impcons['cod_os']."</td>
	<td width=\"60%\" align=\"center\">".$impcons['tipo']."</td>
	<td width=\"20%\" align=\"center\">".date('d/m/Y',strtotime($data))."</td>
	</tr>";
	}
	echo "</table>";

}//valida3
elseif($valida==4)
{
	$sqlconsfun="select cod_os,tipo,reg_data from vw_registro where cod_funcionario='".$funcionario."' and cod_tipo_reg='".$operacao."' and reg_data>='".$dataini."' and reg_data<='".$datafim."' order by cod_tipo_reg asc, cod_os desc ; ";
	$rscons=pg_query($conexao,$sqlconsfun);
    echo "<table border=\"1\" width=\"100%\" >";
	echo "<thead class=\"imprimir\"><tr>";
	echo "<th align=\"center\" valign=\"middle\" colspan=\"5\" width=\"10%\">
	<img src=\"../img/Logo.png\" width=\"203\" height=\"101\" alt=\"Sixma\"  style=\"float: left;\"/>
	<br><h1> Relatório do Colaborador: <br> ".$nome."  </h1></th></tr></thead>";
    echo "<tr>";
    echo "<th width=\"20%\">Codigo da OS</th>";
    echo "<th width=\"60%\">Tipo</th>";
    echo "<th width=\"20%\">Data</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
		$data=$impcons['reg_data'];
	echo "<tr>
	<td width=\"20%\" align=\"center\" id=\"cod\">
	".$impcons['cod_os']."</td>
	<td width=\"60%\" align=\"center\">".$impcons['tipo']."</td>
	<td width=\"20%\" align=\"center\">".date('d/m/Y',strtotime($data))."</td>
	</tr>";
	}
	echo "</table>";

}//valida4

else
{
	if($funcionario=="")
	{
	echo "<script> alert('Selecione um Funcionario'); </script>";
	}
	else
	{
	echo "<script> alert('Selecione uma data inicial'); </script>";
	}
}

 pg_close($conexao);
?>
<body>
</body>
</html>