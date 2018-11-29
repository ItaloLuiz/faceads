<?php include 'includes/header.php';

$get_conta = $_GET['id'];

$query_log = QB::table('tbl_log_ads')->where('account_id','=',$get_conta);
$contar = $query_log->count();
$result_log = $query_log->get();

?>
<?php include 'includes/menu.php';?>
<div class="container home">
  <div class="row">
    <div class="col-md-4 btn-new">
      <a class="btn btn-primary" href="contas.php">Voltar</a> 
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="table-responsive">
        <table id="table" class="table table-borded">
        <thead>
          <th>account id</th>
          <th>campaign id</th>
          <th>campaign name </th>
          <th>reach</th>
          <th>spend</th>
          <th>data inicio</th>
          <th>data final</th>
          <th>data insercao</th>
        </thead>
        <tbody>
          <?php
          $total_gasto   = 0;
          $total_alcance = 0;
          
          foreach($result_log as $row){

            $total_gasto   += $row->spend;
            $total_alcance += $row->reach;
            
            ?>
          <tr>
            <td><?php echo $row->account_id;?></td>
            <td><?php echo $row->campaign_id;?></td>
            <td><?php echo $row->campaign_name;?></td>
            <td><?php echo $row->reach;?></td>
            <td><?php echo $row->spend;?></td>
            <td><?php echo $row->data_inicio;?></td>
            <td><?php echo $row->data_final;?></td>
            <td><?php echo $row->data_insercao;?></td>
            
          </tr>
          <?php } ?>
        </tbody>
        <tfoot>
        <th colspan="8">
        <h4>Resumo</h4>
        </th>
        <tr>
         <th>Total Gasto: <strong><?php echo $total_gasto;?></strong></th>
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