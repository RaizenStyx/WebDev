<!--
 File: lab02.php
 Project: Lab 2

 Creator: Connor Reed
 Email: Contact@calexreed.me
 Course: CITC 1317
 Creation Date: 9/7/2021
-->
<?php
    echo "Lab 02";

    $a = "-2.6 degrees";
    $b = "a dinosaur";
    $c = false;
    $d = NULL;
    $e = -8675309.00;
    $f = 0.0;
    $g = "";
    $h = 42;
    $i = -21;
    $j = array("The Shinning", "Carrie", "IT");
    $l = [$a,$b,$c,$d,$e,$f,$g,$h,$i,$j];
    function show($variable){
        ?><tr><?php
        echo "<td>".gettype($variable);"</td>";
        echo "<td>".boolval($variable);"</td>";
        echo "<td>".intval($variable);"</td>";
        echo "<td>".floatval($variable);"</td>";
        echo "<td>".strval($variable);"</td>";
        echo "<td>";
        var_dump($variable);
            "</td>";
        echo "<td>".(is_int($variable) ? dechex($variable) : "")."</td>";
    ?>
        </tr>
        <?php
    }
?>

<html>

<head>

    <title>
        Lab 02
    </title>

</head>

<body>
<table border="1">
    <thead>
        <tr>
            <th style="text-align: center">Initial Type</th>
            <th style="text-align: center">Cast to bool</th>
            <th style="text-align: center">Cast to int</th>
            <th style="text-align: center">Cast to float</th>
            <th style="text-align: center">Cast to string</th>
            <th style="text-align: center">Variable Info</th>
            <th style="text-align: center">Int as hex</th>
        </tr>
    </thead>
        <?php

        foreach ($l as &$value) {
            echo show($value);
        }
        ?>
</table>

<?php
    echo "print_r method";
    ?><br>
<?php
    $j[] = "Dolores Claiborn";
    echo print_r($j);
?>
</body>

</html>
