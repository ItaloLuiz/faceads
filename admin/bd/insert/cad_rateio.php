<?php
/*
Quando clica no botão SALVAR RATEIO aparece duas mensagens
indicando se aquela unidade ligada aquela campanha esta ou não cadastrada
esta no array ou não esta no array.

Uma forma de calcular o rateio para cadastrar na tabela da IEB seria pegar o valor total
e dividir pela quantidade de unidades, e assim pegar  o valor correto e setar para a unidade.

Poderia ocorrer o seguinte problema, quem for fazer o rateio por algum
motivo resolve fazer em duas etapas, neste caso o valor "rateado" entre as unidades
teria uma diferença.

Se optar por fazer tudo no dia 26 que é a data de fechamento do facebook pode diminuir
as chances de problemas deste tipo.

Outro possivel problema seria o usuário ficar modificando as unidades na tela de rateio,
uma provavel solução seria permitir a edição desses dados apenas no dia 26, mas pode
não ser a melhor opção.




*/
date_default_timezone_set('America/Sao_Paulo');

$servidor = 'localhost';
$usuario  = 'sistemaw_ieb';
$senha    = 'admin@123';
$banco    = 'sistemaw_ieb';

$conn = mysqli_connect($servidor,$usuario,$senha,$banco);

if(!$conn){
    echo 'não conectado';
}

if(empty($_POST['salva_rateio'])){
    echo "informe pelo menos uma unidade";
    exit();
    die();
}

$origem        = 'nova_conta.php';
$salva_rateio  = $_POST['salva_rateio'];
$parcela       = $_POST['parcela'];

//pego o código da unidade e pesquiso o codigo da unidade
//$salva_rateio

$lista_dias = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab');
$data = date('Y-m-d');
$diasemana_numero = date('w', strtotime($data));
$hoje = $lista_dias[$diasemana_numero];
$data = date('Y-m-d H-i-s');
    

foreach($salva_rateio as $row){
   $salva_rat = $row;

   $sql_filial =  "SELECT cd_filial FROM tbl_unidade_atendimento WHERE chave='$salva_rat'";
   $query_filial  = mysqli_query($conn,$sql_filial) or die(mysqli_error($conn));
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


  $query_exists = mysqli_query($conn,$sql_exists) or die(mysqli_error($conn));
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

if(in_array($controle,$explode)){//a unidade não esta cadastrada.
    echo 'ta no array'."\n";

}else {    

    try {
        $query  = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        if($query){
            echo 'foi'."\n";
        }else{
            echo 'erro'."\n";
        }
    } catch (\Throwable $th) {
        //throw $th;
        echo $th->getMessage();
      
    }
 }

}


mysqli_close($conn);














/*$sql2 = "INSERT INTO `tbl_financeiro_clinica_parcelas` ( `num_parcela`, `dia_semana`, `dt_vencimento`, `valor_parcela`, `dt_ultima_edicao`, `cd_filial`, `valor_credito`, `tipo_movimento`, `historico`, `observacoes`, `dias_atraso`, `dt_baixa`, `categoria`, `pagamento`, `num_cheque`, `tipo_conta`, `plano_contas`, `numerocartao`, `dtvalidadecartao`, `codigoseguranca`, `operadoracartao`, `bandeiracartao`, `chequebanco`, `chequeagencia`, `chequeconta`, `chequenumero`, `terceiros`, `numeroboletonota`, `tipo_tratamento`, `lab_dtpagamento`, `extrato_data`, `extrato_doc`, `conciliado`, `cheque_sem_fundo`, `cd_prestador`, `cd_tipo_pagamento`, `lancamentoManual`, `chaveOdontoBonus`, `cd_lote_dentalvidas_gto`, `cd_lote_dentalvidas_mens`)
VALUES 
( 1, 'Qua', '2018-11-21', 15.00, '2018-11-21 09:23:47', 29, NULL, 'D', 'Ref  	DEBITO AUT. FAT.CARTAO MASTER CARD FINAL 8297', '', NULL, '2018-11-21', '', '', '', 'G', 'L00400020170217165236', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, '0000-00-00', '', 0, NULL, 'L01100020150414163331', 'L00500020161205113940', 'S', NULL, NULL, NULL);";

*/










