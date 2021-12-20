<?php
include "connection.php";
    $reqid=$_GET['serial_no'];
    $updatesql="select Current_stock,Requested from hospital_b_data where serial_no='$reqid'";
    $result=mysqli_query($conn, $updatesql);
    $result=mysqli_fetch_array($result);
    $stock=$result['Current_stock'];
    $quant=$stock+$result['Requested'];
    $updatesql="update hospital_b_data set Current_stock='$quant' where serial_no='$reqid'";
    mysqli_query($conn, $updatesql);
    $updatesql="update hospital_b_data set Requested='0' where serial_no='$reqid'";
    mysqli_query($conn, $updatesql);
    $sql="update hospital_b_data set b_status='Accepted' where serial_no='$reqid'";
    if (mysqli_query($conn, $sql)) {
	$msg="You have Updated the table.";
	header("location:../admin.php?msg=".$msg );
    } else {
    $error= "Error changing status: " . mysqli_error($conn);
    header("location:../admin.php?error=".$error );
    }
    mysqli_close($conn);
?>