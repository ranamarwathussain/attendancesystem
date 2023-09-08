<?php include 'Includes/dbcon.php';
   $rollnumber=10001;
    $pid = intval($_GET['q']);

    $qry= "SELECT * FROM student_info where stdid=".$pid." ";
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
              <input type="hidden" name="stdid" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['stdid'];?>" />
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
                <input type="email" name="email" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['email'];?>" disabled />
                 <input type="hidden" name="email" class="form-control"   required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['email'];?>"  />
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Contact</label><span class="text-danger ml-2">*</span>
                <input type="number" name="contact" class="form-control" required="required" value="<?php echo $rows['contact'];?>" disabled />
                <input type="hidden" name="contact" class="form-control" required="required" value="<?php echo $rows['contact'];?>" />
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Address</label><span class="text-danger ml-2">*</span>
                <input type="text" name="address" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['address'];?>" disabled />
                <input type="hidden" name="address" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['address'];?>" />
              
              </div>
               <div class="col-xs-7 col-sm-6 col-lg-6">
                 <label class="form-control-label">Gender<span class="text-danger ml-2">*</span></label>
                        <select disabled name="gender"   class="form-control mb-3" >
                          <option value="<?php echo $rows['firstname'];?>"><?php echo $rows['gender'];?> </option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Other">Other</option>

                 </select>
                 <input type="hidden" name="gender" class="form-control" required="required" oninput="this.value = this.value.toUpperCase()" value="<?php echo $rows['gender'];?>"/>

              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Student CNIC</label><span class="text-danger ml-2">*</span>
                <input type="number" name="stdcnic" class="form-control" value="<?php echo $rows['stdcnic'];?>"  required="required" disabled/>
                 <input type="hidden" name="stdcnic" class="form-control" value="<?php echo $rows['stdcnic'];?>"  required="required" />
              
              </div>
               <div class="col-xs-7 col-sm-6 col-lg-6">
                 <label class="form-control-label">Guardian<span class="text-danger ml-2">*</span></label>
                        <select disabled name="guardian"  class="form-control mb-3">
                          <option value="<?php echo $rows['gardian'];?>"><?php echo $rows['gardian'];?> </option>
                          <option value="Mother">Mother</option>
                          <option value="Father">Father</option>
                          <option value="Mother/Father">Mother/Father</option>
                          <option value="Other Person">Other Person</option>

                 </select>


              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Parent/Guardian CNIC</label><span class="text-danger ml-2">*</span>
                <input type="number" name="pcnic" class="form-control"   value="<?php echo $rows['parentcnic'];?>" required="required" disabled/>
              
              </div>
              <div class="col-xs-7 col-sm-6 col-lg-6">
                <label>Parent/Guardian Contact</label><span class="text-danger ml-2">*</span>
                <input type="number" name="pcontact" class="form-control"  value="<?php echo $rows['parentcontact'];?>" required="required" disabled/>
              
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
               </div>
                
                 <div class="col-xs-7 col-sm-6 col-lg-12">
                 <label class="form-control-label">Fine Type<span class="text-danger ml-2">*</span></label>
                        <select required name="finetype"  class="form-control mb-3">
                           <option value="">--Select Fine Type--</option>
                          <option value="Late Coming">Late Coming</option>
                          <option value="Short Attendance">Short Attendance</option>
                          <option value="Other">Other</option>
                        </select>
                     </div>
                <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Due Date:</label><span class="text-danger ml-2">*</span>
                <input type="date" name="duedate" class="form-control"   required="required"/>
                   
              
              </div>

                     

                <div class="col-xs-7 col-sm-6 col-lg-12">
                <label>Amount</label><span class="text-danger ml-2">*</span>
                <input type="number" name="fineamount" class="form-control"     required/>
                 
              
              </div>
                       
             </div>
          
 


