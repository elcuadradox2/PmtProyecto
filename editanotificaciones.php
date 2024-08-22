<?php
ob_start(); // Inicia el almacenamiento en buffer

include "configbd.php";
include "sidebar.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $db->prepare("SELECT * FROM notificaciones WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die('Error: No se encontró la entrada.');
    }
} else {
    die('Error: ID no proporcionado.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ubicacion_notificacion = htmlspecialchars($_POST['ubicacion_notificacion'], ENT_QUOTES, 'UTF-8');
    $nombre_persona_comercio = htmlspecialchars($_POST['nombre_persona_comercio'], ENT_QUOTES, 'UTF-8');
    $descripcion_notificacion = htmlspecialchars($_POST['descripcion_notificacion'], ENT_QUOTES, 'UTF-8');
    $tipo_boleta = htmlspecialchars($_POST['tipo_boleta'], ENT_QUOTES, 'UTF-8');
    $nombre_chapa_agente = htmlspecialchars($_POST['nombre_chapa_agente'], ENT_QUOTES, 'UTF-8');

    try {
        // Inicia una transacción
        $db->beginTransaction();

        // Actualiza la tabla notificaciones
        $stmt = $db->prepare("UPDATE notificaciones SET ubicacion_notificacion = :ubicacion_notificacion, nombre_persona_comercio = :nombre_persona_comercio, descripcion_notificacion = :descripcion_notificacion, tipo_boleta = :tipo_boleta, nombre_chapa_agente = :nombre_chapa_agente WHERE id = :id");
        $stmt->execute([
            'ubicacion_notificacion' => $ubicacion_notificacion,
            'nombre_persona_comercio' => $nombre_persona_comercio,
            'descripcion_notificacion' => $descripcion_notificacion,
            'tipo_boleta' => $tipo_boleta,
            'nombre_chapa_agente' => $nombre_chapa_agente,
            'id' => $id
        ]);

        // Actualiza la tabla fotos_notificaciones
        $stmt = $db->prepare("UPDATE fotos_notificaciones SET ubicaciones_notificaciones = :ubicaciones_notificaciones WHERE fecha_notificacion = :fecha_notificacion");
        $stmt->execute([
            'ubicaciones_notificaciones' => $ubicacion_notificacion,
            'fecha_notificacion' => $row['fecha_hora_notificacion']
        ]);

        // Confirma la transacción
        $db->commit();

        // Redirige a vistanotificaciones.php
        header("Location: vistanotificaciones.php");
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
                        <h4 class="title">Editar Notificación</h4>
                    </div>
                    <div class="content">
                        <form method="POST">
                            <div class="form-group">
                                <label for="ubicacion_notificacion">Ubicación de la Notificación</label>
                                <input type="text" name="ubicacion_notificacion" class="form-control" value="<?php echo htmlspecialchars($row['ubicacion_notificacion'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_persona_comercio">Nombre de la Persona o Comercio</label>
                                <input type="text" name="nombre_persona_comercio" class="form-control" value="<?php echo htmlspecialchars($row['nombre_persona_comercio'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion_notificacion">Descripción de la Notificación</label>
                                <textarea name="descripcion_notificacion" class="form-control" required><?php echo htmlspecialchars($row['descripcion_notificacion'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tipo_boleta">Tipo de Boleta</label>
                                <select id="tipo_boleta" name="tipo_boleta" class="form-control" required>
                                    <option selected disabled>Seleccione el tipo de boleta</option>
                                    <option value="de pago" <?php echo ($row['tipo_boleta'] == 'de pago') ? 'selected' : ''; ?>>De Pago</option>
                                    <option value="educativa" <?php echo ($row['tipo_boleta'] == 'educativa') ? 'selected' : ''; ?>>Educativa</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nombre_chapa_agente">Nombre o Chapa del Agente</label>
                                <input type="text" name="nombre_chapa_agente" class="form-control" value="<?php echo htmlspecialchars($row['nombre_chapa_agente'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <a href="vistanotificaciones.php" class="btn btn-default">Cancelar</a>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>