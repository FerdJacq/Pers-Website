<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,'dbpers');

if(isset($_POST['deletedata']))
{
	$id = $_POST['delete_id'];

	$query = "DELETE FROM tbluser WHERE `id`='$id';";
	$query_run = mysqli_query($connection, $query);

	if($query_run)
	{	
		echo "<script>";
		echo " alert('Successfully deleted a record of User');      
				window.location.href='UserAcc.php';
			 </script>";
		// echo '<script> alert("DATA DELETED");</script>';
		// header("location:UserAcc.php");
	}
	else
	{
		echo '<script> alert("DATA DELETED");</script>';
	}

}
?>

