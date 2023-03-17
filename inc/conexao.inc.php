
<?php
$str_conexao = 'host=localhost dbname=bd_sixma port=5432 user=postgres password=admin';
//$str_conexao = 'dbname=bd_sixma port=5432 user=diego password=123456';
if(!($conexao=pg_connect($str_conexao))){
	echo 'Caso esta mensagem seja exibida Ligue 9225-7108';
	echo $str_conexao;
	exit;
}
?>