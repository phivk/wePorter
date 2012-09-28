<?php
  $debug = true;
  // resume session to store inserted interaction index for later use in handle_form.php
  session_start();
  require('helpers.php');
  
  // mysqli connection
  $db_servername = "localhost";
  $db_username = "root";
  $db_password = "root";
  $db_name = "LessIsMore";
  
  $mysqli = new mysqli($db_servername, $db_username, $db_password, $db_name);
  if (mysqli_connect_errno()) {
    exit("db connection error: ".mysqli_connect_errno());
  }
  
  // all echoes here are send as responsetext to emitCounts in wePorter.php
  $counts=$_GET["counts"];
  $vpIdsStr=$_GET["vpIds"];
  
  // convert counts
  $ratings = explode(",", $counts);
  $seqRatings = splitDelimiterString($counts, ",", 2);  
  print_r($seqRatings);  
  
  // convert 
  $vpIds = explode(",", $vpIdsStr);  
  $seqVpIds = splitDelimiterString($vpIdsStr, ",", 2);
  print_r($seqVpIds);
  

  
  // store sequences & ratings
  $sqlInsert = "INSERT INTO `InteractionsDirect` 
  (`created`, `sequence1`, `sequence2`, `sequence_ratings1`, `sequence_ratings2`)
  VALUES 
  (NOW(), '$seqVpIds[0]', '$seqVpIds[1]', '$seqRatings[0]', '$seqRatings[1]');";
  
  // increment vpCounts
  for ($i=0; $i < count($vpIds); $i++) { 
    $sqlIncCount = "UPDATE `Video_Part_Counts` 
    SET vpcount = vpcount + 1 
    WHERE vpId = $vpIds[$i];";
    $mysqli->query($sqlIncCount) or die($mysqli->error.__LINE__);
  }
  
  $mysqli->query($sqlInsert) or die($mysqli->error.__LINE__);
  // store inserted interactionId in super global $_SESSION var
  $interactionId = $mysqli->insert_id;
  $_SESSION['interactionId']=$interactionId;

  mysqli_close($mysqli);
?>