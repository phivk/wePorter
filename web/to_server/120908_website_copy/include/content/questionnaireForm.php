<!-- include JS validator -->
<script language="JavaScript" src="./include/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>

<!-- FORM -->
<form name="questionForm" id="questionForm" action="handle_form.php" method="post">
  
  <div class="row">
    <div class="twelve columns">
      
      <div class="row">
        <div class="ten columns">
          <label>Name: (nickname OK, but use it consistently)</label>
          <input autofocus type="text" name="formName" maxlength="50" class="" placeholder="Name"/>
        </div> 
        <div class="two columns">
          <label>Age:</label>
          <input type="text" name="formAge" maxlength="50" class="" placeholder="Age"/>
        </div> <!-- two columns -->
      </div> <!-- row -->

      <label>Email: (no spam, just 'thank you' and results)</label>
      <input type="email" name="formEmail" maxlength="50" class="twelve" placeholder="name@example.com"/>
      
    </div> <!-- twelve columns -->
  </div> <!-- row -->
  
  <div class="row">
    <div class="six columns">
      <p>
        <label>How did you hear about this experiment?</label>
        <select name="formHear">
          <option value="000" disabled selected style='display:none'>Please Choose</option>
          <option value="1"> in real life </option>
          <option value="2"> via social media (fb, twitter, etc) </option>
          <option value="3"> via email </option>
          <option value="4"> link from website </option>
          <option value="0"> other                                </option>
        </select>
      </p>

     <p>
       <label>How often do you watch video online?</label>
       <select name="formFrequency">
         <option value="000" disabled selected style='display:none'>Please Choose</option>
         <option value="1"> daily </option>
         <option value="2"> weekly </option>
         <option value="3"> monthly </option>
         <option value="4"> yearly </option>
         <option value="5"> never </option>
         <option value="0"> other / I don't know </option>
       </select>
     </p>

     <p>
       <label>How much time do spend watching video online on an average day?</label>
       <select name="formDuration">
         <option value="000" disabled selected style='display:none'>Please Choose</option>
         <option value="1"> < 1 min </option>
         <option value="2"> between 1 min and 10 min </option>
         <option value="3"> between 10 min and 30 min </option>
         <option value="4"> between 30 min and 1 hour </option>
         <option value="5"> between 1 hour and 3 hours </option>
         <option value="6"> between 3 hours and 6 hours </option>
         <option value="7"> > 6 hours </option>
         <option value="0"> I don't know </option>
       </select>
     </p>

     <p>
       <label>Are the videos you watch related to current affairs? Ranging from 1 being never, 3 about half of the time, 5 being always</label>
       <select name="formNews">
         <option value="000" disabled selected style='display:none'>Please Choose</option>
         <option value="1"> never </option>
         <option value="2"> sometimes </option>
         <option value="3"> about half of the time </option>
         <option value="4"> often </option>
         <option value="5"> always </option>
         <option value="0"> I don't know </option>
       </select>
     </p>
    </div> <!-- six columns -->
    <div class="six columns">
      <p>
         <label>Do you ever record your own video? </label>
         <select name="formRecord">
           <option value="000" disabled selected style='display:none'>Please Choose</option>
           <option value="1"> yes </option>
           <option value="2"> no </option>
           <option value="0"> I don't know </option>
         </select>
       </p>

       <p>
         <label>Do you ever upload video? </label>
         <select name="formUpload">
           <option value="000" disabled selected style='display:none'>Please Choose</option>
           <option value="1"> yes </option>
           <option value="2"> no </option>
           <option value="0"> I don't know </option>
         </select>
       </p>
       <p>
         <label>The videos you just saw were composed of parts of other videos, would you like seeing parts of your own videos remixed in such a way online?</label>
         <select name="formRemix">
           <option value="000" disabled selected style='display:none'>Please Choose</option>
           <option value="1"> yes </option>
           <option value="2"> no </option>
           <option value="0"> I don't know </option>
         </select>
       </p>
       <p>
         <label>How did you value the video interface presented here? Ranging from 1 being very unpleasant, 3 being neutral, 5 being very pleasant</label>
         <select name="formExperience">
           <option value="000" disabled selected style='display:none'>Please Choose</option>
           <option value="1"> 1 </option>
           <option value="2"> 2 </option>
           <option value="3"> 3 </option>
           <option value="4"> 4 </option>
           <option value="5"> 5 </option>
           <option value="0"> I don't know </option>
         </select>  
       </p>
    </div> <!-- six columns -->
  </div> <!-- row -->
  
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
 
 <div id="questionForm_errorloc" class="error_strings">
 </div>
 
 <input type="submit" name= "submit" value="Submit Feedback" class="medium success button">

</form>

<!-- Client side form validation -->
<script language="JavaScript" type="text/javascript" xml:space="preserve">
var frmvalidator  = new Validator("questionForm");
frmvalidator.EnableOnPageErrorDisplaySingleBox();
frmvalidator.EnableMsgsTogether();

frmvalidator.addValidation("formName","req","Please fill in your Name");
frmvalidator.addValidation("formName","maxlen=50", "Please use 50 characters or less");

frmvalidator.addValidation("formAge","req","Please enter your Age");
frmvalidator.addValidation("formAge","num","Please use a number for Age");

frmvalidator.addValidation("formEmail","req", "Please fill in your Email");
frmvalidator.addValidation("formEmail","email");

frmvalidator.addValidation("formHear","dontselect=000","Please choose an option");
frmvalidator.addValidation("formFrequency", "dontselect=000","Please choose an option");
frmvalidator.addValidation("formDuration", "dontselect=000","Please choose an option");
frmvalidator.addValidation("formNews", "dontselect=000","Please choose an option");
frmvalidator.addValidation("formRecord", "dontselect=000","Please choose an option");
frmvalidator.addValidation("formUpload", "dontselect=000","Please choose an option");
frmvalidator.addValidation("formRemix", "dontselect=000","Please choose an option");
frmvalidator.addValidation("formExperience", "dontselect=000","Please choose an option");
frmvalidator.addValidation("formComments","maxlen=500", "Please use 500 characters or less");

</script>