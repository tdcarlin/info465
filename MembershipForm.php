<?php
/*
$Locked = file_get_contents('/home/ldajeu/AppLock');
if (trim($Locked) == 'Locked') {
  $ModTime = date ("l F d, Y  H:i", filemtime('/home/tinstructor/MemberAppLocked'));
  $FormTemplate = file_get_contents('TemplateForm.html');
  $UI = "<h2>Not Accepting Applications Now</h2>\n\n<p>Applications were locked $ModTime.</p>\n<p>They'll be unlocked when we feel like it.  Try later...</p>";
  $FormTemplate = str_replace('[[[TheForm]]]',$UI , $FormTemplate);
  echo $FormTemplate;
  exit;
}
 */

function MakeTheForm($ValidationErrors)
{
  if (isset($_POST['MAName'])) {
    extract($_POST);
  }
  else {
    //Set defaults
    $MAName = '';
    $LastName = '';
    $StreetAddress = '';
    $CityName = '';
    $StatesName = '';
    $ZipCode = '';
    $MAEmail = '';
    $MASMS = '';
    $SocialMed = '';
    $TheBestApp = '';
    $YourOpinion = '';
    $MAPass1 = '';
    $MAPass2 = '';
    $LeastFavoPhone = '';
    //$MAStatesVisited = '';
    $PhoneYourFamily = '';
  }
  $RedSplat = " <span class=\"Flag\">* </span> ";
  $TheForm = "<p>Complete all sections of the form and
     click Submit Form when you're done... </p>
    <fieldset>
      <legend>Name &amp; Contact Data</legend>\n";
  if (isset($ValidationErrors['MAName'])) {
    $SplatSlug = $RedSplat;
  }
  else {
    $SplatSlug = '';
  }
  //$TheForm .= "\n  <ul>\n";
  $TheForm .= "      <p><label for=\"MAName\">$SplatSlug Name:</label>
          <input type=\"text\" name=\"MAName\" id=\"MAName\" value=\"$MAName\" placeholder=\"Enter Your Fist Name\" autofocus />
            </p><br /> \n";
  if (isset($ValidationErrors['LastName'])) {
    $SplatSlug = $RedSplat;
  }
  else {
    $SplatSlug = '';
  }
  //$TheForm .= "\n  <ul>\n";
  $TheForm .= "      <p><label for=\"LastName\">$SplatSlug Last Name:</label>
          <input type=\"text\" name=\"LastName\" id=\"LastName\" value=\"$LastName\" placeholder=\"Enter Your Last\" autofocus />
            </p><br /> \n";
  if (isset($ValidationErrors['StreetAddress'])) {
    $SplatSlug = $RedSplat;
  }
  else {
    $SplatSlug = '';
  }
  //$TheForm .= "\n  <ul>\n";
  $TheForm .= "      <p><label for=\"StreetAddress\">$SplatSlug Street Address:</label>
          <input type=\"text\" name=\"StreetAddress\" id=\"StreetAddress\" value=\"$StreetAddress\" placeholder=\"Your street address\" autofocus />
            </p><br /> \n";
  if (isset($ValidationErrors['CityName'])) {
    $SplatSlug = $RedSplat;
  }
  else {
    $SplatSlug = '';
  }
  //$TheForm .= "\n  <ul>\n";
  $TheForm .= "      <p><label for=\"CityName\">$SplatSlug City:</label>
          <input type=\"text\" name=\"CityName\" id=\"CityName\" value=\"$CityName\" placeholder=\"your City\" autofocus />
            </p><br /> \n";

  if (isset($ValidationErrors['StatesName'])) {
    $SplatSlug = $RedSplat;
  }
  else {
    $SplatSlug = '';
  }
  //select state           
  $TheForm .= "
          <p><label for=\"StatesName\">$SplatSlug State:</label>
          <select name=\"StatesName[]\" id=\"StatesName\">\n";
  $FileThatIsBeingUse = fopen('/home/ldajeu/web/doc/StateNameOpition', 'r');
  while ($AState = fgets($FileThatIsBeingUse)) {
    $AState = trim($AState);
    //$AStateNoSpaces = str_replace(' ','',$AState);
    if (isset($StatesName) and $StatesName != '' and in_array($AState, $StatesName)) {
      $SelectedSlug = 'selected';
    }
    else {
      $SelectedSlug = '';
    }
    $TheForm .= "             <option value=\"$AState\" $SelectedSlug >$AState</option>\n";
  }
  $TheForm .= "          </select>
        </p><br/>\n";

  if (isset($ValidationErrors['ZipCode'])) {
    $SplatSlug = $RedSplat;
  }
  else {
    $SplatSlug = '';
  }
  $TheForm .= "      <p><label for=\"ZipCode\">$SplatSlug Zip Code:</label>
          <input type=\"text\" name=\"ZipCode\" id=\"ZipCode\" value=\"$ZipCode\" placeholder=\"5 digits like 12345\" />
          </p>  <br />   \n";

  if (isset($ValidationErrors['MAEmail'])) {
    $SplatSlug = $RedSplat;
  }
  else {
    $SplatSlug = '';
  }
  $TheForm .= "       <p><label for=\"MAEmail\">$SplatSlug Email:</label>
          <input type=\"text\" name=\"MAEmail\" id=\"MAEmail\" value=\"$MAEmail\" placeholder=\"Fictitious is fine!\" />
            </p><br />  \n";
  if (isset($ValidationErrors['MASMS'])) {
    $SplatSlug = $RedSplat;
  }
  else {
    $SplatSlug = '';
  }
  $TheForm .= "      <p><label for=\"MASMS\">$SplatSlug Text/SMS#:</label>
          <input type=\"text\" name=\"MASMS\" id=\"MASMS\" value=\"$MASMS\" placeholder=\"10 digits like 123 123 1234\" />
          </p>  <br />   \n";
  if (isset($ValidationErrors['MAPass'])) {
    $SplatSlug = $RedSplat;
  }
  else {
    $SplatSlug = '';
  }
  $TheForm .= "      
          <p><label for=\"MAPass1\">$SplatSlug Password:</label>
          <input type=\"text\" name=\"MAPass1\" id=\"MAPass1\" value=\"$MAPass1\" placeholder=\"At least 8 characters...\" />
        </p><br /> \n";
  $TheForm .= "      
          <p><label for=\"MAPass2\">Password, again:</label>
          <input type=\"text\" name=\"MAPass2\" id=\"MAPass2\" value=\"$MAPass2\" placeholder=\"Enter it again, please\" />
        </p><br /> \n";
  $TheForm .= "        
   </fieldset>\n";

  $TheForm .= "   <fieldset><legend>What Social Media would you use the MOST</legend>\n";
  //Make check boxes for SocialMed[] and radio buttons for TheBestApp from file SocialMedia
  $SocialMediaFile = fopen('/home/ldajeu/web/doc/SocialMedia', 'r');
  $TheBestApptoUse = '';
  while ($AState = fgets($SocialMediaFile)) {
    $AState = trim($AState);
    $AStateNoSpaces = str_replace(' ', '', $AState);  //Used to make id with no spaces so extract() will work 
    if (isset($SocialMed) and $SocialMed != '' and in_array($AState, $SocialMed)) {
      $CheckedSlug = 'checked';
    }
    else {
      $CheckedSlug = '';
    }
    $TheForm .= "       <label for=\"Visited$AStateNoSpaces\" class=\"WideLabel\">
         <input type=\"checkbox\" name=\"SocialMed[]\" id=\"Visited$AStateNoSpaces\" value=\"$AState\" $CheckedSlug />$AState
       </label>\n";
    if (isset($TheBestApp) and $AState == $TheBestApp) {
      $CheckedSlug = 'checked';
    }
    else {
      $CheckedSlug = '';
    }
    $TheBestApptoUse .= "       <label for=\"Fav$AStateNoSpaces\" class=\"WideLabel\">
         <input type=\"radio\" name=\"TheBestApp\" id=\"Fav$AStateNoSpaces\" value=\"$AState\" $CheckedSlug />$AState
       </label>";
  }
  $TheForm .= "    </fieldset>
    <fieldset><legend>The Best App the use</legend>
    $TheBestApptoUse
    </fieldset>";

  $TheForm .= "
    <fieldset>
      <legend>Your Opinions count</legend>
      <div class=\"Row\">\n";
  if (isset($ValidationErrors['YourOpinion'])) {
    $SplatSlug = $RedSplat;
  }
  else {
    $SplatSlug = '';
  }
  $TheForm .= "   <div class=\"Col-12\">       
          <label for=\"YourOpinion\" class=\"WideLabel\">$SplatSlug What's input about the Best Media App?</label>      
            <textarea name=\"YourOpinion\" id=\"YourOpinion\" placeholder=\"Help Us Improve Our Service\">$YourOpinion</textarea>
        </div>
        </div>
      <div class=\"Row\"><br />";
  //Hard coded small select           
  if (isset($ValidationErrors['LeastFavoPhone'])) {
    $SplatSlug = $RedSplat;
  }
  else {
    $SplatSlug = '';
  }
  $TheForm .= "
        <div class=\"Col-6\">
           <label for=\"LeastFavoPhone\" class=\"WideLabel\">$SplatSlug Least Favorite phone to use?</label>
           <select name=\"LeastFavoPhone\" id=\"LeastFavoPhone\" size=\"5\">";
  if ($LeastFavoPhone == 'Nokia') {
    $SelectedSlug = "selected";
  }
  else {
    $SelectedSlug = '';
  }
  $TheForm .= "            <option value=\"Nokia\" $SelectedSlug>Nokia</option>\n";
  if ($LeastFavoPhone == 'LG') {
    $SelectedSlug = "selected";
  }
  else {
    $SelectedSlug = '';
  }
  $TheForm .= "             <option value=\"LG\" $SelectedSlug>LG</option>\n";
  if ($LeastFavoPhone == 'Acatel') {
    $SelectedSlug = "selected";
  }
  else {
    $SelectedSlug = '';
  }
  $TheForm .= "             <option value=\"Acatel\" $SelectedSlug>Acatel</option>\n";
  if ($LeastFavoPhone == 'Sony') {
    $SelectedSlug = "selected";
  }
  else {
    $SelectedSlug = '';
  }
  $TheForm .= "             <option value=\"Sony\" $SelectedSlug>Sony</option>\n";
  if ($LeastFavoPhone == 'Motorola') {
    $SelectedSlug = "selected";
  }
  else {
    $SelectedSlug = '';
  }
  $TheForm .= "             <option value=\"Motorola\" $SelectedSlug>Motorola</option>";
  $TheForm .= "
           </select>
        </div>\n";

  //Multi-select using contents of text file with Options...
  $TheForm .= "
        <div class=\"Col-6\">
          <label for=\"PhoneYourFamily\" class=\"WideLabel\">Phone your Family have?<br />
          <span class=\"FinePrint\">(Ctrl-click for multiple)</span></label>
          <select name=\"PhoneYourFamily[]\" id=\"PhoneYourFamily\" size=\"12\" multiple>\n";
  $FileThatIsBeingUse = fopen('/home/ldajeu/web/doc/FamilyPhone', 'r');
  while ($AState = fgets($FileThatIsBeingUse)) {
    $AState = trim($AState);
    //$AStateNoSpaces = str_replace(' ','',$AState);
    if (isset($PhoneYourFamily) and $PhoneYourFamily != '' and in_array($AState, $PhoneYourFamily)) {
      $SelectedSlug = 'selected';
    }
    else {
      $SelectedSlug = '';
    }
    $TheForm .= "             <option value=\"$AState\" $SelectedSlug >$AState</option>\n";
  }
  $TheForm .= "          </select>
        </div>\n";

  $TheForm .= "    </div>\n";
  $TheForm .= " </fieldset>\n";
  return $TheForm;
}
//
//Mainline 
//Set if initially $PoppedUp or not, then track it, used to control Close Window button
$PoppedUp = isset($_REQUEST['PoppedUp']);
if (!isset($_REQUEST['View'])) {
  $View = 'First';
}
else {
  $View = $_REQUEST['View'];
}
if ($View == 'First') {
  //This is their first time at the page, explain stuff and make the form with empty $_POST...
  $UI = "  <h2>Membership Application</h2>
   <p>Click <a href=\"#\" onClick=\"PopupAbout()\">About the Form</a> to pop up notes about the form, JavaScript, and PHP.</p>
   <form method=\"POST\" name=\"MembershipForm\" action=\"MembershipForm.php\" onSubmit=\"return ValidateForm();\">";
  if ($PoppedUp) $UI .= "\n<input type=\"hidden\" name=\"PoppedUp\" value=\"Yep\">\n";
  $UI .= MakeTheForm('');
  $UI .= " 
     <p>Click <input type=\"submit\" name=\"View\" value=\"Submit Form\"> to submit your completed form ldajeu.  </p>
     <p>Uncheck the box to disable JS ValidateForm: <input type=\"checkbox\" name=\"RunJS\" id=\"RunJS\" checked=\"checked\"></p>
     <p>Click <a href=\"#\" onClick=\"PopupAbout()\">About the Form</a> to pop up notes about the form, JavaScript, and PHP.</p>
</form>";
}
elseif ($View == 'Submit Form') {
  //They've filled in the form and clicked the Submit button, should be error free unless they've disabled JavaScript
  //on their browser or the content is submitted by a bot.  
  $ValidationErrors = '';
  extract($_POST);
  //Validate what came back.
  if (!isset($MAName) or $MAName == '') $ValidationErrors['MAName'] = "Name is missing or empty.  Please enter your name before clicking Submit.";
  if (!isset($LastName) or $LastName == '') $ValidationErrors['LastName'] = "Name is missing or empty.  Please enter your name before clicking Submit.";
  if (!isset($StreetAddress) or $StreetAddress == '') $ValidationErrors['StreetAddress'] = "Street is missing or empty.  Please enter your name before clicking Submit.";
  if (!isset($CityName) or $CityName == '') $ValidationErrors['CityName'] = "City is missing or empty.  Please enter your name before clicking Submit.";
  if (!isset($StatesName) or $StatesName[0] == 'Select State') $ValidationErrors['StatesName'] = "State is missing or empty.  Please choose your  state name before clicking Submit.";
  if (!isset($ZipCode) or strlen($ZipCode) < 5) $ValidationErrors['ZipCode'] = "Please enter the 5-digit Zip.";
  if (!isset($MAEmail) or $MAEmail == '') {
    $ValidationErrors['MAEmail'] = "The email address is empty.  Please enter your email address before clicking Submit.";
  }
  elseif (filter_var($MAEmail, FILTER_VALIDATE_EMAIL) === false) {
    $ValidationErrors['MAEmail'] = "The email  is not a valid format.";
  }
  if (!isset($MASMS) or strlen($MASMS) < 10) $ValidationErrors['MASMS'] = "Please enter the 10-digit number where you receive text messages.";
  if (!isset($YourOpinion) or strlen($YourOpinion) < 50) $ValidationErrors['YourOpinion'] = "Please your comment for at least 50 characters. Your opinion weighs heavily on our decision to accept you into the society.";
  if (!isset($LeastFavoPhone) or $LeastFavoPhone == '') {
    $_POST['LeastFavoPhone'] = '';
    $ValidationErrors['LeastFavoPhone'] = "Please select your least favorite phone.";
  }
  if (!isset($TheBestApp) or $TheBestApp == '') $ValidationErrors['TheBestApp'] = "You must select your Social Media.";
  if ( (!isset($MAPass1) or $MAPass1 == '') or (!isset($MAPass2) or $MAPass2 == '')) {
    $ValidationErrors['MAPass'] = "Enter your password twice, please.";
  }
  elseif ($MAPass1 != $MAPass2) {
    $ValidationErrors['MAPass'] = "Passwords do not match.";
  }
  //$CountStates
  $UI = '';
  if (is_array($ValidationErrors)) {
    $ErrorCount = count($ValidationErrors);
    if ($ErrorCount == 1) {
      $UI .= "<p>Please correct this error, then click Submit Form:</p>\n";
    }
    else {
      $UI .= "<p>Please correct $ErrorCount errors, then click Submit Form:</p>\n";
    }
    $UI .= "<ul>\n";
    foreach ($ValidationErrors as $AnErrorMessage) {
      $UI .= "   <li>$AnErrorMessage</li>\n ";
    }
    $UI .= "</ul>\n";
  }
  else {
    $UI .= "<p>Thanks you for response...</p>";
  }
  $UI .= "<form method=\"POST\" name=\"MembershipForm\" action=\"MembershipForm.php\" onSubmit=\"return ValidateForm();\">\n";
  $UI .= "<h2>Membership Application</h2>\n";
  $UI .= MakeTheForm($ValidationErrors);
  if ($PoppedUp) $UI .= "\n<input type=\"hidden\" name=\"PoppedUp\" value=\"Yep\" >\n";
  $UI .= " <p>Run JS ValidateForm: <input type=\"checkbox\" name=\"RunJS\" id=\"RunJS\" checked=\"checked\">  Click <input type=\"submit\" name=\"View\" value=\"Submit Form\"> if changes have been made.  </p>
     <p>Click <a href=\"#\" onClick=\"PopupAbout()\">About the Form</a> to pop up notes about the form, JavaScript, and PHP.</p>
 </form>";
  if ($PoppedUp) {
    $UI .= "<p>Click <input type=button value='Close Window' onclick='window.close()'> to close this window when you're done making changes...</p>";
  }
  else {
    $UI .= "<p>Use your browser's 'back button' or Alt + Left Arrow to return to the previous page...</p>";
  }
}
else {
  $UI = "<p><font color=red>! </font>Somehow we don't know what your next view should be '$View' is not valid...</p>";
}
$FormTemplate = file_get_contents('TemplateForm.html');
$FormTemplate = str_replace('[[[TheForm]]]', $UI, $FormTemplate);
echo $FormTemplate;
exit;
?>
