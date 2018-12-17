<?php 

//pega o id da conta de anuncios
function  CadLogs($account_id,$base_url,$dt_ini,$dt_fim){

$post = [
    'conta' => $account_id,
    'dt_ini' => $dt_ini,
    'dt_fim' => $dt_fim   
];

$ch = curl_init(''.$base_url.'api.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$response = curl_exec($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);
curl_close($ch);

if(!$response){
    return 'erro função';
}else{
    return $body;
}
}

//pegar nome de usuario via id

function GetUser($id){
    $query = QB::table('tbl_login')->where('id_user','=',$id);
    $result = $query->get();
    return $result[0]->nome_user;
}

function DelLogs($get_del){
    $query = QB::table('tbl_log_ads')->where('account_id','=',$get_del);
    if(!$query){
        return 'não apagado';
        exit();

    }else{
        return 'apagado';
        exit();

    }


}


function DataBr($data){
    $date = date_create($data);
    return date_format($date,"d/m/Y");
}

function GetUnidade($get_account_id){
    $query = QB::table('tbl_contas')->where('account_id','=',$get_account_id);
    $result = $query->get();
    return $result[0]->nome_unidade;
}


function GetCampaign($id){
     //caso queira setar uma data estática
$dt_primeiro_dia = date('Y-m').'-01';

$get_conta = $_GET['id'];

$seleciona_especifico_mes = QB::table('tbl_log_ads')
->selectDistinct(array('tbl_log_ads.reach', 'tbl_log_ads.spend'))
->where('campaign_id','=',$get_conta)
->where('data_inicio','=',$dt_primeiro_dia);



$result_especifico_mes = $seleciona_especifico_mes->get();



$to_json = json_encode($result_especifico_mes);
echo $to_json;
}