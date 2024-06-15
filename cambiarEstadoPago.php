<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "connect.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $query = $db->prepare("UPDATE bitacora_actividades SET status = 'Pagado' WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $result = $query->execute();

        if ($result) {
            header('Location: vistaactividades.php?status=success');
        } else {
            header('Location: vistaactividades.php?status=error');
        }
    } catch (PDOException $e) {
        header('Location: vistaactividades.php?status=error&message=' . urlencode($e->getMessage()));
    }
} else {
    header('Location: vistaactividades.php?status=error&message=' . urlencode('Parámetros faltantes'));
}
?>
