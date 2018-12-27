<?php
  include '../admin/classe_bd/vendor/autoload.php';
  include '../admin/config/conn.php';
  include '../funcoes.php';
  include '../config.php'; 
  
  
  if(isset($_GET['unidade'])){
      $nome_unidade = $_GET['unidade'];
     
  }else{
      $nome_unidade = '';
  }
  
  if(isset($_GET['dt_inicio'])){
       $dt_inicio = $_GET['dt_inicio'];
      
  }else{
      $dt_inicio = date('Y-m').'-01';
  }
  
  if(isset($_GET['dt_final'])){
      $dt_final = $_GET['dt_final'];
      
  }else{
      $dt_final = date('Y-m-d');    
  }
  
  $sql = "SELECT sum(reach) as alcance,sum(spend) as gasto,sum(clicks) as cliques, sum(impressions) as impressoes, nome_unidade
  FROM tbl_log_ads
  INNER JOIN tbl_contas
  ON tbl_log_ads.account_id = tbl_contas.account_id
  where data_inicio  BETWEEN '$dt_inicio' and '$dt_final'
  and nome_unidade LIKE '%$nome_unidade%'  
  group by (nome_unidade)
  order by gasto desc;  
  ";
  
  $query = QB::query($sql);
  $result = $query->get();
  
  
  $to_json = json_encode($result);
  $to_array = json_decode($to_json,true);
  ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Valor Gasto, Alcance, cliques e Impressões</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <style>
      body{padding-top:40px;padding-bottom:40px;}
      .tabelas h1{margin-bottom:35px;}
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <div class="col-md-12 tabelas">
        <h1 class="text-center">Valor Gasto, Alcance, cliques e Impressões<br>
        <small>*Valores somados de todas as campanhas</small></h1>
        <div class="table-responsive">
          <div class="well">
            <form name="form" id="form" method="get" action="">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Nome da unidade</label>
                    <input type="text" name="unidade" id="unidade" value="<?php echo $nome_unidade;?>" class="form-control">          
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Data inicio</label>
                    <input type="date" name="dt_inicio" id="dt_inicio" value="<?php echo $dt_inicio;?>" class="form-control">          
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Data final</label>
                    <input type="date" name="dt_final" id="dt_final" value="<?php echo $dt_final;?>" class="form-control">          
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label style="color:transparent;">.</label>
                    <button class="btn btn-primary btn-block" type="submit">Filtrar</button>         
                  </div>
                </div>
              </div>
            </form>
          </div>
           <div class="form-group">
           <a class="btn btn-primary" href="testes.php">Voltar</a>
           </div>

          <table  class="table table-bordered table-hover highchart" data-graph-container-before="1" data-graph-type="column">
            <thead>
              <tr>
                <th>Unidade</th>
                <th>Gasto</th>
                <th>Alcance</th>
                <th>Cliques</th>
                <th>Impressoes</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($to_array as $rows){?>
              <tr>
                <td><?php echo $rows['nome_unidade'];?></td>
                <td><?php echo $rows['gasto'];?></td>
                <td><?php echo $rows['alcance'];?></td>
                <td><?php echo $rows['cliques'];?></td>
                <td><?php echo $rows['impressoes'];?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <div id="container" style="min-width: 310px;  height: 200px; margin: 0 auto"></div>
        </div>
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