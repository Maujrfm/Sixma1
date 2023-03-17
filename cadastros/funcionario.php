<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sixma</title>
</head>
<body>
<?php 
session_start();
if($_SESSION['permissao']==2)
{
 ?>
<form method="post" action="bancodedados.php">
<input type="hidden" name="validador" value="1" />
<table border="0">
<tr>
<td>Nome:</td>
<td><input type="text" name="fun_nome" size="30" maxlength="150" autocomplete="off" /></td></tr><tr>
<td>Apelido:</td>
<td><input type="text" name="fun_apelido" size="30" maxlength="150" autocomplete="off" /></td></tr>
<tr>
<td>Login:</td> 
<td><input type="text" name="fun_login" size="30" maxlength="8" autocomplete="off" /></td></tr>
<tr>
<td>Senha:</td>
<td><input type="password" name="fun_senha" size="30" maxlength="15" autocomplete="off" /></td></tr>
<tr>
<td>Permisão:</td>
<td><select name="fun_permissao">
<option id="1" value="1" selected="selected">Usuário</option>
<option id="2" value="2">Administrador</option>
</select></td></tr>
<tr>
<td><input type="submit" value="Cadastrar" /></td>
<td><input type="reset" value="Limpar" /></td></tr>
<tr>
<td colspan="2" align="right"><a href="listaCadastros.php"><input type="button" value="Voltar" /></a></td></tr>
</table>
</form>
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