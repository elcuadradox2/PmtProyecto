<?php include "sidebar.php"; ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-18">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Listado Boletas Aviso Pago y Citación</h4>
                        <p class="category">Aqui esta el listado de todas las boletas aviso pago y citación</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <label for="filter">Busqueda</label>
                        <input type="text" name="filter" value="" id="myInput" placeholder="Busqueda por DPI" onkeyup="myFunction()"/>
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
                                <th>No. Boleta</th>
                                <th>Lugar de la infraccion</th>
                                <th>DPI</th>
                                <th>No. Placas</th>
                                <th>Fecha y Hora de le infraccion</th>
                                <th>Nombre Completo</th>
                                <th>Descripcion</th>
                                <th>Tipo de boleta</th>
                                <th>Nombre Autor Boleta</th>
                                <th>Estado de Pago</th>
                                <th>Fotos</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                <?php 
                                $result = $db->prepare("SELECT * FROM aviso_pago ORDER BY id DESC");
                                $result->execute();
                                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_boleta'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['ubicacion_aviso_pago'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['dpi_aviso_pago'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_placas'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['fecha_hora_aviso_pago'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['nombre_completo'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['descripcion_aviso_pago'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['tipo_boleta'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['nombre_chapa_agente'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['estado_pago'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><a href="listadoavisopago.php?idFoto=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>">Ver Fotos</a></td>
                                    <td>
                                        <a href="cambiarestadoavisopago.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-success btn-sm" onclick="return confirm('¿Está seguro de que desea cambiar a pagado esta boleta?');">
                                            <?php echo htmlspecialchars($row['estado_pago'] === 'No Pagado' ? 'Marcar como Pagado' : 'Marcar como No Pagado', ENT_QUOTES, 'UTF-8'); ?>
                                        </a>
                                        <a href="editaavisopago.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" class="fa fa-edit fa-lg text-warning"></a>
                                        <a href="deleteavisopago.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" title="Click para eliminar la boleta agresiones"><i class="fa fa-trash fa-lg text-danger"></i></a>
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