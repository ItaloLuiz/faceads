<?php include 'includes/header.php';?>


<?php include 'includes/menu.php';?>

<div class="container-fluid home">
 <div class="row">

<?php for($i=0;$i<6;$i++){?>
  <div class="col-md-4 col-ms-3">
   <div class="panel panel-widget-topo">   
    <div class="panel-body">
      <h2>Campanha <small>Nome da campanha</small></h2>
      <h4>Total Gasto : <small class="pull-right">R$ 2.600,00</small></h4>
      <h4>Alcance : <small class="pull-right">2000</small></h4>
    </div>   
    <div class="panel-footer">
     <a class="btn btn-primary btn-xs" href="detalhes_campanha.php">Mais Informações</a>
    </div>
   </div>  
  </div>
<?php } ?>
 
 
 
 </div>
</div>



    
<?php include 'includes/footer.php';?>
