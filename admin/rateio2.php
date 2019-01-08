<?php session_start();
  include '../admin/classe_bd/vendor/autoload.php';
  include '../admin/config/conn.php';
  include '../funcoes.php';
  include '../config.php';

  $url_base = $base_url;

  ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="http://biantigo.webdental.com.br/bootstrap/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="http://biantigo.webdental.com.br/dist/css/style.css" rel="stylesheet" type="text/css" />
    <link href="http://biantigo.webdental.com.br/dist/css/skins/_all-skins.css" rel="stylesheet" type="text/css" />
    <link href="http://biantigo.webdental.com.br/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="http://biantigo.webdental.com.br/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="http://biantigo.webdental.com.br/dist/bootstrap-duallistbox.css">
  </head>
  <body>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Dados para o rateio
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Cadastro Painel Rendimento </li>
        </ol>
      </section>
      <section class="content">
        <div class="row">
        <div class="col-md-12">
        <a class="btn btn-primary" href="detalhes.php?id=<?php echo $_GET['id'];?>&N=<?php echo $_GET['N'];?>">Voltar</a>
        
        </div>
        <div class="clearfix"></div>
        <br>
        
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Contas de anúncios</h3>
              </div>
              <div class="box-body">
                <form name="form" id="form" action="#" method="post" role="form" novalidate>
                  <div class="row">
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="campanha">Campanhas</label>
                        <select  name="campanha" id="campanha" class="form-control" required="required">
                        <option value="">selecione</option>
                         ]
                          <?php
                            $get_id = $_GET['id'];
                            $get_data = $_GET['dt_ini'];
                            $pega_Campanha = file_get_contents(''.$url_base.'listCamp.php?id='.$get_id.'&data='.$get_data.'');
                            $to_array2 = json_decode($pega_Campanha,true);

                            print_r($to_array2);
                            
                            $pega_id1 = $_GET['camp'];
                            foreach($to_array2 as $row){
                               
                                /*comparo a campanha passada via get com a passada no foreach
                                se forem iguais coloco o selected no option*/

                                $campaign_name = $row['campaign_name'];
                                $campaign_id   = $row['campaign_id'];
                            
                                if($pega_id1 == $campaign_id){
                                  $opcao = 'selected';
                                }else{
                                  $opcao = '';
                                }
                            
                            
                            ?>
                          <option <?php echo $opcao;?> value="<?php echo $campaign_id;?>"><?php echo $campaign_name;?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <?php if(isset($_GET['camp'])){
                      $pega_id = $_GET['camp'];
                      
                      $get_campanha = file_get_contents(''.$url_base.'/detalhaCamp.php?id='.$pega_id.'&dt_ini='.$_GET['dt_ini']);
                      $to_array3 = json_decode($get_campanha,true); 
                      //print_r($to_array3);
                      
                      $reach = $to_array3[0]['reach'];
                      $spend = $to_array3[0]['spend'];
                      $data_ini   = $to_array3[0]['data_inicio'];
                      $data_final = $to_array3[0]['data_final'];
                      $unidade    = $to_array3[0]['unidade'];
                      
                      
                      ?>
                    <div class="col-md-6">
                    Periodo: <strong><?php echo dataBr($data_ini);?></strong> até <strong><?php echo dataBr($data_final);?>  </strong>

                      <div class="row">

                        <div class="col-md-4">
                          <h4><b>Valor gasto</b></h4>
                          <h5>R$ <?php echo $spend;?></h5>
                        </div>
                        <div class="col-md-4">
                          <h4><b>Alcance</b></h4>
                          <h5><?php echo $reach;?> pessoas</h5>
                        </div>
                        <div class="col-md-4">
                          <h4><b>Rateio</b></h4>
                          <div id="rateio"></div>
                        </div>

                        <div class="col-md-12">
                         <!--<button type="button" class="btn btn-primary salva-rateio">Salvar Rateio</button>-->
                         <a target="_BLANK" class="btn btn-primary" href="<?php echo $base_url;?>rateio_ieb.php?camp=<?php echo $_GET['camp'];?>&dt_ini=<?php echo $_GET['dt_ini'];?>">Salvar Rateio</a>
                        
                        </div>

                      </div>


                    </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Unidades</label>
                        <?php                         
                          $pega = QB::table('tbl_rateio')->where('cod_campanha','=',$_GET['camp']);
                          $contar = $pega->count();                          

                          if($contar >=1){
                            $result   = $pega->get(); 
                            $get_unidades_camp = '';
                            foreach($result as $row){
                              $get_unidades_camp .=  ','.$row->unidades_campanha;
                            }
                            $get_unidades_campanha = explode(",",$get_unidades_camp);

                            $lista = $get_unidades_campanha;
                            $conta_lista = $pega->count();
                          }else{
                            $result   = '';                        
                            $get_unidades_campanha =  '';
                            $lista = $get_unidades_campanha;
                            $conta_lista = '1';
                          }
                                                
                          $rateio = $spend/$conta_lista;
                          $rateio = number_format($rateio,2,'.',',');                       
                            
                            ?>
                        <select multiple name="unidades[]" id="unidades" class="form-control demo2" required="required">
                                                   <?php 
                             $get_uni = TrocaCarac($_GET['N']);
                            $get_data = $_GET['dt_ini'];
                            //$url = file_get_contents(''.$url_base.'/getAccounts.php');
                            $url = file_get_contents($url_base.'admNew/getUnidades.php?unidade='.$get_uni);
                            $to_array = json_decode($url,true);  
                            print_r($to_array);                  
                            
                            foreach($to_array as $row){
                               //$account_id   = $row['account_id'];
                               //$nome_unidade = $row['nome_unidade']; 

                               $account_id   = $row['chave'];
                               $nome_unidade = $row['nm_unidade_atendimento']; 
                               
                               if(@in_array($account_id,$lista)){
                                 $selected = 'selected';                            
                               }else{
                                 $selected = '';                            
                               }

                               if($_GET['N'] == $nome_unidade){
                                $selected2 = 'selected';     
                               }else{
                                $selected2 = '';     
                               }
                              
                            ?>
                          <option <?php echo $selected;?>  value="<?php echo $account_id;?>"><?php echo $nome_unidade;?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <button type="submit" class="btn btn-primary">Gerar Rateio</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <div id="resposta"></div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://biantigo.webdental.com.br/dist/jquery.bootstrap-duallistbox.js"></script>
    <!-- <script>
      $(document).ready(function(){
          $('#unidades').change(function(){
              var unidade = $(this).val();
              var novoLink = 'index.php?camp='+unidade;             
              window.location.href = novoLink;
          });
      });    
      </script> -->
    <script>
      $(document).ready(function(){
          $('#campanha').change(function(){
              var campanha = $(this).val();
              var data     = '<?php echo $_GET['dt_ini'];?>';
              var novoLink = 'rateio2.php?camp='+campanha+"&id=<?php echo $_GET['id'];?>&N=<?php echo $_GET['N'];?>&dt_ini=<?php echo $_GET['dt_ini'];?>";             
              window.location.href = novoLink;              
          });
      });    
    </script>
    <script>
      $(document).ready(function(){      
        var demo2 = $('.demo2').bootstrapDualListbox({
         nonSelectedListLabel: '',
         selectedListLabel: '',
         preserveSelectionOnMove: 'moved',
         moveOnSelect: false,
         nonSelectedFilter: '',
         selectedFilter: ''
       });      
       $('.demo2').change(function(){
         var select = $(this).append('option:selected').val();      
         /*$.post('salva.php',{select:select},function(data){
              var novoLink = 'index.php?camp=<?php echo $_GET['camp'];?>';             
              //window.location.href = novoLink;      
         });*/           
       });      
        $('#form').submit(function(){
          event.preventDefault();         
      
          var dados = $('.demo2').val();          
          var cod_campanha  = '<?php echo $_GET['camp'];?>';
          var total_gasto   = '<?php echo $spend;?>';
          var alcance_camp  = '<?php echo $reach;?>';
          var ratio_camp    = '<?php echo $rateio;?>';
          var data_inicio   = '<?php echo $data_ini;?>';
          var data_final    = '<?php echo $data_final;?>';
          var id = '<?php echo $_GET['id'];?>';
          var n = '<?php echo $_GET['N'];?>';
          var dt_ini = '<?php echo $_GET['dt_ini'];?>';
      
          $.post('salva_banco.php',{cod_campanha:cod_campanha,dados:dados,total_gasto:total_gasto,alcance_camp:alcance_camp,ratio_camp:ratio_camp,data_inicio:data_inicio,data_final:data_final,id:id,n:n,dt_ini:dt_ini},function(data){
            $('#resposta').html(data);
          });
        });     
            
       $('#rateio').text('R$ <?php echo $rateio;?>');         
      
      });    
    </script>
    <script>
    
     $(document).ready(function(){   

       $('.salva-rateio').click(function(){
        var salva_rateio = $('.demo2').append('option:selected').val(); 
        var parcela = '<?php echo $rateio;?>'; 
        $.post('bd/insert/cad_rateio.php',{salva_rateio:salva_rateio,parcela:parcela},function(data){
          alert(data);
        });
         
         
       });

       
     });
    
    
    </script>
  </body>
</html>