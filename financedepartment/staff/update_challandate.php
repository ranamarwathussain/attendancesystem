<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';
	
	if(ISSET($_POST['update'])){
		extract($_POST);
        
		
		mysqli_query($conn, "update `challan` set   duedate='$duedate',fee='$fee',otherfee='$otherfee'  where challanid='$challanid'") or die(mysqli_error());

	$tfee=$fee+$otherfee;
      $message='Updated Duedat and fee amount='.$tfee.' of Fee Challan fee challan number='.$challanid;
		
      $query1=mysqli_query($conn,"INSERT INTO `staffactivity`(`accid`, `empcode`, `empname`, `studentinfo`, `createdon`, `activity`) VALUES ('','".$_SESSION['empcode']."','". $_SESSION['firstname'].''. $_SESSION['lastname']."','".$fname.''.$lname.'-'.$regnumber."',NOW(),'".$message."' )");
		
	echo "<script>alert('Successfully updated!')</script>";
		echo "<script>window.location = 'getchallan.php'</script>";
	}
?>