<?php
include "connection.php";
    $userid=$_POST['user_id'];
    $change=$_POST['test_result'];
    if($change=='Accepted')
    {
        $reason=$_POST['reason'];
        $results=$change."-".$reason;
        $sql="update user_donate set test_results='$results' where user_id='$userid'";
        $date=date('Y-m-d');
        $sql2="update user_donate set donation_date='$date' where user_id='$userid'";
        mysqli_query($conn,$sql2);
        $sql2="update user_donate set last_donation_date='$date' where user_id='$userid'";
        mysqli_query($conn,$sql2);
        $id=rand(100,1000);
        $expd=date('Y-m-d',strtotime("+12 weeks"));
        $sql2="select blood_type from user_donate where user_id='$userid'";
        $res=mysqli_query($conn,$sql2);
        $res=mysqli_fetch_array($res);
        $btype=$res['blood_type'];
        $sql2="insert into b_stock(B_sampleid,Blood_type,Donation_date,Expiry_date) values ('$id','$btype','$date','$expd')";
        mysqli_query($conn,$sql2);
    }
    else{
        $reason=$_POST['reason'];
        $results=$change."-".$reason;
        $sql="update user_donate set test_results='$results'";
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