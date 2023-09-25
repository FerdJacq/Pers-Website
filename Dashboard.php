<?php require_once('Header.php')?>
<title>Dashboard</title>
<style>
  span.small {
  font-size: 20px;
  
  
}
</style>
<?php

// Initialize the session
require_once "config.php";
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<section class="content-header" >
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-lg-6">
            <h1><i class="fas fa-home"></i> Home </h1>
            
          </div>
          
          <div class="col-lg-3 offset-3 mb-10">
          <?php echo '<h4><small><i class="fas fa-calendar-alt"></i>  ' . date("D") . ', ' . date("F d, Y") . '</small></h4>' ;?>
          </div>
        </div>
      </div><!-- /.container-fluid -->
</section>

<section class="content" > 
    <div class="container-fluid" >
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-gray">
                    <div class="inner">
                        <?php
                            require_once "config.php";
                            $sql = "SELECT * FROM tbluser";
                            $result = mysqli_query($mysqli, $sql);
                            $userCount= mysqli_num_rows($result)
                        ?>
                        <h3> <?php echo $userCount; ?></h3>
                 

                         <p>Total Users</p>

                    </div>
                <div class="icon">
                <i class="fas fa-users"></i>
            </div>
              <a href="UserAcc.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
      <!-- ./col -->
      <div class="col-sm-8 ">
            <!-- small box -->
            <div class="small-box bg-gray">
              <div class="inner">

              <div class="slideshow-container">

<div class="mySlides">
  <div class="numbertext"></div>
  <img src="design/dist/img/we.jpg" style="width:100%">
  
</div>

<div class="mySlides ">
  <div class="numbertext"></div>
  <img src="design/dist/img/save.jpg" style="width:100%">
  
</div>

<div class="mySlides ">
  <div class="numbertext"></div>
  <img src="design/dist/img/live.jpg" style="width:100%">
  
</div>

<script> 
  var slideIndex = 0;
  showSlides();

  function showSlides() {
var i;
var slides = document.getElementsByClassName("mySlides");
for (i = 0; i < slides.length; i++) {
  slides[i].style.display = "none";
}
slideIndex++;
if (slideIndex > slides.length) {slideIndex = 1}
slides[slideIndex-1].style.display = "block";
setTimeout(showSlides, 4000); // Change image every 4 seconds
}
</script>
</div>
               
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
</section>
<!-- /.content -->
<?php require_once('Footer.php')?>