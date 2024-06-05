<?php include"sidebar.php"; ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <form action="boletacolisiones.php" method="POST" enctype="multipart/form-data">
                            <h1>Boleta Colisiones</h1>
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
                            <?php 
							  $user=$_SESSION['SESS_MEMBER_ID'];
	$result = $db->prepare("SELECT id,username,name FROM user WHERE id='$user'");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>

<label for="nombre_chapa_agente">Nombre y Chapa del agente:</label> 
<input type="text" id="nombre_chapa_agente" name="nombre_chapa_agente" class="form-control" value="<?php echo $row['username']; ?>" readonly>
<br>
<br>
<?php }?>
                            <label>Descargar Boleta De Colisiones</label>
                            <a href="boletas/colisiones.pdf" class="btn btn-primary" download>Descargar PDF</a>
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