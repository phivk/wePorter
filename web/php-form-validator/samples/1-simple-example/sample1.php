<html>
   <head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
      <title>
Form Page: test
      </title>
      <Style>
        BODY, P,TD{ font-family: Arial,Verdana,Helvetica, sans-serif; font-size: 10pt }
        A{font-family: Arial,Verdana,Helvetica, sans-serif;}
        B {	font-family : Arial, Helvetica, sans-serif;	font-size : 12px;	font-weight : bold;}
        </Style>
      </script>
   </head>
<body>
<h2>Registratin Form</h2>

<?PHP
//include the main validation script
require_once "formvalidator.php";

$show_form=true;

if(isset($_POST['Submit']))
{// The form is submitted

    //Setup Validations
    $validator = new FormValidator();
    $validator->addValidation("Name","req","Please fill in Name");
    $validator->addValidation("Email","email","The input for Email should be a valid email value");
    $validator->addValidation("Email","req","Please fill in Email");
    //Now, validate the form
    if($validator->ValidateForm())
    {
        //Validation success. 
        //Here we can proceed with processing the form 
        //(like sending email, saving to Database etc)
        // In this example, we just display a message
        echo "<h2>Validation Success!</h2>";
        $show_form=false;
    }
    else
    {
        echo "<B>Validation Errors:</B>";

        $error_hash = $validator->GetErrors();
        foreach($error_hash as $inpname => $inp_err)
        {
            echo "<p>$inpname : $inp_err</p>\n";
        }        
    }//else
}//if(isset($_POST['Submit']))

if(true == $show_form)
{
?>

<form name='test' method='POST' action='' accept-charset='UTF-8'>
<table cellspacing='0' cellpadding='10' border='0' bordercolor='#000000'>
   <tr>
      <td>
         <table cellspacing='2' cellpadding='2' border='0'>
            <tr>
               <td align='right' class='normal_field'>Name</td>
               <td class='element_label'>
                  <input type='text' name='Name' size='20'>
               </td>
            </tr>
            <tr>
               <td align='right' class='normal_field'>Email</td>
               <td class='element_label'>
                  <input type='text' name='Email' size='20'>
               </td>
            </tr>
            <tr>
               <td align='right' class='normal_field'>Address</td>
               <td class='element_label'>
                  <input type='text' name='Address' size='20'>
               </td>
            </tr>
            <tr>
               <td align='right' class='normal_field'>City</td>
               <td class='element_label'>
                  <input type='text' name='City' size='20'>
               </td>
            </tr>
            <tr>
               <td colspan='2' align='left' valign='bottom' class='normal_field'>Comments</td>
            </tr>
            <tr>
               <td>
               </td>
               <td class='element_label'>
<textarea name='Comments' cols='50' rows='8'></textarea>
               </td>
            </tr>
            <tr>
               <td colspan='2' align='center'>
                  <input type='submit' name='Submit' value='Submit'>
               </td>
            </tr>
         </table>
      </td>
   </tr>
</table>
</form>
<?PHP
}//true == $show_form
?>
</body>
<html>