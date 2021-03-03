 <?php 
    include 'includes/overall_head.php';
 ?>
 <script type="text/javascript">
   function yesnoCheck(that) {
    if (that.value == "km") {
  
        document.getElementById("ifYes").style.display = "block";
        document.getElementById("trip_no").style.display = "none";

    } else {
        document.getElementById("ifYes").style.display = "none";
        document.getElementById("trip_no").style.display = "block";
    }
}
 </script>

   <div class="container text-success"> 
    <form method="post" action="storing.php">
      <h4 class=" text-secondary ">Registration Form</h4>
 	 <div class="form-group">
                <label for="name">Owner Name</label>
                <input type="text" id="name" name="owner_name" class="form-control" required list="names" autocomplete="on">
                <datalist id="names">
                  <option value="K.chelladurai">
                  <option value="k.ganesan">
                  <option value="c.maheshwari">
                </datalist>
                <small class="text-muted">*required</small>

   	 </div>
	 <div class="form-group">
                <label for="route">Route-No</label>
                <input type="number" id="route" name="route_no" class="form-control" required min="1" max="100">
                <small class="text-muted">*required</small>

   	 </div>
	<div class="form-group">
                <label for="address">Address</label>
                <!-- <textarea id="address" name="address" required rows="5" class="form-control" autocomplete="on" list="address_list"></textarea> -->
                <input type="text" class="form-control" name="address" id="address" list="address_list" required="required" maxlength="1000" minlength="20">
                <datalist id="address_list">
                  <option value="11 A sathamangalam main road west anna nagar madurai-20">
                  <option value="1/4 A puratchi thalivar colony karumbalai madurai-20">
                  <option value="15/225 smp colony anna nagar madurai-20">
                </datalist>
                <small class="text-muted">*required</small>

   	 </div>

	<div class="form-group">
                <label for="vehicle_no">Vehicle Number</label>
                <input type="text" id="vehicle_no" name="vehicle_no" class="form-control" required>
                <small class="text-muted">*required</small>

   	</div>
	<div class="form-group">
                <label for="trip">Trip-Type</label>
                <select id="trip_type" name="trip_type" class="form-control" onchange="yesnoCheck(this);" required>
                    <option value="trip">Trip</option>
                    <option value="km">Km</option>
                </select>
		<small class="text-muted">*required</small><br>

    <div id="ifYes" style="display: none;"class="form-group"><br>
    <label for="km">Km</label> <input type="number" class="form-control" id="km" name="km" /><br />
    <small class="text-muted">*required</small><br>
    </div><br>
    <div id="trip_no" class="form-group">
      <label for="trip_count">Trip Count</label>
    <select id="trip_count" name="trip_count" class="form-control" onchange="yesnoCheck(this);" required>
                    <option value="one" selected="selected">one</option>
                    <option value="two">two</option>
                    <option value="three">three</option>
                </select><br />
    <small class="text-muted">*required</small>


    </div>
	 <input type="submit" class="btn btn-success btn-center" value="submit" name="submit">
  </form>
    </div>

<?php 

include 'includes/overall_footer.php'; ?>
