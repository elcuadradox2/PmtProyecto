<?php
ob_start(); // Inicia el almacenamiento en buffer

include "configbd.php";
include "sidebar.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $db->prepare("SELECT * FROM consignaciones WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die('Error: No se encontró la entrada.');
    }
} else {
    die('Error: ID no proporcionado.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ubicacion_consignacion = htmlspecialchars($_POST['ubicacion_consignacion'], ENT_QUOTES, 'UTF-8');
    $no_licencia = htmlspecialchars($_POST['no_licencia'], ENT_QUOTES, 'UTF-8');
    $no_tarjeta_circulacion = htmlspecialchars($_POST['no_tarjeta_circulacion'], ENT_QUOTES, 'UTF-8');
    $no_peritaje = htmlspecialchars($_POST['no_peritaje'], ENT_QUOTES, 'UTF-8');
    $observaciones = htmlspecialchars($_POST['observaciones'], ENT_QUOTES, 'UTF-8');
    $nombre_chapa_agente = htmlspecialchars($_POST['nombre_chapa_agente'], ENT_QUOTES, 'UTF-8');

    try {
        // Inicia una transacción
        $db->beginTransaction();

        // Actualiza la tabla consignaciones
        $stmt = $db->prepare("UPDATE consignaciones SET ubicacion_consignacion = :ubicacion_consignacion, no_licencia = :no_licencia, no_tarjeta_circulacion = :no_tarjeta_circulacion, no_peritaje = :no_peritaje, observaciones = :observaciones, nombre_chapa_agente = :nombre_chapa_agente WHERE id = :id");
        $stmt->execute([
            'ubicacion_consignacion' => $ubicacion_consignacion,
            'no_licencia' => $no_licencia,
            'no_tarjeta_circulacion' => $no_tarjeta_circulacion,
            'no_peritaje' => $no_peritaje,
            'observaciones' => $observaciones,
            'nombre_chapa_agente' => $nombre_chapa_agente,
            'id' => $id
        ]);

        // Actualiza la tabla fotos_consignaciones
        $stmt = $db->prepare("UPDATE fotos_consignaciones SET ubicacion_consignaciones = :ubicacion_consignaciones WHERE fecha_consignacion = :fecha_consignacion");
        $stmt->execute([
            'ubicacion_consignaciones' => $ubicacion_consignacion,
            'fecha_consignacion' => $row['fecha_hora']
        ]);

        // Confirma la transacción
        $db->commit();

        // Redirige a vistaconsignaciones.php
        header("Location: vistaconsignaciones.php");
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
                        <h4 class="title">Editar Consignación</h4>
                    </div>
                    <div class="content">
                        <form method="POST">
                            <div class="form-group">
                                <label for="ubicacion_consignacion">Ubicación de la Consignación</label>
                                <input type="text" name="ubicacion_consignacion" class="form-control" value="<?php echo htmlspecialchars($row['ubicacion_consignacion'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="no_licencia">No. Licencia</label>
                                <input type="text" name="no_licencia" class="form-control" value="<?php echo htmlspecialchars($row['no_licencia'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="no_tarjeta_circulacion">No. Tarjeta de Circulación</label>
                                <input type="text" name="no_tarjeta_circulacion" class="form-control" value="<?php echo htmlspecialchars($row['no_tarjeta_circulacion'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="no_peritaje">No. Peritaje</label>
                                <input type="text" name="no_peritaje" class="form-control" value="<?php echo htmlspecialchars($row['no_peritaje'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <textarea name="observaciones" class="form-control" required><?php echo htmlspecialchars($row['observaciones'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="nombre_chapa_agente">Nombre o Chapa del Agente</label>
                                <input type="text" name="nombre_chapa_agente" class="form-control" value="<?php echo htmlspecialchars($row['nombre_chapa_agente'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <a href="vistaconsignaciones.php" class="btn btn-default">Cancelar</a>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>