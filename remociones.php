<?php include"sidebar.php"; ?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">

<form action="boletaremociones.php" method="post" enctype="multipart/form-data">

<h1>Boleta Remociones</h1>

<label for="ubicacion_remocion">Ubicación de la remoción:</label> 
<input type="text" id="ubicacion_remocion" name="ubicacion_remocion" class="form-control" required> 

<label for="fecha_hora_remocion">Fecha y Hora de la Remocion:</label>
<input type="datetime-local" id="fecha_hora_remocion" name="fecha_hora_remocion" class="form-control"> 

<label for="nombre_persona_comercio">Nombre de la Persona o Comercio:</label> 
<input type="text" id="nombre_persona_comercio" name="nombre_persona_comercio" class="form-control"> 

<label for="descripcion_consignacion">Descripción de Objetos consignados por la Autoridad:</label> 
<textarea id="descripcion_consignacion" name="descripcion_consignacion" class="form-control"></textarea> 

<label for="fotos_remociones">Ingrese Fotos Remocion</label>
<input type="file" name="fotos_remociones[]" multiple accept="image/*"  class="form-control" required>

<label for="tipo_boleta">Tipo de boleta:</label>
  <select id="tipo_boleta" name="tipo_boleta" class="form-control" required>
    <option selected disabled>Seleccione el tipo de boleta</option>
    <option value="de pago">De Pago</option>
    <option value="educativa">Educativa</option>
  </select>

<?php 
							  $user=$_SESSION['SESS_MEMBER_ID'];
	$result = $db->prepare("SELECT id,username,name FROM user WHERE id='$user'");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>

<label for="nombre_chapa_agente">Nombre y Chapa del agente:</label> 
<input type="text" id="nombre_chapa_agente" name="nombre_chapa_agente" class="form-control" value="<?php echo $row['username']; ?>" readonly>
<br>

<?php }?>

<br>

<label>Descargar Boleta de Remoción</label>
<a href="boletas/remocion.pdf" class="btn btn-primary" download>Descargar PDF</a>


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