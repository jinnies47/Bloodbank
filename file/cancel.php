<?php
include "connection.php";
    $reqid=$_GET['user_id'];
	$sql = "delete from user_request where user_id='$reqid'";
	if (mysqli_query($conn, $sql)) {
	$msg="You have cancelled request for the blood.";
	header("location:../sentrequest.php?msg=".$msg );
    } else {
    $error="Error deleting record: " . mysqli_error($conn);
    header("location:../sentrequest.php?error=".$error );
    }
    mysqli_close($conn);
?>