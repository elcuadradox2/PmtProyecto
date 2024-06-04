<?php include"sidebar.php"; ?>
   <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Reportar Nueva Infraccion</h4>
                            </div>
							<?php if(get("success")):?>
                                            <div>
                                               <?=App::message("success", "Successfully Reported!")?>
                                            </div>
                                            <?php endif;?>
<div class="content">
							    <form action="save-reported.php" method="post">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ID Infraccion</label>
                                                <input type="text" name="offence_id" class="form-control" placeholder="ID Infraccion" value="<?php 
$prefix= md5(time()*rand(1, 2)); echo strip_tags(substr($prefix ,0,6));?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>No. Placa</label>
                                                <input type="text" name="vehicle_no" class="form-control" placeholder="No. Placa" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">No. Licencia</label>
                                                <input type="text" name="driver_license"  class="form-control" placeholder="No. Licencia">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nombre Conductor</label>
                                                <input type="text" name="name" class="form-control" placeholder="Nombre Conductor">
                                            </div>
                                        </div>
                                     </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Direccion del Incidente</label>
                                                <input type="text" name="address"  class="form-control" placeholder="Direccion del Incidente" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Genero</label>
                                                 <select class="form-control" name="gender" >
  <option value="Male">Masculino</option>
  <option value="Female">Femenino</option>
</select> 
                                            </div>
                                        </div>
										<?php 
							  $user=$_SESSION['SESS_MEMBER_ID'];
	$result = $db->prepare("SELECT id,username,email,name,address FROM user WHERE id='$user'");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
		
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Oficial Que Reporta</label>
                                                <input type="text" name="officer_reporting"  class="form-control" placeholder="Officer Name" value="<?php echo $row['username']; ?>" readonly>
                                            </div>
                                        </div>
	<?php }?>
                                    </div>
 <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Infraccion</label>
                                                <select class="form-control" id="offence" name="offence" >
  <option selected disabled>Seleccione el tipo de infraccion que requiere</option>
  <option value="consignaciones">consignaciones</option>
  <option value="remociones">remociones</option>
  <option value="colisiones">colisiones</option>
  <option value="agresiones">agresiones</option>
  <option value="notificacion">notificacion</option>
  <option value="alcoholemia">alcoholemia</option>
  <!-- Más opciones según sea necesario -->
</select>
  <!------------------------------------------------ Campo Consignaciones ---------------------------------------->
<div id="consignaciones" style="display: none;">

<label for="fecha_hora_consignacion">Fecha y Hora de la Consignación:</label>
<input type="datetime-local" id="fecha_hora_consignacion" name="fecha_hora_consignacion" class="form-control">

<label for="ubicacion_consignacion">Ubicación de la consignación:</label>
<input type="text" id="ubicacion_consignacion" name="ubicacion_consignacion" class="form-control">

<label for="objetos_consignacion">Fue Consignado:</label>
<input type="checkbox" id="documentos_consignacion" name="documentos_consignacion" value="documentos">
<label for="documentos_consignacion" >Documentos</label>

<input type="checkbox" id="vehiculo_consignacion" name="vehiculo_consignacion" value="vehiculo">
<label for="vehiculo_consignacion">Vehículo</label>

<h5>Por:</h5>

<label for="motivo_consignacion">Motivo de la consignación:</label>
<select id="motivo_consignacion" name="motivo_consignacion" class="form-control">
  <option selected disabled>Seleccione el motivo de la consignación</option>
  <option value="licencia_vencida_alterada">Por conducir con licencia vencida o alterada</option>
  <option value="faltar_respeto_autoridad">Por faltarle el respeto (agresión) a la autoridad</option>
  <option value="sin_licencia">Por no tener licencia de conducir</option>
  <option value="sin_tarjeta_circulacion">Por no tener tarjeta de circulación</option>
  <option value="placas_provisionales_no_autorizadas">Por portar placas provisionales no autorizadas</option>
  <option value="multas_pendientes">Por tener multas pendientes de cancelación</option>
  <option value="sin_placas_circulacion">Por no tener placas de circulación</option>
  <option value="desacuerdo_colision">Por desacuerdo en colisión</option>
  <option value="danios_propiedad_municipal">Por daños a la propiedad Municipal</option>
  <option value="conducir_alcohol">Por conducir bajo efectos de alcohol</option>
  <option value="tarjeta_circulacion_distinta">Por portar tarjeta de circulacion con datos distintos al vehículo</option>
  <option value="no_cancelar_inmovilizador">Por no cancelar el aparato inmovilizador</option>
  <option value="otros">Otros (Especificar)</option>
</select>

<label for="tipo_vehiculo">Tipo de vehículo:</label>
<select id="tipo_vehiculo" name="tipo_vehiculo" class="form-control">
  <option selected disabled>Seleccione el tipo de vehiculo</option>
  <option value="automovil">Automóvil</option>
  <option value="bus_escolar">Bus Escolar</option>
  <option value="bus_extra_urbano">Bus Extra Urbano</option>
  <option value="bus_urbano">Bus Urbano</option>
  <option value="cabezal">Cabezal</option>
  <option value="camion">Camión</option>
  <option value="jeep">Jeep</option>
  <option value="microbus">Microbus</option>
  <option value="motocicleta">Motocicleta</option>
  <option value="mototaxi">Mototaxi</option>
  <option value="panel">Panel</option>
  <option value="pick_up">Pick Up</option>
  <option value="taxi">Taxi</option>
</select>

<h5>Se hace mención que se consignan y se adjunta los siguientes documentos:</h5>

<label for="clase_licencia">Clase Licencia:</label>
<input type="text" id="clase_licencia" name="clase_licencia" class="form-control">

<label for="no_licencia">No.Licencia:</label>
<input type="text" id="no_licencia" name="no_licencia" class="form-control">

<label for="nombre_licencia">Nombre de licencia:</label>
<input type="text" id="nombre_licencia" name="nombre_licencia" class="form-control">


<label for="vigencia_licencia">Vigencia Licencia:</label>
<select id="vigencia_licencia" name="vigencia_licencia" class="form-control">
  <option selected disabled>Seleccione SI o NO</option>
  <option value="1">Si</option>
  <option value="2">No</option>
</select>

<label for="fecha_vencimiento">Indicar fecha vencimiento si fuera el caso:</label>
<input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control">

