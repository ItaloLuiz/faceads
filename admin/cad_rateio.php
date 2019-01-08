<?php

$servidor = 'localhost';
$usuario  = 'sistemaw_ieb';
$senha    = 'admin@123';
$banco    = 'sistemaw_ieb';

$conn = mysqli_connect($servidor,$usuario,$senha,$banco);

if(!$conn){
    echo 'não conectado';
}

$sql =  "SELECT cd_filial FROM tbl_unidade_atendimento WHERE chave='L00000020110619123404'";

$query = mysqli_query($conn,$sql) or die(mysqli_error($conn));