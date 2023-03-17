<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sixma</title>
<h2> Cadastros </h2>
</head>
<body>
<?php 
session_start();
if($_SESSION['permissao']==2)
{
 ?>
<br /> <p> Sem dependencias </p>
<a href="funcionario.php">Funcionario</a><br />
<a href="cliente.php">Cliente</a><br />
<a href="marca.php">Marca</a><br />
<a href="situacao.php">Situação</a><br />
<a href="tipo.php">Tipo de Equipamento</a><br />
<a href="tiporeg.php">Tipo de Registros</a><br />
<br /> <p> Com dependencias </p>
<a href="produto.php">Produto</a><br />
<a href="modelo.php">Modelo</a><br />
<a href="problema.php">Problema</a><br />
<a href="prod_backup.php">Produtos de Backup</a><br />
<br /><p>Para Voltar</p>
<a href="../paginas/administrativo.php">Voltar</a><br />
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