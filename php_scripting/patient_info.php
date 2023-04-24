<?php
require_once "db.php";

$sql = "SELECT patient.pn,
  patient.last,
  patient.first,
  insurance.iname,
  DATE_FORMAT(insurance.from_date, '%m-%d-%y'),
  DATE_FORMAT(insurance.to_date, '%m-%d-%y')
  FROM insurance
  JOIN patient ON insurance.patient_id = patient._id ORDER BY DATE(insurance.from_date) ASC, patient.last ASC;";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
  echo implode(",", $row) . "\n";
}
;

mysqli_free_result($result);
mysqli_close($conn);
?>