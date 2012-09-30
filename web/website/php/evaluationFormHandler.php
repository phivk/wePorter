<?php
class EvaluationHandler
{
  public $DEBUG = false;    
  // db vars
  public $db_servername = "localhost";
  public $db_username = "root";
  public $db_password = "root";
  public $db_name = "wePorter";
  
  // public $db_servername = "localhost";
  // public $db_username = "ma101pvk";
  // public $db_password = "conrrite";
  // public $db_name = "ma101pvk_weporter";
  
  // mysqli db connection
  public $mysqli;
      
  public function __construct($POST)  
  {
    require_once("./include/formvalidator.php");
    $this->POST = $POST;
    if ($this->DEBUG) {
      echo 'The class "', __CLASS__, '" was initiated.<br />'; 
    }
    // open DB connection
    $this->openDBcon();
    echo "<br>", "received POST:", "<br>";
    var_dump($this->POST);
    echo "<br>";
  } 

  public function __destruct() 
  { 
      if ($this->DEBUG) {
        echo "<br>",'The class "', __CLASS__, '" was destroyed.<br />';  
      }
      $this->closeDBcon();
  }
  
  public function __toString()
  {
    $instanceString = 'Instance of class "'.__CLASS__.'"<br />';
    echo $instanceString;
    return $instanceString;
  }
  
  // set DEBUG to True / False
  public function setDebug($bDebug)
  {
    $this->DEBUG = $bDebug;
  }
  
  public function openDBcon()
  {
    // mysqli connection
    $this->mysqli = new mysqli($this->db_servername, $this->db_username, $this->db_password, $this->db_name);
    if (!mysqli_connect_errno()) {
      if ($this->DEBUG) {
        echo "connected to db ". $this->db_name ." on ".$this->db_servername."<br>";
      }
    }
    else {
      exit("db connection error: ".mysqli_connect_errno());
    }
  }
  
  // close mysqli connection
  public function closeDBcon() {
    mysqli_close($this->mysqli);
  }
  
  public function process_evaluation_data($pair){
    if ($this->validateEvaluationData()) {
      if ($this->DEBUG) {
        echo "<br>evaluation validated<br>";
      }
      // store evaluation data
      $evaluationId = $this->store_evaluation($pair);            
      if (isset($_SESSION['personId'])) {
        $personId = $_SESSION['personId'];
        echo "person id: ", $personId;
        $this->store_personId($personId, $evaluationId);
      }
      else {
        echo "personId not set";
      }    
      // DEBUG
      if ($this->DEBUG) {
        echo "<br>1 record added<br>";
      }
    }
    else {
      exit("couldn't validate evalution data");
    }
  }
  
  // validate person data, returns boolean whether validated
  public function validatePersonData() {
    $personValidator = new FormValidator();
    $personValidator->addValidation("formName","req","Please fill in your Name");
    $personValidator->addValidation("formEmail","email",
"Please fill in a valid email address");
    $personValidator->addValidation("formEmail","req","Please fill in your Email");
    $personValidator->addValidation("formAge","req","Please fill in your Age");
    $personValidator->addValidation("formAge","num","Please use a number for Age");
    return $personValidator->ValidateForm();
  }
    
  // validate evaluation data, returns boolean whether validated
  public function validateEvaluationData() {
    $evaluationValidator = new FormValidator();
    $evaluationValidator->addValidation("formInformativeLeft", "req","please choose formInformativeLeft");
    $evaluationValidator->addValidation("formEntertainingLeft", "req","please choose formEntertainingLeft");
    $evaluationValidator->addValidation("formInterestingLeft", "req","please choose formInterestingLeft");
    $evaluationValidator->addValidation("formInformativeRight", "req","please choose formInformativeRight");
    $evaluationValidator->addValidation("formEntertainingRight", "req","please choose formEntertainingRight");
    $evaluationValidator->addValidation("formInterestingRight", "req","please choose formInterestingRight");
    $evaluationValidator->addValidation("formPreference", "req","please choose formPreference");
    return $evaluationValidator->ValidateForm();
  }

