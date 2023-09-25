<?php
// Initialize the session
// session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: Dashboard.php");
    exit;
}



 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$user = $password = "";
$user = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    // Check if username is empty
    if(empty(trim($_POST["user"]))){
        $user_err = "Please enter your username.";
    } else{
        $user = trim($_POST["user"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["pass"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["pass"]);
        $salt = "test" . $password . "code";
        $hashed = md5($salt);
       
    }
   
    // Validate credentials
    if(empty($user_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT `ID`, `USER`, `PASS`, `NAME` FROM tblcmc WHERE USER = ?";
        
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_user);
            
            // Set parameters
            $param_user = $user;
          
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id, $user, $hashed_password, $Name);
                    
                    if($stmt->fetch()){
                        if($hashed == $hashed_password){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["ID"] = $id;
                            $_SESSION["USER"] = $user;  
                            $_SESSION["NAME"] = $Name; 
                            
                            header("location: Dashboard.php ");

                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid Username or Password1. ";
                        }
                    }
                } else{
                    // User doesn't exist, display a generic error message
                    $login_err = "Invalid Username or Password2.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>


<!-- Start of html -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="design/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="design/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="design/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" type="image/png" href="design/dist/img/perslogo.png" />


</head>
<body class="hold-transition login-page" style="background-image: url('design/dist/img/bg.jpg'); background-repeat: no-repeat; background-size: cover;"> <!--style='background-color:#343a40'-->
<div class="login-box">
  <div class="login-logo" >
  <img src="design/dist/img/perslogo.png" alt="Pers Logo" width="90" height="100">
    
  </div>
  
  <!-- /.login-logo -->
  <div class="card"  >
    <div class="card-body login-card-body" > <!--style='background-color:#20c997' -->

      <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
      ?>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <div class="input-group mb-1">
       
            <input type="text" name="user" class="form-control" <?php echo (!empty($user_err)) ? 'is-invalid' : ''; ?> placeholder='Username'>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        
            <span class="invalid-feedback"><?php echo $user_err; ?></span>
        </div>

        
        <p class="mb-3">
      </p>

        <div class="input-group mb-1">

        <input type="password" name="pass" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder='Password'>
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        
        <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
    
      

        <p class="mb-3">
      </p>
        <div class="row">
        
            <div class="col-12">
            <button type="submit" class="btn btn-dark btn-block">Sign In</button>
          </div>
          
          <!-- /.col -->
          
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="design/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="design/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="design/dist/js/adminlte.min.js"></script>
<script src="https://kit.fontawesome.com/yourcode.js"></script>
</body>
</html>