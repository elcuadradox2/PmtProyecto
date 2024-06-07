<?php include "sidebar.php"; ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Listado Boleta Remociones</h4>
                                <p class="category">Aqui esta el listado de todas las boletas remociones</p>
                             </div>
                             <div class="content table-responsive table-full-width">	
							 <label for="filter">Busqueda</label> <input type="text" name="filter" value="" id="myInput" placeholder="Busqueda por Ubicacion" onkeyup="myFunction()"/>
   
   <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
                                <table class="table table-hover table-striped" id="myTable">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Ubicacion Remociones</th>
                                    	<th>Fecha y Hora</th>
                                    	<th>Nombre o Comercio</th>
                                    	<th>Descripcion Consignacion</th>
                                        <th>Tipo de boleta</th>
                                        <th>Nombre quien ingreso al sistema</th>
										<th>Fotos</th>
                                    </thead>
                                    <tbody>
									<?php 
	$result = $db->prepare("SELECT * FROM remociones ORDER BY id DESC");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
                                        <tr>
										<td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['ubicacion_remocion']; ?></td>
                                        <td><?php echo $row['fecha_hora_remocion']; ?></td>
                                        <td><?php echo $row['nombre_persona_comercio']; ?></td>
										<td><?php echo $row['descripcion_consignacion']; ?></td>
                                        <td><?php echo $row['tipo_boleta']; ?></td>
                                        <td><?php echo $row['nombre_chapa_agente']; ?></td>
										<td> <a href="listadoremociones.php?idFoto=<?php echo $row['id']; ?>">Ver Fotos</a></td>
                                        <td><a href="deleteremociones.php?id=<?php echo $row['id']; ?>" title="Click para eliminar la boleta remociones"><i class="fa fa-trash fa-lg text-danger"></i></a></td>
                                        </tr>
	<?php } ?>
                                    </tbody>
                                    </table>						
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
<?php include "footer.php"; ?>


