<?php 

function date_generator($start_date,$end_date)
{
	$dates = array($start_date);
    while(end($dates) < $end_date){
        $dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
    }
    return $dates;
}
function retrieve_data($start_date,$end_date,$route_no,$random)
{
	global $con;
	$query="SELECT distinct Dates from $route_no where Dates between '$start_date' and '$end_date' and random='$random' ";
	      	

    $res=mysqli_query($con,$query);
    $i=0;
    $date=array();
    while ($row = $res->fetch_assoc()) {
    //fetch one by one data from db
		$dates=$row['Dates'];
		$dates=date("d-m-Y",strtotime($dates)); 
		$date[]=$dates;
}
           return $date;		
}

function getIndianCurrency(float $number)
{

    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    $total=($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    return $total;


}

function audit_insertion($route_no,$from_date,$todate,$total,$word){
	global $con;
  $date=date("d-m-Y");
$sql="INSERT INTO audit(Route_No,From_Date,To_Date,Total_Price,Currency,Entry_Date)values('$route_no','$from_date','$todate','$total','$word','$date')";
$res=mysqli_query($con,$sql);

}
function fetch_user_detail($route_no){
	global $con;
	 $query="SELECT Owner_Name,Vehicle_No,Trip_Type,Km,Address,Trip_Count from users where Route_No=$route_no";
      
            
      $res=mysqli_query($con,$query);
       while($rows=$res->fetch_assoc())
                  {

                    $owner_name=$rows['Owner_Name'];
                    $vehicle_no=$rows['Vehicle_No'];
                    $address=$rows['Address'];
                    $trip_type=$rows['Trip_Type'];
                    $km=$rows['Km'];
                    $trip_count=$rows['Trip_Count'];
                }
         $result=array(
         	'owner_name' =>$owner_name,
         	'vehicle_no' =>$vehicle_no,
         	'address'    =>$address,
         	'trip_type'	 =>$trip_type,
          'km'         =>$km,
          'trip_count' =>$trip_count
         );
         return $result;
}
function fetch_dates_from_audit($route_no){
	global $con;
	$query="SELECT From_Date,To_Date,Total_Price,Currency,S_No from audit  where Route_No=$route_no";
                $res=mysqli_query($con,$query);
                while($rows=$res->fetch_assoc())
                  {
                $Total_Price=$rows['Total_Price'];
                $Currency=$rows['Currency'];
                $From_Date= $rows['From_Date'];
                $To_Date= $rows['To_Date'];
                $S_No=$rows['S_No'];

               }
               $From_Date=date("d-m-Y",strtotime($From_Date));
               $To_Date=date("d-m-Y",strtotime($To_Date));

               $dates=array(
               	'from_date'=>$From_Date,
               	'todate'   =>$To_Date,
               	'total_price' =>$Total_Price,
               	'currency'	=>$Currency,
               	's_no' =>$S_No
               );
               return $dates;
}


function fetch_dates_from_route($route_no,$from_date,$todate,$random){
	global $con;
	$table='r_'.$route_no;
	$period=array();

	$query="SELECT Dates from $table where Dates between '$from_date' and '$todate' and random=$random";

	
                $res=mysqli_query($con,$query);
                while($rows=$res->fetch_assoc())
                  {
                $period[]=date("d-m-Y",strtotime($rows['Dates']));
    
               }
                return $period;
}
function fetch_price_from_route($route_no,$from_date,$todate,$random){
	global $con;
	$table='r_'.$route_no;
	$price=array();
	$query="SELECT price from $table where Dates between '$from_date' and '$todate' and random=$random";
	
                $res=mysqli_query($con,$query);
                while($rows=$res->fetch_assoc())
                  {
                $price[]=$rows['price'];

               }
                return $price;
}
function fetch_km_from_route($route_no,$from_date,$todate,$random){
  global $con;
  $table='r_'.$route_no;
  $km=array();
  $query="SELECT km from $table where Dates between '$from_date' and '$todate' and random=$random";
  
                $res=mysqli_query($con,$query);
                while($rows=$res->fetch_assoc())
                  {
                $km[]=$rows['km'];

               }
                return $km;
}
function convert_paisa($price){
  $rupee=array();
  $paisa=array();
  $k=0;
  foreach($price as $item) {
          $amount = $item;
          $amount=number_format((float)$amount, 2, '.', '');
          $rupee[$k] = floor($amount);
          $paisa[$k] = ($amount - $rupee[$k])*100; 
          $paisa[$k]=  round($paisa[$k]);
          $k++;

        }
        $total=array(
            'rupee'=>$rupee,
            'paisa'=>$paisa
        );
        return $total;
}