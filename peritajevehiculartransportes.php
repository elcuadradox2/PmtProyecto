<?php include"sidebar.php"; ?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">

                            <?php
include "configbd.php";

// Obtener el último número de boleta de la base de datos
$query = "SELECT no_boleta FROM peritaje_vehicular_transportes ORDER BY id DESC LIMIT 1";
$result = $conn->query($query);
$last_boleta = $result->fetch_assoc();

if ($last_boleta) {
    $next_boleta = str_pad((int)$last_boleta['no_boleta'] + 1, 7, '0', STR_PAD_LEFT);
} else {
    $next_boleta = '0000001'; // Primer número de boleta si no hay registros
}
?>

                            <form action="boletaperitajevehiculartransportes.php" method="post" enctype="multipart/form-data">

<h1>Boleta Peritaje Vehicular Transportes</h1>

<label for="no_boleta">No. boleta:</label> 
<input type="text" id="no_boleta" name="no_boleta" class="form-control" value="<?php echo $next_boleta; ?>" readonly required>

<label for="fecha_hora">Fecha Hora Que se ingreso la nueva boleta:</label>
    <input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control">
    <br>

    <label for="placa_peritaje_transportes">Placa del vehiculo peritado</label>
    <input type="text" id="placa_peritaje_transportes" name="placa_peritaje_transportes" class="form-control" required>

    <label for="fotos_peritaje_transportes">Ingrese Fotos Boleta Peritaje Vehicular Transportes</label>
                            <input type="file" name="fotos_peritaje_transportes[]" multiple accept="image/*"  class="form-control" required>
  <br>
 
    <label for="nombre_agente">Nombre del agente:</label>
    <input type="text" id="nombre_agente" name="nombre_agente"  class="form-control">

    <br>

<button type="submit" name="submit" class="btn btn-info btn-fill pull-right">Subir Infraccion</button>
<br>
<br>
</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include"footer.php"; ?>