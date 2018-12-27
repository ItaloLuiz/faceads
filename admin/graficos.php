<?php include 'includes/header.php';

$get_conta = $_GET['id'];
  
//caso queira setar uma data estática
//$dt_primeiro_dia = date('Y-m').'-01';
if(!isset($_GET['data_ini'])){//caso não passe uma data seto o primeiro dia do mês corrente
$dt_primeiro_dia = date('Y-m').'-01';
}else{
$dt_primeiro_dia = $_GET['data_ini'];
}


?>
<?php include 'includes/menu.php';?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<div class="container home">
  <div class="col-md-12 btn-new">
      <a class="btn btn-primary" href="contas.php">Voltar</a> 
  </div>

<div class="col-md-12">


<div id="container" style="min-width: 310px;  height: 800px; margin: 0 auto"></div>

</div>





</div>
<?php include 'includes/footer.php';?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.2.0/highcharts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.2.0/js/modules/exporting.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.2.0/js/modules/export-data.js"></script>

<script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Gasto total, alcance, impressoes e cliques'
    },
    subtitle: {
        text: 'Unidade: <?php echo $_GET["id"];?>'
    },
    xAxis: {
        categories: ['Gasto Total', 'Alcance', 'Impressoes', 'Cliques'],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Gasto total, alcance, impressoes e cliques',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' '
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: true
    },
    series: [

<?php  for($i=1;$i<=12;$i++){

if($i<10){
    $p = '0'.$i;
}else{
    $p = $i;
}

switch ($i) {
    case '1':
        $mes = 'janeiro';
        break;
    case '2':
        $mes = 'fevereiro';
        break;
    case '3':
        $mes = 'março';
        break;
    case '4':
        $mes = 'abril';
        break;
    case '5':
        $mes = 'maio';
        break;
    case '6':
        $mes = 'junho';
        break;
    case '7':
        $mes = 'julho';
        break;
    case '8':
        $mes = 'agosto';
        break;
    case '9':
        $mes = 'setembro';
        break;
    case '10':
        $mes = 'outubro';
        break;
    case '11':
        $mes = 'novembro';
        break;
    case '12':
        $mes = 'dezembro';
        break;
    
    default:
        $mes = 'janeiro';
        break;
}

$gera_data = date('Y').'-'.$p.'-01';


$seleciona_especifico_mes = QB::table('tbl_log_ads')
->selectDistinct(array('tbl_log_ads.reach', 'tbl_log_ads.spend','impressions','clicks'))
->where('account_id','=',$get_conta)
->where('data_inicio','=',$gera_data);  
$contar = $seleciona_especifico_mes->count();
$result_especifico_mes = $seleciona_especifico_mes->get(); 

$total_gasto_mes   = 0;
$total_alcance_mes = 0;
$impressoes = 0;
$clicks     = 0;

foreach($result_especifico_mes as $row){
   $total_gasto_mes   += $row->spend;
   $total_alcance_mes += $row->reach;    
   $impressoes += $row->impressions; 
   $clicks     += $row->clicks;  

}

if(!empty($total_gasto_mes)){

?>
    //{ y: '<?php echo $mes;?>', a:<?php echo $total_gasto_mes;?>, b: <?php echo $total_alcance_mes;?>,c:<?php echo $impressoes;?>,d:<?php echo $clicks;?> },



        
    {
        name: '<?php echo $mes;?>',
        data: [<?php echo $total_gasto_mes;?>, <?php echo $total_alcance_mes;?>, <?php echo $impressoes;?>,<?php echo $clicks;?>]
    }, 

    <?php } } ?>
    
    ]
});
		</script>
  
