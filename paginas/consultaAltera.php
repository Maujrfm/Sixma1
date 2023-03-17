<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="jquery-1.6.4.js"></script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#btfil').click(function(){
             $('#list').load('listaAltera.php?codos='+$('#cod_os').val()+'&cliente='+$('#cli').val());
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


include 'conexao.inc.php';

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
session_start();
if(isset($_SESSION['login']))
{
 ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="" align="center" width="20%"><img src="img/Logo.png" width="203" height="101" alt="Sixma" /></td>
    <td align="center" bgcolor="" width="60%"><h1> Alterar OS </h1></td>
    <td align="center" bgcolor="" width="20%"><form name="form_relogio">
        <input type="text" name="relogio" size="10" style="background-color : Black; color : lightGreen; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_relogio.relogio.blur()">
      </form></td>
  </tr>
  <tr>
    <td valign="top" align="center" width="20%"><ul id="menu">
        <li><a href="administrativo.php" 	title="Voltar" > <img src="img/bt_voltar.png" width="117" height="39"  /> </a></li>
        <li><a href="index.php" 		title="sair"  > <img src="img/bt_sair.png" width="117" height="39"  /> </a></li>
      </ul></td>
    <td bgcolor="#73B9FF" height="100%" width="60%" valign="top" align="left">
    <table width="100%"  border="">
    <tr>
    <td>Codigo da OS:</td>
    <td width="25%">
    <input style="width:13%" name="cod_os" id="cod_os" type="text" size="4" autocomplete="off"/></td></tr>
    <tr>
    <td> Cliente: </td>
    <td width="70%">
    <select style="width:100%" name="cli" id="cli" size="1" >
                <option id="cli" selected="selected"></option>
                <?php 
	while($des_cli=pg_fetch_array($rscli))
	{
	echo "<option id=\"cli\" value=\"".$des_cli['cod']."\">".$des_cli['nome']."</option>";
	}?></select></td></tr>
    <tr>
    <td></td>
    <td align="right">
    <input type="button" value="Filtrar" name="btfil" id="btfil" /></td></tr>
    <tr>
    <td id="list" valign="top" colspan="2">
	</td></tr></table>
    </tr>
</table>
<?php 
pg_close($conexao);
?>
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