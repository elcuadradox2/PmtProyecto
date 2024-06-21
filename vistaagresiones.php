<?php include "sidebar.php"; ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-18">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Listado Boleta Agresiones</h4>
                                <p class="category">Aqui esta el listado de todas las boletas agresiones</p>
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
    td = tr[i].getElementsByTagName("td")[4];
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
                                    	<th>Nombre O Chapa del agente</th>
                                    	<th>Lugar del hecho</th>
                                    	<th>Fecha y Hora</th>
                                        <th>Nombre</th>
                                    	<th>No. Licencia</th>
                                        <th>No. Placa</th>
                                        <th>Tipo de boleta</th>
                                        <th>Nombre quien ingreso al sistema</th>
                                        <th>Estado de Pago</th>
										<th>Fotos</th>
                                        <th>Acciones</th>
                                    </thead>
                                    <tbody>
									<?php 
	$result = $db->prepare("SELECT * FROM agresiones ORDER BY id DESC");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
                                        <tr>
										<td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['nombre_chapa']; ?></td>
                                        <td><?php echo $row['lugar']; ?></td>
                                        <td><?php echo $row['fecha_hora']; ?></td>
										<td><?php echo $row['nombre']; ?></td>
                                        <td><?php echo $row['no_licencia']; ?></td>
                                        <td><?php echo $row['no_placa']; ?></td>
                                        <td><?php echo $row['tipo_boleta']; ?></td>
                                        <td><?php echo $row['nombre_chapa_agente']; ?></td>
                                        <td><?php echo $row['estado_pago']; ?></td>
										<td> <a href="listadoagresiones.php?idFoto=<?php echo $row['id']; ?>">Ver Fotos</a></td>
                                        <td>
                                        <a href="cambiarestadoagresiones.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-success btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar esta entrada?');">
                                            <?php echo $row['estado_pago'] === 'No Pagado' ? 'Marcar como Pagado' : 'Marcar como No Pagado'; ?>
                                        </a>
                                    </td>
                                        <td><a href="deleteagresiones.php?id=<?php echo $row['id']; ?>" title="Click para eliminar la boleta agresiones"><i class="fa fa-trash fa-lg text-danger"></i></a></td>
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


