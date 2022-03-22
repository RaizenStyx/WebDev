<?php
// the credentials below do not work as of now but should be the same if these were changed
$DB_host = "####";
$DB_user = "####";
$DB_pass = "####";
$DB_name = "####";

try
{
    $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
//Grabs the crud file and appends it here
include_once 'class.crud.php';

$crud = new crud($DB_con);

?>
