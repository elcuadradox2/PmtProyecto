<?php include "sidebar.php"; ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Listado Boleta Colisiones</h4>
                                <p class="category">Aqui esta el listado de todas las boletas colisiones</p>
                            </div>
                            <div class="content table-responsive table-full-width">
							
							 <label for="filter">Busqueda</label> <input type="text" name="filter" value="" id="myInput" placeholder="Busqueda por Licencia" onkeyup="myFunction()"/>
   
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
    td = tr[i].getElementsByTagName("td")[2];
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
                                    	<th>Fecha y Hora</th>
                                    	<th>Licencias</th>
                                    	<th>Tarjetas Circulacion</th>
                                    	<th>Observacion</th>
                                      <th>Nombre Agente</th>
										                  <th>Fotos</th>
                                    </thead>
                                    <tbody>
									<?php 
	$result = $db->prepare("SELECT * FROM colisiones ORDER BY id DESC");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
                                        <tr>
										                    <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['fecha_hora']; ?></td>
                                        <td><?php echo $row['licencias']; ?></td>
                                        <td><?php echo $row['tarjetas_circulacion']; ?></td>
											                  <td><?php echo $row['observaciones']; ?></td>
                                        <td><?php echo $row['nombre_chapa_agente']; ?></td>
											                  <td> <a href="listadocolisiones.php?idFoto=<?php echo $row['id']; ?>">Ver Fotos</a></td>
                                        <td><a href="deletecolisiones.php?id=<?php echo $row['id']; ?>" title="Click para eliminar la boleta colisiones"><i class="fa fa-trash fa-lg text-danger"></i></a></td>
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


