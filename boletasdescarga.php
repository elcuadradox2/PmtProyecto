<?php include "sidebar.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Descarga de Boletas</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
</head>
<body>
    <div class="container mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre de Boleta</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $boletas = array(
                    "agresiones",
                    "alcoholemia",
                    "bitacoradeactividades",
                    "bitacoraoperativos",
                    "colisiones",
                    "consignaciones",
                    "entrevista",
                    "notificacion",
                    "peritajevehicular",
                    "peritajevehiculartransportes",
                    "remocion",
                    "reporteinterno",
                    "serviciossociales",
                );

                foreach ($boletas as $boleta) {
                    echo '<tr>';
                    echo '<td>' . $boleta . '</td>';
                    echo '<td><a class="btn btn-warning btn-sm" href="descargar.php?archivo=' . urlencode($boleta) . '" download>Descargar</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php include "footer.php"; ?>