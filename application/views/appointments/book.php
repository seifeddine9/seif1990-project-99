<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#35A768">
    <title><?php echo $this->lang->line('page_title') . ' ' .  $company_name; ?></title>

    <?php
        // ------------------------------------------------------------
        // INCLUDE CSS FILES
        // ------------------------------------------------------------ ?>

    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>/assets/ext/bootstrap/css/bootstrap.min.css">
    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>/assets/ext/jquery-ui/jquery-ui.min.css">
    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>/assets/ext/jquery-qtip/jquery.qtip.min.css">
    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>/assets/css/frontend.css">
    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>/assets/css/general.css">

    <?php
        // ------------------------------------------------------------
        // INCLUDE JAVASCRIPT FILES
        // ------------------------------------------------------------ ?>

    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/ext/jquery/jquery.min.js"></script>
    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/ext/jquery-ui/jquery-ui.min.js"></script>
    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/ext/jquery-qtip/jquery.qtip.min.js"></script>
    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/ext/bootstrap/js/bootstrap.min.js"></script>
    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/ext/datejs/date.js"></script>
    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/js/frontend_book_link.js"></script>

    <?php
        // ------------------------------------------------------------
        // WEBPAGE FAVICON
        // ------------------------------------------------------------ ?>

    <link rel="icon" type="image/x-icon"
            href="<?php echo $this->config->item('base_url'); ?>/assets/img/favicon.ico">

    <link rel="icon" sizes="192x192"
            href="<?php echo $this->config->item('base_url'); ?>/assets/img/logo.png">

    <?php
        // ------------------------------------------------------------
        // VIEW FILE JAVASCRIPT CODE
        // ------------------------------------------------------------ ?>

    <script type="text/javascript">
        var GlobalVariables = {
            availableServices   : <?php echo json_encode($available_services); ?>,
            availableProviders  : <?php echo json_encode($available_providers); ?>,
            baseUrl             : <?php echo '"' . $this->config->item('base_url') . '"'; ?>,
            manageMode          : <?php echo ($manage_mode) ? 'true' : 'false'; ?>,
            dateFormat          : <?php echo json_encode($date_format); ?>,
            appointmentData     : <?php echo json_encode($appointment_data); ?>,
            providerData        : <?php echo json_encode($provider_data); ?>,
            customerData        : <?php echo json_encode($customer_data); ?>,
            user_id        : <?php echo '"' . $user_id . '"'; ?>,

            csrfToken           : <?php echo json_encode($this->security->get_csrf_hash()); ?>
        };

        var EALang = <?php echo json_encode($this->lang->language); ?>;
        var availableLanguages = <?php echo json_encode($this->config->item('available_languages')); ?>;

        $(document).ready(function() {
            FrontendBookLink.initialize(true, GlobalVariables.manageMode);
            // GeneralFunctions.centerElementOnPage($('#book-appointment-wizard'));
            GeneralFunctions.enableLanguageSelection($('#select-language'));
        });
    </script>
</head>

