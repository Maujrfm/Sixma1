<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../inc/jquery-1.6.4.js"></script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#btfil').click(function(){
             $('#list').load('../lista/listarelFuncionario.php?dataini='+$('#dtini').val()+'&datafim='+$('#dtfim').val()+'&funcionario='+$('#fun').val()+'&operacao='+$('#ope').val());
       });
    });
    </script>
 
<script type="text/javascript">
   function imprimir(){
    window.print() 
    }
    </script> 
<script type="text/javascript">
   function cancelar(){
	window.setTimeout("location.href='../paginas/administrativo.php';",1)
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


include '../inc/conexao.inc.php';

$sqlfun="select cod_funcionario,fun_nome from tb_funcionario order by fun_nome";
$rsfun = pg_query($conexao,$sqlfun);

$sqlope="select cod_tipo_reg,tipo_reg_descricao from tb_tipo_reg order by cod_tipo_reg";
$rsope = pg_query($conexao,$sqlope);



?>
<style media="print">
.nao_imprimir{display:none}

</style>
<style media="print">
.imprimir{
	position: relative; 
	left: 50%;
	text-align: center;
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
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr class="nao_imprimir">
    <td bgcolor="" align="center" width="20%"><img src="../img/Logo.png" width="203" height="101" alt="Sixma" /></td>
    <td align="center" bgcolor="" width="60%"><h1> Relatório de Romaneio  </h1></td>
    <td align="center" bgcolor="" width="20%"><form name="form_relogio">
        <input type="text" name="relogio" size="10" style="background-color : Black; color : lightGreen; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_relogio.relogio.blur()">
      </form></td>
  </tr>
  <tr>
    <td valign="top" align="center" width="20%" class="nao_imprimir">
    <ul id="menu" >
        <li><a href="../paginas/administrativo.php" 	title="Voltar" > <img src="../img/bt_voltar.png" width="117" height="39"  /> </a></li>
        <li><a href="../index.php" 		title="sair"  > <img src="../img/bt_sair.png" width="117" height="39"  /> </a></li>
      </ul></td>
    <td bgcolor="#73B9FF" height="100%" width="60%">
    <table width="100%"  border="">
    <tr class="nao_imprimir">
    <td width="25%" align="center">Data Inicial</td>
    <td width="25%" align="center"><input type="date" name="dtini" id="dtini" /></td>
    <td width="25%" align="center">Data Final</td>
    <td width="25%" align="center"><input type="date" name="dtfim" id="dtfim" /></td></tr>
    <tr class="nao_imprimir">
    <td colspan="2" align="center" width="50%"> Funcionário: </td>
    <td colspan="2" align="center" width="50%">
    <select style="width:100%" name="fun" id="fun" size="1" >
                <option selected="selected"></option>
        <?php while($des_fun=pg_fetch_array($rsfun))
		  {
			echo "<option value=\"".$des_fun['cod_funcionario']."\">".$des_fun['fun_nome']."</option>";  
		  }
		  ?></select></td></tr>
    <tr class="nao_imprimir">
    <td colspan="2" align="center" width="50%"> Operação: </td>
    <td colspan="2" align="center" width="50%">
    <select style="width:100%" name="ope" id="ope" size="1" >
                <option selected="selected"></option>
        <?php while($des_ope=pg_fetch_array($rsope))
		  {
			echo "<option value=\"".$des_ope['cod_tipo_reg']."\">".$des_ope['tipo_reg_descricao']."</option>";  
		  }
		  ?></select></td></tr>
    <tr>
    <td colspan="4" align="right" class="nao_imprimir">
    <input type="button" value="Filtrar" name="btfil" id="btfil" /></td></tr>
    <tr>
    <td colspan="4" id="list"></td>
	</tr>
    <tr>
    <td colspan="4" align="right" class="nao_imprimir">
    <input type="button" onclick="cancelar()" value="Cancelar">
    <input type="button" onclick="imprimir()" value="Imprimir"></td></tr></table>
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