<?php
include "connection.php";
    $userid=$_POST['user_id'];
    $change=$_POST['change_test'];
    $tdydate=date("Y-m-d",strtotime("+1 week"));
    $otp=rand(9999,100000);
    if($change=='Scheduled')
	{
        $sql="update user_donate set test_status='$change' where user_id='$userid'";
        $sql2="update user_donate set test_date='$tdydate' where user_id='$userid'";
        mysqli_query($conn,$sql2);
        $sql2="update user_donate set test_otp='$otp' where user_id='$userid'";
        mysqli_query($conn,$sql2);
    }
    else if($change=='Finished')
    {
        $sql="update user_donate set test_status='$change' where user_id='$userid'";
    }
    else
    {
        $sql="update user_donate set test_status='$change' where user_id='$userid'";
        $sql2="update user_donate set test_date='0000-00-00' where user_id='$userid'";
        mysqli_query($conn,$sql2);
        $sql2="update user_donate set test_otp='NULL' where user_id='$userid'";
        mysqli_query($conn,$sql2);
    }
	if(mysqli_query($conn, $sql)) {
	$msg="You have updated the donor table.";
	header("location:../admin.php?msg=".$msg );
    } else {
    $error="Error :Please check the entered details " . mysqli_error($conn);
    header("location:../admin.php?error=".$error );
    }
    mysqli_close($conn);
?>