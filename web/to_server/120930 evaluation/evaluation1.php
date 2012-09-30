<?php
  // DEBUG
  $debug = false;
  
  // start or resume session to store data for recurring visitors
  session_start(); 
  if (isset($_SESSION['views'])) {
    // recurring visitor
    $_SESSION['views']=$_SESSION['views']+1;
  }
  else {
    // new visitor
    $_SESSION['views']=1;
  }
  $_SESSION['experiment']="evaluation";
?>
<?php require_once('./include/content/evaluationQuestions.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
		<title>Evaluation</title>
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

		<!-- include custom scripts -->    
    <script type="text/javascript" src="./js/parallelPlayerClass.js"></script>
    <script type="text/javascript" src="./js/helpers.js"></script>
    <script type="text/javascript" src="./js/emitInteraction.js"></script>
    <script type="text/javascript" src="./js/evaluation.js"></script>
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
            // $(this).css("color","white");
          }, 
          function () {
            $(this).css("text-decoration","none");
            // $(this).css("color","white");
          });
        $(document).foundationCustomForms();
      });
      // *number
      positioning = loadParallelPair();
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
					<h1>Evaluation</h1> 
					<hr/>
					<div class="alert-box">
            <h3>Instructions</h3>
            <p>(This website runs best in recent versions of <a href="http://chrome.com">Chrome</a> and <a href="http://firefox.com">Firefox</a>)</p>
            <p>In this experiment you will watch videos in pairs, one after the other. All videos are user-generated videos recorded at Queen Elizabeth's diamond jubilee celebration in London this summer.</p>
            <p>Videos are randomly positioned left and right. You will be asked to score the videos depending on how informative (about the jubilee event), entertaining and interesting you think they are. You will also be asked which of the two videos has your preference: which of the two would you rather watch?</p>
            <p>Hit 'Play' to start a video. The videos are made up from different clips that are part of larger video. You only evaluate the part you see. Hit 'Play' only once.</p>
            <p>Please watch the videos in pairs, first left, then right. Next, answer the questions relating to that pair of videos, before moving on the the next pair.</p>
            <p>There are 9 pairs of videos. Videos in the first 3 pairs last 1 minute each, videos in the latter 6 pairs last 10 seconds each. Total play time is 8 minutes. You can take breaks in between pairs.</p>
            <p>Hit 'Continue' to proceed to the next videos.</p>
            <p>If one of the videos doens't load, please reload the page.</p>
            <p><strong>Thank you for participating!</strong></p>
            <a href="" class="close">&times;</a>
          </div>
				  
				  <?php
            require("./include/content/evaluationForm1.php"); // number
            getInsertPositioningScriptHtml(1);
          ?>
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
