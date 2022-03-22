<?php
include_once 'dbconfig.php';
include_once 'myLogin.php';

if(!isset($_SESSION['loggedin']))
{
    header("Location: index.php");
} else {

if(isset($_POST['btn-update']))
{
    $id = $_GET['edit_id'];
    $FirstName = $_POST['fname'];
    $LastName = $_POST['lname'];
    $UserName = $_POST['user'];
    $Password = md5($_POST['pword']);
    $Email = $_POST['email'];

    if($crud->updateUser($id, $FirstName, $LastName, $UserName, $Password, $Email))
    {
        header("Location: users.php");

    }
    else
    {
        $msg = "<div class='alert alert-warning'>
				ERROR while updating User 
				</div>";
    }
}

if(isset($_GET['edit_id']))
{
    $id = (int)$_GET['edit_id'];
    extract($crud->getIDUser($id));
}

?>
<?php include_once 'header.php'; ?>

    <div class="container">
        <?php
        if(isset($msg))
        {
            echo $msg;
        }


        ?>
    </div>

    <br>

    <div class="container">
        <form method="post">

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
                $stmt = $DB_con->prepare("SELECT * FROM Users WHERE Users.id=:id");
                $stmt->execute(array(":id"=>$_GET['edit_id']));
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

    <br>

            <table class='table table-bordered'>


                <td>New First Name</td>
                <td><input type='text' name='fname' class='form-control' value="<?php //echo $FirstName; ?>" required></td>
                </tr>

                <tr>
                    <td>New Last Name</td>
                    <td><input type='text' name='lname' class='form-control' value="<?php //echo $LastName; ?>" required></td>
                </tr>

                <tr>
                    <td>New Username</td>
                    <td><input type='text' name='user' class='form-control' value="<?php //echo $UserName; ?>" required></td>
                </tr>

                <tr>
                    <td>New Password</td>
                    <td><input type='password' name='pword' class='form-control' value="<?php //echo $Password; ?>" required></td>
                </tr>

                <tr>
                    <td>New Email</td>
                    <td><input type='text' name='email' class='form-control' value="<?php //echo $Email; ?>" required></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary" name="btn-update">
                            <span class="glyphicon glyphicon-edit"></span>  Update this User
                        </button>
                        <a href="users.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
                    </td>
                </tr>

            </table>
        </form>


    </div>

<?php }
include_once 'footer.php'; ?>