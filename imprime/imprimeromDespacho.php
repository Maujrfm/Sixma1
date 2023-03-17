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
	window.setTimeout("location.href='../romaneio/romDespacho.php';",1)
    }
    </script>
    



<title>Sixma</title>
<?php
session_start();
if(isset($_SESSION['login']))
{
	
$codrom=$_POST['codrom'];
$nf=$_POST['nf'];
$qtdv=$_POST['qtdv'];


include '../inc/conexao.inc.php';

$sqluprom="update tb_romaneio set rom_nf='".$nf."',rom_status=2 where cod_romaneio ='".$codrom."';";
$rsuprom=pg_query($conexao,$sqluprom);

$sqlcimprom="select * from tb_romaneio where cod_romaneio ='".$codrom."';";
$rscimprom=pg_query($conexao,$sqlcimprom);
$impforrom=pg_fetch_array($rscimprom);

$data=$impforrom['rom_data'];

$sqlcimp="select * from tb_marca where cod_marca ='".$impforrom['cod_marca']."';";
$rscimp=pg_query($conexao,$sqlcimp);
$impfor=pg_fetch_array($rscimp);


$sqlcemp="select * from tb_empresa ;";
$rscemp=pg_query($conexao,$sqlcemp);
$impemp=pg_fetch_array($rscemp);


?>
<body onLoad="imprimir()">
<?php 

for($i=1;$i<=$qtdv;$i++)
{
?>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
	<thead>
    <tr>
	<th align="center" valign="middle" width="10%">
	<img src="../img/Logo.png" width="203" height="101" alt="Sixma"  style="float: left;"/></th>
	<th><h1> Romaneio de Despacho </h1></th>
    <th><h4>Nota Nº:</h4><h2> <?php echo $nf?></h2><h2>Vol:<?php echo $i."/".$qtdv ; ?></h2></th></tr></thead>   
    <tr>
    <td colspan="5">
    <table border="1" width="100%">
    <tr><th colspan="4"><h1>Destinatário</h1></th></tr>
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
    <td><?php echo $impfor['marca_cep']?></td></tr>
    <tr><th align="left" colspan="4"><h4>Remetente</h4></th></tr>
    <tr>
    <td colspan="3">
    <table border="1" width="100%">
    <tr>
    <th width="10%" align="center">Razão Social:  </th>
    <td colspan="3"><?php echo $impemp['emp_razao']?></td></tr>
    <tr>
    <th>CNPJ:</th>
    <td ><?php echo $impemp['emp_cnpj']?></td>
    <th width="15%">Telefone:</th>
    <td ><?php echo $impemp['emp_telefone']?></td></tr>
    <tr>
    <th>Endereço:</th>
    <td ><?php echo $impemp['emp_endereco']?></td>
    <th>Bairro:</th>
    <td ><?php echo $impemp['emp_bairro']?></td></tr>
    <tr>
    <th>Cidade:</th>
    <td ><?php echo $impemp['emp_cidade']." - ".$impemp['emp_estado']; ?></td>
    <th>CEP:</th>
    <td><?php echo $impemp['emp_cep']?></td></tr></table>
    </td></tr>
    </table></td></tr></table>
    <?php if($i!=$qtdv){
?>
<div style="page-break-before: always"></div>;
  <?php 
	}
	}//for 

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