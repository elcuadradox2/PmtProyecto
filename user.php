<?php include "sidebar.php"; ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Cambiar Contraseña Usuario</h4>
                    </div>
                    <?php if(get("success")): ?>
                        <div>
                            <?= App::message("exitoso", "Se actualizo su usuario!") ?>
                        </div>
                    <?php endif; ?>
                    <div class="content">
                        <form action="update-user.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Seleccionar Usuario</label>
                                        <select name="user_id" class="form-control">
                                            <?php 
                                            $users = $db->prepare("SELECT id, username FROM user");
                                            $users->execute();
                                            while($user = $users->fetch()): ?>
                                                <option value="<?= $user['id']; ?>"><?= $user['username']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nueva Contraseña</label>
                                        <input type="password" name="new_password" class="form-control" placeholder="Nueva Contraseña">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Cambiar Contraseña</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>