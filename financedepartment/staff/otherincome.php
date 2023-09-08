<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';
	
	if(ISSET($_POST['save'])){
		extract($_POST);
		$query15=mysqli_query($conn,"INSERT INTO `otherincomes`(`oiid`, `purposeofpayment`, `dateofpayment`, `description`, `amount`, `createdby`, `createdon`) VALUES ('','$typeofpayment','$dateofpayment','$description','$totalamount','".$_SESSION['empcode'].'-'. $_SESSION['firstname'].''. $_SESSION['lastname']."',NOW())");


		  $message='Total Other Income='.$totalamount.'Added to the College Account by Staff'.$_SESSION['empcode'].'-'. $_SESSION['firstname'].''. $_SESSION['lastname'];
 
        $query1=mysqli_query($conn,"INSERT INTO `staffactivity`(`accid`, `empcode`, `empname`, `studentinfo`, `createdon`, `activity`) VALUES ('','".$_SESSION['empcode']."','". $_SESSION['firstname'].''. $_SESSION['lastname']."','Account Added To Main Account Other income',NOW(),'".$message."' )");
	    $query21=mysqli_query($conn,"select * from universityaccount");
        $result=$query21->fetch_assoc();
        $totalbalancamountuniversity=$result['ubalance']+$totalamount;


        $query25=mysqli_query($conn,"INSERT INTO `universityaccountlager`(`unilagerid`, `firstname`, `lastname`, `regnumber`, `stdcnic`, `contact`, `email`, `pcode`, `pname`, `description`, `creadedby`, `creadtedon`, `issueamount`, `recamount`, `balance`) VALUES ('','other','income','oi40985','$typeofpayment','$dateofpayment','".$message."','-','-','$description','".$_SESSION['empcode'].'-'. $_SESSION['firstname'].''. $_SESSION['lastname']."',NOW(),'-','".$totalamount."','".$totalbalancamountuniversity."')");

        	  $query6=mysqli_query($conn,"update universityaccount set ubalance='".$totalbalancamountuniversity."' where uaccid='".$result['uaccid']."'");
		$totalbalancamountuniversity=0;
      if($query25 && $query6 )
      {
      	echo "<script>alert('Successfully Paid!')</script>";
		echo "<script>window.location = 'otherchallan.php'</script>";
	
	}else
	{
		echo "<script>alert('Erro!')</script>";
		echo "<script>window.location = 'otherchallan.php'</script>";
	}
}
?>