<label for="tipo_placa">Tipo de placa:</label>
<input type="text" id="tipo_placa" name="tipo_placa" class="form-control">

<label for="no_placa">No.Placa:</label>
<input type="text" id="no_placa" name="no_placa" class="form-control">

<label for="no_tarjeta_circulacion">No. Tarjeta de Circulación:</label>
<input type="text" id="no_tarjeta_circulacion" name="no_tarjeta_circulacion" class="form-control">

<label for="nombre_tarjeta_circulacion">Nombre De Tarjeta de Circulación:</label>
<input type="text" id="nombre_tarjeta_circulacion" name="nombre_tarjeta_circulacion" class="form-control">

<label for="copia_autenticada">Copia Autenticada:</label>
<select id="copia_autenticada" name="copia_autenticada" class="form-control">
<option selected disabled>Seleccione SI o NO</option>
  <option value="Si">Si</option>
  <option value="No">No</option>
</select>

<h6>Si el vehículo es consignado, indicar</h6>

<label for="no_peritaje">No. Peritaje con que ingreso al predio:</label>
<input type="text" id="no_peritaje" name="no_peritaje" class="form-control">

<label for="observaciones">Observaciones:</label>
<textarea id="observaciones" name="observaciones" class="form-control"></textarea>

<label for="nombre_chapa_jefe">Nombre Y Chapa Jefe de estación:</label>
<input type="text" id="nombre_chapa_jefe" name="nombre_chapa_jefe"  class="form-control" readonly>

<label for="nombre_chapa_agente">Nombre y Chapa del agente:</label>
<input type="text" id="nombre_chapa_agente" name="nombre_chapa_agente" class="form-control" readonly>

</div>
<!----------------------------------------- Campo Remociones ----------------------------------------------->
<div id="remociones" style="display: none;">
<h5>Esta constituye EL AVISO DE CONSIGNACIÓN de los objetos que obstaculizan la VÍA PUBLICA y pasos peatonales: se
procede a retirarlos al no haber acatado la notificación previa.</h5>

<label for="ubicacion_remocion">Ubicación de la remoción:</label>
<input type="text" id="ubicacion_remocion" name="ubicacion_remocion" class="form-control">

<label for="fecha_hora_remocion">Fecha y Hora de la Remocion:</label>
<input type="datetime-local" id="fecha_hora_remocion" name="fecha_hora_remocion" class="form-control">

<label for="No_notificacion">No.Notificacion:</label>
<input type="text" id="No_notificicacion" name="No_notificacion" class="form-control">

<label for="nombre_persona_comercio">Nombre de la Persona o Comercio:</label>
<input type="text" id="nombre_persona_comercio" name="nombre_persona_comercio" class="form-control">

<label for="descripcion_consignacion">Descripción de Objetos consignados por la Autoridad:</label>
<input type="text" id="descripcion_consignacion" name="descripcion_consignacion" class="form-control">

<label for="nombre_chapa_agente">Nombre y Chapa del agente:</label>
<input type="text" id="nombre_chapa_agente" name="nombre_chapa_agente" class="form-control" readonly>

</div>

<!------------------------------------------ Campo Colisiones -------------------------------------------->
<div id="colisiones" style="display: none;">
 <!-- Campo de entrada para Departamento -->
<label for="departamento">Departamento:</label>
<input type="text" id="departamento" name="departamento" class="form-control">
<br>

<!-- Campo de entrada para Municipio -->
<label for="municipio">Municipio:</label>
<input type="text" id="municipio" name="municipio" class="form-control">
<br>

<!-- Campo de entrada para Estación -->
<label for="estacion">Estación:</label>
<input type="text" id="estacion" name="estacion" class="form-control">
<br>

<!-- Campo de entrada para Fecha y Hora -->
<label for="fecha_hora">Fecha y Hora:</label>
<input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control">
<br>

<!-- Menú desplegable para seleccionar el día -->
<label for="dia">Día:</label>
<select id="dia" name="dia" class="form-control">
<option selected disabled>Seleccione el dia de la semana</option>
  <option value="lunes">Lunes</option>
  <option value="martes">Martes</option>
  <option value="miercoles">Miércoles</option>
  <option value="jueves">Jueves</option>
  <option value="viernes">Viernes</option>
  <option value="sabado">Sábado</option>
  <option value="domingo">Domingo</option>
</select>
<br>

<!-- Campo de entrada para Carretera -->
<label for="carretera">Carretera:</label>
<input type="text" id="carretera" name="carretera" class="form-control">
<br>

<!-- Campo de entrada para Km -->
<label for="km">Km:</label>
<input type="text" id="km" name="km" class="form-control">
<br>

<!-- Campo de entrada para Calzada -->
<label for="calzada">Calzada:</label>
<input type="text" id="calzada" name="calzada" class="form-control">
<br>

<!-- Campo de entrada para Avenida -->
<label for="avenida">Avenida:</label>
<input type="text" id="avenida" name="avenida" class="form-control"> 
<br>

<!-- Campo de entrada para Calle -->
<label for="calle">Calle:</label>
<input type="text" id="calle" name="calle" class="form-control">
<br>

<!-- Campo de entrada para Blvd. -->
<label for="blvd">Blvd.:</label>
<input type="text" id="blvd" name="blvd" class="form-control"> 
<br>

<!-- Campo de entrada para Ruta -->
<label for="ruta">Ruta:</label>
<input type="text" id="ruta" name="ruta" class="form-control">
<br>

<!-- Campo de entrada para Via y/o colonia -->
<label for="via_colonia">Via y/o colonia:</label>
<input type="text" id="via_colonia" name="via_colonia" class="form-control">
<br>

<!-- Campo de entrada para Numeral -->
<label for="numeral">Numeral:</label>
<input type="text" id="numeral" name="numeral" class="form-control">
<br>

<!-- Campo de entrada para Zona -->
<label for="zona">Zona:</label>
<input type="text" id="zona" name="zona" class="form-control">
<br>


