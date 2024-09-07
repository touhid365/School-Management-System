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
  document.getElementById('refresh-captcha').addEventListener('click', function () {
    generatedCaptcha = generateCaptcha();
  });
  
  // Validate CAPTCHA input
  document.getElementById('btn_contact_details').addEventListener('click', function (event) {
    var userCaptchaInput = document.getElementById('captchaInput').value;
  
    if (userCaptchaInput !== generatedCaptcha) {
      event.preventDefault(); // Prevent form submission
      document.getElementById('error_captcha').innerText = 'Incorrect CAPTCHA. Please try again.';
      document.getElementById('captchaInput').classList.add('has-error');
    } else {
      document.getElementById('error_captcha').innerText = '';
      document.getElementById('captchaInput').classList.remove('has-error');
    }
  });
  