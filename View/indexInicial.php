
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
                        <li><a href="index.php">Educação </a></li>
<!--                        <li><a href="Condominio.php">Condomínio</a></li>-->
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

            <div class="col-lg-4 col-xs-6" style="margin-top:  20%; margin-left: 14%">
                <!-- small box -->
                <div class="small-box bg-light-blue">
                    <div class="inner">
                        <h3>Educação</h3>
                        <p>Pendências - Educação</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-pencil-square-o"></i>
                    </div>
                    <a href="index.php" class="small-box-footer"> Entrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-4 col-xs-6" style="margin-top:  20%; margin-left: 5%">
                <!-- small box -->
                <div class="small-box bg-light-blue">
                    <div class="inner">
                        <h3>Condomínio</h3>

                        <p>Pendências - Condomínio</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-building"></i>
                    </div>
                    <a href="Condominio.php" class="small-box-footer"> Entrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-4 col-xs-6" style="margin-top:  5%; margin-left: 34%">
                <!-- small box -->
                <div class="small-box bg-light-blue">
                    <div class="inner">
                        <h3>Condomínio</h3>

                        <p>Pendências - Condomínio</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-building"></i>
                    </div>
                    <a href="Condominio.php" class="small-box-footer"> Entrar <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->


            <div class="row"></div>
            <!-- /.col -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</div>
<?php include_once "foot.php"?>

</body>

</html>