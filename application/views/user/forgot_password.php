
    


<style type="text/css">
      
.not-logged-avatar {
  width: 100px;
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
 a.forgot-password{
color : #53a585 !important;

}
p{
   color : black !important;
}



</style>
    <script type="text/javascript">
        $(document).ready(function() {
            var GlobalVariables = {
                'csrfToken': <?php echo json_encode($this->security->get_csrf_hash()); ?>,
                'baseUrl': <?php echo '"' . $base_url . '"'; ?>,
                'AJAX_SUCCESS': 'SUCCESS',
                'AJAX_FAILURE': 'FAILURE'
            };

            var EALang = <?php echo json_encode($this->lang->language); ?>;

            /**
             * Event: Login Button "Click"
             *
             * Make an ajax call to the server and check whether the user's credentials are right.
             * If yes then redirect him to his desired page, otherwise display a message.
             */
            $('form').submit(function(event) {
                event.preventDefault();

                var postUrl = GlobalVariables.baseUrl + 'index.php/user/ajax_forgot_password';
                var postData = {
                    'csrfToken': GlobalVariables.csrfToken,
                    'email': $('#email').val()
                };

                $('.alert').addClass('hidden');
                $('#get-new-password').prop('disabled', true);

                $.post(postUrl, postData, function(response) {
                    //////////////////////////////////////////////////////////
                    console.log('Regenerate Password Response: ', response);
                    //////////////////////////////////////////////////////////

                    $('#get-new-password').prop('disabled', false);
                    //if (!GeneralFunctions.handleAjaxExceptions(response)) return;

                    if (response == GlobalVariables.AJAX_SUCCESS) {
                        $('.alert').removeClass('hidden alert-danger alert-success')
                               $('.alert').addClass('alert-success');
                      $('.alert').text(EALang['new_password_sent_with_email']);
                    


                    } else if (response == GlobalVariables.AJAX_FAILURE) {
                        $('.alert').text(' Pour avoir un nouveau mot de passe '
                                + 'merci d\'entrer  une adresse email et un nom d\'utilisateur valides.');
                          $('.alert').removeClass('hidden alert-danger alert-success')
                               $('.alert').addClass('alert-danger');
                    }
                }, 'json');
            });
        });
    </script>

    <div class="container login-page">
        <div class="full-content-center">

            <div class="login-wrap animated flipInX">
                <div class="alert hidden "></div>

                <div class="login-block">
        
                            <h2><?php echo $this->lang->line('forgot_your_password'); ?></h2>
                               <p><?php echo $this->lang->line('type_username_and_email_for_new_password'); ?></p>
        <br/>
              
                    <form role="form" id="login-form">
                       
                        <div class="form-group login-input">
                        <i class="fa fa-envelope overlay"></i>
                        <input type="text" id="email" placeholder="<?php echo $this->lang->line('enter_email_here'); ?>" class="form-control text-input" autofocus required/>

                        </div>
                   
                        <div class="row">
                            <div class="col-sm-6">
                                 <button type="submit" id="get-new-password" class="btn btn-success btn-block">
                Nouveau Mot de passe
            </button>
                            </div>
                        <div class="col-sm-6 ">
                   <a href="<?php echo $base_url; ?>index.php/user/login" class="btn btn-danger btn-block">Se connecter</a>
                 </div>
                       
                        </div>
  
                    </form>
                </div>
            </div>
            
        </div>
    </div>
   