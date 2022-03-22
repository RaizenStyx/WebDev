<?php
//A method for sanitizing user input
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Set the default timezone before using date() function
date_default_timezone_set("UTC");

//Defining a constant min and max year so if it needs to be changed, this is the only place that will need to be updated.
//Define is the same as const. Next 3 lines were all define, changed last to const.
define("MIN_YEAR", 1970);
define("MAX_YEAR", date("Y"));
const SHOW_ERRORS = true; //this could be set to true to see output of $errorMessages

//Define acceptable values for order by and limit to user input, as well as values for form input
$orderArray = array("name","platform","year","genre","publisher");
$limitArray = array("50","100","1000", "5000");
$errorMessages = "";
$searchName = "";

//The form needs some default values to mark as selected on the first run
$orderBy = $orderArray[0];
$limitTo = $limitArray[0];
$minimumYear = MIN_YEAR;
$maximumYear = MAX_YEAR;

//Do some validation, any form error will cause a validation error, in that event flip this flag to false
$validated = true;

//The server request from the form should be a GET request and the submit button should be set, otherwise set validated to false
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //Only going to check if submit has a value so it ignores validation on first load
    if(!empty($_GET["submit"])) {
        // Only accepting values from $orderBy array to prevent SQL injection.
        // You can't user bindParam on limit to or order by table names

        // If not empty start processing the value orderBy form value, otherwise required field not validated
        if (!empty($_GET["orderBy"])) {
            // sanitize user input
            $orderBy = sanitize($_GET["orderBy"]);

            // If the value given is not a white listed value, required field not validated
            if (!in_array($orderBy, $orderArray)) {
                $validated = false;
                $errorMessages .= " Invalid order by field. ";
            }
        } else {
            $validated = false;
            $errorMessages .= " Order by required. ";
        }

        // Do the same for limit to validation using $limitTo array
        // If not empty start processing the returnLimit form value, otherwise required field not validated
        if (!empty($_GET["returnLimit"])) {
            $limitTo = sanitize($_GET["returnLimit"]);

            // If the value given is not a white listed value, required field not validated
            if (!in_array($_GET["returnLimit"], $limitArray)) {
                $validated = false;
                $errorMessages .= " Invalid return limit field. ";
            }
        } else {
            $validated = false;
            $errorMessages .= " Limit to required. ";
        }

        //Check minimum and maximum values for validation
        if (!empty($_GET["minimumYear"]) && !empty($_GET["maximumYear"])) {
            $minimumYear = sanitize($_GET["minimumYear"]);
            $maximumYear = sanitize($_GET["maximumYear"]);

            if ($minimumYear > $maximumYear) {
                //if min > than max that is an error
                $validated = false;
                $errorMessages .= " Min date can not be greater than max date. ";
            } elseif ($minimumYear < MIN_YEAR) {
                //if user specified min is less than our defined min
                $validated = false;
                $errorMessages .= " Minimum year must be less than " . MIN_YEAR . ". ";
            } elseif ($maximumYear > MAX_YEAR) {
                //if user specified max is greater than our defined max
                $validated = false;
                $errorMessages .= " Maximum year must be greater than " . MAX_YEAR . ". ";
            }
        } else {
            $validated = false;
            $errorMessages .= " Min and max year required. ";
        }

        if(!empty($_GET['game_name'])) {
            $searchName = sanitize($_GET['game_name']);
        }


    }else{
        //no submit so first run, not an error state but the form is not validated yet either
        $validated = false;
    }
}else{
    $validated = false;
    $errorMessages .= " POST method. Should be GET. ";
}

// If the form has been validated, connect to the database and make a request
// Ideally this code should be moved to central database access file. This works for now.
if($validated){
    // Create a PHP database object
    $db = new PDO("mysql:host=localhost;dbname=novus", "sa", "Northeast1");

    // Create a prepared statement, which is an SQL query with some PHP variables mixed in.
    // Using bindparam method to do a string replacement on the tagged fields below :beg/:end because it does some
    // sanitation. Just an extra level of protection since all fields have already been sanitized manually
    // Bindparam does not work on order by and limit fields so they have been added to the SQL query string
    // via variable interpolation
    $q = "SELECT * FROM video_game_sales WHERE year BETWEEN :beg AND :end AND name LIKE :name ORDER BY $orderBy limit $limitTo";

    //Pass the query to the database and get a statement object
    $statement = $db->prepare($q);
    //Bind the validated user input to the fields in the statement
    $statement->bindparam(":beg", $minimumYear);
    $statement->bindparam(":end", $maximumYear);
    $temp = "%".$searchName."%";
    $statement->bindParam(":name", $temp);

    //Execute the query
    $statement->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MegaGame: A Video Game Database</title>
</head>
<body>
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <table style="margin-left: auto; margin-right: auto;">
        <tr>
            <td colspan="2" style="text-align:center;">
                <h1 style="text-align:center;">PowerSearch by MegaGame</h1>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">Search by Name:</td>
            <td>
                <input type="text" name="game_name" value="<?php echo $searchName; ?>">
            </td>
        <tr>
            <td style="text-align:right;">
                Min Publication Year
            </td>
            <td style="text-align:left;">
                <select name="minimumYear">
                    <?php
                        for($year=MIN_YEAR; $year <= MAX_YEAR; $year++){
                            echo "<option value=\"$year\"";
                            if($year == $minimumYear)
                                echo " selected=\"selected\" ";
                            echo ">$year</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align:right;">
                Max Publication Year
            </td>
            <td style="text-align:left;">
                <select name="maximumYear">
                    <?php
                    for($year=MIN_YEAR; $year <= MAX_YEAR; $year++) {
                        echo "<option value=\"$year\"";
                        if($year == $maximumYear)
                            echo " selected=\"selected\" ";
                        echo ">$year</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align:right;">
                Order By
            </td>
            <td style="text-align:left;">
                <select name="orderBy">
                    <?php
                    foreach($orderArray as $value) {
                        echo "<option value=\"$value\"";
                        if($value == $orderBy)
                            echo " selected=\"selected\" ";
                        echo ">$value</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align:right;">
                Limit search to top
            </td>
            <td style="text-align:left;">
                <select name="returnLimit">
                    <?php
                    foreach($limitArray as $value) {
                        echo "<option value=\"$value\"";
                        if($value == $limitTo)
                            echo " selected=\"selected\" ";
                        echo ">$value</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="submit" name="submit">
            </td>
        </tr>
    </table>

</form>
<?php if($validated){ ?>
    <div style="text-align: center">PowerSearch Results</div>
    <table style="margin-left: auto; margin-right: auto;">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Platform</th>
            <th>Year</th>
            <th>Genre</th>
            <th>Publisher</th>
        </tr>

        <?php while($row=$statement->fetch()) { ?>
            <tr>
                <td><?php echo $row["id"] ?></td>
                <td><?php echo $row["name"] ?></td>
                <td><?php echo $row["platform"] ?></td>
                <td><?php echo $row["year"] ?></td>
                <td><?php echo $row["genre"] ?></td>
                <td><?php echo $row["publisher"] ?></td>
            </tr>
        <?php } ?>
    </table>
    <?php
    $statement=null;
    $db=null;
}else{
    //form not validated we could display the errors
    if(SHOW_ERRORS){
        echo $errorMessages;
    }
}
?>
</body>
</html>
