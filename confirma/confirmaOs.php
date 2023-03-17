<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style media="print">
.nao_imprimir{display:none}

</style>
    <script type="text/javascript">
   function cancelar(){
	window.setTimeout("location.href='../cadastro.php';",1)
    }
    </script>

<script type="text/javascript">
   function imprimir(){
    window.print()
    }
    </script>
<title>Sixma</title>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['login']))
{

include '../inc/conexao.inc.php';

	$textoreincid=null;
	$codmod=$_POST['mod'];
	$codsit=$_POST['sit'];
	$codfun=$_SESSION['codfun'];
	$codcli=$_POST['cli'];
	$ns=strtoupper($_POST['ns']);
	$obs=$_POST['obs'];
	$problema=$_POST['problema'];
	$desproblema=strtoupper($_POST['desprob']);
	if($codsit==1)
	{
	$nst=$_POST['nst'];
	$sqlnst="select * from tb_backup where cod_backup=".$nst.";";
	$rsnst = pg_query($conexao,$sqlnst);
	$visunst=pg_fetch_array($rsnst);
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

$sqlequip="select * from vw_modelo where cod_modelo=".$codmod." ;";
$rsequip = pg_query($conexao,$sqlequip);
$visuequip=pg_fetch_array($rsequip);

$sqlsit="select * from tb_situacao where cod_situacao=".$codsit.";";
$rssit = pg_query($conexao,$sqlsit);
$visusit=pg_fetch_array($rssit);

$sqlreincid="select os_numserie_prod from tb_os where os_numserie_prod='".$ns."' and cod_modelo='".$codmod."';";
$rsreincid=pg_query($conexao,$sqlreincid);
$testreincid=pg_num_rows($rsreincid);
if($testreincid>0)
{
		 echo "<script> 
		 alert('Este produto ja passou por reparos!'); 
	 	</script> \n";
		$textoreincid="PRODUTO REINCIDENTE - ";
}





?>
<form name="teste" method="post" action="../imprime/imprimeOs.php" >
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="" align="center" width="20%"><img src="../img/Logo.png" width="203" height="101" alt="Sixma" /></td>
    <td colspan="2" align="center" valign="middle">
    <h2>Registro de OS<br></h2>
    Castseg Campo Grande - MS
    </td>
    <td align="center">
    </td>
    </tr>
    <tr>
    <th align="right">Cliente:  </th>
    <td colspan="3" align="center">
    <input type="hidden" name="cli" value="<?php echo $codcli ?>">
	<?php echo $visucli['nome']?></td>
    </tr>
    <tr>
    <th colspan="4">Equipamento 
    <input type="hidden" name="obs" value="<?php echo $obs ?>">
    </th></tr>
    <tr>
    <th align="right">Produto:  </th>
    <td align="center"><?php echo $visuequip['produto']?></td>
    <th align="right" width="10%">Marca:  </th>
    <td align="center"><?php echo $visuequip['marca']?></td></tr>
    <tr>
    <th align="right">Modelo:  </th>
    <td colspan="3" align="center">
    <input type="hidden" name="mod" value="<?php echo $codmod ?>">
	<?php echo $visuequip['modelo']?></td></tr>
    <tr>
    <th align="right">NS.:  </th>
    <td colspan="3" align="center">
    <input type="hidden" name="ns" value="<?php echo $ns ?>">
	<?php echo $ns ?></td></tr>
    <tr>
    <th colspan="4">Problema</th></tr>
    <tr>
    <td colspan="4" align="center">
	<input type="hidden" name="txtreincid" value="<?php echo $textoreincid ?>"><input type="hidden" name="prob" value="<?php echo $problema ?>"><input type="hidden" name="desprob" value="<?php echo $desproblema ?>">
	<?php echo $textoreincid.$visuprob['prob_descricao']." - ".$desproblema?></td></tr>
    <tr>
    <th align="right">Situação:  </th>
    <td align="center">
	<input type="hidden" name="sit" value="<?php echo $codsit ?>">
	<?php echo $visusit['sit_descricao']?></td>
    <?php 
	if($codsit==1)
	{
		echo "<th> NS. Troca:</th>";
		echo "<td align=\"center\"> ".$visunst['bkp_num_serie']."</td>";
		echo "<input type=\"hidden\" name=\"nst\" value=\"".$visunst['bkp_num_serie']."\">";
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
    <table width="100%" border="0" class="nao_imprimir">
    <tr>
    <td align="right"><input type="submit" value="Confirmar" ></td>
    <td><input type="button" onclick="cancelar()" value="Cancelar"></td></tr>
    </table></form>
 
</body>
<?php   pg_close($conexao); 
 }
 else
 {
	 
	 echo "<script> alert('Por favor Faça Login'); 
	 	window.location='../index.php';  
		</script> \n";
		
 }
 ?>
</html>