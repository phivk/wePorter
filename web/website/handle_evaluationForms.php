<?php
/*
handle_evaluationForms.php
Receive data from different evaluationForms
Submit formData to db using evaluaitonFormHandler object
Relocate to next form
@author Philo van Kemenade [at gmail dot com]
@copyright 2012 Philo van Kemenade
*/
require_once("./php/evaluationFormHandler.php");
// resume session to load interactionId from $_SESSION var
session_start();
$DEBUG = false;

if(isset($_POST['evaluation1']))
{
  // process evaluation1: person + parallelPair, proceed to next page
  if (!$DEBUG) {
    header("Location: ./evaluation2.php");
  }
  $form1Handler = new EvaluationHandler($_POST);
  $form1Handler->setDebug($DEBUG);
  if ($form1Handler->validatePersonData()) {
    echo "<br>person validated<br>"; 
    if ($form1Handler->validateEvaluationData()) {
      echo "<br>evaluation validated<br>";
      // $form1Handler->extractEvaluationData();
      $form1Handler->extractPersonData();
      // set pair data
      // $form1Handler->setPairData("parallelPair");
      // store person data, get person id
      $personId = $form1Handler->store_person();
      // store $personId in SESSION VAR for following forms
      $_SESSION['personId'] = $personId;
      if ($DEBUG) {
        echo "person id: ", $personId;
      }
      // store evaluation data
      $evaluationId = $form1Handler->store_evaluation("parallelPair");
      // store person id with evaluation data
      $form1Handler->store_personId($personId, $evaluationId);
      // DEBUG
      if ($DEBUG) {
        echo "<br>1 record added<br>";
      }
    }
    else {
      exit("couldn't validate evalution data");
    }
  }
  else {
    exit("couldn't validate person data");
  }
} // isset $_POST['evaluation1']
else if(isset($_POST['evaluation2']))
{
  // process evaluation1: person + parallelPair, proceed to next page
  if (!$DEBUG) {
    header("Location: ./evaluation3.php");
  }
  $form1Handler = new EvaluationHandler($_POST);
  $form1Handler->setDebug($DEBUG);
  if ($form1Handler->validateEvaluationData()) {
    echo "<br>evaluation validated<br>";
    // $form1Handler->extractEvaluationData();
    // set pair data
    // $form1Handler->setPairData("seqPair1");
    // store evaluation data
    $evaluationId = $form1Handler->store_evaluation("seqPair1");            
    if (isset($_SESSION['personId'])) {
      $personId = $_SESSION['personId'];
      echo "person id: ", $personId;
      $form1Handler->store_personId($personId, $evaluationId);
    }    
    // DEBUG
    if ($DEBUG) {
      echo "<br>1 record added<br>";
    }
  }
  else {
    exit("couldn't validate evalution data");
  }
} // isset $_POST['evaluation2']
else {
  exit("received data from unknown form");
}
?>