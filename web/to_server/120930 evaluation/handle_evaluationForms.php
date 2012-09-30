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
  $formHandler = new EvaluationHandler($_POST);
  $formHandler->setDebug($DEBUG);
  if ($formHandler->validatePersonData()) {
    echo "<br>person validated<br>";
    $personId = $formHandler->store_person();
    // store $personId in SESSION VAR for following forms
    $_SESSION['personId'] = $personId;
    if ($DEBUG) {
      echo "person id: ", $personId;
    }
    
    $formHandler->process_evaluation_data("parallelPair");
  }
  else {
    exit("couldn't validate person data");
  }
} // isset $_POST['evaluation1']

else if(isset($_POST['evaluation2']))
{
  // process evaluation: seqPair, proceed to next page
  if (!$DEBUG) {
    header("Location: ./evaluation3.php");
  }
  $formHandler = new EvaluationHandler($_POST);
  $formHandler->setDebug($DEBUG);
  $formHandler->process_evaluation_data("seqPair1");
} // isset $_POST['evaluation2']

else if(isset($_POST['evaluation3']))
{
  // process evaluation3: seqPair, proceed to next page
  if (!$DEBUG) {
    header("Location: ./evaluation4.php");
  }
  $formHandler = new EvaluationHandler($_POST);
  $formHandler->setDebug($DEBUG);
  $formHandler->process_evaluation_data("seqPair2");
} // isset $_POST['evaluation3']

else if(isset($_POST['evaluation4']))
{
  // process evaluation4: video, proceed to next page
  if (!$DEBUG) {
    header("Location: ./evaluation5.php");
  }
  $formHandler = new EvaluationHandler($_POST);
  $formHandler->setDebug($DEBUG);
  $formHandler->process_evaluation_data("videoPair1");
} // isset $_POST['evaluation4']
else if(isset($_POST['evaluation5']))
{
  // process evaluation: videoPair, proceed to next page
  if (!$DEBUG) {
    header("Location: ./evaluation6.php");
  }
  $formHandler = new EvaluationHandler($_POST);
  $formHandler->setDebug($DEBUG);
  $formHandler->process_evaluation_data("videoPair2");
} // isset $_POST['evaluation5']
else if(isset($_POST['evaluation6']))
{
  // process evaluation: videoPair, proceed to next page
  if (!$DEBUG) {
    header("Location: ./evaluation7.php");
  }
  $formHandler = new EvaluationHandler($_POST);
  $formHandler->setDebug($DEBUG);
  $formHandler->process_evaluation_data("videoPair3");
} // isset $_POST['evaluation6']
else if(isset($_POST['evaluation7']))
{
  // process evaluation: videoPair, proceed to next page
  if (!$DEBUG) {
    header("Location: ./evaluation8.php");
  }
  $formHandler = new EvaluationHandler($_POST);
  $formHandler->setDebug($DEBUG);
  $formHandler->process_evaluation_data("videoPair4");
} // isset $_POST['evaluation7']
else if(isset($_POST['evaluation8']))
{
  // process evaluation: videoPair, proceed to next page
  if (!$DEBUG) {
    header("Location: ./evaluation9.php");
  }
  $formHandler = new EvaluationHandler($_POST);
  $formHandler->setDebug($DEBUG);
  $formHandler->process_evaluation_data("videoPair5");
} // isset $_POST['evaluation8']
else if(isset($_POST['evaluation9']))
{
  // process evaluation: videoPair, proceed to next page
  if (!$DEBUG) {
    header("Location: ./thanks.php");
  }
  $formHandler = new EvaluationHandler($_POST);
  $formHandler->setDebug($DEBUG);
  $formHandler->process_evaluation_data("videoPair6");
} // isset $_POST['evaluation9']
else {
  exit("received data from unknown form");
}
?>