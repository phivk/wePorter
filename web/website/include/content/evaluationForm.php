<!-- include JS validator -->
<script language="JavaScript" src="./include/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>

<?php require_once('./include/content/evaluationQuestions.php'); ?>

<!-- FORM -->
<div class="row">
  <div class="twelve columns">
    <form name="evaluationForm" id="evaluationForm" action="handle_form.php" method="post">

      <div class="row">
        <div class="twelve columns">
          <div id="questionForm_errorloc" class="error_strings"></div>
          <h4>About you</h4>
          <div class="row">
            <div class="ten columns">
              <label>Name:</label>
              <input autofocus type="text" name="formName" maxlength="50" class="" placeholder="Name"/>
            </div>
            <div class="two columns">
              <label>Age:</label>
              <input type="text" name="formAge" maxlength="50" class="" placeholder="Age"/>
            </div> <!-- two columns -->
          </div> <!-- row -->

          <label>Email:</label>
          <input type="email" name="formEmail" maxlength="50" class="twelve" placeholder="name@example.com"/>


        </div> <!-- twelve columns -->
      </div> <!-- row -->
      
      <hr/>
      <h4>Video Pair1</h4>
      <?php getSeqPairHtml(1); ?>
      
      <hr/>
      <h4>Video Pair2</h4>
      <?php getSeqPairHtml(2); ?>
      
      <hr/>
      <h4>Video Pair3</h4>
      <div class="row"> 
        <div class="twelve columns">
    
          <div class="row">
            <!-- left -->
            <div class="six columns">
        
              <!-- parallel player left -->
              <div id="interactionWrapper" class="panel" onload="resetCount()">
                <div class="sequenceWrapper">
                  <div id='playerWrapper1' class='playerWrapper'>
                    <div class="focusBlock"></div>
                    <div id="sequencePlayer1" class="videoBox"></div>
                  </div>
                  <div class="data-wrapper">
                  </div>
                </div>
                <div class="sequenceWrapper">
                  <div id='playerWrapper2' class='playerWrapper'>
                    <div class="focusBlock"></div>
                    <div id="sequencePlayer2" class="videoBox"></div>
                  </div>
                  <div class="data-wrapper">
                  </div>
                </div>
              </div> <!-- interaction wrapper -->

              <p>
                <label for="formInformative3left">How <strong>informative</strong> did you find this video? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative.</label>
                <select name="formInformative3left" id="formInformative3left">
                  <option value="000" disabled selected style='display:none'>Please Choose</option>
                  <option value="1"> 1 </option>
                  <option value="2"> 2 </option>
                  <option value="3"> 3 </option>
                  <option value="4"> 4 </option>
                  <option value="5"> 5 </option>
                  <option value="0"> I don't know </option>
                </select>  
              </p>

              <p>
                <label for="formEntertaining3left">How <strong>entertaining</strong> did you find this video? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining.</label>
                <select name="formEntertaining3left" id="formEntertaining3left">
                  <option value="000" disabled selected style='display:none'>Please Choose</option>
                  <option value="1"> 1 </option>
                  <option value="2"> 2 </option>
                  <option value="3"> 3 </option>
                  <option value="4"> 4 </option>
                  <option value="5"> 5 </option>
                  <option value="0"> I don't know </option>
                </select>  
              </p>
              
              <p>
                <label for="formInteresting3left">How <strong>interesting</strong> did you find this video? Ranging from 1 being very uninteresting, 3 being neutral, 5 being very interesting.</label>
                <select name="formInteresting3left" id="formInteresting3left">
                  <option value="000" disabled selected style='display:none'>Please Choose</option>
                  <option value="1"> 1 </option>
                  <option value="2"> 2 </option>
                  <option value="3"> 3 </option>
                  <option value="4"> 4 </option>
                  <option value="5"> 5 </option>
                  <option value="0"> I don't know </option>
                </select>  
              </p>
            </div> <!-- six cols left-->
      
            <!-- right -->
            <div class="six columns">
        
              <!-- parallel player left -->
              <div id="interactionWrapper" class="panel" onload="resetCount()">
                <div class="sequenceWrapper">
                  <div id='playerWrapper1' class='playerWrapper'>
                    <div class="focusBlock"></div>
                    <div id="sequencePlayer1" class="videoBox"></div>
                  </div>
                  <div class="data-wrapper">
                  </div>
                </div>
                <div class="sequenceWrapper">
                  <div id='playerWrapper2' class='playerWrapper'>
                    <div class="focusBlock"></div>
                    <div id="sequencePlayer2" class="videoBox"></div>
                  </div>
                  <div class="data-wrapper">
                  </div>
                </div>
              </div> <!-- interaction wrapper -->
        
              <p>
                <label for="formInformative3right">How <strong>informative</strong> did you find this video? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative</label>
                <select name="formInformative3right" id="formInformative3right">
                  <option value="000" disabled selected style='display:none'>Please Choose</option>
                  <option value="1"> 1 </option>
                  <option value="2"> 2 </option>
                  <option value="3"> 3 </option>
                  <option value="4"> 4 </option>
                  <option value="5"> 5 </option>
                  <option value="0"> I don't know </option>
                </select>  
              </p>

              <p>
                <label for="formEntertaining3right">How <strong>entertaining</strong> did you find this video? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining</label>
                <select name="formEntertaining3right" id="formEntertaining3right">
                  <option value="000" disabled selected style='display:none'>Please Choose</option>
                  <option value="1"> 1 </option>
                  <option value="2"> 2 </option>
                  <option value="3"> 3 </option>
                  <option value="4"> 4 </option>
                  <option value="5"> 5 </option>
                  <option value="0"> I don't know </option>
                </select>  
              </p>
              
              <p>
                <label for="formInteresting3right">How <strong>interesting</strong> did you find this video? Ranging from 1 being very uninteresting, 3 being neutral, 5 being very interesting</label>
                <select name="formInteresting3right" id="formInteresting3right">
                  <option value="000" disabled selected style='display:none'>Please Choose</option>
                  <option value="1"> 1 </option>
                  <option value="2"> 2 </option>
                  <option value="3"> 3 </option>
                  <option value="4"> 4 </option>
                  <option value="5"> 5 </option>
                  <option value="0"> I don't know </option>
                </select>  
              </p>
            </div> <!-- six cols right -->
          </div> <!-- pair3 video row -->
    
          <!-- preference -->
          <div class="row">
            <div class="twelve columns" style="text-align: center">
              <label>Which of the two videos above has your <strong>preference</strong>?</label>
              <div class="row"> <!-- radio row -->
                <div class="six columns" style="text-align: center">
                  <label for="radio3">
                      <input name="radio3" type="radio" id="radio3Left"> Left
                  </label>
                </div> <!-- six cols radioLeft -->

                <div class="six columns" style="text-align: center">
                  <label for="radio3">
                      <input name="radio3" type="radio" id="radio3Right"> Right
                  </label>
                </div> <!-- six cols radioRight -->
              </div> <!-- radio row -->
            </div> <!-- twelve col preference -->         
          </div> <!-- preference -->
    
        </div> <!-- twelve cols pair3 -->
      </div> <!-- Pair3 -->

      <hr/>
      <h4>Video Pair4</h4>
      <?php getSeqPairHtml(4); ?>
      <hr/>
      <h4>Video Pair5</h4>
      <?php getSeqPairHtml(5); ?>
      <hr/>
      <h4>Video Pair6</h4>
      <?php getSeqPairHtml(6); ?>
      
      <hr/>
      <h4>Video Pair7</h4>
      <?php getSeqPairHtml(7); ?>
      <hr/>
      <h4>Video Pair8</h4>
      <?php getSeqPairHtml(8); ?>
      <hr/>
      <h4>Video Pair9</h4>
      <?php getSeqPairHtml(9); ?>

      <hr/>
      <p>
       <label>Any General comments?</label>
       <textarea name="formComments" rows="3" cols="25"></textarea>
      </p>

      <?php
        // Dont show reCaptcha for now in modal
        // require_once('./include/recaptcha/recaptchalib.php');
        // $publickey = "6LeludUSAAAAAErth0bVH4C5swQ4ILxWaYzBRNHA";
        // echo recaptcha_get_html($publickey);
      ?>

     <div id="evaluationForm_errorloc" class="error_strings">
     </div>

     <input type="submit" name= "submit" value="Submit Feedback" class="medium success button">
     
     

    </form>
  </div> <!-- twelve columns -->
