<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'Includes/session.php';
extract($_POST);
$query = "Select * from otherincomes where oiid='$regnumber'";
$rs = $conn->query($query);
$rows = $rs->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Challan-<?php echo  $rows['oiid']?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style type="text/css">
		.d-flex 
		{
			margin: 0;
			padding: 0;
		}

		.challan {
			 
			border: 1px solid #000000;
			padding: 2px;
			page-break-after: always; /* Insert page break after each copy */
		}
		.challan h3 {
			text-align: center;
			font-weight: bold;
			margin-bottom: 20px;
		}
		.table {
			border: 0px;
			width: 100%;
		  margin-bottom: 0px;


		}
		.table td, .table th {
			border: 0px solid #000000;
			padding: 2px;
		}
		.table tr {
			border: 0px;
			padding: 2px;
		}
		.total {
			font-weight: bold;

		}
		.col-md-4 {
			width: 32.3%;
			float: left;
		}
		.col-md-4:first-child {
			padding-right: 10px;
		}
		.col-md-4:last-child {
			padding-left: 10px;
		}
		.copy {
			margin-top: 20px;
			text-align: center;
			font-weight: bold;
		}
		.copy:after {
			content: attr(data-copy);
		}
		/* Rounded border */
hr.rounded {
  border-top: 8px solid #000000;
  border-radius: 5px;
}
hr.solid {
  border-top:1px solid #000000;
  
}
div{ 
   
  padding:0px; 
   
} 


	</style>
	<style type="text/css" media="print">
    @page { 
        size: landscape;
    }
    /* ISO Paper Size */
@page {
  size: A4 landscape;
}

</style> 
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
			<div class="challan">
				<div class="row" style="height:20px">
				<div class="col-md-12" style="height:20px" >
                  <p><img src="Includes/img/college.png"
                        class="" width="40" alt=""> <b>New Advance College Of Nursing</b></p>
                  </div>
            </div>
            <hr class="solid">
					<div class="d-flex" style="margin-top: -13px;padding: 0;height: -1px;">
						<div class="row" style="height:10px">
							<div class="col-sm-6">
                    
                        <b><p >Date:<span><?php echo  $rows['dateofpayment']?></span></p></b>
                       
              				  </div>
              				  <div class="col-sm-6">
                    
                        <b><p >Income Receipt#: <span><?php echo  $rows['oiid']?></span></p></b>
                       
              				  </div>
              				  
                			</div>
                			 
                	 
                 
                </div>
                <div class="row">
							<div class="col-sm-6">
                    
                        <b><p>Purpose:<span><?php echo  $rows['purposeofpayment']?></span></p></b>
                       
              				  </div>
              				  <div class="col-sm-6">
                    
                        <b><p >Created By: <span><?php echo  $rows['createdby']?></span></p></b>
                       
              				  </div>
              				  
                			</div>
                <div class="row">
							<div class="col-sm-12">
               
			

				<div class="table-responsive" >

					<table  class="table">
						<thead>
							<tr>
								<th style="text-align:center;background-color:#000000;color: white;width: 50%">Description</th>
								<th style="text-align:center;background-color:#000000;color: white;width: 50%">Amount</th>
							</tr>
						</thead>
						<tbody>
							<tr class="info" style="text-align:center;">
								<td><?php echo  $rows['description']?></td>
								<td><b><?php echo  $rows['amount']?></b></td>
							</tr>
							 
							 
						 </tbody>
						 <tr class="total" style="text-align:left;background-color:#000000;color: white;">
								<td>Total Icome Deposit</td>
								<td style="text-align:center;background-color:#000000;color: white;">PKR <?php echo  $rows['amount']?></td>
							</tr>
							<tr class="total" style="text-align:left;color: white;">
								<td></td>
								 
							</tr>
					 
					</table>
					 
					 </div>
					 </div>
		</div>
					 <div >
					 	<p>Sign:___________________</p>
					 	 
					 </div>
				</div>

			</div>

			<!--  College Copy /////////////////////////////////////////-->