<div id="vehiculos">
<!-- Menú desplegable para Tipo de Vehículo -->
<label for="tipo_vehiculo">Tipo de Vehículo:</label>
<select id="tipo_vehiculo" name="tipo_vehiculo" class="form-control">
<option selected disabled>Seleccione el tipo de vehiculo</option>
  <option value="1">Automóvil</option>
  <option value="2">Pick Up</option>
  <option value="3">Motocicleta</option>
  <option value="4">Mototaxi</option>
  <option value="5">Camionetilla</option>
  <option value="6">Camioneta</option>
  <option value="7">Bus U</option>
  <option value="8">Bus E</option>
  <option value="9">Camión</option>
  <option value="10">Cabezal</option>
  <option value="11">Taxi</option>
  <option value="12">Bus Esc.</option>
  <option value="13">Tractor</option>
  <option value="14">Bicicleta</option>
  <option value="15">Jeep</option>
  <option value="16">Panel</option>
  <option value="17">Montacargas</option>
  <option value="18">Plataforma</option>
</select>
<br>

<!-- Campo de entrada para Tipo de placas -->
<label for="tipo_placas">Tipo de placas:</label>
<input type="text" id="tipo_placas" name="tipo_placas" class="form-control">
<br>

<!-- Campo de entrada para No.de placas -->
<label for="no_placas">No.de placas:</label>
<input type="text" id="no_placas" name="no_placas" class="form-control">
<br>

<!-- Campo de entrada para Tarjeta de Circulacion -->
<label for="tarjeta_circulacion">Tarjeta de Circulación:</label>
<input type="text" id="tarjeta_circulacion" name="tarjeta_circulacion" class="form-control">
<br>

<!-- Campo de entrada para Marca -->
<label for="marca">Marca:</label>
<input type="text" id="marca" name="marca" class="form-control">
<br>

<!-- Campo de entrada para Color -->
<label for="color">Color:</label>
<input type="text" id="color" name="color" class="form-control">
<br>

<!-- Menú desplegable para Tipo de servicio -->
<label for="tipo_servicio">Tipo de servicio:</label>
<select id="tipo_servicio" name="tipo_servicio" class="form-control">
<option selected disabled>Seleccione el tipo de servicio</option>
  <option value="particular">Particular</option>
  <option value="alquiler">Alquiler</option>
  <option value="comercial">Comercial</option>
  <option value="urbano">Urbano</option>
  <option value="extraurbano">Extraurbano</option>
  <option value="emergencia">Emergencia</option>
  <option value="oficial">Oficial</option>
</select>
<br>

<!-- Campo de entrada para Nombre Conductor -->
<label for="nombre_conductor">Nombre Conductor:</label>
<input type="text" id="nombre_conductor" name="nombre_conductor" class="form-control">
<br>

<!-- Campo de entrada para Edad -->
<label for="edad">Edad:</label>
<input type="number" id="edad" name="edad" min="1" class="form-control">
<br>

<!-- Menú desplegable para seleccionar sexo -->
<label for="sexo">Sexo:</label>
<select id="sexo" name="sexo" class="form-control">
<option selected disabled>Seleccione el sexo</option>
  <option value="masculino">Masculino</option>
  <option value="femenino">Femenino</option>
  <option value="otro">Otro</option>
</select>
<br>

<!-- Campo de entrada para Domicilio -->
<label for="domicilio">Domicilio:</label>
<input type="text" id="domicilio" name="domicilio" class="form-control">
<br>

<!-- Campo de entrada para No.Licencia -->
<label for="no_licencia">No. Licencia:</label>
<input type="text" id="no_licencia" name="no_licencia" class="form-control">
<br>

<!-- Menú desplegable para Tipo Licencia -->
<label for="tipo_licencia">Tipo Licencia:</label>
<select id="tipo_licencia" name="tipo_licencia" class="form-control">
<option selected disabled>Seleccione tipo de licencia</option>
  <option value="A">A</option>
  <option value="B">B</option>
  <option value="C">C</option>
  <option value="E">E</option>
  <option value="M">M</option>
  <option value="JUV">JUV</option>
  <option value="EXT">EXT</option>
</select>
<br>

<!-- Campo de entrada para No.Cedula -->
<label for="no_cedula">No. Cédula:</label>
<input type="text" id="no_cedula" name="no_cedula" class="form-control">
<br>

<!-- Menú desplegable para Licencia Vencida -->
<label for="licencia_vencida">Licencia Vencida:</label>
<select id="licencia_vencida" name="licencia_vencida" class="form-control">
<option selected disabled>Seleccione SI o NO</option>
  <option value="si">Si</option>
  <option value="no">No</option>
</select>
<br>

<!-- Menú desplegable para Evidencia de ser falsa -->
<label for="evidencia_falsa">Evidencia de ser falsa:</label>
<select id="evidencia_falsa" name="evidencia_falsa" class="form-control">
<option selected disabled>Seleccione SI o NO</option>
  <option value="si">Si</option>
  <option value="no">No</option>
</select>
<br>

<!-- Menú desplegable para Licencia Acorde -->
<label for="licencia_acorde">Licencia Acorde:</label>
<select id="licencia_acorde" name="licencia_acorde" class="form-control">
<option selected disabled>Seleccione SI o NO</option>
  <option value="si">Si</option>
  <option value="no">No</option>
</select>
<br>

<!-- Campo de entrada para No.Ocupantes adicionales -->
<label for="no_ocupantes">No. Ocupantes adicionales:</label>
<input type="number" id="no_ocupantes" name="no_ocupantes" min="0" class="form-control">
<br>

<!-- Menú desplegable para Dispositivos de Seguridad -->
<label for="dispositivos_seguridad">Dispositivos de Seguridad:</label>
<select id="dispositivos_seguridad" name="dispositivos_seguridad" class="form-control">
<option selected disabled>Seleccione el dispositivos de seguridad</option>
  <option value="casco">Casco</option>
  <option value="bolsa_aire">Bolsa de aire</option>
  <option value="cinturon">Cinturón</option>
  <option value="silla_bebe">Silla para Bebé</option>
</select>
<br>

<!-- Menú desplegable para Estado del conductor -->
<label for="estado_conductor">Estado del conductor:</label>
<select id="estado_conductor" name="estado_conductor" class="form-control">
<option selected disabled>Seleccione el estado del conductor</option>
  <option value="ebrio">Ebrio</option>
  <option value="inconsciente">Inconsciente</option>
  <option value="grados">Grados</option>
  <option value="fallecido">Fallecido</option>
  <option value="pee">PEE</option>
  <option value="herido">Herido</option>
</select>
<br>

