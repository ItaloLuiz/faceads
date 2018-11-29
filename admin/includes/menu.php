<div id="custom-bootstrap-menu" class="navbar navbar-default " role="navigation">
    <div class="container">
        <div class="navbar-header"><a class="navbar-brand" href="contas.php">Painel ADS</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
                <!--<li><a href="index.php">Dashboard</a></li>-->
                <li><a href="contas.php">Contas</a></li>
                <!--<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Contas
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="index.php?conta=conta1">Conta 1</a></li>
          <li><a href="index.php?conta=conta2">Conta 2</a></li>
          <li><a href="index.php?conta=conta2">Conta 2</a></li>
        </ul>
      </li>-->
                <li><a href="configuracoes.php">Configurações</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a>Logado como: <b><?php echo GetUser($result[0]->id_user);?></b></a></li>
                <li><a class="btn-sair" href="?sair=logout">Sair</a></li>
            </ul>
        </div>
    </div>
</div>