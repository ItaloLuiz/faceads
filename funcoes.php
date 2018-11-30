<?php 

//pega o id da conta de anuncios
function  CadLogs($account_id,$base_url){

$post = [
    'conta' => $account_id   
];

$ch = curl_init(''.$base_url.'api.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$response = curl_exec($ch);
curl_close($ch);

if(!$response){
    return 'erro';
}else{
    return 'cadastrado';
}
}

//pegar nome de usuario via id

function GetUser($id){
    $query = QB::table('tbl_login')->where('id_user','=',$id);
    $result = $query->get();
    return $result[0]->nome_user;
}

