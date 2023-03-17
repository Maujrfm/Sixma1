<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery-1.6.4.js"></script>
   
    <script type="text/javascript">
   function cancelar(){
	window.setTimeout("location.href='consultaAltera.php';",1)
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
$cod=$_GET['codigo'];
include 'conexao.inc.php';

$sqlalt="select * from vw_os where cod_os=".$cod.";";
$rsalt = pg_query($conexao,$sqlalt);
$altos=pg_fetch_array($rsalt);

$sqltiporeg="select * from tb_tipo_reg ;";
$rstiporeg= pg_query($conexao,$sqltiporeg);


$sqlreg="select * from vw_registro where cod_os=".$cod.";";
$rsreg = pg_query($conexao,$sqlreg);


?>
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
if($_SESSION['permissao']==2)
{
 ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="" align="center" width="20%"><img src="img/Logo.png" width="203" height="101" alt="Sixma" /></td>
    <td align="center" bgcolor="" width="60%"><h1> Alterar OS </h1></td>
    <td align="center" bgcolor="" width="20%">
    <form name="form_relogio">
        <input type="text" name="relogio" size="10" style="background-color : Black; color : lightGreen; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_relogio.relogio.blur()">
      </form></td></tr>
  	<tr>
    <td valign="top" align="center" width="20%"><ul id="menu">
        <li><a href="consultaAltera.php" 	title="Voltar" > <img src="img/bt_voltar.png" width="117" height="39"  /> </a></li>
        <li><a href="index.php" 		title="sair"  > <img src="img/bt_sair.png" width="117" height="39"  /> </a></li>
      </ul></td>
    <td bgcolor="#73B9FF" height="100%" width="60%" valign="top" align="left">
    <form name="Sixmareg" action="alterarReg.php" method="post" >
    <table width="100%"  border="">
    <tr>
    <td align="center" colspan="3"><h4>Dados da OS</h4></td>
    <td><input type="text" name="cod_os" style="text-align:center" value="<?php echo $altos['cod_os'] ?>" disabled>
    <input type="hidden" name="cod_osh" value="<?php echo $altos['cod_os'] ?>">
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
    <td><input type="hidden" name="modelo" value="<?php echo $altos['cod_modelo'] ?>" />
	<?php echo $altos['modelo']?></td>
    <th>NS.: </th>
    <td><input type="hidden" name="numserie" value="<?php echo $altos['os_numserie_prod'] ?>" />
	<?php echo $altos['os_numserie_prod']?></td></tr>	
    <tr>
    <th colspan="4">Problema:</th></tr>
    <tr>
    <td colspan="4" align="center"><?php echo $altos['os_problema']?></td></tr>
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
    <tr>
    <th colspan="4">Obs.:</th></tr>
    <tr>
    <td colspan="4" align="center"><?php echo $altos['os_obs']?></td></tr>
    <tr>
    <th colspan="4">Registros</th></tr>    
    <tr>
    <td colspan="4">
	<?php 
	while($lireg=pg_fetch_array($rsreg))
	{
	$data=$lireg['reg_data'];
	echo "<table border=\"1\" width=\"100%\">";
    echo "<tr>";
    echo "<th>Tipo do Registro:</th>";
	echo "<td>".$lireg['tipo']."</td>";
	echo "<th>Codigo da OS:</th>";
	echo "<td>".$lireg['cod_os']."</td></tr>";
    echo "<tr><th colspan=\"4\" align=\"center\">Descrição:</th></tr>";
	echo "<tr><td colspan=\"4\" align=\"center\">".$lireg['descricao']."</td></tr>";
    echo "<tr><th>Data do Registro:</th>";
	echo "<td>".date('d/m/Y',strtotime($data))."</td>";
	echo "<th>Responsável:</th>";
	echo "<td>".$lireg['funcionario']."</td></tr>";
	echo "</table>";
	}
	?> </td></tr>  
    <tr>
    <th colspan="2">Tipo do Registro</th>
    <td colspan="2">
    <select name="tipo_reg" size="1" >
    <option name="tipo_reg" id="tipo_reg" selected="selected"></option>
    <?php 
	while($tireg=pg_fetch_array($rstiporeg))
	{
	echo "<option value=\"".$tireg['cod_tipo_reg']."\">".$tireg['tipo_reg_descricao']."</option>";	
	}
	?>     
    </select></td></tr>
    <tr>
    <th colspan="4">Descrição</th></tr>
    <tr>
    <td colspan="4" align="center">
    <textarea name="reg_descricao" id="reg_descricao" style="width:90%"  rows="4" maxlength="5000" > </textarea></td></tr>
    <tr>
    <td colspan="2" align="right" width="50%">
   	<input type="submit" id="btfi" value="Finalizar" ></td>
   	<td colspan="2" width="50%">
   	<input type="button" onclick="cancelar()" value="Cancelar"></td></tr>
    </table></form>
    </tr>
</table>
</body>
<?php
}
 else
 {
	 
	 echo "<script> alert('Por favor Faça Login'); 
	 	window.location='index.php';  
		</script> \n";
		
 }

 ?>
</html>