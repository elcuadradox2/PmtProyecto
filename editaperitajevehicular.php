<?php
ob_start(); // Inicia el almacenamiento en buffer

include "configbd.php";
include "sidebar.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $db->prepare("SELECT * FROM peritaje_vehicular WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die('Error: No se encontró la entrada.');
    }
} else {
    die('Error: ID no proporcionado.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $placa_peritaje_vehicular = htmlspecialchars($_POST['placa_peritaje_vehicular'], ENT_QUOTES, 'UTF-8');
    $nombre_agente = htmlspecialchars($_POST['nombre_agente'], ENT_QUOTES, 'UTF-8');

    try {
        // Inicia una transacción
        $db->beginTransaction();

        // Actualiza la tabla peritaje_vehicular
        $stmt = $db->prepare("UPDATE peritaje_vehicular SET placa_peritaje_vehicular = :placa_peritaje_vehicular, nombre_agente = :nombre_agente WHERE id = :id");
        $stmt->execute([
            'placa_peritaje_vehicular' => $placa_peritaje_vehicular,
            'nombre_agente' => $nombre_agente,
            'id' => $id
        ]);

        // Actualiza la tabla fotos_peritaje
        $stmt = $db->prepare("UPDATE fotos_peritaje SET placas_vehiculos = :placas_vehiculos WHERE fecha_hora_vehicular = :fecha_hora_vehicular");
        $stmt->execute([
            'placas_vehiculos' => $placa_peritaje_vehicular,
            'fecha_hora_vehicular' => $row['fecha_hora']
        ]);

        // Confirma la transacción
        $db->commit();

        // Redirige a vistaperitajevehicular.php
        header("Location: vistavehicular.php");
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
                        <h4 class="title">Editar Peritaje Vehicular</h4>
                    </div>
                    <div class="content">
                        <form method="POST">
                            <div class="form-group">
                                <label for="placa_peritaje_vehicular">Placa del Vehículo</label>
                                <input type="text" name="placa_peritaje_vehicular" class="form-control" value="<?php echo htmlspecialchars($row['placa_peritaje_vehicular'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_agente">Nombre del Agente</label>
                                <input type="text" name="nombre_agente" class="form-control" value="<?php echo htmlspecialchars($row['nombre_agente'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <a href="vistavehicular.php" class="btn btn-default">Cancelar</a>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>