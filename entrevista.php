<?php 
include 'session_timeout.php';
include "sidebar.php"; ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <form action="boletaentrevista.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                            <h1>Boleta Entrevista</h1>

                            <label for="fecha_hora">Fecha Hora Que se ingreso la nueva boleta:</label>
                            <input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control">
                            <br>
                            <label for="fotos_entrevista">Ingrese Fotos Boleta Entrevista (Máximo 10 fotos)</label>
                            <input type="file" name="fotos_entrevista[]" id="fotos_entrevista" multiple accept="image/*" class="form-control" required>
                            <br>

                            <label for="nombre_agente">Nombre del agente:</label>
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
    var input = document.getElementById('fotos_entrevista');
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