<?php
  
  function getSeqPairHtml($n) {
    $evalQuesitonsHtml = '
    <!-- Pair'.$n.' -->
    <div class="row"> 
      <div class="twelve columns">

        <div class="row">
          <!-- left -->
          <div class="six columns">
            <div id="seq'.$n.'left" class="videoBox" style="text-align: center"></div>
            <p>
              <label for="formInformative'.$n.'left">How <strong>informative</strong> did you find this video? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative.</label>
              <select name="formInformative'.$n.'left" id="formInformative'.$n.'left">
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
              <label for="formEntertaining'.$n.'left">How <strong>entertaining</strong> did you find this video? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining.</label>
              <select name="formEntertaining'.$n.'left" id="formEntertaining'.$n.'left">
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
              <label for="formInteresting'.$n.'left">How <strong>interesting</strong> did you find this video? Ranging from 1 being very uninteresting, 3 being neutral, 5 being very interesting.</label>
              <select name="formInteresting'.$n.'left" id="formInteresting'.$n.'left">
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
              <label for="formInformative'.$n.'right">How <strong>informative</strong> did you find this video? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative.</label>
              <select name="formInformative'.$n.'right" id="formInformative'.$n.'right">
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
              <label for="formEntertaining'.$n.'right">How <strong>entertaining</strong> did you find this video? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining.</label>
              <select name="formEntertaining'.$n.'right" id="formEntertaining'.$n.'right">
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
              <label for="formInteresting'.$n.'right">How <strong>interesting</strong> did you find this video? Ranging from 1 being very uninteresting, 3 being neutral, 5 being very interesting.</label>
              <select name="formInteresting'.$n.'right" id="formInteresting'.$n.'right">
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
            <label>Which of the two videos above has your <strong>preference</strong>?</label>
            <div class="row"> <!-- radio row -->
              <div class="four columns" style="text-align: center">
                <label for="radio'.$n.'">
                    <input name="radio'.$n.'" type="radio" id="radio'.$n.'Left"> Left
                </label>
              </div> <!-- six cols radioLeft -->
              
              <div class="four columns" style="text-align: center">
                <label for="radio'.$n.'">
                    <input name="radio'.$n.'" type="radio" id="radio'.$n.'None"> None
                </label>
              </div> <!-- six cols radioLeft -->

              <div class="four columns" style="text-aligngn: center">
                <label for="radio2">
                    <input name="radio'.$n.'" type="radio" id="radio'.$n.'Right"> Right
                </label>
              </div> <!-- six cols radioRight -->
              
              <p>
               <label><strong>Why?</strong> (Optional)</label>
               <textarea name="formComments" rows="1" cols="25"></textarea>
              </p>
              
            </div> <!-- radio row -->
          </div> <!-- twelve col preference -->         
        </div> <!-- preference -->

      </div> <!-- twelve cols pair'.$n.' -->
    </div> <!-- Pair'.$n.' -->';
    echo $evalQuesitonsHtml;
    // echo "questions";
  }
?>