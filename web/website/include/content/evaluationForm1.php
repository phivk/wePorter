<!-- include JS validator -->
<script language="JavaScript" src="./include/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>
<!-- FORM -->
<div class="row">
  <div class="twelve columns">
    <form name="evaluationForm1" id="evaluationForm1" action="handle_evaluationForms.php" method="post">

      <div class="row">
        <div class="twelve columns">
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
      <div class="row panel"> 
        <div class="twelve columns">
    
          <div class="row">
            <!-- left -->
            <div class="six columns">
        
              <!-- parallel player left -->
              <div id="interactionWrapperLeft" class="panel" onload="resetCount()">
                <div class="sequenceWrapper">
                  <div id='playerWrapper1Left' class='playerWrapper'>
                    <div class="focusBlock"></div>
                    <div id="sequencePlayer1Left" class="videoBox"></div>
                  </div>
                  <div class="data-wrapper">
                  </div>
                </div>
                <div class="sequenceWrapper">
                  <div id='playerWrapper2Left' class='playerWrapper'>
                    <div class="focusBlock"></div>
                    <div id="sequencePlayer2Left" class="videoBox"></div>
                  </div>
                  <div class="data-wrapper">
                  </div>
                </div>
              </div> <!-- interaction wrapper -->

              <p>
                <label for="formInformativeLeft">How <strong>informative</strong> did you find this video? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative.</label>
                <select name="formInformativeLeft" id="formInformativeLeft">
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
                <label for="formEntertainingLeft">How <strong>entertaining</strong> did you find this video? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining.</label>
                <select name="formEntertainingLeft" id="formEntertainingLeft">
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
                <label for="formInterestingLeft">How <strong>interesting</strong> did you find this video? Ranging from 1 being very uninteresting, 3 being neutral, 5 being very interesting.</label>
                <select name="formInterestingLeft" id="formInterestingLeft">
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
              <div id="interactionWrapperRight" class="panel" onload="resetCount()">
                <div class="sequenceWrapper">
                  <div id='playerWrapper1Right' class='playerWrapper'>
                    <div class="focusBlock"></div>
                    <div id="sequencePlayer1Right" class="videoBox"></div>
                  </div>
                  <div class="data-wrapper">
                  </div>
                </div>
                <div class="sequenceWrapper">
                  <div id='playerWrapper2Right' class='playerWrapper'>
                    <div class="focusBlock"></div>
                    <div id="sequencePlayer2Right" class="videoBox"></div>
                  </div>
                  <div class="data-wrapper">
                  </div>
                </div>
              </div> <!-- interaction wrapper -->
        
              <p>
                <label for="formInformativeRight">How <strong>informative</strong> did you find this video? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative</label>
                <select name="formInformativeRight" id="formInformativeRight">
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
                <label for="formEntertainingRight">How <strong>entertaining</strong> did you find this video? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining</label>
                <select name="formEntertainingRight" id="formEntertainingRight">
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
                <label for="formInterestingRight">How <strong>interesting</strong> did you find this video? Ranging from 1 being very uninteresting, 3 being neutral, 5 being very interesting</label>
                <select name="formInterestingRight" id="formInterestingRight">
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
          </div> <!-- pairParallel video row -->
          
          <!-- preference -->
          <div class="row">
            <div class="twelve columns" style="text-align: center">
              <!-- <label>Which of the two videos above has your <strong>preference</strong>?</label> -->
              <div class="row"> <!-- radio row -->
                
                <!-- <div class="four columns" style="text-align: center">
                  <label for="radioPreference">
                      <input type='radio' name='radioPreference' value='Left'> Left
                  </label>
                </div>

                <div class="four columns" style="text-align: center">
                  <label for="radioPreference">
                      <input type='radio' name='radioPreference' value='None'> None
                  </label>
                </div>

                <div class="four columns" style="text-aligngn: center">
                  <label for="radioPreference">
                      <input type='radio' name='radioPreference' value='Right'> Right
                  </label>
                </div> -->
                <p>
                  <label for="formPreference">Which of the two videos above has your <strong>preference</strong>?</label>
                  <select name="formPreference" id="formPreference">
                    <option value="000" disabled selected style='display:none'>Please Choose</option>
                    <option value="1"> Left </option>
                    <option value="2"> Right </option>
                    <option value="3"> None </option>
                  </select>  
                </p>
                <!--
                <input type = "radio" name ="formPreference" id="r1" value= "1" /><label for="r1">Left</label>
                <input type = "radio" name ="formPreference" id="r2" value= "2" /><label for="r1">Right</label>
                <input type = "radio" name ="formPreference" id="r3" value= "3" /><label for="r1">None</label>
                 -->
                <p>
                 <label><strong>Why?</strong> (Optional)</label>
                 <textarea name="formWhy" rows="1" cols="25"></textarea>
                </p>
                
                <input type="submit" name= "evaluation1" value="Continue >>" class="medium success button">    

              </div> <!-- radio row -->
            </div> <!-- twelve col preference -->         
          </div> <!-- preference -->
    
        </div> <!-- twelve cols pairParallel -->
      </div> <!-- PairParallel -->

      <?php
        // Dont show reCaptcha for now
        // require_once('./include/recaptcha/recaptchalib.php');
        // $publickey = "6LeludUSAAAAAErth0bVH4C5swQ4ILxWaYzBRNHA";
        // echo recaptcha_get_html($publickey);
      ?>

     <div id="evaluationForm1_errorloc" class="error_strings"></div>
     
    </form>
  </div> <!-- twelve columns -->
</div> <!-- row -->

<!-- Client side form validation -->
<script language="JavaScript" type="text/javascript" xml:space="preserve">
  var frmvalidator  = new Validator("evaluationForm1");
  frmvalidator.EnableOnPageErrorDisplaySingleBox();
  frmvalidator.EnableMsgsTogether();

  frmvalidator.addValidation("formName","req","Please fill in your Name");
  frmvalidator.addValidation("formName","maxlen=50", "Please use 50 characters or less");

  frmvalidator.addValidation("formAge","req","Please enter your Age");
  frmvalidator.addValidation("formAge","num","Please use a number for Age");

  frmvalidator.addValidation("formEmail","req", "Please fill in your Email");
  frmvalidator.addValidation("formEmail","email");
  
  frmvalidator.addValidation("formInformativeLeft","dontselect=000","Please choose an option");
  frmvalidator.addValidation("formEntertainingLeft","dontselect=000","Please choose an option");
  frmvalidator.addValidation("formInterestingLeft","dontselect=000","Please choose an option");
  
  frmvalidator.addValidation("formInformativeRight","dontselect=000","Please choose an option");
  frmvalidator.addValidation("formEntertainingRight","dontselect=000","Please choose an option");
  frmvalidator.addValidation("formInterestingRight","dontselect=000","Please choose an option");
  
  frmvalidator.addValidation("formPreference","dontselect=000","Please choose an option");
  
  // frmvalidator.addValidation("formPreference","selectradio","Please select your preference");
  frmvalidator.addValidation("formWhy","maxlen=500", "Please use 500 characters or less");
</script>