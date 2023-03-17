<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sixma</title>
</head>
<?php
include '../inc/conexao.inc.php';
	$verifica=0;
 	$tipo=$_GET['tipo'];
	$produto=$_GET['produto'];
 	$marca=$_GET['marca'];
	$modelo=$_GET['modelo'];
if($tipo!="")
{
	$verifica=1;
	if($produto!="")
	{
		$verifica=2;
		if($marca!="")
		{
			$verifica=3;
			if($modelo!="")
			{
				$verifica=4;
			}//if(modelo)
		}//if(marca)
	}//if(produto)
}//if(tipo)
elseif($marca!="")
		{
		$sqlbkp="select * from vw_backup where cod_marca='".$marca."';";
	$rsbkp=pg_query($conexao,$sqlbkp);

	echo "<table border=\"1\" width=\"100%\">";
    echo "<tr>";
    echo "<th>Tipo</th>";
    echo "<th>Produto</th>";
    echo "<th>Marca</th>";
    echo "<th>Modelo</th>";
    echo "<th>Quantidade</th>";
    echo "</tr>";
	while($impbkp=pg_fetch_array($rsbkp))
	{
	
	echo "<tr><td align=\"center\">".$impbkp['tipo_descricao']."</td>";
	echo "<td align=\"center\">".$impbkp['produto']."</td>";
	echo "<td align=\"center\">".$impbkp['marca']."</td>";
	echo "<td align=\"center\">".$impbkp['modelo']."</td>";
	echo "<td align=\"center\">".$impbkp['quantidade']."</td></tr>";
	}
		}//elseifmarca

else
{
	$sqlbkp="select * from vw_backup";
	$rsbkp=pg_query($conexao,$sqlbkp);

	echo "<table border=\"1\" width=\"100%\">";
    echo "<tr>";
    echo "<th>Tipo</th>";
    echo "<th>Produto</th>";
    echo "<th>Marca</th>";
    echo "<th>Modelo</th>";
    echo "<th>Quantidade</th>";
    echo "</tr>";
	while($impbkp=pg_fetch_array($rsbkp))
	{
	
	echo "<tr><td align=\"center\">".$impbkp['tipo_descricao']."</td>";
	echo "<td align=\"center\">".$impbkp['produto']."</td>";
	echo "<td align=\"center\">".$impbkp['marca']."</td>";
	echo "<td align=\"center\">".$impbkp['modelo']."</td>";
	echo "<td align=\"center\">".$impbkp['quantidade']."</td></tr>";
	}
}//else
if($verifica==1)
{
	$sqlbkp="select * from vw_backup where cod_tipo='".$tipo."';";
	$rsbkp=pg_query($conexao,$sqlbkp);

	echo "<table border=\"1\" width=\"100%\">";
    echo "<tr>";
    echo "<th>Tipo</th>";
    echo "<th>Produto</th>";
    echo "<th>Marca</th>";
    echo "<th>Modelo</th>";
    echo "<th>Quantidade</th>";
    echo "</tr>";
	while($impbkp=pg_fetch_array($rsbkp))
	{
	
	echo "<tr><td align=\"center\">".$impbkp['tipo_descricao']."</td>";
	echo "<td align=\"center\">".$impbkp['produto']."</td>";
	echo "<td align=\"center\">".$impbkp['marca']."</td>";
	echo "<td align=\"center\">".$impbkp['modelo']."</td>";
	echo "<td align=\"center\">".$impbkp['quantidade']."</td></tr>";
	}
	
	
}//verifica=1

elseif($verifica==2)
{
	$sqlbkp="select * from vw_backup where cod_tipo='".$tipo."'and cod_produto='".$produto."';";
	$rsbkp=pg_query($conexao,$sqlbkp);

	echo "<table border=\"1\" width=\"100%\">";
    echo "<tr>";
    echo "<th>Tipo</th>";
    echo "<th>Produto</th>";
    echo "<th>Marca</th>";
    echo "<th>Modelo</th>";
    echo "<th>Quantidade</th>";
    echo "</tr>";
	while($impbkp=pg_fetch_array($rsbkp))
	{
	
	echo "<tr><td align=\"center\">".$impbkp['tipo_descricao']."</td>";
	echo "<td align=\"center\">".$impbkp['produto']."</td>";
	echo "<td align=\"center\">".$impbkp['marca']."</td>";
	echo "<td align=\"center\">".$impbkp['modelo']."</td>";
	echo "<td align=\"center\">".$impbkp['quantidade']."</td></tr>";
	}
	
	
}//verifica=2

if($verifica==3)
{
	$sqlbkp="select * from vw_backup where cod_marca='".$marca."'and cod_produto='".$produto."';";
	$rsbkp=pg_query($conexao,$sqlbkp);

	echo "<table border=\"1\" width=\"100%\">";
    echo "<tr>";
    echo "<th>Tipo</th>";
    echo "<th>Produto</th>";
    echo "<th>Marca</th>";
    echo "<th>Modelo</th>";
    echo "<th>Quantidade</th>";
    echo "</tr>";
	while($impbkp=pg_fetch_array($rsbkp))
	{
	
	echo "<tr><td align=\"center\">".$impbkp['tipo_descricao']."</td>";
	echo "<td align=\"center\">".$impbkp['produto']."</td>";
	echo "<td align=\"center\">".$impbkp['marca']."</td>";
	echo "<td align=\"center\">".$impbkp['modelo']."</td>";
	echo "<td align=\"center\">".$impbkp['quantidade']."</td></tr>";
	}
	
	
}//verifica=3

if($verifica==4)
{
	$sqlbkp="select * from vw_backup where cod_modelo='".$modelo."';";
	$rsbkp=pg_query($conexao,$sqlbkp);

	echo "<table border=\"1\" width=\"100%\">";
    echo "<tr>";
    echo "<th>Tipo</th>";
    echo "<th>Produto</th>";
    echo "<th>Marca</th>";
    echo "<th>Modelo</th>";
    echo "<th>Quantidade</th>";
    echo "</tr>";
	while($impbkp=pg_fetch_array($rsbkp))
	{
	
	echo "<tr><td align=\"center\">".$impbkp['tipo_descricao']."</td>";
	echo "<td align=\"center\">".$impbkp['produto']."</td>";
	echo "<td align=\"center\">".$impbkp['marca']."</td>";
	echo "<td align=\"center\">".$impbkp['modelo']."</td>";
	echo "<td align=\"center\">".$impbkp['quantidade']."</td></tr>";
	}
	
	
}//verifica=4


 pg_close($conexao);
?>
<body>
</body>
</html>