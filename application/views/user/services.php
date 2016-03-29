   
<link
    rel="stylesheet"
    type="text/css"
    href="<?php echo $this->config->item('base_url'); ?>assets/css/general.css">
<link
    rel="stylesheet"
    type="text/css"
    href="<?php echo $this->config->item('base_url'); ?>assets/css/style_portfolio.css">

 <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>assets/ext/bootstrap/css/bootstrap-social.css">
<link
    rel="stylesheet"
    type="text/css"
    href="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery-ui/jquery-ui.min.css">
 <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>assets/ext/bootstrap/css/bootstrap-social.css">    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>assets/ext/intl-tel-input/intlTelInput.css">
            <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>assets/ext/intl-tel-input/intlTelInput.css">
<link
    rel="stylesheet"
    type="text/css"
    href="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery-qtip/jquery.qtip.min.css">
<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/js/frontend_service.js"></script> 

<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery-ui/jquery-ui.min.js"></script>
<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery-qtip/jquery.qtip.min.js"></script>


<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/js/frontend_book_success.js"></script>

<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/ext/masonry.pkgd.min.js"></script>

   <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>assets/ext/intl-tel-input/intlTelInput.js"></script>
<?php  /********
                 Script for facebook javascript sdk*********/ ?>

 <script src="http://connect.facebook.net/en_US/all.js"></script>


<script type="text/javascript">


    var GlobalVariables = {
        availableServices: <?php echo json_encode($available_services); ?>,
        availableProviders: <?php echo json_encode($available_providers); ?>,
        baseUrl: <?php echo '"' . $this->config->item('base_url') . '"'; ?>,
        manageMode: <?php echo '"' . $manage_mode . '"'; ?>,
        dateFormat: <?php echo json_encode($date_format); ?>,
        showProvider: <?php echo json_encode($show_provider); ?>,
        appointmentData: <?php echo json_encode($appointment_data); ?>,
        providerData: <?php echo json_encode($provider_data); ?>,
        customerData: <?php echo json_encode($customer_data); ?>,
        csrfToken: <?php echo json_encode($this->security->get_csrf_hash()); ?>,
        googleApiKey: <?php echo '"' . Config::GOOGLE_API_KEY . '"'; ?>,
        googleClientId: <?php echo '"' . Config::GOOGLE_CLIENT_ID . '"'; ?>,
        googleApiScope: 'https://www.googleapis.com/auth/calendar',
        AJAX_SUCCESS: 'SUCCESS',
        AJAX_FAILURE: 'FAILURE'
    };

    var EALang = <?php echo json_encode($this->lang->language); ?>;

    $(document).ready(function () {
        FrontendService.initialize(true, GlobalVariables.manageMode);

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
{                              $('.update-address-phone-number').removeClass('hidden');
                               $('.cnx-choice').addClass('hidden'); 

                   $('#first-name').val(response.first_name);
                    $('#last-name').val(response.last_name);
                    $('#email').val(response.email);
                    $('#idfacebook').val(response.id);
                    $('#picture').val(response.picture.data.url);
                     

}
                     else
                       {

                    $('#first-name').val(data.first_name);
                    $('#last-name').val(data.last_name);
                    $('#email').val(data.email);
                    $('#phone-number').val(data.phone_number);
                    $('#city').val(data.city);
                    $('#address').val(data.address);
                    $('#zip-code').val(data.zip_code);



                                        $('#not-logged-in').html(' <a href="#" class="" data-toggle="dropdown" > <strong>' + data.first_name + " " + data.last_name + ' </strong><span class=" fa fa-angle-down"></span></a>' +
                            '<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">' +
                            '<?php $active = ($active_menu == PRIV_APPOINTMENTS) ? "active" : ""; ?>' +
                            '<li class="<?php echo $active; ?>" ><a <a href="' + GlobalVariables.baseUrl + 'index.php/home/appointments"><span> Mes Rendez-vous</span></a> </li>' +
                            '<?php $active = ($active_menu == PRIV_PROFILE) ? "active" : ""; ?>' +
                            '<li  class="<?php echo $active; ?>" > <a href="' + GlobalVariables.baseUrl + 'index.php/home/profile"> <span>Mon Profile</span> </a> </li>' +
                            '<?php $active = ($active_menu == PRIV_WAITING) ? "active" : ""; ?>' +
                            '<li  class="<?php echo $active; ?>" > <a href="' + GlobalVariables.baseUrl + 'index.php/home/waiting"> <span>Liste d\'attente</span> </a> </li>' +
                            '<li>' +
                            '<a href="javascript:;"><span>Aide</span></a>' +
                            '</li>' +
                            '<li><a  href="' + GlobalVariables.baseUrl + 'index.php/user/logout"><hr><i class="fa fa-sign-out pull-right"></i> Déconnexion</a>' +
                            '</li>' +
                            '</ul>');



                         var customerData = new Object();
                    customerData = {
                        'user_id': data.id,
                        'first_name': data.first_name,
                        'last_name': data.last_name,
                        'email': data.email,
                        'phone_number': data.phone_number,
                        'address': data.address,
                        'city': data.city,
                        'zip_code': data.zip_code,
                        'role_slug': data.role_slug
                    };
                    GlobalVariables.customerData = customerData;
                    console.log(GlobalVariables.customerData);


                    FrontendService.updateConfirmFrame();

                         var nextTabIndex = parseInt($('#button-next-3').attr('data-step_index')) + 1;
                  $('#button-next-3.btn.button-next.btn-primary').parents().eq(1).hide('fade', function () {
                        $('.active-step').removeClass('active-step');
                        $('#step-' + nextTabIndex).addClass('active-step');
                        $('#wizard-frame-' + nextTabIndex).show('fade');
                    });
                       }



              },'json');


         
  

       }); }  }, {scope: 'email,public_profile', return_scopes: true});   }
