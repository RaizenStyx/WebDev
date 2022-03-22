<?php

class crud
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }

    public function create($courses, $major, $studentid, $fname, $lname, $submittedby, $status, $crn, $notes)
    {
        try
        {
            $stmt = $this->db->prepare("INSERT INTO Requests(Courses,MajorConcentration,StudentId,StudentFirstName,
                     StudentLastName,SubmittedById,StatusId,ApprovedForCRN,Notes) 
                VALUES(:courses, :major, :studentid, :fname, :lname, :submittedby, :status, :crn, :notes)");
            $stmt->bindparam(":courses", $courses);
            $stmt->bindparam(":major", $major);
            $stmt->bindparam(":studentid", $studentid);
            $stmt->bindparam(":fname", $fname);
            $stmt->bindparam(":lname", $lname);
            $stmt->bindparam(":submittedby", $submittedby);
            $stmt->bindparam(":status", $status);
            $stmt->bindparam(":crn", $crn);
            $stmt->bindparam(":notes",$notes);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Requests WHERE id=:id");
        $stmt->execute(array(":id"=>$id));
        $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function getName($id)
    {
        $stmt = $this->db->prepare("SELECT FirstName, LastName FROM Requests WHERE id=:id");
        $stmt->execute(array(":id"=>$id));
        $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function update($id, $status, $CRNApproveFor, $notes)
    {
        try
        {
            $stmt=$this->db->prepare("UPDATE Requests SET  ApprovedForCRN = :CRN,
													        Notes=:notes,
													        StatusId=:status
													WHERE id=:id ");

            $stmt->bindparam(":notes",$notes);
            $stmt->bindparam(":status",$status);
            $stmt->bindparam(":CRN",$CRNApproveFor);
            $stmt->bindparam(":id",$id);
            $stmt->execute();

            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM Requests WHERE id=:id");
        $stmt->bindparam(":id",$id);
        $stmt->execute();
        return true;
    }

    public function getIDUser($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM Users WHERE id=:id");
        $stmt->execute(array(":id"=>$id));
        $editRow=$stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM Users WHERE id=:id");
        $stmt->bindparam(":id",$id);
        $stmt->execute();
        return true;
    }

    public function updateUser($id, $FirstName, $LastName, $UserName, $Password, $Email)
    {
        try
        {
            $stmt=$this->db->prepare("UPDATE Users SET  FirstName = :fname,
													    LastName =:lname,
													    UserName =:usrname,
                                                        Password = :pword,
                                                        Email = :email        
													    WHERE id=:id ");

            $stmt->bindparam(":fname",$FirstName);
            $stmt->bindparam(":lname",$LastName);
            $stmt->bindparam(":usrname",$UserName);
            $stmt->bindparam(":pword",$Password);
            $stmt->bindparam(":email",$Email);
            $stmt->bindparam(":id",$id);
            $stmt->execute();

            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }
    public function createUser($FirstName, $LastName, $UserName, $Password, $Email, $RoleId)
    {
        try
        {
            $stmt = $this->db->prepare("INSERT INTO Users(FirstName,LastName,UserName,Password, Email,roleId) 
                VALUES(:fname, :lname, :username, :password, :email, :roleid)");
            $stmt->bindparam(":fname", $FirstName);
            $stmt->bindparam(":lname", $LastName);
            $stmt->bindparam(":username", $UserName);
            $stmt->bindparam(":password", $Password);
            $stmt->bindparam(":email", $Email);
            $stmt->bindparam(":roleid", $RoleId);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    /* paging */

    public function userData($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        if($stmt->rowCount()>0)
        {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <tr>
                    <td><?php print($row['id']); ?></td>
                    <td><?php print($row['FirstName']); ?></td>
                    <td><?php print($row['LastName']); ?></td>
                    <td><?php print($row['UserName']); ?></td>
                    <td><?php print($row['Password']); ?></td>
                    <td><?php print($row['Email']); ?></td>
                    <td><?php
                        if (($row['roleId']) == 1 )
                        {print ("Admin");
                        }
                        if (($row['roleId']) == 2 )
                        {print ("Advisor");
                        }
                        if (($row['roleId']) == 3 )
                        {print ("Student");
                        }
                        ?></td>

                    <td align="center">
                        <a href="editUser.php?edit_id=<?php print($row['id']); ?>"><button>Edit</button></a>
                    </td>
                    <td align="center">
                        <a href="deleteUser.php?delete_id=<?php print($row['id']); ?>"><button>Delete</button></a>
                    </td>
                </tr>
                <?php
            }
        }
        else
        {
            ?>
            <tr>
                <td>Nothing here...</td>
            </tr>
            <?php
        }

    }


    public function dataview($query)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        if($stmt->rowCount()>0)
        {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
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
                    <td align="center">
                    <?php
                    if((isset($_SESSION['loggedin']))
                        && isset($_SESSION['userlevel'])
                        && ($_SESSION['userlevel'] == 1))
                    {
                    ?>
                    </td>
                    <td align="center">
                        <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><button>Edit</button></a>
                    </td>
                    <td align="center">
                        <a href="delete-data.php?delete_id=<?php print($row['id']); ?>"><button>Delete</button></a>
                    </td>
                        <?php
                    }
                        ?>
                </tr>
                <?php
            }
        }
        else
        {
            ?>
            <tr>
                <td>Nothing here...</td>
            </tr>
            <?php
        }

    }

    public function paging($query,$records_per_page)
    {
        $starting_position=0;
        if(isset($_GET["page_no"]))
        {
            $starting_position=($_GET["page_no"]-1)*$records_per_page;
        }
        $query2=$query." limit $starting_position,$records_per_page";
        return $query2;
    }

    public function paginglink($query,$records_per_page)
    {

        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $total_no_of_records = $stmt->rowCount();

        if($total_no_of_records > 0)
        {
            ?><ul class="pagination"><?php
            $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
            $current_page=1;
            if(isset($_GET["page_no"]))
            {
                $current_page=$_GET["page_no"];
            }
            if($current_page!=1)
            {
                $previous =$current_page-1;
                echo "<li><a href='".$self."?page_no=1'>First</a></li>";
                echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
            }
            for($i=1;$i<=$total_no_of_pages;$i++)
            {
                if($i==$current_page)
                {
                    echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
                }
                else
                {
                    echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
                }
            }
            if($current_page!=$total_no_of_pages)
            {
                $next=$current_page+1;
                echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
                echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
            }
            ?></ul><?php
        }
    }

    /* paging */
   

}