<!-- Menú desplegable para Conductor Trasladado por -->
<label for="trasladado_por">Conductor Trasladado por:</label>
<select id="trasladado_por" name="trasladado_por"  class="form-control">
<option selected disabled>Seleccione una opcion</option>
  <option value="bomberos_municipales">Bomberos Municipales</option>
  <option value="bomberos_voluntarios">Bomberos Voluntarios</option>
  <option value="ministerio_publico">Ministerio Público</option>
  <option value="particular">Particular</option>
</select>

<label>Daños Ocasionados:</label><br>
<input type="checkbox" id="semáforos" name="danos_ocasionados" value="semáforos">
<label for="semáforos">Semáforos</label><br>

<input type="checkbox" id="bardas" name="danos_ocasionados" value="bardas">
<label for="bardas">Bardas</label><br>

<input type="checkbox" id="banqueta" name="danos_ocasionados" value="banqueta">
<label for="banqueta">Banqueta</label><br>

<input type="checkbox" id="area_verde" name="danos_ocasionados" value="área_verde">
<label for="area_verde">Área Verde</label><br>

<input type="checkbox" id="pasarela" name="danos_ocasionados" value="pasarela">
<label for="pasarela">Pasarela</label><br>

<input type="checkbox" id="puente" name="danos_ocasionados" value="puente">
<label for="puente">Puente</label><br>

<input type="checkbox" id="conos" name="danos_ocasionados" value="conos">
<label for="conos">Conos</label><br>

<input type="checkbox" id="senales_verticales" name="danos_ocasionados" value="señales_verticales">
<label for="senales_verticales">Señales Verticales</label><br>

<input type="checkbox" id="postes_electricidad" name="danos_ocasionados" value="postes_electricidad">
<label for="postes_electricidad">Postes Electricidad</label><br>

<input type="checkbox" id="postes_telgua" name="danos_ocasionados" value="postes_telgua">
<label for="postes_telgua">Postes Telgua</label><br>

<input type="checkbox" id="postes_cable" name="danos_ocasionados" value="postes_cable">
<label for="postes_cable">Postes Cable</label><br>

<input type="checkbox" id="vallas_publicitarias" name="danos_ocasionados" value="vallas_publicitarias">
<label for="vallas_publicitarias">Vallas Publicitarias</label><br>

<input type="checkbox" id="new_jerseys" name="danos_ocasionados" value="new_jerseys">
<label for="new_jerseys">New Jerseys</label><br>

<input type="checkbox" id="malla_metalica" name="danos_ocasionados" value="malla_metálica">
<label for="malla_metalica">Malla Metálica</label><br>

<input type="checkbox" id="muppies" name="danos_ocasionados" value="muppies">
<label for="muppies">Muppies</label><br>

<input type="checkbox" id="boyas" name="danos_ocasionados" value="boyas">
<label for="boyas">Boyas</label><br>


<label for="forma_incidente">Forma del Incidente:</label>
<select id="forma_incidente" name="forma_incidente" class="form-control">
<option selected disabled>Seleccione una opcion</option>
  <option value="caida_peaton_vehiculo">Caída de peatón de vehículo</option>
  <option value="contra_inmueble_privado">Contra inmueble Privado</option>
  <option value="contra_inmueble_publico">Contra inmueble Público</option>
  <option value="vehiculo_incendiado">Vehículo incendiado</option>
  <option value="desprendimiento_carga">Desprendimiento de carga</option>
  <option value="salida_via">Salida de la vía</option>
  <option value="empotrado">Empotrado</option>
  <option value="volcado">Volcado</option>
  <option value="entre_vehiculo_peaton">Entre vehículo y peatón</option>
  <option value="contra_vehiculo_estacionado">Contra vehículo estacionado</option>
  <option value="triple_colision">Triple colisión</option>
  <option value="entre_dos_vehiculos">Entre dos vehículos</option>
  <option value="de_frente">De frente</option>
  <option value="en_cadena">En cadena</option>
  <option value="lateral">Lateral</option>
  <option value="atrapado_desprendimiento">Atrapado por desprendimiento</option>
  <option value="cruzando_linea_ferrea">Cruzando línea férrea</option>
  <option value="caida_barranco">Caída a barranco</option>
  <option value="estallido_cisterna">Estallido cisterna</option>
  <option value="por_alcance">Por alcance</option>
  <option value="salto">Salto</option>
</select>


<br>
</div>

<button type="button" onclick="agregarVehiculo()">Agregar Vehículo</button>
<br>
<div id="myForm">
    <!-- El formulario del primer vehículo (deja este bloque vacío, se llenará con JavaScript) -->
</div>

<script>
    var numVehiculo = 1; // Inicializar el número de vehículo

    function agregarVehiculo() {
        var formulario = document.getElementById('vehiculos').cloneNode(true);
        formulario.style.display = 'block'; // Para mostrar el formulario clonado

        // Incrementar el número de vehículo
        numVehiculo++;

        // Crear un nuevo botón con el número de vehículo actualizado
        var nuevoBoton = document.createElement('button');
        nuevoBoton.type = 'button';
        nuevoBoton.textContent = 'Agregar Vehículo No. ' + numVehiculo;
        nuevoBoton.onclick = agregarVehiculo; // Asignar la misma función al nuevo botón

        // Crear un botón de eliminación para el formulario actual
        var botonEliminar = document.createElement('button');
        botonEliminar.type = 'button';
        botonEliminar.textContent = 'Eliminar Vehículo';
        botonEliminar.onclick = function() {
            formulario.parentNode.removeChild(formulario); // Eliminar el formulario actual
            nuevoBoton.parentNode.removeChild(nuevoBoton); // Eliminar el botón de agregar correspondiente
            botonEliminar.remove(); // Eliminar el botón de eliminación actual
            numVehiculo--; // Decrementar el número de vehículo
        };

        // Agregar el formulario, el botón de eliminación y el nuevo botón al contenedor principal
        document.getElementById('myForm').appendChild(formulario);
        document.getElementById('myForm').appendChild(botonEliminar);
        document.getElementById('myForm').appendChild(document.createElement('br')); // Agregar un salto de línea
        document.getElementById('myForm').appendChild(nuevoBoton);
    }
</script>

<h5>Datos Finales Del Incidente</h5>

<label for="vehiculos_consignados">Vehículos Consignados:</label>
<input type="number" id="vehiculos_consignados" name="vehiculos_consignados" min="0" class="form-control"><br>

