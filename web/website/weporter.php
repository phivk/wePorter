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
  $_SESSION['experiment']="weporter";
?>

<!doctype html>
<html>
  <head>
		<title>wePorter Dissertation Project</title>
		
		<!-- include css -->
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		
		<link rel="stylesheet" href="css/foundation-3.0.7/stylesheets/foundation.css">
	  <link rel="stylesheet" href="css/foundation-3.0.7/stylesheets/app.css">

	  <script src="css/foundation-3.0.7/javascripts/modernizr.foundation.js"></script>

		<!-- include popcorn.js -->
    <!-- <script src="js/popcorn-complete.js"></script> -->
		<script src="./js/popcorn-complete_1.3.js"></script>
		

		<!-- include jQuery -->
		<script src="./js/jquery-1.7.2.js"></script>

		<!-- include custom scripts -->    
    <script type="text/javascript" src="./js/parallelPlayerClass.js"></script>
    <script type="text/javascript" src="./js/helpers.js"></script>
    <script type="text/javascript" src="./js/emitInteraction.js"></script>
  </head>
  <body>
    <!-- run JS on load -->
    <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function () {
        // style p tags in alert-box
        $(".alert-box").children("p").css("font-weight", "bold");
        $(".alert-box").find("a").hover(
          function () {
            $(this).css("text-decoration","underline");
          }, 
          function () {
            $(this).css("text-decoration","none");
          });
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
        <!-- 10 colums left side -->
        <!-- offset-by-one -->
        <div class="ten columns"> 
					<h1>wePorter</h1> 
					
					<?php require_once("./include/content/tabs.php") ?>
					
					<hr />
					
					<div class="alert-box">
					  <h4>Instructions</h4>
					  <p >In this first experiment, you will be presented with two videos in parallel. This interaction takes 60 seconds.</p>
            <p>Two videos are presented at once, but you can only 'focus' on one, making the video audible and clearly visible. Focus on a video by moving your mouse over it. The unfocussed video is still dimly visible, allowing you to look what's going on there. You are free to move your mouse over any of the two videos at any time.</p>
            <p>The presented videos are recorded at the celebration of the Queen Elizabeth II Diamond jubilee in May in London.</p>
            <p>You can try this experiment as many times as you like.</p>
            <p>Once the two videos have loaded, hit PLAY to start the videos. (Please reload the page if one of them doesn't load). There will be no option to pause.</p>
            <a href="" class="close">&times;</a>
          </div>

          <?php
            require_once('./php/sequenceLoader.php');
            
            $sl = new sequenceLoader();
            $sl->loadSequences();
            $seqs = $sl->getSequences();
            $vpIds = $sl->getVpIds();
            $html = $sl->getHtmlFromSeqs($seqs);
            // $htmlSetRecurring = $sl->getHtmlRecurring($_SESSION['views'] > 1);
            
            if ($debug) {
              echo "<br>", "seq1 array: ", "<br>";
              print_r($seqs[0]);
              echo "<br>";
              echo "seq2 array: ", "<br>";
              print_r($seqs[1]);
              echo "<br>";
              echo "returned html: ", "<br>", htmlentities($html);
            }
            
            // echo html w JS call to load Popcorn sequences
            echo $html;
            // echo $htmlSetRecurring;
            
            // $vpIdsStr = array2stringList($vpIds);
            // $jsCallStr = '<script type="text/javascript">
            //    testLoad("'.$vpIdsStr.'");
            //  </script>';
            // echo $jsCallStr;          
          ?>
				  
				  
					<div id="interactionWrapper" class="panel" onload="resetCount()">

						<!-- Video Player playing sequece -->
						<div class="sequenceWrapper">
							<div id='playerWrapper1' class='playerWrapper'>
								<div class="focusBlock"></div>
								<div id="sequencePlayer1" class="videoBox"></div>
							</div>
							<div class="data-wrapper">
                <!-- <input id="sequencePlayer1Counter" class="counter" value="0"/> -->
							</div>
						</div>

						<div class="sequenceWrapper">
							<div id='playerWrapper2' class='playerWrapper'>
								<div class="focusBlock"></div>
								<div id="sequencePlayer2" class="videoBox"></div>
							</div>
							<div class="data-wrapper">
								<!-- <input id="sequencePlayer2Counter" class="counter" value="0"/> -->
							</div>
						</div>

            <!-- <p><a 
              name = "playButton" 
              id = "playButton" 
              class="button">
              Play >></a></p> -->
					</div>  <!-- interaction wrapper  -->
				</div> <!-- end of 10 colums -->
			
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
	  
	  <div id="welcomeModal" class="reveal-modal">
      <h2>Welcome!</h2>
      <p class="lead">This website lets you try a new way of watching videos online and at the same time contribute to a research project!
      </p>
      <p>Two videos are presented at once, but you can only 'focus' on one, making the video audible and clearly visible. The two videos sequences are automatically mixed together from parts of different videos. While you are watching, you're submitting data that helps to improve the mix!</p>
      <p>You can try this experiment as many times as you like.</p>
      <p>Please read the instructions before you start. <strong>Have fun!</strong></p>
      <a class="close-reveal-modal">&#215;</a>
    </div>
	  
		<div id="questionnaireModal" class="reveal-modal">
      <h2>Thank you!</h2>
      <p class="lead">You've just watched a sequence of video clips and helped a research project!</p>
      
      <!-- Include Questionnaire Form -->
      <?php
        require("./include/content/questionnaireForm.php");
      ?>
    
      <p>Did you know that every time you complete a sequence, you're submitting data that helps the story to improve? Would you like to try again? That would really help me (and the story)...</p>
      
      <a class="close-reveal-modal">&#215;</a>
      <!-- TODO submit form -->
      <!-- <p><a 
        href="weporter.html"
        class="button">
        Play more</a></p> -->
    </div>
    
    <div id="thanksModal" class="reveal-modal">
      <h2>Thank you!</h2>
      <p class="lead">You've just watched a sequence of video clips and helped a research project!</p>
      <p>Please continue to experiment 2 if you haven`t already.</p>
      <p><a 
        href="./posbias1.php"
        class="medium success button">
        Experiment 2</a></p>
      <p>Did you know that every time you complete an interaction in this first experiment, you're submitting data that helps the story improve? Would you like to try again? That would really help me (and the story)!</p>
      <a class="close-reveal-modal">&#215;</a>
      <p><a 
        href="./weporter.php"
        class="button">
        Play more >></a></p>      
    </div>  
	
		<!-- Included JS Files (Compressed) -->
	  <script src="css/foundation-3.0.7/javascripts/foundation.js"></script>
    <!-- Initialize JS Plugins -->
	  <script src="css/foundation-3.0.7/javascripts/app.js"></script>
  </body>
</html>