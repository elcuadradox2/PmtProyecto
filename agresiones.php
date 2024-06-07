<?php include"sidebar.php"; ?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">

<form action="boletaagresiones.php" method="post" enctype="multipart/form-data">

<h1>Boleta Agresiones</h1>

    <h5>DATOS DEL AGENTE Y DE LA AGRESION</h5>
    
    <label for="nombre_chapa">Nombre O Chapa del agente:</label>
    <input type="text" id="nombre_chapa" name="nombre_chapa"class="form-control" required>
    <br>

    <label for="lugar">Lugar del hecho:</label>
    <input type="text" id="lugar" name="lugar" class="form-control" required>
    <br>

    <label for="fecha_hora">Fecha y Hora:</label>
    <input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control" required> 
    <br>

    <h5>DATOS DEL AGRESOR Y/O VEHICULO QUE CONDUCE</h5>

    <label for="nombre">Nombre Completo:</label>
    <input type="text" id="nombre" name="nombre" class="form-control" required>
    <br>

    <label for="no_licencia">No. Licencia:</label>
    <input type="text" id="no_licencia" name="no_licencia" class="form-control" required>
    <br>

    <label for="no_placa">No. Placa:</label>
    <input type="text" id="no_placa" name="no_placa" class="form-control" required>
    <br>

    <label for="fotos_agresiones">Ingrese Fotos Agresiones</label>
<input type="file" name="fotos_agresiones[]" multiple accept="image/*"  class="form-control" required>
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

    <label>Descargar Boleta de Agresiones</label>
<a href="boletas/agresiones.pdf" class="btn btn-primary" download>Descargar PDF</a>

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