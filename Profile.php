<?php require_once('Header.php')?>
<title>Profiles</title>
<script src="design/plugins/jquery/jquery.min.js"></script>
<style>
    .modal-header{
        background-color: #e7e6e1;
    }
    button{
        padding: 0;
        border: none;
        background: none;
        color: #007bff;
    }
</style>

<!--Modal SCRIPT-->
<script> 
	$(document).ready(function(){
		$('<?php echo ".deletebtn";?>').on('click',function(){
			$('#deletemodal').modal('show');
				
				$tr = $(this).closest('tr');
				var data = $tr.children("td").map(function(){
					return $(this).text();
				}).get();

				console.log(data);
		        $('#delete_id').val(data[0]);
				
		});

	});
</script>
<!--Modal SCRIPT END-->

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Profiles | <small>Staff Accounts</small></h1>
          </div>
        </div>
      </div>
<!-- /.container-fluid -->
</section>

<div class="col-lg-12">           
	<div class="card card-outline card-gray">
		<div class="card-body">

<div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-2 mb-3 clearfix">
                        <h4 class="pull-left">All Accounts</h4>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM tblcmc";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th></th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Position</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['ID'] . "</td>";
                                        echo "<td>" . $row['NAME'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['Position'] . "</td>";
                                        echo "<td>";
                                        echo '<a href="User-Account-Update.php?id='. $row['ID'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                        echo'<button type="button" title="Delete Record"" class="deletebtn"><span class="fa fa-trash"></span></button>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            $result->free();
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close connection
                    $mysqli->close();
                    ?>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>

<!-- BUMBAY -->
<div class="modal fade" id="deletemodal" >
   <div class="modal-dialog">
        <div class="modal-content">
                    <div class="modal-header">
                            <a href="Profile.php" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                          
                    </div>
                    <form action="AccDelete.php" method="post">
                                <input type="hidden" name="delete_id" id="delete_id">
                                <div class="modal-body">
                                <h3>Are you sure you want to delete this User Account?</h3>
                                </div>
                                <div class="modal-footer">
                                    <a href="Profile.php" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                    <button type="submit" name="deletedata" class="btn btn-primary" >Delete</button>
                                    
                                </div>
                     </form>
            </div>
    </div>
</div>
<!-- BUMBAY -->

</section>

<?php require_once('Footer.php')?>
