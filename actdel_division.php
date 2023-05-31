<?php
$Sr_No=$_POST['Sr_No'];

$con=@mysqli_connect("localhost","root","","project");
if(mysqli_connect_error())
exit("Mysql Error :".mysqli_connect_error());

$query="delete from division where Sr_No='$Sr_No'";

mysqli_query($con,$query) or die("Query Error: ".mysqli_error($con));

if(mysqli_affected_rows($con) > 0)
{
	// auto-redirect n leave existing page
	header("location:Divisiongrid.php");
	echo "Success: Data Deleted.";
}
else
	echo "Error: Cannot Delete Category";

echo "<p><a href='Divisiongrid.php'>Back To List</a></p>";

?>