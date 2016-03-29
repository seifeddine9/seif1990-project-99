

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Demo</title>  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">



        <?php // INCLUDE CSS FILES ?>


        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/css/general.css">

       <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/css/style_appointments.css">

        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/ext/sweetalert/sweetalert2.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/ext/pace/pace.css">  
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/ext/animate-css/animate.min.css">    
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/ext/iconmoon/style.css">

        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/ext/font-awesome/css/font-awesome.min.css">

        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/ext/nifty-modal/css/component.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/ext/magnific-popup/magnific-popup.css">



        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery-ui/jquery-ui.min.css">

        <!-- LESS FILE <link href="assets/css/style.less" rel="stylesheet/less" type="text/css" /> -->
        <!-- Extra CSS Libraries Start -->
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/ext/owl-carousel/owl.carousel.css">      
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/ext/owl-carousel/owl.theme.css">     
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/ext/owl-carousel/owl.transitions.css">    
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery-magnific/magnific-popup.css">   
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $this->config->item('base_url'); ?>assets/css/style.css">

        <script
            type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery/jquery.min.js"></script>   
        <script
            type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery-qtip/jquery.qtip.min.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.js"></script>

        <script
            type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>assets/ext/datejs/date.js"></script>
        <script
            type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery-ui/jquery-ui.min.js"></script>


    </script>
    <script type="text/javascript"
    src="<?php echo $base_url; ?>assets/js/frontend_book.js"></script>

    <script
        type="text/javascript"
    src="<?php echo $this->config->item('base_url'); ?>assets/js/frontend_book_success.js"></script>  


    <script
        type="text/javascript"
    src="<?php echo $this->config->item('base_url'); ?>assets/ext/datatables/datatables.min.js"></script>
    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>assets/ext/datatables/datatables.min.css">

    <!-- Extra CSS Libraries End -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
    

    @media (max-width: 380px){
#book-appointment-wizard #wizard-frame-2 .frame-container .frame-content {
    margin-left: 0% !important;
}}
</style>

    <script type="text/javascript">


        var EALang = <?php echo json_encode($this->lang->language); ?>;


    </script>
