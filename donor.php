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

       <div class="tab-pane container active" id="u       ">

        <form action="donor_info.php" method="post" enctype="form-data">
          <input type="number" name="fname" min="100" placeholder="User ID" class="form-control mb-3" required >
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
          <input type="number" min="18" name="Age" placeholder="Age" class="form-control mb-3" >
          <label>Last Donation Date</label>
          <input type="date" name="last_donation_date" placeholder="last donation date" class="form-control mb-3" required>
          <input type="number" min="24" name="weight" placeholder="weight in kg" class="form-control mb-3" required >
		  <a href="donor.php" class="btn btn-info mr-4"> Reset</a>
			   <input type="submit" name="donate" class="btn btn-info" value="Donate Sample">
        </form>

       </div>
        </div>
    </div>
    <?php require 'footer.php' ?>
</body>
