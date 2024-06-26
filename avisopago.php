<?php include"sidebar.php"; ?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">

<form action="boletaavisopago.php" method="post" enctype="multipart/form-data">

<h1>Boleta Aviso Pago y Citación</h1>

<label for="no_boleta">No. boleta:</label> 
<input type="text" id="no_boleta" name="no_boleta" class="form-control" required>

<label for="ubicacion_aviso_pago">Ubicación de la Infracción:</label>
<input type="text" id="ubicacion_notificacion" name="ubicacion_notificacion" class="form-control" required>

<label for="dpi_aviso_pago">DPI:</label>
<input type="text" id="dpi_aviso_pago" name="dpi_aviso_pago" class="form-control" required>

<label for="no_placas">No. Placas:</label>
<input type="text" id="no_placas" name="no_placas" class="form-control" required>

<label for="fecha_hora_aviso_pago">Fecha y Hora de la Infracción:</label>
<input type="datetime-local" id="fecha_hora_aviso_pago" name="fecha_hora_aviso_pago" class="form-control">

<label for="nombre_completo">Nombre Completo:</label>
<input type="text" id="nombre_completo" name="nombre_completo" class="form-control">

<label for="descripcion_aviso_pago">Descripción de la boleta:</label> 
<textarea id="descripcion_aviso_pago" name="descripcion_aviso_pago" class="form-control"></textarea> 

<label for="fotos_aviso_pago">Ingrese Fotos</label>
                            <input type="file" name="fotos_aviso_pago[]" multiple accept="image/*"  class="form-control" required>

 <label for="tipo_boleta">Tipo de boleta:</label>
  <select id="tipo_boleta" name="tipo_boleta" class="form-control" required>
    <option selected disabled>Seleccione el tipo de boleta</option>
    <option value="de pago">De Pago</option>
    <option value="educativa">Educativa</option>
  </select>

<label for="nombre_chapa_agente">Nombre del agente:</label> 
<input type="text" id="nombre_chapa_agente" name="nombre_chapa_agente" class="form-control" required>
<br>

<label for="estado_pago"></label>
<input type="text" id="estado_pago" name="estado_pago" class="form-control" value="No Pagado" readonly style="display: none;">
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