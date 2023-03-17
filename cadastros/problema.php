<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sixma</title>
</head>
<script type="text/javascript" src="../inc/jquery-1.6.4.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#tipo').change(function(){
            $('#produto').load('../lista/listaProdutos.php?tipo='+$('#tipo').val());
        });
    });
    </script>


<?php 

include '../inc/conexao.inc.php';

$sqlequip="select * from tb_tipo order by tipo_descricao";
$rsequip = pg_query($conexao,$sqlequip);

$sqlprod="select * from tb_produto order by prod_descricao";
$rsprod = pg_query($conexao,$sqlprod);

$sqlmarca="select * from tb_marca order by marca_descricao";
$rsmarca = pg_query($conexao,$sqlmarca);

?>


<body>
<?php 
session_start();
if($_SESSION['permissao']==2)
{
 ?>
<form method="post" action="bancodedados.php">
<input type="hidden" name="validador" value="11" />
<table border="0">
<tr>
            <td align="center">Tipo de Equipamento:</td>
      <td>
      <select style="width:100%" name="tipo" id="tipo" size="1" >
                <option value="teste" selected="selected"></option>
                <?php while($des_equip=pg_fetch_array($rsequip)){
	echo"<option value=\"".$des_equip['cod_tipo']."\">". $des_equip['tipo_descricao']."</option>";
	} ?>
              </select></td>
    </tr>
    <tr>
      <td align="center">Produto:</td>
      <td  align="left">
      <select style="width:100%"  name="produto" id="produto" size="1" >
          <option  selected="selected"></option>
        </select></td>
    </tr>
	<tr>
<td align="center">Problema:</td>
<td><input type="text" name="prob_descricao" size="30" maxlength="150" autocomplete="off" /></td></tr>
<tr>
<td align="center"><input type="submit" value="Cadastrar" /></td>
<td align="center"><input type="reset" value="Limpar" /></td></tr>
<tr>
<td colspan="2" align="right"><a href="listaCadastros.php"><input type="button" value="Voltar" /></a></td></tr>
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