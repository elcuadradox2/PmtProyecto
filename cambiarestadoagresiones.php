<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "connect.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $query = $db->prepare("UPDATE agresiones SET estado_pago = 'Pagado' WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $result = $query->execute();

        if ($result) {
            header('Location: vistaagresiones.php?estado_pago=success');
        } else {
            header('Location: vistaagresiones.php?estado_pago=error');
        }
    } catch (PDOException $e) {
        header('Location: vistaagresiones.php?estado_pago=error&message=' . urlencode($e->getMessage()));
    }
} else {
    header('Location: vistaagresiones.php?estado_pago=error&message=' . urlencode('Parámetros faltantes'));
}
?>