</script>



<section class="services-block">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 style="text-align: center;"> Découvrez  nos services </h2><br/>
            </div>
        </div>
        <div class="row " >
          <ul class="portfolio-container">

                        <div class="container">

                <div class="row">
                    <div class="col-md-12  col-sm-12 col-xs-12 portfolio-masonry">



 </div> 
</div>
 </div>
        </ul>

        </div>
    </div>
</section>





<div class="modal fade" id="book-modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

                    <div class="modal-header" style="border: none; background-color: #54debc;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title frame-title" style="text-align: center;  color: #fff;">Prendre un rendez-vous</h3>
      </div>


            <div id="book-appointment-wizard" class="">

                <?php
                // ------------------------------------------------------
                // FRAME TOP BAR
                // ------------------------------------------------------ 
                ?>




                <?php
                // ------------------------------------------------------
                // DISPLAY EXCEPTIONS (IF ANY)
                // ------------------------------------------------------
                if (isset($exceptions)) {
                    echo '<div style="margin: 10px">';
                    echo '<h4>' . $this->lang->line('unexpected_issues') . '</h4>';
                    foreach ($exceptions as $exception) {
                        echo exceptionToHtml($exception);
                    }
                    echo '</div>';
                }
                ?>

                <?php
                // ------------------------------------------------------
                // SELECT SERVICE AND PROVIDER
                // ------------------------------------------------------
                ?>

                <div id="wizard-frame-1" class="wizard-frame" style="display:none;">
                    <div class="frame-container">


                        <div class="frame-content">

                            <div class="form-group">
                                <input id="select-service" type ="hidden" class="col-md-4 form-control">
                            </div>

                            <br/>
                            <div id="service-description" style="display:none;"></div>

                            <br/>
                            <div class="form-group" id="provider-form"

                                 <?php
                                 $this->load->model('settings_model');
                                 $show_provider = $this->settings_model->get_setting('show_provider');
                                 if ($show_provider == '0') {
                                     ?>
                                     style="display:none;"

                                     >

                                    <?php
                                }
                                ?>
                                <label for="select-provider">Choisissez un exécutant </label>
                                <select id="select-provider" class="col-md-4 form-control"></select>
                            </div>


                        </div>
                    </div>

                    <div class="command-buttons">
                        <button type="button" id="button-next-1" class="btn button-next btn-primary"
                                data-step_index="1">
                                    <?php echo $this->lang->line('next'); ?>
                            <span class="glyphicon glyphicon-forward"></span>
                        </button>
                    </div>
                </div>

                <?php
                // ------------------------------------------------------
                // SELECT APPOINTMENT DATE
                // ------------------------------------------------------ 
                ?>

                <div id="wizard-frame-2" class="wizard-frame" >
                    <div class="frame-container">




                        <div class="frame-content row">

                            <h4  style="color: #333; text-align: center;">Choisissez la date et l'heure de votre rendez-vous</h4>
                            <div class="col-md-5 col-sm-5 col-xs-6 col-xxs">
                                <br/> <div id="select-date"></div>
                            </div>

                              <div class="col-md-1 col-sm-1 "  ></div>



                            <div class="col-md-6 col-sm-6 col-xs-12 col-xxs "  >
                                <?php // Available hours are going to be fetched via ajax call.   ?>
             
                             <br/><button type="button" class="btn  btn-primary hours dropdown-toggle" data-toggle="dropdown" >heure du rendez-vous </button>
                              <ul id="available-hours" class="dropdown-menu option" role="menu"></ul>
                           </div>
                        </div>
                        <br/>
                        <div class="waiting-appointment">
                            <p class="ask-dispo"  ></p>

                        </div>
                    </div>

                    <div class="command-buttons">
                          <button class="waiting-appointment btn btn-primary" id="waiting-appointment" 
                                    type="button" data-toggle="modal" data-target="#waiting-modal"> Demander un rendez-vous&nbsp;&nbsp;<span class="glyphicon glyphicon-plus"></span></button>
                        <button type="button" id="button-back-2" class="btn button-back btn-primary"
                                data-step_index="2">
                            <span class="glyphicon glyphicon-backward"></span>
                            <?php echo $this->lang->line('back'); ?>
                        </button>
                        <button type="button" id="button-next-2" class="btn button-next btn-primary"
                                data-step_index="2">
                                    <?php echo $this->lang->line('next'); ?>
                            <span class="glyphicon glyphicon-forward"></span>
                        </button>
                    </div>
                </div>

                <?php
                // ------------------------------------------------------
                // ENTER CUSTOMER DATA
                // ------------------------------------------------------ 
                ?>



                <?php
                if (!$customer_data) {
                    ?>



                    <div id="wizard-frame-3" class="wizard-frame" style="display:none;">



                        <div class="ibox-content frame-container">
                            <div class="alert signup"></div>
                            <div class="frame-content row inscrit hidden ">
                                <h3 >Inscription</h3>

                                <div class="col-md-6 col-sm-6  col-sm-12">
                                    <div class="form-group">
                                        <label for="first-name" class=" hidden-xs control-label"><?php echo $this->lang->line('first_name'); ?> *</label>
                                        <input type="text" id="" name="first-name"  class=" first-name  form-control" maxlength="100" placeholder="Prénom" autofocus />
                                    </div>
                                    <div class="form-group">
                                        <label for="last-name" class=" hidden-xs control-label"><?php echo $this->lang->line('last_name'); ?> *</label>
                                        <input type="text" id="" name="last-name" class=" last-name form-control" placeholder="Nom"  maxlength="250" />
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class=" hidden-xs control-label"><?php echo $this->lang->line('email'); ?> *</label>
                                        <input type="text" id="" name="email" class="email  form-control" placeholder="Address email" maxlength="250" />
                                    </div>

                                    <div class="form-group">
                                        <label for="newpassword" class=" hidden-xs control-label"><?php echo $this->lang->line('password'); ?> *</label>
                                        <input type="password" id="" name="newpassword" class="password form-control" placeholder="Mot de passe"  maxlength="60"  />
                                    </div>

                                </div>

                                <div class="col-md-6 col-sm-6  col-sm-12">
                                    <div class="form-group">
                                        <label for="phone-number" class=" hidden-xs control-label"><?php echo $this->lang->line('phone_number'); ?> *</label>
                                        <input type="text" id="" name="phone-number" class=" phone-number  form-control"  placeholder="Téléphone"  maxlength="60"  />
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class=" hidden-xs control-label"><?php echo $this->lang->line('address'); ?>*</label>
                                        <input type="text" id="" name="address" class="address   form-control" placeholder="Address"  maxlength="250" />
                                    </div>

                                    <div class="form-group">
                                        <label for="city" class=" hidden-xs control-label"><?php echo $this->lang->line('city'); ?>*</label>
                                        <input type="text" id="" name="city" class="city  form-control" placeholder="Ville"  maxlength="120" />
                                    </div>
                                    <div class="form-group">
                                        <label for="zip-code" class="hidden-xs control-label"><?php echo $this->lang->line('zip_code'); ?>*</label>
                                        <input type="text" id="" name="zip-code" class=" zip-code  form-control" placeholder="Code postale"  maxlength="120" />
                                    </div>

                                    <input type="hidden" name="default-image"  id ="default-image" value="assets/img/default_image.jpg">

                                </div>

                            </div>

                                       

                            <div class="row update-address-phone-number frame-content  hidden"  >
                                <br/>
                                <div class="col-xs-offset-2 col-xs-8  col-xs-offset-2"><h3 > Compléter vos coordonnées avant de continuer</h3>
                                
                                    <form role="form" id="coordonnee">
                                    <div class="form-group">
                                        <label for="phone-number-fb" class="  control-label"><?php echo $this->lang->line('phone_number'); ?> *</label>
                                        <br/><input type="text" id="phone-number-fb" name="phone-number-fb" class="form-control"  placeholder="Téléphone"  maxlength="60"  />
                                    </div>

                                    <div class="form-group">
                                        <label for="address-fb" class="  control-label"><?php echo $this->lang->line('address'); ?> *</label>
                                        <input type="text" id="address-fb" name="address-fb" class="form-control"  placeholder="Addresse"    />
                                    </div>

                                    <div class="form-group">
                                        <label for="city-fb" class=" control-label"><?php echo $this->lang->line('city'); ?> *</label>
                                        <input type="text" id="city-fb" name="city-fb" class="form-control"  placeholder="Ville"    />
                                    </div>

                                    <div class="form-group">
                                        <label for="zip-code-fb" class=" control-label"><?php echo $this->lang->line('zip_code'); ?> *</label>
                                        <input type="text" id="zip-code-fb" name="zip-code-fb" class="form-control"  placeholder="Code postal"    />
                                    </div>


                                    </form>
                                </div>
                         
                            </div>
                       



                            <div class="row cnx-choice">
                                <br/>
                                <div class="col-sm-6 "><h3 >Connexion</h3>
                                    <p>Pour continuer,connectez vous à votre espace</p>
                                    <form role="form">
                                        <div class="form-group">         
                                            <i class="fa fa-user overlay"></i>
                                            <input type="text" placeholder="Email"  id="email-address" class="form-control text-input required">
                                        </div>
                                        <div class="form-group">
                                            <i class="fa fa-key overlay"></i>
                                            <input type="password" placeholder="Mot de passe" id="password-cnx"  class="form-control text-input required">
                                        </div>




                                    </form>
                              <br/><br/>     <button  style="font-size: 13px" class="btn btn-block btn-social btn-facebook" onclick="checkLoginState();">
    <span class="fa fa-facebook"></span> Connexion avec Facebook
  </button>
                                </div>
                                <div class="col-sm-6"><h3>Pas encore membre?</h3>
                                    <p>Inscrivez- vous maintenant</p>
                                    <p class="text-center">
                                        <span class="sign-up  "><i class="fa fa-sign-in fa-5x hidden-md  hidden-sm  hidden-lg visible-xs " style="color: #e5e6e7;"></i><i class="fa fa-sign-in visible-md visible-lg visible-sm hidden-xs  big-icon "></i></span>
                                        
                                    </p>
                                </div>

                            </div>
                            <div class="alert hidden"></div>
                        </div>


                        <div class="command-buttons">
                           <br/><button type="button" id="button-back-3" class="btn button-back btn-primary"
                                    data-step_index="3"><span class="glyphicon glyphicon-backward"></span>
                                        <?php echo $this->lang->line('back'); ?>
                            </button>
                            <button type="button" id="button-next-3" class="btn button-next btn-primary"
                                    data-step_index="3">
                                        <?php echo $this->lang->line('next'); ?>
                                <span class="glyphicon glyphicon-forward"></span>
                            </button>
                        </div>
                    </div>






                <?php }
                ?>
                <input type="hidden" id ="last-name">
                <input type="hidden" id ="first-name">
                <input type="hidden" id ="email">
                <input type="hidden" id ="phone-number">
                <input type="hidden" id ="address">
                <input type="hidden" id ="city">
                <input type="hidden" id ="zip-code">
                <input type="hidden" id ="idfacebook">
                <input type="hidden" id ="picture">


                <?php
                // ------------------------------------------------------
                // APPOINTMENT DATA CONFIRMATION
                // ------------------------------------------------------ 
                ?>

                <div id="wizard-frame-4" class="wizard-frame" style="display:none;">
                    <div class="frame-container">
                        <h3 class="frame-title"><?php echo $this->lang->line('step_four_title'); ?></h3>
                        <div class="frame-content row">
                             <br/><div class="confirmation-details col-md-12 col-sm-12 col-xs-12">
                            <div id="appointment-details" class="col-md-6 col-sm-6 col-xs-12"></div>
                            <div id="customer-details" class="col-md-6 col-sm-6 col-xs-12"></div>
                        </div>
                         </div>
                        <?php if ($this->settings_model->get_setting('require_captcha') === '1'): ?>
                            <div class="frame-content row">
                                <div class="col-md-6 col-sm-12">
                                    <h4 class="captcha-title">
                                        CAPTCHA
                                        <small class="glyphicon glyphicon-refresh"></small>
                                    </h4>
                                    <img class="captcha-image" src="<?php echo $this->config->item('base_url'); ?>/index.php/captcha">
                                    <input class="captcha-text" type="text" value="" />
                                    <span id="captcha-hint" class="help-block" style="opacity:0">&nbsp;</span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="command-buttons">
                        <button type="button" id="button-back-4" class="btn button-back btn-primary"
                                data-step_index="4">
                            <span class="glyphicon glyphicon-backward"></span>
                            <?php echo $this->lang->line('back'); ?>
                        </button>
                        <form id="book-appointment-form" style="display:inline-block" method="post">
                            <button id="book-appointment-submit" type="button" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok"></span>
                                <?php
                                echo (!$manage_mode) ? $this->lang->line('confirm') : $this->lang->line('update');
                                ?>
                            </button>
                            <input type="hidden" name="csrfToken" />
                            <input type="hidden" name="post_data" />
                        </form>
                    </div>
                </div>


            </div>

                <?php
                // ------------------------------------------------------
                // APPOINTMENT SUCCESS
                // ------------------------------------------------------ 
                ?>

                             <div id="success-frame" class="" style=" display: none;">


                <div class="col-xs-2 col-sm-2">
                    <img id="success-icon" class="pull-right" src="<?php echo $this->config->item('base_url'); ?>/assets/img/success.png" />
                </div>
                <div class="col-xs-10 col-sm-10">
                    <?php
                    echo '
                            <h3>' . $this->lang->line('appointment_registered') . '</h3>
                            <p>' . $this->lang->line('appointment_details_was_sent_to_you') . '</p>
                            
                        ';
                    /* <a  data-dismiss="modal" class="btn btn-success btn-large">
                      <span class="glyphicon glyphicon-calendar"></span>
                      ok
                      </a> */
                    if ($this->config->item('ea_google_sync_feature')) {
                        echo '
                                <button id="add-to-google-calendar" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    ' . $this->lang->line('add_to_google_calendar') . '
                                </button>';
                    }

                    // Display exceptions (if any).
                    if (isset($exceptions)) {
                        echo '<div class="col-xs-12" style="margin:10px">';
                        echo '<h4>Unexpected Errors</h4>';
                        foreach ($exceptions as $exc) {
                            echo exceptionToHtml($exc);
                        }
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>




        </div>
    </div>
</div>

<div class="modal fade" id="waiting-modal" role="dialog" style="z-index:100000 !important">
    <div class = "modal-dialog " >
        <div class = "modal-content" >
            <div class = "modal-header" style="background-color : #54debc " >
                <button type = "button" class = "close" data-dismiss = "modal" >&times;</button>
                <h3 class = "modal-title" style="text-align: center;  color: #fff;" > Envoie d'une demande liste d'attente </h3>
            </div>
            <div class = "modal-body" >
                <div id = "waiting-content" > </div>
            </div>
            <div class = "modal-footer" style="border-top: none;" >
                <button type = "button" class = "btn btn-primary "  style="background-color: #b02349;" id="waiting-confirm"> Envoyer </button>
                <button type = "button" class = " cancel-waiting btn btn-primary" style=" background-color: #23b08a;" data-dismiss = "modal" > Close </button>
            </div>
        </div>
    </div>
</div>



<?php /****************************************************/
/**************************Modal detail************************/
/*********************************************************/?>



<div id="detail-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
            <div class = "modal-header"  style="border: none; ">
       <button type="button" class="close" data-dismiss="modal">&times;</button></div>
      <div class="modal-body  detail-service-row">
        <div class="row">
     <div class="col-sm-5 col-md-5 image-service"></div>
        <div class="col-sm-6 col-md-6 description-service">
            <h3 class="service-title" style="color: #b02349"></h3>
              <h5 class="service-sous-title" ></h5><br/><br/>
             <p class="service-description" style="  text-justify: inter-word;">  </p>

        </div>
      </div>
      <div class="  row">
   <div class="command-button-reserver text-center"></div>
   </div>

    </div>

  </div>
</div>
</div>
