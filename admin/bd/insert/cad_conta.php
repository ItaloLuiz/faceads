<?php 


include '../../classe_bd/vendor/autoload.php';
include '../../config/conn.php';

$origem = 'nova_conta.php';


$account_id   = $_POST['account_id'];
$nome_unidade = $_POST['nome_unidade'];
$venc_cartao  = $_POST['venc_cartao'];
$compras_ate  = $_POST['compras_ate'];


$dados = array(
    'account_id'=>$account_id,
    'nome_unidade'=>$nome_unidade,
    'venc_cartao'=>$venc_cartao,
    'compras_ate'=>$compras_ate
);

$insert = QB::table('tbl_contas')->insert($dados);

if(!$insert){
   echo "<script>swal(
    'Erro',
    'Dado não inserido, tente novamente.',
    'error'
  )</script>";
   die;
   exit;
}else{
    echo "<script>swal(
        'Ok',
        'Dado inserido com sucesso!',
        'success'
      )</script>";
    die;
    exit;
}