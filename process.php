<?php 
 	include 'init.php';
    include 'includes/overall_head.php';
    global $user_data;
    if(empty($_POST)===false&&isset($_GET['main'])){
    	global $con;
    	$route_no=$_POST['route_no'];
    	$from_date=$_POST['date_from'];
    	$todate=$_POST['date_to'];
    	$date_generators=array();
    	$date_generators=date_generator($from_date,$todate);
    	// print_r($date_generator);
    	$len=count($date_generators);
    	$table='r_'.$route_no;
    	$i=0;
    	$random=rand(1,1000000);
    	$user_data=$random;

    	while($len){

    		$query="INSERT INTO $table(Dates,random)values('$date_generators[$i]','$random') ";
			$res=mysqli_query($con,$query);

			$i++;
			$len--;
    	}
    	if($i){
    		$passing = array(
            'route_no' => $route_no, 
            'from_date' => $from_date,
            'todate' => $todate,
            'random' =>$user_data

    );

       $string = http_build_query($passing);
    		header("Location:process.php?$string");
    	}
    	else
    		echo "something went wrong...";
    }
    if(isset($_GET['route_no'])===true){
               $route_no='r_'.$_GET['route_no'];
               $route_no1=$_GET['route_no'];
               $from_date=$_GET['from_date'];
               $todate=$_GET['todate'];
               $random=$_GET['random'];
      
               $retrieve_data=array();
               $retrieve_data=retrieve_data($from_date,$todate,$route_no,$random);
               $i=0;
               $passing = array(
            'route_no1' => $route_no1, 
            'from_date1' => $from_date,
            'todate1' => $todate,
            'random' =>$random
    );

       $string = http_build_query($passing);
               ?>

         <div class='container'>
         	<form method="post" action="total.php?<?php echo $string ;?>">
         	<?php 
    foreach($retrieve_data as $item) {
    //fetch one by one data from db
		$dates=$item;
		$dates=date("d-m-Y",strtotime($dates)); 

		echo "
		
		<button class='btn border btn-primary' disabled>$dates</button>
		<input class='form-control d-lg-inline' type='number' placeholder='0.00' required name='f_$i' min='0' value='0' step='0.01'  pattern='^\d+(?:\.\d{1,2})?$' onblur='
this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'
'>
		<br>
		 ";  
		$i++;
     }
    
            
 ?>
  <input type="submit"  value="submit" class="btn btn-success"> 



<?php
}
include 'includes/overall_footer.php'; ?>