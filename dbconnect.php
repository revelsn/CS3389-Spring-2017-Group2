<?php
/**
 * This is a test file for experimenting with access to the database from various sources. Probably broken now because
 * GroupTest table no longer exists...
 */
$servername = "35.184.123.250";
$username = "web";
$password = "kMC`NX,<NcCk!>7E";
$db = "wigglydb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

//get IP
	$name = $_POST['name'];

// Attempt insert query execution
$sql = "INSERT INTO GroupTest (Name) VALUES ('$name')";

if(mysqli_query($conn, $sql)){

	echo "<br>Records inserted successfully.";

} else{

	echo "<br>ERROR: Could not execute $sql. " . mysqli_error($link);

}



// Close connection

mysqli_close($conn);
?>

