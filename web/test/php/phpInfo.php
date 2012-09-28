<!doctype html>
<html>
  <head>
		<title>test</title>
	
  </head>
  <body>
    <pre>
      <?php  
      $current_temperature = 37; // Current South Pole temperature
      // Then the if statement will evaluate it for us
      if ($current_temperature > 32) { 
          // Set things to melt if the temp is exceeding 32(freezing)
          echo "Doom! The icecaps will melt, sea levels will rise.";  
      } 
      // If the temp is still freezing(32), nothing at all will happen in this script
      ?>
    </pre>
	  
  </body>
</html>