<label for="acuerdo_propio">Acuerdo por iniciativa propia:</label>
<select id="acuerdo_propio" name="acuerdo_propio" class="form-control">
<option selected disabled>Seleccione una opcion</option>
  <option value="si">Si</option>
  <option value="no">No</option>
</select>
<br>

<label for="acuerdo_asegurado">Se pusieron de acuerdo por medio de asegurado:</label>
<select id="acuerdo_asegurado" name="acuerdo_asegurado" class="form-control">
<option selected disabled>Seleccione una opcion</option>
  <option value="si">Si</option>
  <option value="no">No</option>
</select>
<br>

<label for="nombre_aseguradora">Nombre de Aseguradora:</label>
<input type="text" id="nombre_aseguradora" name="nombre_aseguradora" class="form-control"><br> 

<label for="responsabilidad_danos">Cada uno asume responsabilidad de sus daños:</label>
<input type="text" id="responsabilidad_danos" name="responsabilidad_danos" class="form-control"><br>

<label for="vehiculo_responsable_municipal">Vehículo Responsable de daños a la propiedad municipal:</label>
<input type="text" id="vehiculo_responsable_municipal" name="vehiculo_responsable_municipal" class="form-control"><br>

<label for="intervencion_juridico_pmt">Intervención de Jurídico de la PMT:</label>
<select id="intervencion_juridico_pmt" name="intervencion_juridico_pmt" class="form-control">
<option selected disabled>Seleccione una opcion</option>
  <option value="si">Si</option>
  <option value="no">No</option>
</select>
<br>

<label for="consigno_documentos">Consignó Documentos:</label><br>
<textarea id="consigno_documentos" name="consigno_documentos" rows="4" cols="50" class="form-control"></textarea>

<label for="unidad_alcoholemia">Unidad de Alcoholemia No:</label>
<input type="text" id="unidad_alcoholemia" name="unidad_alcoholemia" class="form-control"><br>

<label for="grua_municipal">Grúa Municipal No:</label>
<input type="text" id="grua_municipal" name="grua_municipal" class="form-control"><br>

<label for="unidad_bomberos">Unidad de Bomberos No:</label>
<input type="text" id="unidad_bomberos" name="unidad_bomberos" class="form-control"><br>

<label for="vehiculo_aseguradora">Vehículo aseguradora No:</label>
<input type="text" id="vehiculo_aseguradora" name="vehiculo_aseguradora" class="form-control"><br>

<label for="unidad_mp_placas">Unidad del MP placas:</label>
<input type="text" id="unidad_mp_placas" name="unidad_mp_placas" class="form-control"><br>

<label for="grua_particular_placas">Grúa particular placas:</label>
<input type="text" id="grua_particular_placas" name="grua_particular_placas" class="form-control"><br>

<label for="unidad_pnc_placas">Unidad de PNC placas:</label>
<input type="text" id="unidad_pnc_placas" name="unidad_pnc_placas" class="form-control"><br>

<label for="peritaje_no">Peritajes No:</label><br>
<textarea id="peritaje_no" name="peritaje_no" rows="4" cols="50" class="form-control"></textarea><br>

<label for="peritaje_acomp_heridos">Acompañantes heridos:</label><br>
<textarea id="peritaje_acomp_heridos" name="peritaje_acomp_heridos" rows="4" cols="50" class="form-control"></textarea><br>

<label for="peritaje_acomp_fallecidos">Acompañantes fallecidos:</label><br>
<textarea id="peritaje_acomp_fallecidos" name="peritaje_acomp_fallecidos" rows="4" cols="50" class="form-control"></textarea><br>

<label for="peritaje_consigno_conductores_pnc">Consignó conductores PNC:</label><br>
<textarea id="peritaje_consigno_conductores_pnc" name="peritaje_consigno_conductores_pnc" rows="4" cols="50" class="form-control"></textarea><br>

<label for="peritaje_consigno_vehiculos_pnc">Consignó vehículos PNC:</label><br>
<textarea id="peritaje_consigno_vehiculos_pnc" name="peritaje_consigno_vehiculos_pnc" rows="4" cols="50" class="form-control"></textarea><br>

<label for="nombre_of_pnc">Nombre Of. PNC:</label>
<input type="text" id="nombre_of_pnc" name="nombre_of_pnc" class="form-control">

<script src="https://cdn.jsdelivr.net/npm/signature_pad"></script>
<!-- Canvas para la firma -->
<canvas id="signatureCanvas" width="400" height="200"></canvas>

<!-- Botón para borrar la firma -->
<button onclick="clearSignature()">Borrar Firma</button>
<!-- Script para la funcionalidad de borrar la firma -->
<script>
    // Obtener el canvas y el SignaturePad
    var canvas = document.getElementById('signatureCanvas');
    var signaturePad = new SignaturePad(canvas, {
        backgroundColor: 'rgb(255, 255, 255)' // Fondo blanco
    });

    // Función para borrar la firma
    function clearSignature() {
        signaturePad.clear(); // Borrar la firma
    }
</script>



</div>
</div>


