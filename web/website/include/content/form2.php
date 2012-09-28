<!-- include JS validator -->
<script language="JavaScript" src="./include/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>

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
      <h4>Video Pair 1</h4>
      
      <!-- pair 1 -->
      <div class="row"> 
        <div class="twelve columns">
    
          <div class="row">
            <!-- left -->
            <div class="six columns">
              <div id="seq1left" class="videoBox">seq1left</div>
              <p>
                <label for="formInformative1left">Did you experience this video as <strong>informative</strong>? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative</label>
                <select name="formInformative1left" id="formInformative1left">
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
                <label for="formEntertaining1left">Did you experience this video as <strong>entertaining</strong>? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining</label>
                <select name="formEntertaining1left" id="formEntertaining1left">
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
              <div id="seq1right" class="videoBox">seq1right</div>
              <p>
                <label for="formInformative1right">Did you experience this video as <strong>informative</strong>? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative</label>
                <select name="formInformative1right" id="formInformative1right">
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
                <label for="formEntertaining1right">Did you experience this video as <strong>entertaining</strong>? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining</label>
                <select name="formEntertaining1right" id="formEntertaining1right">
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
          </div> <!-- pair1 video row -->
    
          <!-- preference -->
          <div class="row">
            <div class="twelve columns" style="text-align: center">
                <label>Which of the two videos above has your <strong>preference</strong>?</label>
                <div class="row"> <!-- radio row -->
                  <div class="six columns" style="text-align: center">
                    <label for="radio1">
                        <input name="radio1" type="radio" id="radio1"> Left
                    </label>
                  </div> <!-- six cols radioLeft -->

                  <div class="six columns" style="text-align: center">
                    <label for="radio2">
                        <input name="radio1" type="radio" id="radio2"> Right
                    </label>
                  </div> <!-- six cols radioRight -->
                </div> <!-- radio row -->
            </div> <!-- twelve col preference -->         
          </div> <!-- preference -->
    
        </div> <!-- twelve cols pair1 -->
      </div> <!-- pair 1 -->
      
      <hr/>

      <!-- pair 2 -->
      <div class="row"> 
        <div class="twelve columns">
    
          <div class="row">
            <!-- left -->
            <div class="six columns">
              <div id="seq2left" class="videoBox">seq2left</div>
              <p>
                <label for="formInformative2left">Did you experience this video as <strong>informative</strong>? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative</label>
                <select name="formInformative2left" id="formInformative2left">
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
                <label for="formEntertaining2left">Did you experience this video as <strong>entertaining</strong>? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining</label>
                <select name="formEntertaining2left" id="formEntertaining2left">
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
              <div id="seq2right" class="videoBox">seq2right</div>
              <p>
                <label for="formInformative2right">Did you experience this video as <strong>informative</strong>? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative</label>
                <select name="formInformative2right" id="formInformative2right">
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
                <label for="formEntertaining2right">Did you experience this video as <strong>entertaining</strong>? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining</label>
                <select name="formEntertaining2right" id="formEntertaining2right">
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
          </div> <!-- pair2 video row -->
    
          <!-- preference -->
          <div class="row">
            <div class="twelve columns" style="text-align: center">
                <label>Which of the two videos above has your <strong>preference</strong>?</label>
                <div class="row"> <!-- radio row -->
                  <div class="six columns" style="text-align: center">
                    <label for="radio2">
                        <input name="radio2" type="radio" id="radio2Left"> Left
                    </label>
                  </div> <!-- six cols radioLeft -->

                  <div class="six columns" style="text-align: center">
                    <label for="radio2">
                        <input name="radio2" type="radio" id="radio2Right"> Right
                    </label>
                  </div> <!-- six cols radioRight -->
                </div> <!-- radio row -->
            </div> <!-- twelve col preference -->         
          </div> <!-- preference -->
    
        </div> <!-- twelve cols pair2 -->
      </div> <!-- pair 2 -->
      
      <!-- pair 3 -->
      <div class="row"> 
        <div class="twelve columns">
    
          <div class="row">
            <!-- left -->
            <div class="six columns">
        
              <!-- parallel player left -->
              <!-- <div id="interactionWrapper" class="panel" onload="resetCount()">
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
              </div> --> <!-- interaction wrapper -->
        
              <p>
                <label for="formInformative3left">Did you experience this video as <strong>informative</strong>? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative</label>
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
                <label for="formEntertaining3left">Did you experience this video as <strong>entertaining</strong>? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining</label>
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
            </div> <!-- six cols left-->
      
            <!-- right -->
            <div class="six columns">
        
              <!-- parallel player left -->
              <!-- <div id="interactionWrapper" class="panel" onload="resetCount()">
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
              </div>  --><!-- interaction wrapper -->
        
              <p>
                <label for="formInformative3right">Did you experience this video as <strong>informative</strong>? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative</label>
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
                <label for="formEntertaining3right">Did you experience this video as <strong>entertaining</strong>? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining</label>
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
      </div> <!-- pair 3 -->

      <p>
       <label>Any comments?</label>
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

frmvalidator.addValidation("formInformative1left","dontselect=000","Please choose an option");
frmvalidator.addValidation("formEntertaining1left","dontselect=000","Please choose an option");
frmvalidator.addValidation("formInformative1right","dontselect=000","Please choose an option");
frmvalidator.addValidation("formEntertaining1right","dontselect=000","Please choose an option");
// frmvalidator.addValidation("radio1","dontselect=000","Please choose an option");
frmvalidator.addValidation("formInformative2left","dontselect=000","Please choose an option");
frmvalidator.addValidation("formEntertaining2left","dontselect=000","Please choose an option");
frmvalidator.addValidation("formInformative2right","dontselect=000","Please choose an option");
frmvalidator.addValidation("formEntertaining2right","dontselect=000","Please choose an option");
// frmvalidator.addValidation("radio2","dontselect=000","Please choose an option");
frmvalidator.addValidation("formInformative3left","dontselect=000","Please choose an option");
frmvalidator.addValidation("formEntertaining3left","dontselect=000","Please choose an option");
frmvalidator.addValidation("formInformative3right","dontselect=000","Please choose an option");
frmvalidator.addValidation("formEntertaining3right","dontselect=000","Please choose an option");
// frmvalidator.addValidation("radio3","dontselect=000","Please choose an option");



frmvalidator.addValidation("formComments","maxlen=500", "Please use 500 characters or less");

</script>