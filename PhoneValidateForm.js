function PopupAbout() {
  NewWindow = window.open('PhoneFormAbout.php', 'PoppedUp', "width=680,height=800,scrollbars=yes");
  return false;
}

function ValidateForm() {
  //alert('Boo');
  if (! document.MembershipForm.RunJS.checked) {
    return true;
  }
  //return true;
  var ValidationErrors = '';
  var CrLf = "\r\n\r\n";
  if (document.MembershipForm.MAName.value == '') {
    ValidationErrors += 'First Name is a required field.  Please supply your First Name...' + CrLf; 
  }
  if (document.MembershipForm.LastName.value == '') {
    ValidationErrors += 'Last Name is a required field.  Please supply your Last Name...' + CrLf; 
  }
  if (document.MembershipForm.StreetAddress.value == '') {
    ValidationErrors += 'Street Address is a required field.  Please supply your Street Address...' + CrLf; 
  }
  if (document.MembershipForm.CityName.value == '') {
    ValidationErrors += 'City is a required field.  Please supply your City...' + CrLf; 
  }
  if (document.MembershipForm.StatesName[0].value == 'Select State') {
    ValidationErrors += 'State is a required field.  Please Select Your State...' + CrLf; 
  }
  if (document.MembershipForm.ZipCode.value == '') {
    ValidationErrors += 'Zip Code is a required field.  Please supply your Zip Code...' + CrLf; 
  }
  if (document.MembershipForm.MAEmail.value == '') {
    ValidationErrors += 'EmailAddress is a required field.  Please supply your email address...' + CrLf;
  }
  if (document.MembershipForm.MASMS.value == '') {
    ValidationErrors += 'SMS/Text is required so we can attempt to fleece you by text.  Supply your phone # for texts or go away...' + CrLf;
  }
  if (document.MembershipForm.YourOpinion.value == '') {
    ValidationErrors += 'Your opinion counts for a lot! Let us know 50 chars of your opinion or go away...' + CrLf;
  }
  if (document.MembershipForm.LeastFavoPhone.value == '') {
    ValidationErrors += 'Choose your Least Favorite ' + CrLf;
  }
  if ((document.MembershipForm.MAPass1.value == '') || (document.MembershipForm.MAPass2.value == '')) {
    ValidationErrors += 'Please enter your password, twice.' + CrLf;
  } else if (document.MembershipForm.MAPass1.value != document.MembershipForm.MAPass2.value) {
    ValidationErrors += 'Passwords entered are not the same.' + CrLf;
  }
  if (ValidationErrors == '') {
    return true;
  } else {
    alert(ValidationErrors);
    return false;
  }
}


