<?php include"sidebar.php"; ?>
   <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
							<?php if(get("success")):?>
                                            <div>
                                               <?=App::message("success", "Your information was updated Successfully!")?>
                                            </div>
                                            <?php endif;?>
                            <div class="content">
							<?php 
							  $user=$_SESSION['SESS_MEMBER_ID'];
	$result = $db->prepare("SELECT id,username,pass,chapa_agente FROM user WHERE id='$user'");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
							 <form action="update-user.php" method="post">
                                    <div class="row">
                                       <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $row['username']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">chapa agente'</label>
                                                <input type="chapa_agente'" name="chapa_agente'" class="form-control" placeholder="chapa agente'" value="<?php echo $row['chapa_agente']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>pass'</label>
                                                <input type="text" name="pass'" class="form-control" placeholder="pass'" value="<?php echo $row['pass']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                   
         <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
	<?php }?>
                            </div>
                        </div>
                    </div>
                       

                </div>
            </div>
        </div>


        <?php include"footer.php"; ?>