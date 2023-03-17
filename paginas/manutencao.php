<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
session_start();
if(isset($_SESSION['login']))
{
 ?>
<title>Sixma</title>
<style type="text/css">
#imgpos {
position:absolute;
left:50%;
top:50%;
margin-left:-245px;
margin-top:-172px;
}
</style>
</head>

<body bgcolor="0080FF">
<div id="imgpos">
<table align="center"  border="0" cellpadding="0" cellspacing="0">
<tr>
 <td colspan="3"> <img name="login_r2_c2" src="img/login_r2_c2.png" width="491" height="251" id="login_r2_c2" alt="" /> </td>
 </tr>
 <tr>
 <td> <img name="login_r3_c2" src="img/login_r3_c2.png" width="103" height="93" id="login_r3_c2" /> </td>
 <td background="img/login_r3_c3.png" width="274" height="93" > <form id="form1" name="form1" method="post" action="valida.php">
   <table align="center">
   <tr>
   <td align="center" valign="middle">Desculpe o Transtorno Estamos em Manutenção!!
   </td>
    <td><a href="inicio.php" 	title="Voltar" > <img src="img/bt_voltar.png" width="117" height="39"  /> </a></td>
   </tr>
   </table>
   </form></td>
 <td> <img name="login_r3_c4" src="img/login_r3_c4.png" width="114" height="93" id="login_r3_c4" alt="" /> </td>
 </tr>
 </table>
 </div>
</body>
<?php
 }
 else
 {
	 
	 echo "<script> alert('Por favor Faça Login'); 
	 	window.location='index.php';  
		</script> \n";
		
 }

 ?>
</html>
