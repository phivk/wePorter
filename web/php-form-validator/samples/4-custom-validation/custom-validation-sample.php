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
require_once "formvalidator.php";
$show_form=true;

class MyValidator extends CustomValidator
{
	function DoValidate(&$formars,&$error_hash)
	{
        if(stristr($formars['Comments'],'http://'))
        {
            $error_hash['Comments']="No URLs allowed in comments";
            return false;
        }
		return true;
	}
}

if(isset($_POST['Submit']))
{
    $validator = new FormValidator();
    $validator->addValidation("Name","req","Please fill in Name");
    $validator->addValidation("Email","email","The input for Email should be a valid email value");
    $validator->addValidation("Email","req","Please fill in Email");
    $custom_validator = new MyValidator();
    $validator->AddCustomValidator($custom_validator);

    if($validator->ValidateForm())
    {
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
    }
}

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