<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Lista de Fotos </title>
    <link href="assets/css/fotos.css" rel="stylesheet"/>
</head>

<body>

<a href="vistaadministrativas.php"><- Volver </a>
    <?php
    include('configbd.php');
    $idFoto = (int) filter_var($_REQUEST['idFoto'], FILTER_SANITIZE_NUMBER_INT);

    $sqlQuery = "SELECT  c.*, f.* FROM multas_administrativas AS c
            INNER JOIN fotos_administrativas AS f
            ON c.nombre_propietario = f.nombre_propietarios
            AND c.fecha_hora = f.fecha_administrativa
            AND c.id = {$idFoto}
            ORDER BY c.fecha_hora DESC";
    $resultadoSQL = mysqli_query($conn, $sqlQuery);
    ?>


    <div class="container">
        <?php
        while ($dataFotos = mysqli_fetch_array($resultadoSQL)) { ?>
            <img src="files_boletaadministrativas/<?php echo $dataFotos['foto']; ?>" alt="fotos colisiones" class="container">
        <?php } ?>

    </div>



</body>

</html>