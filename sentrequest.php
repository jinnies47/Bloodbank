<?php 
require 'file/connection.php'; 
session_start();
  if(!isset($_SESSION['rid']))
  {
  header('location:login.php');
  }
  else {
    $rid = $_SESSION['rid'];
    $sql = "select * from user_request where user_id='$rid'";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<?php $title="Bloodbank | Sent Requests"; ?>
<?php require 'head.php'; ?>
<body>
	<?php require 'header.php'; ?>
	<div class="container cont">

		<?php require 'message.php'; ?>
	<table class="table table-responsive table-striped rounded mb-5">
		<tr><th colspan="8" class="title">Sent requests</th></tr>
		<tr>
			<th>#</th>
			<th>User_Id</th>
			<th>Hospital_Id</th>
			<th>Blood Group</th>
			<th>Quantity</th>
			<th>Status</th>
			<th>Cancel</th>
			<th>Results</th>
		</tr>

		    <div>
                <?php
                if ($result) {
                    $row =mysqli_num_rows( $result);
                    if ($row) { //echo "<b> Total ".$row." </b>";
                }else echo '<b style="color:white;background-color:red;padding:7px;border-radius: 15px 50px;">You have not requested yet. </b>';
            }
            ?>
            </div>

		<?php while($row = mysqli_fetch_array($result)) { ?>

		<tr>
			<td><?php echo ++$counter;?></td>
			<td><?php echo $row['user_id'];?></td>
			<td><?php echo $row['hospital_id'];?></td>
			<td><?php echo $row['blood_type'];?></td>
			<td><?php echo $row['quantity'];?></td>
			<td><?php echo $row['b_status'];?></td>
			<td><?php if($row['b_status'] == 'Accepted'){ ?>
			<?php }
			else{ ?>
				<a href="file/cancel.php?user_id=<?php echo $row['user_id'];?>" class="btn btn-danger">Cancel</a>
			<?php } ?>
			</td>
			<td><?php echo $row['Results'];?></td>
		</tr>
		<?php } ?>
	</table>
</div>
    <?php require 'footer.php'; ?>
</body>
</html>
<?php } ?>