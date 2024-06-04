<?php include"sidebar.php"; ?>
   <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Agregar Usuario Nuevo</h4>
                            </div>
							<?php if(get("success")):?>
                                            <div>
                                               <?=App::message("success", "New User added Successfully!")?>
                                            </div>
                                            <?php endif;?>
                            <div class="content">
                                <form action="saveuser.php" method="post">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>ID Usuario</label>
                                                <input type="text" name="user_id" class="form-control" placeholder="ID Usuario" value="<?php 
$prefix= md5(time()*rand(1, 2)); echo strip_tags(substr($prefix ,0,10));?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Usuario</label>
                                                <input type="text" name="username"  class="form-control" placeholder="Usuario">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Contraseña</label>
                                                <input type="password" name="pass"  class="form-control" placeholder="Contraseña">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nombre Completo</label>
                                                <input type="text" name="name"  class="form-control" placeholder="Nombre Completo">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Chapa Agente</label>
                                                <input type="text" name="chapa_agente"  class="form-control" placeholder="Chapa Agente" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                    
                                       
										  <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tipo De Usuario</label>
                                                 <select class="form-control" name="position" >
  <option value="admin">Administrador</option>
  <option value="officer">Agente</option>
    <option value="digitalizador">Digitalizador</option>
</select> 
                                            </div>
                                        </div>
                                       
                                    </div>
         <button type="submit" class="btn btn-info btn-fill pull-right">Crear Usuario</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                       

                </div>
            </div>
        </div>


        <?php include"footer.php"; ?>