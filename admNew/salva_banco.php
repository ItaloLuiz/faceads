<?php
    include '../admin/classe_bd/vendor/autoload.php';
    include '../admin/config/conn.php';
    include '../funcoes.php';
    include '../config.php';

    /*
    Para editar as campanhas, ou seja, retirar uma unidade de uma campanha
    primeiro pego via select no banco as unidades atuais
    depois pego o novo campo de unidades enviados
    comparo esses dois, caso o novo enviado tenha 1 item a menos que dizer que o cara
    tirou uma unidade, neste caso pego essa unidade retirada e apago ela no banco de dados.
    */

    echo '<pre>';

    //tirou todas as unidades de uma campanha, limpo o banco contendo o codigo da campanha.
    if(empty($_POST['dados'])){
        $cod_campanha  = $_POST['cod_campanha'];
        QB::table('tbl_rateio')->where('cod_campanha','=',$cod_campanha)->delete();
        echo "<script>window.location.href='index.php?camp=$cod_campanha',true; </script>";
        die; 
    }

    $cod_campanha  = $_POST['cod_campanha'];
    $pega = QB::table('tbl_rateio')
      ->select('unidades_campanha')
      ->where('cod_campanha','=',$cod_campanha);
    $qtda_bd = $pega->count();//conto a quantidade no banco de dados

    $result   = $pega->get();
    $to_json  = json_encode($result);
    $to_array = json_decode($to_json,true);//pego as campanhas do banco para comparar array

    $dados = $_POST['dados'];//pego a lista enviada e comparo com o saida do banco
    $qtda = count($dados);//conto a quantidade passada no post  


    $total_gasto   = $_POST['total_gasto'];
    $alcance_camp  = $_POST['alcance_camp'];
    $calc = $total_gasto/$qtda;
    $calc = number_format($calc,2,'.',',');
    $ratio_camp    = $calc;
    $data_inicio   = $_POST['data_inicio'];
    $data_final    = $_POST['data_final'];
    $data_modificacao = date('Y-m-d H:i:s');


    @$enviadas_post = array_diff($dados,$to_array);//cadastro essa
    @$cadastrada_db = array_diff($to_array,$dados);//apago essa

    //apagar tudo no banco onde as unidades forem diferentes das envidas no post e ligadas a campanha passada no post

    /*print_r($enviadas_post);
    print_r($cadastrada_db);*/

    //primeiro apago todas as unidades "diferentes" pegas no banco array_diff
    foreach($cadastrada_db as $row){
        $cod_campanha  = $_POST['cod_campanha'];
        QB::table('tbl_rateio')
          ->where('unidades_campanha','=',$row)
          ->where('cod_campanha','=',$cod_campanha)->delete();
        echo "<script>window.location.href='index.php?camp=$cod_campanha',true; </script>";
    }

    //cadastro todas as unidades enviadas no post 
    foreach($enviadas_post as $row){
        $dados_post = array(
            'cod_campanha'=>$cod_campanha,
            'valor_total' =>$total_gasto,
            'alcance_campanha' =>$alcance_camp,
            'unidades_campanha'=>$row,
            'valor_rateio'=>$ratio_camp,
            'data_inicio' =>$data_inicio,
            'data_final'  =>$data_final,
            'data_modificacao'=>$data_modificacao
        );
        
        $insertId = QB::table('tbl_rateio')->insert($dados_post); 
        
        if($insertId){
            echo "<script>window.location.href='index.php?camp=$cod_campanha',true; </script>";
        }
    }










