<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style media="print">
.nao_imprimir{display:none}

</style>

<script type="text/javascript">
   function imprimir(){
    window.print() 
	window.setTimeout("location.href='../paginas/consulta.php';",1)
    }
    </script>


<title>Sixma</title>
<?php
$cod=$_GET['codigo'];

include '../inc/conexao.inc.php';

$sqlcimp="select * from vw_os where cod_os =".$cod.";";
$rscimp=pg_query($conexao,$sqlcimp);
$impos=pg_fetch_array($rscimp);




?>
<body>
<?php 
session_start();
if(isset($_SESSION['login']))
{
 ?>
<form action="../paginas/consulta.php">
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="" align="center" width="20%"><img src="../img/Logo.png" width="203" height="101" alt="Sixma" /></td>
    <td colspan="2" align="center" valign="middle">
    <h2>Registro de OS<br></h2>
    Castseg Campo Grande - MS
    </td>
    <td align="center">
    <input type="text" style="text-align:center" value="<?php echo $impos['cod_os'] ?>" disabled><br><?php echo date('d/m/Y',strtotime($impos['os_data']))?></td>
    </tr>
    <tr>
    <th align="right">Cliente:  </th>
    <td colspan="3" align="center"><?php echo $impos['cliente']?></td>
    </tr>
    <tr>
    <th colspan="4">Equipamento</th></tr>
    <tr>
    <th align="right">Produto:  </th>
    <td align="center"><?php echo $impos['produto']?></td>
    <th align="right" width="10%">Marca:  </th>
    <td align="center"><?php echo $impos['marca']?></td></tr>
    <tr>
    <th align="right">Modelo:  </th>
    <td colspan="3" align="center"><?php echo $impos['modelo']?></td></tr>
    <tr>
    <th align="right">NS.:  </th>
    <td colspan="3" align="center"><?php echo $impos['os_numserie_prod']?></td></tr>
    <tr>
    <th colspan="4">Problema</th></tr>
    <tr>
    <td colspan="4" align="center"><?php echo $impos['os_problema']?></td></tr>
    <tr>
    <th align="right">Situação:  </th>
    <td align="center">
	<?php echo $impos['situacao']; $codsit=$impos['situacao'];?></td>
    <?php 
	if($codsit=="Trocado")
	{
		echo "<th> NS. Troca:</th>";
		echo "<td align=\"center\"> ".$impos['os_ns_prod_troca']."</td>";
	}
	?>
    </tr>
    <tr>
    <th colspan="4" align="center">
    <table border="1" width="100%">
    <tr>
    <th width="50%" align="center" ><br><br><br><br>________________<br>
	<?php echo $impos['funcionario'] ?></th>
    <th width="50%" align="center"><br><br><br><br>________________<br>
	<?php echo $impos['cliente'] ?></th></tr></table>
    </th></tr></table>
    <table width="100%" border="0" class="nao_imprimir">
    <tr>
    <td align="right">
    <input type="button" id="btimp" value="Imprimir" onClick="imprimir()"  ></td>
    <td><input type="submit" name="cancelar" value="cancelar" formaction="../paginas/consulta.php" ></td></tr>
    </table></form>

<?php
 }
 else
 {
	 
	 echo "<script> alert('Por favor Faça Login'); 
	 	window.location='../index.php';  
		</script> \n";
		
 }
  pg_close($conexao); ?>
</body>
</html>