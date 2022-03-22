<?php
include_once 'dbconfig.php';
include_once 'myLogin.php';

if(!isset($_SESSION['loggedin']))
{
    header("Location: index.php");
} else {

if(isset($_POST['btn-save']))
{
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $UserName = $_POST['UserName'];
    $Password = md5($_POST['Password']);
    $Email = $_POST['Email'];
    $RoleId = $_POST['roleId'];

    if($crud->createUser($FirstName, $LastName, $UserName, $Password, $Email, $RoleId))
    {
        header("Location: users.php");
    }
    else
    {
        header("Location: createUser.php?failure");
    }
}
?>
<?php include_once 'header.php';?>


<?php
if(isset($_GET['failure']))
{
    ?>
    <div class="container">
        <div class="alert alert-warning">
            ERROR while Creating User!
        </div>
    </div>
    <?php
}

?>
  <h1 style="margin-left: 25%">
        Welcome to Creating a User, Administrator Person
        <?= $_SESSION['firstname'] ?>
        <?= $_SESSION['lastname'] ?>!
    </h1>

    <br>

    <div class="container">
        <form method='post'>

            <table class='table table-bordered'>

                <tr>
                    <td>First Name</td>
                    <td><input type='text' name='FirstName' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Last Name</td>
                    <td><input type='text' name='LastName' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td><input type='text' name='UserName' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td><input type='password' name='Password' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Email Address</td>
                    <td><input type='text' name='Email' class='form-control' required></td>
                </tr>

                <tr>
                    <td>User Role</td>
                    <td>
                        <select name="roleId" id="roleId"  class='form-control'>
                            <option value="1">Administrator</option>
                            <option value="2">Advisor</option>
                            <option value="3">Student</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary" name="btn-save">
                            <span class="glyphicon glyphicon-plus"></span> Create New User
                        </button>
                        <a href="users.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to Users</a>
                    </td>
                </tr>

            </table>
        </form>

    </div>

<?php }
include_once 'footer.php'; ?>