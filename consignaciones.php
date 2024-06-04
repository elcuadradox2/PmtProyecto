<?php include"sidebar.php"; ?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">

<form action="boletaconsignaciones.php" method="post" enctype="multipart/form-data">

<h1>Boleta Consignaciones</h1>

<label for="fecha_hora">Fecha Hora Que se ingreso la nueva boleta:</label>
    <input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control">
    <br>
    <label for="fotos_reporte_consignacion">Ingrese Fotos Boleta Reporte Interno</label>
                            <input type="file" name="fotos_reporte_consignacion[]" multiple accept="image/*"  class="form-control" required>
    <br>

    <label for="ubicacion_consignacion">Ubicación de la consignación:</label>
    <input type="text" id="ubicacion_consignacion" name="ubicacion_consignacion" class="form-control" required>

    <label for="no_licencia">No.Licencia:</label>
    <input type="text" id="no_licencia" name="no_licencia" class="form-control" required>

    <label for="no_tarjeta_circulacion">No. Tarjeta de Circulación:</label>
    <input type="text" id="no_tarjeta_circulacion" name="no_tarjeta_circulacion" class="form-control" required>

    <label for="no_peritaje">No. Peritaje con que ingreso al predio:</label>
    <input type="text" id="no_peritaje" name="no_peritaje" class="form-control" required>

    <label for="observaciones">Observaciones:</label>
    <textarea id="observaciones" name="observaciones" class="form-control" required></textarea>

    <?php 
							  $user=$_SESSION['SESS_MEMBER_ID'];
	$result = $db->prepare("SELECT id,username,name FROM user WHERE id='$user'");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
    

    <label for="nombre_chapa_agente">Nombre y Chapa del agente:</label>
    <input type="text" id="nombre_chapa_agente" name="nombre_chapa_agente" class="form-control" value="<?php echo $row['username']; ?>"  readonly>
<br>

<?php }?>

<label>Descargar Boleta de Consignaciones</label>
<a href="boletas/consignaciones.pdf" class="btn btn-primary" download>Descargar PDF</a>

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