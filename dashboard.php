 <?php 
 	include 'init.php';
 	global $con;
    $query="SELECT Route_No from audit";
    $res=mysqli_query($con,$query);
    include 'includes/overall_head.php';
    if(isset($_GET['route_no'])&&empty($_GET)===false){
        $route_no=$_GET['route_no'];
    	$table='r_'.$route_no;
    	if($_GET['delete_option']&&$_GET['delete_option']=="history"){
    	$query="TRUNCATE TABLE $table";
    	$res=mysqli_query($con,$query);
    	$query1="DELETE FROM audit WHERE Route_No=$route_no";
    	$res=mysqli_query($con,$query1);
    	if($res===true)
    	echo "<h1 class='display-4 text-success'>history successfully deleted</h1>";
    	else
    	echo "<h1 class='display-4 text-danger'>history not successfully deleted/no history found</h1>";
    	
    	}
    	else{
    	    $query="DROP TABLE $table";
    	    $res=mysqli_query($con,$query);
    	    $query1="DELETE FROM users WHERE Route_No=$route_no";
        	$res1=mysqli_query($con,$query1);
    	   if($res===true)
    	   echo "<h1 class='display-4 text-success'>Route successfully deleted</h1>";
    	   else
    	   echo "<h1 class='display-4 text-danger'>Route not successfully deleted</h1>";
    	}
    	
          ?>
       <script>
         setTimeout(window.location.href = 'dashboard.php', 500);


        </script>
	    	<?php
               exit();
                  ?>
   
           
      <?php     

    }
    else{
 ?>
   <div class="container"> 
<h1 class="text-danger display-4">Control Room</h1>
</div>
<div class="container">
<form method="get" action="">
             <div class="form-group">
                
                <label for="route_no">Route-No</label>
                <select name="route_no" id="route_no" class="form-control" required>
                  <?php
                  $query="SELECT Route_No from users";
                  $res=mysqli_query($con,$query);
                  while($rows=$res->fetch_assoc())
                  {

                    $route_no=$rows['Route_No'];
                    echo "<option value='$route_no'>$route_no</option>";
                  }
                ?>
                </select>

            </div>
   	<div id="delete" class="form-group">
      <label for="delete_option">Delete</label>
    <select id="delete_option" name="delete_option" class="form-control" onchange="" required>
                    <option value="route" >Route</option>
                    <option value="history" selected="selected">History</option>
                </select><br />
    <small class="text-muted">*required</small>
   <input type="submit" class="btn btn-primary form-control" value="clear" name="">
   </form>
   </div>
<?php
}
include 'includes/overall_footer.php'; ?>
