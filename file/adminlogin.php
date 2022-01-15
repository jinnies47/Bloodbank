<?php
session_start();
    require 'connection.php';
    if(isset($_POST['alogin'])){
    $aemail=$_POST['aemail'];
    $apassword=$_POST['apassword'];
    $sql="select aid,admin_email from admin_data where admin_email='$aemail' and admin_password='$apassword'";
    $result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $rows_fetched=mysqli_num_rows($result);
    if($rows_fetched==0){
        $error= "Wrong email or password.Please try again.";
        header( "location:../login.php?error=".$error);
    }else{
        $row=mysqli_fetch_array($result);
        $_SESSION['aemail']=$row['admin_email'];
        $_SESSION['aid']=$row['aid'];
        $msg= $_SESSION['aid'].' have logged in.';
        header( "location:../admin.php?msg=".$msg);
    } 
  }
?>
