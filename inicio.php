<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
session_start();
if(isset($_SESSION['login']))
{
 ?>
<title>Sixma</title>
<?php 

		$totret=0;
		$totemt=0;
include 'inc/conexao.inc.php';		
	
		
		
		
		
		
		
?>
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
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="" align="center" width="20%"><img src="img/Logo.png" width="203" height="101" alt="Sixma" /></td>
    <td bgcolor="">Olá, <?php echo $_SESSION['apelido'] ?></td>
    <td align="center" bgcolor="" width="20%"><form name="form_relogio">
        <input type="text" name="relogio" size="10" style="background-color : Black; color : lightGreen; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_relogio.relogio.blur()">
      </form></td>
  </tr>
  <tr>
    <td valign="top" align="center"><ul id="menu">
      <li><a href="paginas/cadastro.php" title="cadastro"> <img src="img/bt_cadastro.png" width="117" height="39"  /> </a></li>
      <li><a href="paginas/consulta.php" 	title="consultar"> <img src="img/bt_consultar_os.png" width="117" height="39"  /> </a></li>
      <li><a href="paginas/equipBkp.php" title="equipamento de backup"> <img src="img/bt_equip_backup.png" width="117" height="39"  /> </a></li>
      <?php
      if($_SESSION['permissao']==2)
	  {
		 echo"<li><a href=\"paginas\administrativo.php\" 	title=\"administracao\" > <img src=\"img/bt_admin.png\" width=\"117\" height=\"39\"  /> </a></li>";
	  }
	  ?>
      <li><a href="index.php" 	title="sair" > <img src="img/bt_sair.png" width="117" height="39"  /> </a></li>
      </ul></td>
    <td bgcolor="#73B9FF" width="60%" valign="top"><h2 align="center" >Retorno de Manutenção</h2>
      <br />
      <div id=texto>
        <?php 
	
$sqlconscli="select * from vw_inicio where cod_tipo_reg=5;";
	$rscons=pg_query($conexao,$sqlconscli);	
	$validmt=pg_num_rows($rscons);
	if($validmt!=0)
	{	
	echo "<table border=\"1\" width=\"100%\">";
    echo "<tr>";
    echo "<th>Quantidade de OS</th>";
    echo "<th>Cliente</th>";
    echo "<th>Telefone</th>";
	echo "<th>Opção</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
		
		echo "<tr><td align=\"center\" >".$impcons['quantidade']."</td>";
		echo "<td align=\"center\">".$impcons['nome']."</td>";
		echo "<td align=\"center\">".$impcons['telefone']."</td>";
		echo "<td align=\"center\"><a href=\"/lista/listaconsultaMulti.php?codigo=".$impcons['cod_cliente']."\"><input type=\"button\" value=\"Obter detalhes\"></a></td></tr>";
		$totret=$totret+$impcons['quantidade'];
	}//while
		echo "</table>";
	}

?>
      </div>
      <hr color="#4DA6FF" />
      <h2 align="center">Em Manutenção<br />
      </h2>
      <div id=texto> 
	  <?php
	   $totemt=0;
	  $sqlconsclimt="select * from vw_inicio where cod_tipo_reg<5;";
	$rsconsmt=pg_query($conexao,$sqlconsclimt);	
	$validem=pg_num_rows($rsconsmt);
	if($validem!=0)
	{	
	echo "<table border=\"1\" width=\"100%\">";
    echo "<tr>";
    echo "<th>Quantidade de OS</th>";
    echo "<th>Cliente</th>";
    echo "<th>Telefone</th>";
    echo "</tr>";
	while($impconsmt=pg_fetch_array($rsconsmt))
	{
		
		echo "<tr><td align=\"center\" >".$impconsmt['quantidade']."</td>";
		echo "<td align=\"center\">".$impconsmt['nome']."</td>";
		echo "<td align=\"center\">".$impconsmt['telefone']."</td>";
		echo "</tr>";
		$totemt=$totemt+$impconsmt['quantidade'];
	}//while
		echo "</table>";
	}
	    ?> </div></td>
    <td bgcolor="" valign="top"><div id="fonte" align="center"> Totais de<br />
        Produtos Retornados:</div>
      <div id="fonte2"> <?php echo " "; echo $totret; ?></div>
      <br />
      <div id="fonte">Produtos em Manutenção:</div>
      <div id="fonte2"> <?php echo " "; echo $totemt; ?> <br />
      </div></td>
  </tr>
</table>
</body>
<!--#73B9FF
	#4DA6FF
    #imgpos {
	position: absolute;
	left: 240px;
	top: 173px;
	margin-left: -245px;
	margin-top: -172px;
}
#imgpos1{
	position:absolute;
	left:510px;
	right: 200px;
	top:265px;
	margin-left:-245px;
	margin-top: -172px;
}
#imgpos2{
	position:absolute;
	right: 5px;
	left: 1450px;
	top:210px;
	margin-left:-245px;
	margin-top: -172px;
}
    <td bgcolor=""> </td>
    <td align="center" bgcolor=""><form name="form_relogio"> 
<input type="text" name="relogio" size="10" style="background-color : Black; color : lightGreen; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_relogio.relogio.blur()"> 
</form> </td>
    -->
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