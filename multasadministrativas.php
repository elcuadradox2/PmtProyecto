<?php 
include 'session_timeout.php';
include "sidebar.php"; ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">

                        <form action="boletaadministrativas.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">

                            <h1>Multas Administrativas</h1>

                            <label for="fecha_hora">Fecha Hora de la multa:</label>
                            <input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control">
                            <br>
                            <label for="no_taxi">No.Taxi:</label>
                            <input type="text" id="no_taxi" name="no_taxi" class="form-control">
                            <br>
                            <label for="nombre_propietario">Nombre de propietario:</label>
                            <input type="text" id="nombre_propietario" name="nombre_propietario" class="form-control">
                            <br>
                            <label for="nombre_piloto">Nombre de piloto:</label>
                            <input type="text" id="nombre_piloto" name="nombre_piloto" class="form-control">
                            <br>
                            <label for="no_dpi">No.DPI:</label>
                            <input type="text" id="no_dpi" name="no_dpi" class="form-control">
                            <br>
                            <label for="no_placas">No.Placas:</label>
                            <input type="text" id="no_placas" name="no_placas" class="form-control">
                            <br>
                            <label for="fotos_administrativas">Ingrese Fotos Boleta Multas Administrativas (Máximo 10 fotos)</label>
                            <input type="file" name="fotos_administrativas[]" id="fotos_administrativas" multiple accept="image/*" class="form-control" required>
                            <br>
                            <label for="estado_pago" style="display:none;">Estado de Pago:</label>
                            <input type="text" id="estado_pago" name="estado_pago" class="form-control" value="No Pagado" readonly aria-hidden="" style="display:none;">
                            <br>

                            <label for="nombre_agente">Nombre quien ingreso la boleta:</label>
                            <input type="text" id="nombre_agente" name="nombre_agente" class="form-control">
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
    var input = document.getElementById('fotos_administrativas');
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