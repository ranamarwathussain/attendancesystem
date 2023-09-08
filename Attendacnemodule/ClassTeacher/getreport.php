<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'ncludes/session.php';
extract($_POST);
 $q="select * from  assignteacherclass where tclasssectionid='$sectionId';";
                      $section1=$conn->query($q);
                      $result1=$section1->fetch_assoc();
?>
       <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Class Attendance Percentage By Range</h6>
                </div>
                <div class="table-responsive p-3">
             
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover" border="1">
                    <thead class="thead-light">
                      <tr>
                           <th></th>
                            <th></th>
                        <th>Class ::<?php echo $result1['tclass'];?></th>
                        <th>Start Date::<?php echo $sdateTaken;?> </th>
                        <th>End Date::<?php echo $edateTaken;?></th>
                          <th></th>
                           <th></th>
                       
                      </tr>
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Admission No</th>
                        <th>Class</th>
                        <th>Class Section</th>
                        <th>Session</th>
                        <th>%</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php

                      extract($_POST);
                      $q="select * from  assignteacherclass where tclasssectionid='$sectionId';";
                      $section1=$conn->query($q);
                      $result1=$section1->fetch_assoc();

                      $dateTaken =  $_POST['dateTaken'];

//////total Class of the respective Section and Class

$tc="select COUNT(DISTINCT dateTimeTaken) from tblattendance where classId='".$result1['tclassid']."' And classArmId='".$result1['tclasssectionid']."'  and dateTimeTaken between 
                      '$sdateTaken' AND  '$edateTaken' ";
$tclass=$conn->query($tc);
$totalclasses=$tclass->fetch_assoc();

////////////////////
                      $query = "SELECT DISTINCT admissionNo from tblattendance  where classId='".$result1['tclassid']."' and classArmId='".$result1['tclasssectionid']."' and dateTimeTaken between 
                      '$sdateTaken' AND  '$edateTaken'";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                              $tscp1="select * from tblstudents where  Id='".$rows['admissionNo']."' ";
                            $ts=$conn->query($tscp1);
                            $ts1=$ts->fetch_assoc();
                            
                              $tscp="select COUNT(*) from tblattendance where classId='".$result1['tclassid']."' And classArmId='".$result1['tclasssectionid']."' and admissionNo='".$rows['admissionNo']."' and status='1' and dateTimeTaken between 
                      '$sdateTaken' AND  '$edateTaken' ";
                            $tstdclassp=$conn->query($tscp);
                            $tstdclasspre=$tstdclassp->fetch_assoc();
                            $percent=($tstdclasspre['COUNT(*)']/$totalclasses['COUNT(DISTINCT dateTimeTaken)'])*100;
                              if($rows['status'] == '1'){$status = "Present"; $colour="#00FF00";}else{$status = "Absent";$colour="#FF0000";}
                             $sn = $sn + 1;
                            
                            echo"
                              <tr>
                                <td>".$sn."</td>
                                 <td>".$ts1['firstName']."</td>
                                <td>".$ts1['lastName']."</td>
                                <td>".$ts1['admissionNumber']."</td>
                                <td>".$result1['tclass']."</td>
                                <td>".$result1['tclasssection']."</td>
                                <td>".$ts1['sessionyear']."</td>
                               <td>".$percent."%</td>
                              </tr>";
                              header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$result1['tname']."-".$filename."-".$result1['tclass']."-".$result1['tclasssection']."-".$sessionyear."-report.xls");
header("Pragma: no-cache");
header("Expires: 0");
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
