<?php
include "connection.php";
    $reqid=$_GET['user_id'];
	$status = "Rejected";
	$sql = "update user_request SET b_status='$status' WHERE user_id='$reqid'";
    $feedback="Sorry It is not available Please try after a few days again ";
    $feedsql="update user_request set Results='$feedback' where user_id='$reqid'";
    mysqli_query($conn,$feedsql);
    if (mysqli_query($conn, $sql)) {
	$msg="You have Rejected the request.";
	header("location:../bloodrequest.php?msg=".$msg );
    } else {
    $error= "Error changing status: " . mysqli_error($conn);
    header("location:../bloodrequest.php?error=".$error );
    }
    mysqli_close($conn);
?>