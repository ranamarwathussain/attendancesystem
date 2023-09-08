<?php session_start();
?>
<?php 
error_reporting(0);
include '../Includes/dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="../Includes/img/logo/attnlg.jpg" rel="icon">
<?php include '../Includes/title.php';?>
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

 
</head>

<body id="page-top">
  <div id="wrapper">
     
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
       
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
           

       
           
    
      
        <form>  
          <div class="row"> 
            <div class="col-xs-7 col-sm-6 col-lg-12">
          <div class="modal-header">
            <h4 class="modal-title">Search All Pending Challan</h4>
          </div>
          <label>Reg#</label><span class="text-danger ml-2">*</span>
            <input type="text" name="regnumber" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()"  />
           <div style="clear:both;"></div>
           <center>
              <button type="submit" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span><i class='fas fa-plus'></i>Get Challan</button></center>
         </div>
         </div>
         </form>
     
  
 <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Pending Fee Challan</h6>
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
                        <th>Payable Fee</th>
                        <th>Remarks</th>
                        <th>Payment Status</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php
                  extract($_GET);
                       $query = "Select * from challan where challanstatus='Pending' and regnumber='$regnumber';";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                            $totalfee=$rows['fee']+$rows['otherfee'];
                              
                            echo"
                              <tr>
                                <td>";
                                ?>
                                 
                                  <a href='generatechallan.php?regnumber=<?php echo $rows['challanid']; ?>' target='_blank'><button class="btn btn-info btn-lg">Get Print Challan</button></a>

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
                                <td>".$totalfee."</td>
                                <td>".$rows['month']."</td>
                                <td>".$rows['challanstatus']."</td>";
                                ?>
                          </tr>
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
  
  <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">All Pending Fine Challans</h6>
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
                        <th>Payable Fee</th>
                        <th>Remarks</th>
                        <th>Payment Status</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php
                  extract($_GET);
                       $query = "Select * from fine where challanstatus='Pending' and regnumber='$regnumber';";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                            $totalfee=$rows['fee']+$rows['otherfee'];
                              
                            echo"
                              <tr>
                                <td>";
                                ?>
                                 
                                  <a href='generatefinevoucher.php?regnumber=<?php echo $rows['fineid']; ?>' target='_blank'><button class="btn btn-info btn-lg">Get Print Challan</button></a>

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
                                <td>".$totalfee."</td>
                                <td>".$rows['month']."</td>
                                <td>".$rows['challanstatus']."</td>";
                                ?>
                          </tr>
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
        <!---Container Fluid-->
      </div>
 
    </div>
  </div>

     
        </div>
        <!---Container Fluid-->
      </div>
 
    </div>
  </div>

 
   
   
</body>

</html>