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
    $_SESSION['stage']=1;
  }
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
    
	  <div class="row">
	    <div class="twelve columns">
	      <!-- Header -->
	      <div id="header" class="shadow">
   		    <div id="nav">
   				  <ul>
              <li><a href="wePorter.php">Home</a></li>
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
					
					<dl class="tabs contained">
			      <dd class="active"><a href="#welcome">Welcome</a></dd>
			      <dd><a href="#simple2">About</a></dd>
			      <dd><a href="#simple3">Get in touch</a></dd>
			    </dl>

 			    <ul class="tabs-content contained">
			      <li class="active" id="welcomeTab">Welcome to <strong>wePorter</strong>, a research project on <a href="http://en.wikipedia.org/wiki/Human_computation">Human Computation</a> in online video storytelling. Please read the instruction below before you begin.</li>
			      <li id="simple2Tab"><strong>wePorter</strong> is developed by <a href="http://fromTIMEtoTI.ME">Philo van Kemenade</a> as his dissertation project of the MSc Cognitive Computing at <a href="http://www.gold.ac.uk/">Goldsmiths College</a> London</li>
			      <li id="simple3Tab">Tried the interactive bit? Thank you! Mail to philo<a href="http://www.google.com/recaptcha/mailhide/d?k=01x16h9Bc5IJY2hRywN4BicA==&amp;c=4tS0NyTf_wYeMtbjqgxr74s0VOe8J5jluitqsmBpkIo=" onclick="window.open('http://www.google.com/recaptcha/mailhide/d?k\07501x16h9Bc5IJY2hRywN4BicA\75\75\46c\0754tS0NyTf_wYeMtbjqgxr74s0VOe8J5jluitqsmBpkIo\075', '', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300'); return false;" title="Reveal this e-mail address">...</a>@gmail.com to ask anything about this project.</li>
			    </ul>
					
					<hr />
					
					<div class="alert-box">
            <h4>Instructions</h4>In this first experiment, you will be presented with two videos in parallel. This interaction takes 60 seconds.<br>
            Two videos are presented at once, but you can only 'focus' on one, making the video audible and clearly visible. Focus on a video by moving your mouse over it. The unfocussed video is still dimly visible, allowing you to look what's going on there. You are free in your decision on which video to focus at what time.<br>
            The presented videos are recorded at the celebration of the Queen Elizabeth II Diamond jubilee in May in London.<br>
            To start the videos, hit PLAY. There will be no option to pause.
            <a href="" class="close">&times;</a>
          </div>

          <?php
            require_once('./php/sequenceLoader.php');

            // // stage 1: positional bias test
            // if ($_SESSION['stage'] == 1) {
            //   $posBiasHtml = $sl->getPosBiasHtml();
            //   echo $posBiasHtml;
            //   
            // }
            // else if ($_SESSION['stage'] == 2) {
            //   $posBiasHtml = $sl->getPosBiasHtml();
            //   echo $posBiasHtml;
            //   
            // }
            
            
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
            
            $vpIdsStr = array2stringList($vpIds);
            $jsCallStr = '<script type="text/javascript">
               testLoad("'.$vpIdsStr.'");
             </script>';
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
						
            <!-- <img id="loaderImg" 
              style="position: absolute;
              top: 47%;
              left: 180px;"     
              src="./content/gif/loading.gif" 
            /> -->

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
      <h2>Welcom!</h2>
      <p class="lead">This website lets you try a new way of watching videos online and contribute to research project too!
      </p>
      <p>Two videos are presented at once, but you can only 'focus' on one, making the video audible and clearly visible. The two videos sequences are automatically mixed together from parts of different videos. While you are watching, you're submitting data that helps to improve the mix!
        Please read the instructions before you start. Have fun!</p>
      <a class="close-reveal-modal">&#215;</a>
      
      <form name="thanksForm" id="thanksForm" action="handle_form.php" method="post">
       <input type="submit" name= "storeQiD" value="Play More >>" class="medium success button">
      </form>
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
    
      <p>Did you know that every time you complete a sequence, you're submitting data that helps the story to improve? Would you like to try again? That would really help me (and the story)!</p>
      <a class="close-reveal-modal">&#215;</a>
      
      <form name="thanksForm" id="thanksForm" action="handle_form.php" method="post">
       <input type="submit" name= "storeQiD" value="Play More >>" class="medium success button">
      </form>
    </div>  
	
		<!-- Included JS Files (Compressed) -->
	  <script src="css/foundation-3.0.7/javascripts/foundation.js"></script>
    <!-- Initialize JS Plugins -->
	  <script src="css/foundation-3.0.7/javascripts/app.js"></script>
  </body>
</html>