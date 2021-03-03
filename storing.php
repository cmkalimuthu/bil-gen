<?php
    include 'init.php';
    $owner_name=$_POST['owner_name'];
    $route_no=$_POST['route_no'];
    $vehicle_no=$_POST['vehicle_no'];
    $trip_type=$_POST['trip_type'];
    $address=$_POST['address'];
    if($_POST['km']!=='')
    $km=$_POST['km'];
    else
    $km=1;
    $trip_count=$_POST['trip_count'];

 	
	$table='r_'.$route_no;

 	$sql="INSERT INTO users(Owner_Name,Route_No,Vehicle_No,Trip_Type,Address,Km,Trip_Count)values('$owner_name','$route_no','$vehicle_no','$trip_type','$address',$km,'$trip_count')";
 	if($con->query($sql)){
       
       $query="CREATE TABLE `bill_gen`.$table( `S_No` INT NOT NULL AUTO_INCREMENT , `Dates` VARCHAR(30) NOT NULL , `price` VARCHAR(30) NOT NULL DEFAULT '1', `km` VARCHAR(30) NOT NULL DEFAULT '1' , `random` VARCHAR(30) NOT NULL , PRIMARY KEY (`S_No`))";
       $res=mysqli_query($con,$query);


       
    }else{
        echo"Error:".$sql."<br>".$con->error;
 	}
 header('Location:index.php?reg=success');
?>