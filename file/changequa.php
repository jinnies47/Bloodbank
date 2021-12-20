<?php
include "connection.php";
    $val=$_POST['quantity'];
    $b=$_POST['Blood_type'];
    $s=$_POST['section'];
    $id=$_POST['H_id'];
    if($s=='Requested')
    {
        $sql2="update hospital_b_data set b_status='$s' where Hospital_id='$id' and Blood_Group='$b'";
        mysqli_query($conn, $sql2);
    }
    $sql="update hospital_b_data set $s='$val' where Blood_Group='$b' and Hospital_id='$id'";
    if (mysqli_query($conn, $sql)) {
	$msg="You have changed the quantity.";
	header("location:../bloodrequest.php?msg=".$msg );
    } else {
    $error= "Error changing status: " . mysqli_error($conn);
    echo $error;
    header("location:../bloodrequest.php?error=".$error );
    }
    mysqli_close($conn);
?>