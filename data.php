<?php

$m = $_GET['m'];
if($m==1)
{
$fd = $_GET['fd'];
$td = $_GET['td'];
}

//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', 'mysql.hostinger.com.br');
define('DB_USERNAME', 'u942257283_nupso');
define('DB_PASSWORD', 'u942257283_banco');
define('DB_NAME', 'nupsolxyz');

//get connection
$mysqli = mysqli_connect("mysql.hostinger.com.br:3306", "u942257283_nupso", "nupsolxyz", "u942257283_banco");

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
	if(isset($fd) && isset($td))
	{
	$query = sprintf("  
			   SELECT * FROM backup 
			   WHERE date BETWEEN '".$fd."' AND '".$td."'  
		  ");
	}
	else
	{
	$query = sprintf("SELECT * FROM backup ORDER BY id");
	}
//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);