<?php 
 include 'init.php';
 include 'includes/overall_head.php';

 $total=0;
 $prices=array();

 if(isset($_GET['route_no1'])===true){
    $route_no=$_GET['route_no1'];
    $from_date=$_GET['from_date1'];
    $todate=$_GET['todate1'];
    $random=$_GET['random'];
    $user_details=fetch_user_detail($route_no);
        $trip_type=$user_details['trip_type'];
        $km=$user_details['km'];
        $length=count($prices);
        $trip_count=$user_details['trip_count'];
        $k=0;
        $prices_copy=array();

  foreach( $_POST as $form => $val ) {
     if( is_array( $form ) ) {
         foreach( $form as $thing) {
             echo $thing;
         }
     } 
     else {
        if($trip_type==='km')
            {
        if($form!='submit'){
          $prices_copy[]=$val;  
         $prices[]=$val*(float)$km;
         $total+=$val*(float)$km;
         
         }

        }

        else{
            if($form!='submit'){
         $prices_copy[]=1;
         $total+=$val;
         $prices[]=$val;
         
         }
        }
    }
       
       
 }
  $word=getIndianCurrency((int)$total).' only';
  $link="http://localhost/bill_gen/display.php?route_no=".$route_no."&random=".$random;
  audit_insertion($route_no,$from_date,$todate,$total,$word,$link);
 $date_generators=date_generator($from_date,$todate);
        // print_r($date_generator);
        $len=count($date_generators);
        $table='r_'.$route_no;
        $i=0;

        while($len){

            $query="UPDATE $table set price=$prices[$i],km=$prices_copy[$i] where Dates=('$date_generators[$i]') and random=$random";
            $res=mysqli_query($con,$query);
            $i++;
            $len--;
        }
}
               // $word=getIndianCurrency($total).'only';
$text='route_no='.$route_no.'&random='.$random;
?>
       <script>
         window.location.href = 'display.php?<?php echo $text;?>';


        </script>
            <?php
               exit();
// header('Location:display.php?'.$text);
                ?>

 <?php include 'includes/overall_footer.php'; ?>