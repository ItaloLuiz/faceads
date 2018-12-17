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

date_default_timezone_set('America/Sao_Paulo');
$hoje = date('Y-m-d');;

$query_contas = QB::table('tbl_unidade_atendimento')->select('chave','nm_unidade_atendimento');
 $qtda = $query_contas->count();
 $result_contas = $query_contas->get();

 $to_json = json_encode($result_contas);

 echo $to_json;
 exit;