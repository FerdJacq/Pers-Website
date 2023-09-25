<?php require_once('Header.php')?>
<title>User's Account</title>
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

<script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>

<!--Modal SCRIPT-->
<script src="design/plugins/jquery/jquery.min.js"></script>
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
<!--Modal SCRIPT-->

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users Directory | <small>View All Accounts</small></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>

<div class="col-lg-12">           
	<div class="card card-outline card-gray">
		<div class="card-body">

<div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-2 mb-3 clearfix">
                        <h4 class="pull-left">User's Account</h4>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM tbluser";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th></th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>Contact</th>";
                                        echo "<th>Address</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['Name'] . "</td>";
                                        echo "<td>" . $row['Email'] . "</td>";
                                        echo "<td>" . $row['Contact'] . "</td>";
                                        echo "<td>" . $row['Address'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="Userinfo.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
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
                            <a href="UserAcc.php" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                    </div>
                                <div class="modal-body">
                            <form action="Userdelete.php" method="post">
                                <input type="hidden" name="delete_id" id="delete_id">
                                <h3>Are you sure you want to delete this User Record?</h3>
                                </div>
                                <div class="modal-footer">
                                    <a href="UserAcc.php" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
		                            <button type="submit" name="deletedata" class="btn btn-primary" >Delete</button>
                                </div>
                            </form>
            </div>
    </div>
</div>
<!-- BUMBAY -->

<?php require_once('Footer.php')?>