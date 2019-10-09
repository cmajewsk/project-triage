<?php
// Step 0: Validate Data

// Step 1: Get a datase connection from our help class
$db = DbConnection::getConnection();

// Step 2: Prepare & run the query
// have to manually created guid
$stmt = $db->prepare(
  'INSERT INTO PatientVisit
  (patientGuid, firstName, lastName, DOB, sexAtBirth)
  VALUES(?,?,?,?,?)'
);

$guid = Uuid::uuid4()->toString();
//How to prevent SQL injections:
$stmt->execute([
  $guid,
  $_POST['firstName'],
  $_POST['lastName'],
  $_POST['DOB'],
  $_POST['sexAtBirth']
]);

//Global Variables: can introduce bad security practices (SQL injection ex.)
// $_POST
// $_GET
// $_ENV
// $_SERVER

// Step 3: (Was retrieve the data, but theres no data to retrieve)
//Could do some error checking - but theres an exception already built it, so skip error checking

// Step 4: Output
header('HTTP/1.1 303 See Other');
//303 status code says redirect with a Get
header('Location: ../records/?guid='.$guid);
//tells you where the other place is you're sending it to
