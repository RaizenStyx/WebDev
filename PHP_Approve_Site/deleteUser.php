<?php
include_once 'dbconfig.php';
include_once 'myLogin.php';

if(!isset($_SESSION['loggedin']))
{
    header("Location: index.php");
} else {

if(isset($_POST['btn-del']))
{
    $id = $_GET['delete_id'];
    $crud->deleteUser($id);
    header("Location: deleteUser.php?deleted");
}

?>

<?php include_once 'header.php'; ?>

<div class="container">

    <?php
    if(isset($_GET['deleted']))
    {
        ?>
        <div class="alert alert-success">
            Success! User was deleted...
        </div>
        <?php
    }
    else
    {
        ?>
        <div class="alert alert-danger">
            Delete the following User ?
        </div>
        <?php
    }
    ?>
</div>

<div class="container">

    <?php
    if(isset($_GET['delete_id']))
    {
        ?>
        <table class='table table-bordered'>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>RoleId</th>
            </tr>
            <?php
            $stmt = $DB_con->prepare("SELECT * FROM Users WHERE id=:id");
            $stmt->execute(array(":id"=>$_GET['delete_id']));
            while($row=$stmt->fetch(PDO::FETCH_BOTH))
            {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['FirstName']); ?></td>
                    <td><?php print($row['LastName']); ?></td>
                    <td><?php print($row['UserName']); ?></td>
                    <td><?php print($row['Password']); ?></td>
                    <td><?php print($row['Email']); ?></td>
                    
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    ?>
</div>

<div class="container">
    <p>
        <?php
        if(isset($_GET['delete_id']))
        {
        ?>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
        <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
        <a href="users.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>
    <?php
    }
    else
    {
        header("Location: users.php");
    }
    ?>
    </p>
</div>
<?php }
include_once 'footer.php'; ?>
