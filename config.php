<?php 
/*
$base_url = 'http://localhost/faceads/';
$app_id = '2204624902915529';
$app_secret = '0a965d1a202b430d2d5aba520e177618';
$access_token = 'EAAfVGDwzhckBAD2royRGO1Lnls4ds7ESHnVUZAtMQKbfBilCk3YbxkDqsRCHkCw38VmyU6y2mBntZA8tIV8sQSuE3dfBVISiwq9cL20WnFjPIiC3k56afvuSPkVF4yc8lJqD02q9ArxadaqGudkD1O5lrIwkf8FLzmswQ1I6p0SVfQlyP7';
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

