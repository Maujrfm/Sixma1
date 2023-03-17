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
	window.setTimeout("location.href='../inicio.php';",1)
    }
    </script>


<title>Sixma</title>
<?php
session_start();
if(isset($_SESSION['login']))
{
	function filter($dados)
		{
			$cod=array();
			foreach( $dados as $dado) $cod[] = (int)$dado;
			return $cod;
		}//function
$array=explode(',',$_POST['array_os']);

$cod=filter($array);
$cod_funcionario=$_SESSION['codfun'];
$reg_descricao="Produto devolvido para o cliente - Registro gerado automaticamente";
$contcod=count($cod);

include '../inc/conexao.inc.php';

$sqlcimp="select * from vw_os where cod_os =".$cod[0].";";
$rscimp=pg_query($conexao,$sqlcimp);
$impos=pg_fetch_array($rscimp);
?>
<body onLoad="imprimir()">
<form method="post" action="devolveimpmultOs.php">
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
	
	$sqlinsreg="insert into tb_registro (cod_os,cod_tipo_reg,cod_funcionario,reg_descricao) values ('".$cod[$i]."',6,'".$cod_funcionario."','".$reg_descricao."');";
$rsinsreg=pg_query($conexao,$sqlinsreg);
	
	
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
    <?php }//for?>
    <tr>
    <th colspan="4" align="center">
    <table border="1" width="100%">
    <tr>
    <th width="50%" align="center"><br><br><br><br>________________<br>
	<?php echo $impos['funcionario'] ?></th>
    <th width="50%" align="center"><br><br><br><br>________________<br>
	<?php echo $impos['cliente'] ?></th></tr></table>
    </th></tr></table>
    </form>

<?php
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