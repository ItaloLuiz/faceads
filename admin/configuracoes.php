<?php include 'includes/header.php';?>
<?php include 'includes/menu.php';?>
<div class="container home">
  <form name="form" id="form" method="post" action="bd/update/up_config">
  <div class="col-md-6">
      <div class="form-group">
        <label>Url do APP</label>
        <input type="text" name="base_url" id="base_url" class="form-control" value="<?php echo $result_config[0]->base_url;?>" required>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6">
      <div class="form-group">
        <label>App ID</label>
        <input type="text" name="app_id" id="app_id" class="form-control" value="<?php echo $result_config[0]->app_id;?>" required>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6">
      <div class="form-group">
        <label>App Secret</label>
        <input type="text" name="app_secret" id="app_secret" class="form-control" value="<?php echo $result_config[0]->app_secret;?>" required>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Token</label>
        <input type="text" name="tokken_app" id="tokken_app" class="form-control" value="<?php echo $result_config[0]->tokken_app;?>" required>
      </div>
    </div>
    <div class="clearfix"></div>
    <!--<div class="col-md-6">
      <div class="form-group">
        <label>Account ID</label>
        <input type="text" name="" id="" class="form-control" required>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Bussiness ID</label>
        <input type="text" name="" id="" class="form-control" required>
      </div>
    </div>
    <div class="clearfix"></div>-->
    <div class="col-md-6">
      <div class="form-group">
        <input type="submit" name="go" id="go" class="btn btn-primary" value="Atualizar dados">
      </div>
    </div>
    <div class="clearfix"></div>
  </form>
  <div id="resposta"></div>
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