</head>
<body class="">

    <div id="wrapper">  

        <header>
        <div id="topbar"></div>          
  <nav class="navbar navbar-default" role="navigation">
        <div class="row">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header" style="margin-left: 5%;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navigation">
                    <span class="icon-navicon"></span>
                </button>
                   <a class="navbar-brand" href="<?php echo $this->config->item('base_url'); ?>">
                    <img src="<?php echo $this->config->item('base_url'); ?>assets/img/logo.png" data-dark-src="<?php echo $this->config->item('base_url'); ?>assets/img/logo.png" width="200" alt="Coco Frontend Template" class="logo">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="main-navigation">
                <ul class="nav navbar-nav navbar-right">
                                   
                    <li><a href="<?php  echo $this->config->item('base_url'); ?>" ><strong>Acceuil</strong></a></li>
                    <li><a href="<?php echo  site_url('user/company');?>" ><strong>Notre  agence</strong></a></li>
                    <li><a href="<?php echo  site_url('user/services');?>"><strong>Nos services</strong></a></li>
                    <li><a href="<?php echo  site_url('user/tarif');?>"><strong>Tarifs</strong></a></li>
                      <li><a href="<?php echo  site_url('user/work_for_us');?>"><strong>Nous rejoindre</strong></a></li>
                    
                     <?php if ($customer_data && $role_slug =="customer") {?>

                    <li id="logged-in">
                      <a href="#" class="" data-toggle="dropdown" >
                                  <strong><?php echo $customer_data['first_name']."&nbsp;&nbsp;".$customer_data['last_name'];?>
                                  </strong>
                                 <span class=" fa fa-angle-down"></span>

                      </a>
                          <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                     <?php $active = ($active_menu == PRIV_APPOINTMENTS) ? 'active' : ''; ?>
                                     <li class="<?php echo $active; ?>" ><a <a href="<?php echo $base_url; ?>index.php/home/appointments"><span> Mes Rendez-vous</span></a> </li>       
                                   
                                   <?php $active = ($active_menu == PRIV_PROFILE) ? 'active' : ''; ?>
                                    <li  class="<?php echo $active; ?>" > <a href="<?php echo $base_url; ?>index.php/home/profile"> <span>Mon Profile</span> </a> </li>
                                    
                                    <?php $active = ($active_menu == PRIV_WAITING) ? 'active' : ''; ?>
                                    <li  class="<?php echo $active; ?>" > <a href="<?php echo $base_url; ?>index.php/home/waiting"> <span>Liste d'attente</span> </a> </li>
                                    <li>
                                        <a href="javascript:;"><span>Aide</span></a>
                                    </li>
                                    <li><a href="<?php echo  site_url('user/logout');?>"><hr><i class="fa fa-sign-out pull-right"></i> Déconnexion</a>
                                    </li>
                                </ul>

                    </li>
                          <?php } 
                          else  if ($customer_data && $role_slug !="customer") { ?> 
                             
                                 <li ><a href="<?php echo  site_url('backend');?>"><strong>Backend</strong></a></li>
                       

                            <?php } else  
                              { ?>
                    <li id="not-logged-in"><a href="<?php echo  site_url('user/login');?>"><strong>Se connecter</strong></a></li>
                         <?php }?>


                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-->
    </nav>   
       </header>



        <script type="text/javascript">
            var GlobalVariables = {
                'csrfToken': <?php echo json_encode($this->security->get_csrf_hash()); ?>,
                'availableProviders': <?php echo json_encode($available_providers); ?>,
                'availableServices': <?php echo json_encode($available_services); ?>,
                'dateFormat': <?php echo json_encode($date_format); ?>,
                'baseUrl': <?php echo '"' . $base_url . '"'; ?>,
                'appointments': <?php echo json_encode($appointments); ?>,
                'manageMode': <?php echo ($manage_mode) ? 'true' : 'false'; ?>,
                'appointmentData': <?php echo json_encode($appointment_data); ?>,
                'providerData': <?php echo json_encode($provider_data); ?>,
                'customerData': <?php echo json_encode($customer_data); ?>,
                'googleApiKey': <?php echo '"' . Config::GOOGLE_API_KEY . '"'; ?>,
                'googleClientId': <?php echo '"' . Config::GOOGLE_CLIENT_ID . '"'; ?>,
                'googleApiScope': 'https://www.googleapis.com/auth/calendar',
                'AJAX_SUCCESS': 'SUCCESS',
                'AJAX_FAILURE': 'FAILURE'
            };

            $(document).ready(function () {
                FrontendBook.initialize(true, GlobalVariables.manageMode);


            });
        </script>

        <div class="container">
            <div class="container-fluid" id="customer-appointment">
                <div class="row-fluid no-appointment" style="display:none;">
                    <br>
                    <br>
                    <br>
                    <h5>
                        <?php echo $this->lang->line('no_appointment'); ?>
                    </h5>
                </div>
                <div class="row-fluid appointmnent-customer">
                    <div class="col-md-12 list-appointment">
                        <h3>
                            Mes Rendez-Vous
                        </h3>
                        <div id="my-appointments" >

                            <ul id="tabs-appointments" >
                                <li><a href="#future-appointments"><strong>Future Rendez-vous</strong></a></li>
                                <li><a href="#all-appointments"><strong>Tout les Rendez-vous</strong></a></li>
                                <li><a href="#past-appointments"><strong> Rendez-vous Passés</strong></a></li>
                            </ul>


                            <div id= "future-appointments" class="display ">

                                <table id="list-future-appointments" class="table table-striped  " cellspacing="0" >
                                    <thead><tr><th>Service</th><th>Prestation</th><th>Etat</th></tr>
                                    </thead><tbody></tbody>
                                     </table>

                            </div>

                            <div id= "all-appointments" class="display ">
                                <table id="list-appointments" class="table table-striped " cellspacing="0" >
                                    <thead><tr><th>Service</th><th>Prestation</th><th>Etat</th></tr>
                                    </thead><tbody></tbody> </table>

                            </div>

                            <div id= "past-appointments" class="display ">
                                <table id="list-past-appointments" class="table table-striped  " cellspacing="0" >
                                    <thead><tr><th>Service</th><th>Prestation</th><th>Etat</th></tr>
                                    </thead><tbody></tbody> </table>

                            </div>






                        </div>








                    </div>
                </div>


            </div>
        </div>
    </div>



 <div class="modal fade" id="edit-modal" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
           <div class="modal-header" style="border: none; background-color: #54debc;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title frame-title" style="text-align: center;  color: #fff;">Modifier un rendez-vous</h3>
      </div>


            <div id="book-appointment-wizard" class="">




                <?php
                // ------------------------------------------------------
                // CANCEL APPOINTMENT BUTTON
                // ------------------------------------------------------
                if ($manage_mode === TRUE) {
                    echo '
                            <div id="cancel-appointment-frame" class="row">
                                <div class="col-xs-12 col-sm-10">
                                    <p>' .
                    $this->lang->line('cancel_appointment_hint') .
                    '</p>
                                </div>
                                <div class="col-xs-12 col-sm-2">
                                    <form id="cancel-appointment-form" method="post"
                                            action="' . $this->config->item('base_url')
                    . '/index.php/appointments/cancel/' . $appointment_data['hash'] . '">
                                        <input type="hidden" name="csrfToken" value="' . $this->security->get_csrf_hash() . '" />
                                        <textarea name="cancel_reason" style="display:none"></textarea>
                                        <button id="cancel-appointment" class="btn btn-default">' .
                    $this->lang->line('cancel') . '</button>
                                    </form>
                                </div>
                            </div>';
                }
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

                <div id="wizard-frame-1" class="wizard-frame">
                    <div class="frame-container">
                        <h3 class="frame-title"><?php echo $this->lang->line('step_one_title'); ?></h3>

                        <div class="frame-content">
                            <div class="form-group">
                                <label for="select-service">
                                    <?php echo $this->lang->line('select_service'); ?>
                                </label>

                                <select id="select-service" class="col-md-4 form-control">
                                    <?php
                                    // Group services by category, only if there is at least one service
                                    // with a parent category.
                                    $has_category = FALSE;
                                    foreach ($available_services as $service) {
                                        if ($service['category_id'] != NULL) {
                                            $has_category = TRUE;
                                            break;
                                        }
                                    }

                                    if ($has_category) {
                                        $grouped_services = array();

                                        foreach ($available_services as $service) {
                                            if ($service['category_id'] != NULL) {
                                                if (!isset($grouped_services[$service['category_name']])) {
                                                    $grouped_services[$service['category_name']] = array();
                                                }

                                                $grouped_services[$service['category_name']][] = $service;
                                            }
                                        }

                                        // We need the uncategorized services at the end of the list so
                                        // we will use another iteration only for the uncategorized services.
                                        $grouped_services['uncategorized'] = array();
                                        foreach ($available_services as $service) {
                                            if ($service['category_id'] == NULL) {
                                                $grouped_services['uncategorized'][] = $service;
                                            }
                                        }

                                        foreach ($grouped_services as $key => $group) {
                                            $group_label = ($key != 'uncategorized') ? $group[0]['category_name'] : 'Uncategorized';

                                            if (count($group) > 0) {
                                                echo '<optgroup label="' . $group_label . '">';
                                                foreach ($group as $service) {
                                                    echo '<option value="' . $service['id'] . '">'
                                                    . $service['name'] . '</option>';
                                                }
                                                echo '</optgroup>';
                                            }
                                        }
                                    } else {
                                        foreach ($available_services as $service) {
                                            echo '<option value="' . $service['id'] . '">'
                                            . $service['name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

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
                                <label for="select-provider">
                                    <strong><?php echo $this->lang->line('select_provider'); ?></strong>
                                </label>

                                <select id="select-provider" class="col-md-4 form-control"></select>
                            </div>

                            <div id="service-description" style="display:none;"></div>
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

                <div id="wizard-frame-2" class="wizard-frame" style="display:none;">
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
                // APPOINTMENT DATA CONFIRMATION
                // ------------------------------------------------------ 
                ?>

                <div id="wizard-frame-3" class="wizard-frame" style="display:none;">
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
                                    <input class="captcha-text" type="text" value="" autofocus/>
                                    <span id="captcha-hint" class="help-block" style="opacity:0">&nbsp;</span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="command-buttons">
                        <button type="button" id="button-back-3" class="btn button-back btn-primary"
                                data-step_index="3">
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

                <?php
                // ------------------------------------------------------
                // FRAME FOOTER
                // ------------------------------------------------------ 
                ?>


            </div>
                             <div id="success-frame" class="" style=" display: none;">


                <div class="col-xs-2 col-sm-2">
                    <img id="success-icon" class="pull-right" src="<?php echo $this->config->item('base_url'); ?>assets/img/success.png" />
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





<div id="modal-info-appointment" class="modal fade " role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
                    <div class="modal-header" style="border: none; background-color: #54debc;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" style="text-align: center;  color: #fff;">Détail Rendez-vous</h3>
            </div>
            <div class="modal-body" id="general-info">




            </div>
            <div class="modal-footer" id="button-command" style="border: none; ">
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="waiting-modal" role="dialog" style="z-index:100000 !important">
    <div class = "modal-dialog " >
        <div class = "modal-content" >
                    <div class="modal-header" style="border: none; background-color: #54debc;">
                <button type = "button" class = "close" data-dismiss = "modal" >&times;</button>
                        <h4 class="modal-title" style="text-align: center;  color: #fff;">Envoie d une demande liste d attente </h4>
            </div>
            <div class = "modal-body" >
                <div id = "waiting-content" > </div>
            </div>
            <div class = "modal-footer" style="border: none; " >
                <button type = "button" class = "btn btn-primary"  id="waiting-confirm"> Envoyer </button>
                <button type = "button" class = "btn btn-primary" data-dismiss = "modal" > Close </button>
            </div>
        </div>
    </div>
</div>







<?php
/* * ************************************************************************************ */
/* * ************************************************************************************* */
?>
<footer >
    <div class="container " >
        <div class="row" >
            <div class="col-sm-4"  style="height:10%;">
                <h4>Plan de site</h4>
                <ul class="list-unstyled company-info">
                    <li><a href ="<?php echo $this->config->item('base_url'); ?>">Acceuil</a></li>
                    <li><a href="<?php echo site_url('user/tarif'); ?>">Tarifs</a></li>
                    <li><a  href="<?php echo site_url('user/services'); ?>">Nos services</a></li>
                    <li><a  href="<?php echo site_url('user/company'); ?>">Notre agence</a></li>
                    <li><a  href="<?php echo site_url('user/work_for_us'); ?>">Nous rejoindre</a></li>
                </ul>
            </div>


            <div class="col-sm-4" style="height:10%;">
                <h4>Contactez-nous</h4>
                <ul class="list-unstyled company-info">
                    <li><i class="icon-map-marker"></i> 65 Avenue Habib Bourguiba - B4 2080, Ariana TUNISIE</li>
                    <li><i class="icon-phone3"></i> +216 00 000 000</li>
                    <li><i class="icon-envelope"></i> <a href="mailto:contact@xyz.com">contact@xyz.com</a></li>
                    <li><i class="icon-alarm2"></i> Lundi - Vendredi: <strong>9:00 am - 6:00pm</strong></li>
                </ul>
            </div>

            <div class="col-sm-4 hidden-xs" style="height:10%;">
                <h4>Nos services</h4>
                <ul class="list-unstyled company-info">
                    <li><a href ="#">Femme de ménage</a></li>
                    <li><a href ="#">jardinage</a></li>
                    <li><a href ="#">coursier</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row"> 
            <div class="col-sm-6">
                <p>Copyright &copy; 2016 by <a href="http://www.mcube.tn" target="_blank">Mcube Technologies</a></p> 
            </div>

        </div>
    </div>
</footer>

</div>

<script>
            var resizefunc = [];
</script>







<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery-browser/jquery.browser.min.js"></script>   
<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/ext/fastclick/fastclick.js"></script>  
<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/ext/stellarjs/jquery.stellar.min.js"></script>
<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery-appear/jquery.appear.js"></script>  
<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/js/init.js"></script>  
<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/ext/owl-carousel/owl.carousel.min.js"></script>
<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery-magnific/jquery.magnific-popup.min.js"></script>
<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/js/pages/index.js"></script>
<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/ext/sweetalert/sweetalert2.min.js"></script>  


<script
    type="text/javascript"
src="<?php echo $this->config->item('base_url'); ?>assets/js/general_functions.js"></script>



<!-- Page Specific JS Libraries End -->
</body>
</html>

