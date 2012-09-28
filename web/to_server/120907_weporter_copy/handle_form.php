<?php
  /*
  handle_form.php
  Receive data from form after interaction on wePorter.php
  Submit formData to db
  Relocate to weporter.php
  Philo van Kemenade [at gmail dot com]
  */
  // resume session to load interactionId from $_SESSION var
  session_start(); 
  
  // redirect to homepage
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'weporter.php';
  header("Location: http://$host$uri/$extra");
  
  require_once("./include/formvalidator.php");
  $debug = false;
  
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
  
  if(isset($_POST['submit']))
  {
    // Verify reCaptcha 
    // require_once('./include/recaptcha/recaptchalib.php');
    // $privatekey = "6LeludUSAAAAABTKKxyVaKatzDN5a-IbUjFHl3sS";
    // $resp = recaptcha_check_answer ($privatekey,
    //                               $_SERVER["REMOTE_ADDR"],
    //                               $_POST["recaptcha_challenge_field"],
    //                               $_POST["recaptcha_response_field"]);
    // 
    // if (!$resp->is_valid) {
    //   // What happens when the CAPTCHA was entered incorrectly
    //   die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
    //        "(reCAPTCHA said: " . $resp->error . ")");
    // } 
    // else {
      // Successful reCaptcha verification
      $validator = new FormValidator();
      $validator->addValidation("formName","req","Please fill in your Name");
      $validator->addValidation("formEmail","email",
  "Please fill in a valid email aformddress");
      $validator->addValidation("formEmail","req","Please fill in your Email");
      $validator->addValidation("formAge","req","Please fill in your Age");
      $validator->addValidation("formAge","num","Please use a number for Age");

      if($validator->ValidateForm())
      {        
        /// Connect to Database ///
        $db_servername = "localhost";
        $db_username = "root";
        $db_password = "root";
        // DEBUG
        // $db_name = "tutorial";
        $db_name = "LessIsMore";
        

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
        // Sanatize for SQL and convert to proper datatype
        // strings
        $formData['name'] = $mysqli->real_escape_string($_POST['formName']);
        $formData['email'] = $mysqli->real_escape_string($_POST['formEmail']);

        // string to int
        $formData['age'] = intval($mysqli->real_escape_string($_POST['formAge']));
        $formData['hear'] = intval($mysqli->real_escape_string($_POST['formHear']));
        $formData['frequency'] = intval($mysqli->real_escape_string($_POST['formFrequency']));
        $formData['duration'] = intval($mysqli->real_escape_string($_POST['formDuration']));
        $formData['news'] = intval($mysqli->real_escape_string($_POST['formNews']));
        $formData['record'] = intval($mysqli->real_escape_string($_POST['formRecord']));
        $formData['upload'] = intval($mysqli->real_escape_string($_POST['formUpload']));
        $formData['remix'] = intval($mysqli->real_escape_string($_POST['formRemix']));
        $formData['experience'] = intval($mysqli->real_escape_string($_POST['formExperience']));

        // string
        $formData['comments'] = $mysqli->real_escape_string(nl2br(strip_tags($_POST['formComments'])));

        // create Questionnaires table if not exists
        if (!table_exists("Questionnaires", $db_name, $mysqli)) {
          
          if ($debug) {
            print "Now creating Questionnaires table<br/>";
          }
          // create Questionnaires table
          $createQuery = "
          CREATE TABLE Questionnaires
          (
          formName varchar(30) ,
          formEmail varchar(30) ,
          formAge int ,
          formHear int ,
          formFrequency int ,
          formDuration int ,
          formNews int ,
          formRecord int ,
          formUpload int ,
          formRemix int ,
          formExperience int ,
          formComments varchar(300)
          )";
          if (!mysqli_query($mysqli, $createQuery))  {
            die ('Error: ' . mysql_error());
          }
        }
        else {
          if ($debug) {
            print "Questionnaires Table found<br/>";
          }
        }        
        
        // insert Questionaire data into db
        $insertQuery = "INSERT INTO Questionnaires (`created`,`formName`,`formEmail`,`formAge`,`formHear`,`formFrequency`,`formDuration`,`formNews`,`formRecord`,`formUpload`,`formRemix`,`formExperience`,`formComments`)
                  VALUES
                  (
                  NOW(), '".
                  $formData['name']."', '".
                  $formData['email']."', '".
                  $formData['age']."', '".
                  $formData['hear']."', '".
                  $formData['frequency']."', '".
                  $formData['duration']."', '".
                  $formData['news']."', '".
                  $formData['record']."', '".
                  $formData['upload']."', '".
                  $formData['remix']."', '".
                  $formData['experience']."', '".
                  $formData['comments']."'
                  );";
        $mysqli->query($insertQuery) or die($mysqli->error.__LINE__);
        
        // update Interaction table to point to this questionnaireId
        if (isset($_SESSION['interactionId'])) {
          $interactionId = $_SESSION['interactionId'];
          $questionnaireId = $mysqli->insert_id;
          $sqlUpdateInteraction = "UPDATE `InteractionsDirect`
          SET `questionnaire` = $questionnaireId
          WHERE iId = $interactionId;";
          $mysqli->query($sqlUpdateInteraction) or die($mysqli->error.__LINE__);
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
    //} // else; succesful recaptcha
  } // isset $_POST['submit']
  
  // Redirect to a different page in the current directory that was requested
  if (!$debug) {
    // $host  = $_SERVER['HTTP_HOST'];
    // $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    // $extra = 'weporter.php';
    // header("Location: http://$host$uri/$extra");
    exit;
  }
?>