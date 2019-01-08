<?php 

include '../../classe_bd/vendor/autoload.php';
include '../../config/conn.php';

$origem = 'editar_conta.php';

$get_id = $_POST['id'];
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

$insert = QB::table('tbl_contas')->where('id_conta','=',$get_id)->update($dados);

if(!$insert){
    echo "<script>swal(
     'Erro',
     'Dado não editado, tente novamente.',
     'error'
   )</script>";
    die;
    exit;
 }else{
     echo "<script>swal(
         'Ok',
         'Dado editado com sucesso!',
         'success'
       )</script>";
     die;
     exit;
 }