<?php
  include 'includes/header.php';
  
  $dt_primeiro_dia = date('Y-m').'-01';
  
  $get_account_id = $_GET['account_id'];
  $nome_unidade = GetUnidade($get_account_id);
  $get_a_name = $_GET['a_name'];
  $get_c_id   = $_GET['c_id'];
  $get_dt_ini = $_GET['dt_ini'];
  $total_gasto_mes = $_GET['gasto'];
  
  $query_log = QB::table('tbl_log_ads')
  ->where('account_id','=',$get_account_id)
  ->where('campaign_id','=',$get_c_id)
  ->where('data_inicio','=',$get_dt_ini);  
  
  $contar = $query_log->count();
  $result_log = $query_log->get();
  
  $actions = $result_log[0]->actions;  
  include 'includes/menu.php';
  ?>
<div class="container home">
  <div class="row">
    <div class="col-md-4 btn-new">
      <a class="btn btn-primary" href="detalhes.php?id=<?php echo $get_account_id;?>&N=<?php echo $get_a_name;?>">Voltar</a> 
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <!--<div class="panel panel-info">
        <div class="panel-heading">
         <h4>Unidade</h4>
         <h5><?php echo $nome_unidade;?></b></h5>
        </div>
        </div>-->
      <!-- Apply any bg-* class to to the info-box to color it -->
      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-building-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Unidade</span>
          <span class="info-box-number"><?php echo $nome_unidade;?></span>
          <!-- The progress section is optional -->
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-4">
      <!--<div class="panel panel-info">
        <div class="panel-heading">
         <h4>Campanha</h4>
         <h5><b><?php echo $get_a_name;?></b> -  Data: <b><?php echo DataBr($dt_primeiro_dia);?></b></h5>
        </div>
        </div>-->
      <!-- Apply any bg-* class to to the info-box to color it -->
      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-bookmark"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Campanha</span>
          <span class="info-box-number"><b><?php echo $get_a_name;?></b> -  Data: <b><?php echo DataBr($dt_primeiro_dia);?></b></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-4">
      <!--<div class="panel panel-danger">
        <div class="panel-heading">
         <h4>Total Gasto</h4>
         <h5>R$ <?php echo $total_gasto_mes;?></h5>
        </div>
        </div>-->
      <!-- Apply any bg-* class to to the info-box to color it -->
      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="fa fa-money"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Gasto</span>
          <span class="info-box-number">R$ <?php echo $total_gasto_mes;?></span>
          <!-- The progress section is optional -->
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- box lte--> 
    <!-- box lte-->
    <div class="col-md-12">
    </div>
    <?php  
      $to_array =  json_decode($actions,true);
      foreach($to_array as $key => $row){ 
      
          switch($row['action_type']){
              case 'comment';
              $tipo = 'Comentário(s)';
              $icone = 'fa-comments-o';
              $classe = 'bg-blue';
              break;
      
              case 'post';
              $tipo = 'Post(s)';
              $icone = 'fa-bullhorn';
              $classe = 'bg-blue';
              break;
      
              case 'post_reaction';
              $tipo = 'Reações ao post';
              $icone = 'fa-thumbs-o-up';
              $classe = 'bg-blue';
              break;
      
              case 'onsite_conversion.messaging_reply';
              $tipo = 'Respostas a mensagens';
              $icone = 'fa-envelope-o';
              $classe = 'bg-blue';
              break;
      
              case 'onsite_conversion.messaging_first_reply';
              $tipo = 'Novas conversas em um aplicativo de mensagens';
              $icone = 'fa-commenting-o';
              $classe = 'bg-blue';
              break;
      
              case 'onsite_conversion.messaging_conversation_started_7d';
              $tipo = 'Conversas por mensagem iniciadas';
              $icone = 'fa-commenting-o';
              $classe = 'bg-blue';
              break;
      
              case 'link_click';
              $tipo = 'Cliques no link';
              $icone = 'fa-link';
              $classe = 'bg-blue';
              break;
      
              case 'page_engagement';
              $tipo = 'Engajamento na página';
              $icone = 'fa-line-chart';
              $classe = 'bg-blue';
              break;
      
              case 'post_engagement';
              $tipo = 'Engajamento no post';
              $icone = 'fa-line-chart';
              $classe = 'bg-blue';
              break;
          }
      
         //print_r($row);  
        
         $box = '<div class="col-md-4">';
          $box .= '<div class="panel panel-primary">';
           $box .= '<div class="panel-heading">';
            $box .= '<h5>'.$tipo.'</h5>';
            $box .= '<h3><b>'.$row['value'].'</b></h3>';
           $box .= '</div>';
          $box .= '</div>';
         $box .= '</div>';
      
         //echo $box;
         
         //echo $action_type = $row['action_type'].' - '.$value = $row['value'].'<br>';      
      ?>
    <div class="col-md-4">
      <!-- Apply any bg-* class to to the icon to color it -->
      <div class="info-box">
        <span class="info-box-icon <?php echo $classe;?>"><i class="fa <?php echo $icone;?>"></i></span>
        <div class="info-box-content">
          <span class="info-box-text"><?php echo $tipo;?></span>
          <span class="info-box-number"><?php echo $row['value'];?></span>
        </div>
      </div>
      <!-- info-box -->
    </div>
    <?php } ?>
  </div>
</div>
<?php include 'includes/footer.php';?>