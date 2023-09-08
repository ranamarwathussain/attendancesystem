<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';
	
	if(ISSET($_GET['regnumber'])){
		extract($_GET);

		$query90=mysqli_query($conn,"select * from challan where challanid='$challanid'");
		$getdetails=$query90->fetch_assoc();
		
		 $query1=mysqli_query($conn,"select * from  student_balance where regnumber='$regnumber'");
         $getdetails=$query1->fetch_assoc();
         $totalbalanc=$getdetails['pcost']-$totalfeeamount;

         $query6=mysqli_query($conn," update student_balance set pcost='".$totalbalanc."' where regnumber='$regnumber' and stdcnic='$stdcnic'");
         $query16=mysqli_query($conn,"update  challan set challanstatus='Paid', approvedby='".$_SESSION['empcode'].'-'. $_SESSION['firstname'].''. $_SESSION['lastname']."',approvedon=NOW() where challanid='$challanid'");
         $message='Challan Paid Amount='.$totalfeeamount.'Approved Against Challan ID='.$challanid.''.'Challan Remarks '.$remarks;


        $query4=mysqli_query($conn,"INSERT INTO `studentlagers`(`stdlagerid`, `firstname`, `lastname`, `regnumber`, `stdcnic`, `contact`, `email`, `pcode`, `pname`, `description`, `creadedby`, `creadtedon`, `paid`, `outbalance`) VALUES ('','$fname','$lname','$regnumber','$stdcnic','$contact','$email','$pcode','$pname','".$message."','".$_SESSION['empcode'].'-'. $_SESSION['firstname'].''. $_SESSION['lastname']."',NOW(),'$totalfeeamount','".$totalbalanc."')");
        $totalbalanc=0;

        $message='Fee Paid Amount='.$totalfeeamount.'Approved Against challan ID='.$challanid.' '.' Challan Remarks '.$remarks;

        $query1=mysqli_query($conn,"INSERT INTO `staffactivity`(`accid`, `empcode`, `empname`, `studentinfo`, `createdon`, `activity`) VALUES ('','".$_SESSION['empcode']."','". $_SESSION['firstname'].''. $_SESSION['lastname']."','".$fname.''.$lname.'-'.$regnumber."',NOW(),'".$message."' )");

        $query21=mysqli_query($conn,"select * from universityaccount");
        $result=$query21->fetch_assoc();
        $totalbalancamountuniversity=$result['ubalance']+$totalfeeamount;
        
        $query25=mysqli_query($conn,"INSERT INTO `universityaccountlager`(`unilagerid`, `firstname`, `lastname`, `regnumber`, `stdcnic`, `contact`, `email`, `pcode`, `pname`, `description`, `creadedby`, `creadtedon`, `issueamount`, `recamount`, `balance`) VALUES ('','$fname','$lname','$regnumber','$stdcnic','$contact','$email','$pcode','$pname','".$message."','".$_SESSION['empcode'].'-'. $_SESSION['firstname'].''. $_SESSION['lastname']."',NOW(),'-','".$totalfeeamount."','".$totalbalancamountuniversity."')");

        	  $query6=mysqli_query($conn,"update universityaccount set ubalance='".$totalbalancamountuniversity."' where uaccid='".$result['uaccid']."'");
		$totalbalancamountuniversity=0;
      if($query25 && $query6 )
      {
      	echo "<script>alert('Successfully Paid!')</script>";
		echo "<script>window.location = 'unpaidchallan.php'</script>";
	
	}else
	{
		echo "<script>alert('Erro!')</script>";
		echo "<script>window.location = 'unpaidchallan.php'</script>";
	}
}
?>