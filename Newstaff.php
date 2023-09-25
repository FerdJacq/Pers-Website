<?php
   // Include config file
    require_once "config.php";

    // Define variables and initialize with empty values
    $name = $email = $position  = $username = $password = $cpass = "";
    $name_err = $email_err = $position_err = $username_err = $password_err = $cpass_err ="";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

     // Validate Full Name
     $input_name = trim($_POST["name"]);
     if(empty($input_name)){
         $name_err = "Please enter a Full Name.";
     } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
         $name_err = "Please enter a valid Full Name.";
     } else{
         $name = $input_name;
     }

     // Validate Username
     $input_user = trim($_POST["username"]);
     if(empty($input_user)){
         $username_err = "Please enter a Username.";
     } else{
         $username = $input_user;
     }

      // Validate email
      $input_email = trim($_POST["email"]);
      if(empty($input_email)){
          $email_err = "Please enter an email.";
      }else{
          $email = $input_email;
      }
  
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";   
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["cpass"]))){
        $cpass_err = "Please confirm your password.";
    } else{
        $cpass = trim($_POST["cpass"]);
        if(empty($password_err) && ($password != $cpass)){
            $cpass_err = "Password did not match.";
        }
    }
     
      // Validate Position
      if (isset($_POST['position'])) {
        $input_position = trim($_POST["position"]);}
     
      if(empty($input_position)){
          $position_err = "Please enter a Position.";
      } else{
          $position = $input_position;
      }
  
       // Check input errors before inserting in database
       if(empty($username_err) && empty($password_err) && empty($name_err) && empty($email_err) && empty($position_err)){
          // Prepare an insert statement
          $sql = "INSERT INTO tblcmc (`USER`, `NAME`, `email`,`Position`,`PASS`) VALUES (?, ?, ?, ?, ?);";
  
  
          if($stmt=$mysqli->prepare($sql)){
              // Bind variables to the prepared statement as parameters
              $stmt->bind_param( "sssss", $param_user, $param_name, $param_email,  $param_position, $param_pass);
          
              // Set parameters
              $param_user = $username;
              $param_name = $name;
              $param_email = $email;
              $param_position = $position;
              $salt = "test" . $password . "code";
              $hashed = md5($salt);
              $param_pass = $hashed;
              // Creates a password hash
  
          // Attempt to execute the prepared statement
          if($stmt->execute()){
              // Records created successfully. Redirect to landing page
              // header("location: profile.php");
  
              echo "<script>";
              echo " alert('Successfully added a new record');      
                      window.location.href='Profile.php';
                    </script>";
              exit();
  
          } else{
              echo "Oops! Something went wrong. Please try again later.";
          }
      }
       
      // Close statement
      $stmt->close();
  }
  
  // Close connection
  $mysqli->close();
  }



?>
<?php require_once('Header.php')?>
<title>Directory | Add Staff </title>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Account Directory | <small>Add Staff</small></h1>
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
            <!-- general form elements -->
            <div class="card card-outline card-gray">
              
              <!-- /.card-header -->
              <!-- form start -->
              <div class = "row mb-3"></div>
             
              <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                <div class="card-body col-md-5 offset-3">
                  <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>" name="name" placeholder="Enter Full Name">
                    <span class="invalid-feedback"><?php echo $name_err; ?></span>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" name="email" placeholder="Enter Email">
                    <label style="font-size:13px">E.g. example@mail.com</label>
                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                  </div>
                  <div class="form-group">
                  <label>Position</label>
                  <select class="form-control select2 <?php echo (!empty($position_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $position; ?>" name="position" style="width: 100%;">
                    <option <?php if(!$position) echo 'selected="selected"'; ?> value="" hidden>Enter Position</option>
                    <option <?php if($position =='Staff') echo 'selected="selected"'; ?> value="Staff">STAFF</option>
                  </select>
                  <span class="invalid-feedback"><?php echo $position_err; ?></span>
                  </div>
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" name="username" placeholder="Enter Username">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" name="password" placeholder="Password">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                  </div>
                  <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" class="form-control <?php echo (!empty($cpass_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cpass; ?>" name="cpass" placeholder="Retype password">
                    <span class="invalid-feedback"><?php echo $cpass_err; ?></span>
                  </div>


                  <div class="form-group">
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                  <a href="javascript:history.back()" class="btn btn-secondary ml-2">Cancel</a>
                  </div>
                </form>
                </div>
                <!-- /.card-body -->

                
             
              <div class="col-md-3">

</div>
            </div>
            <!-- /.card -->


         
</section>


<?php require_once('Footer.php')?>