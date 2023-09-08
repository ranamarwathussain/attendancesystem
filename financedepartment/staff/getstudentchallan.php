<?php include 'Includes/dbcon.php';
   $rollnumber=10001;
    $pid = intval($_GET['q']);

    $qry1= "SELECT * FROM student_info where stdid=".$pid." ";
    $result1 = $conn->query($qry1);
    $rows1 = $result1->fetch_assoc(); 

    $qry3= "SELECT * FROM program where pcode='".$rows1['pcode']."' ";
    $result3 = $conn->query($qry3);
    $rows3 = $result3->fetch_assoc(); 

    
    $qry= "SELECT * FROM student_balance where regnumber='".$rows1['regnumber']."' ";
    $result = $conn->query($qry);
    $rows = $result->fetch_assoc(); 
////////////////////////////////////////////////////////////////
    ?>
   
    <div class="modal-header">
            <h4 class="modal-title">Student Detail</h4>
          </div>
          <div class="modal-body">
             <div class="row">
             <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Reg#</label><span class="text-danger ml-2">*</span>
                <input type="text" name="fname" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['regnumber'];?>" disabled/>
                <input type="hidden" name="regnumber" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['regnumber'];?>"/>
              <input type="hidden" name="stdid" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows1['stdid'];?>" />
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>First Name</label><span class="text-danger ml-2">*</span>
                <input type="text" name="fname" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['firstname'];?>" disabled/>
              <input type="hidden" name="fname" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['firstname'];?>" />
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Last Name</label><span class="text-danger ml-2">*</span>
                <input type="text" name="lname" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['lastname'];?>" disabled />
              <input type="hidden" name="lname" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['lastname'];?>"  />
              </div>
                <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Email</label><span class="text-danger ml-2">*</span>
                <input type="email" name="email" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows1['email'];?>" disabled />
                 <input type="hidden" name="email" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows1['email'];?>"  />
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Contact</label><span class="text-danger ml-2">*</span>
                <input type="number" name="contact" class="form-control" required="required" value="<?php echo $rows1['contact'];?>" disabled />
                <input type="hidden" name="contact" class="form-control" required="required" value="<?php echo $rows1['contact'];?>" />
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Address</label><span class="text-danger ml-2">*</span>
                <input type="text" name="address" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows1['address'];?>" disabled />
                <input type="hidden" name="address" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows1['address'];?>" />
              
              </div>
               <div class="col-xs-7 col-sm-6 col-lg-6">
                 <label class="form-control-label">Gender<span class="text-danger ml-2">*</span></label>
                        <select disabled name="gender"   class="form-control mb-3" >
                          <option value="<?php echo $rows1['firstname'];?>"><?php echo $rows1['gender'];?> </option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Other">Other</option>

                 </select>
                 <input type="hidden" name="gender" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows1['gender'];?>"/>

              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Student CNIC</label><span class="text-danger ml-2">*</span>
                <input type="number" name="stdcnic" class="form-control" value="<?php echo $rows['stdcnic'];?>"  required="required" disabled/>
                 <input type="hidden" name="stdcnic" class="form-control" value="<?php echo $rows['stdcnic'];?>"  required="required" />
              
              </div>
               <div class="col-xs-7 col-sm-6 col-lg-6">
                 <label class="form-control-label">Guardian<span class="text-danger ml-2">*</span></label>
                        <select disabled name="guardian"  class="form-control mb-3">
                          <option value="<?php echo $rows1['gardian'];?>"><?php echo $rows1['gardian'];?> </option>
                          <option value="Mother">Mother</option>
                          <option value="Father">Father</option>
                          <option value="Mother/Father">Mother/Father</option>
                          <option value="Other Person">Other Person</option>

                 </select>


              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Parent/Guardian CNIC</label><span class="text-danger ml-2">*</span>
                <input type="number" name="pcnic" class="form-control"   value="<?php echo $rows1['parentcnic'];?>" required="required" disabled/>
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Parent/Guardian Contact</label><span class="text-danger ml-2">*</span>
                <input type="number" name="pcontact" class="form-control"  value="<?php echo $rows1['parentcontact'];?>" required="required" disabled/>
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Program Code</label><span class="text-danger ml-2">*</span>
                <input type="text" name="pcode" class="form-control"  value="<?php echo $rows['pcode'];?>" required="required" disabled/>
                <input type="hidden" name="pcode" class="form-control"  value="<?php echo $rows['pcode'];?>" required="required" />
              
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Program Name</label><span class="text-danger ml-2">*</span>
                <input type="text" name="pname" class="form-control"  value="<?php echo $rows['pname'];?>" required="required" disabled/>
               <input type="hidden" name="pname" class="form-control"  value="<?php echo $rows['pname'];?>" required="required" />
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Total Payable Amount</label><span class="text-danger ml-2">*</span>
                <input type="number" name="pcost" class="form-control"  value="<?php echo $rows['pcost'];?>" required="required" disabled/>
                <input type="hidden" name="pcost" class="form-control"  value="<?php echo $rows['pcost'];?>" required="required" />
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Program Duration</label><span class="text-danger ml-2">*</span>
                <input type="number" name="pduration" class="form-control"  value="<?php echo $rows1['pduration'];?>" required="required" disabled/>
                  <input type="hidden" name="pduration" class="form-control"  value="<?php echo $rows1['pduration'];?>" required="required" />
              
              </div>

              <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Fee Mode</label><span class="text-danger ml-2">*</span>
                <input type="text" name="fmode" class="form-control"  value="<?php echo $rows3['pfeemode'];?>" required="required" disabled/>
                  <input type="hidden" name="feemode" class="form-control"  value="<?php echo $rows3['pfeemode'];?>" required="required" />
              
              </div>

               <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Due Date:</label><span class="text-danger ml-2">*</span>
                <input type="date" name="duedate" class="form-control"   required="required"/>
                   
              
              </div>
               <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Fee:</label><span class="text-danger ml-2">*</span>
                <input type="number" name="mfee" class="form-control"   required="required" />
                 
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Other Charges:</label><span class="text-danger ml-2">*</span>
                <input type="number" name="otherfee" class="form-control"   required="required"/>
                  
              
              </div>
               <div class="col-xl-6">
                <label class="form-control-label">Challan Remarks<span class="text-danger ml-2"></span></label>
                <textarea name="remarks" class="form-control" style="height: 100px"  placeholder="Challan Remarks" oninput="this.value = this.value.toUpperCase()"></textarea>
                </div> 
              

               </div>
              
             </div>
          
 


