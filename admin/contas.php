<?php include 'includes/header.php';?>
<?php include 'includes/menu.php';?>

<div class="container home">
<?php  if(isset($_GET['status']) && ($_GET['status'] == 'sucesso')){?>
  <div class="alert alert-success">
   <p>Dado deletado com sucesso</p>
  </div>
 <?php } ?>

  <?php  if(isset($_GET['status']) && ($_GET['status'] == 'erro')){?>
    <div class="alert alert-danger">
     <p>Erro, Dado não deletado</p>
    </div>
  <?php } ?>
 <div class="row">

 <div class="col-md-4 btn-new">
  <a class="btn btn-primary" href="nova_conta.php">Nova Conta</a> 
 </div>
 <div class="clearfix"></div>

  <div class="col-md-12">
  <div class="table-responsive">
  <table id="table" class="table table-borded">
   <thead>
    <th>ID da Conta</th>
    <th>Nome da Unidade</th>
    <th>Editar</th>   
    <th>Apagar</th>
   </thead>
   <tbody>
<?php foreach($result_contas as $row){?>
    <tr>
     <td><?php echo $row->account_id;?></td>    
     <td><?php echo $row->nome_unidade;?></td> 
     <td><a class="btn btn-primary btn-sm" href="editar_conta.php?id=<?php echo $row->id_conta;?>">Editar</a></td>
     <td><a class="btn btn-danger btn-sm" href="contas.php?del=<?php echo $row->id_conta;?>">Apagar</a></td>
    </tr>  
<?php } ?>

   </tbody>
 
  </div>
 </div>
  
  </div>

  <?php
   if(isset($_GET['del'])){
       $get_del = $_GET['del'];
       $del = QB::table('tbl_contas')->where('id_conta','=',$get_del)->delete();
       if(!$del){
           header("Location:contas.php?status=erro");
           exit;
           die;
       }else{
        header("Location:contas.php?status=sucesso");
        exit;
        die;
       }
   }
   ?>


 
 
 
 </div>
</div>    
<?php include 'includes/footer.php';?>
