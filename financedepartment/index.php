<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta name="description" content="Attendence Portal for the College, New Advance College for Nursing Created and maintain by RMTech Developers Lahore Based Software Company">

      <meta name="keywords" content="newadvancecollegefornursing,nursing college lahore,advance nursing college, new advance college for Nursing lahore township, best college for Nursing in lahore,nursing institute in lahore near johar town township,easy to learn system,Attendence system for college Nursing institute, new Advance College of Nursing lahore Attendence management system Lahore, take Attendence online,online Attendence Portal new Advance College of Nursing">
      <meta name="author" content=" new advance nursing college lahore Owner of the Website and Business Developer Rana marwat hussain marwathussain.tk">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="Includes/img/logo/attnlg.jpg" rel="icon">
  <title>FMS - Login</title>
  <link href="Includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="Includes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="Includes/css/ruang-admin.min.css" rel="stylesheet">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>

<body class="bg-gradient-login" style="background-image: url('Includes/img/logo/loral1.jpe00g');">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                <div class="text-center">
                    <img src="Includes/img/logo/logo.png" style="width:300px;height:200px">
                    <br><br>
                     
                  </div>
                  <form class="user" method="Post" action="">
                  <div class="form-group">
                  <select required name="userType" class="form-control mb-3">
                          <option value="">--Select User Roles--</option>
                          <option value="Ceo">CEO</option>
                          <option value="Administrator">Administrator</option>
                          <option value="staff">Staff</option>
                  </select>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" required name="username" id="exampleInputEmail" placeholder="Employee ID/UserName">
                    </div>
                    <div class="form-group">
                      <input type="password" name = "password" required class="form-control" id="exampleInputPassword" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <!-- <label class="custom-control-label" for="customCheck">Remember
                          Me</label> -->
                      </div>
                    </div>
                    <div class="form-group">
                        <input type="submit"  class="btn btn-success btn-block" value="Login" name="login" />
                    </div>
                     </form>

<?php
include 'Includes/dbcon.php';
if(isset($_POST['login'])){

    $userType = $_POST['userType'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = $password;

    if($userType == "Administrator"){

      $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
      $rs = $conn->query($query);
      $num = $rs->num_rows;
      $rows = $rs->fetch_assoc();

      if($num > 0){

        $_SESSION['empcode']= $rows['empcode'];
        $_SESSION['firstname'] = $rows['firstname'];
        $_SESSION['lastname'] = $rows['lastname'];
        $_SESSION['email'] = $rows['email'];
 echo "<script type = \"text/javascript\">
        window.location = ('Admin/index.php')
        </script>";
       
      }

      else{

        echo "<div class='alert alert-danger' role='alert'>
        Invalid Username/Password!
        </div>";

      }
    }
    else if($userType == "staff"){

       $query = "SELECT * FROM staff WHERE username = '$username' AND password = '$password' AND empstatus='ACTIVE'";
      
      $rs = $conn->query($query);
      $num = $rs->num_rows;
      $rows = $rs->fetch_assoc();

      if($num > 0){

         $_SESSION['empcode']= $rows['empcode'];
        $_SESSION['firstname'] = $rows['firstname'];
        $_SESSION['lastname'] = $rows['lastname'];
        $_SESSION['email'] = $rows['email'];

        echo "<script type = \"text/javascript\">
        window.location = (\"staff/index.php\")
        </script>";
      }

      else{

        echo "<div class='alert alert-danger' role='alert'>
        Invalid Username/Password!
        </div>";

      }
    }else if($userType == "Ceo"){

       $query = "SELECT * FROM ceo WHERE username = '$username' AND password = '$password'";
      $rs = $conn->query($query);
      $num = $rs->num_rows;
      $rows = $rs->fetch_assoc();

      if($num > 0){

        $_SESSION['empcode']= $rows['empcode'];
        $_SESSION['firstname'] = $rows['firstname'];
        $_SESSION['lastname'] = $rows['lastname'];
        $_SESSION['email'] = $rows['email'];

        echo "<script type = \"text/javascript\">
        window.location = (\"ceo/index.php\")
        </script>";
      }

      else{

        echo "<div class='alert alert-danger' role='alert'>
        Invalid Username/Password!
        </div>";

      }
    }else {

        echo "<div class='alert alert-danger' role='alert'>
        Invalid Username/Password!
        </div>";

    }
}
?>
 <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <footer class="sticky-footer1 bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span> &copy; <script> document.write(new Date().getFullYear()); </script> - All Rights Reserved New Advance College Of Nursing - Developed by <a href="https://marwathussain.tk" target="_blank">RMTech</a>
            </span>
          </div>
        </div>
      </footer>
  <script src="Includes/vendor/jquery/jquery.min.js"></script>
  <script src="Includes/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="Includes/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="Includes/js/ruang-admin.min.js"></script>
</body>

</html>