<?php session_start();
?>
<?php 
error_reporting(0);
include "xlsx.php";
include '../Includes/dbcon.php';
include '../Includes/session.php';


if(isset($_POST["submit_file"]))
{
  $dateCreated = date("Y-m-d");
  $sampPass = "pass123";
  $sampPass_2 =$sampPass;

if(isset($_FILES['excel']['name'])){
  
  if($conn){
    $excel=SimpleXLSX::parse($_FILES['excel']['tmp_name']);
    echo "<pre>"; 
    // print_r($excel->rows(1));
    print_r($excel->dimension(2));
    print_r($excel->sheetNames());
        for ($sheet=0; $sheet < sizeof($excel->sheetNames()) ; $sheet++) { 
        $rowcol=$excel->dimension($sheet);
        $i=0;
        if($rowcol[0]!=1 &&$rowcol[1]!=1){
    foreach ($excel->rows($sheet) as $key => $row) {
      //print_r($row);
      $q="";
      foreach ($row as $key => $cell) {
        //print_r($cell);echo "<br>";
        if($i==0){

          $q.=$cell. " varchar(50),";
        }else{
          

              $q.="'".$cell. "',";
             
          
        }
      }
      if($i==0){
         
        $query="INSERT INTO tblstudents values ('',".rtrim($q,",").",'$sampPass_2','$dateCreated');";
      
      
        
      }else{
         
        $query="INSERT INTO tblstudents values ('',".rtrim($q,",").",'$dateCreated');";
        echo $query; echo '<br>';
         
      }
      
      if(mysqli_query($conn,$query))
      {
        $_SESSION['getuser']="ok";
      }
      echo "<br>";
      $i++;
    }
  }
    }
  }
}
echo "<script>window.location='../createStudents.php';</script>";
}

?>