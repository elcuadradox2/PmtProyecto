<?php
ob_start(); // Inicia el almacenamiento en buffer

include "configbd.php";
include "sidebar.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $db->prepare("SELECT * FROM peritaje_vehicular_transportes WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die('Error: No se encontró la entrada.');
    }
} else {
    die('Error: ID no proporcionado.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $placa_peritaje_transportes = htmlspecialchars($_POST['placa_peritaje_transportes'], ENT_QUOTES, 'UTF-8');
    $nombre_agente = htmlspecialchars($_POST['nombre_agente'], ENT_QUOTES, 'UTF-8');

    try {
        // Inicia una transacción
        $db->beginTransaction();

        // Actualiza la tabla peritaje_vehicular_transportes
        $stmt = $db->prepare("UPDATE peritaje_vehicular_transportes SET placa_peritaje_transportes = :placa_peritaje_transportes, nombre_agente = :nombre_agente WHERE id = :id");
        $stmt->execute([
            'placa_peritaje_transportes' => $placa_peritaje_transportes,
            'nombre_agente' => $nombre_agente,
            'id' => $id
        ]);

        // Actualiza la tabla fotos_peritaje_transportes
        $stmt = $db->prepare("UPDATE fotos_peritaje_transportes SET placas_peritajes = :placas_peritajes WHERE fecha_hora_transportes = :fecha_hora_transportes");
        $stmt->execute([
            'placas_peritajes' => $placa_peritaje_transportes,
            'fecha_hora_transportes' => $row['fecha_hora']
        ]);

        // Confirma la transacción
        $db->commit();

        // Redirige a vistaperitajevehiculartransportes.php
        header("Location: vistavehiculartransportes.php");
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
                        <h4 class="title">Editar Peritaje Vehicular Transportes</h4>
                    </div>
                    <div class="content">
                        <form method="POST">
                            <div class="form-group">
                                <label for="placa_peritaje_transportes">Placa del Vehículo</label>
                                <input type="text" name="placa_peritaje_transportes" class="form-control" value="<?php echo htmlspecialchars($row['placa_peritaje_transportes'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_agente">Nombre del Agente</label>
                                <input type="text" name="nombre_agente" class="form-control" value="<?php echo htmlspecialchars($row['nombre_agente'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <a href="vistavehiculartransportes.php" class="btn btn-default">Cancelar</a>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>