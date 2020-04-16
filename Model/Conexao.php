<?php


class Conexao
{
    private $servidor;
    private $usuario;
    private $senha;
    private $nomeBanco;
    private $banco;
    private $query;
    private $queryTbl;
    private $nomeEnt;

    //construct para realizar a conexão
    function Construct($servidor, $usuario, $senha, $nomeBanco)
    {
        $this->setServidor($servidor);
        $this->setUsuario($usuario);
        $this->setSenha($senha);
        $this->setNomeBanco($nomeBanco);
        $this->Conectar();
    }

    public function setServidor($servidor)
    {
        $this->servidor = $servidor;
    }


    public function getServidor()
    {
        return $this->servidor;
    }


    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }


    public function getUsuario()
    {
        return $this->usuario;
    }


    public function setSenha($senha)
    {
        $this->senha = $senha;
    }


    public function getSenha()
    {
        return $this->senha;
    }


    public function setNomeBanco($nomeBanco)
    {
        $this->nomeBanco = $nomeBanco;
    }


    public function getNomeBanco()
    {
        return $this->nomeBanco;
    }

    //realiza a conexão com o banco de dados
    public function Conectar()
    {
        $this->banco = ibase_connect
        (
            $this->getServidor(),
            $this->getUsuario(),
            $this->getSenha(),
            $this->getNomeBanco()
        );
        if (!($dbhCon = ibase_connect( $this->getServidor(), $this->getUsuario(), $this->getSenha())))
        {
            die('Erro ao conectar: ' . ibase_errmsg());
        }

    }
	
	public function inverteData($data){
		if(count(explode("/",$data)) > 1){
			return implode("-",array_reverse(explode("/",$data)));
		}elseif(count(explode("-",$data)) > 1){
			return implode("/",array_reverse(explode("-",$data)));
		}
	}

    public function SelectTblEdu($codigo, $DataIni, $DataFim)
    {

        // atribui valores as variaveis de conexão para que seja relizada a conexão com banco de dados
        $this->Construct('192.168.254.203:C:\Program Files (x86)\Virtua\Cobranca\Dados_Interbase\COB_DB_COBRANCA.FDB', 'SYSDBA', 'virtuakey', '');


        //consulta o nome do banco que vai dar nome a planilha exportada
        $SqlNomeBanco ="SELECT BANCOS.NOME AS  BANCO FROM BANCOS WHERE BANCOS.CODIGO = '$codigo'";

        // verifica se os campos data foram inseridos no formulário
        if ($DataIni != "" || $DataFim != "" ) {

            $ini = $this->inverteData($DataIni);
            $fim = $this->inverteData($DataFim);
			
            //printf($ini . "<br>");
            //printf($fim);

            $select = "SELECT OPERACOES.NROPERACAO AS OPERACAO, CLIENTES.NOME AS CLIENTE, CLIENTES.CPF AS CPF, OPERACOES.CONDNEGOCIAIS AS ALUNO,
						CAST( OPERACOES.DATAVENCTO as date ) as  DATAVENC, OPERACOES.VALORDIVIDA AS DIVIDA, CLASS_OPERACAO.DESCRICAO AS CLASS_OPERACAO, BANCOS.NOME AS BANCO
						FROM OPERACOES
						INNER JOIN BANCOS ON OPERACOES.BANCO = BANCOS.CODIGO
						INNER JOIN CLIENTES ON OPERACOES.CLIENTE = CLIENTES.CODIGO
						INNER JOIN CLASS_OPERACAO ON OPERACOES.COD_CLASSIFICACAO = CLASS_OPERACAO.CODIGO
						WHERE OPERACOES.STATUS = 'S'
						AND OPERACOES.DATAVENCTO BETWEEN '$ini' AND '$fim'
						AND BANCOS.CODIGO = '$codigo'
						AND OPERACOES.COD_CLASSIFICACAO IN(3, 4, 1, 19, 16, 6, 20, 15, 11, 12)
						AND (CLIENTES.COD_CLASSIFICACAO NOT IN (3, 4) OR CLIENTES.COD_CLASSIFICACAO IS NULL)
						ORDER BY CLIENTES.NOME";

        }else{

            //consulta do relatório de pendências
            $select = "SELECT OPERACOES.NROPERACAO AS OPERACAO, CLIENTES.NOME AS CLIENTE, CLIENTES.CPF AS CPF, OPERACOES.CONDNEGOCIAIS AS ALUNO,
						CAST( OPERACOES.DATAVENCTO as date ) as  DATAVENC, OPERACOES.VALORDIVIDA AS DIVIDA,CLASS_OPERACAO.DESCRICAO AS CLASS_OPERACAO, BANCOS.NOME AS BANCO
						FROM OPERACOES
						INNER JOIN BANCOS ON OPERACOES.BANCO = BANCOS.CODIGO
						INNER JOIN CLIENTES ON OPERACOES.CLIENTE = CLIENTES.CODIGO
						INNER JOIN CLASS_OPERACAO ON OPERACOES.COD_CLASSIFICACAO = CLASS_OPERACAO.CODIGO
						WHERE OPERACOES.STATUS = 'S'
						AND BANCOS.CODIGO = '$codigo'
						AND OPERACOES.COD_CLASSIFICACAO IN(3, 4, 1, 19, 16, 6, 20, 15, 11, 12)
						AND (CLIENTES.COD_CLASSIFICACAO NOT IN (3, 4) OR CLIENTES.COD_CLASSIFICACAO IS NULL)
						ORDER BY CLIENTES.NOME";
        }

        $con = $this->getBanco();

        //atribui o resultado da cunsulta do relatório de pendências para a variavel $queryTbl
        $this->queryTbl = ibase_query($con, $select);

        //atribui o resultado da cunsulta do nome do banco a variavel $nomeEnt
        $queryNome = ibase_query($con, $SqlNomeBanco);
            $row = ibase_fetch_assoc($queryNome);
                $this->nomeEnt =  $row["BANCO"];

    }

    //consulta todos o bancos para ser mostrada no formulário
    public function BancosEdu()
    {

        $this->Construct('192.168.254.203:C:\Program Files (x86)\Virtua\Cobranca\Dados_Interbase\COB_DB_COBRANCA.FDB', 'SYSDBA', 'virtuakey', '');

            $select = "SELECT CODIGO, NOME FROM BANCOS WHERE NOME != '' ORDER BY NOME";

        $con = $this->getBanco();

        $this->query = ibase_query($con, $select);
    }

