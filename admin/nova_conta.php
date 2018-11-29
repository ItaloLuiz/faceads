<?php include 'includes/header.php';?>
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
   <p>Dado inserido com sucesso</p>
  </div>
 <?php } ?>

  <?php  if(isset($_GET['status']) && ($_GET['status'] == 'erro')){?>
    <div class="alert alert-danger">
     <p>Erro, Dado não inserido</p>
    </div>
  <?php } ?>

<form name="form" id="form" method="post" action="bd/insert/cad_conta.php">

<div class="row">

    <div class="col-md-6">
        <div class="form-group">
            <label>Account ID</label>
            <input type="text" name="account_id" id="account_id" class="form-control" required>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Nome da unidade</label>
            <input type="text" name="nome_unidade" id="nome_unidade" class="form-control" required>
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


</div>


 
 
 
 </div>
</div>    
<?php include 'includes/footer.php';?>
