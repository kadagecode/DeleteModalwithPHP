<?php
$con=@mysqli_connect("localhost","root","","project");
if(mysqli_connect_error())
exit("Mysql Error :".mysqli_connect_error());
 $Sr_No=$_GET["Sr_No"];

$query="SELECT * FROM `division` WHERE Sr_No=$Sr_No";

$result=mysqli_query($con,$query) or die("Query Error");

if($row=mysqli_fetch_array($result))
{
    $Region=$row['Region'];
    $Circle=$row['Circle'];
    $Division_Name=$row['Division_Name'];
    $Address1=$row['Address1'];
    $Address2=$row['Address2'];
    $Place=$row['Place'];
    $Email=$row['Email'];
    $Phone_No=$row['Phone_No'];
    $Designation=$row['Designation'];
}
else
{
	exit("Record Not Found");
}
?>
 