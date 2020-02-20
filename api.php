<?php
$conn = mysqli_connect('localhost','root','','smartbin') or die('unable to connect');


$result=mysqli_query($conn,"select * from bin_location  order by id desc");
$a=array();

while($row= mysqli_fetch_array($result))
{
	array_push($a, $row);
}
echo json_encode($a);

?>