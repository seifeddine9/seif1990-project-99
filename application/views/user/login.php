


    <?php // INCLUDE CSS FILES ?>
        <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>assets/ext/bootstrap/css/bootstrap-social.css">

            <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>assets/ext/intl-tel-input/intlTelInput.css">



           <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>assets/ext/intl-tel-input/intlTelInput.js"></script>  


         <script type="text/javascript" src="<?php echo $this->config->item('base_url'); ?>assets/ext/all.js"></script>

       <style>


       
.not-logged-avatar {
  margin: 0px auto;
  display: block;
  margin-bottom: 20px;
  text-align: center;
 box-shadow: 1px 1px 3px rgba(0,0,0,0.1);
}




.full-content-center {
  width: 100%;
 max-width: 600px;
  margin: 6% auto;
  text-align: center;
}
.full-content {
  background: #E5E9EC;
}
.full-content-center h1 {
  font-size: 150px;
  font-family: "Open Sans";
  line-height: 150px;
  font-weight: 700;
  color: #252932;
}

.login-wrap {
 margin: 80px 10%;
  text-align: left;
  background: rgba(0,0,0,0.1);
  padding: 20px 20px;
  color: #fff;
}

.login-wrap i {
  margin-right: 5px;
}
.login-wrap .checkbox {
  margin-left: 0;
  padding-left: 0;
}
.login-wrap .btn-block {
  margin: 5px 0;
}
button.btn.btn-block.btn-social.btn-facebook,
button#login {
    width: 70%;
    margin-left: 15%;
}
.login-wrap .login-input {
  position: relative;
}
.login-wrap .login-input .text-input {
  padding-left: 30px;
}
.login-wrap .login-input i.overlay {
  position: absolute;
  left: 10px;
  top: 10px;
  color: #aaa;
}
.checkbox{

  color : #53a585 ;
}
p a.forgot-password{
color : #53a585 !important;

}



       </style>
              
                <!-- Extra CSS Libraries End -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
 <script type="text/javascript">
        var GlobalVariables = {
            'csrfToken': <?php echo json_encode($this->security->get_csrf_hash()); ?>,
            'baseUrl': <?php echo '"' . $base_url . '"'; ?>,
            'destUrl': <?php echo '"' . $dest_url . '"'; ?>,
            'destUrlCustomer': <?php echo '"' . $dest_url_customer . '"'; ?>,
            'AJAX_SUCCESS': 'SUCCESS',
            'AJAX_FAILURE': 'FAILURE'
        };

        var EALang = <?php echo json_encode($this->lang->language); ?>;
          window.fbAsyncInit = function() {
  FB.init({
    appId      : '535891186589773',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });





  };


        $(document).ready(function() {

         var customerData = new Object();

           $(document).on("keypress" ,"#phone-number" , function(event) {
             // console.log(isNaN(String.fromCharCode(event.which)));

  if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
            event.preventDefault();
        }
});


  checkLoginState = function () {

              FB.login(function(response) {

                    if (response.status === 'connected') {
      // Logged into your app and Facebook.
    FB.api('/me?fields=id,name,link,email,gender,picture,first_name,last_name,about', function(response) {
                var formData = new Object();
                  formData['customer'] = { 'idfacebook': response.id };

                var postData = {
                    'csrfToken': GlobalVariables.csrfToken,
                    'post_data': formData
                };

                  
           var postUrl = GlobalVariables.baseUrl + 'index.php/user/login_facebook';

             $.post(postUrl, postData, function (data) {



if(data =='AJAX_FAILURE')
{                      

  $('.coordonnee-facebook').removeClass('hidden');
  $('.login-block').addClass('hidden'); 



                     

                    customerData = {
                        'idfacebook': response.id,
                        'first_name': response.first_name,
                        'last_name': response.last_name,
                        'email': response.email,
                        'src_photo': response.picture.data.url

                    };

console.log(customerData);
   // window.location.href =GlobalVariables.baseUrl + 'index.php/user/l_facebook';
}
     else {

            window.location.href = GlobalVariables.destUrlCustomer;

                       }



              },'json');


         
      }); }  }, {scope: 'email,public_profile', return_scopes: true});  


       }
    $('#buttonNext').click(function(event){

    var missingFields = false ; 

      $('#coordonnee .required').each(function() {
                if ($(this).val() == '') {
                    $(this).parents('.form-group').addClass('has-error');

      
                  missingFields = true;

  }

});
if(missingFields == true)
 {return false; }

 


   var formData = new Object();

        formData['customer'] = {
            'phone_number': $("#phone-number").intlTelInput("getNumber"),
            'address': $('#address').val(),
            'city': $('#city').val(),
            'zip_code': $('#zip-code').val(),
            'idfacebook' : customerData.idfacebook,
            'first_name' : customerData.first_name,
            'last_name' : customerData.last_name,
            'src_photo' : customerData.src_photo,
            'email' : customerData.email,
        };

 var postData = {
            'csrfToken': GlobalVariables.csrfToken,
            'post_data': formData
        };
  var postUrl = GlobalVariables.baseUrl + 'index.php/user/inscription';

          

 $.post(postUrl, postData, function(response) {
                ////////////////////////////////////////////////////////////
  window.location.href = GlobalVariables.baseUrl ;
         
  }, 'json');



});







            /**
             * Event: Login Button "Click"
             *
             * Make an ajax call to the server and check whether the user's credentials are right.
             * If yes then redirect him to his desired page, otherwise display a message.
             */
            $('#login-form').submit(function(event) {
               event.preventDefault();

                var postUrl = GlobalVariables.baseUrl + 'index.php/user/ajax_check_login';
                var postData = {
                    'csrfToken': GlobalVariables.csrfToken,
                    'email': $('#email').val(),
                    'password': $('#password').val()
                };

             

                $.post(postUrl, postData, function(response) {
                    //////////////////////////////////////////////////
                    console.log('Check Login Response: ', response);
                    //////////////////////////////////////////////////

                    if (!GeneralFunctions.handleAjaxExceptions(response)) return;

                    if (response.role_slug == "admin" || response.role_slug == "provider" || response.role_slug == "secretary") {
                        window.location.href = GlobalVariables.destUrl;
                    } 
                    else if (response.role_slug == "customer") {
                        window.location.href = GlobalVariables.destUrlCustomer;
                        
                    }
                    


                    else {
                        $('.alert').html(EALang['login_failed']);
                        $('.alert')
                            .removeClass('hidden alert-danger alert-success')
                            .addClass('alert-danger');
                    }
                }, 'json');
            });   });

         </script>
    
        <!-- Modal Start -->
        	<!-- Modal Task Progress -->	
          

	<!-- Begin page -->
	<div class="container login-page">
		<div class="full-content-center">

			<div class="login-wrap animated flipInX">
				<div class="login-block  ">
          <div class="alert hidden"></div>
					<img src="<?php echo $base_url;?>assets/img/logo.png" class="img-responsive not-logged-avatar" id ="avatar">
					<form role="form" id="login-form">
						<div class="form-group login-input">
						<i class="fa fa-user overlay"></i>
						<input type="text" id="email" class="form-control text-input" placeholder="<?php echo $this->lang->line('enter_email_here'); ?>" autofocus required>
						</div>
						<div class="form-group login-input">
						<i class="fa fa-key overlay"></i>
						<input type="password" id ="password" class="form-control text-input" placeholder="<?php echo $this->lang->line('enter_password_here'); ?>" required>
						</div>
						 <div class="ol-sm-12">

        </div>
						<div class="row ">
							<div class="col-sm-12">
							<button type="submit" id="login" class="btn btn-primary btn-block"><?php echo $this->lang->line('login'); ?></button>

							</div>
         
						</div>

					</form>
                    <button class="btn btn-block btn-social  btn-facebook" style="text-align: center" onclick="checkLoginState();">
                <span class="fa fa-facebook"></span> Connexion avec Facebook
         </button>
   <br/>   


                <div class="col-sm-6">
              <a href="<?php echo $base_url; ?>index.php/user/signup" style='color: #23b08a;' class="signup">Nouveau utilisateur?</a>

              </div>
                <div class="col-sm-6">
              <a href="<?php echo $base_url; ?>index.php/user/forgot_password" style="color:#23b08a;" class="forgot-password">Mot de passe oublié ?</a>
         </div>
		</div>


                            <div class="row coordonnee-facebook hidden">
                                <br/>
                                <div class="col-xs-offset-2 col-xs-8  col-xs-offset-2"><h3 > Compléter vos coordonnées avant de continuer</h3>
                                
                                    <form role="form" id="coordonnee">
                                <div class="col-md-12 col-sm-12  col-xs-12">
                                    <div class="form-group">
                                        <label for="phone-number" class=" hidden-xs control-label"><?php echo $this->lang->line('phone_number'); ?> *</label>
                                        <br/><input type="text" id="phone-number" name="phone-number" class=" phone-number required form-control"  placeholder="Téléphone"  maxlength="60"  />
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12  col-xs-12">
                                    <div class="form-group">
                                        <label for="address" class=" hidden-xs control-label"><?php echo $this->lang->line('address'); ?> *</label>
                                        <input type="text" id="address" name="address" class=" address  required form-control"  placeholder="Addresse"    />
                                    </div>
                                </div>

                                     <div class="col-md-6 col-sm-6  col-xs-12">
                                    <div class="form-group">
                                        <label for="city" class=" hidden-xs control-label"><?php echo $this->lang->line('city'); ?> *</label>
                                        <input type="text" id="city" name="city" class=" city  required form-control"  placeholder="Ville"    />
                                    </div>
                                </div>   

                                  <div class="col-md-6 col-sm-6  col-xs-12">
                                    <div class="form-group">
                                        <label for="zip-code" class=" hidden-xs control-label"><?php echo $this->lang->line('zip_code'); ?> *</label>
                                        <input type="text" id="zip-code" name="zip-code" class=" zip-code required form-control"  placeholder="Code postal"    />
                                    </div>
                                </div>


                                    </form>
                                </div>
                                                 <div class="command-buttons " >
                                 <div  class="text-right">
                            <button type="button" id="buttonNext" class="btn button-next btn-primary">
                                        Suivant
                                <span class="glyphicon glyphicon-forward"></span>
                            </button>
                          </div>
                        </div>
                            </div>






			</div>
			
		</div>
	</div>
    <script type="text/javascript">
$("#phone-number").intlTelInput({
  nationalMode: true,
  utilsScript: "<?php echo $this->config->item('base_url'); ?>assets/ext/intl-tel-input/utils.js", // just for formatting/placeholders etc
  autoPlaceholder: false
});

    </script>
	<!-- End of eoverlay modal -->
	
  