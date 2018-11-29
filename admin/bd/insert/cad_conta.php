<?php 

include '../../config/conn.php';

$origem = 'nova_conta.php';


$account_id   = $_POST['account_id'];
$nome_unidade = $_POST['nome_unidade'];

$dados = array(
    'account_id'=>$account_id,
    'nome_unidade'=>$nome_unidade
);

$insert = QB::table('tbl_contas')->insert($dados);

if(!$insert){
    header("Location:../../$origem?status=erro");
    die;
    exit;
}else{
    header("Location:../../$origem?status=sucesso");
    die;
    exit;
}