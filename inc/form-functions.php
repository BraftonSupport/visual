<?php
/*
Author: John Parks
Description: I DO know her
Version: 1.0
*/

// function to establish DB connection, to be used in future functions
function establish_connection() {
	$servername = "69.174.52.217";
	$username = "policy8_brafton";
	$password = "!H}GDB~m]1_6";
	$dbname = "policy8_newpsdb";

	$conn = new mysqli( $servername, $username, $password, $dbname );

	// check the connection
	if ( $conn->connect_error ) {
		die( "Connection failed! Error is " . $conn->connect_error );
	}

	echo "Connect success!";
	return $conn;
}

// function for spitting out any variable in a formatted manner
function printDat( $toPrint ) {
	echo "<pre>";
	print_r( $toPrint );
	echo "</pre>";
}