<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'ncludes/session.php';
if ($_GET['action'] == "delete")
	{
        $Id= $_GET['Id'];
        $classArmId= $_GET['classArmId'];

        $query = mysqli_query($conn,"DELETE FROM assignteacherclass WHERE assignid=$Id");

        if ($query == TRUE) 
        {

           
                  echo '<script>alert("Assignmane Cancelled!")
                  ;window.location.href = "assign.php";</script>';

 
            }
        
        else{

            echo '<script>alert("An error Occurred!")
            ;
            window.location.href = "assign.php";</script>';
         }
      
  }


?>