<!------------------------------------------ Campo Agresiones -------------------------------------------->
<div id="agresiones" style="display: none;">

    <h5>AGRESIONES Y/O DAÑOS OCASIONADOS A EQUIPO</h5>
 
 <label for="estacion_unidad">Estación y/o Unidad:</label>
    <input type="text" id="estacion_unidad" name="estacion_unidad" class="form-control">
    <br>

    <h5>DATOS DEL AGENTE Y DE LA AGRESION</h5>
    
    <label for="nombre_chapa">Nombre Chapa:</label>
    <input type="text" id="nombre_chapa" name="nombre_chapa"class="form-control">
    <br>

    <label for="lugar">Lugar:</label>
    <input type="text" id="lugar" name="lugar" class="form-control">
    <br>

    <label for="fecha_hora">Fecha Hora:</label>
    <input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control">
    <br>

    <label for="tipos_agresion">Tipos de Agresión:</label>
    <select id="tipos_agresion" name="tipos_agresion" class="form-control">
    <option selected disabled>Seleccione el tipo de agresion</option>
      <option value="1">Atropellado</option>
      <option value="2">Herido de Bala</option>
      <option value="3">Herido con arma blanca</option>
      <option value="4">Golpeado</option>
      <option value="5">Linchado</option>
      <option value="6">Apedreado</option>
      <option value="7">Otros, especifique</option>
    </select>
    <br>

    <label for="otro_tipo_agresion">Especifique otro tipo de agresión:</label>
    <input type="text" id="otro_tipo_agresion" name="otro_tipo_agresion" class="form-control">
    <br>

    <h5>DAÑOS OCASIONADOS AL VEHICULO Y/O EQUIPO PMT</h5>

    <label for="tipo_vehiculo">Tipo de Vehículo:</label>
    <select id="tipo_vehiculo" name="tipo_vehiculo" class="form-control">
    <option selected disabled>Seleccione el tipo de vehiculo</option>
      <option value="A">Autopatrullas</option>
      <option value="B">Grúa</option>
      <option value="C">Pick Up</option>
      <option value="D">Panel</option>
      <option value="E">Motocicleta</option>
      <option value="F">Bicicleta</option>
      <option value="G">Motogrúa</option>
      <option value="Otro">Otro</option>
    </select>
    <br>

    <label for="numero_placa">No. Placa:</label>
    <input type="text" id="numero_placa" name="numero_placa" class="form-control">
    <br>

    <label for="tipos_danos">Tipos de Daños Ocasionados:</label>
    <select id="tipos_danos" name="tipos_danos" class="form-control">
    <option selected disabled>Seleccione el tipo de daño ocasionado</option>
      <option value="1a">Abolladura con piedra, palos o machete</option>
      <option value="2a">Rotura de vidrios o espejos</option>
      <option value="3a">Orificios de bala</option>
      <option value="4a">Destrucción de radio portátil</option>
      <option value="5a">Robo de radio portátil</option>
      <option value="6a">Robo o destrucción de conos</option>
      <option value="7a">Intento de incendio de la unidad</option>
      <option value="8a">Conos y bardas destruidas</option>
      <option value="9a">Uniforme / equipo reglamentario</option>
      <option value="10a">Otros (Especificar)</option>
    </select>
    <br>

    <!-- Campo de texto para especificar otros daños -->
    <label for="otros_danos">Especifique otros daños:</label>
    <input type="text" id="otros_danos" name="otros_danos" class="form-control">
    <br>

    <h5>DATOS DEL AGRESOR Y/O VEHICULO QUE CONDUCE</h5>

    <!-- Campo de entrada para Nombre -->
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" class="form-control">
    <br>

    <!-- Campo de entrada para Marca -->
    <label for="marca">Marca:</label>
    <input type="text" id="marca" name="marca" class="form-control">
    <br>

    <!-- Campo de entrada para Color -->
    <label for="color">Color:</label>
    <input type="text" id="color" name="color" class="form-control">
    <br>

    <!-- Campo de entrada para No. Licencia -->
    <label for="no_licencia">No. Licencia:</label>
    <input type="text" id="no_licencia" name="no_licencia" class="form-control">
    <br>

    <!-- Campo de entrada para No. Placa -->
    <label for="no_placa">No. Placa:</label>
    <input type="text" id="no_placa" name="no_placa" class="form-control">
    <br>

    <!-- Campo de entrada para Tarjeta Circulación -->
    <label for="tarjeta_circulacion">Tarjeta Circulación:</label>
    <input type="text" id="tarjeta_circulacion" name="tarjeta_circulacion" class="form-control">
    <br>

    <!-- Menú desplegable para Se le colocó una multa -->
    <label for="multa">Se le colocó una multa:</label>
    <select id="multa" name="multa" class="form-control">
    <option selected disabled>Seleccione una opcion</option>
      <option value="si">Sí</option>
      <option value="no">No</option>
    </select>
    <br>

    <!-- Campo de entrada para Monto Multa -->
    <label for="monto_multa">Monto Multa:</label>
    <input type="text" id="monto_multa" name="monto_multa" class="form-control">
    <br>

    <!-- Campo de entrada para No. Boleta -->
    <label for="no_boleta">No. Boleta:</label>
    <input type="text" id="no_boleta" name="no_boleta" class="form-control">
    <br>
    
    <h5>DATOS DE LA DENUNCIA AL MINISTERIO PUBLICO</h5>

    <label for="elaboro_denuncia">Elaboro Denuncia:</label><br>
    <select id="elaboro_denuncia" name="elaboro_denuncia" class="form-control">
    <option selected disabled>Seleccione una opcion</option>
      <option value="si">Sí</option>
      <option value="no">No</option>
    </select>
    <br>

    <!-- Campo de entrada para No. De Expediente -->
    <label for="no_expediente">No. De Expediente:</label>
    <input type="text" id="no_expediente" name="no_expediente" class="form-control">
    <br>

    <!-- Campo de entrada para Indicar Motivo -->
    <label for="indicar_motivo">Indicar Motivo:</label>
    <input type="text" id="indicar_motivo" name="indicar_motivo" class="form-control">
    <br>

    <!-- Campo de entrada para Fecha y Hora de recibido -->
    <label for="fecha_hora_recibido">Fecha y Hora de recibido:</label>
    <input type="datetime-local" id="fecha_hora_recibido" name="fecha_hora_recibido" class="form-control">
    <br>

    <!-- Campo de entrada para Observaciones -->
    <label for="observaciones">Observaciones, indicar si consignó documentos u otros:</label>
    <textarea id="observaciones" name="observaciones" class="form-control"></textarea>
    <br>

    <!-- Campo de entrada para Nombre y Firma del Agente -->
    <label for="nombre_firma_agente">Nombre y Firma del Agente:</label>
    <input type="text" id="nombre_firma_agente" name="nombre_firma_agente" class="form-control">
    <br>

    <!-- Campo de entrada para Firma y sello del Jefe de Sector -->
    <label for="firma_jefe_sector">Firma y sello del Jefe de Sector:</label>
    <input type="text" id="firma_jefe_sector" name="firma_jefe_sector" class="form-control">
    <br>



</div>

<!---------------------------------------------------- Campo Notificacion ---------------------------------------------->
<div id="notificacion" style="display: none;">

<label for="ubicacion_obstaculos">Ubicación de los obstáculos:</label>
<input type="text" id="ubicacion_obstaculos" name="ubicacion_obstaculos" class="form-control">

<label for="fecha_hora_notificacion">Fecha y Hora de Notificación:</label>
<input type="datetime-local" id="fecha_hora_notificacion" name="fecha_hora_notificacion" class="form-control">

