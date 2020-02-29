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
$first=$_POST['first'];
$last=$_POST['last'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$password=$_POST['password'];
addriver($first,$last,$phone,$email,$password);
}
$conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');
//  $conn = mysqli_connect('localhost','kbvahg66_crystal','@C=-.rC0-qN?','kbvahg66_crystal') or die('unable to connect');
$record_per_page = 10;
$page = '';
if(isset($_GET["page"]))
{
    $page = $_GET["page"];
}
else
{
    $page = 1;
}

$start_from = ($page-1)*$record_per_page;

$query = "select * from bin_location order by id DESC LIMIT $start_from, $record_per_page";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>SmartBin</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
<nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">


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
                <div class="card-body">
                    <img src="smbin.jpg" style="height: 50px;" class="img-fluid" alt="">
                </div>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal4" style="box-shadow: unset;">
                    Generate report
                </button>


            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Bin Status</h3>
                </div>
                <div  class="table-responsive">
                    <table class="table table-bordered">
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
                        <?php
                        while($row = mysqli_fetch_array($result))
                        {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $row["0"]; ?></th>
                                <td><?php echo $row["1"]; ?></td>
                                <td><?php echo $row["2"]; ?></td>
                                <td><?php echo $row["3"]; ?></td>
                                <td><?php echo $row["4"]; ?></td>
                                <td><a href="?deletebin=<?php echo $row[0]; ?>" name="deletebin" class="btn btn-danger">Delete</a>
                                    <!--          <a href="" name="hidedelete" class="btn btn-warning" style="margin-left: 5px;">Hide</a></td>-->
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <?php
                            $page_query = "select * from bin_location ORDER BY id DESC";
                            $page_result = mysqli_query($conn, $page_query);
                            $total_records = mysqli_num_rows($page_result);
                            $total_pages = ceil($total_records/$record_per_page);
                            $start_loop = $page;
                            $difference = $total_pages - $page;
                            if($difference <= 5)
                            {
                                $start_loop = $total_pages - 5;
                            }
                            $end_loop = $start_loop + 4;
                            if($page > 1)
                            {
                                echo " <li class='page-item'><a class='page-link' href='home.php?page=1'>First</a></li>";
                                echo " <li class='page-item'><a class='page-link' href='home.php?page=".($page - 1)."'>Previous</a></li>";
                            }
                            for($i=$start_loop; $i<=$end_loop; $i++)
                            {


                                if($i>0)
                                    echo "<li class='page-item'><a class='page-link' href='home.php?page=".$i."'>".$i."</a></li>";
                            }
                            if($page <= $end_loop)
                            {
                                echo "<li class='page-item'><a class='page-link' href='home.php?page=".($page + 1)."'>Next</a></li>";
                                echo "<li class='page-item'><a class='page-link' href='home.php?page=".$total_pages."'>Last</a></li>";
                            }
                            ?>
                        </ul>
                    </nav>
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
    <input type="text" name="first" class="form-control" id="exampleInputEmail1" placeholder="First name">
  </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Last name</label>
    <input type="text" name="last" class="form-control" id="exampleInputPassword1" placeholder="Last name">
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
    <label for="exampleInputEmail1">Latitude</label>
    <input type="text" name="lat" class="form-control" id="exampleInputEmail1" placeholder=" Latitude">
  </div>
   <div class="form-group">
    <label for="exampleInputEmail2">Longitude</label>
    <input type="text" name="lng" class="form-control" id="exampleInputEmail2"  placeholder="Longitude">
  </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Name</label>
    <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="name">
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
</html>
