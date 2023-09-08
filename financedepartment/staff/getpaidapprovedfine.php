<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';
	
	if(ISSET($_GET['fineid'])){
		extract($_GET);
		 
		      $query90=mysqli_query($conn,"select * from fine where fineid='$fineid'");
		      $getdetails=$query90->fetch_assoc();

          
         $query16=mysqli_query($conn,"update  fine set challanstatus='Paid', approvedby='".$_SESSION['empcode'].'-'. $_SESSION['firstname'].''. $_SESSION['lastname']."',approvedon=NOW() where fineid='$fineid'");
         $message='fine Paid Amount='.$totalfine.'Approved Against Fine ID='.$fineid.'Fine Reason'.' '.$finetype;


        $query4=mysqli_query($conn,"INSERT INTO `studentfinelagers`(`stdfinelagerid`, `firstname`, `lastname`, `regnumber`, `stdcnic`, `contact`, `email`, `pcode`, `pname`, `description`, `creadedby`, `creadtedon`, `paid`, `outbalance`) VALUES ('','".$getdetails['firstname']."','".$getdetails['lastname']."','".$getdetails['regnumber']."','".$getdetails['stdcnic']."','".$getdetails['contact']."','".$getdetails['email']."','".$getdetails['pcode']."','".$getdetails['pname']."','".$message."','".$_SESSION['empcode'].'-'. $_SESSION['firstname'].''. $_SESSION['lastname']."',NOW(),'".$totalfine."','".$totalfine."')");


          $query1=mysqli_query($conn,"INSERT INTO `staffactivity`(`accid`, `empcode`, `empname`, `studentinfo`, `createdon`, `activity`) VALUES ('','".$_SESSION['empcode']."','". $_SESSION['firstname'].''. $_SESSION['lastname']."','".$getdetails['firstname'].''.$getdetails['lastname'].'-'.$getdetails['regnumber']."',NOW(),'".$message."' )");


        $query21=mysqli_query($conn,"select * from universityaccount");
        $result=$query21->fetch_assoc();
        $totalbalancamountuniversity=$result['ubalance']+$totalfine;


        $query25=mysqli_query($conn,"INSERT INTO `universityaccountlager`(`unilagerid`, `firstname`, `lastname`, `regnumber`, `stdcnic`, `contact`, `email`, `pcode`, `pname`, `description`, `creadedby`, `creadtedon`, `issueamount`, `recamount`, `balance`) VALUES ('','".$getdetails['firstname']."','".$getdetails['lastname']."','".$getdetails['regnumber']."','".$getdetails['stdcnic']."','".$getdetails['contact']."','".$getdetails['email']."','".$getdetails['pcode']."','".$getdetails['pname']."','".$message."','".$_SESSION['empcode'].'-'. $_SESSION['firstname'].''. $_SESSION['lastname']."',NOW(),'-','".$totalfine."','".$totalbalancamountuniversity."')");

        $query6=mysqli_query($conn,"update universityaccount set ubalance='".$totalbalancamountuniversity."' where uaccid='".$result['uaccid']."'");


		$totalbalancamountuniversity=0;


      if($query25 && $query6 )
      {
      	echo "<script>alert('Successfully Paid!')</script>";
		echo "<script>window.location = 'unpaidfine.php'</script>";
	
	}else
	{
		echo "<script>alert('Erro!')</script>";
		echo "<script>window.location = 'unpaidfine.php'</script>";
	}






		}
?>