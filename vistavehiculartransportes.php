<?php 
include 'session_timeout.php';
include "sidebar.php"; ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Listado Boleta Peritaje Vehicular Transportes</h4>
                        <p class="category">Aqui esta el listado de todas las boletas peritaje vehicular transportes</p>
                    </div>
                    <div class="content table-responsive table-full-width">	
                        <label for="filter">Busqueda</label> 
                        <input type="text" name="filter" value="" id="myInput" placeholder="Busqueda por licencia" onkeyup="myFunction()"/>
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
                                    td = tr[i].getElementsByTagName("td")[3];
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
                                <th>No. Boleta</th>
                                <th>Fecha Y Hora</th>
                                <th>Placa del vehiculo peritado</th>
                                <th>Nombre quien ingreso al sistema</th>
                                <th>Fotos</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                <?php 
                                $result = $db->prepare("SELECT * FROM peritaje_vehicular_transportes ORDER BY id DESC");
                                $result->execute();
                                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_boleta'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['fecha_hora'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['placa_peritaje_transportes'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['nombre_agente'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><a href="listadovehiculartransportes.php?idFoto=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>">Ver Fotos</a></td>
                                    <td>
                                        <a href="editarperitajevehiculartransportes.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" class="fa fa-edit fa-lg text-warning"></a>
                                        <a href="deletevehiculartransportes.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" title="Click para eliminar la boleta peritaje transportes" onclick="return confirm('¿Está seguro de que desea eliminar esta boleta?');"><i class="fa fa-trash fa-lg text-danger"></i></a>
                                    </td>
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
</body>
<?php include "footer.php"; ?>