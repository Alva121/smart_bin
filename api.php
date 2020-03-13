<?php
if($_GET['type']==1)
{
$conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');


$location=mysqli_query($conn,"select * from bin_location");
$a=array();

while($row1= mysqli_fetch_assoc($location))
{
	array_push($a, $row1);
}
echo json_encode($a);
}

if($_GET['type']==2)
{

    $name=$_GET['name'];
    $phone=$_GET['phone'];
    $msg=$_GET['msg'];
    $lat=$_GET['lat'];
    $lng=$_GET['lng'];
    $conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');

    $result=mysqli_query($conn,"insert into user_feedback (name,phone,message,lat,lng) values ('$name','$phone','$msg','$lat','$lng')");
    if($result)
    echo "0";else echo "-1";

}

if($_GET['type']==3)
{

    $id=$_GET['id'];
    $status=$_GET['status'];
    $conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');

    $result=mysqli_query($conn,"UPDATE bin_location SET status='$status' WHERE id='$id'");
if($result)
    echo "ok".$status.$id;else echo "fail";
}

if($_GET['type']==4)
{

    $name=$_GET['name'];
    $phone=$_GET['phone'];
    $email=$_GET['email'];
    $pass=$_GET['password'];
    $type="1";

    $conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');

    $result=mysqli_query($conn,"insert into driver (name,phone,email,password,type) values ('$name','$phone','$email','$pass','$type')");
    if($result)
        echo "0";else echo "-1";
}

if($_GET['type']==5)
{
 $email=$_GET['email'];
$pass=$_GET['password'];
$type=$_GET['_type'];
  $conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');
$result=mysqli_query($conn,"select * from driver where email='$email' and password='$pass' and type='$type' ");
 if(mysqli_num_rows($result)>0)
        echo "0";else echo "-1";
}

if($_GET['type']==6)
{
    $name=$_GET['name'];
    $temp=$_GET['_type'];
    $lat=$_GET['lat'];
    $lng=$_GET['lng'];
    if ($temp==1) 
    {
    $plastic="Plastic";

    $conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');

    $result=mysqli_query($conn,"insert into collector (name,lat,lng,type) values ('$name','$lat','$lng','$plastic')");
    if($result)
    echo "0";else echo "-1";

    }
    else
    {
    $wet="Degradable";

    $conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');

    $result=mysqli_query($conn,"insert into collector (name,lat,lng,type) values ('$name','$lat','$lng','$wet')");
    if($result)
    echo "0";else echo "-1";
    }
}
?>
