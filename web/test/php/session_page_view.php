<?php
session_start();

if(isset($_SESSION['views']))
$_SESSION['views']=$_SESSION['views']+1;
else
$_SESSION['views']=1;
echo "Views=". $_SESSION['views'];
?>

<html>
<body>

<?php
//retrieve session data
echo " Pageviews=". $_SESSION['views'];
echo " Session_id= ".session_id();
?>

</body>
</html>