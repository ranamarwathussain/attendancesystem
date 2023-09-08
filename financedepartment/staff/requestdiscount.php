<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';
//------------------------SAVE--------------------------------------------------

if(isset($_POST['save'])){
    
                extract($_POST);
     if($discounttype=='Admission')
        {


            $query=mysqli_query($conn,"select * from student_discounts where stdcnic ='$stdcnic' and regnumber ='$regnumber' and email ='$email' and contact ='$contact' and remarks='Admission'" );
                
                $ret=mysqli_fetch_array($query);
             
                if($ret > 0){ 
                  
                    echo "<script>alert('Discount on Admission Can Avail only once!')</script>";
                        echo "<script>window.location = 'studentadmissoinfeediscount.php'</script>";
                         
                           }else
                           {

                            

                if($dispercent>=0 && $dispercent<=100)
                {
                 $query=mysqli_query($conn,"select * from student_discounts where stdcnic ='$stdcnic' and regnumber ='$regnumber' and email ='$email' and contact ='$contact' and discountstatus='Pending'" );
                
                $ret=mysqli_fetch_array($query);
             
                if($ret > 0){ 
                  $statusMsg = "<div id='moo' class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show' auto-close='2000'>Discount Request Is Pending Please Wait for Approval !<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><i class='fas fa-skull-crossbones' style='font-size:24px'></i></button></div>";
                    echo "<script>alert('Discount Request Is Pending Please Wait for Approval !')</script>";
                        echo "<script>window.location = 'studentadmissoinfeediscount.php'</script>";
                         
                }
                else{
                     $totaldiscount=0;
                    if($discounttype=='Admission'){
                        $totaldiscount=($padmission/100)*$dispercent;
                    }elseif ($discounttype=='Tuitionfee') {
                        $totaldiscount=($pcost/100)*$dispercent;
                         
                    }
                        
               $query=mysqli_query($conn,"INSERT INTO `student_discounts`(`discountid`, `firstname`, `lastname`, `regnumber`, `stdcnic`, `contact`, `email`, `pcode`, `pname`, `discountamount`, `remarks`, `discountstatus`, `createdby`, `createdon`, `approvedby`, `approvedon`) VALUES ('','$fname','$lname','$regnumber','$stdcnic','$contact','$email','$pcode','$pname','".$totaldiscount."','$discounttype','Pending','".$_SESSION['empcode'].'-'. $_SESSION['firstname'].''. $_SESSION['lastname']."',NOW(),'0','0')");
            $message='Requested For Discount for'.' '.$discounttype;
              $query1=mysqli_query($conn,"INSERT INTO `staffactivity`(`accid`, `empcode`, `empname`, `studentinfo`, `createdon`, `activity`) VALUES ('','".$_SESSION['empcode']."','". $_SESSION['firstname'].''. $_SESSION['lastname']."','".$fname.''.$lname.'-'.$regnumber."',NOW(),'".$message."' )");

                $totaldiscount=0;
                $message='';

                if ($query) {
                    
                     $statusMsg = "<div id='moo' class='alert alert-success bg-success  text-light border-0 alert-dismissible fade show' auto-close='2000'>Created Successfully! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><i class='far fa-hand-point-up' style='font-size:24px'></i></button></div>";
                        echo "<script>alert('Successfully Requested!')</script>";
                        echo "<script>window.location = 'studentadmissoinfeediscount.php'</script>";
                             
                        
                        }
                        else
                        {
                           $statusMsg = "<div id='moo' class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show' auto-close='2000'>An error Occurred! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><i class='fas fa-skull-crossbones' style='font-size:24px'></i></button></div>";
                            echo "<script>alert('Error Occour!')</script>";
                        echo "<script>window.location = 'studentadmissoinfeediscount.php'</script>";
                            
                           
                        }
                 
               }
            }else
            {
                echo "<script>alert('Error Occour Percentage Should be between 0-100!')</script>";
                        echo "<script>window.location = 'studentadmissoinfeediscount.php'</script>";
                            

            }
                           }
        }
        else
        {

                if($dispercent>=0 && $dispercent<=100)
                {
                 $query=mysqli_query($conn,"select * from student_discounts where stdcnic ='$stdcnic' and regnumber ='$regnumber' and email ='$email' and contact ='$contact' and discountstatus='Pending'" );
                
                $ret=mysqli_fetch_array($query);
             
                if($ret > 0){ 
                  $statusMsg = "<div id='moo' class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show' auto-close='2000'>Discount Request Is Pending Please Wait for Approval !<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><i class='fas fa-skull-crossbones' style='font-size:24px'></i></button></div>";
                    echo "<script>alert('Discount Request Is Pending Please Wait for Approval !')</script>";
                        echo "<script>window.location = 'studentadmissoinfeediscount.php'</script>";
                         
                }
                else{
                     $totaldiscount=0;
                    if($discounttype=='Admission'){
                        $totaldiscount=($padmission/100)*$dispercent;
                    }elseif ($discounttype=='Tuitionfee') {
                        $totaldiscount=($pcost/100)*$dispercent;
                         
                    }
                        
               $query=mysqli_query($conn,"INSERT INTO `student_discounts`(`discountid`, `firstname`, `lastname`, `regnumber`, `stdcnic`, `contact`, `email`, `pcode`, `pname`, `discountamount`, `remarks`, `discountstatus`, `createdby`, `createdon`, `approvedby`, `approvedon`) VALUES ('','$fname','$lname','$regnumber','$stdcnic','$contact','$email','$pcode','$pname','".$totaldiscount."','$discounttype','Pending','".$_SESSION['empcode'].'-'. $_SESSION['firstname'].''. $_SESSION['lastname']."',NOW(),'0','0')");
            $message='Requested For Discount for'.' '.$discounttype;
              $query1=mysqli_query($conn,"INSERT INTO `staffactivity`(`accid`, `empcode`, `empname`, `studentinfo`, `createdon`, `activity`) VALUES ('','".$_SESSION['empcode']."','". $_SESSION['firstname'].''. $_SESSION['lastname']."','".$fname.''.$lname.'-'.$regnumber."',NOW(),'".$message."' )");

                $totaldiscount=0;
                $message='';

                if ($query) {
                    
                     $statusMsg = "<div id='moo' class='alert alert-success bg-success  text-light border-0 alert-dismissible fade show' auto-close='2000'>Created Successfully! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><i class='far fa-hand-point-up' style='font-size:24px'></i></button></div>";
                        echo "<script>alert('Successfully Requested!')</script>";
                        echo "<script>window.location = 'studentadmissoinfeediscount.php'</script>";
                             
                        
                        }
                        else
                        {
                           $statusMsg = "<div id='moo' class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show' auto-close='2000'>An error Occurred! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><i class='fas fa-skull-crossbones' style='font-size:24px'></i></button></div>";
                            echo "<script>alert('Error Occour!')</script>";
                        echo "<script>window.location = 'studentadmissoinfeediscount.php'</script>";
                            
                           
                        }
                 
               }
            }else
            {
                echo "<script>alert('Error Occour Percentage Should be between 0-100!')</script>";
                        echo "<script>window.location = 'studentadmissoinfeediscount.php'</script>";
                            

            }
    }
             
}

?>