<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sixma</title>
<?php 

include '../inc/conexao.inc.php';
$sqlequip="select * from tb_tipo order by tipo_descricao";
$rsequip = pg_query($conexao,$sqlequip);




?>
</head>
<body>
<?php 
session_start();
if($_SESSION['permissao']==2)
{
 ?>
<form method="post" action="bancodedados.php">
<input type="hidden" name="validador" value="7" />
<table border="0">
<tr>
            <td>Tipo de Equipamento:</td>
            <td>
            <select style="width:100%" name="cod_tipo" id="tipo" size="1" >
                <option value="teste" selected="selected"></option>
                <?php while($des_equip=pg_fetch_array($rsequip)){
	echo"<option value=\"".$des_equip['cod_tipo']."\">". $des_equip['tipo_descricao']."</option>";
	} ?>
              </select></td>
          </tr>
          <tr>
          <td> Descrição do Produto: </td>
          <td><input type="text" name="prod_descricao" size="30" maxlength="150" autocomplete="off" /></td></tr>
<tr>
<td align="center">
<input type="submit" value="Cadastrar" /></td>
<td align="center">
<input type="reset" value="Limpar" /></td></tr>
<tr>
<td colspan="2" align="right"><a href="listaCadastros.php">
<input type="button" value="Voltar" /></a></td></tr>
</table>
</form>
<?php
 }
 else
 {
	 
	 echo "<script> alert('Por favor Faça Login'); 
	 	window.location='../index.php';  
		</script> \n";
		
 }
  pg_close($conexao);
 ?>
</body>
</html>