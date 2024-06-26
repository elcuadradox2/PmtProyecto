<?php
include'connect.php';
$id=$_GET['id'];

// Primero, obtén la ubicacion asociada con la consignacion
$query = $db->prepare("SELECT no_placas, fecha_hora_aviso_pago FROM aviso_pago WHERE id= :post_id");
$query->bindParam(':post_id', $id);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
$no_placas = $row['no_placas'];
$fecha_hora_aviso_pago = $row['fecha_hora_aviso_pago'];

// Luego, obtén las rutas de las fotos asociadas con esa ubicacion y el mismo id
$result = $db->prepare("SELECT foto FROM fotos_aviso_pago WHERE placa_aviso_pago= :no_placas AND fecha_aviso_pago= :fecha_hora_aviso_pago");
$result->bindParam(':no_placas', $no_placas);
$result->bindParam(':fecha_hora_aviso_pago', $fecha_hora_aviso_pago);
$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC)){
    // Añade el nombre de la carpeta a la ruta de la foto
    $ruta_foto = 'files_boletaavisopago/' . $row['foto'];
    
    // Intenta eliminar cada foto del disco
    if(!unlink($ruta_foto)){
        echo 'Error al eliminar la foto ' . $ruta_foto . ', por favor intente de nuevo';
        exit;
    }
}

// Luego, elimina las fotos de la base de datos que corresponden al mismo id y placa_peritaje_transportes
$result = $db->prepare("DELETE FROM fotos_aviso_pago WHERE placa_aviso_pago= :no_placas AND fecha_aviso_pago= :fecha_hora_aviso_pago");
$result->bindParam(':no_placas', $no_placas);
$result->bindParam(':fecha_hora_aviso_pago', $fecha_hora_aviso_pago);
if(!$result->execute()){    
    echo 'Error al eliminar las fotos de la base de datos, por favor intente de nuevo';
    exit;
}

// Finalmente, elimina la colisión
$result = $db->prepare("DELETE FROM aviso_pago WHERE id= :post_id");
$result->bindParam(':post_id', $id);
if($result->execute()){    
    header("location:vistaavisopago.php");
}else{
    echo 'Error al eliminar la boleta, por favor intente de nuevo';
}     
?>