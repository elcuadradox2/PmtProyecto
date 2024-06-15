<?php include "sidebar.php"; ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Listado Boleta Bitacora Actividades</h4>
                        <p class="category">Aquí está el listado de todas las boletas bitacora actividades</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <label for="filter">Búsqueda</label>
                        <input type="text" name="filter" id="myInput" placeholder="Búsqueda por Fecha" onkeyup="myFunction()" class="form-control"/>

                        <script>
                            function myFunction() {
                                var input, filter, table, tr, td, i;
                                input = document.getElementById("myInput");
                                filter = input.value.toUpperCase();
                                table = document.getElementById("myTable");
                                tr = table.getElementsByTagName("tr");

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
                                <th>Fecha y Hora</th>
                                <th>Nombre quien ingresó al sistema</th>
                                <th>Estado de Pago</th>
                                <th>Fotos</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                            <?php 
                            $result = $db->prepare("SELECT * FROM bitacora_actividades ORDER BY id DESC");
                            $result->execute();
                            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['fecha_hora'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['nombre_agente'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><a href="listadoactividades.php?idFoto=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>">Ver Fotos</a></td>
                                    <td>
                                        <a href="cambiarEstadoPago.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-success btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar esta entrada?');">
                                            <?php echo $row['status'] === 'No Pagado' ? 'Marcar como Pagado' : 'Marcar como No Pagado'; ?>
                                        </a>
                                    </td>
                                    <td><a href="deleteactividades.php?id=<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>" title="Click para eliminar la boleta bitacora actividades" onclick="return confirm('¿Está seguro de que desea eliminar esta entrada?');"><i class="fa fa-trash fa-lg text-danger"></i></a></td>
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
