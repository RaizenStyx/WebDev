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
        $crud->delete($id);
        header("Location: delete-data.php?deleted");
    }

    ?>

    <?php include_once 'header.php'; ?>

    <div class="container">

        <?php
        if(isset($_GET['deleted']))
        {
            ?>
            <div class="alert alert-success">
            Success! record was deleted...
            </div>
            <?php
        }
        else
        {
            ?>
            <div class="alert alert-danger">
            Delete the following record ?
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
            $stmt->execute(array(":id"=>$_GET['delete_id']));
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
        <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
        </form>  
        <?php
    }
    else
    {
        header("Location: index.php");
    }
    ?>
    </p>
    </div>	
<?php }
include_once 'footer.php'; ?>