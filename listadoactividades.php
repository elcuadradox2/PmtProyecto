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

<a href="vistaactividades.php"><- Volver </a>
    <?php
    include('configbd.php');
    $idFoto = filter_var($_REQUEST['idFoto'], FILTER_SANITIZE_NUMBER_INT);

    if ($idFoto) {
        // Preparar la consulta SQL usando sentencias preparadas para evitar inyecciones SQL
        $stmt = $conn->prepare("SELECT c.*, f.* FROM bitacora_actividades AS c
                                INNER JOIN fotos_actividades AS f
                                ON c.fecha_hora = f.fecha_actividades
                                AND c.id = ?
                                ORDER BY c.fecha_hora DESC");
        $stmt->bind_param("i", $idFoto); // "i" indica que el parámetro es de tipo entero
        $stmt->execute();
        $resultadoSQL = $stmt->get_result();
    ?>

    <div class="container">
        <?php
        while ($dataFotos = $resultadoSQL->fetch_assoc()) { ?>
            <img src="files_bitacoraactividades/<?php echo htmlspecialchars($dataFotos['foto']); ?>" alt="fotos colisiones" class="container">
        <?php } ?>
    </div>

    <?php
        $stmt->close(); // Cerrar la sentencia
    } else {
        echo "<p>ID de foto inválido.</p>";
    }
    ?>

</body>

</html>