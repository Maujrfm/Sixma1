<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style media="print">
.nao_imprimir{display:none}

</style>

<script type="text/javascript">
   function imprimir(){
    window.print() 
	window.setTimeout("location.href='../paginas/cadastro.php';",1)
    }
    </script>
<title>Sixma</title>
</head>
<body onLoad="imprimir()">
<?php
include '../inc/conexao.inc.php';


	session_start();
	$codmod=$_POST['mod'];
	$codsit=$_POST['sit'];
	$codfun=$_SESSION['codfun'];
	$codcli=$_POST['cli'];
	$ns=$_POST['ns'];
	$obs=$_POST['obs'];
	$problema=$_POST['prob'];
	$desproblema=$_POST['desprob'];
	$txtreincid=$_POST['txtreincid'];
	if($codsit==1)
	{
	$nst=$_POST['nst'];
	$sqldel="delete from tb_backup where bkp_num_serie='".$nst."';";
	$rsdel=pg_query($conexao,$sqldel);
	
	}
	else
	{
		$nst=null;
	}
	
	$sqlcli="select * from vw_clientes where cod=".$codcli.";";
$rscli = pg_query($conexao,$sqlcli);
$visucli=pg_fetch_array($rscli);

$sqlprob="select prob_descricao from tb_problema where cod_problema='".$problema."';";
$rsprob=pg_query($conexao,$sqlprob);
$visuprob=pg_fetch_array($rsprob);

$txtproblema=$txtreincid.$visuprob['prob_descricao']." - ".$desproblema;

$sqlequip="select * from vw_modelo where cod_modelo=".$codmod." ;";
$rsequip = pg_query($conexao,$sqlequip);
$visuequip=pg_fetch_array($rsequip);

$sqlsit="select * from tb_situacao where cod_situacao=".$codsit.";";
$rssit = pg_query($conexao,$sqlsit);
$visusit=pg_fetch_array($rssit);
	
	
	
	
	
	$sqlinc="insert into tb_os (cod_modelo, cod_situacao, cod_funcionario, cod_cliente, os_numserie_prod, os_problema, os_obs, os_ns_prod_troca,cod_problema) 
values ('".$codmod."','".$codsit."','".$codfun."','".$codcli."','".$ns."','".$txtproblema."','".$obs."','".$nst."','".$problema."');";
$rsinc=pg_query($conexao,$sqlinc);
$validinsos=pg_affected_rows($rsinc);

	
if($validinsos==1)
{
$sqlnumos="select cod_os, os_data from tb_os where cod_os=(select max (cod_os) from tb_os);";
$rsnumos=pg_query($conexao,$sqlnumos);
$impos=pg_fetch_array($rsnumos);
}


 ?>
 <table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="" align="center" width="20%"><img src="../img/Logo.png" width="203" height="101" alt="Sixma" /></td>
    <td colspan="2" align="center" valign="middle">
    <h2>Registro de OS<br></h2>
    Castseg Campo Grande - MS
    </td>
    <td align="center">
    <input type="text" style="text-align:center" value="<?php echo $impos['cod_os'] ?>" disabled><br><?php echo date('d/m/Y',strtotime($impos['os_data']))?>
    </td>
    </tr>
    <tr>
    <th align="right">Cliente:  </th>
    <td colspan="3" align="center">
	<?php echo $visucli['nome']?></td>
    </tr>
    <tr>
    <th colspan="4">Equipamento 
    </th></tr>
    <tr>
    <th align="right">Produto:  </th>
    <td align="center"><?php echo $visuequip['produto']?></td>
    <th align="right" width="10%">Marca:  </th>
    <td align="center"><?php echo $visuequip['marca']?></td></tr>
    <tr>
    <th align="right">Modelo:  </th>
    <td colspan="3" align="center">
	<?php echo $visuequip['modelo']?></td></tr>
    <tr>
    <th align="right">NS.:  </th>
    <td colspan="3" align="center">
 	<?php echo $ns ?></td></tr>
    <tr>
    <th colspan="4">Problema</th></tr>
    <tr>
    <td colspan="4" align="center">
	<?php echo $txtproblema//$visuprob['prob_descricao']." - ".$desproblema?></td></tr>
    <tr>
    <th align="right">Situação:  </th>
    <td align="center">
	<?php echo $visusit['sit_descricao']?></td>
    <?php 
	if($codsit==1)
	{
		echo "<th> NS. Troca:</th>";
		echo "<td align=\"center\"> ".$nst."</td>";

	}
	?>
    </tr>
    <tr>
    <th colspan="4" align="center">
    <table border="1" width="100%">
    <tr>
    <th width="50%" align="center" ><br><br><br><br>________________<br>
	<?php echo $_SESSION['nome'] ?></th>
    <th width="50%" align="center"><br><br><br><br>________________<br>
	<?php echo $visucli['nome'] ?></th></tr></table>
    </th></tr></table>
</body>
<?php  pg_close($conexao); ?>
</html>