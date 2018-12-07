<?php 

include '../../classe_bd/vendor/autoload.php';
include '../../config/conn.php';
include '../../../funcoes.php';

$origem = 'contas.php';


$get_del = $_POST['id'];
$del = QB::table('tbl_contas')->where('id_conta','=',$get_del)->delete();


if(!$del){
   echo "<script>swal(
    'Erro',
    'Dado não apagado, tente novamente.',
    'error'
  )</script>";
   die;
   exit;
}else{
  DelLogs($get_del);
    echo "<script>swal(
        'Ok',
        'Dado apagado com sucesso!',
        'success'
      )</script>";      
    die;
    exit;
}