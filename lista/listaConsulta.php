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
	$sqlconscli="select * from vw_os where cod_cliente=".$cliente." order by os_data desc,cod_os desc ;";
	$rscons=pg_query($conexao,$sqlconscli);
	$verifica=1;
}
elseif($codos!="")
{
	$sqlconscod="select * from vw_os where cod_os=".$codos.";";
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
	echo "<th>Opção</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
		$sqlconsbt="select max (cod_tipo_reg) from tb_registro where cod_os='".$impcons['cod_os']."';";
		$rsconsbt=pg_query($conexao,$sqlconsbt);
		$impbt=pg_fetch_array($rsconsbt);
		$validbt=$impbt['max'];
		$data=$impcons['os_data'];
		if($validbt<6)
		{
		echo "<tr><td align=\"center\" id=\"cod\"><a href=\"../imprime/reimprimeOs.php?codigo=".$impcons['cod_os']."\">".$impcons['cod_os']."</a></td><td align=\"center\">".$impcons['cliente']."</td><td align=\"center\">".date('d/m/Y',strtotime($data))."</td><td align=\"center\">".$impcons['marca']."</td><td align=\"center\">".$impcons['modelo']."</td><td align=\"center\">";
			if($validbt==5)
			{
	 		echo "<a href=\"devolveOs.php?codigo=".$impcons['cod_os']."\"><input type=\"button\" value=\"Devolver\"></a>";
			}
		echo "</td></tr>";
		}
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