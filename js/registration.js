$(document).ready(function() {

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
  
    $('#btn_contact_details').click(function() {
      var error_address = '';
      var error_add_city = '';
      var error_add_state = '';
      var error_add_zip = '';
      var error_add_postoffice = '';
      var error_gridCheck = '';
      var error_captcha = '';
  
      if ($.trim($('#address').val()).length == 0) {
        error_address = 'Address is required';
        $('#error_address').text(error_address);
        $('#address').addClass('has-error');
      } else {
        error_address = '';
        $('#error_address').text(error_address);
        $('#address').removeClass('has-error');
      }
      //-----------city----------
      if ($.trim($('#add_city').val()).length == 0) {
        error_add_city = 'Please provide a valid city.';
        $('#error_add_city').text(error_add_city);
        $('#add_city').addClass('has-error');
      } else {
        error_add_city = '';
        $('#error_add_city').text(error_add_city);
        $('#add_city').removeClass('has-error');
      }
      //-----------state----------
      if ($.trim($('#add_state').val()).length == 0) {
        error_add_state = 'Please provide a valid State.';
        $('#error_add_state').text(error_add_state);
        $('#add_state').addClass('has-error');
      } else {
        error_add_state = '';
        $('#error_add_state').text(error_add_state);
        $('#add_state').removeClass('has-error');
      }
      //-----------zip-------------
      if ($.trim($('#add_zip').val()).length == 0) {
        error_add_zip = 'Please provide a valid Pin Code.';
        $('#error_add_zip').text(error_add_zip);
        $('#add_zip').addClass('has-error');
      } else {
        error_add_zip = '';
        $('#error_add_zip').text(error_add_zip);
        $('#add_zip').removeClass('has-error');
      }
  
      //----------------postOffice--------------
      if ($.trim($('#add_postoffice').val()).length == 0) {
        error_add_postoffice = 'Please provide a valid Post Office.';
        $('#error_add_postoffice').text(error_add_postoffice);
        $('#add_postoffice').addClass('has-error');
      } else {
        error_add_postoffice = '';
        $('#error_add_postoffice').text(error_add_postoffice);
        $('#add_postoffice').removeClass('has-error');
      }
  
      //-----------checkbox-----------
      if (!$('#gridCheck').is(':checked')) {
        error_gridCheck = 'Check box is required.';
        $('#error_gridCheck').text(error_gridCheck);
        $('#gridCheck').addClass('has-error');
      } else {
        error_gridCheck = '';
        $('#error_gridCheck').text(error_gridCheck);
        $('#gridCheck').removeClass('has-error');
      }
  
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
  
      if (error_address != '' || error_add_city != '' || error_add_state != '' ||
        error_add_zip != '' || error_add_postoffice != '' || error_gridCheck != '' || error_captcha != '') {
        return false;
      } else {
        $('#btn_contact_details').attr("disabled", "disabled");
        $(document).css('cursor', 'progress');
        $("#register_form").submit();
      }
    });
  
  });
  