<label for="nombre_persona_comercio">Nombre de la Persona o Comercio en mención:</label>
<input type="text" id="nombre_persona_comercio" name="nombre_persona_comercio" class="form-control">

<h5>Tipo de Obstáculos:</h5>
<input type="checkbox" id="tipo_obstaculos_1" name="tipo_obstaculos[]" value="1" class="form-control">
<label for="tipo_obstaculos_1">Materiales Construcción</label><br>

<input type="checkbox" id="tipo_obstaculos_2" name="tipo_obstaculos[]" value="2" class="form-control">
<label for="tipo_obstaculos_2">Chatarra</label><br>

<input type="checkbox" id="tipo_obstaculos_3" name="tipo_obstaculos[]" value="3" class="form-control">
<label for="tipo_obstaculos_3">Llantas</label><br>

<input type="checkbox" id="tipo_obstaculos_4" name="tipo_obstaculos[]" value="4" class="form-control">
<label for="tipo_obstaculos_4">Rótulos</label><br>

<input type="checkbox" id="tipo_obstaculos_5" name="tipo_obstaculos[]" value="5" class="form-control">
<label for="tipo_obstaculos_5">Flores</label><br>

<input type="checkbox" id="tipo_obstaculos_6" name="tipo_obstaculos[]" value="6" class="form-control">
<label for="tipo_obstaculos_6">Ventas Comida</label><br>

<input type="checkbox" id="tipo_obstaculos_7" name="tipo_obstaculos[]" value="7" class="form-control">
<label for="tipo_obstaculos_7">Frutas / Verduras</label><br>

<input type="checkbox" id="tipo_obstaculos_8" name="tipo_obstaculos[]" value="8" class="form-control">
<label for="tipo_obstaculos_8">Talleres en Vía Pública</label><br>

<input type="checkbox" id="tipo_obstaculos_9" name="tipo_obstaculos[]" value="9" class="form-control">
<label for="tipo_obstaculos_9">Muebles</label><br>

<input type="checkbox" id="tipo_obstaculos_10" name="tipo_obstaculos[]" value="10" class="form-control">
<label for="tipo_obstaculos_10">Toneles</label><br>

<input type="checkbox" id="tipo_obstaculos_11" name="tipo_obstaculos[]" value="11" class="form-control">
<label for="tipo_obstaculos_11">Cajas</label><br>

<input type="checkbox" id="tipo_obstaculos_12" name="tipo_obstaculos[]" value="12" class="form-control">
<label for="tipo_obstaculos_12">Vallas</label><br>

<input type="checkbox" id="tipo_obstaculos_13" name="tipo_obstaculos[]" value="13" class="form-control">
<label for="tipo_obstaculos_13">Ropa</label><br>

<input type="checkbox" id="tipo_obstaculos_14" name="tipo_obstaculos[]" value="14" class="form-control">
<label for="tipo_obstaculos_14">Estructuras metálicas</label><br>

<input type="checkbox" id="tipo_obstaculos_15" name="tipo_obstaculos[]" value="15" class="form-control">
<label for="tipo_obstaculos_15">Carretas</label><br>

<input type="checkbox" id="tipo_obstaculos_16" name="tipo_obstaculos[]" value="16" class="form-control">
<label for="tipo_obstaculos_16">Otros (especificar)</label>

<input type="text" id="especificar_obstaculos" name="especificar_obstaculos" class="form-control"><br>

<label for="placa">Placa:</label>
<input type="text" id="placa" name="placa" class="form-control">

<label for="marca">Marca:</label>
<input type="text" id="marca" name="marca" class="form-control">

<label for="tipo_vehiculo">Tipo de Vehículo:</label>
<input type="text" id="tipo_vehiculo" name="tipo_vehiculo" class="form-control">

<label for="color">Color:</label>
<input type="text" id="color" name="color" class="form-control">

<label for="nombre_agente">Nombre del Agente:</label>
<input type="text" id="nombre_agente" name="nombre_agente" class="form-control">

<label for="chapa_agente">Chapa del Agente:</label>
<input type="text" id="chapa_agente" name="chapa_agente" class="form-control">


</div>


<!---------------------------------------------------------- Campo Alcoholemia ------------------------------------------>
<div id="alcoholemia" style="display: none;">

<h5>DEL LUGAR DEL OPERATIVO</h5>

<label for="fecha_hora">Fecha y Hora:</label>
<input type="datetime-local" id="fecha_hora" name="fecha_hora" class="form-control">

<label for="lugar_prueba">Lugar donde se realiza la prueba:</label>
<input type="text" id="lugar_prueba" name="lugar_prueba" class="form-control">

<h5>DEL CONDUCTOR Y/O PERSONA EVALUADA</h5>

<label for="nombre_conductor">Nombre del Conductor:</label>
<input type="text" id="nombre_conductor" name="nombre_conductor" class="form-control"> 

<label for="domicilio_conductor">Domicilio del Conductor:</label>
<input type="text" id="domicilio_conductor" name="domicilio_conductor" class="form-control">


  <label for="licencia">Tipo de Licencia:</label>
  <select id="licencia" name="licencia" class="form-control">
    <option selected disabled>Seleccione el tipo de licencia</option>
    <option value="A">A</option>
    <option value="B">B</option>
    <option value="C">C</option>
    <option value="EXT">EXT</option>
    <option value="JUV">JUV</option>
    <option value="M">M</option>
  </select>

  <label for="no_licencia">No. Licencia:</label>
  <input type="text" id="no_licencia" name="no_licencia" class="form-control">

  <h6>No.Cedula</h6>

<label for="no_orden">No. Orden:</label>
<input type="text" id="no_orden" name="no_orden" class="form-control">

<label for="no_registro">No. Registro:</label>
<input type="text" id="no_registro" name="no_registro" class="form-control">
 
  <h6>No.Telefonico</h6>

<label for="telefono_domiciliar">Teléfono Domiciliar:</label>
<input type="text" id="telefono_domiciliar" name="telefono_domiciliar" class="form-control">

<label for="telefono_personal">Teléfono Personal:</label>
<input type="text" id="telefono_personal" name="telefono_personal" class="form-control">

<h5>DEL VEHICULO</h5>  

