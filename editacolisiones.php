<?php
ob_start(); // Inicia el almacenamiento en buffer

include "configbd.php";
include "sidebar.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $db->prepare("SELECT * FROM colisiones WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die('Error: No se encontró la entrada.');
    }
} else {
    die('Error: ID no proporcionado.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $licencias = htmlspecialchars($_POST['licencias'], ENT_QUOTES, 'UTF-8');
    $tarjetas_circulacion = htmlspecialchars($_POST['tarjetas_circulacion'], ENT_QUOTES, 'UTF-8');
    $observaciones = htmlspecialchars($_POST['observaciones'], ENT_QUOTES, 'UTF-8');
    $nombre_chapa_agente = htmlspecialchars($_POST['nombre_chapa_agente'], ENT_QUOTES, 'UTF-8');

    try {
        // Inicia una transacción
        $db->beginTransaction();

        // Actualiza la tabla colisiones
        $stmt = $db->prepare("UPDATE colisiones SET licencias = :licencias, tarjetas_circulacion = :tarjetas_circulacion, observaciones = :observaciones, nombre_chapa_agente = :nombre_chapa_agente WHERE id = :id");
        $stmt->execute([
            'licencias' => $licencias,
            'tarjetas_circulacion' => $tarjetas_circulacion,
            'observaciones' => $observaciones,
            'nombre_chapa_agente' => $nombre_chapa_agente,
            'id' => $id
        ]);

        // Actualiza la tabla fotos_colisiones
        $stmt = $db->prepare("UPDATE fotos_colisiones SET licencias_colisiones = :licencias_colisiones WHERE fecha_colisiones = :fecha_colisiones");
        $stmt->execute([
            'licencias_colisiones' => $licencias,
            'fecha_colisiones' => $row['fecha_hora']
        ]);

        // Confirma la transacción
        $db->commit();

        // Redirige a vistacolisiones.php
        header("Location: vistacolisiones.php");
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
                        <h4 class="title">Editar Colisión</h4>
                    </div>
                    <div class="content">
                        <form method="POST">
                            <div class="form-group">
                                <label for="licencias">Licencias</label>
                                <input type="text" name="licencias" class="form-control" value="<?php echo htmlspecialchars($row['licencias'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="tarjetas_circulacion">Tarjetas de Circulación</label>
                                <input type="text" name="tarjetas_circulacion" class="form-control" value="<?php echo htmlspecialchars($row['tarjetas_circulacion'], ENT_QUOTES, 'UTF-8'); ?>" required>
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
                            <a href="vistacolisiones.php" class="btn btn-default">Cancelar</a>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>