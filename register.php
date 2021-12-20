<?php 
session_start();
if (isset($_SESSION['hid'])) {
  header("location:bloodrequest.php");
}elseif (isset($_SESSION['rid'])) {
  header("location:sentrequest.php");
}else{
?>
<?php 

include 'config.php';
include 'sendmail.php';


error_reporting(0);

session_start();

// if (isset($_SESSION['username'])) {
//     // header("Location: index.php");
// }


if (isset($_POST['submit'])) {
	$username = $_POST['rname'];
	$email = $_POST['remail'];
	$password = md5($_POST['rpassword']);

	$check_query = mysqli_query($conn, "SELECT * FROM tablename where email ='$email'");
    $rowCount = mysqli_num_rows($check_query);
    if(!empty($email) && !empty($password)){
        if($rowCount > 0){
        ?>
        <script>
            alert("User with email already exist!");
			window.location.replace('index.php');

        </script>
        <?php
    }else{

	if ($password) {

		//function call
		$otp=rand(100000,999999);
		$_SESSION['otp'] = $otp;
		$_SESSION['username']=$username;
		$_SESSION['email']=$email;
		$_SESSION['password']=$password;
		
		$check=sendotpmail($otp,$email);
		
	
		if($check==false){
			?>
				<script>
					alert("<?php echo "Register Failed, Invalid Email ".$email?>");
				</script>
			<?php
		}else{
			?>
			<script>
				alert("<?php echo " OTP sent to " . $email ?>");
				window.location.replace('otp.php');

			</script>
			<?php
		}
		
	}
}//here
}
}

?>

<!DOCTYPE html>
<html>
<?php $title="Bloodbank | Register"; ?>
<?php require 'head.php'; ?>
<body>
<script>
		function validateform(){  
var rname=document.registrationform.rname.value;  
var password=document.registrationform.rpassword.value;  
  
if (rname==null || rname==" "){  
  alert("Username can't be blank");  
  return false;  
}else if(password.length<6){  
  alert("Password must be at least 6 characters long.");  
  return false;  
  }  
}  
	</script>

  <?php include 'header.php'; ?>

    <div class="container cont">

    <?php require 'message.php'; ?>

      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7 mb-5">
          <div class="card rounded">
            <ul class="nav nav-tabs justify-content-center bg-light" style="padding: 20px">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#hospitals">Hospitals</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#receivers">Receivers</a>
              </li>
            </ul>

    <div class="tab-content">

       <div class="tab-pane container active" id="hospitals">

        <form action="file/hospitalReg.php" method="post" enctype="multipart/form-data" >
          <input type="text" name="hname" placeholder="Hospital Name" class="form-control mb-3" required>
          <input type="text" name="hcity" placeholder="Hospital City" class="form-control mb-3" required>
          <input type="tel" name="hphone" placeholder="Hospital Phone Number" class="form-control mb-3" required pattern="[0,6-9]{1}[0-9]{9,11}" title="Password must have start from 0,6,7,8 or 9 and must have 10 to 12 digit">
          <input type="email" name="hemail" placeholder="Hospital Email" class="form-control mb-3" required>
          <input type="password" name="hpassword" placeholder="Hospital Password" class="form-control mb-3" required minlength="6">
          <input type="submit" name="hregister" value="Register" class="btn btn-primary btn-block mb-4">
        </form>

       </div>


       <div class="tab-pane container fade" id="receivers">

         <form action="file/receiverReg.php" method="post" enctype="multipart/form-data" onsubmit="return validateform()" >
          <input type="text" name="rname" placeholder="Receiver Name" class="form-control mb-3" required>
          <select name="rbg" class="form-control mb-3" required>
                <option disabled="" selected="">Blood Group</option>
                <option value="A_p">A+</option>
                <option value="A_n">A-</option>
                <option value="B_p">B+</option>
                <option value="B_n">B-</option>
                <option value="AB_p">AB+</option>
                <option value="AB_n">AB-</option>
                <option value="O_p">O+</option>
                <option value="O_n">O-</option>
          </select>
          <input type="text" name="rcity" placeholder="Receiver City" class="form-control mb-3" required>
          <input type="tel" name="rphone" placeholder="Receiver Phone Number" class="form-control mb-3" required pattern="[0,6-9]{1}[0-9]{9,11}" title="Password must have start from 0,6,7,8 or 9 and must have 10 to 12 digit">
          <input type="email" name="remail" placeholder="Receiver Email" class="form-control mb-3" required>
          <input type="password" name="rpassword" placeholder="Receiver Password" class="form-control mb-3" required minlength="6">
          <input type="submit" name="rregister" value="Register" class="btn btn-primary btn-block mb-4">
        </form>

       </div>
    </div>
    <a href="login.php" class="text-center mb-4" title="Click here">Already have account?</a>
</div>
</div>
</div>
</div>
<?php require 'footer.php' ?>
</body>
</html>
<?php } ?>