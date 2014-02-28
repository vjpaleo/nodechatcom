<!-- Bootstrap Form Helpers -->
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
        <form class="form-signin" id="form-signup" role="form" action="/user/register" method="post"  role="form">
          <fieldset>
            <!-- legend>Sign Up here..</legend -->
            
            <lable for="ufullname"> Full Name : </lable>
            <input type="text" name="ufullname" id="ufullname" value="<?=($ufullname) ?: NULL;?>" class="form-control" placeholder="Enter your full name" required autofocus>
            
            <lable for="uemail"> Email : </lable>
            <input type="text" name="uemail" id="uemail" value="<?=($uemail) ?: NULL;?>" class="form-control" placeholder="Enter your email address" required>
            
            <lable for="upassword"> Password : </lable>
            <input type="password" name="upassword" value="" class="form-control" placeholder="Enter Password" required>

            <lable for="cpassword"> Re-enter Password : </lable>
            <input type="password" name="cpassword" value="" class="form-control" placeholder="Confirm Password" required>
            
            <lable for="udob"> Date of Birth : </lable>
            <input type="date" name="udob" value="<?=($udob) ?: NULL;?>" class="form-control" placeholder="Enter your Date Of Birth in MM-DD-YYYY format" required>
            
            <lable for="ufullname"> Zipcode : </lable>
            <input type="uzipcode" name="uzipcode" value="<?=($uzipcode) ?: NULL;?>" class="form-control" placeholder="Enter your zip code." required>
            
            <lable for="ucountry">Country : </lable>
            <input type="hidden" name="ucountry" value="<?=($ucountry) ?: NULL;?>" class="form-control" placeholder="Enter your country" required>
            <div class="bfh-selectbox bfh-countries" data-country="US" data-flags="true"></div>
            
            <button class="btn btn-lg btn-primary btn-block" name="btn-register-submit" type="submit">Sign up</button>
          
          </fieldset>
        </form>
      </div>
    </div>
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
<style>
body {
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #eee;
}

.form-signin {
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  /* margin-bottom: -1px; */
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="text"] {
  margin-bottom: 10px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>