<?php
include '../config.php';
include '../sendmail.php';

error_reporting(0);
session_start();

require 'connection.php';
if(isset($_POST['hregister'])){
	$hname=$_POST['hname'];
	$hemail=$_POST['hemail'];
	$hpassword=$_POST['hpassword'];
	$hphone=$_POST['hphone'];
	$hcity=$_POST['hcity'];
	$id=rand(1,10);
	$check_email = mysqli_query($conn, "SELECT Hospital_Email FROM hospital_data where Hospital_email = '$hemail' ");
	if(mysqli_num_rows($check_email) > 0){
    $error= 'Email Already exists. Please try another Email.';
    header( "location:../register.php?error=".$error );
 }else{
	if ($hpassword) {

		//function call
		$otp=rand(100000,999999);
		$_SESSION['otp'] = $otp;
		$_SESSION['username']=$hname;
		$_SESSION['email']=$hemail;
		$_SESSION['password']=$hpassword;
		$_SESSION['phone']=$hphone;
		$_SESSION['city']=$hcity;
		$_SESSION['id']=$id;
		$check=sendotpmail($otp,$hemail);
		if($check==false){
			?>
				<script>
					alert("<?php echo "Register Failed, Invalid Email ".$hemail?>");
				</script>
			<?php
		}else{
			?>
			<script>
				alert("<?php echo " OTP sent to " . $hemail ?>");
				window.location.replace('../otp_h.php');

			</script>
			<?php
		}	
	}
	$sql2="select max(serial_no) from hospital_b_data";
	$res=mysqli_query($conn, $sql2);
	$res=mysqli_fetch_array($res);
	$num=$res['max(serial_no)'];
	$num=$num+1;
	$sql2="INSERT INTO hospital_b_data (Blood_Group,Current_stock,Requested,serial_no,Hospital_id,b_status)
	VALUES ('O_p',0,0, '$num','$id','Requested')";
	mysqli_query($conn, $sql2);
	$num=$num+1;
	$sql2="INSERT INTO hospital_b_data (Blood_Group,Current_stock,Requested,serial_no,Hospital_id,b_status)
	VALUES ('O_n',0,0, '$num','$id','Requested')";
	mysqli_query($conn, $sql2);
	$num=$num+1;
	$sql2="INSERT INTO hospital_b_data (Blood_Group,Current_stock,Requested,serial_no,Hospital_id,b_status)
	VALUES ('AB_p',0,0, '$num','$id','Requested')";
	mysqli_query($conn, $sql2);
	$num=$num+1;
	$sql2="INSERT INTO hospital_b_data (Blood_Group,Current_stock,Requested,serial_no,Hospital_id,b_status)
	VALUES ('AB_n',0,0, '$num','$id','Requested')";
	mysqli_query($conn, $sql2);
	$num=$num+1;
	$sql2="INSERT INTO hospital_b_data (Blood_Group,Current_stock,Requested,serial_no,Hospital_id,b_status)
	VALUES ('B_p',0,0, '$num','$id','Requested')";
	mysqli_query($conn, $sql2);
	$num=$num+1;
	$sql2="INSERT INTO hospital_b_data (Blood_Group,Current_stock,Requested,serial_no,Hospital_id,b_status)
	VALUES ('B_n',0,0, '$num','$id','Requested')";
	mysqli_query($conn, $sql2);
	$num=$num+1;
	$sql2="INSERT INTO hospital_b_data (Blood_Group,Current_stock,Requested,serial_no,Hospital_id,b_status)
	VALUES ('A_p',0,0, '$num','$id','Requested')";
	mysqli_query($conn, $sql2);
	$num=$num+1;
	$sql2="INSERT INTO hospital_b_data (Blood_Group,Current_stock,Requested,serial_no,Hospital_id,b_status)
	VALUES ('A_n',0,0, '$num','$id','Requested')";
	mysqli_query($conn, $sql2);
	// if ($conn->query($sql) === TRUE) {
	// 	$msg = 'You have successfully registered Please, login to continue.';
	// 	header( "location:../login.php?msg=".$msg );
	// } else {
	// 	$error = "Error: " . $sql . "<br>" . $conn->error;
	// 	$location="../register.php";
    //     header( "$location/error=".$error );
	// }
	$conn->close();
}
}
?>