<body>
    <div id="main" class="container">
        <div class="wrapper row">
            <div id="book-appointment-wizard" class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">

                <?php
                    // ------------------------------------------------------
                    // FRAME TOP BAR
                    // ------------------------------------------------------ ?>

                <div id="header">
                    <span id="company-name"><?php echo $company_name; ?></span>

                    <div id="steps">
                        <div id="step-1" class="book-step active-step" title="<?php echo $this->lang->line('step_one_title'); ?>">
                            <strong>1</strong>
                        </div>

                        <div id="step-2" class="book-step" title="<?php echo $this->lang->line('step_two_title'); ?>">
                            <strong>2</strong>
                        </div>
                        <div id="step-3" class="book-step" title="<?php echo $this->lang->line('step_three_title'); ?>">
                            <strong>3</strong>
                        </div>
                        <div id="step-4" class="book-step" title="<?php echo $this->lang->line('step_four_title'); ?>">
                            <strong>4</strong>
                        </div>
                    </div>
                </div>

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
                                        <button id="cancel-appointment" class="btn btn-primary">' .
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
                        foreach($exceptions as $exception) {
                            echo exceptionToHtml($exception);
                        }
                        echo '</div>';
                    }
                ?>

                <?php
                    // ------------------------------------------------------
                    // SELECT SERVICE AND PROVIDER
                    // ------------------------------------------------------ ?>

                <div id="wizard-frame-1" class="wizard-frame">
                    <div class="frame-container">
                        <h3 class="frame-title"><?php echo $this->lang->line('step_one_title'); ?></h3>

                        <div class="frame-content">
                            <div class="form-group">
                                <label for="select-service">
                                    <strong><?php echo $this->lang->line('select_service'); ?></strong>
                                </label>

                                <select id="select-service" class="col-md-4 form-control">
                                    <?php
                                        // Group services by category, only if there is at least one service
                                        // with a parent category.
                                        $has_category = FALSE;
                                        foreach($available_services as $service) {
                                            if ($service['category_id'] != NULL) {
                                                $has_category = TRUE;
                                                break;
                                            }
                                        }

                                        if ($has_category) {
                                            $grouped_services = array();

                                            foreach($available_services as $service) {
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
                                            foreach($available_services as $service) {
                                                if ($service['category_id'] == NULL) {
                                                    $grouped_services['uncategorized'][] = $service;
                                                }
                                            }

                                            foreach($grouped_services as $key => $group) {
                                                $group_label = ($key != 'uncategorized')
                                                        ? $group[0]['category_name'] : 'Uncategorized';

                                                if (count($group) > 0) {
                                                    echo '<optgroup label="' . $group_label . '">';
                                                    foreach($group as $service) {
                                                        echo '<option value="' . $service['id'] . '">'
                                                            . $service['name'] . '</option>';
                                                    }
                                                    echo '</optgroup>';
                                                }
                                            }
                                        }  else {
                                            foreach($available_services as $service) {
                                                echo '<option value="' . $service['id'] . '">'
                                                            . $service['name'] . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
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
                    // ------------------------------------------------------ ?>

                <div id="wizard-frame-2" class="wizard-frame" style="display:none;">
                    <div class="frame-container">

                        <h3 class="frame-title"><?php echo $this->lang->line('step_two_title'); ?></h3>

                        <div class="frame-content row">
                            <div class="col-md-6 col-sm-6 col-xs-6 ">
                                <br/> <div id="select-date"></div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <?php // Available hours are going to be fetched via ajax call.   ?>
                                <br/><div id="available-hours"></div>
                            </div>
                        </div>
                    </div>

                    <div class="command-buttons">
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
                    // ------------------------------------------------------ ?>

 
                <?php
                if (!$user_id) {
                    ?>



                    <div id="wizard-frame-3" class="wizard-frame" style="display:none;">



                        <div class="ibox-content frame-container">
                                          <div class="alert signup"></div>



                            <div class="row cnx-choice">
                                <br/>
                                <div class="col-sm-6 "><h3 > Connexion</h3>
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
                                </div>
                         
                            </div>
                            <div class="alert hidden"></div>
                        </div>


                        <div class="command-buttons">
                            <button type="button" id="button-back-3" class="btn button-back btn-primary"
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


                <?php
                    // ------------------------------------------------------
                    // APPOINTMENT DATA CONFIRMATION
                    // ------------------------------------------------------ ?>

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
                                    echo (!$manage_mode) ? $this->lang->line('confirm')
                                            : $this->lang->line('update');
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
                    // ------------------------------------------------------ ?>

                <div id="frame-footer">
                    Powered By
                    <a href="http://mcube.tn" target="_blank"><strong>Mcube Technologies</strong></a>
                    
                </div>
            </div>
        </div>
    </div>

    <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>/assets/js/general_functions.js"></script>

    <?php google_analytics_script(); ?>
</body>
</html>
