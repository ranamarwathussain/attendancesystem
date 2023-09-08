<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';
//------------------------SAVE--------------------------------------------------

if(isset($_POST['save'])){
    
                extract($_POST);

      $query=mysqli_query($conn,"select * from student_balance where stdcnic ='$stdcnic' and regnumber ='$regnumber' " );
      $balance=$query->fetch_assoc();

     $totalfee=$mfee+$otherfee;
             
     if($mfee >$balance['pcost'])
        {
                        echo "<script>alert('Fee Amount is Greater Than the Payable Amount!')</script>";
                        echo "<script>window.location = 'getchallan.php'</script>";
                         
                          
        }elseif ($otherfee >$balance['pcost']) {
            echo "<script>alert('Other Fee Amount is Greater Than the Payable Amount!')</script>";
                        echo "<script>window.location = 'getchallan.php'</script>";
                         
           
        }elseif ($totalfee>$balance['pcost']) {
             echo "<script>alert('Total Amount is Greater Than the Payable Amount!')</script>";
                        echo "<script>window.location = 'getchallan.php'</script>";
             
        }else
        {
            $query=mysqli_query($conn,"select * from challan where stdcnic ='$stdcnic' and regnumber ='$regnumber' and email ='$email' and contact ='$contact' and challanstatus='Pending'" );
                
                $ret=mysqli_fetch_array($query);
            
            if($ret > 0)
            {
                echo "<script>alert('Challan Already Pending Please Search & Edit!')</script>";
                        echo "<script>window.location = 'getchallan.php'</script>";
             

            }
            else
            {
                $monthdetails= date('F, Y');
                $query=mysqli_query($conn,"INSERT INTO `challan`(`challanid`, `stdid`, `regnumber`, `firstname`, `lastname`, `stdcnic`, `contact`, `email`, `pcode`, `pname`, `duedate`, `createdon`, `fee`, `otherfee`, `month`, `creadtedby`, `challanstatus`, `approvedby`, `approvedon`,`challanremarks`) VALUES ('','$stdid','$regnumber','$fname','$lname','$stdcnic','$contact','$email','$pcode','$pname','$duedate',NOW(),'$mfee','$otherfee','".$monthdetails."','".$_SESSION['empcode']."','Pending','-','-','$remarks')");

             $message='Challan Generated for'.' '.$regnumber.'-'.'due date'.$duedate;
             $query1=mysqli_query($conn,"INSERT INTO `staffactivity`(`accid`, `empcode`, `empname`, `studentinfo`, `createdon`, `activity`) VALUES ('','".$_SESSION['empcode']."','". $_SESSION['firstname'].''. $_SESSION['lastname']."','".$fname.''.$lname.'-'.$regnumber."',NOW(),'".$message."' )");

              
                $message='';
                if($query)
                {
                 echo "<script>alert('Challan Generated Please Take Print!')</script>";
                        echo "<script>window.location = 'getchallan.php'</script>";
                }
             
            }
        }
        
             
}

?>