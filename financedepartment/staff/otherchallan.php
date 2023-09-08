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
            <h1 class="h3 mb-0 text-gray-800">Other Income Section</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Other Income Section</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Other Income Section</h6>
                    <?php echo $statusMsg; ?>
                </div>
                <div class="card-body">

                  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span><i class='fas fa-plus' style='font-size:20px'></i>Other Income Receipt</button>
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
				<form method="POST" action="otherincome.php">	
					<div class="modal-header">
						<h4 class="modal-title">Income Receipt</h4>
					</div>
					<div class="modal-body">
						 <div class="row">
						  <div class="col-xs-7 col-sm-6 col-lg-12">
                 <label class="form-control-label">Purpose of Payment<span class="text-danger ml-2">*</span></label>
                        <select required name="typeofpayment"  class="form-control mb-3">
                           <option value="">--Select Purpose of payment--</option>
                          <option value="Rental">Rental</option>
                          <option value="Cafeteria/Goodwill Collection">Cafeteria/Goodwill Collection</option>
                          <option value="Funds">Funds</option>
                          <option value="Donations">Donations</option>
                          <option value="Other">Other</option>
                        </select>
                     </div>
                <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Date of Payment:</label><span class="text-danger ml-2">*</span>
                <input type="date" name="dateofpayment" class="form-control"   required="required"/>
                   
              
              </div>

                     

                <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Total Amount</label><span class="text-danger ml-2">*</span>
                <input type="number" name="totalamount" class="form-control"     required/>
                 
              
              </div>
							</div>
              <br>
              <div class="col-xs-7 col-sm-6 col-lg-12">
              <div class="form-outline mb-1">
                 <label class="form-label" for="form4Example3">Description:</label><span class="text-danger ml-2">*</span>
                <textarea class="form-control" name='description' rows="5" oninput="this.value = this.value.toUpperCase()" required></textarea>
               
              </div>
                        </div>
                       
					   </div>
					  
                         
              

					<div style="clear:both;"></div>
					<div class="modal-footer">
						
						<button name="save" class="btn btn-success" ><span class="glyphicon glyphicon-save"></span> Income Receipt</button>
				
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Abort</button>
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
                  <h6 class="m-0 font-weight-bold text-primary">Income Receipts</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Receipt#</th>
                        <th>Purpose Of Payment</th>
                        <th>Date of Payment</th>
                        <th>Description</th>
                         <th>Amount</th>
                         <th>Creadted By</th>
                        <th>Created On</th>
                        <th>Status Paid</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php
                       $query = "Select * from  otherincomes;";
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
                                  <center><button class="btn btn-warning" data-toggle="modal" data-target="#edit_modal<?php echo  $rows['oiid']?>"><?php echo $rows['oiid']; ?></button> 
                                 <form action='generateincomeslip.php' method="POST" target='_blank'>   
                                  <input type='hidden' name='regnumber' value="<?php echo $rows['oiid']; ?>" >
                                  <button type='submit' class="btn btn-info">-Income Receipt-</button></a></center>
                                </form>

                                <?php 
                                echo "</td>
                                <td>".$rows['oiid']."</td>
                                <td>".$rows['purposeofpayment']."</td>
                                <td>".$rows['dateofpayment']."</td>
                                <td>".$rows['description']."</td>
                                <td>".$rows['amount']."</td>
                                <td>".$rows['createdby']."</td>
                                <td>".$rows['createdon']."</td>
                                <td>".$rows['Paid']."</td>";
                                ?>
                          </tr>
                              
    <div class="modal fade bd-example-modal-lg" id="edit_modal<?php echo $rows['oiid']?>" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content modal-lg">
				<form method="POST" action="update_challandate.php">	
					<div class="modal-header">
            <h4 class="modal-title">Income Receipt Details</h4>
          </div>
            <div class="modal-body">
               <div class="col-xs-7 col-sm-6 col-lg-12">
                 <label class="form-control-label">Purpose of Payment<span class="text-danger ml-2">*</span></label>
                        <select disabled name="typeofpayment"  class="form-control mb-3">
                           <option value=""><?php echo $rows['purposeofpayment']?></option>
                          <option value="Rental">Rental</option>
                          <option value="Cafeteria/Goodwill Collection">Cafeteria/Goodwill Collection</option>
                          <option value="Funds">Funds</option>
                          <option value="Donations">Donations</option>
                          <option value="Other">Other</option>
                        </select>
                     </div>
                <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Date of Payment:</label><span class="text-danger ml-2">*</span>
                <input type="date" name="dateofpayment" class="form-control"   value="<?php echo $rows['dateofpayment']?>"disabled />
                   
              
              </div>

                     

                <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Total Amount</label><span class="text-danger ml-2">*</span>
                <input type="number" name="totalamount" class="form-control"  
                value="<?php echo $rows['amount'];?>" disabled/>
                 
              
              </div>
             
              <br>
              <div class="col-xs-7 col-sm-6 col-lg-12">
              <div class="form-outline mb-1">
                 <label class="form-label" for="form4Example3">Description:</label><span class="text-danger ml-2">*</span>
                <textarea class="form-control" name='description' rows="5" oninput="this.value = this.value.toUpperCase()" value="" disabled ><?php echo $rows['description']?></textarea>
               
              </div>
                        </div>
                       
             </div>
              
             </div>
              <div style="clear:both;"></div>
          
          
 
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