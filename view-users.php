<?php include "sidebar.php"; ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Listado de usuarios</h4>
                                <p class="category">Aqui esta el listado de usuarios</p>
                             </div>
                             <div class="content table-responsive table-full-width">	
							 <label for="filter">Busqueda</label> <input type="text" name="filter" value="" id="myInput" placeholder="Busqueda por usuario" onkeyup="myFunction()"/>
   
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
                                    	  <th>User ID</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
										                    <th>Chapa Agente</th>
                                        <th>Puesto</th>
                                        <th>Eliminar</th>
                                    </thead>
                                    <tbody>
                                <?php 
                                    $stmt = $db->prepare("SELECT * FROM user ORDER BY id DESC");
                                    $stmt->execute();
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                                    <td><?php echo htmlspecialchars($row['chapa_agente']); ?></td>    
                                    <td><?php echo htmlspecialchars($row['position']); ?></td>
                                    <td><a href="delete-user.php?id=<?php echo htmlspecialchars($row['id']); ?>" title="Click para eliminar el usuario"><i class="fa fa-trash fa-lg text-danger"></i></a></td>
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


