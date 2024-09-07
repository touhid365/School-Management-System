$(document).ready(function(){

    // Generate a random CAPTCHA
    function generateCaptcha() {
     var captchaText = '';
     var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
 
     for (var i = 0; i < 6; i++) {
       captchaText += possible.charAt(Math.floor(Math.random() * possible.length));
     }
 
     // Draw CAPTCHA text on the canvas
     var canvas = document.getElementById('captchaCanvas');
     var ctx = canvas.getContext('2d');
     ctx.clearRect(0, 0, canvas.width, canvas.height);
     ctx.font = '30px Arial';
     ctx.fillText(captchaText, 10, 40);
 
     return captchaText;
   }
 
   var generatedCaptcha = generateCaptcha(); // Store the generated CAPTCHA text
 
   // Refresh CAPTCHA on button click
   $('#refresh-captcha').click(function() {
     generatedCaptcha = generateCaptcha();
   });


 $('#btn_login_details').click(function(){
  
  var error_email = '';
  var error_password = '';
  var error_cpassword ='';
  var error_squestion ='';
  var error_roll_no ='';
  
  var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  //  var filter1 =/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
  var filter1 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/;
  var filter4 =/^IMIT\d{6}$/;
  
  //--------username-----------
 
if($.trim($('#email').val()).length == 0)
 {
  error_email = 'Email is required';
  $('#error_email').text(error_email);
  $('#email').addClass('has-error');
 }
 else
 {
  if (!filter.test($('#email').val()))
  {
   error_email = 'Invalid Email';
   $('#error_email').text(error_email);
   $('#email').addClass('has-error');
  }
  else
  {
   error_email = '';
   $('#error_email').text(error_email);
   $('#email').removeClass('has-error');
  }
 }

  //----------password----------
  
  if($.trim($('#password').val()).length == 0)
  {
   error_password = 'Password is required';
   $('#error_password').text(error_password);
   $('#password').addClass('has-error');
  }
  else
  {
  if (!filter1.test($('#password').val()))
   {
     error_password = 'Invalid Password, It must be[ name@123 ]characters long. ';
     $('#error_password').text(error_password);
     $('#password').addClass('has-error');
     
  } 
  else 
  {
   error_password = '';
   $('#error_password').text(error_password);
   $('#password').removeClass('has-error');
  }
 }
 
  //----------confirm password--------
//   if($.trim($('#cpassword').val()).length == 0)
//   {
//    error_cpassword = 'Confirm Password is required';
//    $('#error_cpassword').text(error_cpassword);
//    $('#cpassword').addClass('has-error');
//   }
//   else
//   {
//  if (!filter1.test($('#cpassword').val())) 
//    {
//      error_cpassword = 'Invalid  confirm password,  ';
//      $('#error_cpassword').text(error_cpassword);
//      $('#cpassword').addClass('has-error');  
//    }
//   else
//   {  
//    error_cpassword = '';
//    $('#error_cpassword').text(error_cpassword);
//    $('#cpassword').removeClass('has-error');
//   }
//  }
  //--------------Rollno-----------//
//   if($.trim($('#roll_no').val()).length == 0)
//    {
//     error_roll_no = 'Roll No is required';
//     $('#error_roll_no').text(error_roll_no);
//     $('#roll_no').addClass('has-error');
//    }
//    else
//    {
//    if (!filter4.test($('#roll_no').val()))
//     {
//       error_roll_no = 'Roll No format is [ IMIT402401 ]';
//       $('#error_roll_no').text(error_roll_no);
//       $('#roll_no').addClass('has-error');
      
//    } 
//    else 
//    {
//     error_roll_no = '';
//     $('#error_roll_no').text(error_roll_no);
//     $('#roll_no').removeClass('has-error');
//    }
//   }
  //------------security question------

 //  if($.trim($('#squestion').val()).length == 0)
 //  {
 //   error_squestion = 'Security question is required';
 //   $('#error_squestion').text(error_squestion);
 //   $('#squestion').addClass('has-error');
 //  }
 //  else
 //  {
 //   error_squestion = '';
 //   $('#error_squestion').text(error_squestion);
 //   $('#squestion').removeClass('has-error');
 //  }

 //  if($.trim($('#sanswer').val()).length == 0)
 //  {
 //   error_sanswer = 'Security Answer is required';
 //   $('#error_sanswer').text(error_sanswer);
 //   $('#sanswer').addClass('has-error');
 //  }
 //  else
 //  {
 //   error_sanswer = '';
 //   $('#error_sanswer').text(error_sanswer);
 //   $('#sanswer').removeClass('has-error');
 //  }
  //------------------

  if(error_email != '' || error_password != '' )
  {
  return false;
  } 
  else  
  {
     
  
  
   $('#list_login_details').removeClass('active active_tab1');
   $('#list_login_details').removeAttr('href data-toggle');
   $('#login_details').removeClass('active');
   $('#list_login_details').addClass('inactive_tab1');
   $('#list_personal_details').removeClass('inactive_tab1');
   $('#list_personal_details').addClass('active_tab1 active');
   $('#list_personal_details').attr('href', '#personal_details');
   $('#list_personal_details').attr('data-toggle', 'tab');
   $('#personal_details').addClass('active in');
  
 }
 
 });
 
 $('#previous_btn_personal_details').click(function(){
  $('#list_personal_details').removeClass('active active_tab1');
  $('#list_personal_details').removeAttr('href data-toggle');
  $('#personal_details').removeClass('active in');
  $('#list_personal_details').addClass('inactive_tab1');
  $('#list_login_details').removeClass('inactive_tab1');
  $('#list_login_details').addClass('active_tab1 active');
  $('#list_login_details').attr('href', '#login_details');
  $('#list_login_details').attr('data-toggle', 'tab');
  $('#login_details').addClass('active in');
 });
 
 $('#btn_personal_details').click(function(){
  var error_first_name = '';
  var error_last_name = '';
  var error_gender = '';
  var error_m_status = '';
  var error_mobile_no = '';
  var error_nationality = '';
  var error_occupation = '';
  var mobile_validation = /^\d{10}$/;
  var filter2 = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  //-----name---------
  
  if($.trim($('#first_name').val()).length == 0)
  {
   error_first_name = 'First Name is required';
   $('#error_first_name').text(error_first_name);
   $('#first_name').addClass('has-error');
  }
  else
  {
   error_first_name = '';
   $('#error_first_name').text(error_first_name);
   $('#first_name').removeClass('has-error');
  }
  
  if($.trim($('#last_name').val()).length == 0)
  {
   error_last_name = 'Last Name is required';
   $('#error_last_name').text(error_last_name);
   $('#last_name').addClass('has-error');
  }
  else
  {
   error_last_name = '';
   $('#error_last_name').text(error_last_name);
   $('#last_name').removeClass('has-error');
  }
  //----------married-----------
  
  if($.trim($('#m_status').val()).length == 0)
  {
   error_m_status = ' Options is required';
   $('#error_m_status').text(error_m_status);
   $('#m_status').addClass('has-error');
  }
  else
  {
   error_m_status = '';
   $('#error_m_status').text(error_m_status);
   $('#m_status').removeClass('has-error');
  }

  //------mobile-no-------
  if($.trim($('#mobile_no').val()).length == 0)
  {
   error_mobile_no = 'Mobile Number is required';
   $('#error_mobile_no').text(error_mobile_no);
   $('#mobile_no').addClass('has-error');
  }
  else
  {
   if (!mobile_validation.test($('#mobile_no').val()))
   {
    error_mobile_no = 'Invalid Mobile Number';
    $('#error_mobile_no').text(error_mobile_no);
    $('#mobile_no').addClass('has-error');
   }
   else
   {
    error_mobile_no = '';
    $('#error_mobile_no').text(error_mobile_no);
    $('#mobile_no').removeClass('has-error');
   }
  }

  //----email-----
  if($.trim($('#email').val()).length == 0)
  {
   error_email = 'Email is required';
   $('#error_email').text(error_email);
   $('#email').addClass('has-error');
  }
  else
  {
   if (!filter2.test($('#email').val()))
   {
    error_email = 'Invalid Email';
    $('#error_email').text(error_email);
    $('#email').addClass('has-error');
   }
   else
   {
    error_email = '';
    $('#error_email').text(error_email);
    $('#email').removeClass('has-error');
   }
  }
 //----------gender---------
   
if($.trim($('#gender').val()).length == 0)
{
error_gender = ' Options is required';
$('#error_gender').text(error_gender);
$('#gender').addClass('has-error');
}
else
{
error_married = '';
$('#error_gender').text(error_gender);
$('#gender').removeClass('has-error');
}
//---------------Occupation----------
  
if($.trim($('#Occupation').val()).length == 0)
{
error_occupation = ' Options is required';
$('#error_occupation').text(error_occupation);
$('#Occupation').addClass('has-error');
}
else
{
error_occupation = '';
$('#error_occupation').text(error_occupation);
$('#Occupation').removeClass('has-error');
}
  
//-----------nationality------------------
if($.trim($('#nationality').val()).length == 0)
{
error_nationality = ' Options is required';
$('#error_nationality').text(error_nationality);
$('#nationality').addClass('has-error');
}
else
{
error_nationality = '';
$('#error_nationality').text(error_nationality);
$('#nationality').removeClass('has-error');
}


  if(error_first_name != '' || error_last_name != '' || error_mobile_no != '' || error_email != '' 
  || error_m_status != '' || error_gender != '' || error_occupation != '' || error_nationality != '')
  {
   return false;
  }
  else
  {
   $('#list_personal_details').removeClass('active active_tab1');
   $('#list_personal_details').removeAttr('href data-toggle');
   $('#personal_details').removeClass('active');
   $('#list_personal_details').addClass('inactive_tab1');
   $('#list_contact_details').removeClass('inactive_tab1');
   $('#list_contact_details').addClass('active_tab1 active');
   $('#list_contact_details').attr('href', '#contact_details');
   $('#list_contact_details').attr('data-toggle', 'tab');
   $('#contact_details').addClass('active in');
  }
 });
 
 $('#previous_btn_contact_details').click(function(){
  $('#list_contact_details').removeClass('active active_tab1');
  $('#list_contact_details').removeAttr('href data-toggle');
  $('#contact_details').removeClass('active in');
  $('#list_contact_details').addClass('inactive_tab1');
  $('#list_personal_details').removeClass('inactive_tab1');
  $('#list_personal_details').addClass('active_tab1 active');
  $('#list_personal_details').attr('href', '#personal_details');
  $('#list_personal_details').attr('data-toggle', 'tab');
  $('#personal_details').addClass('active in');
 });
 
 $('#btn_contact_details').click(function(){





  var error_address = '';
  var error_add_city = '';
  var error_add_state = '';
  var error_add_zip = '';
  var error_add_postoffice = '';
  var error_gridCheck = '';
  var error_captcha = '';

  if($.trim($('#address').val()).length == 0)
  {
   error_address = 'Address is required';
   $('#error_address').text(error_address);
   $('#address').addClass('has-error');
  }
  else
  {
   error_address = '';
   $('#error_address').text(error_address);
   $('#address').removeClass('has-error');
  }
//-----------city----------
  if($.trim($('#add_city').val()).length == 0)
  {
   error_add_city = 'Please provide a valid city.';
   $('#error_add_city').text(error_add_city);
   $('#add_city').addClass('has-error');
  }
  else
  {
   error_add_city = '';
   $('#error_add_city').text(error_add_city);
   $('#add_city').removeClass('has-error');
  }
  //-----------state----------
  if($.trim($('#add_state').val()).length == 0)
  {
   error_add_state = 'Please provide a valid State.';
   $('#error_add_state').text(error_add_state);
   $('#add_state').addClass('has-error');
  }
  else
  {
   error_add_state = '';
   $('#error_add_state').text(error_add_state);
   $('#add_state').removeClass('has-error');
  }
  //-----------zip-------------
  if($.trim($('#add_zip').val()).length == 0)
  {
   error_add_zip = 'Please provide a valid Pin Code.';
   $('#error_add_zip').text(error_add_zip);
   $('#add_zip').addClass('has-error');
  }
  else
  {
   error_add_zip = '';
   $('#error_add_zip').text(error_add_zip);
   $('#add_zip').removeClass('has-error');
  }

  //----------------postOffice--------------

  if($.trim($('#add_postoffice').val()).length == 0)
  {
   error_add_postoffice = 'Please provide a valid Post Office.';
   $('#error_add_postoffice').text(error_add_postoffice);
   $('#add_postoffice').addClass('has-error');
  }
  else
  {
   error_add_postoffice = '';
   $('#error_add_postoffice').text(error_add_postoffice);
   $('#add_postoffice').removeClass('has-error');
  }
  //-----------checkbox-----------
  if($.trim($('#gridCheck').val()).length == 0)
  {
   error_gridCheck = 'Check box is required.';
   $('#error_gridCheck').text(error_gridCheck);
   $('#gridCheck').addClass('has-error');
  }
  else
  {
   error_gridCheck= '';
   $('#error_gridCheck').text(error_gridCheck);
   $('#gridCheck').removeClass('has-error');
  }
  
  //--------captcha-----------
   //--------captcha-----------
   var userCaptchaInput = $('#captchaInput').val();
   if ($.trim(userCaptchaInput).length == 0) {
     error_captcha = 'Captcha is required.';
     $('#error_captcha').text(error_captcha);
     $('#captchaInput').addClass('has-error');
   } else if (userCaptchaInput !== generatedCaptcha) {
     error_captcha = 'Incorrect CAPTCHA. Please try again.';
     $('#error_captcha').text(error_captcha);
     $('#captchaInput').addClass('has-error');
   } else {
     error_captcha = '';
     $('#error_captcha').text(error_captcha);
     $('#captchaInput').removeClass('has-error');
   }

// if ($.trim($('#captchaInput').val()).length == 0) {
//   error_captcha = 'Captcha is required.';
//   $('#error_captcha').text(error_captcha);
//   $('#captchaInput').addClass('has-error');
// } else {
//   error_captcha = '';
//   $('#error_captcha').text(error_captcha);
//   $('#captchaInput').removeClass('has-error');
// }


  if(error_address != '' || error_add_city != '' || error_add_state != '' 
  || error_add_zip != '' || error_add_postoffice != ''  || error_gridCheck != '' || error_captcha != '') 
  {
   return false;
  }
  else
  {
   $('#btn_contact_details').attr("disabled", "disabled");
   $(document).css('cursor', 'prgress');
   $("#register_form").submit();
  }
  
 });
 
});