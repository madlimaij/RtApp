<?php
require_once('Patient.php');
require_once('Database.php');

$db = new Database;
$result = $db->execute("
        SELECT pn FROM patient;");
$patient_numbers = $result->fetch_all(MYSQLI_ASSOC);
asort($patient_numbers);
foreach ($patient_numbers as $pn) {
    $patient = new Patient($pn["pn"]);
    $patient->validate(date('m-d-y'));
}

$db->close();

?>