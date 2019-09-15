<?php
	function opencon()
	{
		$dbhost="localhost";
	    	$dbuser="userId";
	    	$dbpass="password";
		$db="dbName";
		$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$db) or die("Connection failed ".$conn->error);
		return $conn;
	}
	function closecon($conn)
	{
		echo "Connection closed";
		mysql_close($conn);
	}
?>
