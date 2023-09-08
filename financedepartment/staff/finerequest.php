<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';
//------------------------SAVE--------------------------------------------------

if(isset($_POST['save'])){
    
                extract($_POST);
        $monthdetails= date('F, Y');
        $query=mysqli_query($conn,"INSERT INTO `fine`(`fineid`, `stdid`, `regnumber`, `firstname`, `lastname`, `stdcnic`, `contact`, `email`, `pcode`, `pname`, `duedate`, `createdon`, `fee`, `finetype`, `month`, `creadtedby`, `challanstatus`,`approvedby`, `approvedon`) VALUES ('','$stdid','$regnumber','$fname','$lname','$stdcnic','$contact','$email','$pcode','$pname','$duedate',NOW(),'$fineamount','$finetype','".$monthdetails."','".$_SESSION['empcode']."','Pending','-','-')");



             $message='Fine Generated for'.' '.$regnumber.'-'.'due date'.$duedate;
             
             $query1=mysqli_query($conn,"INSERT INTO `staffactivity`(`accid`, `empcode`, `empname`, `studentinfo`, `createdon`, `activity`) VALUES ('','".$_SESSION['empcode']."','". $_SESSION['firstname'].''. $_SESSION['lastname']."','".$fname.''.$lname.'-'.$regnumber."',NOW(),'".$message."' )");

              
                $message='';
                if($query)
                {

                 echo "<script>alert('fine voucher Please Take Print!')</script>";
                        echo "<script>window.location = 'getfincechallan.php'</script>";
                }
                else
                {
                    echo "<script>alert('Error!')</script>";
                        echo "<script>window.location = 'getfincechallan.php'</script>";
                

                }
             
            }
        
        
             


?>