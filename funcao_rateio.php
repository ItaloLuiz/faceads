<?php
$base_url = 'http://localhost/faceads/';
$campanha = '6093795462112';
$data     = '2018-12-01';

include 'funcoes.php';

$cad = Cad_rateio($campanha,$data,$base_url);
print_r($cad);

die();
//abaixo testes de inserção com função

$conn = array(
    'servidor'=>'localhost',
    'usuario' => 'root',
    'senha'   => '',
    'banco'   => 'ieb'
);

$dados = array(
    'nome'=>'italo',
    'email'=>'italo.luis@yahoo.com',
    'idade'=>'32'
);

function insere($dados,$tabela,$conn){
  $servidor  = $conn['servidor'];
  $usuario   = $conn['usuario'];
  $senha     = $conn['senha'];
  $banco     = $conn['banco'];

  $conecta = mysqli_connect($servidor,$usuario,$senha,$banco) or die(mysqli_error($conecta));

  $dado = '';
  foreach($dados as $key => $value){
       $value = mysqli_real_escape_string($conecta,$value);
       $value = addslashes($value);
       $dado .= $key.'='."'$value'".','."\n";
  }
  $dado   = substr($dado,0,-2);  
  $sql    = "INSERT INTO $tabela SET $dado";

  
  $insere = mysqli_query($conecta,$sql) or die(mysqli_error($conecta));
  if(!$insere){
      return 'erro,dados não inseridos';
  }else{
      return 'dados inseridos';
  }    

}



$insere = insere($dados,'tbl_contas',$conn);
echo $insere;