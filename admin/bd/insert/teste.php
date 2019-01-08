<?php
echo '<pre>';

date_default_timezone_set('America/Sao_Paulo');

$servidor = 'localhost';
$usuario  = 'root';
$senha    = '';
$banco    = 'sistema_face';

$conn = mysqli_connect($servidor,$usuario,$senha,$banco) or die(mysqli_error());

$servidor_IEB = 'localhost';
$usuario_IEB  = 'sistemaw_ieb';
$senha_IEB    = 'admin@123';
$banco_IEB    = 'sistemaw_ieb';

$conn_IEB = mysqli_connect($servidor_IEB,$usuario_IEB,$senha_IEB,$banco_IEB) or die(mysqli_error());

/*
  o script rodara dia 26 de cada mês, pegando os dados do dia 1 até o dia 26.
  ESTA DANDO BUG, QUANDO TENTA CADSTRAR OUTRA CAMPANHA DA MESMA UNIDADE ? MODIFICADO testar
 */

$cod_campanha = '6081413230512';
$data_inicio  = '2018-01-01';
$data_final   = '2018-01-28';

$data_inicio1  = date('Y-m-d').' 12:00:00';
$data_final1   = date('Y-m-d').' 18:00:00';

function Seleciona($query){
    $nome_unidade  = array();
    while($row = mysqli_fetch_assoc($query)){
        $nome_unidade[] = $row;
    }
    return $nome_unidade;  
}

function Pog($cod_campanha,$uni,$data_inicio,$data_final){
    return md5($cod_campanha.$uni.$data_inicio.$data_final);  
}

$sql_rateio = "SELECT * FROM tbl_rateio
 WHERE cod_campanha='$cod_campanha'
 AND  data_inicio BETWEEN '$data_inicio' AND '$data_final'";
$query = mysqli_query($conn,$sql_rateio) or die(mysqli_error($conn));
$qtda  = mysqli_num_rows($query);

$result_bdFace = Seleciona($query);

//print_r($result_bdFace);
$parcela  =  $result_bdFace[0]['valor_rateio'];
echo $parcela.'<br>';


for($i=0;$i<$qtda;$i++){   
    $cod_campanha =  $result_bdFace[$i]['cod_campanha'];
    $chave_controle_Fac = $result_bdFace[$i]['unidades_campanha'];
    //echo Pog($chave_controle_Fac);
    echo  Pog($cod_campanha,$chave_controle_Fac,$data_inicio,$data_final).'<br>';
   
   }
echo '<hr>';


foreach($result_bdFace as $row){

$cod_campanha     = $row['cod_campanha'];
$unidade_campanha = $row['unidades_campanha'];

$sql_filial     =  "SELECT cd_filial FROM tbl_unidade_atendimento WHERE chave='$unidade_campanha'";
$query_filial   = mysqli_query($conn_IEB,$sql_filial) or die(mysqli_error($conn_IEB));
$result_filial  = mysqli_fetch_array($query_filial);
$cd_filial      = $result_filial['cd_filial'];


 //gerar numero para impedir insert duplicado
 $controle = md5($cod_campanha.$unidade_campanha.$data_inicio.$data_final);
 
 $sql_exists = "SELECT controle as chave_controle,nm_unidade_atendimento as unidade
 FROM tbl_financeiro_clinica_parcelas
 INNER JOIN tbl_unidade_atendimento
 ON tbl_financeiro_clinica_parcelas.cd_filial = tbl_unidade_atendimento.cd_filial
 WHERE controle='$controle'
 GROUP BY tbl_financeiro_clinica_parcelas.cd_filial
 ORDER BY tbl_financeiro_clinica_parcelas.dt_ultima_edicao DESC ";


 $query_exists = mysqli_query($conn_IEB,$sql_exists) or die(mysqli_error($conn_IEB));


 $result_bdIeb = Seleciona($query_exists);
 $chave_controle_IEB = $result_bdIeb[0]['chave_controle'].'<br>';
 $chave_controle_IEB;

 /*tentar buscar no banco da ieb os que estão com valores errados*/

 $sql_select = "SELECT valor_parcela,controle,dt_ultima_edicao
  FROM tbl_financeiro_clinica_parcelas
  WHERE valor_parcela <> '$parcela' 
  AND controle='$controle'
  AND  dt_ultima_edicao BETWEEN '$data_inicio1' AND '$data_final1';
   ";

$sql_select_del = "SELECT valor_parcela,controle,dt_ultima_edicao
  FROM tbl_financeiro_clinica_parcelas
  WHERE valor_parcela = '$parcela' 
  AND controle='$controle'
  AND  dt_ultima_edicao BETWEEN '$data_inicio1' AND '$data_final1';
   ";

//problema nesse caso é que pode apagar coisa errada.
$sql_del = "DELETE FROM tbl_financeiro_clinica_parcelas
WHERE valor_parcela <> '$parcela' 
AND controle='$controle'
AND  dt_ultima_edicao BETWEEN '$data_inicio1' AND '$data_final1'";

echo $sql_select;
echo '<br><hr>';
echo $sql_select_del;

//$query_del = mysqli_query($conn_IEB,$sql_del) or die(mysqli_error($conn_IEB));


}