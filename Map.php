<?php require_once('Header.php')?>
<title>Map</title>
<style>
  span.small {
  font-size: 20px;
}
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>MAP | <small>User's Location</small></h1>
          </div>
        </div>
      </div>
<!-- /.container-fluid -->
</section>

<!-- Map Script -->
<!-- <script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script> -->

<section class="content" > 
    <div class="container-fluid" >
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div>
                    <div class="inner">
                      <!--List -->
                      <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM tblcoor";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                 
                                        echo "<th>Name</th>";
                                        echo "<th>Location</th>";
                                        echo "<th>Reason</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                       
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['coordinate'] . "</td>";
                                        echo "<td>" . $row['reason'] . "</td>";
                                        echo "<td>";
                                        echo '<a href="http://localhost/pers/Map.php?origin=14.396640,121.045040&destination='. $row['coordinate'] .'" class="mr-3" title="Location" data-toggle="tooltip"><span class="fa fa-map-marker "></span></a>';
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
                <div class="icon">
            </div>
        </div>
    </div>
      <!-- ./col -->
      <div class="col-sm-8 ">
            <!-- small box -->
            <div class="small-box bg-gray">
              <div class="inner">
              
<iframe
  width="100%"
  height="600px"
  style="border:0"
  loading="lazy"
  allowfullscreen
  src="https://map-cb-pers.logiceight.com/?z=16&center=<?php echo $_GET['destination'];?>&loc=<?php echo$_GET['origin'];?>&loc=<?php echo $_GET['destination'];?>&hl=en&alt=0&srv=2">
</iframe>
            
                  </div>
              
        </div>
    </div>

</section>





<?php require_once('Footer.php')?>