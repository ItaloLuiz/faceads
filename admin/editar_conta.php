<?php include 'includes/header.php';
  if(!isset($_GET['id'])){
      header("location:contas.php");
      exit;
      die;
  }
  $get_id = $_GET['id'];
  
  $query_conta = QB::table('tbl_contas')->where('id_conta','=',$get_id);
  $qtda = $query_conta->count();
  $result_conta = $query_conta->get();
  ?>
<?php include 'includes/menu.php';?>
<div class="container home">
  <div class="row">
    <div class="col-md-4 btn-new">
      <a class="btn btn-primary" href="contas.php">Voltar</a> 
    </div>
    <div class="clearfix"></div>
    <div class="container home">
      <?php  if(isset($_GET['status']) && ($_GET['status'] == 'sucesso')){?>
      <div class="alert alert-success">
        <p>Dado editado com sucesso</p>
      </div>
      <?php } ?>
      <?php  if(isset($_GET['status']) && ($_GET['status'] == 'erro')){?>
      <div class="alert alert-danger">
        <p>Erro, Dado não editado</p>
      </div>
      <?php } ?>
      <form name="form" id="form" method="post" action="bd/update/up_conta.php">
        <div class="row">
          <input type="hidden" name="id" value="<?php echo $get_id;?>">
          <div class="col-md-6">
            <div class="form-group">
              <label>Account ID</label>
              <input type="text" name="account_id" id="account_id" class="form-control" value="<?php echo  $result_conta[0]->account_id;?>" required>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Nome da unidade</label>
              <input type="text" name="nome_unidade" id="nome_unidade" class="form-control" value="<?php echo  $result_conta[0]->nome_unidade;?>" required>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Vencimento do cartão</label>
              <input type="number" min="1" name="venc_cartao" id="venc_cartao" class="form-control" value="<?php echo  $result_conta[0]->venc_cartao;?>" required>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Compras até</label>
              <input type="number" min="1" name="compras_ate" id="compras_ate" class="form-control" value="<?php echo  $result_conta[0]->compras_ate;?>"  required>
            </div>
          </div>
          <div class="clearfix"></div>
          
          <div class="col-md-6">
            <div class="form-group">           
              <input type="submit" name="" id="" class="btn btn-primary" value="Atualizar">
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </form>
      <div id="resposta"></div>
    </div>
  </div>
</div>
<?php include 'includes/footer.php';?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.min.js"></script>
<script>
 $(document).ready(function(){
  $('#form').on('submit', function(e) {
  	e.preventDefault();
 	  $(this).ajaxSubmit({
	  	target: '#resposta'
  	});
  });
 });
</script>