<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
session_start();
if($_SESSION['permissao']==2)
{
 ?>
<title>Sixma</title>
<?php 
		
		$totfab=0;
		$totloja=0;
		
include '../inc/conexao.inc.php';
?>
<script language="JavaScript"> 
function moveRelogio(){ 
   	momentoAtual = new Date() 
   	hora = momentoAtual.getHours() 
   	minuto = momentoAtual.getMinutes() 
   	segundo = momentoAtual.getSeconds() 

   	str_segundo = new String (segundo) 
   	if (str_segundo.length == 1) 
      	 segundo = "0" + segundo 

   	str_minuto = new String (minuto) 
   	if (str_minuto.length == 1) 
      	 minuto = "0" + minuto 

   	str_hora = new String (hora) 
   	if (str_hora.length == 1) 
      	 hora = "0" + hora 

   	horaImprimible = hora + " : " + minuto + " : " + segundo 

   	document.form_relogio.relogio.value = horaImprimible 

   	setTimeout("moveRelogio()",1000) 
} 
</script>
<style type="text/css">
ul {
	margin: 0;
	padding: 0;
	list-style: none;
	width: 150px;
	}
ul li {
	position: relative;
	}
li ul {
	position: absolute;
	left: 149px;
	top: 0;
	display: none;
	}
li:hover ul { display: block; }
#fonte {
	color : lightGreen;
	font-family : Verdana, Arial, Helvetica;
	font-size : 12pt;
	text-align : center;
"
}
#fonte2 {
	color : lightGreen;
	font-family : Verdana, Arial, Helvetica;
	font-size : 12pt;
	text-align : center;
	font-weight: bold;
"
}
#texto {
	text-align: center;
}
</style>
</head>
<body onload="moveRelogio()" bgcolor="#4DA6FF">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="" align="center" width="20%"><img src="../img/Logo.png" width="203" height="101" alt="Sixma" /></td>
    <td bgcolor=""></td>
    <td align="center" bgcolor="" width="20%"><form name="form_relogio">
        <input type="text" name="relogio" size="10" style="background-color : Black; color : lightGreen; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_relogio.relogio.blur()">
      </form></td>
  </tr>
  <tr>
    <td valign="top" align="center"><ul id="menu">
      <li><a href="../cadastros/listaCadastros.php" title="cadastro"> <img src="../img/bt_adm_bd.png" width="117" height="39"  /> </a></li>
      <li><a href="consultaAltera.php" 	title="consultar"> <img src="../img/bt_alterar_os.png" width="117" height="39"  /> </a></li>
      <li><a href="../relatorios/relatorio.php" 	title="consultar"> <img src="../img/bt_relatorios.png" width="117" height="39"  /></a>
      <ul>
      <li><a href="../relatorios/relCliente.php" 	title="consultar"> <img src="../img/bt_cliente.png" width="117" height="39"  /> </a></li>      <li><a href="../relatorios/relTipo.php" 	title="consultar"> <img src="../img/bt_tipo.png" width="117" height="39"  /> </a></li>
      <li><a href="../relatorios/relProduto.php" 	title="consultar"> <img src="../img/bt_produto.png" width="117" height="39"  /> </a></li>
      <li><a href="../relatorios/relMarca.php" 	title="consultar"> <img src="../img/bt_marca.png" width="117" height="39"  /> </a></li>
      <li><a href="../relatorios/relModelo.php" 	title="consultar"> <img src="../img/bt_modelo.png" width="117" height="39"  /> </a></li>
      <li><a href="../relatorios/relData.php" 	title="consultar"> <img src="../img/bt_data.png" width="117" height="39"  /> </a></li>
      <li><a href="../relatorios/relProblema.php" 	title="consultar"> <img src="../img/bt_problema.png" width="117" height="39"  /> </a></li>
      <li><a href="../relatorios/relReincidencia.php" 	title="Voltar" > <img src="../img/bt_reincidencia.png" width="117" height="39"  /> </a></li>
      <li><a href="../relatorios/relRomaneio.php" 	title="Voltar" > <img src="../img/bt_rel_romaneio.png" width="117" height="39"  /> </a></li>
      <li><a href="../relatorios/relFuncionario.php" 	title="Voltar" > <img src="../img/bt_funcionario.png" width="117" height="39"  /> </a></li>
      </ul>
      </li>
      <li><a href="../romaneio/romaneio.php" 	title="consultar"> <img src="../img/bt_romaneio.png" width="117" height="39"  /></a>
      <ul>
      <li><a href="../romaneio/romInterno.php" 	title="Voltar" > <img src="../img/bt_interno.png" width="117" height="39"  /> </a></li>
      <li><a href="../romaneio/romDespacho.php" 	title="Voltar" > <img src="../img/bt_despacho.png" width="117" height="39"  /> </a></li>
      </ul>
      </li>
      <li><a href="../inicio.php" 	title="Voltar" > <img src="../img/bt_voltar.png" width="117" height="39"  /> </a></li>
      <li><a href="../index.php" 	title="sair" > <img src="../img/bt_sair.png" width="117" height="39"  /> </a></li>
      </ul></td>
    <td bgcolor="#73B9FF" width="60%" valign="top">
    <h2 align="center" >Produtos na loja</h2>
      <br />
      <div id=texto>
        <?php 

