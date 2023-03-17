<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../inc/jquery-1.6.4.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tipo').change(function(){
            $('#produto').load('../lista/listaProdutos.php?tipo='+$('#tipo').val());
        });
    });
    </script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#produto').change(function(){
            $('#marca').load('../lista/listaMarca.php?produto='+$('#produto').val());
        });
    });
    </script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#marca').change(function(){
            $('#modelo').load('../lista/listaMod.php?marca='+$('#marca').val()+'&produto='+$('#produto').val()+'&tipo='+$('#tipo').val());
        });
    });
    </script>




<script type="text/javascript">
    $(document).ready(function(){
        $('#btfil').click(function(){
             $('#list').load('../lista/listaBackup.php?tipo='+$('#tipo').val()+'&produto='+$('#produto').val()+'&marca='+$('#marca').val()+'&modelo='+$('#modelo').val());
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




include '../inc/conexao.inc.php';
$sqlequip="select * from tb_tipo order by tipo_descricao";
$rsequip = pg_query($conexao,$sqlequip);

$sqlmarca="select * from tb_marca order by marca_descricao";
$rsmarca = pg_query($conexao,$sqlmarca);

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
    <td bgcolor="" align="center" width="20%"><img src="../img/Logo.png" width="203" height="101" alt="Sixma" /></td>
    <td align="center" bgcolor="" width="60%"><h1>Equipamentos de Backup</h1></td>
    <td align="center" bgcolor="" width="20%"><form name="form_relogio">
        <input type="text" name="relogio" size="10" style="background-color : Black; color : lightGreen; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_relogio.relogio.blur()">
      </form></td>
  </tr>
  <tr>
    <td valign="top" align="center" width="20%"><ul id="menu">
        <li><a href="../inicio.php" 	title="Voltar" > <img src="../img/bt_voltar.png" width="117" height="39"  /> </a></li>
        <li><a href="../index.php" 		title="sair"  > <img src="../img/bt_sair.png" width="117" height="39"  /> </a></li>
      </ul></td>
    <td bgcolor="#73B9FF" height="100%" width="60%" valign="top" align="left"><form name="teste">
    <table width="100%"  border="">
    <tr>
      <td width="50%" align="center">Tipo de Equipamento:</td>
      <td width="50%">
      <select style="width:100%" name="tipo" id="tipo" size="1" >
                <option  selected="selected"></option>
                <?php while($des_equip=pg_fetch_array($rsequip)){
	echo"<option value=\"".$des_equip['cod_tipo']."\">". $des_equip['tipo_descricao']."</option>";
	} ?>
              </select></td>
    </tr>
    <tr>
      <td align="center">Produto:</td>
      <td  align="left">
      <select style="width:100%" name="produto" id="produto" size="1" >
          <option  selected="selected"></option>
        </select></td>
    </tr>
    <tr>
      <td align="center" >Marca:</td>
      <td >
      <select style="width:100%" name="marca" id="marca" size="1" >
          <option  selected="selected"></option>
    <?php while($des_marca=pg_fetch_array($rsmarca)){
	echo"<option value=\"".$des_marca['cod_marca']."\">". $des_marca['marca_descricao']."</option>";
	} ?>

        </select></td>
    </tr>
    <tr>
      <td align="center">Modelo:</td>
      <td>
      <select style="width:100%" name="modelo" id="modelo" size="1" >
          <option  selected="selected"></option>
        </select
    ></td>
    </tr>
    <tr>
    <td></td>
    <td align="right">
    <a href="equipBkp.php"><input type="button" value="Reset"  /></a>
    <input type="button" value="Filtrar" name="btfil" id="btfil" />
    </td></tr>
    <tr>
    <td id="list" valign="top" colspan="2">
	</td></tr></table></form>
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