<?php
  function getPairFormHtml($n) {
    $pairFormHtml = '
      <form name="evaluationForm'.$n.'" id="evaluationForm'.$n.'" action="handle_evaluationForms.php" method="post">        
        
        <!-- Pair'.$n.' -->
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
  
  // function getSeqPairHtml($n) {
  //   $evalQuesitonsHtml = '
  //   <!-- Pair'.$n.' -->
  //   <hr>
  //   <h4>Video Pair'.$n.'</h4>
  //   <div class="row"> 
  //     <div class="twelve columns">
  // 
  //       <div class="row">
  //         <!-- left -->
  //         <div class="six columns">
  //           <div id="seq'.$n.'left" class="videoBox" style="text-align: center"></div>
  //           <p>
  //             <label for="formInformativeLeft">How <strong>informative</strong> did you find this video? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative.</label>
  //             <select name="formInformativeLeft" id="formInformativeLeft">
  //               <option value="000" disabled selected style="display:none">Please Choose</option>
  //               <option value="1"> 1 </option>
  //               <option value="2"> 2 </option>
  //               <option value="3"> 3 </option>
  //               <option value="4"> 4 </option>
  //               <option value="5"> 5 </option>
  //               <option value="0"> I don\'t know </option>
  //             </select>  
  //           </p>
  // 
  //           <p>
  //             <label for="formEntertainingLeft">How <strong>entertaining</strong> did you find this video? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining.</label>
  //             <select name="formEntertainingLeft" id="formEntertainingLeft">
  //               <option value="000" disabled selected style="display:none">Please Choose</option>
  //               <option value="1"> 1 </option>
  //               <option value="2"> 2 </option>
  //               <option value="3"> 3 </option>
  //               <option value="4"> 4 </option>
  //               <option value="5"> 5 </option>
  //               <option value="0"> I don\'t know </option>
  //             </select>  
  //           </p>
  //           
  //           <p>
  //             <label for="formInterestingLeft">How <strong>interesting</strong> did you find this video? Ranging from 1 being very uninteresting, 3 being neutral, 5 being very interesting.</label>
  //             <select name="formInterestingLeft" id="formInterestingLeft">
  //               <option value="000" disabled selected style="display:none">Please Choose</option>
  //               <option value="1"> 1 </option>
  //               <option value="2"> 2 </option>
  //               <option value="3"> 3 </option>
  //               <option value="4"> 4 </option>
  //               <option value="5"> 5 </option>
  //               <option value="0"> I don\'t know </option>
  //             </select>  
  //           </p>
  //         </div> <!-- six cols left-->
  // 
  //         <!-- right -->
  //         <div class="six columns">
  //           <div id="seq'.$n.'right" class="videoBox" style="text-align: center"></div>
  //           <p>
  //             <label for="formInformativeRight">How <strong>informative</strong> did you find this video? Ranging from 1 being very uninformative, 3 being neutral, 5 being very informative.</label>
  //             <select name="formInformativeRight" id="formInformativeRight">
  //               <option value="000" disabled selected style="display:none">Please Choose</option>
  //               <option value="1"> 1 </option>
  //               <option value="2"> 2 </option>
  //               <option value="3"> 3 </option>
  //               <option value="4"> 4 </option>
  //               <option value="5"> 5 </option>
  //               <option value="0"> I don\'t know </option>
  //             </select>  
  //           </p>
  // 
  //           <p>
  //             <label for="formEntertainingRight">How <strong>entertaining</strong> did you find this video? Ranging from 1 being very unentertaining, 3 being neutral, 5 being very entertaining.</label>
  //             <select name="formEntertainingRight" id="formEntertainingRight">
  //               <option value="000" disabled selected style="display:none">Please Choose</option>
  //               <option value="1"> 1 </option>
  //               <option value="2"> 2 </option>
  //               <option value="3"> 3 </option>
  //               <option value="4"> 4 </option>
  //               <option value="5"> 5 </option>
  //               <option value="0"> I don\'t know </option>
  //             </select>  
  //           </p>
  //           
  //           <p>
  //             <label for="formInterestingRight">How <strong>interesting</strong> did you find this video? Ranging from 1 being very uninteresting, 3 being neutral, 5 being very interesting.</label>
  //             <select name="formInterestingRight" id="formInterestingRight">
  //               <option value="000" disabled selected style="display:none">Please Choose</option>
  //               <option value="1"> 1 </option>
  //               <option value="2"> 2 </option>
  //               <option value="3"> 3 </option>
  //               <option value="4"> 4 </option>
  //               <option value="5"> 5 </option>
  //               <option value="0"> I don\'t know </option>
  //             </select>  
  //           </p>
  //         </div> <!-- six cols right -->
  //       </div> <!-- pair'.$n.' video row -->
  // 
  //       <!-- preference -->
  //       <div class="row">
  //         <div class="twelve columns" style="text-align: center">
  //           <div class="row"> <!-- radio row -->
  //             
  //             <p>
  //               <label for="formPreference">Which of the two videos above has your <strong>preference</strong>?</label>
  //               <select name="formPreference" id="formPreference">
  //                 <option value="000" disabled selected style="display:none">Please Choose</option>
  //                 <option value="1"> Left </option>
  //                 <option value="2"> Right </option>
  //                 <option value="3"> None </option>
  //               </select>  
  //             </p>
  // 
  //             <p>
  //              <label><strong>Why?</strong> (Optional)</label>
  //              <textarea name="formWhy" rows="1" cols="25"></textarea>
  //             </p>
  //             
  //           </div> <!-- radio row -->
  //         </div> <!-- twelve col preference -->         
  //       </div> <!-- preference -->
  // 
  //     </div> <!-- twelve cols pair'.$n.' -->
  //   </div> <!-- Pair'.$n.' -->';
  //   echo $evalQuesitonsHtml;
  //   // echo "questions";
  // }
?>