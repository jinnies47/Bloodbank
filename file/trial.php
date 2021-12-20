<?php
require 'connection.php';
 $sql2="select max(serial_no) from hospital_b_data";
 $res=mysqli_query($conn, $sql2);
 $r=mysqli_fetch_array($res);
 echo $r['max(serial_no)'];
?>