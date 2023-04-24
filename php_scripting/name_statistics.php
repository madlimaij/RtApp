<?php
require_once "db.php";

// Functions
function letterCounter($name)
{
    $trimmed = preg_replace('/^[a-zäöüõšž]$/', "", strtolower($name));
    $characters = mb_str_split($trimmed); //str_split had problems with "õ", "ä" etc
    $letters = array();
    foreach ($characters as $ch) {
        if (array_key_exists($ch, $letters)) {
            $letters[$ch] += 1;
        } else {
            $letters[$ch] = 1;
        }
    }
    ;
    return $letters;
}

function percentOfTotal($total, $part)
{
    return $total ? ($part / $total * 100) : 0;
}
;

// Statistics of all first and last names of sample patients
$sql = "SELECT last, first FROM patient";
$result = mysqli_query($conn, $sql);
$names = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Using reduce function to concat all first and last names into one string (added sorting by count)
$namesAsString = array_reduce($names, function ($acc, $curr) {
    return $acc . implode("", $curr);
}, "");

$countedLetters = letterCounter($namesAsString);
// // Sorting problem with non-English letters!
ksort($countedLetters);
$lettersTotalCount = array_sum($countedLetters);

foreach ($countedLetters as $key => $value) {
    $percent = percentOfTotal($lettersTotalCount, $value);
    echo mb_strtoupper($key) . "\t" . $value . "\t" . round($percent, 2) . " %\n";
}

mysqli_free_result($result);
mysqli_close($conn);
?>