<?php
  require('helpers.php');
  // all echoes here are send as responsetext to emitCounts in wePorter.php
  $counts=$_GET["counts"];
  // print_r($sl);
  
  // string to count vars
  $ratings = explode(",", $counts);

  // chop ratings in two for separate seqs
  $chunks = array_chunk($ratings, count($ratings)/2);
  $seqRat1 = $chunks[0];
  $seqRat2 = $chunks[1];
  
  print_r($seqRat1);
  print_r($seqRat2);
  
  $db_servername = "localhost";
  $db_username = "root";
  $db_password = "root";
  // DEBUG
  // $db_name = "tutorial";
  $db_name = "LessIsMore";

  // mysqli connection
  $mysqli = new mysqli($db_servername, $db_username, $db_password, $db_name);
  if (!mysqli_connect_errno()) {
    // echo "connected to db ". $db_name ." on ".$db_servername."<br>";
  }
  else {
    exit("db connection error: ".mysqli_connect_errno());
  }
  
  // "INSERT INTO Interactions (`created`)
  // VALUES (NOW());
  // 
  // INSERT INTO `Sequence_Pair_Ratings_6Parts` (seq_r1_1,seq_r1_2,seq_r1_3,seq_r1_4,seq_r1_5,seq_r1_6,seq_r2_1,seq_r2_2,seq_r2_3,seq_r2_4,seq_r2_5,seq_r2_6
  // )
  // VALUES (1,2,3,4,5,6,7,8,9,1,2,3);"
  $sql="SELECT * FROM Videos WHERE vId = 1";

  $result = $mysqli->query($sql) or die($mysqli->error.__LINE__);

  // print_r($result);


  while($row = $result->fetch_row()) {
    // print_r($row);  
  }

  mysqli_close($mysqli);
?>