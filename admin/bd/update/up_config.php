<?php 

include '../../classe_bd/vendor/autoload.php';
include '../../config/conn.php';

$origem = 'configuracoes.php';



$app_id     = $_POST['app_id'];
$app_secret = $_POST['app_secret'];
$tokken_app = $_POST['tokken_app'];
$base_url   = $_POST['base_url'];

$dados = array(
    'app_id'=>$app_id,
    'app_secret'=>$app_secret,
    'tokken_app'=>$tokken_app,
    'base_url'=>$base_url
);

$insert = QB::table('tbl_configs')->update($dados);

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