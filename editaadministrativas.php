<?php
ob_start(); // Inicia el almacenamiento en buffer

include "configbd.php";
include "sidebar.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $db->prepare("SELECT * FROM multas_administrativas WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die('Error: No se encontró la entrada.');
    }
} else {
    die('Error: ID no proporcionado.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha_hora = htmlspecialchars($_POST['fecha_hora'], ENT_QUOTES, 'UTF-8');
    $no_taxi = htmlspecialchars($_POST['no_taxi'], ENT_QUOTES, 'UTF-8');
    $nombre_propietario = htmlspecialchars($_POST['nombre_propietario'], ENT_QUOTES, 'UTF-8');
    $nombre_piloto = htmlspecialchars($_POST['nombre_piloto'], ENT_QUOTES, 'UTF-8');
    $no_dpi = htmlspecialchars($_POST['no_dpi'], ENT_QUOTES, 'UTF-8');
    $no_placas = htmlspecialchars($_POST['no_placas'], ENT_QUOTES, 'UTF-8');
    $nombre_agente = htmlspecialchars($_POST['nombre_agente'], ENT_QUOTES, 'UTF-8');

    try {
        // Inicia una transacción
        $db->beginTransaction();

        // Actualiza la tabla aviso_pago
        $stmt = $db->prepare("UPDATE multas_administrativas SET fecha_hora = :fecha_hora, no_taxi = :no_taxi, nombre_propietario = :nombre_propietario, nombre_piloto = :nombre_piloto, no_dpi = :no_dpi, no_placas = :no_placas, nombre_agente = :nombre_agente WHERE id = :id");
        $stmt->execute([
            'fecha_hora' => $fecha_hora,
            'no_taxi' => $no_taxi,
            'nombre_propietario' => $nombre_propietario,
            'nombre_piloto' => $nombre_piloto,
            'no_dpi' => $no_dpi,
            'no_placas' => $no_placas,
            'nombre_agente' => $nombre_agente,
            'id' => $id
        ]);

        // Actualiza la tabla fotos_aviso_pago
        $stmt = $db->prepare("UPDATE fotos_administrativas SET nombre_propietarios = :nombre_propietarios WHERE fecha_administrativa = :fecha_administrativa");
        $stmt->execute([
            'nombre_propietarios' => $nombre_propietario,
            'fecha_administrativa' => $row['fecha_hora']
        ]);

        // Confirma la transacción
        $db->commit();

        // Redirige a vistaavisopago.php
        header("Location: vistaadministrativas.php");
        ob_end_flush(); // Envía la salida del buffer
        exit();
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $db->rollBack();
        die('Error: ' . $e->getMessage());
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Editar Multas Administrativas</h4>
                    </div>
                    <div class="content">
                        <form method="POST">
                            <div class="form-group">
                                <label for="fecha_hora">Fecha y Hora</label>
                                <input type="datetime-local" name="fecha_hora" class="form-control" value="<?php echo htmlspecialchars($row['fecha_hora'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="no_taxi">Número de Taxi</label>
                                <input type="text" name="no_taxi" class="form-control" value="<?php echo htmlspecialchars($row['no_taxi'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_propietario">Nombre del Propietario</label>
                                <input type="text" name="nombre_propietario" class="form-control" value="<?php echo htmlspecialchars($row['nombre_propietario'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_piloto">Nombre del Piloto</label>
                                <input type="text" name="nombre_piloto" class="form-control" value="<?php echo htmlspecialchars($row['nombre_piloto'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="no_dpi">Número de DPI</label>
                                <input type="text" name="no_dpi" class="form-control" value="<?php echo htmlspecialchars($row['no_dpi'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="no_placas">Número de Placas</label>
                                <input type="text" name="no_placas" class="form-control" value="<?php echo htmlspecialchars($row['no_placas'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_agente">Nombre del Agente</label>
                                <input type="text" name="nombre_agente" class="form-control" value="<?php echo htmlspecialchars($row['nombre_agente'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <a href="vistaadministrativas.php" class="btn btn-default">Cancelar</a>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>