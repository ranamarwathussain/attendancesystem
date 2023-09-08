<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';

//------------------------SAVE--------------------------------------------------

if(isset($_POST['save'])){
    
    extract($_POST);
    $query=mysqli_query($conn,"select * from program" );
    $ret1=mysqli_fetch_array($query);
     if($ret1 > 0){
    $query=mysqli_query($conn,"select * from student_info where stdcnic ='$stdcnic' OR regnumber ='$regnumber' OR email ='$email' OR contact ='$contact'" );
    $ret=mysqli_fetch_array($query);
 
    if($ret > 0){ 
      $statusMsg = "<div id='moo' class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show' auto-close='2000'>This Record's Email/Regnumber/Contact/Student CNIC/firstname/lastname Already Exists! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><i class='fas fa-skull-crossbones' style='font-size:24px'></i></button></div>";
    }
    else{

      $totalbalance=$pcost+$padmission;

    $query=mysqli_query($conn,"INSERT INTO `student_info`(`stdid`, `firstname`, `lastname`, `email`, `contact`, `address`, `gender`, `stdcnic`, `gardian`, `parentcnic`, `parentcontact`, `regnumber`,`sequanceid`, `pcode`, `pname`, `pcost`,`padmission`, `pduration`, `createdby`, `createdon`,`studentstatus`) VALUES ('','$fname','$lname','$email','$contact','$address','$gender','$stdcnic','$guardian','$pcnic','$pcontact','$regnumber','$seqid','$pcode','$pname','$pcost','$padmission','$pduration','".$_SESSION['empcode'].'-'. $_SESSION['firstname'].''. $_SESSION['lastname']."',NOW(),'Active')");

      $query3=mysqli_query($conn," INSERT INTO `student_balance`(`bid`, `firstname`, `lastname`, `stdcnic`, `regnumber`, `pcode`, `pname`, `pcost`,`padmission`, `pduration`) VALUES ('','$fname','$lname','$stdcnic','$regnumber','$pcode','$pname','".$totalbalance."','-','$pduration')");


      $query4=mysqli_query($conn,"INSERT INTO `studentlagers`(`stdlagerid`, `firstname`, `lastname`, `regnumber`, `stdcnic`, `contact`, `email`, `pcode`, `pname`, `description`, `creadedby`, `creadtedon`, `paid`, `outbalance`) VALUES ('','$fname','$lname','$regnumber','$stdcnic','$contact','$email','$pcode','$pname','New Admission/Entery','".$_SESSION['empcode'].'-'. $_SESSION['firstname'].''. $_SESSION['lastname']."',NOW(),'0','".$totalbalance."')");

        


      $query1=mysqli_query($conn,"INSERT INTO `staffactivity`(`accid`, `empcode`, `empname`, `studentinfo`, `createdon`, `activity`) VALUES ('','".$_SESSION['empcode']."','". $_SESSION['firstname'].''. $_SESSION['lastname']."','".$fname.''.$lname.'-'.$regnumber."',NOW(),'ADDED Student' )");

    $totalbalance=0;
    if ($query) {
        
         $statusMsg = "<div id='moo' class='alert alert-success bg-success  text-light border-0 alert-dismissible fade show' auto-close='2000'>Created Successfully! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><i class='far fa-hand-point-up' style='font-size:24px'></i></button></div>";
                 
            
            }
            else
            {
               $statusMsg = "<div id='moo' class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show' auto-close='2000'>An error Occurred! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><i class='fas fa-skull-crossbones' style='font-size:24px'></i></button></div>";
               
            }
     
   }
 }else
            {
               $statusMsg = "<div id='moo' class='alert alert-danger bg-danger text-light border-0 alert-dismissible fade show' auto-close='2000'>NO Program Present!! <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><i class='fas fa-skull-crossbones' style='font-size:24px'></i></button></div>";
               
            }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script>
function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","getuser.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>
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
            <h1 class="h3 mb-0 text-gray-800">Add Student Section</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Student Section</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Add Student Section</h6>
                    <?php echo $statusMsg; ?>

                </div>
                <div class="card-body">

                  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span><i class='fas fa-plus' style='font-size:20px'></i> Add Student</button>
                    
				 </div>
              </div>
 			</div>
          </div>
           <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-content">
				<form method="POST">	
					<div class="modal-header">
						<h4 class="modal-title">Add Student</h4>
					</div>
					<div class="modal-body">
						 <div class="row">
						 
							<div class="col-xs-7 col-sm-6 col-lg-6">
								<label>First Name</label><span class="text-danger ml-2">*</span>
								<input type="text" name="fname" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()"/>
							
							</div>
							<div class="col-xs-7 col-sm-6 col-lg-6">
								<label>Last Name</label><span class="text-danger ml-2">*</span>
								<input type="text" name="lname" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()"/>
							
							</div>
                <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Email</label><span class="text-danger ml-2">*</span>
                <input type="email" name="email" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()"/>
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Contact</label><span class="text-danger ml-2">*</span>
                <input type="number" name="contact" class="form-control" required="required"  />
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Address</label><span class="text-danger ml-2">*</span>
                <input type="text" name="address" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()"/>
              
              </div>
               <div class="col-xs-7 col-sm-6 col-lg-6">
                 <label class="form-control-label">Gender<span class="text-danger ml-2">*</span></label>
                        <select required name="gender"   class="form-control mb-3" >
                          <option value="">--Select Gender--</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Other">Other</option>

                 </select>


              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Student CNIC</label><span class="text-danger ml-2">*</span>
                <input type="number" name="stdcnic" class="form-control" required="required"/>
              
              </div>
               <div class="col-xs-7 col-sm-6 col-lg-6">
                 <label class="form-control-label">Guardian<span class="text-danger ml-2">*</span></label>
                        <select required name="guardian"  class="form-control mb-3">
                          <option value="">--Select Gender--</option>
                          <option value="Mother">Mother</option>
                          <option value="Father">Father</option>
                          <option value="Mother/Father">Mother/Father</option>
                          <option value="Other Person">Other Person</option>

                 </select>


              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Parent/Guardian CNIC</label><span class="text-danger ml-2">*</span>
                <input type="number" name="pcnic" class="form-control"   required="required"/>
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Parent/Guardian Contact</label><span class="text-danger ml-2">*</span>
                <input type="number" name="pcontact" class="form-control" required="required"/>
              
              </div>

					     </div>
                
               <div class="col-xl-6">
                        <label class="form-control-label">Select Program<span class="text-danger ml-2">*</span></label>
                         <?php
                        $qry= "SELECT * FROM program ORDER BY pid ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;   
                        if ($num > 0){
                          echo ' <select required name="pcode" onchange="showUser(this.value)" class="form-control mb-3">';
                          echo'<option value="">--Select Class--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['pid'].'" >'.$rows['pcode'].'-'.$rows['pname'].'</option>';
                              }
                                 echo '</select>';
                            }
                           ?>  
                        </div>
                       
					   </div>
					  
                         <div class="col-xs-7 col-sm-6 col-lg-12">
                 <div class="col-xl-6">
                        <label>Registration Number (Auto Generated)</label><span class="text-danger ml-2">*</span>
                          <?php
                                echo"<div id='txtHint'></div>";
                            ?>
                        </div>
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
                        <th>Roll#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>CNIC</th>
                        <th>Guardian details</th>
                        <th>Program</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php
                       $query = "Select * from student_info;";
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
                                <td>";
                                ?>
                                  <center><button class="btn btn-warning" data-toggle="modal" data-target="#edit_modal<?php echo  $rows['stdid']?>"><?php echo $rows['regnumber']; ?></button> 

                                <?php 
                                echo "</td>
                                <td>".$rows['firstname'].' '.$rows['lastname']."</td>
                                <td>".$rows['email']."</td>
                                <td>".$rows['contact']."</td>
                                <td>".$rows['address']."</td>
                                <td>".$rows['gender']."</td>
                                <td>".$rows['stdcnic']."</td>
                                <td>".$rows['gardian'].'-'.$rows['parentcnic'].'-'.$rows['parentcontact']."</td>
                                <td>".$rows['pname']."</td>
                                <td>".$rows['studentstatus']."</td>";
                                ?>

                      <td><center><button class="btn btn-warning" data-toggle="modal" data-target="#edit_modal<?php echo  $rows['stdid']?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
						 <center><a href='getdeletestudent.php?stdid=<?php echo  $rows['stdid']?>'<button class="btn btn-danger"  ><span class="glyphicon glyphicon-edit"></span>Delete</button></a> 
						 </td>
                              </tr>
                              
    <div class="modal fade bd-example-modal-lg" id="edit_modal<?php echo $rows['stdid']?>" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content modal-lg">
				<form method="POST" action="update_student.php">	
					<div class="modal-header">
            <h4 class="modal-title">Update Student</h4>
          </div>
          <div class="modal-body">
             <div class="row">
             <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Reg#</label><span class="text-danger ml-2">*</span>
                <input type="text" name="fname" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['regnumber'];?>" disabled/>
                <input type="hidden" name="regnumber" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['regnumber'];?>"/>
              <input type="hidden" name="stdid" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['stdid'];?>" />
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>First Name</label><span class="text-danger ml-2">*</span>
                <input type="text" name="fname" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['firstname'];?>" disabled/>
              <input type="hidden" name="fname" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['firstname'];?>" />
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Last Name</label><span class="text-danger ml-2">*</span>
                <input type="text" name="lname" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['lastname'];?>" disabled />
              <input type="hidden" name="lname" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['lastname'];?>"  />
              </div>
                <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Email</label><span class="text-danger ml-2">*</span>
                <input type="email" name="email" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['email'];?>" disabled />
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Contact</label><span class="text-danger ml-2">*</span>
                <input type="number" name="contact" class="form-control" required="required" value="<?php echo $rows['contact'];?>" disabled />
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Address</label><span class="text-danger ml-2">*</span>
                <input type="text" name="address" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['address'];?>" />
              
              </div>
               <div class="col-xs-7 col-sm-6 col-lg-6">
                 <label class="form-control-label">Gender<span class="text-danger ml-2">*</span></label>
                        <select disabled name="gender"   class="form-control mb-3" >
                          <option value="<?php echo $rows['firstname'];?>"><?php echo $rows['gender'];?> </option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Other">Other</option>

                 </select>


              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Student CNIC</label><span class="text-danger ml-2">*</span>
                <input type="number" name="stdcnic" class="form-control" value="<?php echo $rows['stdcnic'];?>"  required="required" disabled/>
              
              </div>
               <div class="col-xs-7 col-sm-6 col-lg-6">
                 <label class="form-control-label">Guardian<span class="text-danger ml-2">*</span></label>
                        <select disabled name="guardian"  class="form-control mb-3">
                          <option value="<?php echo $rows['gardian'];?>"><?php echo $rows['gardian'];?> </option>
                          <option value="Mother">Mother</option>
                          <option value="Father">Father</option>
                          <option value="Mother/Father">Mother/Father</option>
                          <option value="Other Person">Other Person</option>

                 </select>


              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Parent/Guardian CNIC</label><span class="text-danger ml-2">*</span>
                <input type="number" name="pcnic" class="form-control"   value="<?php echo $rows['parentcnic'];?>" required="required" disabled/>
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Parent/Guardian Contact</label><span class="text-danger ml-2">*</span>
                <input type="number" name="pcontact" class="form-control"  value="<?php echo $rows['parentcontact'];?>" required="required" disabled/>
              
              </div>
               <div class="col-xs-7 col-sm-6 col-lg-6">
                 <label class="form-control-label">Student Status<span class="text-danger ml-2">*</span></label>
                        <select required name="studentstatus"  class="form-control mb-3">
                          <option value="<?php echo $rows['studentstatus'];?>"><?php echo $rows['studentstatus'];?> </option>
                          <option value="Active">Active</option>
                          <option value="In-Active">In-Active</option>
                          
                 </select>


              </div>

               </div>
                
                
                       
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