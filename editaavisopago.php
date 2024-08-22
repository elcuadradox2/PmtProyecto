<?php
ob_start(); // Inicia el almacenamiento en buffer

include "configbd.php";
include "sidebar.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $db->prepare("SELECT * FROM aviso_pago WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die('Error: No se encontró la entrada.');
    }
} else {
    die('Error: ID no proporcionado.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ubicacion_aviso_pago = htmlspecialchars($_POST['ubicacion_aviso_pago'], ENT_QUOTES, 'UTF-8');
    $dpi_aviso_pago = htmlspecialchars($_POST['dpi_aviso_pago'], ENT_QUOTES, 'UTF-8');
    $no_placas = htmlspecialchars($_POST['no_placas'], ENT_QUOTES, 'UTF-8');
    $nombre_completo = htmlspecialchars($_POST['nombre_completo'], ENT_QUOTES, 'UTF-8');
    $descripcion_aviso_pago = htmlspecialchars($_POST['descripcion_aviso_pago'], ENT_QUOTES, 'UTF-8');
    $tipo_boleta = htmlspecialchars($_POST['tipo_boleta'], ENT_QUOTES, 'UTF-8');
    $nombre_chapa_agente = htmlspecialchars($_POST['nombre_chapa_agente'], ENT_QUOTES, 'UTF-8');

    try {
        // Inicia una transacción
        $db->beginTransaction();

        // Actualiza la tabla aviso_pago
        $stmt = $db->prepare("UPDATE aviso_pago SET ubicacion_aviso_pago = :ubicacion_aviso_pago, dpi_aviso_pago = :dpi_aviso_pago, no_placas = :no_placas, nombre_completo = :nombre_completo, descripcion_aviso_pago = :descripcion_aviso_pago, tipo_boleta = :tipo_boleta, nombre_chapa_agente = :nombre_chapa_agente WHERE id = :id");
        $stmt->execute([
            'ubicacion_aviso_pago' => $ubicacion_aviso_pago,
            'dpi_aviso_pago' => $dpi_aviso_pago,
            'no_placas' => $no_placas,
            'nombre_completo' => $nombre_completo,
            'descripcion_aviso_pago' => $descripcion_aviso_pago,
            'tipo_boleta' => $tipo_boleta,
            'nombre_chapa_agente' => $nombre_chapa_agente,
            'id' => $id
        ]);

        // Actualiza la tabla fotos_aviso_pago
        $stmt = $db->prepare("UPDATE fotos_aviso_pago SET placa_aviso_pago = :placa_aviso_pago WHERE fecha_aviso_pago = :fecha_aviso_pago");
        $stmt->execute([
            'placa_aviso_pago' => $no_placas,
            'fecha_aviso_pago' => $row['fecha_hora_aviso_pago']
        ]);

        // Confirma la transacción
        $db->commit();

        // Redirige a vistaavisopago.php
        header("Location: vistaavisopago.php");
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
                        <h4 class="title">Editar Aviso de Pago</h4>
                    </div>
                    <div class="content">
                        <form method="POST">
                            <div class="form-group">
                                <label for="ubicacion_aviso_pago">Ubicación del Aviso de Pago</label>
                                <input type="text" name="ubicacion_aviso_pago" class="form-control" value="<?php echo htmlspecialchars($row['ubicacion_aviso_pago'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="dpi_aviso_pago">DPI del Aviso de Pago</label>
                                <input type="text" name="dpi_aviso_pago" class="form-control" value="<?php echo htmlspecialchars($row['dpi_aviso_pago'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="no_placas">No. Placas</label>
                                <input type="text" name="no_placas" class="form-control" value="<?php echo htmlspecialchars($row['no_placas'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_completo">Nombre Completo</label>
                                <input type="text" name="nombre_completo" class="form-control" value="<?php echo htmlspecialchars($row['nombre_completo'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion_aviso_pago">Descripción del Aviso de Pago</label>
                                <input type="text" name="descripcion_aviso_pago" class="form-control" value="<?php echo htmlspecialchars($row['descripcion_aviso_pago'], ENT_QUOTES, 'UTF-8'); ?>" required>
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