<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';
	
	if(ISSET($_POST['update'])){
		extract($_POST);

        
		
		mysqli_query($conn, "update fine set   duedate='$duedate'  where fineid='$fineid'") or die(mysqli_error());
		$message='Updated Duedat of Fine Challan fine voucher number='.$fineid;
		
      $query1=mysqli_query($conn,"INSERT INTO `staffactivity`(`accid`, `empcode`, `empname`, `studentinfo`, `createdon`, `activity`) VALUES ('','".$_SESSION['empcode']."','". $_SESSION['firstname'].''. $_SESSION['lastname']."','".$fname.''.$lname.'-'.$regnumber."',NOW(),'".$message."' )");
		
	    echo "<script>alert('Successfully updated!')</script>";
		echo "<script>window.location = 'getfincechallan.php'</script>";
	}
?>