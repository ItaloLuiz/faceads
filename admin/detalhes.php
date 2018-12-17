<?php include 'includes/header.php';
  $get_conta = $_GET['id'];
  
  //caso queira setar uma data estática
  $dt_primeiro_dia = date('Y-m').'-01';
  
  $query_log = QB::table('tbl_log_ads')
  ->where('account_id','=',$get_conta)
  ->orderBy('data_insercao','desc');
  
  $contar = $query_log->count();
  $result_log = $query_log->get();
  
  /*
  este select pega apenas o alcance e o total gasto
  é possivel setar a data no where, se não setar ele pegara a soma de todas as campanhas cadastradas no
  banco.
  */
  
  $seleciona_especifico = QB::table('tbl_log_ads')
   ->selectDistinct(array('tbl_log_ads.reach', 'tbl_log_ads.spend'))
   ->where('account_id','=',$get_conta);
   //->where('data_inicio','=',$dt_primeiro_dia)
   //->whereBetween('data_inicio', '2018-06-01', '2018-07-01')
   //->groupBy('campaign_id');
   $result_especifico = $seleciona_especifico->get();
  
   $seleciona_especifico_mes = QB::table('tbl_log_ads')
   ->selectDistinct(array('tbl_log_ads.reach', 'tbl_log_ads.spend'))
   ->where('account_id','=',$get_conta)
   ->where('data_inicio','=',$dt_primeiro_dia);  
   $result_especifico_mes = $seleciona_especifico_mes->get();  
  
   $total_gasto   = 0;
   $total_alcance = 0;
    foreach($result_especifico as $row){
          $total_gasto   += $row->spend;
          $total_alcance += $row->reach;       
  
    }
  
    $total_gasto_mes   = 0;
    $total_alcance_mes = 0;
     foreach($result_especifico_mes as $row){
           $total_gasto_mes   += $row->spend;
           $total_alcance_mes += $row->reach;       
   
     }
  ?>
<?php include 'includes/menu.php';?>
<div class="container home">
  <div class="row">
    <div class="col-md-4 btn-new">
      <a class="btn btn-primary" href="contas.php">Voltar</a> 
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-12">
          <div class="panel">
            <div class="panel-body">    
              <span><?php echo $_GET['N'];?></span> <br>    
              <span> <strong>Dados do mês : <?php echo dataBr($dt_primeiro_dia);?></strong></span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <!-- Apply any bg-* class to to the info-box to color it -->
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-money"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Gasto</span>
              <span class="info-box-number">R$ <?php echo $total_gasto_mes;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-6">
          <!-- Apply any bg-* class to to the info-box to color it -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-line-chart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Alcance</span>
              <span class="info-box-number"><?php echo $total_alcance_mes;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="table-responsive2">
        <table id="table" class="table table-borded">
        <thead>
          <th>account id</th>
          <th>campaign id</th>
          <th>campaign name </th>
          <th>reach</th>
          <th>spend</th>
          <th>Dados extras</th>
          <th>data inicio</th>
          <th>data final</th>
          <th>data insercao</th>
        </thead>
        <tbody>
          <?php
            foreach($result_log as $row){?>
          <tr>
            <td><?php echo $row->account_id;?></td>
            <td><?php echo $row->campaign_id;?></td>
            <td><?php echo $row->campaign_name;?></td>
            <td><?php echo $row->reach;?></td>
            <td><?php echo $row->spend;?></td>
            <td><a href="extras.php?account_id=<?php echo $row->account_id;?>&a_name=<?php echo $row->campaign_name;?>&c_id=<?php echo $row->campaign_id;?>&dt_ini=<?php echo $row->data_inicio;?>&gasto=<?php echo $row->spend;?>">Extras</a></td>
            <td><?php echo $row->data_inicio;?></td>
            <td><?php echo $row->data_final;?></td>
            <td><?php echo $row->data_insercao;?></td>
          </tr>
          <?php } ?>
        </tbody>
        <tfoot>
          <th colspan="9">
            <h4>Resumo</h4>
          </th>
          <?php
            ?>
          <tr>
            <th>Total Gasto: <strong><br>R$ <?php echo $total_gasto;?></strong></th>
            <th>Total Alcance: <strong><?php echo $total_alcance;?></strong></th>
          </tr>
        </tfoot>
      </div>
    </div>
  </div>
</div>
</div>    
<?php include 'includes/footer.php';?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script>
  $(document).ready(function(){  
   $('.apaga').on('click', function(e) {
   	e.preventDefault();    
     const swalWithBootstrapButtons = swal.mixin({
     confirmButtonClass: 'btn btn-success',
     cancelButtonClass: 'btn btn-danger',
     buttonsStyling: false,
  })
  
  swalWithBootstrapButtons({
   title: 'Tem certeza?',
   text: "Você não podera desfazer essa ação!",
   type: 'warning',
   showCancelButton: true,
   confirmButtonText: 'Sim, apague!',
   cancelButtonText: 'Não, cancelar!',
   reverseButtons: true
  }).then((result) => {
   if (result.value) {
     var id = $('.apaga').attr('data-id');
     $.post('bd/delete/del_conta.php',{id:id},function(data){
       $('#resposta').html(data);
       window.location.reload();
     });    
   } else if (
     // Read more about handling dismissals
     result.dismiss === swal.DismissReason.cancel
   ) {
     swalWithBootstrapButtons(
       'Cancelado',
       'Nada foi apagado',
       'error'
     )
   }
  });
  
  
   });
  });
</script>
<script>
  $(document).ready(function() {
      $('#table').DataTable(
        {
          "language": {
              "url": "pt-BR.json"
          }
      }
      );
  } );
</script>