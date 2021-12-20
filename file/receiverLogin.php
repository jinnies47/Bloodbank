<?php
session_start();
    require 'connection.php';
    if(isset($_POST['rlogin'])){
    $remail=$_POST['remail'];
    $rpassword=$_POST['rpassword'];
    $sql="select * from tablename where email='$remail' and password='$rpassword'";
    $result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
    $rows_fetched=mysqli_num_rows($result);
    if($rows_fetched==0){
        $error= "Wrong email or password. Please try again.";
        header( "location:../login.php?error=".$error);
    }else{
        $row=mysqli_fetch_array($result);
        $_SESSION['remail']=$row['email'];
        $_SESSION['rname']=$row['username'];
        $_SESSION['rid']=$row['id'];
        $msg= $_SESSION['rname'].' have logged in.';
        header( "location:../abs.php?msg=".$msg);
    } 
  }
?>