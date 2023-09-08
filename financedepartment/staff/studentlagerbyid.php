<?php session_start();

include 'Includes/dbcon.php';
include 'Includes/session.php';
extract($_POST);

 $query = "SELECT * FROM staff WHERE empcode = '".$_SESSION["empcode"]."'";
  $rs = $conn->query($query);
  $get = $rs->fetch_assoc();

  $query1= "SELECT * FROM student_info WHERE regnumber = '$regnumber'";
  $rs1 = $conn->query($query1);
   
  $rows1 = $rs1->fetch_assoc();
  $fullName = $get['firstname'].' '.$get['lastname'];
 
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<title>Student Ledger</title>
		
<script>
function printPage() {
    window.print();
}
</script>

</head>
<body>
	<div class = "container">
		<div id = "header">
		<br/>

			<p style = "text-align: right; font-size:12pt; font-weight:bold;">Student Ledger Report</p>
        <div align="right" style="font-size:12pt;">
		<p style="text-align: right;font-size:12pt;"> <b style="color:black;text-align: right;">Date Prepared:</b>
		 <?php $date = date('d-m-y h:i:s');
echo "<b>".$date."</br>";?></p>
        </div>			
        <b style="font-size:14pt; font-weight:bold;"><div align="center">
            Student Complete Ledger<br>
            </div></b>
      
		<br/>
        <style>
        /* Rounded border */
hr.rounded {
  border-top: 8px solid #000000;
  border-radius: 5px;
  color: black;
}
</style>
  <div class="form-group row">
  <div class="col-xs-2 col-sm-2 col-lg-2">
    <label for="ex1">Regnumber</label>
    <input class="form-control"  style="font-weight: bold;" id="ex1" type="text" value="<?php echo $rows1['regnumber'];?>"  disabled>
  </div> <br>
  <div class="col-xs-2 col-sm-2 col-lg-2" style="margin-left:10px">
    <label for="ex2">Name</label>
    <input class="form-control" style="font-weight: bold;" id="ex2" type="text" value="<?php echo $rows1['firstname'].' '.$rows1['lastname'];?>" disabled>
  </div><br>
  <div class="col-xs-2 col-sm-2 col-lg-2" style="margin-left:10px">
    <label for="ex2">Contact</label>
    <input class="form-control" style="font-weight: bold;" id="ex2" type="text" value="<?php echo $rows1['contact'];?>" disabled>
  </div>
  <br>
  
  <br>
  <div class="col-xs-3 col-sm-3 col-lg-2" style="margin-left:10px">
    <label for="ex3">Program Code</label>
    <input class="form-control" style="font-weight: bold;" id="ex2" type="text" value="<?php echo $rows1['pcode'];?>" disabled></div>
 

 <div class="col-xs-2 col-sm-2 col-lg-2"  >
    <label for="ex3">Program Name</label>
    <input class="form-control" style="font-weight: bold;" id="ex2" type="text" value="<?php echo $rows1['pname'];?>" disabled>
  </div>
  
   
</div>     
<hr class="rounded">
         <style type="text/css">
                      form-group-row.input {
                        font-weight:bold;
                             
                       }

        </style>
        

 <b style="font-size:14pt; font-weight:bold;"><div align="center">
            Student Challan Submit Report (If Any)<br>
            </div></b>
<table class="table table-striped" style="align-content: left;">
						    <thead>
                  <tr>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Description</th>
                        <th scope="col">Paid Balance</th>
                        <th scope="col">Remaing Balance</th>
                         
                        
                      </tr>
                    
                  </tr>
                </thead>
						  <tbody>
                   <?php

                   
                       

                      $query2 = "SELECT * FROM studentlagers where regnumber='$regnumber' order by stdlagerid";

                      $rs2 = $conn->query($query2);
                      $num2 = $rs2->num_rows;
                      $sn=0;
                      if($num2 > 0)
                      { 
                        while ($rows2 = $rs2->fetch_assoc())
                          {
                          
                             $sn = $sn + 1;
                            echo"
                                <tr >
                                 
                                <td>".$rows2['creadtedon']."</td>
                                <td>".$rows2['description']."</td>
                                <td>".$rows2['paid']."</td>
                                 <td>".$rows2['outbalance']."</td>
                               
                                
                            ";
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
                  
                  <?php
                   $query2 = "SELECT sum(paid) as paid FROM studentlagers where regnumber='$regnumber' order by stdlagerid";
                   $rs2 = $conn->query($query2);
                   $paidbalance=$rs2->fetch_assoc();


                   $query21 = "SELECT pcost FROM student_balance where regnumber='$regnumber' order by bid";
                   $rs21 = $conn->query($query21);
                   $remainingbalance=$rs21->fetch_assoc();
                   echo"
                                <tr >
                                 
                                <td></td>
                                <td><b>Student Total Balance Report</b></td>
                                <td><b>".$paidbalance['paid']."</b></td>
                                <td><b>".$remainingbalance['pcost']."</b></td>
                             </tr>";
                
                 ?>
                 
                </tbody>
						  
					  </table> 
                      <style>
        /* Rounded border */
hr.rounded {
  border-top: 8px solid #000000;
  border-radius: 5px;
  color: black;
}
</style>
       
<hr class="rounded">
    
             
             

<br />
<br />
<hr class="rounded">
         <style type="text/css">
                      form-group-row.input {
                        font-weight:bold;
                             
                       }

        </style>
        <b style="font-size:14pt; font-weight:bold;"><div align="center">
            Student Fine Report (If Any)<br>
            </div></b>

<table class="table table-striped" style="align-content: left;">
                            <thead>
                  <tr>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Description</th>
                        <th scope="col">Fine Paid</th>
                        
                         
                        
                      </tr>
                    
                  </tr>
                </thead>
                          <tbody>
                   <?php

                   
                       

                      $query2 = "SELECT * FROM studentfinelagers where regnumber='$regnumber' order by stdfinelagerid";

                      $rs2 = $conn->query($query2);
                      $num2 = $rs2->num_rows;
                      $sn=0;
                      if($num2 > 0)
                      { 
                        while ($rows2 = $rs2->fetch_assoc())
                          {
                          
                             $sn = $sn + 1;
                            echo"
                                <tr >
                                 
                                <td>".$rows2['creadtedon']."</td>
                                <td>".$rows2['description']."</td>
                                <td>".$rows2['paid']."</td>
                                  
                               
                                
                            ";
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
                  
                  
                 <?php
                   $query2 = "SELECT sum(paid) as paid FROM studentfinelagers where regnumber='$regnumber' order by stdfinelagerid";
                   $rs2 = $conn->query($query2);
                   $paidbalance=$rs2->fetch_assoc();
                        echo"
                                <tr >
                                 
                                <td></td>
                                <td><b>Student Total Fine Submission Report</b></td>
                                <td><b>".$paidbalance['paid']."</b></td>
                                
                             </tr>";
                
                 ?>
                 
                 
                </tbody>
                          
                      </table> 
                      <style>
        /* Rounded border */
hr.rounded {
  border-top: 8px solid #000000;
  border-radius: 5px;
  color: black;
}
</style>
       
<hr class="rounded">
    
             
             

<br />
<br />
<b style="color:black; font-size:15px;">
Prepared By: <?php echo $fullName;?><br>
Employee Code By: <?php echo $_SESSION['empcode'];?>
</b>


			</div>
	
	
	
	

	</div>
</body>


</html>