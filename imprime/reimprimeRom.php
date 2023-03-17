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
	window.setTimeout("location.href='../romaneio/romInterno.php';",1)
    }
    </script>
    



<title>Sixma</title>
<?php
session_start();
if(isset($_SESSION['login']))
{
	
$codrom=$_GET['codigo'];
include '../inc/conexao.inc.php';

$sqlcimprom="select * from tb_romaneio where cod_romaneio ='".$codrom."';";
$rscimprom=pg_query($conexao,$sqlcimprom);
$impforrom=pg_fetch_array($rscimprom);

$data=$impforrom['rom_data'];

$sqlcimp="select * from tb_marca where cod_marca ='".$impforrom['cod_marca']."';";
$rscimp=pg_query($conexao,$sqlcimp);
$impfor=pg_fetch_array($rscimp);

?>
<body>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
	<thead>
    <tr>
	<th align="center" valign="middle" colspan="6" width="10%">
	<img src="../img/Logo.png" width="203" height="101" alt="Sixma"  style="float: left;"/>
	<br><h1> Romaneio Interno </h1><p align="right"> <?php echo $codrom ?><br><?php echo date('d/m/Y',strtotime($data));?> </p></th></tr></thead>     
    <tr>
    <td colspan="5">
    <table border="0" width="100%">
    <tr>
    <th width="10%" align="center">Razão Social:  </th>
    <td colspan="3"><?php echo $impfor['marca_razao']?></td></tr>
    <tr>
    <th>CNPJ:</th>
    <td ><?php echo $impfor['marca_cnpj']?></td>
    <th width="15%">Telefone:</th>
    <td ><?php echo $impfor['marca_telefone']?></td></tr>
    <tr>
    <th>Endereço:</th>
    <td ><?php echo $impfor['marca_endereco']?></td>
    <th>Bairro:</th>
    <td ><?php echo $impfor['marca_bairro']?></td></tr>
    <tr>
    <th>Cidade:</th>
    <td ><?php echo $impfor['marca_cidade']." - ".$impfor['marca_estado']; ?></td>
    <th>CEP:</th>
    <td ><?php echo $impfor['marca_cep']?></td></tr>
    </table></td>
    </tr>
	<tr>
    <th>Numero de Serie</th>
    <th>Tipo</th>
    <th>Produto</th>
    <th>Marca</th>
    <th>Modelo</th>
    </tr>
    <?php 
				
	
			$sqlmimp="select * from vw_os where cod_romaneio='".$codrom."';";
			$rsmimp=pg_query($conexao,$sqlmimp);
			while($mimpos=pg_fetch_array($rsmimp))
			{
	 		?>    
    		<tr>
    		<th align="center"><?php echo $mimpos['os_numserie_prod'] ?></th>
   			<td align="center"><?php echo $mimpos['tipo']?></td>
   			<td align="center"><?php echo $mimpos['produto']?></td>
   			<td align="center"><?php echo $mimpos['marca']?></td>
   			<td align="center"><?php echo $mimpos['modelo']?></td></tr>
            <?php 
			}//while
			?>
	<tr>
        <td colspan="5">
        <table border="2" width="100%">	
			<tr>
            <th align="center" colspan="2">Totalização</th></tr>
            <tr>
            <th>Modelo</th>
            <th>Quantidade</th></tr>
        <?php
       
		$sqltotrom="select modelo,count(*) from vw_os where cod_romaneio='".$codrom."' group by modelo;";
			$rstotrom=pg_query($conexao,$sqltotrom);
			while($totrom=pg_fetch_array($rstotrom))
			{
        	?>
			<tr>
            <th align="center"><?php echo $totrom['modelo']?></th>
            <th align="center"><?php echo $totrom['count']?></th></tr>
	<?php		
		}//while totalização
	?>
    </table></td></tr>
  </table>
    <table width="100%" border="0" class="nao_imprimir">
    <tr>
    <td align="right">
    <input type="button" id="btimp" value="Imprimir" onClick="imprimir()" ></td>
    <td><a href="../romaneio/romInterno.php"><input type="button" name="cancelar" value="cancelar"></a></td></tr>
</table>

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