<?php session_start();
include 'Includes/dbcon.php';
include 'Includes/session.php';
extract($_POST);
$paidbalancecolected=0;
$remainingbalancecolected=0;
////////////////////////making dates///////////////
$month_name =$fname;
$date_array = date_parse($month_name);
$month_number = $date_array["month"];
$currentyear=date("Y");
if($month_number<=9)
{
$startdatefordata=$currentyear.'-0'.$month_number.'-01'.' '.'00:00:00';
}
else
{
    $startdatefordata=$currentyear.'-'.$month_number.'-01'.' '.'00:00:00';


}
  

$month_name =$lname;
$date_array = date_parse($month_name);
$month_number = $date_array["month"];
$currentyear=date("Y");
if($month_number<=9)
{
$enddatefordata=$currentyear.'-0'.$month_number.'-31'.' '.'00:00:00';
}
else
{
   $enddatefordata=$currentyear.'-'.$month_number.'-31'.' '.'00:00:00';


}
 
//////////////////////////////Query to get data inclusive all date ranges////////////
/*SELECT * FROM `challan` where approvedon >= '2023-04-27'
   and approvedon <= '2023-04-28' + INTERVAL 1 DAY;  */
///////////////////////////////
$sqlpcode= "SELECT * FROM student_info WHERE regnumber = '".$regnumber."'";
$getpcode= $conn->query($sqlpcode);
$pcodeget = $getpcode->fetch_assoc();

