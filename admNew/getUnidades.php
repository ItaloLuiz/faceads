<?php header('Content-Type: application/json');

include '../admin/classe_bd/vendor/autoload.php';
$config = array(
    'driver'    => 'mysql', // Db driver
    'host'      => 'localhost',
    'database'  => 'sistemaw_ieb',
    'username'  => 'sistemaw_ieb',
    'password'  => 'admin@123',
    'charset'   => 'utf8', // Optional
    'collation' => 'utf8_unicode_ci', // Optional
    //'prefix'    => 'cb_', // Table prefix, optional
    //'options'   => array( // PDO constructor options, optional
        //PDO::ATTR_TIMEOUT => 5,
        //PDO::ATTR_EMULATE_PREPARES => false,
    //),
);

$conn = new \Pixie\Connection('mysql', $config, 'QB');

if($conn){
//echo 'ok';
}

$isso  = array('IEB','OralDents',' ','-','Oraldents---','---');
$por   = array('','',' ','','','','');

$unidade = str_replace($isso,$por,$_GET['unidade']);



date_default_timezone_set('America/Sao_Paulo');
$hoje = date('Y-m-d');;

 /*$query_contas = QB::table('tbl_unidade_atendimento')
 ->select('chave','nm_unidade_atendimento')
 ->where('nm_unidade_atendimento','LIKE', '%$unidade%');*/ 
 
 $sql = "SELECT chave,nm_unidade_atendimento FROM tbl_unidade_atendimento WHERE nm_unidade_atendimento LIKE '%$unidade%'";
 
 
 $query_contas = QB::query($sql);
 
 
 //$qtda = $query_contas->count();
 $result_contas = $query_contas->get();

 $to_json = json_encode($result_contas);

 echo $to_json;
 exit;