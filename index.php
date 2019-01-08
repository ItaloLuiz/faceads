
<?php for($i=1;$i<=12;$i++){
       if($i<10){
        $p = '0'.$i;
       }else{
        $p = $i;
       }
    
?>
<a href="http://localhost/faceads/contas.php?dt_ini=2018-<?php echo $p;?>-01&dt_fim=2018-<?php echo $p;?>-30">Cadastrar mês <?php echo $p;?></a>
<br>
<?php }?>