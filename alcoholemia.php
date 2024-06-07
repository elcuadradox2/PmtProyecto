<?php include"sidebar.php"; ?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">

<form action="boletaalcoholemia.php" method="post" enctype="multipart/form-data">

<h1>Boleta Alcoholemia</h1>

<h5>DEL LUGAR DEL OPERATIVO</h5>

<label for="fecha_hora">Fecha y Hora:</label>
<input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control" required>

<label for="lugar_prueba">Lugar donde se realiza la prueba:</label>
<input type="text" id="lugar_prueba" name="lugar_prueba" class="form-control" required>

<h5>DEL CONDUCTOR Y/O PERSONA EVALUADA</h5>

<label for="nombre_conductor">Nombre del Conductor:</label>
<input type="text" id="nombre_conductor" name="nombre_conductor" class="form-control" required> 

<label for="domicilio_conductor">Domicilio del Conductor:</label>
<input type="text" id="domicilio_conductor" name="domicilio_conductor" class="form-control" >

  <label for="no_licencia">No. Licencia:</label>
  <input type="text" id="no_licencia" name="no_licencia" class="form-control" required>

<h5>DEL VEHICULO</h5>  

<label for="tarjeta_circulacion">Tarjeta de Circulación:</label>
<input type="text" id="tarjeta_circulacion" name="tarjeta_circulacion" class="form-control" >

  <label for="no_placas">No. Placas:</label>
  <input type="text" id="no_placas" name="no_placas" class="form-control" required>
 <br>


 <label for="fotos_alcoholemia">Ingrese Fotos Alcoholemia</label>
<input type="file" name="fotos_alcoholemia[]" multiple accept="image/*"  class="form-control" required>
<br>

<label for="tipo_boleta">Tipo de boleta:</label>
  <select id="tipo_boleta" name="tipo_boleta" class="form-control" required>
    <option selected disabled>Seleccione el tipo de boleta</option>
    <option value="de pago">De Pago</option>
    <option value="educativa">Educativa</option>
  </select>
<br>

  <?php 
							  $user=$_SESSION['SESS_MEMBER_ID'];
	$result = $db->prepare("SELECT id,username,name FROM user WHERE id='$user'");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>

<label for="nombre_chapa_agente">Nombre del agente:</label> 
<input type="text" id="nombre_chapa_agente" name="nombre_chapa_agente" class="form-control" value="<?php echo $row['username']; ?>" readonly>
<br>

<?php }?>


<label>Descargar Boleta de Alcoholemia</label>
<a href="boletas/alcoholemia.pdf" class="btn btn-primary" download>Descargar PDF</a>

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