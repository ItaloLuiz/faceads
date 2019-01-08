<?php

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

/**
 * o script rodara dia 26 de cada mês, pegando os dados do dia 1 até o dia 26.
 */
$cod_campanha = '6081413230512';
$data_inicio  = '2018-01-01';
$data_final   = '2018-01-28';

function Seleciona($query){
    $nome_unidade  = array();
    while($row = mysqli_fetch_assoc($query)){
        $nome_unidade[] = $row;
    }
    return $nome_unidade;  

}


$sql_rateio = "SELECT * FROM tbl_rateio
 WHERE cod_campanha='$cod_campanha'
 AND  data_inicio BETWEEN '$data_inicio' AND '$data_final'";

$query = mysqli_query($conn,$sql_rateio) or die(mysqli_error($conn));
$qtda  = mysqli_num_rows($query);

 if($qtda <=0){
     echo 'sem rateio configurado';
     die();
     exit();
 }

$result = Seleciona($query);

 /*
  * inserir dados do rateio na tabela 
  */

$lista_dias = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
$data = date('Y-m-d');
$diasemana_numero = date('w', strtotime($data));
$hoje = $lista_dias[$diasemana_numero];
$data = date('Y-m-d H-i-s');

//echo '<pre>';
//print_r($result);

$contar_uni = count($result);


$unidades = '';
for($i=0;$i<$contar_uni;$i++){
    $unidades .= $result[$i]['unidades_campanha'].'-';
}

$explode_uni = explode("-",$unidades);

foreach($result as $row){

    $salva_rat = $row['unidades_campanha'];
    $parcela   = $row['valor_rateio'];

 
    $sql_filial =  "SELECT cd_filial FROM tbl_unidade_atendimento WHERE chave='$salva_rat'";
    $query_filial  = mysqli_query($conn_IEB,$sql_filial) or die(mysqli_error($conn_IEB));
    $result_filial = mysqli_fetch_array($query_filial);
    $cd_filial = $result_filial['cd_filial'];
 
    
   //gerar numero para impedir insert duplicado
   $controle = substr(md5($salva_rat.$cd_filial),0,22);
 
   $sql_exists = "SELECT old_chave as chave_controle,nm_unidade_atendimento as unidade
   FROM tbl_financeiro_clinica_parcelas
   INNER JOIN tbl_unidade_atendimento
   ON tbl_financeiro_clinica_parcelas.cd_filial = tbl_unidade_atendimento.cd_filial
   WHERE old_chave='$controle'
   GROUP BY tbl_financeiro_clinica_parcelas.cd_filial
   ORDER BY tbl_financeiro_clinica_parcelas.dt_ultima_edicao DESC ";
 
 
   $query_exists = mysqli_query($conn_IEB,$sql_exists) or die(mysqli_error($conn_IEB));
   $qtda_exists  = mysqli_num_rows($query_exists);


   $nome_unidade  = array();
   while($row = mysqli_fetch_assoc($query_exists)){
       $nome_unidade[] = $row;
    }
    $lista = '';
      foreach ($nome_unidade as $row){ 
         $lista .= $row['chave_controle'].'-';           
     }
$lista   = substr($lista,0,-1);
$explode = explode('-',$lista);

$sql = "
INSERT INTO tbl_financeiro_clinica_parcelas
SET
old_chave = '$controle',
cd_parcela  = '1',
num_parcela = 1,
dia_semana  = '$hoje',
dt_vencimento = '2018-12-12',
valor_parcela = '$parcela',
dt_ultima_edicao = '$data',
cd_filial = '$cd_filial',
valor_credito = '00',
tipo_movimento = 'D',
historico = 'FACEBOOK',
observacoes = 'Pagamento Facebook teste',
dias_atraso = '0',
dt_baixa = '2018-12-12',
categoria = 'teste',
pagamento ='',
num_cheque = '',
tipo_conta = 'G',
plano_contas = '',
numerocartao = '',
dtvalidadecartao = '',
codigoseguranca = '',
operadoracartao = '',
bandeiracartao = '',
chequebanco = '',
chequeagencia = '',
chequeconta = '',
chequenumero = '',
terceiros = '',
numeroboletonota = '',
tipo_tratamento = '',
lab_dtpagamento = '2018-12-12',
extrato_data = '2018-12-12',
extrato_doc = '',
conciliado = '0',
cheque_sem_fundo = '',
cd_prestador = '',
cd_tipo_pagamento = '',
lancamentoManual = '',
chaveOdontoBonus = '',
cd_lote_dentalvidas_gto = '0',
cd_lote_dentalvidas_mens = '0'
";

/*
 pegar o valor do rateio ao chegar nesse arquivo
 pesquisar no banco de dados por com base no campo de controle
 apagar do banco os valores que não baterem com o valor atual do rateio
 */

//valor passado pelo array
$controle_del = substr(md5($salva_rat.$cd_filial),0,22);

//selecionar old_chave no banco de dados
$explode = explode('-',$lista);


$diferenca = array_diff_assoc($explode,$explode_uni);


/*foreach($diferenca as $conta){
    $sql_del = "DELETE FROM tbl_financeiro_clinica_parcelas WHERE old_chave ='$conta'";
    mysqli_query($conn_IEB,$sql_del) or die(mysqli_error($conn_IEB));
}*/



$sql_teste = "SELECT old_chave,valor_parcela
 FROM tbl_financeiro_clinica_parcelas
 WHERE old_chave ='$controle_del'  ";

 echo $sql_teste;


die();



if(in_array($controle,$explode)){//a unidade não esta cadastrada.
    /* 
     se a unidade já esta cadastrada faço um update no banco com o novo valor do rateio
    */
$sql_update = "
 UPDATE tbl_financeiro_clinica_parcelas SET
 valor_parcela = '$parcela',
 dt_ultima_edicao = '$data'
 WHERE old_chave = '$controle'
";
$query  = mysqli_query($conn_IEB,$sql_update) or die(mysqli_error($conn_IEB));

echo 'ta no array<br>'."\n";

}else {    

    try {
        $query  = mysqli_query($conn_IEB,$sql) or die(mysqli_error($conn_IEB));
        if($query){
            echo 'foi<br>'."\n";
        }else{
            echo 'erro<br>'."\n";
        }
    } catch (\Throwable $th) {
        //throw $th;
        echo $th->getMessage();
      
    }
 }


}

mysqli_close($conn);
mysqli_close($conn_IEB);
 