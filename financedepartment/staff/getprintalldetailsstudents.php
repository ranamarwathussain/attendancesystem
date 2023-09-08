<?php session_start();

include 'Includes/dbcon.php';
include 'Includes/session.php';
extract($_POST);

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
        <title>Student</title>
        
<script>
function printPage() {
    window.print();
}
</script>

</head>
<body>
<?php if(isset($_POST['check']))
{
    ?>
    <div class = "container">
        <div id = "header">
        <br/>

            <p style = "text-align: right; font-size:12pt; font-weight:bold;">Program Wise Report</p>
        <div align="right" style="font-size:12pt;">
        <p style="text-align: right;font-size:12pt;"> <b style="color:black;text-align: right;">Date Prepared:</b>
         <?php $date = date('d-m-y h:i:s');

echo "<b>".$date."</br>";?></p>
        </div>          
        <b style="font-size:14pt; font-weight:bold;"><div align="center">
             Student List<br>
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
   
<hr class="rounded">
         <style type="text/css">
                      form-group-row.input {
                        font-weight:bold;
                             
                       }

        </style>
        

 <b style="font-size:14pt; font-weight:bold;"><div align="center">
            <br>
            </div></b>
 <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Roll#</th>
                        <th>Name</th>
                       
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>CNIC</th>
                        <th>Guardian details</th>
                        <th>Program</th>
                        <th>Status</th>
                         
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php
                       $query = "Select * from student_info where pcode='$pcode' and studentstatus='$studentstatus';";
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
                                <td><b>". $rows['regnumber']."</b></td>
                                <td><b>".$rows['firstname'].' '.$rows['lastname']."</b></td>
                                
                                <td><b>".$rows['contact']."</b></td>
                                <td><b>".$rows['address']."</b></td>
                                <td><b>".$rows['gender']."</b></td>
                                <td><b>".$rows['stdcnic']."</b></td>
                                <td><b>".$rows['gardian'].'-'.$rows['parentcnic'].'-'.$rows['parentcontact']."</b></td>
                                <td><b>".$rows['pname']."</b></td>
                                <td><b>".$rows['studentstatus']."</b></td>";
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
                 
</style>
<?php
}
?>
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