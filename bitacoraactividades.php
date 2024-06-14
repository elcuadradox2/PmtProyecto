<?php include"sidebar.php"; ?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">

                            <form action="boletaactividades.php" method="post" enctype="multipart/form-data">

<h1>Bitacora Actividades</h1>

<label for="fecha_hora">Fecha Hora Que se ingreso la nueva boleta:</label>
    <input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control">
    <br>
    <label for="fotos_actividades">Ingrese Fotos Boleta Bitacora Actividades</label>
                            <input type="file" name="fotos_actividades[]" multiple accept="image/*"  class="form-control" required>
  <br>
 
    <label for="nombre_agente">Nombre quien ingreso la boleta:</label>
    <input type="text" id="nombre_agente" name="nombre_agente"  class="form-control" >
<br>

<label for="pagado">Estado de Pago:</label>
<input type="text" id="pagado" name="pagado" class="form-control" value="No Pagado" readonly>
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
        <?php include"footer.php"; ?>