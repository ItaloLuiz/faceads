<?php 

include '../../config/conn.php';

$origem = 'editar_conta.php';

$get_id = $_POST['id'];
$account_id   = $_POST['account_id'];
$nome_unidade = $_POST['nome_unidade'];

$dados = array(
    'account_id'=>$account_id,
    'nome_unidade'=>$nome_unidade
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