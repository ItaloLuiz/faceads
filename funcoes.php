<?php 


function  CadLogs($account_id,$base_url){
    // set post fields
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