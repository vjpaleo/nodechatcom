<!-- Bootstrap Form Helpers -->
    <link href="http://nodeChat.com/assets/formhelpers/dist/css/bootstrap-formhelpers.min.css" rel="stylesheet" media="screen">

      <form class="form-signin" id="form-signup" role="form" action="/user/register" method="post">
        <h2 class="form-signin-heading">Please sign up to chat with your firends. Its Free!</h2>
        <lable for="ufullname"> Full Name : </lable>
        <input type="text" name="ufullname" id="ufullname" value="<?=($ufullname) ?: NULL;?>" class="form-control" placeholder="Enter your full name" required autofocus>
        <lable for="ufullname"> Email : </lable>
        <input type="text" name="uemail" id="uemail" value="<?=($uemail) ?: NULL;?>" class="form-control" placeholder="Enter your email address" required >
        <lable for="ufullname"> Password : </lable>
        <input type="password" name="upassword" value="" class="form-control" placeholder="Enter Password" required>
        <lable for="ufullname"> Re-enter Password : </lable>
        <input type="password" name="cpassword" value="" class="form-control" placeholder="Confirm Password" required>
        <lable for="ufullname"> Date of Birth : </lable>
        <input type="date" name="udob" value="<?=($udob) ?: NULL;?>" class="form-control" placeholder="Enter your Date Of Birth in MM-DD-YYYY format" required>
        <lable for="ufullname"> Zipcode : </lable>
        <input type="text" name="uzipcode" value="<?=($uzipcode) ?: NULL;?>" class="form-control" placeholder="Enter your zip code." required>
        <lable for="ufullname">Country : </lable>
        
        <input type="hidden" name="ucountry" value="<?=($ucountry) ?: NULL;?>" class="form-control" placeholder="Enter your country" required>
        <div class="bfh-selectbox bfh-countries" data-country="US" data-flags="true"></div>
        
        <button class="btn btn-lg btn-primary btn-block" name="btn-register-submit" type="submit">Sign up</button>
      </form>
<script src="http://nodeChat.com/assets/js/jquery.validate.js"></script>

<!-- Bootstrap Form Helpers -->
<script src="http://nodeChat.com/assets/formhelpers/dist/js/bootstrap-formhelpers.min.js"></script>

<script type="text/javascript">

$(document).ready(function () {

  $('#form-signin').validate({
      rules: {
          ufullname: {
              required: true, 
              maxlength: 50
          },
          uemail: {
              required: true, 
              email: true
          },
          upassword: {
              minlength:5,
              maxngth:20,
              required: true
          },
          cpassword: {
              minlength:5,
              maxngth:20,
              required: true
          },
          udob: {
              required: true, 
              minlength:10,
              maxngth:10,
              date: true
          },
          uzipcode: {
              required: true, 
              minlength:5,
              maxngth:6,
              text: true
          },
          ucountry: {
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