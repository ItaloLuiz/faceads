<?php 

include '../../config/conn.php';

$origem = 'contas.php';


$get_del = $_POST['id'];
$del = QB::table('tbl_contas')->where('id_conta','=',$get_del)->delete();


if(!$del){
   echo "<script>swal(
    'Erro',
    'Dado não apagado, tente novamente.',
    'error'
  )</script>";
  echo '<script>history.go(0);</script>';
   die;
   exit;
}else{
    echo "<script>swal(
        'Ok',
        'Dado apagado com sucesso!',
        'success'
      )</script>";
      echo '<script>history.go(0);</script>';
    die;
    exit;
}