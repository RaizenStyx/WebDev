<!--
 File: lab03.php
 Project: Lab 3

 Creator: Connor Reed
 Email: Contact@calexreed.me
 Course: CITC 1317
 Creation Date: 9/14/2021
-->

<html lang="en">

<head>
    <title>
        Lab 03
    </title>
</head>

<body>
<!--<h2>File Array Output</h2> -->
<?php
/*
foreach ($lines as $line) {
    echo "<p>".trim($line)."</p>\n";
}
*/
?>
<h2>80s Games Sales</h2>
<table border = "1">
<?php
// opens a file
$lines = file('80s_vg_sales.csv');

$video_games = array();

$total = 0;

$firstIteration = true;

foreach ($lines as $line) {
    $video_games[] = explode(",", trim($line));
}

foreach ($video_games as $game){
    echo "<tr>";
    for($i = 0;$i<count($game); $i++) {
        echo "<td>".$game[$i]."</td>";
    }
    echo "</tr>\n";

    // Skips first iteration process
    if (!$firstIteration) {
        $total += $game[5];
    }
    $firstIteration = false;

    // another way to do the total
    // this cast everything to float #, sting would be 0
    //$total += floatval($game[5]);
}
echo "</table>";

echo "<h2> Global sales total estimate: $".($total *= 1000000)."</h2>";

?>
</body>

</html>