<?php 
require 'file/connection.php'; 
session_start();
  if(!isset($_SESSION['hid']))
  {
  header('location:login.php');
  }
  else {
    $hid = $_SESSION['hid'];
    $sql="select * from user_request where hospital_id='$hid'";
    $result=mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<?php $title="Bloodbank | Blood Requests"; ?>
<?php require 'head.php'; ?>
<link rel="stylesheet" type="text/css" href="./style.css">
<body>
	<?php require 'header.php'; ?>
	<div class="container cont">

		<?php require 'message.php';?>

	<table class="table table-responsive table-striped rounded mb-5">
		<tr><th colspan="9" class="title">Blood requests from Users</th></tr>
		<tr>
			<th>#</th>
			<th>Hospital_id</th>
			<th>User_id</th>
			<th>Blood Group</th>
			<th>Quantity</th>
			<th>Status</th>
			<th colspan="2">Action</th>
			<th>Results</th>
		</tr>

		    <div>
                <?php
                if ($result) {
                    $row =mysqli_num_rows( $result);
                    if ($row) 
					{ //echo "<b> Total ".$row." </b>";
            	    }
				else 
					echo '<b style="color:white;background-color:red;padding:7px;border-radius: 15px 50px;">No one has requested yet. </b>';
            }
            ?>
            </div>

		<?php while($row=mysqli_fetch_array($result)) { ?>
		<tr>
			<td><?php echo ++$counter;?></td>
			<td><?php echo $row['hospital_id'];?></td>
			<td><?php echo $row['user_id'];?></td>
			<td><?php echo $row['blood_type'];?></td>
			<td><?php echo $row['quantity'];?></td>
			<td><?php echo $row['b_status'];?></td>
			<td><?php if($row['b_status']=='Accepted' or $row['b_status']=='Rejected'){ 
				?> <a href="" class="btn btn-success disabled">Accepted</a>
		         <?php }
			else{ ?>
				<a href="file/accept.php?user_id=<?php echo $row['user_id'];?>"
				 class="btn btn-success">Accept
				 </a>
			<?php } ?>
			</td>
			<td><?php if($row['b_status'] == 'Rejected' or $row['b_status']=='Accepted'){ ?> <a href="" class="btn btn-danger disabled">Rejected</a> <?php }
			else{ ?>
				<a href="file/reject.php?user_id=<?php echo $row['user_id'];?>" class="btn btn-danger">Reject</a>
			<?php } ?>
			</td>
			<td><?php echo $row['Results'];?></td>
		</tr>
		<?php } ?>
	</table>
</div>
	  <?php
	  	$hospsql="select * from hospital_b_data where Hospital_id='$hid' ";
		  $res=mysqli_query($conn, $hospsql); 
		  $counter=0;
	  ?>
	  <div class="d-flex">
	<div class="container" style="margin-left:90px;">
	<table class="table table-responsive table-striped rounded mb-2">
		<tr><th colspan="4" class="title">Hospital Blood sample data</th></tr>
		<tr>
			<th>#</th>
			<th>Blood Group</th>
			<th>Current_Stock</th>
			<th>Requested</th>
		</tr>

		    <div>
                <?php
                if ($res) {
                    $row =mysqli_num_rows( $res);
                    if ($row) 
					{ //echo "<b> Total ".$row." </b>";
            	    }
				else 
					echo '<b style="color:white;background-color:red;padding:7px;border-radius: 15px 50px;">No one has requested yet. </b>';
            }
            ?>
            </div>

		<?php while($row=mysqli_fetch_array($res)) { ?>
		<tr>
			<td><?php echo ++$counter;?></td>
			<td><?php echo $row['Blood_Group'];?></td>
			<td><?php echo $row['Current_stock'];?></td>
			<td><?php echo $row['Requested'];?></td>
		</tr>
		<?php } ?>
	</table>
	</div>
	<div class="col-lg-4 mb-2 mt-2" style="margin-right:70px;">
			<h4>Change Hospital Blood sample data</h4>
		<form class="ml-10" action="file/changequa.php" method="post">
			<label class="mb-2 text-muted font-weight-bold">Blood Group</label>
			<br>
			<select class="form-select form-select-lg mb-2" name="Blood_type">
  			<option selected>Select</option>
			<option value="O_p">O_p</option>
			<option value="O_n">O_n</option>
			<option value="AB_p">AB_p</option>
			<option value="AB_n">AB_n</option>
			<option value="A_n">A_n</option>
			<option value="A_p">A_p</option>
			<option value="B_p">B_p</option>
			<option value="B_n">B_n</option>
			</select>   
		<br> 
		<label class="mb-2 text-muted font-weight-bold">Section</label>
			<br>
			<select class="form-select form-select-lg mb-2" name="section">
  			<option selected>Select</option>
			<option value="Current_Stock">Current_Stock</option>
			<option value="Requested">Requested</option>
			</select>   
		<br>
		<label class="text-muted font-weight-bold">Change</label>
		<input type="radio" value="<?php echo $hid ?>" name="H_id">
			<br>
		<label class="text-muted font-weight-bold">Quantity</label>
            <input type="number" min="0" max="50" name="quantity" placeholder="Change Quantity" class="form-control mb-2"> 
            <input type="submit" value="Change" class="btn btn-primary mb-4">
        </form>
	</div>
	</div>
    <?php require 'footer.php'; ?>
</body>
</html>
<?php } ?>