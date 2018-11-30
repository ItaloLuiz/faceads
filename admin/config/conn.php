<?php 
// Create a connection, once only.
$config = array(
            'driver'    => 'mysql', // Db driver
            'host'      => 'localhost',
            'database'  => 'sistema_face',
            'username'  => 'root',
            'password'  => '',
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
$hoje = date('Y-m-d');