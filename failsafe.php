<?php


require_once "config.php";  
$name = $cont = "";
$name_err = $cont_err = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){

// Validate  Name
$input_name = trim($_POST["name"]);
if(empty($input_name)){
    $name_err = "Please enter Name.";
} elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
    $name_err = "Please enter a valid  Name.";
} else{
    $name = $input_name;
}

$input_cont = trim($_POST["cont"]);
if(empty($input_cont)){
    $cont_err = "Please enter Contact.";
} elseif(!filter_var($input_cont, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[0-9]+$/")))){
    $cont_err = "Please enter a valid  Contact.";
} else{
    $cont = $input_cont;
}
   
    if(isset($_POST['submit1'])){   

        if(empty($name_err) && empty($cont_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO tblcoor (`name`,`contact`,`reason`,`coordinate`) VALUES (?, ?, ?, ?);";
            
            $coor = "14.406750,121.046690";
            $reas = "MEDICAL DEPARTMENT";
     
            if($stmt=$mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param( "ssss", $param_name, $param_cont, $param_reas, $param_coor);
            
                // Set parameters
                $param_name = $name;
                $param_cont = $cont;
                $param_reas = $reas;
                $param_coor = $coor;
                
            // Attempt to execute the prepared statement
            }if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                // header("location: profile.php");
    
                echo "<script>";
                echo "window.location.href='failsafe.php';
                      </script>";
                exit();
    
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
       
         $stmt->close();
    
        }

    }if(isset($_POST['submit2'])){   

        if(empty($name_err) && empty($cont_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO tblcoor (`name`,`contact`,`reason`,`coordinate`) VALUES (?, ?, ?, ?);";
            
            $coor = "14.406750,121.046690";
            $reas = "FIRE DEPARTMENT";
     
            if($stmt=$mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param( "ssss", $param_name, $param_cont, $param_reas, $param_coor);
            
                // Set parameters
                $param_name = $name;
                $param_cont = $cont;
                $param_reas = $reas;
                $param_coor = $coor;
                
            // Attempt to execute the prepared statement
            }if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                // header("location: profile.php");
    
                echo "<script>";
                echo "window.location.href='failsafe.php';
                      </script>";
                exit();
    
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
       
         $stmt->close();
    
        }

    }if(isset($_POST['submit3'])){   

        if(empty($name_err) && empty($cont_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO tblcoor (`name`,`contact`,`reason`,`coordinate`) VALUES (?, ?, ?, ?);";
            
            $coor = "14.406750,121.046690";
            $reas = "POLICE DEPARTMENT";
     
            if($stmt=$mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param( "ssss", $param_name, $param_cont, $param_reas, $param_coor);
            
                // Set parameters
                $param_name = $name;
                $param_cont = $cont;
                $param_reas = $reas;
                $param_coor = $coor;
                
            // Attempt to execute the prepared statement
            }if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                // header("location: profile.php");
    
                echo "<script>";
                echo "window.location.href='failsafe.php';
                      </script>";
                exit();
    
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
       
         $stmt->close();
    
        }

    }
    
// Close connection
$mysqli->close();
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>P E R S</title>

    </head>
    <body>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="name" id="name" placeholder="Enter  Name" >
        <input type="text" name="cont" id="cont" placeholder="Enter Contact">

        <button type="submit"name="submit1"> Medical Department</button>
        <button type="submit" name="submit2">Fire Department</button>
        <button type="submit" name="submit3">Police Department</button>

    </form>
    
    </body>
</html>