<?php
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
  
  $primeiro_dia = $dt_inicio;
  $ultimo_dia   = $dt_final;
  
  $sql = "SELECT sum(spend) as gasto, nome_unidade as unidade,data_inicio as data, actions as dados FROM tbl_log_ads
  INNER JOIN tbl_contas 
  ON tbl_log_ads.account_id = tbl_contas.account_id
  WHERE data_inicio 
  BETWEEN '$primeiro_dia' and '$ultimo_dia'
  GROUP BY nome_unidade
  ORDER BY gasto DESC";
  
  //echo $sql;
  
  
   include '../admin/classe_bd/vendor/autoload.php';
   include '../admin/config/conn.php';
  
   $query    = QB::query($sql);    
   $result   = $query->get();
   $to_json  = json_encode($result);
   $to_array = json_decode($to_json,true);  
  
   function TrataJson($result){  
    $to_array = json_decode($result,true);  
    return $to_array;
   }
  
   $total_geral =0;
   foreach($to_array as $rows){
     $total_geral += $rows['gasto'];
   }
  
   function regra_tres($total,$qtda){
    $regra = $qtda*100 / $total;
    return round($regra,3);
  }
  
  function data_BR($data){
    $originalDate = $data;
    return $newDate = date("d/m/Y", strtotime($originalDate));
  }
  
  
  
  ?>
<div class="col-md-12">
  <h1 class="page-header text-capitalize">Gasto x Comentários<br>
    <small>Periodo: <?php echo data_BR($primeiro_dia);?> a <?php echo data_BR($ultimo_dia);?></small>
  </h1>
  <h3>Gasto Total: R$ <?php echo  number_format($total_geral,2,',','.');?></h3>
</div>
<div class="col-md-12">
  <form name="form" id="form" method="get" action="">
    <input type="hidden" name="tipo" id="tipo"  value="gasto_comments">
    <div class="row">
      <!--<div class="col-md-4">
        <div class="form-group">
          <label>Nome da unidade</label>
          <input type="text" name="unidade" id="unidade"  class="form-control">          
        </div>
        </div>-->
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
<table  class="table table-bordered table-hover highchart" data-graph-container-before="1" data-graph-type="column">
  <thead>
    <tr>
      <th>Unidade</th>
      <th>Gasto</th>
      <th>Comentários</th>
      <!--<th>Porcentagem</th>--> 
    </tr>
  </thead>
  <tbody>
    <?php  
      $total =0;
      foreach($to_array as $rows){
         //echo '<pre>';
      
       $dados = $rows['dados'];
      
       $array =  TrataJson($dados);
       //print_r($array);
      
       $comment = '';
       foreach($array as $row){
      
           if($row['action_type'] == 'comment'){
               $comment .= $row['value'];    
           }
      
       
       $qtda_comment = $comment;
       
      
        $total += $rows['gasto'];
       }
       ?>
    <tr>
      <td><?php echo $rows['unidade'];?></td>
      <td><?php echo $rows['gasto'];?></td>
      <td><?php echo $qtda_comment;?> </td>
      <!--<td><?php echo regra_tres($total_geral,$qtda_comment);?> %</td>-->                
    </tr>
    <?php } ?>
  </tbody>
</table>
<div id="container" style="min-width: 310px;  height: 200px; margin: 0 auto"></div>