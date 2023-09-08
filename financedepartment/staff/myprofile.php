<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';
$query = "SELECT * FROM staff WHERE empcode = '".$_SESSION["empcode"]."'";
  $rs = $conn->query($query);
  $get = $rs->fetch_assoc();
//---------------------------------------EDIT-------------------------------------------------------------






//--------------------EDIT------------------------------------------------------------

 if(isset($_POST['update'])){
    
            extract($_POST);
        
            $query=mysqli_query($conn,"update staff set password='$pass' where staffid='$staffid'");

            if ($query) {
              $statusMsg = "<div id='moo' class='alert alert-warning bg-warning border-0 alert-dismissible fade show' role='alert' auto-close='2000'>Updated Record Successfully!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
              $query = "SELECT * FROM staff WHERE empcode = '".$_SESSION["empcode"]."'";
              $rs = $conn->query($query);
               $get = $rs->fetch_assoc();
                
               
            }
            else
            {
                $statusMsg = "<div id='moo' class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show' auto-close='2000'>An error Occurred! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
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
  <link href="../img/logo.png" rel="icon">
<?php include 'Includes/title.php';?>
  <link href="../Includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../Includes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="Includes/css/ruang-admin.min.css" rel="stylesheet">
   <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="Includes/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="Includes/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="Includes/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="Includes/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="Includes/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="Includes/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="Includes/assets/vendor/simple-datatables/style.css" rel="stylesheet">

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
            <h1 class="h3 mb-0 text-gray-800">Staff Profile</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">My Profile</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">My Profile Section</h6>
                    <?php echo $statusMsg; ?>
                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="form-group row mb-3">
                        <div class="col-xl-6">
                            <label class="form-control-label">Staff Code<span class="text-danger ml-2">*</span></label>
                      <input type="tetx" class="form-control" name="empcode" value="<?php if($get['empcode']>0){echo 'Restricted';}else {echo $get['empcode'];}?>" id="exampleInputFirstName" placeholder="emp Code" oninput="this.value = this.value.toUpperCase()" <?php if($get['empcode']>0){?>disabled<?php }else{?> maxlength="6"  required<?php }?>>
                        </div>
                    
                   
                        <div class="col-xl-6">
                            <label class="form-control-label">First Name<span class="text-danger ml-2">*</span></label>
                      <input type="text" class="form-control" name="firstname" value="<?php echo $get['firstname'];?>" id="exampleInputFirstName" placeholder="First Name" oninput="this.value = this.value.toUpperCase()" disabled>
                        </div>


                        <div class="col-xl-6">
                            <label class="form-control-label">Last Name<span class="text-danger ml-2">*</span></label>
                      <input type="text" class="form-control" name="lastname" value="<?php echo $get['lastname'];?>" id="exampleInputFirstName" placeholder="Last Name" oninput="this.value = this.value.toUpperCase()" disabled>
                        </div>
                  <div class="col-xl-6">
                            <label class="form-control-label">Email<span class="text-danger ml-2">*</span></label>
                      <input type="email" class="form-control" name="email" value="<?php echo $get['email'];?>" id="exampleInputFirstName" placeholder="Email" oninput="this.value = this.value.toUpperCase()" disabled>
                        </div>
                    <div class="col-xl-12">
                            <label class="form-control-label">Contact<span class="text-danger ml-2">*</span></label>
                      <input type="number" class="form-control" name="contact" value="<?php echo $get['contact'];?>" id="exampleInputFirstName" placeholder="Contact" oninput="this.value = this.value.toUpperCase()" disabled>
                        </div>
                    </div>
                    
                     <div class="form-group row mb-3">
                        <div class="col-xl-6">
                            <label class="form-control-label">Campus<span class="text-danger ml-2">*</span></label>
                      <input type="text" class="form-control" name="campus" value="<?php echo $get['campus'];?>" id="exampleInputFirstName" placeholder="Campus" oninput="this.value = this.value.toUpperCase()" disabled>
                        </div>
                    
                   
                        <div class="col-xl-6">
                            <label class="form-control-label">City<span class="text-danger ml-2">*</span></label>
                      <input type="text" class="form-control" name="city" value="<?php echo $get['city'];?>" id="exampleInputFirstName" placeholder="City" oninput="this.value = this.value.toUpperCase()"disabled>
                        </div>


                    </div>
                     <div class="form-group row mb-3">
                         
                    <div class="col-xl-12">
                            <label class="form-control-label">Staff Status<span class="text-danger ml-2">*</span></label>
                    <select disabled name="status" class="form-control mb-3">
                       <option value="ACTIVE"><?php echo $get['empstatus'];?></option>
                      <option value="ACTIVE">ACTIVE</option>
                      <option value="In ACTIVE">In ACTIVE</option>
                      <option value="Black List">Black List</option>
                      </select> 
                    </div>
                       <div class="col-xl-6">
                            <label class="form-control-label">User Name<span class="text-danger ml-2">*</span></label>
                      <input type="text" class="form-control" name="city" value="<?php echo $get['username'];?>" id="exampleInputFirstName" placeholder="City" oninput="this.value = this.value.toUpperCase()"disabled>
                        </div>
                           <div class="col-xl-6">
                            <label class="form-control-label">password<span class="text-danger ml-2">*</span></label>
                      <input type="text" class="form-control" name="pass" value="<?php echo $get['password'];?>" id="exampleInputFirstName"  oninput="this.value = this.value.toUpperCase()">
                        </div>

                        <div class="col-xl-6">
                            
                      <input type="hidden" class="form-control" name="staffid" value="<?php echo $get['staffid'];?>"  oninput="this.value = this.value.toUpperCase()">
                        </div>
                   
                    </div>
                     
                    
                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                    
                  </form>
                </div>
              </div>

              <!-- Input Group -->
                 
          </div>
          

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
        
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../Includes/vendor/jquery/jquery.min.js"></script>
  <script src="../Includes/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../Includes/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../Includes/js/ruang-admin.min.js"></script>
   <!-- Page level plugins -->
  <script src="../Includes/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../Includes/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
    $(function() {
  var alert = $('div.alert[auto-close]');
  alert.each(function() {
    var that = $(this);
    var time_period = that.attr('auto-close');
    setTimeout(function() {
      that.alert('close');
    }, time_period);
  });
});
  </script>
</body>

</html>