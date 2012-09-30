<?php
  function getPairFormHtml($n) {
    $pairFormHtml = '
      <form name="evaluationForm'.$n.'" id="evaluationForm'.$n.'" action="handle_evaluationForms.php" method="post">        
        <!-- Pair '.$n.' -->
        <hr>
        <h4>Video Pair'.$n.'</h4>
        <div class="row panel"> 
          <div class="twelve columns">

            <div class="row">
              <!-- left -->
              <div class="six columns">
                <div id="seq'.$n.'left" class="videoBox" style="text-align: center"></div>
                <p>
                  <label for="formInformativeLeft">How <strong>informative</strong> did you find this video? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative.</label>
                  <select name="formInformativeLeft" id="formInformativeLeft">
                    <option value="000" disabled selected style="display:none">Please Choose</option>
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                    <option value="0"> I don\'t know </option>
                  </select>  
                </p>

                <p>
                  <label for="formEntertainingLeft">How <strong>entertaining</strong> did you find this video? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining.</label>
                  <select name="formEntertainingLeft" id="formEntertainingLeft">
                    <option value="000" disabled selected style="display:none">Please Choose</option>
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                    <option value="0"> I don\'t know </option>
                  </select>  
                </p>

                <p>
                  <label for="formInterestingLeft">How <strong>interesting</strong> did you find this video? Ranging from 1 being very uninteresting, 3 being neutral, 5 being very interesting.</label>
                  <select name="formInterestingLeft" id="formInterestingLeft">
                    <option value="000" disabled selected style="display:none">Please Choose</option>
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                    <option value="0"> I don\'t know </option>
                  </select>  
                </p>
              </div> <!-- six cols left-->

              <!-- right -->
              <div class="six columns">
                <div id="seq'.$n.'right" class="videoBox" style="text-align: center"></div>
                <p>
                  <label for="formInformativeRight">How <strong>informative</strong> did you find this video? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative.</label>
                  <select name="formInformativeRight" id="formInformativeRight">
                    <option value="000" disabled selected style="display:none">Please Choose</option>
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                    <option value="0"> I don\'t know </option>
                  </select>  
                </p>

                <p>
                  <label for="formEntertainingRight">How <strong>entertaining</strong> did you find this video? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining.</label>
                  <select name="formEntertainingRight" id="formEntertainingRight">
                    <option value="000" disabled selected style="display:none">Please Choose</option>
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                    <option value="0"> I don\'t know </option>
                  </select>  
                </p>

                <p>
                  <label for="formInterestingRight">How <strong>interesting</strong> did you find this video? Ranging from 1 being very uninteresting, 3 being neutral, 5 being very interesting.</label>
                  <select name="formInterestingRight" id="formInterestingRight">
                    <option value="000" disabled selected style="display:none">Please Choose</option>
                    <option value="1"> 1 </option>
                    <option value="2"> 2 </option>
                    <option value="3"> 3 </option>
                    <option value="4"> 4 </option>
                    <option value="5"> 5 </option>
                    <option value="0"> I don\'t know </option>
                  </select>  
                </p>
              </div> <!-- six cols right -->
            </div> <!-- pair'.$n.' video row -->

            <!-- preference -->
            <div class="row">
              <div class="twelve columns" style="text-align: center">
                <div class="row"> <!-- radio row -->

                  <p>
                    <label for="formPreference">Which of the two videos above has your <strong>preference</strong>?</label>
                    <select name="formPreference" id="formPreference">
                      <option value="000" disabled selected style="display:none">Please Choose</option>
                      <option value="1"> Left </option>
                      <option value="2"> Right </option>
                      <option value="3"> None </option>
                    </select>  
                  </p>
                  
                  <p>
                   <label><strong>Why?</strong> (Optional)</label>
                   <textarea name="formWhy" rows="1" cols="25"></textarea>
                  </p>
                  
                  <input type="submit" name= "evaluation'.$n.'" value="Continue >>" class="medium success button" style="margin:10px">
                  
                </div> <!-- radio row -->
              </div> <!-- twelve col preference -->         
            </div> <!-- preference -->
            
            <div id="evaluationForm'.$n.'_errorloc" class="error_strings"></div>
      
          </div> <!-- twelve cols pair'.$n.' -->
        </div> <!-- Pair'.$n.' -->
      </form>';
    echo $pairFormHtml;

  }
  
  function getInsertPositioningScriptHtml($n){
    $insertPositioningScriptHtml = 
    '<script type="text/javascript" charset="utf-8">
      //console.log("positioning in html: ",positioning);
      //Create an input type dynamically.
      var element = document.createElement("input");
      //Assign attributes to the element.
      element.setAttribute("type", "text");
      element.setAttribute("value", positioning);
      element.setAttribute("name", "formPositioning");
      //Append the element to form
      var form = document.getElementById("evaluationForm'.$n.'");
      form.appendChild(element);
      element.style.display = "none";
    </script>';
    echo $insertPositioningScriptHtml;
  }
  
  function getPairValidationHtml($n){
    $pairValidationHtml = 
    '<!-- Client side form validation -->
    <script language="JavaScript" type="text/javascript" xml:space="preserve">      
      var frmvalidator  = new Validator("evaluationForm'.$n.'"); // *number*
      frmvalidator.EnableOnPageErrorDisplaySingleBox();
      frmvalidator.EnableMsgsTogether();
      
      frmvalidator.addValidation("formPositioning","req","Positioning undefined...");
      
      frmvalidator.addValidation("formInformativeLeft","dontselect=000","Please choose an option");
      frmvalidator.addValidation("formEntertainingLeft","dontselect=000","Please choose an option");
      frmvalidator.addValidation("formInterestingLeft","dontselect=000","Please choose an option");
      
      frmvalidator.addValidation("formInformativeRight","dontselect=000","Please choose an option");
      frmvalidator.addValidation("formEntertainingRight","dontselect=000","Please choose an option");
      frmvalidator.addValidation("formInterestingRight","dontselect=000","Please choose an option");
      
      frmvalidator.addValidation("formPreference","dontselect=000","Please choose an option");
      frmvalidator.addValidation("formWhy","maxlen=500", "Please use 500 characters or less");
    </script>';
    echo $pairValidationHtml;   
  }
?>