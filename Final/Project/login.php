<?php
session_start();
error_reporting(0);
include("include/config.php");
if(isset($_POST['submit']))
{
$ret=mysqli_query($con,"SELECT * FROM users WHERE email='".$_POST['username']."' and password='".md5($_POST['password'])."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="panel.php";//
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
// For stroing log if user login successfull
$log=mysqli_query($con,"insert into userlog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['login']."','$uip','$status')");
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
	// For stroing log if user login unsuccessfull
$_SESSION['login']=$_POST['username'];	
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
mysqli_query($con,"insert into userlog(username,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$_SESSION['errmsg']="Invalid username or password";
$extra="panel.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="style2.css">

  <title>Login | Hospital Management System </title>
    
  </head>
  <style type="text/css">
    #inputbtn:hover{cursor:pointer;}
    .card{
    background: #f8f9fa;
    border-top-left-radius: 5% 5%;
    border-bottom-left-radius: 5% 5%;
    border-top-right-radius: 5% 5%;
    border-bottom-right-radius: 5% 5%;
}

  </style>
  <body style="background: -webkit-linear-gradient(left, #3931af, #00c6ff); background-size: cover;">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" >
    <div class="container">

      <a class="navbar-brand js-scroll-trigger" href="index.php" style="margin-top: 10px;margin-left:-65px;font-family: 'IBM Plex Sans', sans-serif;"><h4><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp Hospital Management System</h4></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" style="margin-right: 40px;">
            <a class="nav-link js-scroll-trigger" href="index.php" style="color: white;font-family: 'IBM Plex Sans', sans-serif;"><h6>HOME</h6></a>
          </li>
  
          <li class="nav-item" style="margin-right: 40px;">
            <a class="nav-link js-scroll-trigger" href="portal.php" style="color: white;font-family: 'IBM Plex Sans', sans-serif;"><h6>PORTAL</h6></a>
          </li>

          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="contact.html" style="color: white;font-family: 'IBM Plex Sans', sans-serif;"><h6>CONTACT</h6></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<section>

    <div class="container-fluid" style="margin-top:60px;margin-bottom:60px;color:#34495E;">
      <div class="row">

        

         <div class="col-md-7" style="padding-left: 180px; ">
                 <div style="-webkit-animation: mover 2s infinite alternate;
    animation: mover 1s infinite alternate;">
          <img src="img/p3.jpg" alt="" style="width: 70%;padding-left: 40px;margin-top: 150px;margin-left: 45px;margin-bottom:15px">
      </div>

     

         </div>

         <div class="col-md-4" style="margin-top: 6%;right: 8%">
          <div class="card" style="font-family: 'IBM Plex Sans', sans-serif;">
            <div class="card-body">
              <center>
                <i class="fa fa-hospital-o fa-3x" aria-hidden="true" style="color:#0062cc"></i>
                <br>
              <h3 style="margin-top:3%">Patient Login</h3><br>
			  <p>
								Please enter your name and password to log in.<br />
								<span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg']="";?></span>
			</p>
              <form class="form-login" method="post">
                <div class="row" style="margin-top: 4%">
                  <div class="col-md-4"><label>Email-ID: </label></div>
                  <div class="col-md-8"><input type="text" class="form-control" name="username" placeholder="Username"></div><br><br>
                  <div class="col-md-4" style="margin-top: 3%"><label>Password: </label></div>
                  <div class="col-md-8" style="margin-top: 3%">
				  <input type="password" class="form-control password" name="password" placeholder="Password">
				  </div><br><br><br>
                </div>
                <div class="row">
                 <div class="col-md-4"  style="padding-left: 50%;margin-top:5%">
                    <center><input type="submit" id="submit" name="submit" value="Login" class="btn btn-primary"></center>
				</div>           
                  
                </div>
              </form>
            </center>
            </div>
          </div>
        </div>


      </div>
    </div>

</section>


<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>