<label for="tipo_vehiculo">Tipo de Vehículo:</label>
<select id="tipo_vehiculo" name="tipo_vehiculo" class="form-control">
  <option selected disabled>Seleccione el tipo de vehiculo</option>
  <option value="automovil">Automóvil</option>
  <option value="Pick Up">Pick Up</option>
  <option value="Camioneta">Camioneta</option>
  <option value="Camionetilla">Camionetilla</option>
  <option value="Taxi">Taxi</option>
  <option value="Jeep">Jeep</option>
  <option value="Bus Ext.">Bus Ext.</option>
  <option value="Bus U.">Bus U.</option>
  <option value="Motocicleta">Motocicleta</option>
  <option value="Panel">Panel</option>
</select>

<label for="tarjeta_circulacion">Tarjeta de Circulación:</label>
<input type="text" id="tarjeta_circulacion" name="tarjeta_circulacion" class="form-control">

<label for="marca">Marca:</label>
<input type="text" id="marca" name="marca" class="form-control">

<label for="color">Color:</label>
<input type="text" id="color" name="color" class="form-control">


  <label for="tipo_placa">Tipo de Placas:</label>
  <select id="tipo_placa" name="tipo_placa" class="form-control">
    <option selected disabled>Seleccione el tipo de placas</option>
    <option value="A">A</option>
    <option value="C">C</option>
    <option value="CD">CD</option>
    <option value="M">M</option>
    <option value="O">O</option>
    <option value="P">P</option>
    <option value="U">U</option>
  </select>

  <label for="no_placas">No. Placas:</label>
  <input type="text" id="no_placas" name="no_placas" class="form-control">

<h5>DE LA PRUEBA</h5>


  <label for="prueba_fisica">Se realizó prueba física:</label>
  <select id="prueba_fisica" name="prueba_fisica" class="form-control">
    <option selected disabled>Seleccione SI o NO</option>
    <option value="Si">Si</option>
    <option value="No">No</option>
  </select>

<label for="resultado">Resultado:</label>
<select id="resultado" name="resultado" class="form-control">
  <option selected disabled>Seleccione Positivo o Negativo</option>
  <option value="Positivo">Positivo</option>
  <option value="Negativo">Negativo</option>
</select>

<label for="documentado">Documentado:</label>
<select id="documentado" name="documentado" class="form-control">
  <option selected disabled>Seleccione SI o NO</option>
  <option value="Si">Si</option>
  <option value="No">No</option>
</select>

<label for="prueba_tecnica">Prueba Tecnica:</label>
<select id="prueba_tecnica" name="prueba_tecnica" class="form-control">
  <option selected disabled>Seleccione SI o NO</option>
  <option value="Si">Si</option>
  <option value="No">No</option>
</select>

<label for="resultado_tecnico">Resultado Tecnico:</label>
<select id="resultado_tecnico" name="resultado_tecnico" class="form-control">
  <option selected disabled>Seleccione Positivo o Negativo</option>
  <option value="Positivo">Positivo</option>
  <option value="Negativo">Negativo</option>
</select>

<label for="grados">Grados:</label>
<input type="text" id="grados" name="grados" class="form-control">

<label for="infraccionado">Fue Infraccionado:</label>
<select id="infraccionado" name="infraccionado" class="form-control">
  <option selected disabled>Seleccione SI o NO</option>
  <option value="Si">Si</option>
  <option value="No">No</option>
</select>

<br>

<label for="articulo">Articulo:</label>
<input type="text" id="articulo" name="articulo" class="form-control">


<label for="no_boleta">No.Boleta:</label>
<input type="text" id="no_boleta" name="no_boleta" class="form-control">


<label for="retiro_propio_operativo">Se retiro del operativo por sus propios medios:</label>
<select id="retiro_propio_operativo" name="retiro_propio_operativo" class="form-control">
  <option selected disabled>Seleccione SI o NO</option>
  <option value="Si">Si</option>
  <option value="No">No</option>
</select>

<label for="indicar">Indicar:</label>
<input type="text" id="indicar" name="indicar" class="form-control">

<label for="observaciones">Observaciones:</label>
<input type="text" id="observaciones" name="observaciones" class="form-control">

<label for="nombre_agente">Nombre del Agente:</label>
<input type="text" id="nombre_agente" name="nombre_agente" class="form-control">

<label for="firma_agente">Firma del Agente:</label>
<input type="text" id="firma_agente" name="firma_agente" class="form-control">

<label for="nombre_jefe">Nombre del Jefe de Sector:</label>
<input type="text" id="nombre_jefe" name="nombre_jefe" class="form-control">

<label for="firma_jefe">Firma del Jefe de Sector:</label>
<input type="text" id="firma_jefe" name="firma_jefe" class="form-control">

</div>
<!------------------------------------------- Terminan Campos--------------------------------------------------------->

<button type="submit" class="btn btn-info btn-fill pull-right">Subir Infraccion</button>


<script>
document.addEventListener('DOMContentLoaded', (event) => {
  document.getElementById('offence').addEventListener('change', function() {
    var consignaciones = document.getElementById('consignaciones');
    var remociones = document.getElementById('remociones');
    var colisiones = document.getElementById('colisiones');
    var agresiones = document.getElementById('agresiones');
    var notificacion = document.getElementById('notificacion');
    var alcoholemia = document.getElementById('alcoholemia');
    // Oculta todos los campos adicionales
    consignaciones.style.display = 'none';
    remociones.style.display = 'none';
    colisiones.style.display = 'none';
    agresiones.style.display = 'none';
    notificacion.style.display = 'none';
    alcoholemia.style.display = 'none';
    // Muestra los campos adicionales para la opción seleccionada
    switch (this.options[this.selectedIndex].value) {

      case 'consignaciones':
        consignaciones.style.display = 'block';
        break;
      case 'remociones':
        remociones.style.display = 'block';  
        break;
      case 'colisiones':
        colisiones.style.display = 'block';
        break;
      case 'agresiones':
        agresiones.style.display = 'block';
        break;
      case 'notificacion':
        notificacion.style.display = 'block';
        break;
      case 'alcoholemia':
        alcoholemia.style.display = 'block';
        break;
      // Más casos según sea necesario
    }
  });
});
</script>
</select>
</select>                                                 
												</div>
                                        </div>
                                    </div>
                                   
                                </form>
                            </div>
                        </div>
                    </div>
                     
                    </div>

                </div>
            </div>
        </div>


        <?php include"footer.php"; ?>