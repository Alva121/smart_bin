<?php
include 'helper.php';
if(isset($_POST['submit']))
{

$password=$_POST['password'];

$email=$_POST['email'];

login($email,$password);

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SmartBin</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="bg-secondary">
	<div class="container-fluid">
<div class="row">
	<div class="col-md-4">
		
	</div>
	<div class="col-md-4">
		<div class="card" style="margin-top: 130px;padding: 20px;">
			<form method="post">
				<div class="card-header" style="background-color: unset;">
					<h3>Login</h3>
				</div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
  </div>
<div class="card-footer" style="padding: unset;">
  <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
  </div>
</form>
		</div>
	</div>
	<div class="col-md-4">
		
	</div>
</div>
</div>
</body>
</html>