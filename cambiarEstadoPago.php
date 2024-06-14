<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "configbd.php"; // Asegúrate de que la conexión a la base de datos está configurada correctamente

if (isset($_GET['id']) && isset($_GET['pagado'])) {
    $id = intval($_GET['id']);
    $pagado = $_GET['pagado'] === 'true' ? 'Pagado' : 'No Pagado';

    try {
        $query = $db->prepare("UPDATE bitacora_actividades SET pagado = :pagado WHERE id = :id");
        $query->bindParam(':pagado', $pagado);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        
        $result = $query->execute();

        if ($result) {
            header('Location: vistaactividades.php?status=success');
        } else {
            header('Location: vistaactividades.php?status=error');
        }
    } catch (PDOException $e) {
        echo 'Error de ejecución de consulta: ' . $e->getMessage();
    }
} else {
    echo 'Error: Parámetros faltantes';
}
?>
