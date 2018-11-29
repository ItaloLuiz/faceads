<?php include 'includes/header.php';?>
<?php include 'includes/menu.php';?>
<div class="container home">
  <div class="row">
    <div class="col-md-4 btn-new">
      <a class="btn btn-primary" href="contas.php">Voltar</a> 
    </div>
    <div class="clearfix"></div>
    <div class="container home">    
      <form name="form" id="form" method="post" action="bd/insert/cad_conta.php">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Account ID</label>
              <input type="text" name="account_id" id="account_id" class="form-control" placeholder="258725951253917" required>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Nome da unidade</label>
              <input type="text" name="nome_unidade" id="nome_unidade" class="form-control" placeholder="ieb" required>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-6">
            <div class="form-group">           
              <input type="submit" name="" id="" class="btn btn-primary" value="Cadastrar">
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
  	}).clearForm();
  });
 });
</script>