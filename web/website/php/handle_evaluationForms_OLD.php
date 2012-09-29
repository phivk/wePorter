<?php
  /*
  handle_evaluationForms.php
  Receive data from different evaluationForms
  Submit formData to db
  Relocate to next form
  Philo van Kemenade [at gmail dot com]
  */
  // resume session to load interactionId from $_SESSION var
  session_start(); 
  
  // for redirection to next evaluationForm
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'evaluation2.php';
  header("Location: http://$host$uri/$extra");
  
  /// Database Vars ///
  $db_servername = "localhost";
  $db_username = "root";
  $db_password = "root";
  $db_name = "wePorter";
  
  require_once("../include/formvalidator.php");
  $debug = false;
  
  // helper function to check if table exists
  function table_exists($tablename, $database = false, $mysqli) {
      if(!$database) {
          $res = mysql_query("SELECT DATABASE()");
          $database = mysql_result($res, 0);
      }

      $sqlQuery = "SELECT COUNT(*)
      FROM information_schema.tables 
      WHERE table_schema = '$database' 
      AND table_name = '$tablename'";
      
      $result = mysqli_query($mysqli, $sqlQuery);
      if(!$result) {
          echo "Cannot do query" . "<br/>";
          exit;
      }
      
      $row = mysqli_fetch_row($result);
      $count = $row[0];
      return $count > 0;
  }
  
  if(isset($_POST['evaluation1']))
  {
    
    // process evaluation1: about person + parallel pair
    $validator = new FormValidator();
    $validator->addValidation("formName","req","Please fill in your Name");
    $validator->addValidation("formEmail","email",
"Please fill in a valid email address");
    $validator->addValidation("formEmail","req","Please fill in your Email");
    $validator->addValidation("formAge","req","Please fill in your Age");
    $validator->addValidation("formAge","num","Please use a number for Age");

    if($validator->ValidateForm())
    {            
      // mysqli connection
      $mysqli = new mysqli($db_servername, $db_username, $db_password, $db_name);
      if (mysqli_connect_errno()) {
      		printf("Connect failed: %s\n", mysqli_connect_error());
      		exit();
      }
      if ($debug) {
        print "connected to db ". $db_name ." on ".$db_servername."<br>";
      }
      
      /// Get form data ///
      $formData['pair'] = "parallelPair"; // because evaluation1 number
      // Sanatize for SQL and convert to proper datatype
      // strings
      $formData['name'] = $mysqli->real_escape_string($_POST['formName']);
      $formData['email'] = $mysqli->real_escape_string($_POST['formEmail']);
      $formData['email'] = $mysqli->real_escape_string($_POST['formEmail']);
      $formData['age'] = intval($mysqli->real_escape_string($_POST['formAge']));
      
      // string to int
      $formData["informativeLeft"] = intval($mysqli->real_escape_string($_POST["formInformativeLeft"]));
      $formData["entertainingLeft"] = intval($mysqli->real_escape_string($_POST["formEntertainingLeft"]));
      $formData["interestingLeft"] = intval($mysqli->real_escape_string($_POST["formInterestingLeft"]));
      $formData["informativeRight"] = intval($mysqli->real_escape_string($_POST["formInformativeRight"]));
      $formData["entertainingRight"] = intval($mysqli->real_escape_string($_POST["formEntertainingRight"]));
      $formData["interestingRight"] = intval($mysqli->real_escape_string($_POST["formInterestingRight"]));
      
      // strings
      $formData['preference'] = $mysqli->real_escape_string($_POST['radioPreference']);
      $formData['why'] = $mysqli->real_escape_string(nl2br(strip_tags($_POST['formWhy'])));
      
      
      // TODO store person data in separate Person table
      // store inserted interactionId in super global $_SESSION var
      // $questionnaireId = $mysqli->insert_id;
      // $_SESSION['questionnaireId']=$questionnaireId;
      
      // store evalution data
      if (table_exists("Evaluations", $db_name, $mysqli)) {
        // insert Evaluation data into db
        $insertQuery = "INSERT INTO Evaluations ('created','pair','informativeLeft','entertainingLeft','interestingLeft','informativeRight','entertainingRight','interestingRight','preference','why')
                  VALUES
                  (
                  NOW(), '".
                  $formData['pair']."', '".
                  $formData["informativeLeft"]."', '".
                  $formData["entertainingLeft"]."', '". 
                  $formData["interestingLeft"]."', '".
                  $formData["informativeRight"]."', '".
                  $formData["entertainingRight"]."', '".
                  $formData["interestingRight"]."', '".
                  $formData["preference"]."', '". 
                  $formData['why']."'
                  );";
        $mysqli->query($insertQuery) or die($mysqli->error.__LINE__);
      }
      else {
        exit("Evaluation Table not found");
      }        
      
      // update Evaluation table to point to right Person iD
      if (isset($_SESSION['personId'])) {
        if ($debug) {
          echo "updating eval with personId<br>";
        }
        $personId = $_SESSION['personId'];
        
        $evaluationId = $mysqli->insert_id;
        $sqlUpdateEvaluation = "UPDATE `Evaluations`
        SET `person` = $personId
        WHERE eId = $evaluationId;";
        $mysqli->query($sqlUpdateEvaluation) or die($mysqli->error.__LINE__);
      }
      
      if ($debug) {
        echo "1 record added<br>";
      }

      // close db connection
      mysqli_close($mysqli);
    }
    else
    // Validation failed
    {
        echo "<B>Validation Errors:</B>";
        $error_hash = $validator->GetErrors();
        foreach($error_hash as $inpname => $inp_err)
        {
          echo "<p>$inpname : $inp_err</p>\n";
        }
    }
  } // isset $_POST['evaluation1']
  else {
    // Post received from storeQiD button in thanksModal
    if(isset($_POST['storeQiD'])) {
      if (isset($_SESSION['questionnaireId'])) {
        // update Interaction table to point to this questionnaireId
        if (isset($_SESSION['interactionId'])) {
          // mysqli connection
          $mysqli = new mysqli($db_servername, $db_username, $db_password, $db_name);
          if (mysqli_connect_errno()) {
          		printf("Connect failed: %s\n", mysqli_connect_error());
          		exit();
          }
          if ($debug) {
            print "connected to db ". $db_name ." on ".$db_servername."<br>";
          }
          // send sql insert query
          $interactionId = $_SESSION['interactionId'];
          $questionnaireId = $_SESSION['questionnaireId'];
          $sqlUpdateInteraction = "UPDATE `InteractionsDirect`
          SET `questionnaire` = $questionnaireId
          WHERE iId = $interactionId;";
          $mysqli->query($sqlUpdateInteraction) or die($mysqli->error.__LINE__);
          
          // close db connection
          mysqli_close($mysqli);
          exit; 
        }
      }
    }
  }
  
  // Redirect to a different page as specified in header above
  if (!$debug) {
    exit;
  }
?>