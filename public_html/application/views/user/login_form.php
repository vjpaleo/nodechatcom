
      <form class="form-signin" id="form-signin" role="form" action="/user/login" method="post">
        <h2 class="form-signin-heading">Please sign in to chat with your firends. Its Free!</h2>
        <input type="email" name="uemail" id="email" value="<?=$email;?>" class="form-control" placeholder="Email Address" required autofocus>
        <input type="password" name="upassword" value="<?=$password;?>" class="form-control" placeholder="Password" required>
        <label class="checkbox">
          <input type="checkbox" name="rememberme" value="remember-me" <?=($rememberme)?'checked':'';?>> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" name="btn-login-submit" type="submit">Sign in</button>
      </form>
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