 <?php 
 	include 'init.php';
 	global $con;
    $query="SELECT Route_No from audit";
    $res=mysqli_query($con,$query);
    include 'includes/overall_head.php';
    if(isset($_GET['entry_date'])&&empty($_GET)===false){
    	
    	$entry_date=date("d-m-Y",strtotime($_GET['entry_date']));
    	$query="SELECT * from audit where Entry_Date='$entry_date'";
    	
        $res=mysqli_query($con,$query);
        $from_date=array();
        $to_date=array();
        $total_price=array();
        $currency=array();
        $entry_date=array();
        $route_no=array();
        while($rows=$res->fetch_assoc())
          {
          	$route_no[]=$rows['Route_No'];
          	$from_date[]=date("d-m-Y",strtotime($rows['From_Date']));
          	$to_date[]=date("d-m-Y",strtotime($rows['To_Date']));
          	$total_price[]=$rows['Total_Price'];
          	$currency[]=$rows['Currency'];
          	$entry_date[]=$rows['Entry_Date'];
          }
          // $data=array(
          // 	'from_date'=>$from_date,
          // 	'to_date'=>$to_date,
          // 	'total_price'=>$total_price,
          // 	'currency'=>$currency,
          // 	'entry_date'=>$entry_date
          // );
          ?>
          <div class="table-responsive-sm">
          <table class="table table-dark table-striped table-bordered">
  <thead>
    <tr>
       <th scope="col">Route_No</th>
      <th scope="col">From</th>
      <th scope="col">To</th>
      <th scope="col">Total_Price</th>
      <th scope="col">Currency</th>
      <th scope="col">Entry Date</th>
    </tr>
  </thead>
  <tbody>
    
      
      <?php
      $k=0;
      $length=count($total_price);
          while($length) {
          	# code...

          	echo "<tr>
          	<td class='text-success'>$route_no[$k]</td>
          	<td class='text-success'>$from_date[$k]</td>
          	<td class='text-success'>$to_date[$k]</td>
          	<td class='text-success'>$total_price[$k]</td>
          	<td class='text-success'>$currency[$k]</td>
          	<td class='text-success'>$entry_date[$k]</td>
          	</tr>";
          	$k++;
          	$length--;
          }

           ?>
    
    
  </tbody>
</table>
</div>
          
      <?php     

    }
    else{
 ?>
   <div class="container"> 
<h1 class="text-success">History</h1>
</div>
<div class="container">
<form method="get" action="">
  <div class="form-group">
                <label for="vehicle_no">Entry-Date</label>
                <input type="date" id="entry_date" name="entry_date" class="form-control" required>
                <small class="text-muted">*required</small>

   	</div>
   <input type="submit" class="btn btn-primary form-control" value="show" name="">
   </form>
   </div>
<?php
}
include 'includes/overall_footer.php'; ?>
