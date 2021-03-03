 <?php  
 include 'init.php';
 

global $con;
if(isset($_GET['route_no'])===true){
    $route_no=$_GET['route_no'];
    $random=$_GET['random'];
    $user_detail=fetch_user_detail($route_no);
    $dates=fetch_dates_from_audit($route_no);
    $from_date=date("Y-m-d",strtotime($dates['from_date']));
    $to_date=date("Y-m-d",strtotime($dates['todate']));
    $period=fetch_dates_from_route($route_no,$from_date,$to_date,$random);
    $price=fetch_price_from_route($route_no,$from_date,$to_date,$random);
    $km=fetch_km_from_route($route_no,$from_date,$to_date,$random);
    $rupee=array();
    $paisa=array();
      $k=0;
      $price_cart=convert_paisa($price);
      $row_rupee=$price_cart['rupee'];
      $row_paisa=$price_cart['paisa'];
      
      $km_price=convert_paisa($km);
      $km_rupee=$km_price['rupee'];
      $km_paisa=$km_price['paisa'];


        $amount1 = $dates['total_price'];
        $amount=number_format((float)$amount1, 2, '.', '');
        $total_rupee = floor($amount);
        $total_paisa = ($amount - $total_rupee)*100; 
        $total_paisa=round($total_paisa);


        if($user_detail['trip_type']==='trip'){
          $trip=$user_detail['trip_count'];
          $length=count($km_rupee);
          $r=0;
          while($length){
          $km_rupee[$r]='-';
          $km_paisa[$r]='-';
          $length--;
          $r++;
        }
        }
        else{
          $trip=$user_detail['km'];
        }

}
  ?>
<style type="text/css">
    h1 h3 h4{
      margin-bottom:0;
    }

    .rates, th, .rates td {
  border: 1px solid black;
  border-collapse: collapse;
}
@page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
th, td {
  padding: 5px;
  text-align: left;
}
</style>

<body>
  
    <h3 style="text-align: center;">TRANSPORT CLAIM BILL FOR MILK DISTRIBUTION</h3>
    
    <p><strong>BILL NO: <?php echo $dates['s_no']; ?></strong></p>
    <div id="address" style="height: 250px">
      <!-- address starts here -->

      <table  width="100%" style="margin-bottom: 5px">
      <tbody>
        <tr>
          <td valign="top" style="margin-right:500px;padding-right: 300px;height: 50px;" >
            <!-- from starts here -->
            <strong>From:</strong><br>
            <h4>
              <span><?php echo $user_detail['owner_name']; ?>,

                <br>
               <?php echo $user_detail['address']; ?>
              </span>

              </h4>
            </td>
            <!-- from starts here -->
          <td valign="top"  >
            <!-- fto starts here -->
            <strong>To:</strong><br>
            <h4 style="margin-bottom: 5px">
              
               The General Manager,<br>
               M.D.C.M.P.U. LTD,<br>
               SATHAMANGALAM.<br>
               MADURAI-625 020.<br>
               
              </h4>
            <span>DATE:<?php echo date("d-m-Y"); ?></span>
    
            <!--to ends here -->
          </td>

          </tr>
          
        </tbody>


    </table>
    <!-- address end here -->
    <p>
     Sir,<br>
            &nbsp;&nbsp;&nbsp;&nbsp;I am here with submitting the bill for distribution of milk through Route No
            <span style="text-decoration: underline;"> <?php echo $route_no; ?> </span>
            Period from
            <span style="text-decoration: underline;"> <?php echo $dates['from_date']; ?> </span>
            to<span style="text-decoration: underline;"> <?php echo $dates['todate']; ?> </span>
            for Rs<span style="text-decoration: underline;"> <?php echo (int)($dates['total_price']); ?> </span>
            Vehicle No<span style="text-decoration: underline;"> <?php echo $user_detail['vehicle_no']; ?> </span>
          </p>
    
    <!-- declaration starts here -->
    <table  style="border: 1px solid black;width: 100%;" class="rates"> 
      <tr>
    <th rowspan="2">Date</th>
    <th colspan="2">Rate/Trip</th> 
    <th rowspan="2">No of Trip/Km</th>
    <th colspan="2">Total Amount</th>
    <th rowspan="2">Particulars</th>
  </tr>

  <tr>
    <th>RS</th>
    <th>ps</th>
    <th>RS</th>
    <th>ps</th>
  </tr>
  
    <?php 
  

    $i=0;
    $j=count($period);
      while($j) {
          echo "<tr>
          <td>$period[$i]</td>
          <td>$km_rupee[$i]</td>
          <td>$km_paisa[$i]</td>
          <td>$trip</td>
          <td>$row_rupee[$i]</td>
          <td>$row_paisa[$i]</td>
          <td></td>
          </tr>";
          $i++;
          $j--;
        }
     ?>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>TOTAL</td>
    <td><?php echo $total_rupee; ?></td>
    <td><?php echo $total_paisa; ?></td>
    <td></td>
  </tr>
  
</table>

<p>RS<span style="text-decoration: underline;"> <?php echo (int)$dates['total_price']; ?>&nbsp;&nbsp;<span style="float:center;">(RS.<span style="text-decoration: underline;"> <?php echo strtoupper($dates['currency']); ?>)</span></p>
<span style="float: right;">Signature of contractor</span>
</div>

<div style="margin-top: 100%">
  <br>
  <div id="div_content_up">
    <ol type="I">
  <li>Certificate issued by Asst.Manager MKG/Zonal Superintendent</li><br>
  <ol type="1">
  <li>Certificate that the vehicle has been engaged for the distribution of milk from Madurai Dairy in RNO__________for the period from__________to__________</li><br>
  <li>Certificate that the vehicle has covered all the depot points.</li><br>
  <li>Certificate that the rate claimed in this bill is according to the contract.</li><br>
  <li>Certificate that the bill has not been claimed and paid before.</li><br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <span style="float:right;margin-bottom: 20%">Asst.Manager/Supdt.(MKG)</span><br>
  </ol>
  <div style="margin-top: 100px;margin-bottom: 100px"></div>
  <li>Certificate from Dairy Section</li><br>
  <ol type="1">
   <li>Certified that there is no cases of short handling over of plastic tubs and leaky sachets expact on.</li><br>
  </ol>
  <ul>The cost of__________tubs and the cost of ___________ Nos. of SM/PM/TM/FCM</ul>
</ol>  
<ul>May be recovered from this bill.</ul>
  <br>
  <br>
  <br>
  <br>
  <ul>
   <p style="margin-top: 30%">
    <span style="float:left">Asst.</span>
    <span style="margin-left:100px">A.M.D</span>
    <span style="margin-left:100px">Dy.M.(process)</span>
    <span style="margin-left:100px">Manager(P & M)</span>
    
   </p>
  <ul>
  </div>
</div>
</body>
<script type="text/javascript">
      // window.print();
</script>
    
  



