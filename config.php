<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "projectdb";

$conn = mysqli_connect($server, $user, $pass, $database);
?>
<?php
if ($conn) {
    ?>
    <script>alert(<?php echo "Connected"; ?>)</script>
<?php
}
?>


