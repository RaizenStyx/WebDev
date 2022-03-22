<?php

/***************************** HANDLING CLIENT LOGOUT *******************************/
	include_once 'dbconfig.php';
    include_once 'header.php';

	session_start();
	header("Cache-Control: no-cache, must-revalidate");
	if(isset($_POST['logout']))
	{
		$_SESSION = array();
?>
		<!-- Once we start outputting HTML, 
		     we can no longer do anything involving headers -->
		<h1 style="margin-left: 25%">Thank you for visiting.</h1>
<?php
	}

/************************** HANDLING CLIENT LOGIN ATTEMPT ***************************/
	if((isset($_POST['userid']))
		&&(isset($_POST['password']))
		&&(isset($_POST['loginbutton'])))
	{
		// Begin by attempting to connect to the database containing the users (Is the dbconfig.php)

		
		// Now, let's try to access the database table containing the users
		try
		{
			$query = "SELECT * FROM Users WHERE UserName = :user and Password = :pw";
			$statement = $DB_con -> prepare($query);
			$statement -> execute(array(
				'user' => $_POST['userid'], 
				'pw' => md5($_POST['password']))
			);
			if ($statement -> rowCount() == 1)
			{
				$_SESSION['loggedin']=TRUE;
				// Get the user details from the SINGLE returned database row
				$row = $statement -> fetch();
				$_SESSION['userlevel'] = $row['roleId'];
				$_SESSION['firstname'] = $row['FirstName'];
				$_SESSION['lastname'] = $row['LastName'];
				$_SESSION['userid'] = $row['id'];
			}
			else
				echo("<h1>Invalid Username or Password.</h1>");

		}
		catch (Exception $error) 
		{
			echo "Error occurred accessing user privileges: " . $error->getMessage();
		}
	}

include_once 'footer.php';


