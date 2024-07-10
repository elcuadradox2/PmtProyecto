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
$query = "SELECT no_boleta FROM colisiones ORDER BY id DESC LIMIT 1";
$result = $conn->query($query);
$last_boleta = $result->fetch_assoc();

if ($last_boleta) {
    $next_boleta = str_pad((int)$last_boleta['no_boleta'] + 1, 7, '0', STR_PAD_LEFT);
} else {
    $next_boleta = '0000001'; // Primer número de boleta si no hay registros
}
?>
                        <form action="boletacolisiones.php" method="POST" enctype="multipart/form-data">
                            <h1>Boleta Colisiones</h1>
                            <label for="no_boleta">No. boleta:</label> 
<input type="text" id="no_boleta" name="no_boleta" class="form-control" value="<?php echo $next_boleta; ?>" readonly required>

                            <label for="fecha_hora">Fecha Hora Que se ingreso la nueva boleta:</label>
                            <input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control">
                            <br>
                            <label for="licencias">Ingrese las licencias</label>
                            <br>
                            <textarea name="licencias" id="licencias" class="form-control" cols="30" rows="5"></textarea>
                            <br>
                            <label for="tarjetas_circulacion">Ingrese las tarjetas de circulacion</label>
                            <br>
                            <textarea name="tarjetas_circulacion" id="tarjetas_circulacion" class="form-control" cols="30" rows="5"></textarea>
                            <br>
                            <label for="fotos_colisiones">Ingrese Fotos Colisiones</label>
                            <input type="file" name="fotos_colisiones[]" multiple accept="image/*"  class="form-control" required>
                            <label for="observaciones">Observaciones</label>
                            <br>
                            <textarea name="observaciones" id="observaciones"  class="form-control" cols="30" rows="5"></textarea>
                            <br>

<label for="nombre_chapa_agente">Nombre del agente:</label> 
<input type="text" id="nombre_chapa_agente" name="nombre_chapa_agente" class="form-control">
<br>
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