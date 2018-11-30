<?php 
/*
$base_url = 'http://localhost/faceads/';
$app_id = '';
$app_secret = '';
$access_token = '';
*/

$query_config = QB::table('tbl_configs');
$contar = $query_config->count();
if($contar<=0){
    echo 'Cadastre os dados do app';
    die;
}

$result_config = $query_config->get();

$base_url = $result_config[0]->base_url;
$app_id = $result_config[0]->app_id;
$app_secret = $result_config[0]->app_secret;
$access_token = $result_config[0]->tokken_app;

