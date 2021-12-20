<?php
session_start();
    require 'connection.php';
    if(isset($_POST['hlogin'])){
    $hemail=$_POST['hemail'];
    $hpassword=$_POST['hpassword'];
    $sql="select Hospital_Name,Hospital_Email,Hospital_Id from hospital_data where Hospital_Email='$hemail' and Passwordd='$hpassword'";
    $result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $rows_fetched=mysqli_num_rows($result);
    if($rows_fetched==0){
        $error= "Wrong email or password.Please try again.";
        header( "location:../login.php?error=".$error);
    }else{
        $row=mysqli_fetch_array($result);
        $_SESSION['hemail']=$row['Hospital_Email'];
        $_SESSION['hname']=$row['Hospital_Name'];
        $_SESSION['hid']=$row['Hospital_Id'];
        $msg= $_SESSION['hname'].' have logged in.';
        header( "location:../bloodrequest.php?msg=".$msg);
    } 
  }
?>
