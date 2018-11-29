<?php session_start(); ob_start();
 
// se não existir as sessoes envio o usuario de volta ao login
 if(!isset($_SESSION['control_data']) || (!isset($_SESSION['user_id']))   ){
  header("Location:../login.php?erro=sem-permissao-1");
  exit;
  die;
 }

 //se as sessoes estiverem vazias
 if(empty($_SESSION['control_data']) || (empty($_SESSION['user_id']))   ){
  header("Location:../login.php?erro=sem-permissao-2");
  exit;
  die;
 }

 //se clicar em sair destruo as sessoes 
 if(isset($_GET['sair']) && ($_GET['sair'] == 'logout')){
   session_destroy();
   session_unset();  
   header("Location:../login.php?logout");   
   die;
   exit;

 }

 include 'classe_bd/vendor/autoload.php';
 include 'config/conn.php';
 include 'config/config.php';
 include '../funcoes.php';

 $id_user = $_SESSION['user_id'];
 $query   = QB::table('tbl_login')->where('id_user','=',$id_user);
 $contar  = $query->count();

 if($contar <=0){
  header("Location:../login.php?erro=sem-permissao-3");
  exit;
  die; 
 }
 $result = $query->get();

 $query_contas = QB::table('tbl_contas');
 $qtda = $query_contas->count();
 $result_contas = $query_contas->get();

 $query_config = QB::table('tbl_configs');
 $result_config = $query_config->get();

?>
<!DOCTYPE html>
<html lang="pt-bt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Admin</title>    
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.min.css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="css/style.css">


  </head>
  <body>