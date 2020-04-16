<?php

require_once "../Model/Conexao.php";

class Controle
{
    public $Query;
    public $QueryForm;
    public $Banco;
    public $id;
    public $nomeEnt;

    //recebe o resultado da consulta de todos os bancos para o formulário
    function SelectEdu()
    {
        $con = new Conexao();
        $con->BancosEdu();

        $this->QueryForm = $con->getQuery();
    }

/*    function SelectCond()
    {
        $con = new Conexao();
        $con->BancosCond();

        $this->QueryForm = $con->getQuery();
    }*/


    //seleciona a exibição ou exportação dos dados
    public function ctrl($pagina, $entidade, $DataIni, $DataFim)
    {

            switch ($pagina) {
                case "exibirEdu" :

                    //passa os campos selecionados no formulario pelo usuário via url
                    header("Location: ../View/TabelaEdu.php?codigo=".$entidade."&data1=".$DataIni."&data2=".$DataFim);

                    break;

                case "exportarEdu" :

                    $con = new Conexao();

                    $con->SelectTblEdu($entidade, $DataIni, $DataFim);

                    require_once "../Model/ExportacaoEdu.php";

                    $exib = new ExportacaoEdu();
                    $exib->excel($con->getQueryTbl(), $con->getNomeEnt(), $DataIni, $DataFim);

                    break;

            }

/*        switch ($pagina) {
            case "exibirCond" :

                header("Location: ../View/TabelaCond.php?codigo=".$entidade."&data1=".$DataIni."&data2=".$DataFim);

                break;

            case "exportarCond" :

                $con = new Conexao();

                $con->SelectTblCond($entidade, $DataIni, $DataFim);

                require_once "../Model/ExportacaoCond.php";

                $exib = new ExportacaoCond();
                $exib->excel($con->getQueryTbl(), $con->getNomeEnt(), $DataIni, $DataFim);

                break;

        }*/

    }

    public function tabelaEdu($entidade, $DataIni, $DataFim)
    {
        $con = new Conexao();

        $con->SelectTblEdu($entidade, $DataIni, $DataFim);

        $this->Query = $con->getQueryTbl();
    }

/*    public function tabelaCond($entidade, $DataIni, $DataFim)
    {
        $con = new Conexao();

        $con->SelectTblCond($entidade, $DataIni, $DataFim);

        $this->Query = $con->getQueryTbl();
    }*/

}