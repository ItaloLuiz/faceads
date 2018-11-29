<?php session_start(); ob_start();
  include 'admin/classe_bd/vendor/autoload.php';
  include 'admin/config/conn.php';
  include 'funcoes.php';
  
  
  ?>
<!DOCTYPE html>
<html lang="pt-bt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.min.css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      body{padding:40px;}
      .centro{float:none;margin:0 auto;display:block;}
      .panel-login{border:solid 1px #ccc;}
      .panel-heading h2{font-size:22px;text-transform:uppercase;margin-top:2px;margin-bottom:2px; padding-bottom:10px; border-bottom:dotted 1px #ccc;}
    </style>
  </head>
  <body>
    <div class="container">
      <div class="col-md-4 centro">
        <div class="panel panel-login">
          <div class="panel-heading">
            <h2>Login</h2>
          </div>
          <div class="panel-body">
            <form name="form" id="form" method="post" action="">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Usuário</label>
                    <input type="text" name="usuario" class="form-control" id="usuario" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Senha</label>
                    <input type="password" name="senha" class="form-control" id="senha" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" name="go" id="go" class="btn btn-primary">Logar</button>
                  </div>
                </div>
              </div>
            </form>
            <?php
              if(isset($_POST['go'])){
                  $usuario = $_POST['usuario'];
                  $senha   = $_POST['senha'];
              
                  $query = QB::table('tbl_login')
                    ->where('nome_user','=',$usuario)
                    ->OrWhere('email_user','=',$usuario);
              
                  $contar = $query->count();
                  if($contar >=1){//achou o usuario
              
                   $result = $query->get();
                   $seta_hash = $result[0]->senha_user;//recupero o hash do banco
                      
              
                   if (password_verify($senha, $seta_hash)) {//comparo a senha informada com o hash
                       
                       $_SESSION['control_data'] = date('Y-m-d H:i:s');
                       $_SESSION['user_id'] = $result[0]->id_user;
                       //testo se as sessoes não estão vazias, se não estiverem envio para o admin
                       if(!empty($_SESSION['control_data']) && (!empty($_SESSION['user_id']))   ){
                           header("Location:admin/contas.php");
                           exit;
                           die;
                       }else{// se ocorrer algo errado com a sessao informo mato o script
                           echo '<h4 class="text-center text-danger">Houve um erro, tente novamente</h4>';  
                           die; 
                       }   
              
                   } else {
                       echo '<h4 class="text-center text-danger">Senha inválida</h4>';
                   }
              
              
                  }else{// se não achar o usuario cai no else
                   echo '<h4 class="text-center text-danger">Usuário não encontrado</h4>';
                  }
              
              }
              ?>
          </div>
          <div class="panel-footer">
            
            <span class="pull-left text-left"><a href="">Recuperar Senha</a></span>
            <span class="pull-right text-right"><a href="index.php">Voltar</a></span>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>