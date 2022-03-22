<?php
include_once 'dbconfig.php';
include_once 'header.php';
include_once 'myLogin.php';
?>

<br>

<?php
/*********************** PRESENTING CLIENT WITH LOGIN SCREEN ************************/
if(!isset($_SESSION['loggedin']))
{
    ?>

    <form name='login' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' style="margin-left: 40%">
        User name: <input type='text' name='userid' /><br />
        Password: <input type='password' name='password' /><br />
        <input type='submit' name='loginbutton' value='Login' />
    </form>
    <?php
}
/****************** PRESENTING LOGGED IN CLIENT WITH ADMIN SCREEN *******************/
if((isset($_SESSION['loggedin']))
    && isset($_SESSION['userlevel'])
    && ($_SESSION['userlevel'] == 1))
{
    ?>
    <!-- Place HTML here for the admin page -->
    <h1 style="margin-left: 25%">
        Welcome to the Administrator Page,
        <?= $_SESSION['firstname'] ?>
        <?= $_SESSION['lastname'] ?>!<br>
        Your User ID is: 
        <?= $_SESSION['userid'] ?>
    </h1>

<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr>
     <th>#</th>
     <th>Course</th>
     <th>Concentration</th>
     <th>Student900#</th>
     <th>First Name</th>
     <th>Last Name</th>
     <th>Submitted By</th>
     <th>Status</th>
     <th>ApprovedForCRN</th>
     <th>Notes</th>
     <th>Contact</th>
     <th colspan="2" align="center">Admin</th>
     </tr>
     <?php
		$query = "SELECT Requests.*, Users.Email AS Email FROM Requests LEFT JOIN Users ON Requests.SubmittedById = Users.id";
		$records_per_page=5;
		$newquery = $crud->paging($query,$records_per_page);
		$crud->dataview($newquery);
	 ?>
    <tr>
        <td colspan="7" align="center">
 			<div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
	</table>     
</div>

<div class="container">
	<a href="add_data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
    &nbsp;
    <a href="users.php" class="btn btn-large btn-info"><i class="btn btn-large btn-info"></i> &nbsp; User Admin</a>
    &nbsp;
    <form name='logout' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' >
        <input type='submit' value='Logout' name='logout'  style="margin-left: 50%" class="btn btn-large btn-info">
    </form>
</div>
<?php
}

/****************** PRESENTING LOGGED IN CLIENT WITH ADVISOR SCREEN *******************/
if((isset($_SESSION['loggedin']))
    && isset($_SESSION['userlevel'])
    && ($_SESSION['userlevel'] == 2))
{
    ?>
    <!-- Place HTML here for the advisor page -->
    <h1 style="margin-left: 25%">
        Welcome to the Advisor Page,
        <?= $_SESSION['firstname'] ?>
        <?= $_SESSION['lastname'] ?>!<br>
        Your User ID is: 
        <?= $_SESSION['userid'] ?>
    </h1>


    <div class="container">
        <table class='table table-bordered table-responsive'>
            <tr>
                <th>#</th>
                <th>Course</th>
                <th>Concentration</th>
                <th>Student900#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Submitted By</th>
                <th>Status</th>
                <th>ApprovedForCRN</th>
                <th>Notes</th>
                <th>Contact</th>
            </tr>
            <?php
            // Trying to use SESSION user id to pull only records they submitted in query below
            $query= "SELECT Requests.*, Users.Email AS Email FROM Requests LEFT JOIN Users ON Requests.SubmittedById = Users.id";
            $records_per_page=5;
            $newquery = $crud->paging($query,$records_per_page);
            $crud->dataview($newquery);
            ?>
            <tr>
                <td colspan="7" align="center">
                    <div class="pagination-wrap">
                        <?php $crud->paginglink($query,$records_per_page); ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="container">
        <a href="add_data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
        &nbsp;
        <form name='logout' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' >
            <input type='submit' value='Logout' name='logout'  style="margin-left: 50%" class="btn btn-large btn-info">
        </form>
    </div>
    <?php
}

/****************** PRESENTING LOGGED IN CLIENT WITH STUDENT SCREEN *******************/
if((isset($_SESSION['loggedin']))&&($_SESSION['userlevel']==3))
{
    ?>
    <!-- Place HTML here for the client page -->
    <h1 style="margin-left: 25%">
        Welcome to the Student Page,
        <?= $_SESSION['firstname'] ?>
        <?= $_SESSION['lastname'] ?>!<br>
        Your User ID is: 
        <?= $_SESSION['userid'] ?>
    </h1>

    <div class="container">
        <table class='table table-bordered table-responsive'>
            <tr>
                <th>#</th>
                <th>Course</th>
                <th>Concentration</th>
                <th>Student900#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Submitted By</th>
                <th>Status</th>
                <th>ApprovedForCRN</th>
                <th>Notes</th>
                <th>Contact</th>
            </tr>
            <?php
            $query = "SELECT Requests.*, Users.Email AS Email FROM Requests LEFT JOIN Users ON Requests.SubmittedById = Users.id"; //WHERE Users.id =:id";
            $records_per_page=5;
            $newquery = $crud->paging($query,$records_per_page);
            $crud->dataview($newquery);
            ?>
            <tr>
                <td colspan="7" align="center">
                    <div class="pagination-wrap">
                        <?php $crud->paginglink($query,$records_per_page); ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="container">
        <a href="add_data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
        &nbsp;
        <form name='logout' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' >
            <input type='submit' value='Logout' name='logout'  style="margin-left: 50%" class="btn btn-large btn-info">
        </form>
    </div>

    <?php
}
include_once 'footer.php'; ?>