</div> <!-- row -->



<!-- Client side form validation -->
<script language="JavaScript" type="text/javascript" xml:space="preserve">
  var frmvalidator  = new Validator("evaluationForm");
  frmvalidator.EnableOnPageErrorDisplaySingleBox();
  frmvalidator.EnableMsgsTogether();

  frmvalidator.addValidation("formName","req","Please fill in your Name");
  frmvalidator.addValidation("formName","maxlen=50", "Please use 50 characters or less");

  frmvalidator.addValidation("formAge","req","Please enter your Age");
  frmvalidator.addValidation("formAge","num","Please use a number for Age");

  frmvalidator.addValidation("formEmail","req", "Please fill in your Email");
  frmvalidator.addValidation("formEmail","email");

  frmvalidator.addValidation("formInformative1left","dontselect=000","Please choose an option");
  frmvalidator.addValidation("formEntertaining1left","dontselect=000","Please choose an option");
  frmvalidator.addValidation("formInformative1right","dontselect=000","Please choose an option");
  frmvalidator.addValidation("formEntertaining1right","dontselect=000","Please choose an option");
  frmvalidator.addValidation("radio1","selectradio","Please select your preference for Video Pair1");

  frmvalidator.addValidation("formInformative2left","dontselect=000","Please choose an option");
  frmvalidator.addValidation("formEntertaining2left","dontselect=000","Please choose an option");
  frmvalidator.addValidation("formInformative2right","dontselect=000","Please choose an option");
  frmvalidator.addValidation("formEntertaining2right","dontselect=000","Please choose an option");
  frmvalidator.addValidation("radio2","selectradio","Please select your preference for Video Pair2");

  frmvalidator.addValidation("formInformative3left","dontselect=000","Please choose an option");
  frmvalidator.addValidation("formEntertaining3left","dontselect=000","Please choose an option");
  frmvalidator.addValidation("formInformative3right","dontselect=000","Please choose an option");
  frmvalidator.addValidation("formEntertaining3right","dontselect=000","Please choose an option");
  frmvalidator.addValidation("radio3","selectradio","Please select your preference for Video Pair3");

  frmvalidator.addValidation("formComments","maxlen=500", "Please use 500 characters or less");

</script>