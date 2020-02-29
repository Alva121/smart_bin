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
    $msg=$_GET['message'];
    $lat=$_GET['lat'];
    $lng=$_GET['lng'];
    $conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');

    $result=mysqli_query($conn,"insert into user_feedback (name,phone,message,lat,lng) values ('$name','$phone','$msg','$lat','$lng')");

}


?>
