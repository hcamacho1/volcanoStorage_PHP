<?php
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'Jiggers12';
	$database = 'volcanostorage';

// New Connection
	$db = mysqli_connect($dbhost,$dbuser,$dbpass, "volcanostorage");

	// Check for errors
	if(mysqli_connect_errno())
	{
		echo mysqli_connect_error();
	}
    else
    {
        echo 'database connected ... <br>';
    }
?>