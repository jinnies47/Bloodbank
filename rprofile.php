<?php
require 'file/connection.php';
session_start();
if(!isset($_SESSION['rid']))
{
  header('location:login.php');
}
else {
	if(isset($_SESSION['rid'])){
		$id=$_SESSION['rid'];
		$sql = "SELECT * FROM tablename WHERE id='$id'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result);
	}
}
?>

<!DOCTYPE html>
<html>
<?php $title="Bloodbank | Receiver Profile"; ?>
<?php require 'head.php';?>
<body>
	<?php require 'header.php'; ?>

	<div class="container cont">

		<?php require 'message.php'; ?>

		<div class="row justify-content-center">
			<div class="col-lg-4 col-md-6 col-sm-8 mb-5">
				<div class="card">
					<div class="media justify-content-center mt-1">
						<img src="image/user.png" alt="profile" class="rounded-circle" width="60" height="60">
					</div>
					<div class="card-body">
					   <form action="file/updateprofile.php" method="post">
					   	<label class="text-muted font-weight-bold" class="text-muted font-weight-bold">User Name</label>
						<input type="text" name="rname" value="<?php echo $row['username']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold" class="text-muted font-weight-bold">User Email</label>
						<input type="email" name="remail" value="<?php echo $row['email']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold" class="text-muted font-weight-bold">User Password</label>
						<input type="text" name="rpassword" value="<?php echo $row['password']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold" class="text-muted font-weight-bold">User Phone Number</label>
						<input type="text" name="rphone" value="<?php echo $row['ph_num']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold" class="text-muted font-weight-bold">User id</label>
						<input type="text" name="rid" value="<?php echo $row['id']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold" class="text-muted font-weight-bold">User City</label>
						<input type="text" name="rcity" value="<?php echo $row['city']; ?>" class="form-control mb-3">
						<label class="text-muted font-weight-bold" class="text-muted font-weight-bold">User Blood Group</label>
						<select class="form-control mb-3" name="bg" required>
                             <option selected><?php echo $row['blood_gr']; ?></option>
                             <option>A-</option>
                             <option>A+</option>
                             <option>B-</option>
                             <option>B+</option>
                             <option>AB-</option>
                             <option>AB+</option>
                             <option>O-</option>
                             <option>O+</option>
                        </select>
						<input type="submit" name="update" class="btn btn-block btn-primary" value="Update">
					   </form>
					</div>
					<a href="abs.php" class="text-center">Cancel</a><br>
				</div>
			</div>
		</div>
	</div>
	<?php require 'footer.php'; ?>
</body>
</html>