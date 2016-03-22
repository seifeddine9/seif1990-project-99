


    <?php // INCLUDE CSS FILES ?>
    

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

        $(document).ready(function() {






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
				<div class="login-block">
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
						 <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> <?php echo $this->lang->line('remember_me'); ?>
          </label>
        </div>
						<div class="row">
							<div class="col-sm-6">
							<button type="submit" id="login" class="btn btn-success btn-block"><?php echo $this->lang->line('login'); ?></button>

							</div>
							<div class="col-sm-6">
							<a href="<?php echo $base_url; ?>index.php/user/signup" class="btn btn-danger btn-block"><?php echo $this->lang->line('sign_up_now'); ?></a>

              </div>
						</div>
           <p ><a  href="<?php echo $base_url; ?>index.php/user/forgot_password" class="forgot-password">
                <?php echo $this->lang->line('forgot_your_password'); ?></a></p>
					</form>
				</div>
			</div>
			
		</div>
	</div>

	<!-- End of eoverlay modal -->
	
  