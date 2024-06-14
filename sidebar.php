<?php 
include('connect.php');

session_start();
if(!isset($_SESSION['SESS_FIRST_NAME'])){
    header("location: login.php");
}
?>
    <!doctype html>
    <html lang="en">
    <head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php 
	$result = $db->prepare("SELECT * FROM site_settings WHERE id=1");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
	<title><?php echo $row['site_name']; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
	<meta name="keywords" content="Traffic" />
	<meta name="description" content="<?php echo $row['site_desc']; ?>">
	<meta name="author" content="">
	
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="orange" data-image="assets/img/sidebarpmt.png">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index.php" class="simple-text">
                    <?php echo $row['site_name']; ?>
                </a>
            </div>
<?php }?>
<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='agente') {
?>
 <ul class="nav">
                <li class="">
                    <a href="index.php">
                        <i class="pe-7s-graph"></i>
                        <p>Menu</p>
                    </a>
                </li>
				 <li>
                    <a href="report-offence.php">
                        <i class="pe-7s-look"></i>
                        <p>Reportar Infraccion</p>
                    </a>
                </li>
			 </ul>
<?php
}
if($position=='admin') {
?>
	  <ul class="nav">
                <li class="">
                    <a href="index.php">
                        <i class="pe-7s-graph"></i>
                        <p>Menu</p>
                    </a>
                </li>
                <li>
                    <a href="agresiones.php">
                        <i class="pe-7s-look"></i>
                        <p>Agresiones</p>
                    </a>
                </li>
                <li>
                    <a href="alcoholemia.php">
                        <i class="pe-7s-look"></i>
                        <p>Alcoholemia</p>
                    </a>
                </li>
                <li>
                    <a href="bitacoraactividades.php">
                        <i class="pe-7s-look"></i>
                        <p>Bitacora De Actividades</p>
                    </a>
                </li>
                <li>
                    <a href="bitacoraoperativos.php">
                        <i class="pe-7s-look"></i>
                        <p>Bitacora De Operativos</p>
                    </a>
                </li>
                <li>
                    <a href="consignaciones.php">
                        <i class="pe-7s-look"></i>
                        <p>Consignaciones</p>
                    </a>
                </li>
                <li>
                    <a href="colisiones.php">
                        <i class="pe-7s-look"></i>
                        <p>Colisiones</p>
                    </a>
                </li>
                <li>
                    <a href="entrevista.php">
                        <i class="pe-7s-look"></i>
                        <p>Entrevista</p>
                    </a>
                </li>
                <li>
                    <a href="notificaciones.php">
                        <i class="pe-7s-look"></i>
                        <p>Notificaciones</p>
                    </a>
                </li>
                <li>
                    <a href="peritajevehiculartransportes.php">
                        <i class="pe-7s-look"></i>
                        <p>Peritaje Vehicular Transportes</p>
                    </a>
                </li>
                <li>
                    <a href="peritajevehicular.php">
                        <i class="pe-7s-look"></i>
                        <p>Peritaje Vehicular</p>
                    </a>
                </li>
                <li>
                    <a href="remociones.php">
                        <i class="pe-7s-look"></i>
                        <p>Remociones</p>
                    </a>
                </li>
                <li>
                    <a href="reporteinterno.php">
                        <i class="pe-7s-look"></i>
                        <p>Reporte Interno</p>
                    </a>
                </li>
                <li>
                    <a href="serviciossociales.php">
                        <i class="pe-7s-look"></i>
                        <p>Servicios Sociales</p>
                    </a>
                </li>
                <li>
                    <a href="vistaagresiones.php">
                        <i class="pe-7s-note2"></i>
                        <p>Listado Boletas Agresiones</p>
                    </a>
                </li>
                <li>
                    <a href="vistaalcoholemia.php">
                        <i class="pe-7s-note2"></i>
                        <p>Listado Boletas Alcoholemia</p>
                    </a>
                </li>
                <li>
                    <a href="vistaactividades.php">
                        <i class="pe-7s-note2"></i>
                        <p>Listado Boletas Bitacora Actividades</p>
                    </a>
                </li>
                <li>
                    <a href="vistaoperativos.php">
                        <i class="pe-7s-note2"></i>
                        <p>Listado Boletas Bitacora Operativos</p>
                    </a>
                </li>
               <li>
                    <a href="vistaconsignaciones.php">
                        <i class="pe-7s-note2"></i>
                        <p>Listado Boletas Consignaciones</p>
                    </a>
                </li>
                <li>
                    <a href="vistacolisiones.php">
                        <i class="pe-7s-note2"></i>
                        <p>Listado Boletas Colisiones</p>
                    </a>
                </li>
                <li>
                    <a href="vistaentrevista.php">
                        <i class="pe-7s-note2"></i>
                        <p>Listado Boletas Entrevista</p>
                    </a>
                </li>
                <li>
                    <a href="vistanotificaciones.php">
                        <i class="pe-7s-note2"></i>
                        <p>Listado Boletas Notificaciones</p>
                    </a>
                </li>
                <li>
                    <a href="vistavehiculartransportes.php">
                        <i class="pe-7s-note2"></i>
                        <p>Listado Boletas Peritaje Vehicular Transportes</p>
                    </a>
                </li>
                <li>
                    <a href="vistavehicular.php">
                        <i class="pe-7s-note2"></i>
                        <p>Listado Boletas Peritaje Vehicular</p>
                    </a>
                </li>
                <li>
                    <a href="vistaremociones.php">
                        <i class="pe-7s-note2"></i>
                        <p>Listado Boletas Remociones</p>
                    </a>
                </li>
                <li>
                    <a href="vistareporteinterno.php">
                        <i class="pe-7s-note2"></i>
                        <p>Listado Boletas Reporte Interno</p>
                    </a>
                </li>
                <li>
                    <a href="vistaserviciossociales.php">
                        <i class="pe-7s-note2"></i>
                        <p>Listado Boletas Servicios Sociales</p>
                    </a>
                </li>
				<li>
                    <a href="add-user.php">
                        <i class="pe-7s-user"></i>
                        <p>Agregar Usuario</p>
                    </a>
                </li>
                <li>
                    <a href="view-users.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Listar Usuarios</p>
                    </a>
                </li>
			 </ul>
			 <?php
}
?>
<?php
if($position=='digitalizador') {
?>
    <ul class="nav">
        <li>
            <a href="index.php">
                <i class="pe-7s-graph"></i>
                <p>Menu</p>
            </a>
        </li>
        <li>
            <a href="view-offence.php">
                <i class="pe-7s-note2"></i>
                <p>Lista de Infraccion</p>
            </a>
        </li>
    </ul>
<?php
}
?>
</div>
    </div>
	 <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
            <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                  </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="logout.php">
                                <p>Salir</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>
