<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gráficos</title>       
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
        #custom-bootstrap-menu.navbar-default .navbar-brand {
    color: rgba(250, 250, 250, 1);
}
#custom-bootstrap-menu.navbar-default {
    font-size: 14px;
    background-color: rgba(0, 126, 229, 1);
    border-width: 0px;
    border-radius: 0px;
}
#custom-bootstrap-menu.navbar-default .navbar-nav>li>a {
    color: rgba(252, 247, 247, 1);
    background-color: rgba(0, 126, 229, 1);
}
#custom-bootstrap-menu.navbar-default .navbar-nav>li>a:hover,
#custom-bootstrap-menu.navbar-default .navbar-nav>li>a:focus {
    color: rgba(242, 233, 233, 1);
    background-color: rgba(0, 119, 181, 1);
}
#custom-bootstrap-menu.navbar-default .navbar-nav>.active>a,
#custom-bootstrap-menu.navbar-default .navbar-nav>.active>a:hover,
#custom-bootstrap-menu.navbar-default .navbar-nav>.active>a:focus {
    color: rgba(245, 235, 235, 1);
    background-color: rgba(0, 119, 181, 1);
}
#custom-bootstrap-menu.navbar-default .navbar-toggle {
    border-color: #0077b5;
}
#custom-bootstrap-menu.navbar-default .navbar-toggle:hover,
#custom-bootstrap-menu.navbar-default .navbar-toggle:focus {
    background-color: #0077b5;
}
#custom-bootstrap-menu.navbar-default .navbar-toggle .icon-bar {
    background-color: #0077b5;
}
#custom-bootstrap-menu.navbar-default .navbar-toggle:hover .icon-bar,
#custom-bootstrap-menu.navbar-default .navbar-toggle:focus .icon-bar {
    background-color: #007ee5;
}
        
        </style>
    </head>
    <body>
        
    <div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation">
    <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" href="index.php">Gráficos</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
                
                <li <?php if(isset($_GET['tipo']) && ($_GET['tipo'] == 'maiorgmes')){ echo 'class="active"';};?>><a href="index.php?tipo=maiorgmes">Maior gasto Mês</a></li>
                <li <?php if(isset($_GET['tipo']) && ($_GET['tipo'] == 'menorgmes')){ echo 'class="active"';};?>><a href="index.php?tipo=menorgmes">Menor gasto Mês</a></li>
                <li <?php if(isset($_GET['tipo']) && ($_GET['tipo'] == 'maiorgano')){ echo 'class="active"';};?>><a href="index.php?tipo=maiorgano">Maior gasto Ano</a></li>
                <li <?php if(isset($_GET['tipo']) && ($_GET['tipo'] == 'menorgano')){ echo 'class="active"';};?>><a href="index.php?tipo=menorgano">Menor gasto Ano</a></li>
                <li <?php if(isset($_GET['tipo']) && ($_GET['tipo'] == 'gasto_alcance')){ echo 'class="active"';};?>><a href="index.php?tipo=gasto_alcance">Gasto x Alcance</a></li>
                <li <?php if(isset($_GET['tipo']) && ($_GET['tipo'] == 'gasto_cliques')){ echo 'class="active"';};?>><a href="index.php?tipo=gasto_cliques">Gasto x Cliques</a></li>
                <li <?php if(isset($_GET['tipo']) && ($_GET['tipo'] == 'gasto_impressoes')){ echo 'class="active"';};?>><a href="index.php?tipo=gasto_impressoes">Gasto x Impressões</a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Outras métricas <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li <?php if(isset($_GET['tipo']) && ($_GET['tipo'] == 'gasto_comments')){ echo 'class="active"';};?>><a href="index.php?tipo=gasto_comments">Gasto x Comentários</a></li>
                <li <?php if(isset($_GET['tipo']) && ($_GET['tipo'] == 'gasto_engajamento')){ echo 'class="active"';};?>><a href="index.php?tipo=gasto_engajamento">Gasto x Engajamento</a></li>
                <li <?php if(isset($_GET['tipo']) && ($_GET['tipo'] == 'gasto_reacoes')){ echo 'class="active"';};?>><a href="index.php?tipo=gasto_reacoes">Gasto x Reações</a></li>                
                </ul>
              </li>
            

            </ul>
        </div>
    </div>
</div>

<div class="container">
 <div class="col-md-12">
  <?php
   if(isset($_GET['tipo'])){
       $tipo = $_GET['tipo'];

       switch ($tipo) {
            case 'maiorgmes':
               include 'template/maiorgmes.php';
               break;
            case 'menorgmes':
               include 'template/menorgmes.php';
               break;
            case 'maiorgano':
               include 'template/maiorgano.php';
               break;
            case 'menorgano':
               include 'template/menorgano.php';
               break;
            case 'gasto_alcance':
               include 'template/gasto_alcance.php';
               break;
            case 'gasto_cliques':
               include 'template/gasto_cliques.php';
               break;
            case 'gasto_impressoes':
               include 'template/gasto_impressoes.php';
               break;
            case 'gasto_comments':
               include 'template/gasto_comments.php';
               break;
            case 'gasto_engajamento':
               include 'template/gasto_engajamento.php';
               break;
            case 'gasto_reacoes':
               include 'template/gasto_reacoes.php';
               break;
           
           default:
               
               break;
       }

   }
  ?>
  

   
 
 </div>
</div>

        
<!-- jQuery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.2.0/highcharts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.2.0/js/modules/exporting.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.2.0/js/modules/export-data.js"></script>
<script src="js/jquery.highchartTable-min.js"></script>

<script>
$(document).ready(function(){
  $(document).ready(function() {
  $('table.highchart').highchartTable();
});
});

</script>
    </body>
</html>
