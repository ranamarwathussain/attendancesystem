<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'ncludes/session.php';

//------------------------SAVE--------------------------------------------------

if(isset($_POST['save'])){
   
   extract($_POST);
$sessionyear= strftime("%Y", time());

   $dateCreated = date("Y-m-d");
   $query1="select * from studentenroll where  admissionNumber='$stdid' AND classId='$classId'";
  $result=$conn->query($query1);

if(mysqli_num_rows($result)>0)
{
  $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>Student Already Enrolled In The Class/Section!</div>";
           
}
else
{ 
          $getstudent="select * from student_info where stdid='$stdid'";
          $result=$conn->query($getstudent);
          $student=$result->fetch_assoc();

        /////////////////////////////////

          $getclass="select * from program where pid=$classId";
          $result=$conn->query($getclass);
          $class=$result->fetch_assoc();
         

          /////////////////////////////////
          $getclassssection="select * from tblclassarms where Id=$classArmId";
          $result=$conn->query($getclassssection);
          $classsection=$result->fetch_assoc();

  

          //////////////////////////////////
          
          

            
        $query=mysqli_query($conn,"insert into studentenroll values('','".$student['firstname']."','".$student['lastname']."','$stdid','$classId','".$class['pname']."','$classArmId','".$classsection['classArmName']."','".$sessionyear."','".$dateCreated."')");
            
            
            if ($query) 
            {
                
                
                        $statusMsg = "<div class='alert alert-success' style='margin-right:700px;'>Enrolled Successfully!</div>";
            }
            
            else
            {
                 $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
            }

       
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
<?php include 'includes/title.php';?>
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
        xmlhttp.open("GET","ajaxClassArms.php?cid="+str,true);
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
            <h1 class="h3 mb-0 text-gray-800">Students Enrollment Section</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Students Un/Enrollment</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Enrollment Section</h6>
                    <?php echo $statusMsg; ?>
                </div>
                <div class="card-body">
                  <form method="POST">
                  
                    
                 
                  <div class="form-group row mb-3">
                    <div class="col-xl-6">
                      
                        <label class="form-control-label">Select Student No<span class="text-danger ml-2">*</span></label>
                         <?php
                        $qry= "SELECT * FROM  student_info ORDER BY stdid ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;   
                        if ($num > 0){
                          echo ' <select required name="stdid" onchange="classArmDropdown(this.value)" class="form-control mb-3">';
                          echo'<option value="">--Select Admission No--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['stdid'].'" >'.$rows['firstname'].' '.$rows['lastname'].'-'.$rows['regnumber'].'</option>';
                              }
                                 echo '</select>';
                            }
                           ?>  
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Select Class<span class="text-danger ml-2">*</span></label>
                         <?php
                        $qry= "SELECT * FROM program ORDER BY pid ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;		
                        if ($num > 0){
                          echo ' <select required name="classId" onchange="classArmDropdown(this.value)" class="form-control mb-3">';
                          echo'<option value="">--Select Class--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['pid'].'" >'.$rows['pname'].'</option>';
                              }
                                 echo '</select>';
                            }
                           ?>  
                        </div>
                        <div class="col-xl-6">
                        <label class="form-control-label">Class Section<span class="text-danger ml-2">*</span></label>
                        
                            <?php
                                echo"<div id='txtHint'></div>";
                            ?>
                        </div>

                    </div>
                      
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                  </form>
                </div>
              </div>

              <!-- Input Group -->
                 <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Assinged Teachers</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>Admission No</th>
                        <th>Student Name</th>
                        <th>Class Assigned</th>
                        <th>Class Section</th>
                        <th>Session Year</th>
                        <th>Assigned Date</th>
                        <th>UnAssignment</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php
                      $query = "Select * from studentenroll;";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                             $sn = $sn + 1;
                             
                            $tscp1="select * from student_info where  stdid='".$rows['admissionNumber']."' ";
                            $ts=$conn->query($tscp1);
                            $ts1=$ts->fetch_assoc();
                            
                            echo"
                              <tr>
                                <td>".$sn."</td>
                                
                                <td>".$ts1['regnumber']."</td>
                                <td>".$rows['firstName'].' '.$rows['lastName']."</td>
                                <td>".$rows['className']."</td>
                                <td>".$rows['section']."</td>
                                <td>".$rows['sessionyear']."</td>
                                <td>".$rows['date']."</td>
                               <td><a href='deletestudentassignment.php?action=delete&Id=".$rows['sid']."&classArmId=".$rows['section']."'><i class='fas fa-fw fa-trash'></i></a></td>
                              </tr>";
                          }
                      }
                      else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }
                      
                      ?>
                    </tbody>
                  </table>
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