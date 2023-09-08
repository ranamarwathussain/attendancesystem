<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';
	
	if(ISSET($_POST['update'])){
		extract($_POST);
        
		
		mysqli_query($conn, "update `student_info` set   address='$address',studentstatus='$studentstatus'  where stdid='$stdid'") or die(mysqli_error());

		
      $query1=mysqli_query($conn,"INSERT INTO `staffactivity`(`accid`, `empcode`, `empname`, `studentinfo`, `createdon`, `activity`) VALUES ('','".$_SESSION['empcode']."','". $_SESSION['firstname'].''. $_SESSION['lastname']."','".$fname.''.$lname.'-'.$regnumber."',NOW(),'Updated Student Address & Status' )");
		
	echo "<script>alert('Successfully updated!')</script>";
		echo "<script>window.location = 'addstudent.php'</script>";
	}
?>