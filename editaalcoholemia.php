<?php
ob_start(); // Inicia el almacenamiento en buffer

include "configbd.php";
include "sidebar.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $db->prepare("SELECT * FROM alcoholemia WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die('Error: No se encontró la entrada.');
    }
} else {
    die('Error: ID no proporcionado.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lugar_prueba = htmlspecialchars($_POST['lugar_prueba'], ENT_QUOTES, 'UTF-8');
    $nombre_conductor = htmlspecialchars($_POST['nombre_conductor'], ENT_QUOTES, 'UTF-8');
    $domicilio_conductor = htmlspecialchars($_POST['domicilio_conductor'], ENT_QUOTES, 'UTF-8');
    $no_licencia = htmlspecialchars($_POST['no_licencia'], ENT_QUOTES, 'UTF-8');
    $tarjeta_circulacion = htmlspecialchars($_POST['tarjeta_circulacion'], ENT_QUOTES, 'UTF-8');
    $no_placas = htmlspecialchars($_POST['no_placas'], ENT_QUOTES, 'UTF-8');
    $tipo_boleta = htmlspecialchars($_POST['tipo_boleta'], ENT_QUOTES, 'UTF-8');
    $nombre_chapa_agente = htmlspecialchars($_POST['nombre_chapa_agente'], ENT_QUOTES, 'UTF-8');

    try {
        // Inicia una transacción
        $db->beginTransaction();

        // Actualiza la tabla alcoholemia
        $stmt = $db->prepare("UPDATE alcoholemia SET lugar_prueba = :lugar_prueba, nombre_conductor = :nombre_conductor, domicilio_conductor = :domicilio_conductor, no_licencia = :no_licencia, tarjeta_circulacion = :tarjeta_circulacion, no_placas = :no_placas, tipo_boleta = :tipo_boleta, nombre_chapa_agente = :nombre_chapa_agente WHERE id = :id");
        $stmt->execute([
            'lugar_prueba' => $lugar_prueba,
            'nombre_conductor' => $nombre_conductor,
            'domicilio_conductor' => $domicilio_conductor,
            'no_licencia' => $no_licencia,
            'tarjeta_circulacion' => $tarjeta_circulacion,
            'no_placas' => $no_placas,
            'tipo_boleta' => $tipo_boleta,
            'nombre_chapa_agente' => $nombre_chapa_agente,
            'id' => $id
        ]);

        // Actualiza la tabla fotos_alcoholemia
        $stmt = $db->prepare("UPDATE fotos_alcoholemia SET licencias_alcoholemia = :licencias_alcoholemia WHERE fecha_alcoholemia = :fecha_alcoholemia");
        $stmt->execute([
            'licencias_alcoholemia' => $no_licencia,
            'fecha_alcoholemia' => $row['fecha_hora']
        ]);

        // Confirma la transacción
        $db->commit();

        // Redirige a vistaalcoholemia.php
        header("Location: vistaalcoholemia.php");
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
                        <h4 class="title">Editar Boleta Alcoholemia</h4>
                    </div>
                    <div class="content">
                        <form method="POST">
                            <div class="form-group">
                                <label for="lugar_prueba">Lugar de la Prueba</label>
                                <input type="text" name="lugar_prueba" class="form-control" value="<?php echo htmlspecialchars($row['lugar_prueba'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_conductor">Nombre del Conductor</label>
                                <input type="text" name="nombre_conductor" class="form-control" value="<?php echo htmlspecialchars($row['nombre_conductor'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="domicilio_conductor">Domicilio del Conductor</label>
                                <input type="text" name="domicilio_conductor" class="form-control" value="<?php echo htmlspecialchars($row['domicilio_conductor'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="no_licencia">No. Licencia</label>
                                <input type="text" name="no_licencia" class="form-control" value="<?php echo htmlspecialchars($row['no_licencia'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="tarjeta_circulacion">Tarjeta de Circulación</label>
                                <input type="text" name="tarjeta_circulacion" class="form-control" value="<?php echo htmlspecialchars($row['tarjeta_circulacion'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="no_placas">No. Placas</label>
                                <input type="text" name="no_placas" class="form-control" value="<?php echo htmlspecialchars($row['no_placas'], ENT_QUOTES, 'UTF-8'); ?>" required>
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
                            <a href="vistaalcoholemia.php" class="btn btn-default">Cancelar</a>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>