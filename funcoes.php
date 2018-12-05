<?php 

//pega o id da conta de anuncios
function  CadLogs($account_id,$base_url){

$post = [
    'conta' => $account_id   
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
    return 'erro no curl';
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

