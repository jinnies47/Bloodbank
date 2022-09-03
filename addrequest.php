<?php
include "./file/connection.php";
    $reqid=$_POST['userid'];
	$sql = "select * from user_request where user_id='$reqid'";
	$rbg=$_POST['rbg'];
	$blood_bags=$_POST['blood_bags'];
	$hid=$_POST['hid']; 
    $result=mysqli_query($conn,$sql);
    $row=mysqli_num_rows($result);
    if($row==0)
    {
        $sql="INSERT INTO user_request(user_id,hospital_id,blood_type,b_status,quantity,Results)
        VALUES ('$reqid','$hid','$rbg', 'Requested','$blood_bags','Pending')";
        mysqli_query($conn, $sql);
	$msg="You have added request for the blood.";
	header("location:./sentrequest.php?msg=".$msg );
    } else {
    $error="You cannot make more than 1 request: " . mysqli_error($conn);
    header("location:./abs.php?error=".$error );
    }

    mysqli_close($conn);
?>
