<!--
 File: lab06.php
 Project: Lab 6

 Creator: Connor Reed
 Email: Contact@calexreed.me
 Course: CITC 1317
 Creation Date: 9/30/2021
-->

<?php
$nameErr = $emailErr = $websiteErr = $commentErr = "";
$name = $email = $website = $comment = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    if (empty($_POST['name'])) {
       $nameErr = "Name is required";
    } else {
       $name = $_POST['name'];
    }

    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST['email'];
    }

    if (empty($_POST['website'])) {
        $websiteErr = "Website is required";
    } else {
        $website = $_POST['website'];
    }

    if (empty($_POST['comment'])) {
        $commentErr = "Comment is required";
    } else {
        $comment = $_POST['comment'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab 06</title>
    <style>
        #myBox {
            padding: 15px;
            margin: auto;
            border: solid black;
            position: absolute;
            top: 25%;
            left: 25%;
        }
    </style>
</head>
<body>

<div id="myBox">

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

    Name: <input type="text" name="name">
    <span class="error"><br>* <?php echo $nameErr;?></span><br>

    Email: <input type="text" name="email">
    <span class="error"><br>* <?php echo $emailErr;?></span><br>

    Website: <input type="text" name="website">
    <span class="error"><br>* <?php echo $websiteErr;?></span><br>

    Comment: <textarea name="comment" rows="5" cols="40"></textarea>
    <span class="error"><br>* <?php echo $commentErr;?> </span><br>

    <input type = "submit">

</form>

<?php
echo "<br>";
echo  $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
?>

</div>

</body>

</html>
