<div class="row">
    <div class="col-md-6">
      <h2>Why Node Chat?</h2>
         
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <div id="list-content" class="float-right">
         <ul>
             <li>Run your <strong>own enterprise instant messaging</strong> network</li>
             <li><strong>30-day FREE Trial</strong> - No up-front fees, No credit card details</li>
             <li><strong>Highly Secure</strong> - Never worry about hackers and data leaks</li>
             <li><strong>Low monthly cost</strong> - starting from $0.99 per user</li>
             <li><strong>Best Features</strong> - Remote control, Screen sharing </li>
             <li><strong>Excellent</strong> for small and medium businesses</li>
             <li>Runs on Win, Linux, Mac, <strong>iPhone</strong> and <strong>Android</strong></li>
         </ul>
     </div>
    </div>
    <div class="col-md-6">
      <h2 class="form-signin-heading">Please sign up to chat with your firends. Its Free!</h2>
      <form class="form-signin" id="form-signin" role="form" action="/user/login" method="post" role="form">
        <fieldset>
          <!-- legend>Sign Up here..</legend -->
          <div class="form-group">
            <lable for="uemail"> Email : </lable>
            <input type="text" name="uemail" id="uemail" value="<?=($email) ?: NULL;?>" class="form-control" placeholder="Enter your email address" required>
          </div>
          <div class="form-group">
            <lable for="upassword"> Password : </lable>
            <input type="password" name="upassword" value="<?=($password) ?: NULL;?>" class="form-control" placeholder="Enter Password" required>
          </div>
        <label class="checkbox">
          <input type="checkbox" name="rememberme" value="remember-me" <?=($rememberme)?'checked':'';?>> Remember me
        </label>
        <br/>
        <button class="btn btn-lg btn-primary btn-block" name="btn-login-submit" type="submit">Sign in</button>
        
        </fieldset>
      </form>
    </div>
  </div>
      
<script src="http://nodeChat.com/assets/js/jquery.validate.js"></script>
<script type="text/javascript">

$(document).ready(function () {

  $('#form-signin').validate({
      rules: {
          uemail: {
              required: true, 
              email: true
          },
          upassword: {
              minlength:5,
              required: true
          },
      },
      messages: {
          uemail: {
              required: 'You need to provide your registed email to login!',
              email: 'Please enter a valid email address'
          },
          upassword: {
              required: 'You need to provide password.',
              minlength: 'Your password must be at least 5 characters long',
          },
      },
      
      highlight: function (element) {
          $(element).closest('.control-group').removeClass('success').addClass('error');
      },
      success: function (element) { /*
          element.text('OK!').addClass('valid')
              .closest('.control-group').removeClass('error').addClass('success');
              */
      }
  });
});
</script>