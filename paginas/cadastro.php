<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
			$('#problema').load('../lista/listaProblema.php?produto='+$('#produto').val());;
		});
    });
    </script>
    
        <!--$(document).ready(function(){
        $('#sit').change(function(){
            $('#nst1').load('listaNst1.php?situacao='+$('#sit').val());
			$('#nst2').load('listaNst2.php?situacao='+$('#sit').val());
        });
    });-->
    
    
    
    
    
<script type="text/javascript">
    $(document).ready(function(){
        $('#marca').change(function(){
            $('#mod').load('../lista/listaMod.php?marca='+$('#marca').val()+'&produto='+$('#produto').val()+'&tipo='+$('#tipo').val());
        });
    });
    </script>

	<script type="text/javascript">
    $(document).ready(function(){
        $('#sit').change(function(){
            $('#nst').load('../lista/listaNst.php?modelo='+$('#mod').val()+'&situacao='+$('#sit').val());
        });
    });
    </script>

    
     <script>//usar este metodo no problema
	 $(document).ready(function(){
		$('#nst').hide();
		$('#nst1').hide();
		 $('#sit').change(function(){
			if($('#sit').val() != '1'){
				$('#nst').hide();
				$('#nst1').hide();	
			}else{
				$('#nst').show();
				$('#nst1').show();	
			}
		 });
	});
    </script>
    
    <script type="text/javascript">
   function cancelar(){
	window.setTimeout("location.href='../inicio.php';",1)
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

$cod_os=null;
$des_cli=null;
$des_equip=null;
$des_sit=null;


include '../inc/conexao.inc.php';
$sqlcli="select * from vw_clientes";
$rscli = pg_query($conexao,$sqlcli);

$sqlequip="select * from tb_tipo order by tipo_descricao";
$rsequip = pg_query($conexao,$sqlequip);

$sqlsit="select * from tb_situacao order by sit_descricao";
$rssit = pg_query($conexao,$sqlsit);


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
    <td align="center" bgcolor="" width="60%"><h2>Cadastro de OS</h2></td>
    <td align="center" bgcolor="" width="20%"><form name="form_relogio">
        <input type="text" name="relogio" size="10" style="background-color : Black; color : lightGreen; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_relogio.relogio.blur()">
      </form></td>
  </tr>
  <tr>
    <td valign="top" align="center" width="20%"><ul id="menu">
        <li><a href="../inicio.php" 	title="Voltar" > <img src="../img/bt_voltar.png" width="117" height="39"  /> </a></li>
        <li><a href="../index.php" 		title="sair"  > <img src="../img/bt_sair.png" width="117" height="39"  /> </a></li>
      </ul></td>
    <td bgcolor="#73B9FF" height="100%" width="60%" valign="top" align="center">
    <form name="Sixma" method="post" action="../confirma/confirmaOs.php" >
        <table width="98%" cellpadding="0" cellspacing="0"border="0" id="texto">
          <tr>
            <td width="8%">Cliente:</td>
            <td width="25%" align="left"><select style="width:75%" name="cli" size="1" >
                <option name="cliente" id="cliente" selected="selected"></option>
                <?php 
	while($des_cli=pg_fetch_array($rscli))
	{
	echo "<option value=\"".$des_cli['cod']."\">".$des_cli['nome']."</option>";
	}
	?>
              </select></td>
            <td width="10%">Tipo de Equipamento:</td>
            <td width="25%" align="left"><select style="width:60%" name="tipo" id="tipo" size="1" >
                <option value="teste" selected="selected"></option>
                <?php while($des_equip=pg_fetch_array($rsequip)){
	echo"<option value=\"".$des_equip['cod_tipo']."\">". $des_equip['tipo_descricao']."</option>";
	} ?>
              </select></td>
          </tr>
          <tr>
            <td>Produto:</td>
            <td width="25%" align="left"><select style="width:75%" name="produto" id="produto" size="1" >
                <option  selected="selected"></option>
              </select></td>
            <td width="5%">Marca:</td>
            <td width="25%" align="left"><select style="width:60%" name="marca" id="marca" size="1" >
                <option  selected="selected"></option>
              </select></td>
          </tr>
          <tr>
            <td>Modelo:</td>
            <td width="25%" align="left">
            <select style="width:75%" name="mod" id="mod" size="1" >
                <option  selected="selected"></option>
              </select></td>
            <td>NS.:</td>
            <td width="25%" align="left"><input style="width:58%" name="ns" id="ns" type="text" size="4" autocomplete="off"/></td>
          </tr>
          <tr>
            <td colspan="2" align="center">Problema:</td>
            <td colspan="2" align="center">
            <select style="width:60%" name="problema" id="problema" size="1" >
                <option  selected="selected"></option>
                </select></td>
          </tr>
          <tr>
            <td colspan="4" >
            	<textarea name="desprob" id="desprob" style="width:90%"  rows="4" maxlength="2000" > </textarea></td>
          </tr>
          <tr>
            <td>Situação:</td>
            <td width="25%" align="left">
            	<select style="width:60%" name="sit" id="sit" size="1" >
                <option selected="selected"></option>
                <?php while($des_sit=pg_fetch_array($rssit)){
	echo"<option value=\"".$des_sit['cod_situacao']."\">".$des_sit['sit_descricao']."</option>";
	} ?>
              </select></td>
            <td id="nst1">NS. para Troca</td>
           	<td>
            <select style="width:60%" name="nst" id="nst" size="1" >    
            </select></td></tr>
          <tr>
            <td colspan="4" align="left">Obs.:</td>
          </tr>
          <tr>
            <td colspan="4">
            	<textarea name="obs" id="obs" style="width:90%" rows="4" maxlength="2000"> </textarea></td>
          </tr>
          <tr>
            <td colspan="" align="right"></td>
            <td></td>
            <td colspan="2"><table>
                <tr>
                  <td width="50%">
                  <input type="submit" id="btfi" value="Finalizar" ></td>
                  <td width="50%">
                  <input type="button" onclick="cancelar()" value="Cancelar"></td>
                </tr>
              </table></td>
          </tr>
        </table>
        
      </form></td>
    <td bgcolor="" valign="top" width="20%"></td>
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
	 	window.location='../index.php';  
		</script> \n";
		
 }
 ?>
</html>