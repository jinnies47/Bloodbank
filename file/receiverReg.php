<?php
include '../config.php';
include '../sendmail.php';


error_reporting(0);

session_start();
if(isset($_POST['rregister'])){
	require 'connection.php';
	$rname=$_POST['rname'];
	$remail=$_POST['remail'];
	$rpassword=$_POST['rpassword'];
	$rphone=$_POST['rphone'];
	$rcity=$_POST['rcity'];
	$rbg=$_POST['rbg'];
	$check_email = mysqli_query($conn, "SELECT email FROM tablename where email='$remail' ");
	if(mysqli_num_rows($check_email) > 0){
    $error= 'Email Already exists. Please try another Email.';
    header( "location:../register.php?error=".$error );
	}
	else{	
	if ($rpassword) {

		//function call
		$otp=rand(100000,999999);
		$_SESSION['otp'] = $otp;
		$_SESSION['username']=$rname;
		$_SESSION['email']=$remail;
		$_SESSION['password']=$rpassword;
		$_SESSION['phone']=$rphone;
		$_SESSION['city']=$rcity;
		$_SESSION['rbg']=$rbg;

		$check=sendotpmail($otp,$remail);
	
		if($check==false){
			?>
				<script>
					alert("<?php echo "Register Failed, Invalid Email ".$remail?>");
				</script>
			<?php
		}else{
			?>
			<script>
				alert("<?php echo " OTP sent to " . $remail ?>");
				window.location.replace('../otp.php');

			</script>
			<?php
		}
		
	}
	// $sql = "INSERT INTO tablename (username, email, password, ph_num, city,blood_gr)
	// VALUES ('$rname','$remail', '$rpassword', '$rphone', '$rcity', '$rbg')";
	// if ($conn->query($sql) === TRUE) {
	// 	$msg = "You have successfully registered. Please, login to continue.";
	// 	header( "location:../login.php?msg=".$msg);
	// } else {
	// 	$error = "Error: " . $sql . "<br>" . $conn->error;
    //     header( "location:../register.php?error=".$error );
	// }
	$conn->close();
  }
}
?>