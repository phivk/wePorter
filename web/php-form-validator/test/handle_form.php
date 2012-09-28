<?PHP
require_once("./include/formvalidator.php");

if(isset($_POST['Submit']))
{
    $validator = new FormValidator();
    $validator->addValidation("Name","req","Please fill in Name");
    $validator->addValidation("Email","email",
"Please fill in a valid email address");
    $validator->addValidation("Email","req","Please fill in Email");
    $validator->addValidation("Age","req","Please fill in your Age");
    $validator->addValidation("Age","num","Please use a number for Age");
    
    
    if($validator->ValidateForm())
    {
        echo "<h2>Validation Success!</h2>";
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $age = $_POST['Age'];
        print "name: $name<br>";
        print "email: $email<br>";
        print "age: $age<br>";
        
    }
    else
    {
        echo "<B>Validation Errors:</B>";
        $error_hash = $validator->GetErrors();
        foreach($error_hash as $inpname => $inp_err)
        {
          echo "<p>$inpname : $inp_err</p>\n";
        }
    }
}

?>