<div class="col-md-4">
			<div class="challan">
				<div class="row" style="height:20px">
				<div class="col-md-12" style="height:20px" >
                  <p><img src="Includes/img/college.png"
                        class="" width="40" alt=""> <b>New Advance College Of Nursing</b></p>
                  </div>
            </div>
            <hr class="solid">
					<div class="d-flex" style="margin-top: -13px;padding: 0;height: -1px;">
						<div class="row" style="height:10px">
							<div class="col-sm-6">
                    
                        <b><p >Date:<span><?php echo  $rows['dateofpayment']?></span></p></b>
                       
              				  </div>
              				  <div class="col-sm-6">
                    
                        <b><p >Income Receipt#: <span><?php echo  $rows['oiid']?></span></p></b>
                       
              				  </div>
              				  
                			</div>
                			 
                	 
                 
                </div>
                <div class="row">
							<div class="col-sm-6">
                    
                        <b><p>Purpose:<span><?php echo  $rows['purposeofpayment']?></span></p></b>
                       
              				  </div>
              				  <div class="col-sm-6">
                    
                        <b><p >Created By: <span><?php echo  $rows['createdby']?></span></p></b>
                       
              				  </div>
              				  
                			</div>
                <div class="row">
							<div class="col-sm-12">
               
			

				<div class="table-responsive" >

					<table  class="table">
						<thead>
							<tr>
								<th style="text-align:center;background-color:#000000;color: white;width: 50%">Description</th>
								<th style="text-align:center;background-color:#000000;color: white;width: 50%">Amount</th>
							</tr>
						</thead>
						<tbody>
							<tr class="info" style="text-align:center;">
								<td><?php echo  $rows['description']?></td>
								<td><b><?php echo  $rows['amount']?></b></td>
							</tr>
							 
							 
						 </tbody>
						 <tr class="total" style="text-align:left;background-color:#000000;color: white;">
								<td>Total Icome Deposit</td>
								<td style="text-align:center;background-color:#000000;color: white;">PKR <?php echo  $rows['amount']?></td>
							</tr>
							<tr class="total" style="text-align:left;color: white;">
								<td></td>
								 
							</tr>
					 
					</table>
					 
					 </div>
					 </div>
		</div>
					 <div >
					 	<p>Sign:___________________</p>
					 	 
					 </div>
				</div>

			</div>

			<!--  College Copy /////////////////////////////////////////-->

      <!--  College Copy /////////////////////////////////////////-->             
      <!--  Student Copy /////////////////////////////////////////-->
             <div class="col-md-4">
			<div class="challan">
				<div class="row" style="height:20px">
				<div class="col-md-12" style="height:20px" >
                  <p><img src="Includes/img/college.png"
                        class="" width="40" alt=""> <b>New Advance College Of Nursing</b></p>
                  </div>
            </div>
            <hr class="solid">
					<div class="d-flex" style="margin-top: -13px;padding: 0;height: -1px;">
						<div class="row" style="height:10px">
							<div class="col-sm-6">
                    
                        <b><p >Date:<span><?php echo  $rows['dateofpayment']?></span></p></b>
                       
              				  </div>
              				  <div class="col-sm-6">
                    
                        <b><p >Income Receipt#: <span><?php echo  $rows['oiid']?></span></p></b>
                       
              				  </div>
              				  
                			</div>
                			 
                	 
                 
                </div>
                <div class="row">
							<div class="col-sm-6">
                    
                        <b><p>Purpose:<span><?php echo  $rows['purposeofpayment']?></span></p></b>
                       
              				  </div>
              				  <div class="col-sm-6">
                    
                        <b><p >Created By: <span><?php echo  $rows['createdby']?></span></p></b>
                       
              				  </div>
              				  
                			</div>
                <div class="row">
							<div class="col-sm-12">
               
			

				<div class="table-responsive" >

					<table  class="table">
						<thead>
							<tr>
								<th style="text-align:center;background-color:#000000;color: white;width: 50%">Description</th>
								<th style="text-align:center;background-color:#000000;color: white;width: 50%">Amount</th>
							</tr>
						</thead>
						<tbody>
							<tr class="info" style="text-align:center;">
								<td><?php echo  $rows['description']?></td>
								<td><b><?php echo  $rows['amount']?></b></td>
							</tr>
							 
							 
						 </tbody>
						 <tr class="total" style="text-align:left;background-color:#000000;color: white;">
								<td>Total Icome Deposit</td>
								<td style="text-align:center;background-color:#000000;color: white;">PKR <?php echo  $rows['amount']?></td>
							</tr>
							<tr class="total" style="text-align:left;color: white;">
								<td></td>
								 
							</tr>
					 
					</table>
					 
					 </div>
					 </div>
		</div>
					 <div >
					 	<p>Sign:___________________</p>
					 	 
					 </div>
				</div>

			</div>

			<!--  College Copy /////////////////////////////////////////-->
      <!--  Student Copy /////////////////////////////////////////-->
                     
                
		 
		
			
			
		</div>
	</div>
</body>
</html>
