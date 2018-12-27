<?php
  $primeiro_dia = date('Y').'-01-01';
  $ultimo_dia   = date('Y-m-d');
  
  $sql = "SELECT sum(spend) as gasto, nome_unidade as unidade, data_inicio as data FROM tbl_log_ads
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
  <h1 class="page-header text-capitalize">Maior gasto anual por unidade<br>
    <small>Periodo: <?php echo data_BR($primeiro_dia);?> a <?php echo data_BR($ultimo_dia);?></small>
  </h1>
  <h3>Gasto Total: R$ <?php echo  number_format($total_geral,2,',','.');?></h3>
</div>
<table  class="table table-bordered table-hover highchart" data-graph-container-before="1" data-graph-type="column">
  <thead>
    <tr>
      <th>Unidade</th>
      <th>Gasto</th>
      <th>Porcentagem</th>
    </tr>
  </thead>
  <tbody>
    <?php $total = 0;
      foreach($to_array as $rows){
        $total += $rows['gasto'];
        
        ?>
    <tr>
      <td><?php echo $rows['unidade'];?></td>
      <td><?php echo $rows['gasto'];?></td>
      <td><?php echo regra_tres($total_geral,$rows['gasto']);?> %</td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<div id="container" style="min-width: 310px;  height: 200px; margin: 0 auto"></div>