  // DEPRECATED
  // public function setPairData($pair){
  //   $this->evaluationData["pair"] = $pair;
  // }
  
  // helper public function to check if table exists
  public function table_exists($tablename, $database = false) {
      if(!$database) {
          $res = mysql_query("SELECT DATABASE()");
          $database = mysql_result($res, 0);
      }

      $sqlQuery = "SELECT COUNT(*)
      FROM information_schema.tables 
      WHERE table_schema = '$database' 
      AND table_name = '$tablename'";

      $result = mysqli_query($this->mysqli, $sqlQuery);
      if(!$result) {
          echo "Cannot do query" . "<br/>";
          exit;
      }

      $row = mysqli_fetch_row($result);
      $count = $row[0];
      return $count > 0;
  }
  
  public function store_person(){
    // Sanatize for SQL and convert to proper datatype
    // strings
    $formData['name'] = $this->mysqli->real_escape_string($this->POST['formName']);
    $formData['email'] = $this->mysqli->real_escape_string($this->POST['formEmail']);
    $formData['email'] = $this->mysqli->real_escape_string($this->POST['formEmail']);

    $formData['age'] = intval($this->mysqli->real_escape_string($this->POST['formAge']));
    
    // insert Persons data into db
    $insertQuery = "INSERT INTO Persons (`created`,`formName`,`formEmail`,`formAge`)
              VALUES
              (
              NOW(), '".
              $formData['name']."', '".
              $formData['email']."', '".
              $formData['age']."'
              );";
    $this->mysqli->query($insertQuery) or die($this->mysqli->error.__LINE__);
    return $this->mysqli->insert_id;
  }

  public function store_evaluation($pair){
    // Sanatize for SQL and convert to proper datatype
    // string to int
    $formData["informativeLeft"] = intval($this->mysqli->real_escape_string($this->POST["formInformativeLeft"]));
    $formData["entertainingLeft"] = intval($this->mysqli->real_escape_string($this->POST["formEntertainingLeft"]));
    $formData["interestingLeft"] = intval($this->mysqli->real_escape_string($this->POST["formInterestingLeft"]));
    $formData["informativeRight"] = intval($this->mysqli->real_escape_string($this->POST["formInformativeRight"]));
    $formData["entertainingRight"] = intval($this->mysqli->real_escape_string($this->POST["formEntertainingRight"]));
    $formData["interestingRight"] = intval($this->mysqli->real_escape_string($this->POST["formInterestingRight"]));
    $formData["preference"] = intval($this->mysqli->real_escape_string($this->POST["formPreference"]));

    // strings
    $formData["positioning"] = $this->mysqli->real_escape_string($this->POST["formPositioning"]);
    $formData["why"] = $this->mysqli->real_escape_string(nl2br(strip_tags($this->POST["formWhy"])));
    
    $insertQuery = "INSERT INTO Evaluations (`created`,`pair`,`positioning`,`informativeLeft`,`entertainingLeft`,`interestingLeft`,`informativeRight`,`entertainingRight`,`interestingRight`,`preference`,`why`)
              VALUES
              (
              NOW(), '".
              $pair."', '".
              $formData['positioning']."', '".
              $formData['informativeLeft']."', '".
              $formData['entertainingLeft']."', '". 
              $formData['interestingLeft']."', '".
              $formData['informativeRight']."', '".
              $formData['entertainingRight']."', '".
              $formData['interestingRight']."', '".
              $formData['preference']."', '". 
              $formData['why']."'
              );";
    $this->mysqli->query($insertQuery) or die($this->mysqli->error.__LINE__);
    return $this->mysqli->insert_id;
  }
  
  public function store_personId($personId, $evaluationId){
    $updateQuery = "UPDATE `Evaluations`
                    SET `person` = $personId
                    WHERE `eId` = $evaluationId;";
    $this->mysqli->query($updateQuery) or die($this->mysqli->error.__LINE__);
  }
} // EvaluationHandler Class
?>