<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sixma</title>
</head>
<body>
<?php
$login_w=$_POST['login'];
$senha_w=$_POST['senha'];

include 'conexao.inc.php';

$sql="select * from tb_funcionario where fun_login= '".$login_w."'";
$resultado = pg_query($conexao,$sql);
pg_close($conexao);
$linha=pg_fetch_array($resultado);
if($linha['fun_login']=="")
{
		print "<script> alert('Usuario ou senha Invalido'); window.history.go(-1); 
		header('Location: index.php');
		</script> \n";
}
else
{
	if($linha['fun_senha']==$senha_w)
	{
		session_start();
		$_SESSION['codfun']=$linha['cod_funcionario'];
		$_SESSION['login']=$linha['fun_login'];
		$_SESSION['senha']=$linha['fun_senha'];
		$_SESSION['nome']=$linha['fun_nome'];
		$_SESSION['apelido']=$linha['fun_apelido'];
		$_SESSION['permissao']=$linha['fun_permissao'];
		session_write_close();
		header('Location: ../inicio.php');
		}
	else
	{
		print "<script> alert('Usuario ou senha Invalido'); window.history.go(-1); 
		header('Location: ../index.php');
		</script> \n";
	}
}
 pg_close($conexao);
?> 
</body>
</html>
<!--echo "<table border='1'>";
while($linha=pg_fetch_array($resultado))
{
	echo "<tr><td> ".$linha['id']."</td>";
	echo "<td>".$linha['login']."</td>";
	echo "<td>".$linha['senha']."</td></tr>";
}
echo "</table>";-->
