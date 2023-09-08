<?php session_start();
?>
<?php 
error_reporting(0);
include 'Includes/dbcon.php';
include 'ncludes/session.php';
?>
        <table border="1">
        <thead>
            <tr><b><p style="font-size: 30;text-align: center;">*!Attendace Report Auto Generated!*</p></b></tr>
            <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Admission No</th>
                        <th>Class</th>
                        <th>Class Section</th>
                        <th>Session</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Percentage</th>
                      </tr>
            
        </thead>

<?php 
extract($_POST);
$filename="Attendance list";
$sessionyear= strftime("%Y", time());
$dateTaken = date("Y-m-d");
///////////////////section///////////////
$q1="select * from tblclassarms where Id='$sectionId';";
$r1=$conn->query($q1);
$classsection=$r1->fetch_assoc();
//////////////////////////////////////////////////class 
$q12="select * from tblclass where Id='".$classsection['classId']."';";
$r12=$conn->query($q12);
$class=$r12->fetch_assoc();
/////////////////////////////////
$q="select * from  assignteacherclass where tclasssectionid='$sectionId';";
$section1=$conn->query($q);
$result1=$section1->fetch_assoc();

//////total Class of the respective Section and Class

$tc="select COUNT(DISTINCT dateTimeTaken) from tblattendance where classId='".$result1['tclassid']."' And classArmId='".$result1['tclasssectionid']."' ";
$tclass=$conn->query($tc);
$totalclasses=$tclass->fetch_assoc();

////////////////////

$query = "SELECT  * from tblattendance where classId='".$result1['tclassid']."' and classArmId='".$result1['tclasssectionid']."'   and sessionTermId='$sessionyear' ORDER BY firstName ASC; ";
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
                            
                            $tscp="select COUNT(*) from tblattendance where classId='".$result1['tclassid']."' And classArmId='".$result1['tclasssectionid']."' and admissionNo='".$rows['admissionNo']."' and status='1' ";
                            $tstdclassp=$conn->query($tscp);
                            $tstdclasspre=$tstdclassp->fetch_assoc();
                            $percent=($tstdclasspre['COUNT(*)']/$totalclasses['COUNT(DISTINCT dateTimeTaken)'])*100;

                              if($rows['status'] == '1'){$status = "Present"; $colour="#00FF00";}else{$status = "Absent";$colour="#FF0000";}
                             $sn = $sn + 1;
                            echo"
                              <tr>
                                <td>".$sn."</td>
                                 <td>".$rows['firstName']."</td>
                                <td>".$rows['lastName']."</td>
                                <td>".$ts1['admissionNumber']."</td>
                                <td>".$result1['tclass']."</td>
                                <td>".$result1['tclasssection']."</td>
                                <td>".$rows['sessionTermId']."</td>
                        
                                <td style='background-color:".$colour."'>".$status."</td>
                                 
                                <td>".$rows['dateTimeTaken']."</td>
                                <td>".$percent."%</td>
                              </tr>";





           
                      
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$result1['tname']."-".$filename."-".$result1['tclass']."-".$result1['tclasssection']."-".$sessionyear."-report.xls");
header("Pragma: no-cache");
header("Expires: 0");



                          }
                          echo "<tr>
                          <td>
                          </td>
                          <td>
                          </td>
                          <td>
                          </td>
                          <td>
                          </td>
                          <td>
                          </td>
                          <td>
                          </td>
                          <td style='height:100px'><b>Teacher Name & Signature </b>
                          </td>
                          <td style='height:100px'>
                          </td>
                          <td>
                          </td>
                           
                           </tr>
                           ";

                           

                    
			
			}
	
                      else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }

            

?>
</table>