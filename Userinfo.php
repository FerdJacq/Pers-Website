<title>User's | Information </title>
<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM tbluser WHERE id = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["Name"];
                $email = $row["Email"];
                $contact = $row["Contact"];
                $address = $row["Address"];
                $gender = $row["Gender"];
                $bday = $row["Birthday"];
                $occupation = $row["Occupation"];
                $guardian = $row["Guardian"];
                $cog = $row["COG"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<?php require_once('Header.php')?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>User's Directory | <small>Information</small></h1>
          </div>
          <div class="col-sm-6">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 
   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->

            <div class="col-md-12">
                <!-- general form elements-->
                    <div class=" callout card-outline card-gray">
                        <!-- card header-->
                        <!-- form start-->
                            <div class="row mb-3">
                            </div>
                                <!-- form start-->
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="card-body col-md-7 offset-3">
                                            <div class="form-group">
                                            <table class="table table-bordered table-striped table-sm">
                                
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th><p  class="lead"><?php echo " " . $row["Name"]; ?></p></th>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <th><p  class="lead"><?php echo " " . $row["Email"]; ?></p></th>
                                    </tr>
                                    <tr>
                                        <th>Contact</th>
                                        <th><p  class="lead"><?php echo " " . $row["Contact"]; ?></p></th>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <th><p  class="lead"><?php echo " " . $row["Address"]; ?></p></th>
                                    </tr>
                                    <tr>
                                        <th>Birthday</th>
                                        <th><p  class="lead"><?php echo " " . $row["Birthday"]; ?></p></th>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <th><p  class="lead"><?php echo " " . $row["Gender"]; ?></p></th>
                                    </tr>
                                    <tr>
                                        <th>Occupation</th>
                                        <th><p  class="lead"><?php echo " " . $row["Occupation"]; ?></p></th>
                                    </tr>
                                    <tr>
                                        <th>User's Guardian</th>
                                        <th><p  class="lead"><?php echo " " . $row["Guardian"]; ?></p></th>
                                    </tr>
                                    <tr>
                                        <th>Guardian's Contact</th>
                                        <th><p  class="lead"><?php echo " " . $row["COG"]; ?></p></th>
                                    </tr>
                                </thead>
                                
                            </table>   
                                            </div>
                                            <p class="text-right"><a href="javascript:history.back()" class="btn btn-primary" style="text-decoration:none; color:white;">Back</a></p>
                                        </div>
                                    </form>
                    </div>
            </div>
        </div>
    </div>
   </section>
<?php require_once('Footer.php')?>