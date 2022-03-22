<?php
include_once 'dbconfig.php';
include_once 'header.php';
include_once 'myLogin.php';
?>

    <br>

<?php

/****************** PRESENTING LOGGED IN CLIENT WITH ADMIN SCREEN *******************/
if(!isset($_SESSION['loggedin']))
{
    header("Location: index.php");
} else {
    ?>
    <!-- Place HTML here for the admin page -->
    <h1 style="margin-left: 25%">
        Welcome to the User List, Administrator Person
        <?= $_SESSION['firstname'] ?>
        <?= $_SESSION['lastname'] ?>!
    </h1>

    <div class="container">
        <table class='table table-bordered table-responsive'>
            <tr>
                <th>#</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>UserName</th>
                <th>Password</th>
                <th>Email</th>
                <th>RoleId</th>
                <th colspan="2" align="center">Admin</th>
            </tr>
            <?php
            $query = "SELECT * FROM Users";
            $crud-> userData($query);
            ?>
        </table>
    </div>

    <div class="container">
        &nbsp;
        <a href="createUser.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Create User</a>
        &nbsp;
        <a href="index.php" class="btn btn-large btn-info"><i class="btn btn-large btn-info"></i> &nbsp; Home</a>
        
        <form name='logout' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' >
            <input type='submit' value='Logout' name='logout'  style="margin-left: 50%" class="btn btn-large btn-info">
        </form>
    </div>
    <?php }
include_once 'footer.php';
