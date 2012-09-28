<?php
echo "in php", "<br/>";

$counts=$_GET["counts"];

echo $counts, "<br/>";

$db_servername = "localhost";
$db_username = "root";
$db_password = "root";
$db_name = "tutorial";

// mysqli connection
$mysqli = new mysqli($db_servername, $db_username, $db_password, $db_name);
if (!mysqli_connect_errno()) {
  echo "connected to db ". $db_name ." on ".$db_servername."<br>";
}
else {
  exit("db connection error: ".mysqli_connect_errno());
}

$sql="SELECT * FROM Videos WHERE vId = 1";

$result = $mysqli->query($sql) or die($mysqli->error.__LINE__);

print_r($result);


while($row = $result->fetch_row()) {
  print_r($row);  
}

mysqli_close($mysqli);
?>