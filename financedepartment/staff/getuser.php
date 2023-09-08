<?php include 'Includes/dbcon.php';
   $rollnumber=10001;
    $pid = intval($_GET['q']);

    $qry= "SELECT * FROM program where pid=".$pid." ";
    $result = $conn->query($qry);
    $num = $result->fetch_assoc(); 
////////////////////////////////////////////////////////////////
    
    $query=mysqli_query($conn,"select * from student_info where pname='".$num['pname']."' ORDER BY stdid DESC LIMIT 1");

    $result1 =$query->fetch_assoc();
    $ret=mysqli_num_rows($query);
    if($ret>0)
    {
        $concateregnumber= $num['pname'].$result1['sequanceid'] ;
        ?>
    
     <input type="text" name="regnumber" class="form-control" value="<?php echo  $concateregnumber;?>"disabled/>
     <input type="hidden" name="regnumber" class="form-control" value="<?php echo $concateregnumber;?>"/>
      <input type="hidden" name="seqid" class="form-control" value="<?php echo  $result1['sequanceid']+1;?>"/>
     <input type="hidden" name="pname" class="form-control" value="<?php echo $num['pname'];?>"/>
     <input type="hidden" name="pcode" class="form-control" value="<?php echo $num['pcode'];?>"/>
     <input type="hidden" name="pduration" class="form-control" value="<?php echo $num['pduration'];?>"/>
     <input type="hidden" name="pcost" class="form-control" value="<?php echo $num['pcost'];?>"/>
     <input type="hidden" name="padmission" class="form-control" value="<?php echo $num['padmission'];?>"/>
<?php
        
    }
    else
    {
         
        ?>
     <input type="text" name="regnumber" class="form-control" value="<?php echo $num['pname'].$rollnumber;?>"disabled/>
     <input type="hidden" name="regnumber" class="form-control" value="<?php echo $num['pname'].$rollnumber;?>"/>
     <input type="hidden" name="seqid" class="form-control" value="<?php echo  $rollnumber;?>"/>
     <input type="hidden" name="pname" class="form-control" value="<?php echo $num['pname'];?>"/>
     <input type="hidden" name="pcode" class="form-control" value="<?php echo $num['pcode'];?>"/>
     <input type="hidden" name="pduration" class="form-control" value="<?php echo $num['pduration'];?>"/>
     <input type="hidden" name="pcost" class="form-control" value="<?php echo $num['pcost'];?>"/>
     <input type="hidden" name="padmission" class="form-control" value="<?php echo $num['padmission'];?>"/>
    <?php 


    }
   
               
 
?>

