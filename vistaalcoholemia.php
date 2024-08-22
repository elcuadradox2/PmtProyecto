<?php include "sidebar.php"; ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Listado Boleta Alcoholemia</h4>
                        <p class="category">Aqui esta el listado de todas las boletas alcoholemia</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <label for="filter">Busqueda</label>
                        <input type="text" name="filter" value="" id="myInput" placeholder="Busqueda por Licencia" onkeyup="myFunction()"/>
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
                                    td = tr[i].getElementsByTagName("td")[6];
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
                                <th>Lugar de la prueba</th>
                                <th>Nombre Conductor</th>
                                <th>Domicilio Conductor</th>
                                <th>No. Licencia</th>
                                <th>Tarjeta Circulacion</th>
                                <th>No. Placa</th>
                                <th>Tipo de boleta</th>
                                <th>Nombre Autor Boleta</th>
                                <th>Estado de Pago</th>
                                <th>Fotos</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                <?php 
                                $result = $db->prepare("SELECT * FROM alcoholemia ORDER BY id DESC");
                                $result->execute();
                                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_boleta'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['fecha_hora'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['lugar_prueba'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['nombre_conductor'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['domicilio_conductor'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_licencia'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['tarjeta_circulacion'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_placas'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['tipo_boleta'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['nombre_chapa_agente'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['estado_pago'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><a href="listadoalcoholemia.php?idFoto=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>">Ver Fotos</a></td>
                                    <td>
                                        <a href="cambiarestadoalcoholemia.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-success btn-sm" onclick="return confirm('¿Está seguro de que desea cambiar a pagado esta boleta?');">
                                            <?php echo htmlspecialchars($row['estado_pago'] === 'No Pagado' ? 'Marcar como Pagado' : 'Marcar como No Pagado', ENT_QUOTES, 'UTF-8'); ?>
                                        </a>
                                        <a href="editaalcoholemia.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" class="fa fa-edit fa-lg text-warning"></a>
                                        <a href="deletealcoholemia.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" title="Click para eliminar la boleta alcoholemia"><i class="fa fa-trash fa-lg text-danger"></i></a>
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