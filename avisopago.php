<?php include "sidebar.php"; ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <?php
                        include "configbd.php";

                        // Obtener el último número de boleta de la base de datos
                        $query = "SELECT no_boleta FROM avisopago ORDER BY id DESC LIMIT 1";
                        $result = $conn->query($query);
                        $last_boleta = $result->fetch_assoc();

                        if ($last_boleta) {
                            $next_boleta = str_pad((int)$last_boleta['no_boleta'] + 1, 7, '0', STR_PAD_LEFT);
                        } else {
                            $next_boleta = '0000001'; // Primer número de boleta si no hay registros
                        }
                        ?>

                        <form action="boletaavisopago.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                            <h1>Boleta Aviso de Pago</h1>

                            <label for="no_boleta">No. boleta:</label>
                            <input type="text" id="no_boleta" name="no_boleta" class="form-control" value="<?php echo $next_boleta; ?>" readonly required>

                            <h5>DATOS DEL PAGO</h5>

                            <label for="nombre_chapa">Nombre O Chapa del agente:</label>
                            <input type="text" id="nombre_chapa" name="nombre_chapa" class="form-control" required>
                            <br>

                            <label for="lugar">Lugar del hecho:</label>
                            <input type="text" id="lugar" name="lugar" class="form-control" required>
                            <br>

                            <label for="fecha_hora">Fecha y Hora:</label>
                            <input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control" required>
                            <br>

                            <h5>DATOS DEL PAGO</h5>

                            <label for="nombre">Nombre Completo:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" required>
                            <br>

                            <label for="no_licencia">No. Licencia:</label>
                            <input type="text" id="no_licencia" name="no_licencia" class="form-control" required>
                            <br>

                            <label for="no_placa">No. Placa:</label>
                            <input type="text" id="no_placa" name="no_placa" class="form-control" required>
                            <br>

                            <label for="fotos_avisopago">Ingrese Fotos Aviso de Pago (Máximo 10 fotos)</label>
                            <input type="file" name="fotos_avisopago[]" id="fotos_avisopago" multiple accept="image/*" class="form-control" required>
                            <br>

                            <label for="tipo_boleta">Tipo de boleta:</label>
                            <select id="tipo_boleta" name="tipo_boleta" class="form-control" required>
                                <option selected disabled>Seleccione el tipo de boleta</option>
                                <option value="de pago">De Pago</option>
                                <option value="educativa">Educativa</option>
                            </select>
                            <br>

                            <label for="nombre_chapa_agente">Nombre del agente:</label>
                            <input type="text" id="nombre_chapa_agente" name="nombre_chapa_agente" class="form-control" required>
                            <br>

                            <label for="estado_pago">Estado de Pago:</label>
                            <input type="text" id="estado_pago" name="estado_pago" class="form-control" value="No Pagado" readonly>
                            <br>

                            <button type="submit" name="submit" class="btn btn-info btn-fill pull-right">Subir Infracción</button>
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
    var input = document.getElementById('fotos_avisopago');
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