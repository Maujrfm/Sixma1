<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sixma</title>
</head>
<?php
session_start();
if(isset($_SESSION['login']))
{
	$sit=$_GET['situacao'];
	$mod=$_GET['modelo'];
	
include 'conexao.inc.php';	
	if($mod!=null)
	{
	$sqlnst="select * from tb_backup where cod_modelo=".$mod." order by bkp_num_serie";
	$rsnst = pg_query($conexao,$sqlnst);
	if($sit==1)
	{
	echo "<option selected=\"selected\"></option>";
	while($des_nst=pg_fetch_array($rsnst))
	{
	echo"<option value=\"".$des_nst['cod_backup']."\">". $des_nst['bkp_num_serie']."</option>";
	} 
	}
	}
	else
	{
		 echo "<script> alert('Por favor preencha as informações a cima'); 
		 window.location='cadastro.php'; 
	 			</script> \n";
	}


}
 else
 {
	 
	 echo "<script> alert('Por favor Faça Login'); 
	 	window.location='../index.php';  
		</script> \n";
		
 }
 pg_close($conexao);
?>
<body>
</body>
</html>