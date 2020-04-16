
<?php
$codigo = $_GET['codigo'];
$data1 = $_GET['data1'];
$data2 = $_GET['data2'];

require_once "../Controller/Controle.php";

$cont = new Controle();
$cont->SelectCond();
$cont->tabelaCond($codigo, $data1, $data2);

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="br">
<head>
    <?php include_once "head.php"?>
</head>

<body class="hold-transition skin-blue layout-top-nav">

<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header" style="margin-left: -4%">
                    <a href="index.php" class="navbar-brand"><b> <i class="fa fa-pencil-square-o"></i> Relatório</b>Pendência</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Educação</a></li>
                        <li class="active"><a href="Condominio.php">Condomínio</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.container-fluid -->

            <!-- <div class="navbar-custom-menu">
                 <ul class="nav navbar-nav">

                     <li class="dropdown user user-menu">

                         <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                             <span class="hidden-xs"> <i class="fa fa-arrow-left" ></i> SAIR </span>
                         </a>
                         <ul class="dropdown-menu">

                             <li class="user-header">
                                 <img src="../public/dist/img/Exit_delete_close_remove_door_logout_out.png"  alt="User Image">

                                 <p>
                                     Deseja realmente sair ?
                                 </p>
                             </li>

                             <li class="user-footer">
                                 <div class="pull-left">
                                     <a href="#" class="btn btn-default btn-flat">SIM</a>
                                 </div>
                                 <div class="pull-right">
                                     <a href="#" class="btn btn-default btn-flat">NÃO</a>
                                 </div>
                             </li>
                         </ul>
                     </li>

                 </ul>
             </div>-->
        </nav>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Condomínio</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" align="center">
                    <div class="row" align="left">

                        <form name="form" action="../Controller/control.php" method="get">


                            <div class="col-md-3">
                                <div class="form-group">
                                    <h4>Bancos:</h4>
                                    <select name="entidade" class="form-control" style="width: 100%;">
                                        <option value=""> Selecione um banco </option>

                                        <?php
                                        while ($row = ibase_fetch_object($cont->QueryForm))
                                        { ?>
                                            <option value=<?php echo $row->CODIGO ?> <?php if($codigo == $row->CODIGO) {echo "selected";}?>><?php echo utf8_encode($row->NOME) ?></option>
                                        <?php } ?>

                                    </select>

                                </div>
                            </div>

                            <!-- Date -->
                            <div class="col-md-2" style="margin-top: 1.2%">
                                <label>Date Inicial:</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input value="<?php echo $data1?>" name="DataIni" type="text" class="form-control pull-right" id="datepicker-inicio">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->

                            <!-- Date -->
                            <div class="col-md-2" style="margin-top: 1.2%">
                                <label>Date Final:</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input value="<?php echo $data2?>" name="DataFim" type="text" class="form-control pull-right" id="datepicker-fim">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- /.form group -->


                            <div class="col-md-2" style="margin-top: 4%">
                                <div class="form-group">
                                    <!-- radio -->
                                    <div class="form-group">
                                        <label>
                                            <input type="radio" name="opcao" value="exibirCond" class="minimal" checked>
                                            Tabela
                                        </label>
                                        <label style="margin-left: 12%">
                                            <input type="radio" name="opcao" value="exportarCond" class="minimal">
                                            Csv
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1" style="margin-top: 3.3%; margin-left: -3%">
                                <button type="submit" class="btn btn-block btn-primary" onclick="return validar()">Executar</button>
                            </div>

                        </form>

                        <div class="col-xs-12">

                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Operação</th>
                                            <th>Cliente</th>
                                            <th>CPF/CNPJ</th>
                                            <th>Lote</th>
                                            <th>Dt. Vcto.</th>
                                            <th>Vlr. Dívida</th>
                                            <th>Banco Nome</th>
                                            <!--<th>Resolução da Pendência</th>-->
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php

                                        if($cont->Query!= NULL){

                                            while ($row = ibase_fetch_object($cont->Query)) {
                                                ?>

                                                <tr>
                                                    <td><?php echo $row->OPERACAO ?> </td>
                                                    <td><?php echo utf8_encode($row->CLIENTE) ?></td>
                                                    <td><?php echo $row->CPF ?></td>
                                                    <td><?php echo utf8_encode($row->LOTE) ?></td>
                                                    <td><?php echo $row->DATAVENC ?></td>
                                                    <td><?php echo $row->DIVIDA ?></td>
                                                    <td><?php echo utf8_encode($row->BANCO) ?></td>
                                                    <!--<td></td>-->
                                                </tr>

                                            <?php }
                                        }?>

                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


            <div class="row">

            </div>
            <!-- /.col -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</div>

<?php include_once "foot.php"?>

</body>

</html>
