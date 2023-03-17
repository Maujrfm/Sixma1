<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sixma</title>
</head>
<?php

session_start();
if($_SESSION['permissao']==2)
{

$validador=$_POST['validador'];
include '../inc/conexao.inc.php';
if($validador==1)
{
	//ucfirst(strtolower())ucwords(strtolower())strtoupper
$fun_nome=ucwords(strtolower($_POST['fun_nome']));
$fun_login=$_POST['fun_login'];
$fun_senha=$_POST['fun_senha'];
$fun_permissao=$_POST['fun_permissao'];
$fun_apelido=ucwords(strtolower($_POST['fun_apelido']));

$sqlfun="insert into tb_funcionario (fun_nome, fun_login, fun_senha, fun_permissao,fun_apelido) values ('".$fun_nome."','".$fun_login."','".$fun_senha."','".$fun_permissao."','".$fun_apelido."');";
$rsfun=pg_query($conexao,$sqlfun);
$valinsfun=pg_affected_rows($rsfun);
if($valinsfun==1)
{
		 echo "<script> alert('Cadastro Efetuado com sucesso!'); 
		 window.location='funcionario.php';
	 		</script> \n";
}
else
{
		 echo "<script> alert('Ocorreu um erro na sua transição'); 
		 window.location='funcionario.php';
		</script> \n";
}
}
elseif($validador==2)
{
$cli_empresa=ucwords(strtolower($_POST['cli_empresa']));
$cli_contato=ucwords(strtolower($_POST['cli_contato']));
$cli_cnpj=$_POST['cnpj'];
$cli_telefone=$_POST['cli_telefone'];
$cli_email=$_POST['cli_email'];

$sqlcli="insert into tb_cliente (cli_empresa, cli_contato, cli_telefone, cli_email,cli_cnpj) values ('".$cli_empresa."','".$cli_contato."','".$cli_telefone."','".$cli_email."','".$cli_cnpj."');";
$rscli=pg_query($conexao,$sqlcli);
$valinscli=pg_affected_rows($rscli);
if($valinscli==1)
{
		 echo "<script> alert('Cadastro Efetuado com sucesso!'); 
		 window.location='cliente.php';
	 		</script> \n";
}
else
{
		 echo "<script> alert('Ocorreu um erro na sua transição'); 
		 window.location='cliente.php';
		</script> \n";
}
}
elseif($validador==3)
{
	$marca_descricao=strtoupper($_POST['marca_descricao']);
	$cnpj=$_POST['cnpj'];
	$marca_razao=strtoupper($_POST['marca_razao']);
	$telefone=$_POST['telefone'];
	$end=ucwords(strtolower($_POST['end']));
	$bairro=ucwords(strtolower($_POST['bairro']));
	$cidade=ucwords(strtolower($_POST['cidade']));
	$estado=strtoupper($_POST['estado']);
	$CEP=$_POST['cep'];
	
	$sqlmarca="insert into tb_marca (marca_descricao,marca_bairro,marca_razao,marca_endereco,marca_cnpj,marca_telefone,marca_cidade,marca_estado,marca_cep) values ('".$marca_descricao."','".$bairro."','".$marca_razao."','".$end."','".$cnpj."','".$telefone."','".$cidade."','".$estado."','".$CEP."');";
$rsmarca=pg_query($conexao,$sqlmarca);
$valinsmarca=pg_affected_rows($rsmarca);
if($valinsmarca==1)
{
		 echo "<script> alert('Cadastro Efetuado com sucesso!'); 
		 window.location='marca.php';
	 		</script> \n";
}
else
{
		 echo "<script> alert('Ocorreu um erro na sua transição'); 
		 window.location='marca.php';
		</script> \n";
}
}
elseif($validador==4)
{
	$sit_descricao=ucwords(strtolower($_POST['sit_descricao']));
	
	$sqlsit="insert into tb_situacao (sit_descricao) values ('".$sit_descricao."');";
$rssit=pg_query($conexao,$sqlsit);
$valinssit=pg_affected_rows($rssit);
if($valinssit==1)
{
		 echo "<script> alert('Cadastro Efetuado com sucesso!'); 
		 window.location='situacao.php';
	 		</script> \n";
}
else
{
		 echo "<script> alert('Ocorreu um erro na sua transição'); 
		 window.location='situacao.php';
		</script> \n";
}
}
elseif($validador==5)
{
	$sts_descricao=ucwords(strtolower($_POST['sts_descricao']));
	
	$sqlsts="insert into tb_status (sts_descricao) values ('".$sts_descricao."');";
$rssts=pg_query($conexao,$sqlsts);
$valinssts=pg_affected_rows($rssts);
if($valinssts==1)
{
		 echo "<script> alert('Cadastro Efetuado com sucesso!'); 
		 window.location='status.php';
	 		</script> \n";
}
else
{
		 echo "<script> alert('Ocorreu um erro na sua transição'); 
		 window.location='status.php';
		</script> \n";
}
}
elseif($validador==6)
{
	$tipo_descricao=strtoupper($_POST['tipo_descricao']);
	
	$sqltipo="insert into tb_tipo (tipo_descricao) values ('".$tipo_descricao."');";
$rstipo=pg_query($conexao,$sqltipo);
$valinstipo=pg_affected_rows($rstipo);
if($valinstipo==1)
{
		 echo "<script> alert('Cadastro Efetuado com sucesso!'); 
		 window.location='tipo.php';
	 		</script> \n";
}
else
{
		 echo "<script> alert('Ocorreu um erro na sua transição'); 
		 window.location='tipo.php';
		</script> \n";
}
}
elseif($validador==7)
{
	$cod_tipo=$_POST['cod_tipo'];
	$prod_descricao=strtoupper($_POST['prod_descricao']);
	
	$sqlprod="insert into tb_produto (cod_tipo,prod_descricao) values ('".$cod_tipo."','".$prod_descricao."');";
$rsprod=pg_query($conexao,$sqlprod);

$valinsprod=pg_affected_rows($rsprod);
if($valinsprod==1)
{
		 echo "<script> alert('Cadastro Efetuado com sucesso!'); 
		 window.location='produto.php';
	 		</script> \n";
}
else
{
		 echo "<script> alert('Ocorreu um erro na sua transição'); 
		 window.location='produto.php';
		</script> \n";
}
}
elseif($validador==8)
{
	$cod_tipo=$_POST['tipo'];
	$cod_produto=$_POST['produto'];
	$cod_marca=$_POST['marca'];
	$mod_descricao=strtoupper($_POST['mod_descricao']);
	
	$sqlmod="insert into tb_modelo (cod_tipo,cod_produto,cod_marca,mod_descricao) values ('".$cod_tipo."','".$cod_produto."','".$cod_marca."','".$mod_descricao."');";
$rsmod=pg_query($conexao,$sqlmod);
$valinsmod=pg_affected_rows($rsmod);

if($valinsmod==1)
{
		 echo "<script> alert('Cadastro Efetuado com sucesso!'); 
		 window.location='modelo.php';
	 		</script> \n";
}
else
{
		 echo "<script> alert('Ocorreu um erro na sua transição'); 
		 window.location='modelo.php';
		</script> \n";
}
}
 elseif($validador==9)
{
	$tipo_reg=ucwords(strtolower($_POST['tipo_registro']));
	
	$sqltiporeg="insert into tb_tipo_reg (tipo_reg_descricao) values ('".$tipo_reg."');";
$rstiporeg=pg_query($conexao,$sqltiporeg);
$valinstiporeg=pg_affected_rows($rstiporeg);
if($valinstiporeg==1)
{
		 echo "<script> alert('Cadastro Efetuado com sucesso!'); 
		 window.location='tiporeg.php';
	 		</script> \n";
}
else
{
		 echo "<script> alert('Ocorreu um erro na sua transição'); 
		 window.location='tiporeg.php';
		</script> \n";
}
}

elseif($validador==10)
{
	$cod_modelo=$_POST['mod'];
	$nst=strtoupper($_POST['nst']);
	
	$sqlbkp="insert into tb_backup (cod_modelo,bkp_num_serie) values ('".$cod_modelo."','".$nst."');";
$rsbkp=pg_query($conexao,$sqlbkp);
$valinsbkp=pg_affected_rows($rsbkp);
if($valinsbkp==1)
{
		 echo "<script> alert('Cadastro Efetuado com sucesso!'); 
		 window.location='prod_backup.php';
	 		</script> \n";
}
else
{
		 echo "<script> alert('Ocorreu um erro na sua transição'); 
		 window.location='prod_backup.php';
		</script> \n";
}
}
elseif($validador==11)
{
	$cod_tipo=$_POST['tipo'];
	$cod_produto=$_POST['produto'];
	$prob_descricao=strtoupper($_POST['prob_descricao']);
	
	$sqlprob="insert into tb_problema (cod_produto,prob_descricao) values ('".$cod_produto."','".$prob_descricao."');";
$rsprob=pg_query($conexao,$sqlprob);
$valinsprob=pg_affected_rows($rsprob);

if($valinsprob==1)
{
		 echo "<script> alert('Cadastro Efetuado com sucesso!'); 
		 window.location='problema.php';
	 		</script> \n";
}
else
{
		 echo "<script> alert('Ocorreu um erro na sua transição'); 
		 window.location='problema.php';
		</script> \n";
}
}
elseif($validador==12)
{
	$cnpj=$_POST['cnpj'];
	$emp_razao=strtoupper($_POST['marca_razao']);
	$telefone=$_POST['telefone'];
	$end=ucwords(strtolower($_POST['end']));
	$bairro=ucwords(strtolower($_POST['bairro']));
	$cidade=ucwords(strtolower($_POST['cidade']));
	$estado=strtoupper($_POST['estado']);
	$CEP=$_POST['cep'];
	
	$sqlempresa="insert into tb_empresa (emp_bairro,emp_razao,emp_endereco,emp_cnpj,emp_telefone,emp_cidade,emp_estado,emp_cep) values ('".$bairro."','".$emp_razao."','".$end."','".$cnpj."','".$telefone."','".$cidade."','".$estado."','".$CEP."');";
$rsempresa=pg_query($conexao,$sqlempresa);
$valinsempresa=pg_affected_rows($rsempresa);
if($valinsempresa==1)
{
		 echo "<script> alert('Cadastro Efetuado com sucesso!'); 
		 window.location='empresa.php';
	 		</script> \n";
}
else
{
		 echo "<script> alert('Ocorreu um erro na sua transição'); 
		 window.location='empresa.php';
		</script> \n";
}
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