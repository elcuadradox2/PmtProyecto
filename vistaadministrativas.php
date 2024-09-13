<?php 
include 'session_timeout.php';
include "sidebar.php"; 
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-18">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Listado Boletas Multas Administrativas</h4>
                        <p class="category">Aqui esta el listado de todas las boletas de multas administrativas</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <label for="filter">Busqueda</label>
                        <input type="text" name="filter" value="" id="myInput" placeholder="Busqueda por Propietario" onkeyup="myFunction()" class="form-control"/>

                        <script>
                            function myFunction() {
                                var input, filter, table, tr, td, i;
                                input = document.getElementById("myInput");
                                filter = input.value.toUpperCase();
                                table = document.getElementById("myTable");
                                tr = table.getElementsByTagName("tr");

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
                                <th>Fecha y Hora</th>
                                <th>No.Taxi</th>
                                <th>Nombre Propietario</th>
                                <th>Nombre Piloto</th>
                                <th>No.DPI</th>
                                <th>No.Placas</th>
                                <th>Nombre Autor Boleta</th>
                                <th>Estado de Pago</th>
                                <th>Fotos</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                            <?php 
                            $result = $db->prepare("SELECT * FROM multas_administrativas ORDER BY id DESC");
                            $result->execute();
                            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['fecha_hora'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_taxi'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['nombre_propietario'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['nombre_piloto'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_dpi'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_placas'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['nombre_agente'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['estado_pago'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><a href="listadoadministrativas.php?idFoto=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>">Ver Fotos</a></td>
                                    <td>
                                        <a href="cambiarestadoadministrativas.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-success btn-sm" onclick="return confirm('¿Está seguro de que desea cambiar a pagado esta boleta?');">
                                            <?php echo htmlspecialchars($row['estado_pago'] === 'No Pagado' ? 'Marcar como Pagado' : 'Marcar como No Pagado', ENT_QUOTES, 'UTF-8'); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="editaadministrativas.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" title="Click para editar la boleta administrativa"><i class="fa fa-edit fa-lg text-warning"></i></a>
                                        <a href="deleteadministrativass.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" title="Click para eliminar la boleta administrativa" onclick="return confirm('¿Está seguro de que desea eliminar esta boleta?');"><i class="fa fa-trash fa-lg text-danger"></i></a>
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
<?php include "footer.php"; ?>