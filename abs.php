<?php 
session_start();
require 'file/connection.php';
if(isset($_GET['search'])){
    $searchKey = $_GET['search'];
    $sql = "select bloodinfo.*, hospitals.* from bloodinfo, hospitals where bloodinfo.hid=hospitals.id && bg LIKE '%$searchKey%'";
}else{
    $sql = "select bloodinfo.*, hospitals.* from bloodinfo, hospitals where bloodinfo.hid=hospitals.id";
}
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<?php $title="Bloodbank | Request blood sample"; ?>
<?php require 'head.php'; ?>
<body>
    <?php require 'header.php'; ?>
    <div class="container cont">
        
        <?php require 'message.php'; ?>

		     <div class="tab-content">

       <div class="tab-pane container active" id="  ">

        <form action="addrequest.php" method="post" enctype="form-data">
		  <select name="rbg" class="form-control mb-3" required>
                <option disabled="" selected="">Blood Group</option>
                <option value="A_p">A+</option>
                <option value="A_n">A-</option>
                <option value="B_p">B+</option>
                <option value="B_n">B-</option>
                <option value="AB_p">AB+</option>
                <option value="AB_n">AB-</option>
                <option value="O_p">O+</option>
                <option value="O_n">O-</option>
          </select>
          <input type="number" min="1" max="50" name="blood_bags" placeholder="no of blood bags" class="form-control mb-3" required>
          <input type="number" name="hid" placeholder="hospital id" class="form-control mb-3" required>
          <input type="number" name="userid" placeholder="user id" class="form-control mb-3" required>
		  <a href="addrequest.php" class="btn btn-info mr-4"> Reset</a>
			   <input type="submit" name="donate" class="btn btn-info" value="Donate Sample">
        </form>

    </div>
    <?php require 'footer.php' ?>
</body>

<script type="text/javascript">
    $('.hospital').on('click', function(){
        alert("Hospital user can't request for blood.");
    });
</script>