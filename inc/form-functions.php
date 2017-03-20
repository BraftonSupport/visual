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
		die( "<p>Connection failed! Error is " . $conn->connect_error . "</p>");
	}

	return $conn;
}

// function for spitting out any variable in a formatted manner
function printDat( $toPrint ) {
	echo "<pre>";
	print_r( $toPrint );
	echo "</pre>";
}

// looks at the columns of the "numberoflives" table
function getNumEmployees() {
	$conn = establish_connection();
	$query = "desc tbl_br_office_gb_numberoflives";

	$fieldsArray = array();

	$fieldsToIgnore = ['officeid', 'servicetypeid', 'minimum', 'IsUpdated'];

	$res = $conn->query( $query );

	while( $row = $res->fetch_assoc() ) {
		if ( !in_array( $row['Field'], $fieldsToIgnore ) ) {
			$fieldsArray[] = $row['Field'];
		}
	}

	return $fieldsArray;
}

function getCatNAICS() {
	$conn = establish_connection();
	$table = "naics_category";
	$query = "SELECT naics_category_id, naics_category_name FROM $table";

	$res = $conn->query( $query );

	$cats = array();

	while( $row = $res->fetch_assoc() ) {
		$cats[] = $row;
	}

	return $cats;
}

// function to grab NAICS, based on the passed in category id
function getNAICS( $id ) {
	$conn = establish_connection();
	$table = "naics";
	$query = "SELECT id, name FROM $table WHERE naics_category_id = $id";

	$res = $conn->query( $query );

	$industries = array();

	while( $row = $res->fetch_assoc() ) {
		$industries[] = $row;
	}

	return $industries;
}

// function to grab office IDs for GB
// takes an employee range (ie column name from "number_of_lives") as input, and grabs any offices with a value in that column != 0 or null
// returns an array of officeids
function getGBOfficeIDs( $col ) {
	$conn = establish_connection();
	$table = "tbl_br_office_gb_numberoflives";
	$query = "SELECT officeid FROM $table WHERE $col != 0 && $col IS NOT NULL";

	$res = $conn->query( $query );

	$ids = array();

	while( $row = $res->fetch_assoc() ) {
		$ids[] = $row['officeid'];
	}

	return $ids;
}