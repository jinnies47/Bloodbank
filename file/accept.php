
<?php
include "connection.php";
    $reqid=$_GET['user_id'];
	$status="Accepted";
	$sql="update user_request SET b_status='$status' WHERE user_id='$reqid'";
    $groupsql="select blood_type,quantity,hospital_id from user_request where user_id='$reqid'";
    $feedback="It will be available within 7 days after ".date('Y/m/d')." at the Hospital";
    $feedsql="update user_request set Results='$feedback' where user_id='$reqid'";
    mysqli_query($conn,$feedsql);
    $group=mysqli_query($conn,$groupsql);
    $res=mysqli_fetch_array($group);
    //getting necessary details from user table and updating it to the blood bank request table
    $q=$res['quantity'];
    $h=$res['hospital_id'];
    $b=$res['blood_type'];
    $frupdate="select $b from blood_requests where H_Id='$h'";
    $query=mysqli_query($conn,$frupdate);
    $cur=mysqli_fetch_array($query);
    $ans=$cur[$b]+$q;
    $updatesql="update blood_requests set $b='$ans' where H_Id='$h'";
    mysqli_query($conn,$updatesql);
    if (mysqli_query($conn, $sql)) {
	$msg="You have accepted the request.";
	header("location:../bloodrequest.php?msg=".$msg );
    } else {
    $error= "Error changing status: " . mysqli_error($conn);
    header("location:../bloodrequest.php?error=".$error );
    }
    mysqli_close($conn);
?>