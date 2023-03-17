<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<?php 
session_start();
session_destroy();
 ?>
<div id="imgpos">
<table align="center"  border="0" cellpadding="0" cellspacing="0">
<tr>
 <td colspan="3"> <img name="login_r2_c2" src="img/login_r2_c2.png" width="491" height="251" id="login_r2_c2" alt="" /> </td>
 </tr>
 <tr>
 <td> <img name="login_r3_c2" src="img/login_r3_c2.png" width="103" height="93" id="login_r3_c2" /> </td>
 <td background="img/login_r3_c3.png" width="274" height="93" > <form id="form1" name="form1" method="post" action="inc/valida.php">
   <table align="center">
   <tr>
   <td>Login: </td>
   <td> <input type="text" name="login" maxlength="8" style="text-align:center" tabindex="1" autocomplete="off" autofocus="autofocus" /> </td>
   <td rowspan="2" align="right"><input type="submit" value="Login" tabindex="3"/></td>
   </tr>
   <tr>
   <td>Senha: </td>
   <td> <input name="senha" type="password" maxlength="15" style="text-align:center" tabindex="2"/>
   </td>
   </tr>
   </table>
   </form></td>
 <td> <img name="login_r3_c4" src="img/login_r3_c4.png" width="114" height="93" id="login_r3_c4" alt="" /> </td>
 </tr>
 </table>
 <?php
 include 'inc/rodape.php';
 ?>
 </div>
</body>
</html>
