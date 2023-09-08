<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="Includes/img/logo/attnlg.jpg" rel="icon">
<?php include 'Includes/title.php';?>
  <link href="../Includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../Includes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="Includes/css/ruang-admin.min.css" rel="stylesheet">
   <!-- Vendor CSS Files -->
   <link href="Includes/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="Includes/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="Includes/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="Includes/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="Includes/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="Includes/assets/vendor/simple-datatables/style.css" rel="stylesheet">

 <style>


#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
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
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Deposite History (Month Wise)</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Deposite History (Month Wise)</li>
            </ol>
          </div>

          <div class="row mb-3">
   <?php
                        $qry= "SELECT * FROM program ORDER BY pid ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;   
                        if ($num > 0){?>         
            <!-- Class Arm Card -->
<div class="card col-xl-12">
             <div class="card col-xl-12">
            <div class="card-body col-xl-12" >
              <h5 class="card-title">Program Wise Deposite History</h5>
               <form method="post" action='studenreportmonthlypayment.php' target="_blank">
                    <div class="form-group row mb-12">
                     <div class="col-xl-12">
                          <?php
                        $qry= "SELECT * FROM program ORDER BY pid ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;   
                        if ($num > 0){
                          echo ' <select required name="pcode"  class="form-control mb-3">';
                          echo'<option value="">--Select Class--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['pcode'].'" >'.$rows['pcode'].'-'.$rows['pname'].'</option>';
                              }
                                 echo '</select>';
                            }
                           ?>  
                        </div>
                   
                     <div class="col-lg-6">
                       <label for="From Month">From (Month):</label>
                        <select  name="fname">
                          <option value="January">January</option>
                          <option value="February">February</option>
                          <option value="March">March</option>
                           <option value="April">April</option>
                          <option value="May">May</option>
                          <option value="June">June</option>
                           <option value="July">July</option>
                          <option value="August">August</option>
                          <option value="September">September</option>
                           <option value="October">October</option>
                          <option value="November">November</option>
                          <option value="December">December</option>
                        </select>

                      </div>
                      <div class="col-lg-6">
                       <label for="To Month">To (Month):</label>
                         <select  name="lname">
                          <option value="January">January</option>
                          <option value="February">February</option>
                          <option value="March">March</option>
                           <option value="April">April</option>
                          <option value="May">May</option>
                          <option value="June">June</option>
                           <option value="July">July</option>
                          <option value="August">August</option>
                          <option value="September">September</option>
                           <option value="October">October</option>
                          <option value="November">November</option>
                          <option value="December">December</option>
                        </select>
                      </div>
                     
 <?php $years = range(1900, strftime("%Y", time())); ?>
                          
<label class="form-control-label">Select Year<span class="text-danger ml-2">*</span></label>
                      

                      <select class="form-control mb-3" name="currentyeardate" id="cars" required>
                          <option value="<?php echo strftime("%Y", time()); ?>"><?php echo strftime("%Y", time()); ?></option>
                          <?php foreach($years as $year) : ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                          <?php endforeach; ?>
                        </select>
                         
                    </div><button type="submit" name="remainings" class="btn btn-warning btn-block">Get Details</button>
                    
                   
                
                  </form>
             </div>
            </div>
          </div><?php
         }
         else
         {?>
            <div class="col-lg-12">
          <div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Danger!</strong> No Program Data Found.
  </div>
</div>
  <?php

         }
         ?>
         <?php
                        $qry= "SELECT * FROM student_info ORDER BY stdid ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;   
                        if ($num > 0){?>
<! Student wise history !-->
   <!-- Class Arm Card -->
<div class="card col-xl-12">
             <div class="card col-xl-12">
            <div class="card-body col-xl-12" >
              <h5 class="card-title">Student Wise Deposite History</h5>
               <form method="post" action='studenreportmonthlypaymentstudent1.php' target="_blank">
                    <div class="form-group row mb-12">
                     <div class="col-xl-12">
                          <?php
                        $qry= "SELECT * FROM student_info ORDER BY stdid ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;   
                        if ($num > 0){
                          echo ' <select required name="regnumber"  class="form-control mb-3">';
                          echo'<option value="">--Select Student--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['regnumber'].'" >'.$rows['firstname'].' '.$rows['lastname'].'-'.$rows['regnumber'].'-'.$rows['pcode'].'-'.$rows['pname'].'</option>';
                              }
                                 echo '</select>';
                            }
                           ?>  
                        </div>
                   
                     <div class="col-lg-6">
                       <label for="From Month">From (Month):</label>
                        <select  name="fname">
                          <option value="January">January</option>
                          <option value="February">February</option>
                          <option value="March">March</option>
                           <option value="April">April</option>
                          <option value="May">May</option>
                          <option value="June">June</option>
                           <option value="July">July</option>
                          <option value="August">August</option>
                          <option value="September">September</option>
                           <option value="October">October</option>
                          <option value="November">November</option>
                          <option value="December">December</option>
                        </select>

                      </div>
                      <div class="col-lg-6">
                       <label for="To Month">To (Month):</label>
                         <select  name="lname">
                          <option value="January">January</option>
                          <option value="February">February</option>
                          <option value="March">March</option>
                           <option value="April">April</option>
                          <option value="May">May</option>
                          <option value="June">June</option>
                           <option value="July">July</option>
                          <option value="August">August</option>
                          <option value="September">September</option>
                           <option value="October">October</option>
                          <option value="November">November</option>
                          <option value="December">December</option>
                        </select>
                      </div>
                     
 <?php $years = range(1900, strftime("%Y", time())); ?>
                          
<label class="form-control-label">Select Year<span class="text-danger ml-2">*</span></label>
                      

                      <select class="form-control mb-3" name="currentyeardate" id="cars" required>
                          <option value="<?php echo strftime("%Y", time()); ?>"><?php echo strftime("%Y", time()); ?></option>
                          <?php foreach($years as $year) : ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                          <?php endforeach; ?>
                        </select>
                         
                    </div><button type="submit" name="remainings" class="btn btn-warning btn-block">Get Details</button>
                    
                   
                
                  </form>
             </div>
            </div>
          </div>
        
           <?php
         }
         else
         {?>
           <div class="col-lg-12">
          <div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Danger!</strong> No Student Data Found.
  </div>
</div>
<?php
         }
         ?>

          

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
    
      <!-- Footer -->
    </div>
  </div>

   
 
<?php include 'script.php'?>
</body>

</html>