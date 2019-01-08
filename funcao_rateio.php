<?php
$base_url = 'http://localhost/faceads/';
$campanha = '6093795462112';
$data     = '2018-12-01';

include 'funcoes.php';

$cad = Cad_rateio($campanha,$data,$base_url);
print_r($cad);



