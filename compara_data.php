<?php

$data_hoje   = strtotime('2018-12-12 12:00');
$data_futuro = strtotime('2018-12-12 11:00');

if($data_hoje > $data_futuro){
    echo 'passou da data';
}
else if($data_hoje == $data_futuro){
    echo 'encerra hoje';
}
else{
    echo 'esta na data';
}



