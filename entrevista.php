<?php include"sidebar.php"; ?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">

                            <form action="boletaentrevista.php" method="post" enctype="multipart/form-data">

<h1>Boleta Entrevista</h1>

<label for="fecha_hora">Fecha Hora Que se ingreso la nueva boleta:</label>
    <input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control">
    <br>
    <label for="fotos_entrevista">Ingrese Fotos Boleta Estrevista</label>
                            <input type="file" name="fotos_entrevista[]" multiple accept="image/*"  class="form-control" required>
  <br>

  <?php 
							  $user=$_SESSION['SESS_MEMBER_ID'];
	$result = $db->prepare("SELECT id,username,name FROM user WHERE id='$user'");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
 
    <label for="nombre_agente">Nombre del agente:</label>
    <input type="text" id="nombre_agente" name="nombre_agente"  class="form-control" value="<?php echo $row['username']; ?>" readonly>

    <?php }?>

    <br>

<label>Descargar Boleta De Entrevista</label>
<a href="boletas/entrevista.pdf" class="btn btn-primary" download>Descargar PDF</a>

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