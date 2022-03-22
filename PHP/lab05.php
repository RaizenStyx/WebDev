<!--
 File: lab05.php
 Project: Lab 5

 Creator: Connor Reed
 Email: Contact@calexreed.me
 Course: CITC 1317
 Creation Date: 9/28/2021
-->

<?php

if ($_SERVER['REQUEST_METHOD'] != "POST"){
    echo "<h1>The Method Should be POST</h1>";
} else {

    if (empty($_POST['name'])) {
        echo "ERROR. Name is required<br>\n";
    } else {
        echo "Name= " . $_POST["name"] . "<br>\n";
    }

    if (empty($_POST['email'])) {
        echo "ERROR. Email is required<br>\n";
    } else {
        echo "Email= " . $_POST["email"] . "<br>\n";
    }

    if (empty($_POST['website'])) {
        echo "ERROR. Website is required<br>\n";
    } else {
        echo "Website= " . $_POST["website"] . "<br>\n";
    }

    if (empty($_POST['comment'])) {
        echo "ERROR. Comment is required<br>\n";
    } else {
        echo "Comment= " . $_POST["comment"] . "<br>\n";
    }
}

