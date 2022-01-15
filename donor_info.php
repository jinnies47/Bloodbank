<?php 
require 'file/connection.php'; 
session_start();
  if(!isset($_SESSION['rid']))
  {
  header('location:login.php');
  }
  else {
    $rid = $_SESSION['rid'];
	$sql2="select ph_num from tablename where id='$rid'";
	$res=mysqli_query($conn, $sql2);
	$res=mysqli_fetch_array($res);
	$ph_num=$res['ph_num'];
	$rbg=$_POST['rbg'];
	$ldd=$_POST['last_donation_date'];
	$age=$_POST['Age'];
	$weight=$_POST['weight'];
	$sql2="insert into user_donate (user_id,ph_num,blood_type,last_donation_date,age,weight,test_status) values ('$rid','$ph_num','$rbg','$ldd','$age','$weight','Not conducted')";
	mysqli_query($conn, $sql2);
    $sql = "select * from user_donate where user_id='$rid'";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<?php $title="Bloodbank | donor Requests"; ?>
<?php require 'head.php'; ?>
<body>
	<?php require 'header.php'; ?>
	<div class="container cont">

		<?php require 'message.php'; ?>

	<table class="table table-responsive table-striped rounded mb-5">
		<tr><th colspan="10" class="title">user donation</th></tr>
		<tr>
			<th>#</th>
			<th>User Id</th>
			<th>phone number</th>
			<th>Blood type</th>
			<th>last donation date</th>
			<th>test status </th>
			<th>donate otp</th>
			<th>donation date</th>
			<th>test results</th>
			<th>my action</th>
		</tr>
		<?php while($row = mysqli_fetch_array($result)) { ?>

		<tr>
			<td><?php echo ++$counter;?></td>
			<td><?php echo $row['user_id'];?></td>
			<td><?php echo $row['ph_num'];?></td>
			<td><?php echo $row['blood_type'];?></td>
			<td><?php echo $row['last_donation_date'];?></td>
			<td><?php echo $row['test_status'];?></td>
			<td><?php echo $row['test_otp'];?></td>
			<td><?php echo $row['test_date'];?></td>
			<td><?php echo $row['test_results'];?></td>
			<td><?php if($row['test_status'] == 'Test Finished'){ ?>
			<?php }
			else{ ?>
				<a href="file/canceld.php?user_id=<?php echo $row['user_id'];?>" class="btn btn-danger">Cancel</a>
			<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
    <?php require 'footer.php'; ?>
</body>
</html>
<?php } ?>