$sqlconscli="select * from vw_inicio where cod_tipo_reg<3;";
	$rscons=pg_query($conexao,$sqlconscli);	
	$validlo=pg_num_rows($rscons);
		if($validlo!=0)
	{
	echo "<table border=\"1\" width=\"100%\">";
    echo "<tr>";
    echo "<th>Quantidade de OS</th>";
    echo "<th>Cliente</th>";
    echo "<th>Telefone</th>";
    echo "</tr>";
	while($impcons=pg_fetch_array($rscons))
	{
		
		echo "<tr><td align=\"center\" >".$impcons['quantidade']."</td>";
		echo "<td align=\"center\">".$impcons['nome']."</td>";
		echo "<td align=\"center\">".$impcons['telefone']."</td>";
		echo "</tr>";
		$totloja=$totloja+$impcons['quantidade'];
	}//while
		echo "</table>";
	}
?>
      </div>
      <hr color="#4DA6FF" />
      <h2 align="center">Produtos na fabrica<br />
      </h2>
      <div id=texto>
       <?php 
		  $sqlconsclimt="select * from vw_inicio where cod_tipo_reg=3;";
	$rsconsmt=pg_query($conexao,$sqlconsclimt);	
		$validfa=pg_num_rows($rsconsmt);
		if($validfa!=0)
	{		
	echo "<table border=\"1\" width=\"100%\">";
    echo "<tr>";
    echo "<th>Quantidade de OS</th>";
    echo "<th>Cliente</th>";
    echo "<th>Telefone</th>";
    echo "</tr>";
	while($impconsmt=pg_fetch_array($rsconsmt))
	{
		
		echo "<tr><td align=\"center\" >".$impconsmt['quantidade']."</td>";
		echo "<td align=\"center\">".$impconsmt['nome']."</td>";
		echo "<td align=\"center\">".$impconsmt['telefone']."</td>";
		echo "</tr>";
		$totfab=$totfab+$impconsmt['quantidade'];
	}//while
		echo "</table>";
	}
	   ?> </div></td>
    <td bgcolor="" valign="top"><div id="fonte" align="center"> Totais de<br />
        Produtos na loja:</div>
      <div id="fonte2"> <?php echo " "; echo $totloja ?></div>
      <br />
      <div id="fonte">Produtos na fabrica:</div>
      <div id="fonte2"> <?php echo " "; echo $totfab ?> <br />
      </div></td>
  </tr>
</table>
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