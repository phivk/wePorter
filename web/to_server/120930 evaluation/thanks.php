<!DOCTYPE html>
<html lang="en">
  <head>
		<title>Thank you</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<meta name="generator" content="TextMate http://macromates.com/">
  	<meta name="author" content="Philo van Kemenade">
  	
		<!-- include css -->
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		
		<link rel="stylesheet" href="css/foundation-3.0.7/stylesheets/foundation.css">
	  <link rel="stylesheet" href="css/foundation-3.0.7/stylesheets/app.css">

	  <script src="css/foundation-3.0.7/javascripts/modernizr.foundation.js"></script>

		<!-- include popcorn.js -->
		<script src="./js/popcorn-complete_1.3.js"></script>
		<!-- include jQuery -->
		<script src="./js/jquery-1.7.2.js"></script>

  </head>
  <body>
    <!-- run JS on load -->
    <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function () {
        // style p tags in alert-box
        $(".alert-box").children("p").css("font-weight", "bold");
        $(".alert-box a").css("color", "white");
        $(".alert-box").find("a").hover(
          function () {
            $(this).css("text-decoration","underline");
          }, 
          function () {
            $(this).css("text-decoration","none");
          });
        $(document).foundationCustomForms();
      });
    </script>
    
	  <div class="row">
	    <div class="twelve columns">
	      <!-- Header -->
	      <div id="header" class="shadow">
   		    <div id="nav">
   				  <ul>
              <li><a href="weporter.php">Home</a></li>
     				</ul>
   			  </div>
   		  </div>
	    </div>
	  </div>  

    <!-- Main Content-->
		<div class="row">
	    <div class="twelve columns">
					<h1>Thanks</h1> 
					<hr/>
					<div class="alert-box success">
            <h3>Thank you for participating!</h3>
            <p>You would help me even more by sharing <a href="http://tinyurl.com/weporter">tinyurl.com/weporter</a> with some more friendly people!</p>
            <a href="" class="close">&times;</a>
          </div>					
	    </div> <!-- end of 12 colums -->
	  </div> <!-- end of row -->
		
		<div class="row">
		  <div class="twelve columns">
		    <div id="footer">
    			<ul>
    				<li> </li>
    			</ul>
    		</div>
		  </div>
		</div>
      	
		<!-- Included JS Files (Compressed) -->
	  <script src="css/foundation-3.0.7/javascripts/foundation.js"></script>
    <!-- Initialize JS Plugins -->
	  <script src="css/foundation-3.0.7/javascripts/app.js"></script>
  </body>
</html>
