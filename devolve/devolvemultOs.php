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
session_start();
if(isset($_SESSION['login']))
{
	if(isset($_POST['check']))
	{
function filter($dados)
{
$cod=array();
foreach( $dados as $dado) $cod[] = (int)$dado;
return $cod;
}
$codclibkp=$_POST['cli_bkp'];
$cod=filter($_POST['check']);
$array=implode(',',$cod);
$contcod=count($cod);

include '../inc/conexao.inc.php';

$sqlcimp="select * from vw_os where cod_os =".$cod[0].";";
$rscimp=pg_query($conexao,$sqlcimp);
$impos=pg_fetch_array($rscimp);
?>
<body>
<form method="post" action="devolveimpmultOs.php">
<input type="hidden" name="array_os" value="<?php echo $array ?>">
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="" align="center" width="20%"><img src="../img/Logo.png" width="203" height="101" alt="Sixma" /></td>
    <td colspan="2" align="center" valign="middle">
    <h2>Devolução de Multi OS<br></h2>
    Castseg Campo Grande - MS
    </td>
    <td align="center">
    <?php echo date('d/m/Y')?></td>
    </tr>
    <tr>
    <th align="right">Cliente:  </th>
    <td colspan="3" align="center"><?php echo $impos['cliente']?></td>
    </tr>
    <?php 
	
	for($i=0;$i<$contcod;$i++)
{
	$sqlmimp="select * from vw_os where cod_os =".$cod[$i].";";
$rsmimp=pg_query($conexao,$sqlmimp);
$mimpos=pg_fetch_array($rsmimp);
	
	
	$sqlreg="select * from tb_registro where cod_os='".$cod[$i]."' and cod_tipo_reg='5';";
$rsreg=pg_query($conexao,$sqlreg);
$impreg=pg_fetch_array($rsreg);
	
	
	
	 ?>
    <tr>
    <th align="center" colspan="3">Equipamentos da OS:</th>
    <th align="center"><?php echo $mimpos['cod_os'] ?></th></tr>
    <tr>
    <th align="right">Produto:  </th>
    <td align="center"><?php echo $mimpos['produto']?></td>
    <th align="right" width="10%">Marca:  </th>
    <td align="center"><?php echo $mimpos['marca']?></td></tr>
    <tr>
    <th align="right">Modelo:  </th>
    <td colspan="3" align="center"><?php echo $mimpos['modelo']?></td></tr>
    <tr>
    <th align="right">NS.:  </th>
    <td colspan="3" align="center"><?php echo $mimpos['os_numserie_prod']?></td></tr>
    <tr>
    <th colspan="4">Problema</th></tr>
    <tr>
    <td colspan="4" align="center"><?php echo $mimpos['os_problema']?></td></tr>
    <tr>
    <th align="right">Resolução:  </th>
    <td colspan="3" align="center">
	<?php echo $impreg['reg_descricao']?></td></tr>
    <?php }?>
    <tr>
    <th colspan="4" align="center">
    <table border="1" width="100%">
    <tr>
    <th width="50%" align="center"><br><br><br><br>________________<br>
	<?php echo $impos['funcionario'] ?></th>
    <th width="50%" align="center"><br><br><br><br>________________<br>
	<?php echo $impos['cliente'] ?></th></tr></table>
    </th></tr></table>
    <table width="100%" border="0" class="nao_imprimir">
    <tr>
    <td align="right">
    <input type="submit" id="btimp" value="Imprimir" ></td>
    <td><a href="../lista/listaconsultaMulti.php?codigo=<?php echo $codclibkp ;?>"><input type="button" name="cancelar" value="cancelar"></a></td></tr>
    </table></form>

<?php
}//ifcontador
else
{
	echo "<script> alert('Por favor Selecione uma OS');
		window.location='../inicio.php'; 
	 	</script> \n";
	
}
 }//session
 else
 {
	 
	 echo "<script> alert('Por favor Faça Login'); 
	 	window.location='../index.php';  
		</script> \n";
		
 }
  pg_close($conexao); ?>
</body>
</html>