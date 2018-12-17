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

 $cod_campanha  = $_POST['cod_campanha'];
 $pega = QB::table('tbl_rateio')
   ->select('unidades_campanha')
   ->where('cod_campanha','=',$cod_campanha);
   
 $result   = $pega->get();
 $to_json  = json_encode($result);
 $to_array = json_decode($to_json,true);
 
 $get_from_bd =  '';
 foreach($to_array  as $key => $rows){     
    $get_from_bd  .= $rows['unidades_campanha'].',';
 }

 $get_from_bd = substr($get_from_bd,0,-1);//tenho que tirar a virgula final

 $unidades_campanha   = implode(',',$_POST['dados']);   
 $explode = explode(',',$unidades_campanha);
 $explode2 = explode(',',$get_from_bd);
 $qtda = count($explode);      
 
//echo '<pre>';


/*print_r($explode);
print_r($explode2);*/

$array_dif = array_diff($explode2,$explode);//pego essas unidades e apago do banco

//print_r($array_dif);


foreach($array_dif as $row){
    $campanha = $row;
    QB::table('tbl_rateio')->where('unidades_campanha','=',$campanha)->delete();
    QB::table('tbl_rateio')->where('unidades_campanha','=','')->delete();
}




 $total_gasto   = $_POST['total_gasto'];
 $alcance_camp  = $_POST['alcance_camp'];

 $calc = $total_gasto/$qtda;
 $calc = number_format($calc,2,'.',',');

 $ratio_camp    = $calc;
 $data_inicio   = $_POST['data_inicio'];
 $data_final    = $_POST['data_final'];
 $data_modificacao = date('Y-m-d H:i:s');

 $dados = array(
    'cod_campanha'=>$cod_campanha,
    'valor_total' =>$total_gasto,
    'alcance_campanha' =>$alcance_camp,
    'unidades_campanha'=>$unidades_campanha,
    'valor_rateio'=>$ratio_camp,
    'data_inicio' =>$data_inicio,
    'data_final'  =>$data_final,
    'data_modificacao'=>$data_modificacao
 );

 $dados_update = array(
    'unidades_campanha'=>$unidades_campanha,
    'valor_rateio'=>$ratio_camp,
    'data_modificacao'=>$data_modificacao
 );

 //$insertId = QB::table('tbl_rateio')->onDuplicateKeyUpdate($dados_update)->insert($dados);

foreach($explode as $row){

    //print_r($row);


    $dados = array(
        'cod_campanha'=>$cod_campanha,
        'valor_total' =>$total_gasto,
        'alcance_campanha' =>$alcance_camp,
        'unidades_campanha'=>$row,
        'valor_rateio'=>$ratio_camp,
        'data_inicio' =>$data_inicio,
        'data_final'  =>$data_final,
        'data_modificacao'=>$data_modificacao
     );

     
    $insertId = QB::table('tbl_rateio')->insert($dados);  
}

 if($insertId){
    echo '<script>alert("foi");</script>';
     //echo "<script>window.location.href='index.php?camp=$cod_campanha',true; </script>";
 }else{
   $pega = QB::table('tbl_rateio')->where('cod_campanha','=',$cod_campanha);
   $result   = $pega->get();
   $get_data = strtotime($result[0]->data_modificacao);

  /* if(strtotime($data_modificacao) == $get_data){
       echo '<script>alert("atualizada");</script>';
       echo "<script>window.location.href='index.php?camp=$cod_campanha',true;</script>";
   }else{
       echo '<script>alert("erro");</script>';
       echo "<script>window.location.href='index.php?camp=$cod_campanha',true;</script>";
   }*/
   
   echo '<script>alert("erro");</script>';
 }
