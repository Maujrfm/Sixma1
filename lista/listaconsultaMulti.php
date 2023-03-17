<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../inc/jquery-1.6.4.js"></script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#btfil').click(function(){
             $('#list').load('../lista/listaConsulta.php?codos='+$('#cod_os').val()+'&cliente='+$('#cli').val());
       });
    });
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

$cod_os=null;
$des_cli=null;


include '../inc/conexao.inc.php';

$sqlcli="select * from vw_clientes";
$rscli = pg_query($conexao,$sqlcli);



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

$cod_cli=$_GET['codigo'];

$str_conexao = 'dbname=bd_sixma port=5432 user=postgres password=admin';
		if(!($conexao=pg_connect($str_conexao))){
	echo 'Caso esta mensagem seja exibida Ligue 9225-7108';
	exit;
}

	$sqlconscli="select * from vw_os where cod_cliente=".$cod_cli." order by os_data desc,cod_os asc  ;";
	$rscons=pg_query($conexao,$sqlconscli);


session_start();
if(isset($_SESSION['login']))
{
 ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="" align="center" width="20%"><img src="../img/Logo.png" width="203" height="101" alt="Sixma" /></td>
    <td align="center" bgcolor="" width="60%"><h1> Consulta Mult OS </h1></td>
    <td align="center" bgcolor="" width="20%"><form name="form_relogio">
        <input type="text" name="relogio" size="10" style="background-color : Black; color : lightGreen; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_relogio.relogio.blur()">
      </form></td>
  </tr>
  <tr>
    <td valign="top" align="center" width="20%"><ul id="menu">
        <li><a href="../inicio.php" 	title="Voltar" > <img src="../img/bt_voltar.png" width="117" height="39"  /> </a></li>
        <li><a href="../index.php" 		title="sair"  > <img src="../img/bt_sair.png" width="117" height="39"  /> </a></li>
      </ul></td>
    <td bgcolor="#73B9FF" height="100%" width="60%" valign="top" align="left">
<?php    
	echo "<form method=\"post\" action=\"../devolve/devolvemultOS.php\">";
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
		
		$sqlconsbt="select cod_tipo_reg from tb_os where cod_os='".$impcons['cod_os']."';";
		$rsconsbt=pg_query($conexao,$sqlconsbt);
		$impbt=pg_fetch_array($rsconsbt);
		$validbt=$impbt['cod_tipo_reg'];
		$data=$impcons['os_data'];
		if($validbt==5)
		{
		echo "<tr><td align=\"center\" id=\"cod\">".$impcons['cod_os']."</td>";
		echo "<td align=\"center\">".$impcons['cliente']."</td><td align=\"center\">".date('d/m/Y',strtotime($data))."</td>";
		echo "<td align=\"center\">".$impcons['marca']."</td>";
		echo "<td align=\"center\">".$impcons['modelo']."</td>";
		echo "<td align=\"center\">";
		echo "<input type=\"checkbox\" name=\"check[]\" value=".$impcons['cod_os'].">";
		echo "</td></tr>";
		}//if($validbt==5)
	}//while$sqlconsbt="select max (cod_tipo_reg) from tb_registro where cod_os='".$impcons['cod_os']."';";
		echo "<tr><td align=\"right\" colspan=\"6\"><input type=\"submit\" value=\"Devolver\">";
		echo "<input type=\"hidden\" name=\"cli_bkp\" value=".$cod_cli.">";
		echo "</table></form>";
?>  
    </td>
    <td bgcolor="" valign="top" width="20%"></td>
  </tr>
</table>
<?php 
pg_close($conexao);
?>
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