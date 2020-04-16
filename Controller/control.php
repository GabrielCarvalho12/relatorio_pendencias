<?php
//envia o dados do formulário para Controle.php

require_once "Controle.php";

$pagina = $_GET["opcao"];
$entidade =$_GET['entidade'];
$DataIni = $_GET['DataIni'];
$DataFim = $_GET['DataFim'];

$cont = new Controle();
$cont->ctrl($pagina, $entidade, $DataIni, $DataFim);

