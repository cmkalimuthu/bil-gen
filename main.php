<?php
// include 'init.php';

        //fetch one by one data from db
?>
        
        <div class="container  text-success">
            <form method="post" action="process.php?main=main">
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
            <div class="form-group">
                <label for="date_from">Period From</label>
                <input type="date" id="date_from" name="date_from" class="form-control" required>
                <small class="text-muted">*required</small>

            </div>
            <div class="form-group">
                <label for="date_to">Period To</label>
                <input type="date" name="date_to" id="date_to" class="form-control" required>
                <small class="text-muted">*required</small>


            </div>

            <input type="submit" name="submit" class="btn btn-primary btn-center" value="proceed">
            </form>
