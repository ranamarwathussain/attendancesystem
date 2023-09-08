<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'ncludes/session.php';
if(isset($_POST['save']))
{
    extract($_POST);
    $admissionNo=$_POST['admissionNo'];
    $N=0;
    $check=$_POST['check'];
    $N = count($admissionNo);
    $status = "";
    $sessionyear= strftime("%Y", time());
    //$dateTaken = date("Y-m-d");
$taken=0;
//check if the attendance has not been taken i.e if no record has a status of 1
  $qurty=mysqli_query($conn,"select * from tblattendance  where classId = '$classId' and classArmId = '$classArmId' and dateTimeTaken='$dateTaken' and status = '1'");
  $count = mysqli_num_rows($qurty);

  if($count > 0){

      $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>Attendance has been taken for today!</div>";

  }

    else //update the status to 1 for the checkboxes checked
    {

        for($i = 0; $i < $N; $i++)
        {
                $admissionNo[$i]; //admission Number

                if(isset($check[$i])) //the checked checkboxes
                {
                      $qquery=mysqli_query($conn,"update tblattendance set status='1' where admissionNo= '$check[$i]' AND classId='$classId' AND classArmId='$classArmId' and sessionTermId='$sessionyear' and tid='$_SESSION[userId]' and dateTimeTaken='$dateTaken';");
                  $taken=1;   
                  
                }
          }
          if ($taken==1) {

                          $statusMsg = "<div class='alert alert-success'  style='margin-right:700px;'>Attendance Taken Successfully!</div>";
                          $taken=0;                      }
                      
      }







   

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/attnlg.jpg" rel="icon">
  <title>Dashboard</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">



   <script>
    function classArmDropdown(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxClassArms2.php?cid="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
      <?php include "Includes/sidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
       <?php include "Includes/topbar.php";?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Take Attendance (Today's Date : <?php echo $todaysDate = date("m-d-Y");?>)</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">All Student in Class</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
 <div class="card-body">
                  <form method="POST">
                   <div class="col-lg-12">
                       <div class="col-xl-6">
                        <label class="form-control-label">Select Date<span class="text-danger ml-2">*</span></label>
                            <input type="date" class="form-control" name="dateTaken" id="exampleInputFirstName" placeholder="Class Arm Name">
                        </div>
                      
                        <label class="form-control-label">Select Class<span class="text-danger ml-2">*</span></label>
                         <?php
                         $sessionyear= strftime("%Y", time());
                        $qry= "SELECT * FROM assignteacherclass where sessionyear='$sessionyear' ORDER BY tclassid ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;   
                        if ($num > 0){
                          echo ' <select required name="sectionId" onchange="classArmDropdown(this.value)" class="form-control mb-3">';
                          echo'<option value="">--Select Class--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['tclasssectionid'].'" >'.$rows['tclass'].'('.$rows['tclasssection'].')'.'</option>';
                              }
                                 echo '</select>';
                            }
                           ?>  
                         </div>
                       </div>
                        <button type="submit" name="getstudent" class="btn btn-primary">Get Students</button>
                     </form>
                   </div></h6>

              <!-- Input Group -->
        <form method="POST">
            <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">

                  <h6 class="m-0 font-weight-bold text-danger">Note: <i>Click on the checkboxes besides each student to take attendance. keep Uncheck for Absent!</i></h6>
                </div>
                <div class="table-responsive p-3">
                <?php echo $statusMsg; ?>
                  <table class="table align-items-center table-flush table-hover">
                    <thead class="thead-light">
                     <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Admission No</th>
                        <th>Class Name</th>
                        <th>Section</th>
                        <th>Session Year</th>
                        <th>Attendance</th>
                      </tr>
                    </thead>
                    
                    <tbody>



                  <?php
                  if(isset($_POST['getstudent']))
                  {
                    extract($_POST);
                    //////////////////
                    $sessionyear= strftime("%Y", time());
                      //$dateTaken = date("Y-m-d");
                  $q1="select * from tblclassarms where Id='$sectionId';";
                  $r1=$conn->query($q1);
                  $result1=$r1->fetch_assoc();

                  ////////////////////////
                  //check if the attendance has not been taken i.e if no record has a status of 1
                    $qurty=mysqli_query($conn,"select * from tblattendance  where classId = '".$result1['classId']."' and classArmId = '$sectionId' and dateTimeTaken='$dateTaken';");
                    $count = mysqli_num_rows($qurty);
                     if($count>0)
                    {
                      }
                      else
                      {

$query = "select * from studentenroll where classArmId='$sectionId' AND sessionyear='$sessionyear';";
                       $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      {
                        while ($rows = $rs->fetch_assoc())
                          {
                            $qquery=mysqli_query($conn,"insert into tblattendance(firstName,lastName,admissionNo,classId,classArmId,sessionTermId,tid,status,dateTimeTaken) 
                             value('".$rows['firstName']."','".$rows['lastName']."','".$rows['admissionNumber']."','".$rows['classId']."','".$rows['classArmId']."','$sessionyear','$_SESSION[userId]','0','$dateTaken')");

                          }

                      }

}
                       

                    



                    //////////////
                      $query = "select * from studentenroll where classArmId='$sectionId' AND sessionyear='$sessionyear';";
                       $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                             $sn = $sn + 1;
                            echo"
                              <tr>
                                <td>".$sn."</td>
                                <td>".$rows['firstName']."</td>
                                <td>".$rows['lastName']."</td>
                                <td>".$rows['admissionNumber']."</td>
                                <td>".$rows['className']."</td>
                                <td>".$rows['section']."</td>
                                <td>".$rows['sessionyear']."</td>
                              <td><input name='check[]' type='checkbox' value=".$rows['admissionNumber']." class='form-control'></td>
                              
                              </tr>";
                              echo "<input name='admissionNo[]' value=".$rows['admissionNumber']." type='hidden' class='form-control'>";
                               echo "<input name='classId' value=".$rows['classId']." type='hidden' class='form-control'>";
                                echo "<input name='classArmId' value=".$rows['classArmId']." type='hidden' class='form-control'>";
                                echo "<input name='fn[]' value=".$rows['firstName']." type='hidden' class='form-control'>";
                                echo "<input name='ln[]' value=".$rows['lastName']." type='hidden' class='form-control'>";
                                echo "<input name='dateTaken' value=".$dateTaken." type='hidden' class='form-control'>";
                         
                          }
                      }
                      else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }
                    }

                      
                      ?>
                    </tbody>
                  </table>
                  <br>
                  <button type="submit" name="save" class="btn btn-primary">Take Attendance</button>
                  </form>
                </div>
              </div>
            </div>
            </div>
          </div>
          <!--Row-->

          <!-- Documentation Link -->
          <!-- <div class="row">
            <div class="col-lg-12 text-center">
              <p>For more documentations you can visit<a href="https://getbootstrap.com/docs/4.3/components/forms/"
                  target="_blank">
                  bootstrap forms documentations.</a> and <a
                  href="https://getbootstrap.com/docs/4.3/components/input-group/" target="_blank">bootstrap input
                  groups documentations</a></p>
            </div>
          </div> -->

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
       <?php include "Includes/footer.php";?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
   <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
</body>

</html>