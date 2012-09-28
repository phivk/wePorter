<?php
  if($_POST['formSubmit'] == "Submit")
  {
    $varMovie = $_POST['formMovie'];
    $varName = $_POST['formName'];
  }
?>
<form action="myform.php" method="post">
    Which is your favorite movie?
    <input type="text" name="formMovie" maxlength="50" value="<?=$varMovie;?>">
    What is your name?
    <input type="text" name="formName" maxlength="50" value="<?=$varName;?>">
    <input type="submit" name="formSubmit" value="Submit">
</form>
