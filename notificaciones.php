<?php include"sidebar.php"; ?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">

<form action="boletanotificaciones.php" method="post" enctype="multipart/form-data">

<h1>Boleta Notificaciones</h1>

<label for="ubicacion_notificacion">Ubicación de la notificacion:</label>
<input type="text" id="ubicacion_notificacion" name="ubicacion_notificacion" class="form-control" required>

<label for="fecha_hora_notificacion">Fecha y Hora de Notificación:</label>
<input type="datetime-local" id="fecha_hora_notificacion" name="fecha_hora_notificacion" class="form-control">

<label for="nombre_persona_comercio">Nombre de la Persona o Comercio en mención:</label>
<input type="text" id="nombre_persona_comercio" name="nombre_persona_comercio" class="form-control">

<label for="descripcion_notificacion">Descripción de la notificacion:</label> 
<textarea id="descripcion_notificacion" name="descripcion_notificacion" class="form-control"></textarea> 

<label for="fotos_notificaciones">Ingrese Fotos Colisiones</label>
                            <input type="file" name="fotos_notificaciones[]" multiple accept="image/*"  class="form-control" required>

 <label for="tipo_boleta">Tipo de boleta:</label>
  <select id="tipo_boleta" name="tipo_boleta" class="form-control" required>
    <option selected disabled>Seleccione el tipo de boleta</option>
    <option value="de pago">De Pago</option>
    <option value="educativa">Educativa</option>
  </select>

<label for="nombre_chapa_agente">Nombre del agente:</label> 
<input type="text" id="nombre_chapa_agente" name="nombre_chapa_agente" class="form-control" required>
<br>

<label for="estado_pago">Estado de Pago:</label>
<input type="text" id="estado_pago" name="estado_pago" class="form-control" value="No Pagado" readonly>
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