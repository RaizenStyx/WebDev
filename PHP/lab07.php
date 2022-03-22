<!--
 File: lab07.php
 Project: Lab 7

 Creator: Connor Reed
 Email: Contact@calexreed.me
 Course: CITC 1317
 Creation Date: 10/05/2021
-->

<?php
function sanitize($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$nameErr = $emailErr = $websiteErr = $commentErr = "";
$name = $email = $website = $comment = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    if (empty($_POST['name'])) {
        $nameErr = "Name is required";
    } else {
        $name = sanitize($_POST['name']);
    }

    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
    } else {
        $email = sanitize($_POST['email']);

        //check to see if email address is well-formed
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST['website'])) {
        $websiteErr = "Website is required";
    } else {
        $website = sanitize($_POST['website']);

        //check if url address syntax is valid(allows dashes in URL)
        if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www.\.)[-a-z0-9+&@#.\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)){
            $websiteErr = "Invalid URL";
        }
    }

    if (empty($_POST['comment'])) {
        $commentErr = "Comment is required";
    } else {
        $comment = sanitize($_POST['comment']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lab 07</title>
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

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

        Name: <input type="text" name="name">
        <span class="error"><br>* <?php echo $nameErr;?></span><br>

        Email: <input type="text" name="email">
        <span class="error"><br>* <?php echo $emailErr;?></span><br>

        Website: <input type="text" name="website">
        <span class="error"><br>* <?php echo $websiteErr;?></span><br>

        Comment: <textarea name="comment" rows="5" cols="40"></textarea>
        <span class="error"><br>* <?php echo $commentErr;?></span><br>

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
