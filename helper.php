<?php

function login($email,$password){

if ($_SESSION['login']==true || ($email=="admin@gmail.com" && $password=="password"))
{
            $_SESSION['login']=true;
         //   echo $_SESSION['login'];
           header("Location:home.php");
}

        else {
        	echo "<script>alert('Try again');</script>";
        }

}



function addriver($first,$last,$phone,$email,$password){
  $conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');


$result=mysqli_query($conn,"insert into driver (name,phone,email,password) values ('$fname','$phone','$email','$password')");
if($result){
  echo "<script>alert('Registration successful');</script>";
}
else
{
   echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
   Try again <strong>Check driver exist!</strong>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>";
}

}

function viewdriver(){
  $conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');


$result=mysqli_query($conn,"select * from driver where type=1  order by id desc");

while($row= mysqli_fetch_array($result))
{
	?>
	   <tr>
      <th scope="row"><?php echo $row["0"]; ?></th>
      <td><?php echo $row["1"]; ?>?></td>
      <td><?php echo $row["2"]; ?></td>
      <td><?php echo $row["3"]; ?></td>
      <td><a href="?deletedriver=<?php echo $row[0]; ?>" name="deletedriver" class="btn btn-danger">Delete</a></td>
    </tr>
<?php
}

}

function deletedriver($id){
    $conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');

//$conn connecting to data base

    $result=mysqli_query($conn,"delete from driver where id='$id'");

    if($result){
        echo "<script>alert('Deleted successful');</script>";
        //display notification
    }
    else
    {
        echo "<script>alert('Try again');</script>";
    }
}

function addbin($lat,$lng,$name){
  $conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');


$result=mysqli_query($conn,"insert into bin_location (name,lat,lng) values ('$name','$lat','$lng')");
$result=mysqli_query($conn,"insert into bin_location (name,lat,lng,type) values ('$name','$lat','$lng','0')");
if($result){
  echo "<script>alert('Added successful');</script>";
  //display notification
}
else
{
   echo "<script>alert('Try again');</script>";
}

}


function viewbin(){
    $conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');


$result=mysqli_query($conn,"select * from bin_location  order by id desc");

while($row= mysqli_fetch_array($result))
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
}

function viewfeedback(){
    $conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');


$result=mysqli_query($conn,"select * from user_feedback  order by id desc");

while($row= mysqli_fetch_array($result))
{
  ?>
     <tr>
      <th scope="row"><?php echo $row["0"]; ?></th>
      <td><?php echo $row["1"]; ?></td>
      <td><?php echo $row["2"]; ?></td>
      <td><?php echo $row["3"]; ?></td>
      <td><?php echo $row["4"]; ?></td>
    </tr>
<?php
}
}


function deletebin($id){
    $conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');

//$conn connecting to data base

    $result=mysqli_query($conn,"delete from bin_location where id='$id'");

    if($result){
        echo "<script>alert('Deleted successful');</script>";
        //display notification
    }
    else
    {
        echo "<script>alert('Try again');</script>";
    }
}


?>
