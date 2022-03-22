<?php
/********************************* Basic Login Page ***********************************
 * We want to:
 * - Create a login page containing userid, password, and submit inputs
 * - After client clicks submit, check database for userid and password
 * - If valid userid/password, log them in and check id for level in  order to 
 *   determine page to present
 * - If invalid userid/password, post error and return to login page
 * - If user is already logged in, present the appropriate page
 * - When user logs out, log them out and present "goodbye" page
 * 
 * Implementation:
 * - Use a session variable, $_SESSION['loggedin'], to determine whether someone is 
 *   logged in
 * - Use a session variable, $_SESSION['userlevel'], to determine user's level
 * - Use a session for first name, $_SESSION['firstname'], to store user's first name
 * - Use a session for last name, $_SESSION['lastname'], to store user's last name
*************************************************************************************/

/***************************** HANDLING CLIENT LOGOUT *******************************/
	session_start();
	header("Cache-Control: no-cache, must-revalidate");
	if(isset($_POST['logout']))
	{
		$_SESSION = array();
?>
		<!-- Once we start outputting HTML, 
		     we can no longer do anything involving headers -->
		<h1>Thank you for visiting.</h1>
<?php
	}

/************************** HANDLING CLIENT LOGIN ATTEMPT ***************************/
	if((isset($_POST['userid']))
		&&(isset($_POST['password']))
		&&(isset($_POST['loginbutton'])))
	{
		// Begin by attempting to connect to the database containing the users
		try
		{
			$db = new PDO("mysql:host=localhost;dbname=Sandbox", "sa", "Northeast1");
		}
		catch (Exception $error) {  //If attempt failed, send error
			die("Connection to user database failed: " . $error->getMessage());
		}
		
		// Now, let's try to access the database table containing the users
		try
		{
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = "SELECT * FROM TeamCUsers WHERE username = :user and password = :pw";
			$statement = $db -> prepare($query);
			$statement -> execute(array(
				'user' => $_POST['userid'], 
				'pw' => $_POST['password'])
			);
			if ($statement -> rowCount() == 1)
			{
				$_SESSION['loggedin']=TRUE;
				// Get the user details from the SINGLE returned database row
				$row = $statement -> fetch();
				$_SESSION['userlevel'] = $row['userlevel'];
				$_SESSION['firstname'] = $row['firstname'];
				$_SESSION['lastname'] = $row['lastname'];
			}
			else
				echo("<h1>Invalid userid or password.</h1>");		

			// Close the statement and the database
			$statement = null;
			$db = null;
		}
		catch (Exception $error) 
		{
			echo "Error occurred accessing user privileges: " . $error->getMessage();
		}
	}

/*********************** PRESENTING CLIENT WITH LOGIN SCREEN ************************/
	if(!isset($_SESSION['loggedin']))
	{
?>
		<form name='login' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
			User name: <input type='text' name='userid' /><br />
			Password: <input type='password' name='password' /><br />
			<input type='submit' name='loginbutton' value='Click here to log in' />
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
		<h1>
			Welcome to the Administrator Page, 
			<?= $_SESSION['firstname'] ?> 
			<?= $_SESSION['lastname'] ?>!
		</h1>
		<form name='logout' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' >
			<input type='submit' value='Click to logout' name='logout'>
		</form>
<?php
	}

/****************** PRESENTING LOGGED IN CLIENT WITH BASIC SCREEN *******************/
	if((isset($_SESSION['loggedin']))&&($_SESSION['userlevel']==0))
	{
?>
<!-- Place HTML here for the client page -->
		<h1>
			Welcome to the Client Page, 
			<?= $_SESSION['firstname'] ?> 
			<?= $_SESSION['lastname'] ?>!
		</h1>
		<form name='logout' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' >
			<input type='submit' value='Click to logout' name='logout'>
		</form>
<?php
	}
?>