/*    public function SelectTblCond($codigo, $DataIni, $DataFim)
    {

        $this->Construct('192.168.254.202:C:\Program Files (x86)\Virtua\Cobranca\Dados_Interbase\COB_DB_CONDOMINIO.FDB', 'SYSDBA', 'virtuakey', '');

        $ini = DateTime::createFromFormat('d/m/Y', $DataIni)->format('Y-m-d') ;
        $fim = DateTime::createFromFormat('d/m/Y', $DataFim)->format('Y-m-d') ;

        $select = "SELECT OPERACOES.NROPERACAO AS OPERACAO, CLIENTES.NOME AS CLIENTE, CLIENTES.CPF AS CPF, OPERACOES.CONDNEGOCIAIS AS LOTE,
                  cast( OPERACOES.DATAVENCTO as date ) as  DATAVENC, OPERACOES.VALORDIVIDA AS DIVIDA, BANCOS.NOME AS BANCO
                  FROM  OPERACOES,BANCOS
                  INNER JOIN CLIENTES ON OPERACOES.CLIENTE = CLIENTES.CODIGO
                  WHERE OPERACOES.BANCO = BANCOS.CODIGO AND OPERACOES.DATAVENCTO BETWEEN '$ini' AND '$fim'
                  AND OPERACOES.STATUS = 'S' AND BANCOS.CODIGO = '$codigo'
                  ORDER BY CLIENTES.NOME";

        $con = $this->getBanco();

        $this->queryTbl = ibase_query($con, $select);

        $row = ibase_fetch_assoc($this->queryTbl);

        $this->nomeEnt = $row["BANCO"];

    }

    public function BancosCond()
    {

        $this->Construct('192.168.254.202:C:\Program Files (x86)\Virtua\Cobranca\Dados_Interbase\COB_DB_CONDOMINIO.FDB', 'SYSDBA', 'virtuakey', '');

        $select = "SELECT CODIGO, NOME FROM BANCOS WHERE NOME != '' ORDER BY NOME";

        $con = $this->getBanco();

        $this->query = ibase_query($con, $select);

    }
*/

    public function getBanco()
    {
        return $this->banco;
    }

    public function Desconectar()
    {
        mysqli_close($this->banco);
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getQueryTbl()
    {
        return $this->queryTbl;
    }

    public function getNomeEnt()
    {
        return $this->nomeEnt;
    }


}

?>