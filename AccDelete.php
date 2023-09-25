<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,'dbpers');

if(isset($_POST['deletedata']))
{
	$id = $_POST['delete_id'];

	$query = "DELETE FROM tblcmc WHERE `ID`='$id';";
	$query_run = mysqli_query($connection, $query);

	if($query_run)
	{
		echo "<script>";
		echo " alert('Successfully deleted a user account');      
				window.location.href='Profile.php';
			 </script>";
		// echo '<script> alert("DATA DELETED");</script>';
		// header("location:Profiled.php");
	}
	else
	{
		echo '<script> alert("DATA NOT DELETED");</script>';
	}

}
?>