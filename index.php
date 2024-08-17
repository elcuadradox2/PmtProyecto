<?php
include('configbd.php');
session_start();

if (!isset($_SESSION['SESS_FIRST_NAME'])) {
    header("location: login.php");
    exit();
}

$position = $_SESSION['SESS_LAST_NAME'];
if ($position == 'agente') {
    header("location: boletasdescarga.php");
    exit();
}
?>
<?php include "sidebar.php" ?>
<div class="content">
    <div class="container-fluid">
        <!-- Colisiones boleta -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
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
                                            <td><?php echo htmlspecialchars($row['licencias'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="td-actions text-right">
                                                <span style="padding:2px; background-color:#1DC7EA; color:#FFF;"><?php echo htmlspecialchars($row['fecha_hora'], ENT_QUOTES, 'UTF-8'); ?></span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Agresiones boleta -->
            <div class="col-md-6">
                <div class="card">
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
                                            <td><?php echo htmlspecialchars($row['no_licencia'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="td-actions text-right">
                                                <span style="padding:2px; background-color:#1DC7EA; color:#FFF;"><?php echo htmlspecialchars($row['fecha_hora'], ENT_QUOTES, 'UTF-8'); ?></span>
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
        <!-- Aviso Pago y Alcoholemia boleta -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Ultimas</h4>
                        <p class="category">Boletas Aviso Pago</p>
                    </div>
                    <div class="content">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    <?php
                                        $result = $db->prepare("SELECT * FROM aviso_pago ORDER BY id DESC limit 3");
                                        $result->execute();
                                        for($i=0; $row = $result->fetch(); $i++){
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['dpi_aviso_pago'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="td-actions text-right">
                                                <span style="padding:2px; background-color:#1DC7EA; color:#FFF;"><?php echo htmlspecialchars($row['fecha_hora_aviso_pago'], ENT_QUOTES, 'UTF-8'); ?></span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Ultimas</h4>
                        <p class="category">Boletas Alcoholemia</p>
                    </div>
                    <div class="content">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    <?php
                                        $result = $db->prepare("SELECT * FROM alcoholemia ORDER BY id DESC limit 3");
                                        $result->execute();
                                        for($i=0; $row = $result->fetch(); $i++){
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['no_placas'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="td-actions text-right">
                                                <span style="padding:2px; background-color:#1DC7EA; color:#FFF;"><?php echo htmlspecialchars($row['fecha_hora'], ENT_QUOTES, 'UTF-8'); ?></span>
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
         <!-- Notificaciones y Remociones boleta -->
         <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Ultimas</h4>
                        <p class="category">Boletas Notificaciones</p>
                    </div>
                    <div class="content">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    <?php
                                        $result = $db->prepare("SELECT * FROM notificaciones ORDER BY id DESC limit 3");
                                        $result->execute();
                                        for($i=0; $row = $result->fetch(); $i++){
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['ubicacion_notificacion'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="td-actions text-right">
                                                <span style="padding:2px; background-color:#1DC7EA; color:#FFF;"><?php echo htmlspecialchars($row['fecha_hora_notificacion'], ENT_QUOTES, 'UTF-8'); ?></span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Ultimas</h4>
                        <p class="category">Boletas Remociones</p>
                    </div>
                    <div class="content">
                        <div class="table-full-width">
                            <table class="table">
                                <tbody>
                                    <?php
                                        $result = $db->prepare("SELECT * FROM remociones ORDER BY id DESC limit 3");
                                        $result->execute();
                                        for($i=0; $row = $result->fetch(); $i++){
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['ubicacion_remocion'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="td-actions text-right">
                                                <span style="padding:2px; background-color:#1DC7EA; color:#FFF;"><?php echo htmlspecialchars($row['fecha_hora_remocion'], ENT_QUOTES, 'UTF-8'); ?></span>
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