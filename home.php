<?php
session_start();
include 'helper.php';

//echo  $_SESSION['login'];
if(!isset($_SESSION["login"]))
{
  header("location:index.php");
}
if(isset($_GET['deletedriver']))
{
    $id=$_GET['deletedriver'];
    deletedriver($id);
}
if(isset($_GET['deletebin']))
{
    $id=$_GET['deletebin'];
    deletebin($id);
}
if(isset($_POST['logout']))
{
session_destroy();
header("location:index.php");
}
if(isset($_POST['addbin']))
{
$lat=$_POST['lat'];
$lng=$_POST['lng'];
$name=$_POST['name'];
addbin($lat,$lng,$name);
}
if(isset($_POST['addriver']))
{
$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$password=$_POST['password'];
addriver($name,$phone,$email,$password);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SmartBin</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	<style>
		.card{
			padding: 20px;
			margin: 20px;
		}
		button{

			margin-top: 10px
		}
		.card-header{
			background-color: unset;
		}
	</style>
</head>
<body class="bg-secondary">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="feedback.php">User Feedback</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="report.php">Report</a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
       <div class="navbar-nav mr-auto nav-item active">
           <form method="post">
        <button name="logout" class="btn btn-danger" href="#">Logout <small>>></small></button>
        </form>
      </div>
    </div>
  </div>
</nav>
<div class="container-fluid">




    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" >
                    <h1>Smart Bin</h1>
                </div>

<!--                    <img src="sm1bin.jpg"  class="img-fluid" alt="" style="padding: unset;">-->
                    <iframe src="http://localhost/smartbin/smartbin/admin.php" frameborder="0"  allowfullscreen="" style="width: 100%;height: 100%;margin:0px;border: 0;"></iframe>

            </div>
            <div class="card">
                <div class="card-header" >
                    <h4>Driver Detail</h4>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1" style="box-shadow: unset;">
                    View Driver
                </button>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" style="box-shadow: unset;">
                    Add Driver
                </button>

            </div>
            <div class="card">
                <div class="card-header" >
                    <h4>Bin Detail</h4>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" style="box-shadow: unset;">
                    Add Bin
                </button>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Bin Status</h3>
                </div>
                <div  >
                     <table id="example" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">name</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php viewbin(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Driver</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
 <?php viewdriver(); ?>
  </tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Driver</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">First Name</label>
    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="First name">
  </div>
  <div class="form-group">
    <label for="Phones">Phone</label>
    <input type="tel" name="phone" class="form-control" id="Phones"  placeholder="Phone">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail3">Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail3"  placeholder="Email">
  </div>
  <div class="form-group">
    <label for="Passwords">Password</label>
    <input type="password" name="password" class="form-control" id="Passwords"  placeholder="Password">
  </div>
 <button name="addriver" class="btn btn-primary btn-block">Add Driver</button>
</form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Bin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

               <form method="post">
      <div class="form-group">
    <label for="exampleInputPassword1">Location name</label>
    <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="Name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Latitude</label>
    <input type="text" name="lat" class="form-control" id="exampleInputEmail1" placeholder=" Latitude">
  </div>
   <div class="form-group">
    <label for="exampleInputEmail2">Longitude</label>
    <input type="text" name="lng" class="form-control" id="exampleInputEmail2"  placeholder="Longitude">
  </div>
 <button name="addbin" class="btn btn-primary btn-block">Add Bin</button>
              </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Report Generate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</body>
  <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
  </script>
</html>
