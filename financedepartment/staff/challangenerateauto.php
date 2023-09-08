<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';
//------------------------SAVE--------------------------------------------------

if(isset($_POST['save'])){
    
extract($_POST);

$query123=mysqli_query($conn,"SELECT *  FROM `student_info` where pcode='$pcode' and studentstatus='Active'" );


 while($balance123=$query123->fetch_assoc())
 {
    

      $query=mysqli_query($conn,"select * from student_balance where stdcnic ='".$balance123['stdcnic']."' and regnumber ='".$balance123['regnumber']."' " );
      $balance=$query->fetch_assoc();

     $totalfee=$mfee+$otherfee;
             
     if($mfee >$balance['pcost'])
        {
            $query=mysqli_query($conn,"INSERT INTO `autochallanreport`(`autoid`, `description`, `dateandtime`, `totalchallan`, `totalrejected`, `regnumber`, `fname`, `lname`) VALUES ('','monthly fee > remaining balance (Rejected)',NOW(),'-','Rejected','".$balance123['regnumber']."','".$balance123['firstname']."','".$balance123['lastname']."')");

                        //echo "<script>alert('Fee Amount is Greater Than the Payable Amount!')</script>";
                        echo "<script>window.location = 'autochallan.php'</script>";
                         
                          
        }elseif ($otherfee >$balance['pcost']) {
            $query=mysqli_query($conn,"INSERT INTO `autochallanreport`(`autoid`, `description`, `dateandtime`, `totalchallan`, `totalrejected`, `regnumber`, `fname`, `lname`) VALUES ('','Other fee > remaining balance (Rejected)',NOW(),'-','Rejected','".$balance123['regnumber']."','".$balance123['firstname']."','".$balance123['lastname']."')");

          //  echo "<script>alert('Other Fee Amount is Greater Than the Payable Amount!')</script>";
                     echo "<script>window.location = 'autochallan.php'</script>";
                         
           
        }elseif ($totalfee>$balance['pcost']) {
            $query=mysqli_query($conn,"INSERT INTO `autochallanreport`(`autoid`, `description`, `dateandtime`, `totalchallan`, `totalrejected`, `regnumber`, `fname`, `lname`) VALUES ('','Fee+otherfee > remaining balance (Rejected)',NOW(),'-','Rejected','".$balance123['regnumber']."','".$balance123['firstname']."','".$balance123['lastname']."')");

             //echo "<script>alert('Total Amount is Greater Than the Payable Amount!')</script>";
                       echo "<script>window.location = 'autochallan.php'</script>";
             
        }else
        {
            $query=mysqli_query($conn,"select * from challan where stdcnic='".$balance123['stdcnic']."' and regnumber ='".$balance123['regnumber']."' and email ='".$balance123['email']."' and contact ='".$balance123['contact']."' and challanstatus='Pending'" );
                
                $ret=mysqli_fetch_array($query);
            
            if($ret > 0)
            {
                $query=mysqli_query($conn,"INSERT INTO `autochallanreport`(`autoid`, `description`, `dateandtime`, `totalchallan`, `totalrejected`, `regnumber`, `fname`, `lname`) VALUES ('','Already Pending Challan (Rejected)',NOW(),'-','Rejected','".$balance123['regnumber']."','".$balance123['firstname']."','".$balance123['lastname']."')");

               // echo "<script>alert('Challan Already Pending Please Search & Edit!')</script>";
                        echo "<script>window.location = 'autochallan.php'</script>";
             

            }
            else
            {
                $monthdetails= date('F, Y');
                $query=mysqli_query($conn,"INSERT INTO `challan`(`challanid`, `stdid`, `regnumber`, `firstname`, `lastname`, `stdcnic`, `contact`, `email`, `pcode`, `pname`, `duedate`, `createdon`, `fee`, `otherfee`, `month`, `creadtedby`, `challanstatus`, `approvedby`, `approvedon`,`challanremarks`) VALUES ('','".$balance123['stdid']."','".$balance123['regnumber']."','".$balance123['firstname']."','".$balance123['lastname']."','".$balance123['stdcnic']."','".$balance123['contact']."','".$balance123['email']."','".$balance123['pcode']."','".$balance123['pname']."','$duedate',NOW(),'$mfee','$otherfee','".$monthdetails."','".$_SESSION['empcode']."','Pending','-','-','$remarks')");


             $message='Challan Generated for'.' '.$balance123['regnumber'].'-'.'due date'.$duedate;
             $query1=mysqli_query($conn,"INSERT INTO `staffactivity`(`accid`, `empcode`, `empname`, `studentinfo`, `createdon`, `activity`) VALUES ('','".$_SESSION['empcode']."','". $_SESSION['firstname'].''. $_SESSION['lastname']."','".$balance123['firstname'].''.$balance123['lastname'].'-'.$balance123['regnumber']."',NOW(),'".$message."' )");

            $query=mysqli_query($conn,"INSERT INTO `autochallanreport`(`autoid`, `description`, `dateandtime`, `totalchallan`, `totalrejected`, `regnumber`, `fname`, `lname`) VALUES ('','Auto Challan Generated (Auto Gen)',NOW(),'Auto Generated','-','".$balance123['regnumber']."','".$balance123['firstname']."','".$balance123['lastname']."')");

              
                $message='';
                if($query)
                {
                // echo "<script>alert('Challan Generated Please Take Print!')</script>";
                        echo "<script>window.location = 'autochallan.php'</script>";
                }
             
            }
        }
        
             
  
 }           
}

?>