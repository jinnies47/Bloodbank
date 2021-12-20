<?php
include "connection.php";
    $reqid=$_GET['user_id'];
	$sql = "delete from user_donate where user_id='$reqid'";
	if (mysqli_query($conn, $sql)) {
	$msg="You have cancelled the donation request.";
	header("location:../donor.php?msg=".$msg );
    } else {
    $error="Error deleting record: " . mysqli_error($conn);
    header("location:../dono_info.php?error=".$error );
    }
    mysqli_close($conn);
?>