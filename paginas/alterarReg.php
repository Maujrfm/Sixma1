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
$cod_os=$_POST['cod_osh'];
$cod_tipo_reg=$_POST['tipo_reg'];
$reg_descricao=$_POST['reg_descricao'];
$cod_fun=$_SESSION['codfun'];
$cod_modelo=$_POST['modelo'];
$numserie=$_POST['numserie'];

include 'conexao.inc.php';

$sqlreg="insert into tb_registro (cod_os,cod_tipo_reg,reg_descricao,cod_funcionario) values ('".$cod_os."','".$cod_tipo_reg."','".$reg_descricao."','".$cod_fun."');";
$rsreg = pg_query($conexao,$sqlreg);
$valinsreg=pg_affected_rows($rsreg);
if($valinsreg==1)
{
		if($cod_tipo_reg==7)
		{
			$sqlinsbkp="insert into tb_backup (cod_modelo,bkp_num_serie) values ('".$cod_modelo."','".$numserie."');";
			$rsinsbkp=pg_query($conexao,$sqlinsbkp);
		}
		 echo "<script> alert('Cadastro Efetuado com sucesso! '); 
		 window.location='consultaAltera.php';
	 		</script> \n";
}
else
{
		 echo "<script> alert('Ocorreu um erro na sua transição'); 
		 window.location='consultaAltera.php';
		</script> \n";
}
 }
 else
 {
	 
	 echo "<script> alert('Por favor Faça Login'); 
	 	window.location='index.php';  
		</script> \n";
		
 }
  pg_close($conexao);
 ?>
</body>
</html>