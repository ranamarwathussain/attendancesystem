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
    xmlhttp.open("GET","getstudentfine.php?q="+str,true);
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
            <h1 class="h3 mb-0 text-gray-800">Paid Fine Section</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Paid Fine Section</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Paid Fine Section</h6>
                    <?php echo $statusMsg; ?>
                    <div class="form-outline">
   <b><label class="form-label" for="textAreaExample3">Paid Fine Stats</label></b>
  <textarea disabled class="form-control" id="textAreaExample3" rows="2">Total Amount:
    <?php $query = "Select sum(fee) as feesum from fine where challanstatus='Paid';";
                      $rs = $conn->query($query);
                      $row=$rs->fetch_assoc();
                      echo $row['feesum'];?></textarea>
                      <form action="getprintfine1.php" method="POST" target="_blank">
                       <button type="submit" name='piadfine'  class="btn btn-primary btn-block">Print All Un-paid</button>
                       </form>
 
</div>
                </div>
                <div class="card-body">

                 
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
				<form method="POST" action="finerequest.php">	
					<div class="modal-header">
						<h4 class="modal-title">Generate Challan</h4>
					</div>
					<div class="modal-body">
						 <div class="row">
						 
							</div>
                
               <div class="col-xl-12">
                        <label class="form-control-label">Select Student<span class="text-danger ml-2">*</span></label>
                         <?php
                        $qry= "SELECT * FROM student_info where studentstatus='Active' ORDER BY stdid ASC";
                        $result = $conn->query($qry);
                        $num = $result->num_rows;   
                        if ($num > 0){
                          echo ' <select required name="stdid" onchange="showUser(this.value)" class="form-control mb-3">';
                          echo'<option value="">--Select Class--</option>';
                          while ($rows = $result->fetch_assoc()){
                          echo'<option value="'.$rows['stdid'].'" >'.$rows['regnumber'].'-'.$rows['firstname'].''.$rows['lastname'].'-'.$rows['pcode'].'-'.$rows['pname'].'</option>';
                              }
                                 echo '</select>';
                            }
                           ?>  
                        </div>
                       
					   </div>
					  
                         <div class="col-xs-7 col-sm-6 col-lg-12">
                 <div class="col-xl-12">
                        <label>Student Details (Auto Generated)</label><span class="text-danger ml-2">*</span>
                          <?php
                                echo"<div id='txtHint'></div>";
                            ?>
                        </div>
                </div>
                       
              

					<div style="clear:both;"></div>
					<div class="modal-footer">
						
						<button name="save" class="btn btn-success" ><span class="glyphicon glyphicon-save"></span> Generate Voucher</button>
				
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Abort</button>
        </div>
        	</div>
				</form>
          <div style="clear:both;"></div>
        </div>
      </div>
      
    </div>
  </div>
     <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Student Challan</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Roll#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                         <th>CNIC</th>
                         <th>Program Code</th>
                        <th>Program Name</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                        <th>Payable Fine</th>
                        <th>Remarks</th>
                        <th>Payment Status</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php
                       $query = "Select * from fine where challanstatus='Paid';";
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
                                <center><button disabled class="btn btn-warning" data-toggle="modal" data-target="#edit_modal<?php echo  $rows['regnumber']?>"><?php echo $rows['regnumber']; ?></button> 
                                <a href='generatepaidfinechallan.php?regnumber=<?php echo $rows['fineid']; ?>' target='_blank'><button class="btn btn-info">Paid</button></a>
                                  </center>
                                <?php 
                               
                                echo "</td>
                                <td>".$rows['firstname'].' '.$rows['lastname']."</td>
                                <td>".$rows['email']."</td>
                                <td>".$rows['contact']."</td>
                                <td>".$rows['stdcnic']."</td>
                                <td>".$rows['pcode']."</td>
                                <td>".$rows['pname']."</td>
                                <td>".$rows['createdon']."</td>
                                <td>".$rows['duedate']."</td>
                                <td>".$rows['fee']."</td>
                                <td>".$rows['month']."</td>
                                <td>".$rows['challanstatus']."</td>";
                                ?>
                          </tr>
                              
    <div class="modal fade bd-example-modal-lg" id="edit_modal<?php echo $rows['regnumber']?>" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content modal-lg">
				<form method="POST" action="update_student.php">	
					<div class="modal-header">
            <h4 class="modal-title">Student Challan Details</h4>
          </div>
            <div class="modal-body">
             <div class="row">
             <div class="col-xs-7 col-sm-6 col-lg-12">
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
                 <input type="hidden" name="email" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['email'];?>"  />
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Contact</label><span class="text-danger ml-2">*</span>
                <input type="number" name="contact" class="form-control" required="required" value="<?php echo $rows['contact'];?>" disabled />
                <input type="hidden" name="contact" class="form-control" required="required" value="<?php echo $rows['contact'];?>" />
              
              </div>
              
               
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Student CNIC</label><span class="text-danger ml-2">*</span>
                <input type="number" name="stdcnic" class="form-control" value="<?php echo $rows['stdcnic'];?>"  required="required" disabled/>
                 <input type="hidden" name="stdcnic" class="form-control" value="<?php echo $rows['stdcnic'];?>"  required="required" />
              
              </div>
             
              
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Program Code</label><span class="text-danger ml-2">*</span>
                <input type="text" name="pcode" class="form-control"  value="<?php echo $rows['pcode'];?>" required="required" disabled/>
                <input type="hidden" name="pcode" class="form-control"  value="<?php echo $rows['pcode'];?>" required="required" />
              
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Program Name</label><span class="text-danger ml-2">*</span>
                <input type="text" name="pname" class="form-control"  value="<?php echo $rows['pname'];?>" required="required" disabled/>
               <input type="hidden" name="pname" class="form-control"  value="<?php echo $rows['pname'];?>" required="required" />
              </div>
              
              
               <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Due Date:</label><span class="text-danger ml-2">*</span>
                <input type="date" name="duedate" class="form-control"  value="<?php echo $rows['duedate'];?>" disabled/>
                <input type="hidden" name="duedate" class="form-control"  value="<?php echo $rows['duedate'];?>" />
                   
              
              </div>
               <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Fee:</label><span class="text-danger ml-2">*</span>
                <input type="number" name="fee" class="form-control"  value="<?php echo $rows['fee'];?>" disabled/>
                 <input type="hidden" name="fee" class="form-control"  value="<?php echo $rows['fee'];?>" />
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Fine Type:</label><span class="text-danger ml-2">*</span>
                 <input type="text" name="otherfee" class="form-control"  value="<?php echo $rows['finetype'];?>" disabled/> 
                 <input type="hidden" name="otherfee" class="form-control"  value="<?php echo $rows['Finetype'];?>" />
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Total Payable Amount:</label><span class="text-danger ml-2">*</span>
                 <input type="number" name="otherfee" class="form-control"  value="<?php echo $rows['fee'];?>" disabled/> 
                 <input type="hidden" name="totalamount" class="form-control"  value="<?php echo $rows['fee'];?>"/> 
                 
              
              
              
              </div>
              


               </div>
              
             </div>
          
 



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