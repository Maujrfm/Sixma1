<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sixma</title>
<script type="text/javascript" src="../inc/jquery-1.6.4.js"></script>
<script type="text/javascript" src="../inc/jquery.maskedinput.js"></script>
</head>
<script type="text/javascript">
    $(document).ready(function(){
	  $("input.Data").mask("99/99/9999");
      $("input.Telefone").mask("(999)9999-9999");
      $("input.CNPJ").mask("99.999.999/9999-99");
	  $("input.CEP").mask("99.999-999");
	  $("input.Est").mask("aa");
      
});
	</script>

<body>
<?php 
session_start();
if($_SESSION['permissao']==2)
{
 ?>
<form method="post" action="bancodedados.php">
<input type="hidden" name="validador" value="12" />
<table border="0">
<tr>
<td>Razão Social:</td>
<td><input type="text" name="marca_razao" size="30" maxlength="150" autocomplete="off" /></td></tr>
<tr>
<td>CNPJ:</td>
<td><input type="text" class="CNPJ" name="cnpj" size="30" maxlength="150" autocomplete="off" /></td></tr>
<tr>
<td>Telefone:</td>
<td><input type="text" class="Telefone" name="telefone" size="30" maxlength="150" autocomplete="off" /></td></tr>
<tr>
<td>Endereço:</td>
<td><input type="text" name="end" size="30" maxlength="150" autocomplete="off" /></td></tr>
<tr>
<td>Bairro:</td>
<td><input type="text" name="bairro" size="30" maxlength="150" autocomplete="off" /></td></tr>
<tr>
<td>Cidade:</td>
<td><input type="text" name="cidade" size="30" maxlength="150" autocomplete="off" /></td></tr>
<tr>
<td>Estado:</td>
<td><input type="text" class="Est" name="estado" size="30" maxlength="150" autocomplete="off" /></td></tr>
<tr>
<td>CEP:</td>
<td>
<input type="text" class="CEP" name="cep" size="30" maxlength="150" autocomplete="off" /></td></tr>
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
 ?>
</body>
</html>