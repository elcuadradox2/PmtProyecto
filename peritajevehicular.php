<?php 
include 'session_timeout.php';
include "sidebar.php"; ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">

                        <?php
                        include "configbd.php";

                        // Obtener el último número de boleta de la base de datos
                        $query = "SELECT no_boleta FROM peritaje_vehicular ORDER BY id DESC LIMIT 1";
                        $result = $conn->query($query);
                        $last_boleta = $result->fetch_assoc();

                        if ($last_boleta) {
                            $next_boleta = str_pad((int)$last_boleta['no_boleta'] + 1, 7, '0', STR_PAD_LEFT);
                        } else {
                            $next_boleta = '0000001'; // Primer número de boleta si no hay registros
                        }
                        ?>

                        <form action="boletaperitajevehicular.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">

                            <h1>Boleta Peritaje Vehicular</h1>

                            <label for="no_boleta">No. boleta:</label>
                            <input type="text" id="no_boleta" name="no_boleta" class="form-control" value="<?php echo $next_boleta; ?>" readonly required>

                            <label for="fecha_hora">Fecha Hora Que se ingreso la nueva boleta:</label>
                            <input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control">
                            <br>

                            <label for="placa_peritaje">Placa del vehiculo peritado</label>
                            <input type="text" id="placa_peritaje" name="placa_peritaje" class="form-control" required>

                            <label for="fotos_peritaje">Ingrese Fotos Boleta Peritaje Vehicular (Máximo 10 fotos)</label>
                            <input type="file" name="fotos_peritaje[]" id="fotos_peritaje" multiple accept="image/*" class="form-control" required>
                            <br>

                            <label for="nombre_agente">Nombre del agente:</label>
                            <input type="text" id="nombre_agente" name="nombre_agente" class="form-control">
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
<?php include "footer.php"; ?>

<script>
function validateForm() {
    var input = document.getElementById('fotos_peritaje');
    if (input.files.length > 10) {
        alert('No se pueden subir más de 10 fotos.');
        return false;
    }
    return true;
}

<?php if (isset($_GET['status'])): ?>
    <?php if ($_GET['status'] == 'success'): ?>
        alert('Formulario enviado correctamente.');
    <?php elseif ($_GET['status'] == 'error'): ?>
        alert('Hubo un error al enviar el formulario.');
    <?php elseif (isset($_GET['message']) && $_GET['message'] == 'too_many_files'): ?>
        alert('No se pueden subir más de 10 fotos.');
    <?php endif; ?>
<?php endif; ?>
</script>