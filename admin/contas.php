<?php include 'includes/header.php';?>
<?php include 'includes/menu.php';?>
<div class="container home">
  <div class="row">
    <div class="col-md-4 btn-new">
      <a class="btn btn-primary" href="nova_conta.php">Nova Conta</a> 
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="table-responsive2">
        <table id="table" class="table table-borded">
        <thead>
          <th>ID da Conta</th>
          <th>Nome da Unidade</th>
          <th>Detalhes</th>
          <th>Ação</th>
        </thead>
        <tbody>
          <?php foreach($result_contas as $row){?>
          <tr>
            <td><?php echo $row->account_id;?></td>
            <td><?php echo $row->nome_unidade;?></td>
            <td><a href="detalhes.php?id=<?php echo $row->account_id;?>&N=<?php echo $row->nome_unidade;?>">Ver detalhes</a></td>
            <td>
              <a class="btn btn-primary btn-sm" href="editar_conta.php?id=<?php echo $row->id_conta;?>">Editar</a>
              <a id="del" class="btn btn-danger btn-sm apaga" data-id="<?php echo $row->id_conta;?>" href="contas.php?del=<?php echo $row->id_conta;?>">Apagar</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
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