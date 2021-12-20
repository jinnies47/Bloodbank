<?php 
require './file/connection.php'; 
session_start();
  if(!isset($_SESSION['aid']))
  {
  header('location:../login.php');
  }
  else {
    $hid = $_SESSION['aid'];
    $sql="select * from user_donate";
    $result=mysqli_query($conn, $sql);
	$counter=0;
?>

<!DOCTYPE html>
<html>
<?php $title="Bloodbank | Blood Requests"; ?>
<?php require 'head.php'; ?>
<body>
	<?php require 'header.php'; ?>
	<div class="container cont">

		<?php require 'message.php';?>

	<table class="table table-responsive table-striped rounded mb-5">
		<tr><th colspan="9" class="title">Donor requests from Users</th></tr>
		<tr>
			<th>#</th>
			<th>User_id</th>
			<th>Blood Group</th>
			<th>Test Status</th>
			<th>Last Donation date</th>
            <th>Donated Date</th>
			<th>Donate Password</th>
			<th>Test Results</th>
			<th>Test date</th>
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
			<td><?php echo $row['user_id'];?></td>
			<td><?php echo $row['blood_type'];?></td>
			<td><?php echo $row['test_status'];?></td>
			<td><?php echo $row['last_donation_date'];?></td>
			<td><?php echo $row['test_date'];?></td>
			<td><?php echo $row['test_otp'];?></td>
			<td><?php echo $row['test_results'];?></td>
			<td><?php echo $row['donation_date'];?></td>
		</tr>
		<?php } ?>
	</table>
</div>
	<div class="d-flex">
	<div class="col-lg-4" style="margin-left:80px;">
			<h4>Change Donor data</h4>
		<form class="ml-10" action="file/change.php" method="post">
			<label class="text-muted font-weight-bold">User Id</label>
            <input type="number" min="100" name="user_id" required placeholder="Enter User Id" class="form-control"> 
		<label class="text-muted font-weight-bold">Change Test Status</label>
			<br>
			<select class="form-select form-select-lg mb-2" name="change_test">
  			<option selected>Not Conducted</option>
			<option value="Scheduled">Scheduled</option>
			<option value="Test_Finished">Test Finished</option>
			</select> 
			<br>  

           <input type="submit" value="Change" class="btn btn-primary mb-2">
        </form>
	</div>
	<div class="col-lg-4" style="margin-left:80px;">
			<h4>Update Test Results</h4>
		<form class="ml-10" action="file/update.php" method="post">
			<label class="text-muted font-weight-bold">User Id</label>
            <input type="number" min="100" name="user_id" placeholder="Enter User Id" class="form-control" required> 
		<label class="text-muted font-weight-bold">Change Test Status</label>
			<br>
			<select class="form-select form-select-lg mb-2" name="test_result">
  			<option selected>Select</option>
			<option value="Accepted">Accepted</option>
			<option value="Rejected">Rejected</option>
			</select> 
			<br>  
			<label class="text-muted font-weight-bold">Reason for acceptance/rejection</label>
			<input type="text" name="reason" placeholder="Reason" maxlength="200" >
           <input type="submit" value="Update" class="btn btn-primary mb-2">
        </form>
		<br><br>
	</div>
	</div>
	<div class="d-flex">
	<div>
	<?php
		$sql="select * from b_stock";
		$sql2="delete from b_stock where curdate()>Expiry_date";
		mysqli_query($conn,$sql2);
		$result=mysqli_query($conn, $sql);
		$counter=0;
	?>
	<table class="table table-responsive table-striped rounded mb-2" style="margin-left:90px;">
		<tr><th colspan="9" class="title">Blood Stock at Blood Bank</th></tr>
		<tr>
			<th>#</th>
			<th>BSample_id</th>
			<th>Blood Group</th>
			<th>Donation Date</th>
			<th>Expiry Date</th>
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
			<td><?php echo $row['B_sampleid'];?></td>
			<td><?php echo $row['Blood_type'];?></td>
			<td><?php echo $row['Donation_date'];?></td>
			<td><?php echo $row['Expiry_date'];?></td>
		</tr>
		<?php } ?>
	</table>
		</div>
			<div class="col-lg-4" style="margin-left:80px;">
			<h4>Delete Blood Samples</h4>
		<form class="ml-10" action="./file/discard.php" method="post">
			<label class="text-muted font-weight-bold">Blood sample Id</label>
            <input type="number" min="100" name="bsample_id" required placeholder="blood sample id" class="form-control"> 
			<br>  
           <input type="submit" value="Delete" class="btn btn-primary mb-2">
        </form>
		</div>
	</div>
	<div>
	<?php
		$sql="select * from hospital_b_data";
		$result=mysqli_query($conn, $sql);
	?>
	<table class="table table-responsive table-striped rounded mb-5 mt-5" style="margin-left:90px;">
		<tr><th colspan="9" class="title">Blood requests from Hospitals</th></tr>
		<tr>
			<th>#</th>
			<th>Hospital_id</th>
			<th>Blood Group</th>
			<th>Quantity</th>
			<th>Status</th>
			<th colspan="2">Action</th>
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
			<td><?php echo $row['serial_no'];?></td>
			<td><?php echo $row['Hospital_id'];?></td>
			<td><?php echo $row['Blood_Group'];?></td>
			<td><?php echo $row['Requested'];?></td>
			<td><?php echo $row['b_status'];?></td>
			<td><?php if($row['b_status']=='Accepted' or $row['b_status']=='Rejected'){ 
				?> <a href="" class="btn btn-success disabled">Accepted</a>
		         <?php }
			else{ ?>
				<a href="file/accepth.php?serial_no=<?php echo $row['serial_no'];?>"
				 class="btn btn-success">Accept
				 </a>
			<?php } ?>
			</td>
			<td><?php if($row['b_status'] == 'Rejected' or $row['b_status']=='Accepted'){ ?> <a href="" class="btn btn-danger disabled">Rejected</a> <?php }
			else{ ?>
				<a href="file/rejecth.php?serial_no=<?php echo $row['serial_no'];?>" class="btn btn-danger">Reject</a>
			<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
	</div>
    <?php require 'footer.php'; ?>
</body>
</html>
<?php } ?>