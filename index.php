<?php include "sidebar.php" ?>
        <div class="content">
            <!-- Colisiones boleta     -->
            <div class="container-fluid">
            <div class="row">					   
            <div class="col-md-6">
            <div class="card ">
            <div class="header">
                <h4 class="title">Ultimas</h4>
                <p class="category">Boletas Colisiones</p>
            </div>
            <div class="content">
            <div class="table-full-width">
                                    <table class="table">
                                    <tbody>
<?php 
	$result = $db->prepare("SELECT * FROM colisiones ORDER BY id DESC limit 3");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>                                           
										    <tr>
                                            <td><?php echo $row['licencias']; ?></td>
                                            <td class="td-actions text-right">
                                            <span style="padding:2px; background-color:#1DC7EA; color:#FFF;">  <?php echo $row['fecha_hora']; ?> </span>
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
            <!-- Agresiones boleta     -->
            <div class="container-fluid">
            <div class="row">					   
            <div class="col-md-6">
            <div class="card ">
            <div class="header">
                <h4 class="title">Ultimas</h4>
                <p class="category">Boletas Agresiones</p>
            </div>
            <div class="content">
            <div class="table-full-width">
                                    <table class="table">
                                    <tbody>
<?php 
	$result = $db->prepare("SELECT * FROM agresiones ORDER BY id DESC limit 3");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>                                           
										    <tr>
                                            <td><?php echo $row['no_licencias']; ?></td>
                                            <td class="td-actions text-right">
                                            <span style="padding:2px; background-color:#1DC7EA; color:#FFF;">  <?php echo $row['fecha_hora']; ?> </span>
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
                    <div class="container-fluid">
                    <div class="row">					   
                    <div class="col-md-6">
                    <div class="card ">
                    <div class="header">
                    <h4 class="title">Ultimas</h4>
                    <p class="category">Boletas Peritaje Vehicular Transportes</p>
                    </div>
                    <div class="content">
                    <div class="table-full-width">
                    <table class="table">
                    <tbody>
<?php
    $result = $db->prepare("SELECT * FROM peritaje_vehicular_transportes ORDER BY id DESC limit 3");
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
?> 

                                            <tr>
                                            <td><?php echo $row['placa_peritaje_transportes']; ?></td>
                                            <td class="td-actions text-right">
                                            <span style="padding:2px; background-color:#1DC7EA; color:#FFF;">  <?php echo $row['fecha_hora']; ?> </span>
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
        </div>
		
<?php include "footer.php"?>

     