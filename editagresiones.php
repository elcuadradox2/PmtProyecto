<?php
ob_start(); // Inicia el almacenamiento en buffer

include "configbd.php";
include "sidebar.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $db->prepare("SELECT * FROM agresiones WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        die('Error: No se encontró la entrada.');
    }
} else {
    die('Error: ID no proporcionado.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_chapa = htmlspecialchars($_POST['nombre_chapa'], ENT_QUOTES, 'UTF-8');
    $lugar = htmlspecialchars($_POST['lugar'], ENT_QUOTES, 'UTF-8');
    $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
    $no_licencia = htmlspecialchars($_POST['no_licencia'], ENT_QUOTES, 'UTF-8');
    $no_placa = htmlspecialchars($_POST['no_placa'], ENT_QUOTES, 'UTF-8');
    $nombre_chapa_agente = htmlspecialchars($_POST['nombre_chapa_agente'], ENT_QUOTES, 'UTF-8');

    try {
        // Inicia una transacción
        $db->beginTransaction();

        // Actualiza la tabla agresiones
        $stmt = $db->prepare("UPDATE agresiones SET nombre_chapa = :nombre_chapa, lugar = :lugar, nombre = :nombre, no_licencia = :no_licencia, no_placa = :no_placa, nombre_chapa_agente = :nombre_chapa_agente WHERE id = :id");
        $stmt->execute([
            'nombre_chapa' => $nombre_chapa,
            'lugar' => $lugar,
            'nombre' => $nombre,
            'no_licencia' => $no_licencia,
            'no_placa' => $no_placa,
            'nombre_chapa_agente' => $nombre_chapa_agente,
            'id' => $id
        ]);

        // Actualiza la tabla fotos_agresiones
        $stmt = $db->prepare("UPDATE fotos_agresiones SET licencia_agresiones = :licencia_agresiones WHERE fecha_agresion = :fecha_agresion");
        $stmt->execute([
            'licencia_agresiones' => $no_licencia,
            'fecha_agresion' => $row['fecha_hora']
        ]);

        // Confirma la transacción
        $db->commit();

        // Redirige a vistaagresiones.php
        header("Location: vistaagresiones.php");
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
                        <h4 class="title">Editar Boleta Agresiones</h4>
                    </div>
                    <div class="content">
                        <form method="POST">
                            <div class="form-group">
                                <label for="nombre_chapa">Nombre O Chapa del agente</label>
                                <input type="text" name="nombre_chapa" class="form-control" value="<?php echo htmlspecialchars($row['nombre_chapa'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lugar">Lugar del hecho</label>
                                <input type="text" name="lugar" class="form-control" value="<?php echo htmlspecialchars($row['lugar'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="no_licencia">No. Licencia</label>
                                <input type="text" name="no_licencia" class="form-control" value="<?php echo htmlspecialchars($row['no_licencia'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="no_placa">No. Placa</label>
                                <input type="text" name="no_placa" class="form-control" value="<?php echo htmlspecialchars($row['no_placa'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre_chapa_agente">Nombre Autor Boleta</label>
                                <input type="text" name="nombre_chapa_agente" class="form-control" value="<?php echo htmlspecialchars($row['nombre_chapa_agente'], ENT_QUOTES, 'UTF-8'); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <a href="vistaagresiones.php" class="btn btn-default">Cancelar</a>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
