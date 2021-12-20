<?php
include "connection.php";
    $reqid=$_POST['bsample_id'];
	$sql = "delete from b_stock WHERE B_sampleid='$reqid'";
    if (mysqli_query($conn, $sql)) {
	$msg="Deletion of Blood sample id successful.";
	header("location:../admin.php?msg=".$msg );
    } else {
    $error= "Error changing status: " . mysqli_error($conn);
    header("location:../admin.php?error=".$error );
    }
    mysqli_close($conn);
?>