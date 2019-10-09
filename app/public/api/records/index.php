<?php
// localhost8080/app/public/api/records

// php is case sensitive


// Step 1: Get a datase connection from our help class
// DbConnection is a classNAME - checks a way to autoload DbConnection class
// :: indicates it is a static function - dont need an instance of the class
// :: is a static method on that class
$db = DbConnection::getConnection();

// Step 2: Create & run the query

if (isset($_GET['guid'])) {
  $stmt = $db->prepare(
    'SELECT * FROM patient
    WHERE patientGuid = ?'
  );
  //NEED TO FINISH THIS PART
}
// takes sql and made it a string
// prepare - method on phps PDO, only exists once we've created the database connection
// returns a PDO statement object - aka prepares an SQL statement
$stmt = $db->prepare('SELECT * FROM Patient');
// runs the query and has access to all the data that will be returned
$stmt->execute();
// patients is an associated arrays
$patients = $stmt->fetchAll();

// patientGuid VARCHAR(64) PRIMARY KEY,
// firstName VARCHAR(64),
// lastName VARCHAR(64),
// dob DATE DEFAULT NULL,
// sexAtBirth CHAR(1) DEFAULT ''

// Step 3: Convert to JSON
// json_encode is a function built into php (pretty print is one option)
// when something is written in ALL CAPS its a constant
$json = json_encode($patients, JSON_PRETTY_PRINT);

// Step 4: Output
// php is org designed for http - but this header says send out this http header -
// so browser knows its JSON and can interpretate it that way
// default would be text/html (if you don't define anything)
header('Content-Type: application/json');
// always end with one blank line
echo $json;
