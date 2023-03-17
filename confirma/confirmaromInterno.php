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
$ns=array();
foreach( $dados as $dado) $ns[] = (string)$dado;
return $ns;
}
$marca=$_POST['marca'];
$tipo=$_POST['tipo'];
$ns=filter($_POST['check']);
$array=implode(',',$ns);
$contns=count($ns);

include '../inc/conexao.inc.php';

$sqlcimp="select * from tb_marca where cod_marca ='".$marca."';";
$rscimp=pg_query($conexao,$sqlcimp);
$impfor=pg_fetch_array($rscimp);
?>
<body>
<form method="post" action="../imprime/imprimeromInterno.php">
<input type="hidden" name="array_ns" value="<?php echo $array ?>">
<input type="hidden" name="marca" value="<?php echo $marca ?>">
<input type="hidden" name="tipo" value="<?php echo $tipo ?>">
<table width="100%" border="1" cellpadding="0" cellspacing="0">
	<thead>
    <tr>
	<th align="center" valign="middle" colspan="6" width="10%">
	<img src="../img/Logo.png" width="203" height="101" alt="Sixma"  style="float: left;"/>
	<br><h1> Romaneio Interno </h1><p align="right"> <?php echo date('d/m/Y')?> </p></th></tr></thead>     
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
		
		$mod_ant="NULL";
		$conttot=0;
		$vetor_modelo[]=0;
		$vetor_qtd[]=0;
		$cm=-1;
		$cc=-1;
		for($i=0;$i<=$contns;$i++)
		{
			if($i<$contns)
			{
			$sqlmimp="select * from vw_os where os_numserie_prod='".$ns[$i]."';";
			$rsmimp=pg_query($conexao,$sqlmimp);
			$mimpos=pg_fetch_array($rsmimp);
	 		?>    
    		<tr>
    		<th align="center"><?php echo $mimpos['os_numserie_prod'] ?></th>
   			<td align="center"><?php echo $mimpos['tipo']?></td>
   			<td align="center"><?php echo $mimpos['produto']?></td>
   			<td align="center"><?php echo $mimpos['marca']?></td>
   			<td align="center"><?php echo $mimpos['modelo']?></td>
       		<?php 
			$mod_atual=$mimpos['modelo'];
			}//impressao
			
			if($contns==1)
			{
				$vetor_modelo[0]=$mod_atual;
				$vetor_qtd[0]=1;
			}
			if($mod_ant=="NULL")
			{
				$mod_ant=$mod_atual;
				$conttot=1;
			}//if
			elseif(strcmp($mod_ant,$mod_atual)==0)
			{
				$conttot++;
				$mod_atual=0;
			}//elseif
			else
			{
				$cm++;
				$cc++;
				$vetor_modelo[$cm]=$mod_ant;
				$vetor_qtd[$cc]=$conttot;
				$mod_ant=$mod_atual;
				$mod_atual=0;
				$conttot=1;
			}//else
		}//for tabela
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
        $countmodelo=count($vetor_modelo);
		for($j=0;$j<$countmodelo;$j++)
		{
        	?>
			<tr>
            <th align="center"><?php echo $vetor_modelo[$j]?></th>
            <th align="center"><?php echo $vetor_qtd[$j]?></th></tr>
	<?php		
		}//for totalização
	?>
    </table></td></tr>
    </table>
    <table width="100%" border="0" class="nao_imprimir">
    <tr>
    <td align="right">
    <input type="submit" id="btimp" value="Imprimir" ></td>
    <td><a href="../romaneio/romInterno.php"><input type="button" name="cancelar" value="cancelar"></a></td></tr>
</table></form>

<?php
}//ifcontador
else
{
	echo "<script> alert('Por favor Selecione uma OS');
		window.location='../romaneio/romInterno.php'; 
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