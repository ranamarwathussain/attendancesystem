<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';

//------------------------SAVE--------------------------------------------------

if(isset($_POST['save'])){
    
    extract($_POST);
   
    $query=mysqli_query($conn,"select * from program where pcode ='$pcode' || pname ='$pname'");
    $ret=mysqli_fetch_array($query);
 
    if($ret > 0){ 
      $statusMsg = "<div id='moo' class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show' auto-close='2000'>This Record Already Exists! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><i class='fas fa-skull-crossbones' style='font-size:24px'></i></button></div>";

       
    }
    else{

    $query=mysqli_query($conn,"INSERT INTO `program`(`pid`, `pcode`, `pname`, `pcost`,`padmission`,`pduration`, `pfeemode`, `pdegree`, `pshift`,`empcode`,`empname`,`createdon`) VALUES ('','$pcode','$pname','$pcost','$padmission','$pduration','$feemode','$degree','$shift','".$_SESSION['empcode']."','". $_SESSION['firstname'].''. $_SESSION['lastname']."',NOW())");
      
      $query=mysqli_query($conn,"INSERT INTO `adminactivity`(`aid`, `empcode`, `empname`, `createdon`,`pcode`,`pname`, `activity`) VALUES ('','".$_SESSION['empcode']."','". $_SESSION['firstname'].''. $_SESSION['lastname']."',NOW(),'$pcode','$pname','Created Program' )");

    if ($query) 
              {
        $statusMsg = "<div id='moo' class='alert alert-success bg-success text-light border-0 alert-dismissible fade show' auto-close='2000'>Created Successfully <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><i class='far fa-hand-point-up' style='font-size:24px'></i></button></div>";
              }
            else
            {

              $statusMsg = "<div id='moo' class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show' auto-close='2000'>An error Occurred!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><i class='fas fa-skull-crossbones' style='font-size:24px'></i></button></div>";
                 
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
  <link href="Includes/img/logo/attnlg.jpg" rel="icon">
<?php include 'Includes/title.php';?>
  <link href="../Includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../Includes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../Includes/css/ruang-admin.min.css" rel="stylesheet">
   <!-- Vendor CSS Files -->
   <link href="../Includes/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../Includes/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../Includes/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../Includes/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../Includes/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../Includes/assets/vendor/simple-datatables/style.css" rel="stylesheet"> 


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
            <h1 class="h3 mb-0 text-gray-800">Add Program Section</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Program Section</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add Program Section</h6>
                    <?php echo $statusMsg; ?>
                </div>
                <div class="card-body">

                  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span><i class='fas fa-plus' style='font-size:20px'></i> Add Program</button>
				 </div>
              </div>
 			</div>
          </div>
           <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-content">
				<form method="POST">	
					<div class="modal-header">
						<h4 class="modal-title">Add Program</h4>
					</div>
					<div class="modal-body">
						 <div class="row">
						 
							<div class="col-xs-7 col-sm-6 col-lg-6">
								<label>Program Code</label><span class="text-danger ml-2">*</span>
								<input type="text" name="pcode" class="form-control" placeholder="i.e CS101" required="required"/>
							
							</div>
							<div class="col-xs-7 col-sm-6 col-lg-6">
								<label>Program Name</label><span class="text-danger ml-2">*</span>
								<input type="text" name="pname" class="form-control" required="required"/>
							
							</div>
					     </div>
					      
					     <div class="row">
						 
							<div class="col-xs-7 col-sm-6 col-lg-12">
								<label>Total Cost</label><span class="text-danger ml-2">*</span>
								<input type="number" name="pcost" class="form-control" required="required"/>
							
							</div>
              <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Admission Fee</label><span class="text-danger ml-2">*</span>
                <input type="number" name="padmission" class="form-control" required="required"/>
              
              </div>
							 
					     </div>
					     <div class="row">
						 
							<div class="col-xs-7 col-sm-6 col-lg-12">
								<label>Program Duration</label><span class="text-danger ml-2">*</span>
								<input type="number" name="pduration" placeholder="i.e Years" class="form-control" required="required"/>
							
							</div>
							 
					     </div>
					       
					</div>
					<div class="col-xl-12">
                      
                        <label class="form-control-label">Fee Mode<span class="text-danger ml-2">*</span></label>
                        <select required name="feemode" onchange="classArmDropdown(this.value)" class="form-control mb-3">
                        	<option value="">--Select Fee Mode--</option>
                        	<option value="Monthly">Monthly</option>
                        	 <option value="Quartly">Quartly</option>
                        	<option value="Yearly">Yearly</option>

                        	</select>
                  
                      
                        <label class="form-control-label">Select Degree Program<span class="text-danger ml-2">*</span></label>
                        <select required name="degree" onchange="classArmDropdown(this.value)" class="form-control mb-3">
                        	<option value="">--Select Degree Program--</option>
                        		<option value="Degree Program">Degree Program</option>
                        			<option value="Diploma Program">Diploma Program</option>
                        	</select>
                        	<label class="form-control-label">Select Shift<span class="text-danger ml-2">*</span></label>
                        <select required name="shift" onchange="classArmDropdown(this.value)" class="form-control mb-3">
                        	<option value="">--Select Select Shift--</option>
                        		<option value="Evening">Evening</option>
                        			<option value="Morning">Morning</option>
                        	</select>
                        </div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						
						<button name="save" class="btn btn-success" ><span class="glyphicon glyphicon-save"></span> Save</button>
				
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
        </div>
        	</div>
				</form>
			</div>
      </div>
      
    </div>
  </div>
     <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Programs</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Code</th>
                        <th>Program Name</th>
                        <th>Total Cost</th>
                        <th>Admission Fee</th>
                        <th>Duration</th>
                        <th>Fee Mode</th>
                        <th>Degree Program</th>
                        <th>Shift</th>
                        <th>Created By</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php
                       $query = "Select * from program;";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                              
                            echo"
                              <tr>
                                <td>".$rows['pcode']."</td>
                                <td>".$rows['pname']."</td>
                                <td>".$rows['pcost']."</td>
                                <td>".$rows['padmission']."</td>
                                <td>".$rows['pduration'].' '.'Years'."</td>
                                <td>".$rows['pfeemode']."</td>
                                <td>".$rows['pdegree']."</td>
                                <td>".$rows['pshift']."</td>
                                <td>".$rows['empcode'].'-'.$rows['empname'].'-'.$rows['createdon']."</td>";
                                ?>
                      <td><center><button class="btn btn-warning" data-toggle="modal" data-target="#edit_modal<?php echo  $rows['pid']?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
						 </td>
                              </tr>
                              
    <div class="modal fade" id="edit_modal<?php echo $rows['pid']?>" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<form method="POST" action="update_program.php">	
					<div class="modal-header">
						<h4 class="modal-title">Update Program</h4>
					</div>
					<div class="modal-body">
						 <div class="row">
						 
							<div class="col-xs-7 col-sm-6 col-lg-6">
								<label>Program Code</label><span class="text-danger ml-2">*</span>
								<input type="text" name="pcode" class="form-control" value="<?php echo $rows['pcode']?>"  disabled/>
								<input type="hidden" name="pid" class="form-control" value="<?php echo $rows['pid']?>" />
							 <input type="hidden" name="pcode" class="form-control" value="<?php echo $rows['pcode']?>" />
              
							</div>
							<div class="col-xs-7 col-sm-6 col-lg-6">
								<label>Program Name</label><span class="text-danger ml-2">*</span>
								<input type="text" name="pname" class="form-control" value="<?php echo $rows['pname']?>"/>
							
							</div>
					     </div>
					      
					     <div class="row">
						 
							<div class="col-xs-7 col-sm-6 col-lg-12">
								<label>Total Cost</label><span class="text-danger ml-2">*</span>
								<input type="number" name="pcost" class="form-control" value="<?php echo $rows['pcost']?>"disabled/>
                
							
							</div>
              <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Admission Fee</label><span class="text-danger ml-2">*</span>
                <input type="number" name="padmission" class="form-control" value="<?php echo $rows['padmission']?>"disabled/>
                
              
              </div>
							 
					     </div>
					        <div class="row">
						 
							<div class="col-xs-7 col-sm-6 col-lg-12">
								<label>Program Duration</label><span class="text-danger ml-2">*</span>
								<input type="number" name="pduration" class="form-control" value="<?php echo $rows['pduration']?>"/>
							
							</div>
							 
					     </div>
					</div>
					<div class="col-xl-12">
                      
                        <label class="form-control-label">Fee Mode<span class="text-danger ml-2">*</span></label>
                        <select  name="feemode" onchange="classArmDropdown(this.value)" class="form-control mb-3">
                        	 <option value="<?php echo $rows['pfeemode']?>"><?php echo $rows['pfeemode']?></option>
                        	<option value="Monthly">Monthly</option>
                        	 <option value="Quartly">Quartly</option>
                        	<option value="Yearly">Yearly</option>

                        	</select>
                  
                      
                        <label class="form-control-label">Select Degree Program<span class="text-danger ml-2">*</span></label>
                        <select  name="degree" onchange="classArmDropdown(this.value)" class="form-control mb-3">
                        	<option value="<?php echo $rows['pdegree']?>"><?php echo $rows['pdegree']?></option>
                        		<option value="Degree Program">Degree Program</option>
                        			<option value="Diploma Program">Diploma Program</option>
                        	</select>
                        	<label class="form-control-label">Select Shift<span class="text-danger ml-2">*</span></label>
                        <select  name="shift" onchange="classArmDropdown(this.value)" class="form-control mb-3">
                        	<option value="<?php echo $rows['pshift']?>"><?php echo $rows['pshift']?></option>
                        		<option value="Evening">Evening</option>
                        			<option value="Morning">Morning</option>
                        	</select>
                        </div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						<button name="update" class="btn btn-warning" ><span class="glyphicon glyphicon-save"></span> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
			

                              <?php

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
<?php include 'script.php'?>
  
   
</body>

</html>