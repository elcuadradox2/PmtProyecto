<?php include"sidebar.php"?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Offence Table</h4>
                                <p class="category">Here is a list of all Offences</p>
                            </div>
                            <div class="content table-responsive table-full-width">
							
							 <label for="filter">Search</label> <input type="text" name="filter" value="" id="myInput" placeholder="Search with offence ID" onkeyup="myFunction()"/>
   
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
    td = tr[i].getElementsByTagName("td")[0];
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
                                        <th>Offence ID</th>
                                    	<th>Offence</th>
                                    	<th>Offender</th>
                                    	<th>Reporter</th>
                                    	<th>Address</th>
										<th>Action</th>
                                    </thead>
                                    <tbody>
									<?php 
	$result = $db->prepare("SELECT * FROM reported_offence ORDER BY id DESC");
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
                                        <tr>
										<td><?php echo $row['offence_id']; ?></td>
                                        	<td><a title="Click to view details" href="offence-detail.php?id=<?php echo $row['id']; ?>"><?php echo $row['offence']; ?></a></td>
                                        	<td><?php echo $row['name']; ?></td>
                                        	<td><?php echo $row['officer_reporting']; ?></td>
											<td><?php echo $row['address']; ?></td>
											<td><td><a rel="facebox" title="Click to edit view details" href="offence-detail.php?id=<?php echo $row['id']; ?>"><i class="fa fa-eye  fa-lg text-success"></i> </a>
			<a href="#" id="<?php echo $row['id']; ?>" class="delbutton" title="Click to Delete the Offense"><i class="fa fa-trash fa-lg text-danger"></i></a>
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
        </div>
		   <footer class="footer">
            <div class="container-fluid">
                
            <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a>PMT SANARATE</a>, Sistema de Infracciones
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

</html>
