<?php
include_once 'dbconfig.php';
include_once 'myLogin.php';

$status = 1;
$notes = "Add Notes Here for Approving or Denying";
$crn = "Approved for CRN: ";

if(!isset($_SESSION['loggedin']))
{
    header("Location: index.php");
} else {
    
    if(isset($_POST['btn-update']))
    {
        $id = $_GET['edit_id'];
        $status = $_POST['StatusId'];
        $notes = $_POST['Notes'];
        $crn = $_POST['ApprovedForCRN'];
        
        if($crud->update($id, $status, $crn, $notes))
        {
            header("Location: index.php");
        }
        else
        {
            $msg = "<div class='alert alert-warning'>
                    ERROR while updating record 
                    </div>";
        }
    }

    if(isset($_GET['edit_id']))
    {
        $id = $_GET['edit_id'];
        extract($crud->getID($id));	
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
                <form method='post'>

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
            $stmt = $DB_con->prepare("SELECT Requests.*, Users.Email AS Email FROM Requests LEFT JOIN Users ON Requests.SubmittedById = Users.id WHERE Requests.id=:id");
            $stmt->execute(array(":id"=>$_GET['edit_id']));
            while($row=$stmt->fetch(PDO::FETCH_BOTH))
            {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['Courses']); ?></td>
                    <td><?php print($row['MajorConcentration']); ?></td>
                    <td><?php print($row['StudentId']); ?></td>
                    <td><?php print($row['StudentFirstName']); ?></td>
                    <td><?php print($row['StudentLastName']); ?></td>
                    <td><?php print($row['SubmittedById']); ?></td>
                    <td><?php
                        if(($row['StatusId']) == 1){
                            echo "Pending";
                        } else if(($row['StatusId']) == 2){
                            echo "Denied";
                        } else if(($row['StatusId']) == 3){
                            echo "Approved";
                        } else if(($row['StatusId']) == 4){
                            echo "Complete";
                        } else echo "Error";
                        ?></td>

                    <td><?php print($row['ApprovedForCRN']); ?></td>
                    <td><?php print($row['Notes']); ?></td>
                    <td><?php print($row['Email']); ?></td>
                </tr>
                <?php
            }
            ?>
                    </table>

                <table class='table table-bordered'>

                    <tr>
                        <td>Status Id</td>
                        <td>
                        <select name="StatusId" id="StatusId" class='form-control'>
                            <option value="1">Pending</option>
                            <option value="2">Denied</option>
                            <option value="3">Approved</option>
                            <option value="4">Complete</option>
                        </select>
                            
                        </td>
                    </tr>

                    <tr>
                        <td>Notes</td>
                        <td><input type='text' name='Notes' class='form-control' value="<?php echo $notes; ?>" required></td>
                    </tr>

                    <tr>
                        <td>Approved for CRN</td>
                        <td><input type='text' name='ApprovedForCRN' class='form-control' value="<?php echo $crn; ?>" required></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary" name="btn-update">
                            <span class="glyphicon glyphicon-edit"></span>  Update this Record
                            </button>
                            <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
                        </td>
                    </tr>

                </table>
            </form>

            </div>

    <?php 
}
include_once 'footer.php'; ?>