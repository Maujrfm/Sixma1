<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../inc/jquery-1.6.4.js"></script>
   
  <script type="text/javascript">
   function imprimir(){
    window.print() 
	window.setTimeout("location.href='../relatorios/relReincidencia.php';",1)
    }
    </script> 
<script type="text/javascript">
   function cancelar(){
	window.setTimeout("location.href='../relatorios/relReincidencia.php';",1)
    }
    </script> 
    
<script language="JavaScript"> 
function moveRelogio(){ 
   	momentoAtual = new Date() 
   	hora = momentoAtual.getHours() 
   	minuto = momentoAtual.getMinutes() 
   	segundo = momentoAtual.getSeconds() 

   	str_segundo = new String (segundo) 
   	if (str_segundo.length == 1) 
      	 segundo = "0" + segundo 

   	str_minuto = new String (minuto) 
   	if (str_minuto.length == 1) 
      	 minuto = "0" + minuto 

   	str_hora = new String (hora) 
   	if (str_hora.length == 1) 
      	 hora = "0" + hora 

   	horaImprimible = hora + " : " + minuto + " : " + segundo 

   	document.form_relogio.relogio.value = horaImprimible 

   	setTimeout("moveRelogio()",1000) 
} 
</script>
<title>Sixma</title>
<?php 	
$numserie=$_GET['numserie'];
include '../inc/conexao.inc.php';

$sqlalt="select * from vw_os where os_numserie_prod='".$numserie."';";
$rsalt = pg_query($conexao,$sqlalt);






?>
<style media="print">
.nao_imprimir{display:none}
</style>
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
<body onload="moveRelogio()" bgcolor="#4DA6FF">
<?php 
session_start();
if(isset($_SESSION['login']))
{
 ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
    <td colspan="3">
	<table border="1">
   	<?php
	echo "<thead  class=\"imprimir\"><tr>";
	echo "<th align=\"center\" valign=\"middle\" colspan=\"6\" width=\"10%\">
	<img src=\"../img/Logo.png\" width=\"203\" height=\"101\" alt=\"Sixma\"  style=\"float: left;\"/>
	<br><h1> Relatório de OS </h1><p align=\"right\">".date('d/m/Y')."</p></th></tr></thead>";

    ?></table></td></tr>
  <tr class="nao_imprimir">
    <td bgcolor="" align="center" width="20%"><img src="../img/Logo.png" width="203" height="101" alt="Sixma" /></td>
    <td align="center" bgcolor="" width="60%"><h1> Reincidencia de Produto </h1></td>
    <td align="center" bgcolor="" width="20%">
    <form name="form_relogio">
        <input type="text" name="relogio" size="10" style="background-color : Black; color : lightGreen; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_relogio.relogio.blur()">
      </form></td></tr>
  	<tr>
    <td valign="top" align="center" width="20%" class="nao_imprimir">
    <ul id="menu">
        <li><a href="../relatorios/relReincidencia.php" 	title="Voltar" > <img src="../img/bt_voltar.png" width="117" height="39"  /> </a></li>
        <li><a href="../index.php" 		title="sair"  > <img src="../img/bt_sair.png" width="117" height="39"  /> </a></li>
      </ul></td>
    <td bgcolor="#73B9FF" height="100%" width="60%" valign="top" align="left">
<?php    while($altos=pg_fetch_array($rsalt))
{
	$cod=$altos['cod_os'];
$sqlreg="select * from vw_registro where cod_os=".$cod." and cod_tipo_reg='5';";
$rsreg = pg_query($conexao,$sqlreg);?>
    <table width="100%"  border="">
    <tr>
    <td align="center" colspan="3"><h4>Dados da OS</h4></td>
    <td align="center">
	<input type="text" name="cod_os" style="text-align:center" value="<?php echo $altos['cod_os'] ?>" disabled>
	<br />
	<?php 
	$data_os=$altos['os_data'];
	
	echo date('d/m/Y',strtotime($data_os))
	
	?>
    </td></tr>
    <tr>
    <th>Cliente:</th>
    <td><?php echo $altos['cliente']?></td>
    <th>Tipo do Equipamento: </th>
    <td><?php echo $altos['tipo']?></td></tr>
    <tr>
    <th>Produto:</th>
    <td><?php echo $altos['produto']?></td>
    <th>Marca: </th>
    <td><?php echo $altos['marca']?></td></tr>
    <tr>
   	<th>Modelo:</th>
    <td>
	<?php echo $altos['modelo']?></td>
    <th>NS.: </th>
    <td>
	<?php echo $altos['os_numserie_prod']?></td></tr>	
    <tr>
    <th colspan="4">Problema:</th></tr>
    <tr>
    <td colspan="4" align="center">
	<?php echo $altos['os_problema']?></td></tr>
    <tr>
   	<th>Situação:</th>
    <td><?php echo $altos['situacao']; $codsit=$altos['situacao'];?></td>
    <?php 
	if($codsit=="Trocado")
	{
		echo "<th> NS. Troca:</th>";
		echo "<td align=\"center\"> ".$altos['os_ns_prod_troca']."</td>";
	}
	?></tr> 
	<?php 
	while($lireg=pg_fetch_array($rsreg))
	{
	$data=$lireg['reg_data'];
	$solucao=strtoupper($lireg['descricao']);
    echo "<tr>
	<th colspan=\"4\" align=\"center\">Solução:</th></tr>";
	echo "<tr>
	<td colspan=\"4\" align=\"center\">".$solucao."</td></tr>";
    echo "<tr><th>Data do Registro:</th>";
	echo "<td>".date('d/m/Y',strtotime($data))."</td>";
	echo "<th>Responsável:</th>";
	echo "<td>".$lireg['funcionario']."</td></tr>";
	}//while solucao
}//while dados?>  
    <tr>
    <td colspan="4" align="right" class="nao_imprimir">
    <input type="button" onclick="cancelar()" value="Cancelar">
    <input type="button" onclick="imprimir()" value="Imprimir"></td></tr></table>
    </td>
    </tr>
</table>
</body>
<?php

}

 else
 {
	 
	 echo "<script> alert('Por favor Faça Login'); 
	 	window.location='../index.php';  
		</script> \n";
		
 }

 ?>
</html>