$start_month =$fname;
$end_month = $lname;
$start_month_number = date('n', strtotime($start_month));
$end_month_number = date('n', strtotime($end_month));
if ($start_month_number > $end_month_number) {
    
    echo "<script>alert('Starting Month Should be Less than the Ending Month!')</script>";
        echo "<script>window.location = 'paymentreportstudent.php'</script>";
}else
{
/*$month_range = range($start_month_number, $end_month_number);

    $last_index = count($month_range) - 1;
    $totalmonths=$month_range[$last_index];*/
$start_date = new DateTime($start_month);
$end_date = new DateTime($end_month);
 
$interval = $start_date->diff($end_date);

$months = $interval->m;
$years = $interval->y;
 
$total_months = $years * 12 + $months;
$totalmontsget=$total_months+1;
///////////////////////////////getting monthly cost///////////////////
$programcost=$pcodeget['padmission']+$pcodeget['pcost'];
$costcalculation=12*$pcodeget['pduration'];
$totalmonthlycostprogram=$programcost/$costcalculation;

$totalcostpayable=$totalmonthlycostprogram*$totalmontsget;
///////////////////////////////getting monthly cost///////////////////
 $query = "SELECT * FROM staff WHERE empcode = '".$_SESSION["empcode"]."'";
  $rs = $conn->query($query);
  $get = $rs->fetch_assoc();
$fullName = $get['firstname'].' '.$get['lastname'];
 
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <title>Program Wise Students Remainings</title>
        
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

            <p style = "text-align: right; font-size:12pt; font-weight:bold;">Student Deposite History (Month Wise)</p>
        <div align="right" style="font-size:12pt;">
        <p style="text-align: right;font-size:12pt;"> <b style="color:black;text-align: right;">Date Prepared:</b>
         <?php $date = date('d-m-y h:i:s');
echo "<b>".$date."</br>";?></p>
        </div>          
        <b style="font-size:14pt; font-weight:bold;"><div align="center">
           Student Deposite History (Month Wise)<br>
            </div></b>
<style type="text/css">
                      form-group-row.input {
                        font-weight:bold;
                             
                       }
 
   .input {font-weight:bold;}
 
        </style>
        <div class="row">
  <div class="col-lg-4">
    <input type="text" class="form-control input" value="<?php echo 'Report: from'.' '.$start_month.' '.'To'.' '.$end_month.' '.'('.$month_number.')';?>" disabled>
  </div>
  <div class="col-lg-3">
    <input type="text" class="form-control input" value="<?php echo 'Total Cost:'.' '.$programcost;?>" disabled>
  </div>
   <div class="col-lg-2">
    <strong><input type="text" class="form-control input" value="<?php echo 'Total Years:'.' '.$pcodeget['pduration'];?>" disabled ></strong>
  </div>
  <div class="col-lg-3">
    <strong><input type="text" class="form-control input" value="<?php echo 'Total Payable:'.' '.$totalcostpayable;?>" disabled ></strong>
  </div>
</div>
<table class="table table-striped" style="align-content: left;">
                            <thead>
                  <tr>
                    <tr>
                        <th scope="col">Student Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Reg#</th>
                        <th scope="col">Program Code</th>
                        <th scope="col">Program Name</th>
                        <th scope="col">Paid Balance</th>
                        <th scope="col">Remaining Balance</th>
                        <th scope="col">Status</th>
                          
                       
                       </tr>
                    
                  </tr>
                </thead>
                          <tbody>
                   <?php
                   
                  $query2 = "SELECT sum(fee) as fee,sum(otherfee) as otherfee,firstname,lastname,regnumber,pcode,pname,contact FROM `challan` where challanstatus='Paid' and regnumber='".$regnumber."' AND  approvedon>='".$startdatefordata."' AND approvedon<='".$enddatefordata."'  order by  challanid";
                    $rs2 = $conn->query($query2);
                      $num2 = $rs2->num_rows;
                      $sn=0;
                      if($num2 > 0)
                      { 
                        while ($rows2 = $rs2->fetch_assoc())
                          {
                             $totalrevinue=$rows2['fee']+$rows2['otherfee'];
                             $remainnigamount=$totalcostpayable-$totalrevinue;
                                 
                                 
                                 if($totalrevinue==0)
                                 {

                                 }else
                                 {
                                 $paidbalancecolected=$paidbalancecolected+$totalrevinue;

                                 $remainingbalancecolected=$remainingbalancecolected+$remainnigamount;
                                    if($totalcostpayable>$totalrevinue)
                                     {
                                         echo"
                                            <tr style='color:black;background-color:#FFCCCB;'>
                                             
                                            <td>".$rows2['firstname'].' '.$rows2['lastname']."</td>
                                             <td><b>".$rows2['contact']."</b></td>
                                            <td>".$rows2['regnumber']."</td>
                                            <td>".$rows2['pcode']."</td>
                                            <td>".$rows2['pname']."</td>
                                             <td>".$totalrevinue."</td>
                                             <td><b>".$remainnigamount."</b></td>";
                                     echo "<td><b>Defaulter</b></td>";
                                     }
                                     else
                                     {  echo"
                                            <tr style='color:black;background-color:#90ee90;'>
                                             
                                            <td>".$rows2['firstname'].' '.$rows2['lastname']."</td>
                                             <td><b>".$rows2['contact']."</b></td>
                                            <td>".$rows2['regnumber']."</td>
                                            <td>".$rows2['pcode']."</td>
                                            <td>".$rows2['pname']."</td>
                                             <td>".$totalrevinue."</td>
                                             <td><b>".$remainnigamount."</b></td>";
                                     
                                         echo "<td><b>Cleared</b></td>";
                                     }
                                 }
                                
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
                  <tr>

                 
                </tbody>
                          <style>
        /* Rounded border */
hr.rounded {
  border-top: 8px solid #000000;
  border-radius: 5px;
  color: black;
}
</style>
       
<hr class="rounded">
               <?php
                   $query21 = "SELECT sum(pcost) as fee,pname,pcode FROM `student_balance` where regnumber='".$regnumber."' order by  bid";
                   $rs21 = $conn->query($query21);
                   $paidbalance=$rs21->fetch_assoc();
                   echo"
                                <tr >
                                 
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                 <td><b>Total Amount Collected for Program:".' '.$paidbalance['pname'].'-'.$paidbalance['pcode']."</b></td>
                                <td><b>".$paidbalancecolected."</b></td>
                                <td><b>".$remainingbalancecolected."</b></td>
                                <td></td>
                                </tr>";
                             ?>
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
<?php
    }
?>