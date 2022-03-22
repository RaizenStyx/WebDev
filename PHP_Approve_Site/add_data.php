<?php
include_once 'dbconfig.php';
include_once 'myLogin.php';

if(!isset($_SESSION['loggedin']))
{
    header("Location: index.php");
} else {

if(isset($_POST['btn-save']))
{
    $courses = $_POST['Courses'];
    $major = $_POST['MajorConcentration'];
    $studentid = $_POST['StudentId'];
    $fname = $_POST['StudentFirstName'];
    $lname = $_POST['StudentLastName'];
    $submittedby = $_SESSION['userid'];
    $status = 1;
    $crn = $_POST['ApprovedForCRN'];
    $notes = $_POST['Notes'];
    

    if($crud->create($courses, $major, $studentid, $fname, $lname, $submittedby, $status, $crn, $notes))
    {
        header("Location: index.php");
    }
    else
    {
        header("Location: add_data.php?failure");
    }

}
?>
<?php include_once 'header.php'; 

if(isset($_GET['failure']))
{
    ?>
    <div class="container">
        <div class="alert alert-warning">
            ERROR while inserting record !
        </div>
    </div>
    <?php
}

?>

    <br>
    <h1 style="margin-left: 25%">
        Welcome to the Requests Page,
        <?= $_SESSION['firstname'] ?>
        <?= $_SESSION['lastname'] ?>!
    </h1>

    <div class="container">
        <form method='post'>

            <table class='table table-bordered'>

                <tr>
                    <td>First Name</td>
                    <td><input type='text' name='StudentFirstName' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Last Name</td>
                    <td><input type='text' name='StudentLastName' class='form-control' required></td>
                </tr>
                    
                <tr>
                    <td>Submitted By Id</td>
                    <td><input type='text' name='SubmittedById' class='form-control' value = "Will be your user id" required disabled ></td>
                </tr>

                <tr>
                    <td>Status Id(Pending)</td>
                    <td><input type='text' name='StatusId' class='form-control' value = "Will be pending" required disabled></td>
                </tr>

                <tr>
                    <td>Course Wanting Approved</td>
                    <td><input type='text' name='Courses' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Concentration</td>
                    <td><input type='text' name='MajorConcentration' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Student 900 Number</td>
                    <td><input type='text' name='StudentId' class='form-control' required></td>
                </tr>

                <tr>
                    <td>CRN</td>
                    <td><input type='text' name='ApprovedForCRN' class='form-control' required></td>
                </tr>

                <tr>
                    <td>Notes</td>
                    <td><input type='text' name='Notes' class='form-control' required></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-primary" name="btn-save">
                            <span class="glyphicon glyphicon-plus"></span> Create New Record
                        </button>
                        <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to Home</a>
                    </td>
                </tr>

            </table>
        </form>

    </div>

<?php 
}
include_once 'footer.php'; ?>