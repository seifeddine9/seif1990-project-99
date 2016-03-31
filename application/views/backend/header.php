<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $company_name; ?> | www.mesrendezvous.com</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">





        <link rel="icon" type="image/x-icon"
              href="<?php echo $base_url; ?>/assets/img/favicon.ico">

        <script type="text/javascript"
        src="<?php echo $base_url; ?>/assets/js/backend_header.js"></script>	



        <!-- Bootstrap Core CSS -->
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $base_url; ?>/assets/ext/bootstrap_admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">




        <!-- Custom CSS -->
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $base_url; ?>/assets/ext/bootstrap_admin/dist/css/sb-admin-2.css" rel="stylesheet">



        <!-- Custom Fonts -->
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $base_url; ?>/assets/ext/bootstrap_admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">






        <?php
        // ------------------------------------------------------------
        // INCLUDE CSS FILES
        // ------------------------------------------------------------ 
        ?>

        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $base_url; ?>/assets/ext/jquery-ui/jquery-ui.min.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $base_url; ?>/assets/ext/jquery-qtip/jquery.qtip.min.css">
        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $base_url; ?>/assets/ext/jquery-jscrollpane/jquery.jscrollpane.css">

        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $base_url; ?>/assets/css/backend.css">

        <link
            rel="stylesheet"
            type="text/css"
            href="<?php echo $base_url; ?>/assets/css/general.css">

        <?php
        // ------------------------------------------------------------
        // INCLUDE JAVASCRIPT FILES
        // ------------------------------------------------------------ 
        ?>
        <script
            type="text/javascript"
        src="<?php echo $base_url; ?>/assets/ext/jquery/jquery.min.js"></script>
        <script
            type="text/javascript"
        src="<?php echo $base_url; ?>/assets/ext/jquery-ui/jquery-ui.min.js"></script>
        <script
            type="text/javascript"
        src="<?php echo $base_url; ?>/assets/ext/jquery-qtip/jquery.qtip.min.js"></script>
        <script
            type="text/javascript"
        src="<?php echo $base_url; ?>/assets/ext/bootstrap/js/bootstrap.min.js"></script>
        <script
            type="text/javascript"
        src="<?php echo $base_url; ?>/assets/ext/datejs/date.js"></script>
        <script
            type="text/javascript"
        src="<?php echo $base_url; ?>/assets/ext/jquery-jscrollpane/jquery.jscrollpane.min.js"></script>
        <script
            type="text/javascript"
        src="<?php echo $base_url; ?>/assets/ext/jquery-mousewheel/jquery.mousewheel.js"></script>

        <script type="text/javascript">
            // Global JavaScript Variables - Used in all backend pages.
            var availableLanguages = <?php echo json_encode($this->config->item('available_languages')); ?>;
            var EALang = <?php echo json_encode($this->lang->language); ?>;

            $(document).ready(function () {
                BackendHeader.initialize(true);

            });

        </script>
    </head>

    <body>





        <div id="header">

            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="container-fluid">



                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo $base_url; ?>/index.php/backend"><?php echo $company_name; ?></a>
                    </div>


                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                        <ul class="nav navbar-nav navbar-right">

                            <li>
                                <?php
                                // CALENDAR MENU ITEM
                                // ------------------------------------------------------ 
                                ?>
                                <?php $hidden = ($privileges[PRIV_APPOINTMENTS]['view'] == TRUE) ? '' : 'hidden'; ?>
                                <?php $active = ($active_menu == PRIV_APPOINTMENTS) ? 'active' : ''; ?>
                                <a href="<?php echo $base_url; ?>/index.php/backend" class="menu-item <?php echo $hidden; ?><?php echo $active; ?>"
                                   title="<?php echo $this->lang->line('manage_appointment_record_hint'); ?>">
                                       <?php echo $this->lang->line('calendar'); ?>
                                </a>
                            </li>

                            <li>
                                <?php
                                // CUSTOMERS MENU ITEM
                                // ------------------------------------------------------ 
                                ?>
                                <?php $hidden = ($privileges[PRIV_CUSTOMERS]['view'] == TRUE) ? '' : 'hidden'; ?>
                                <?php $active = ($active_menu == PRIV_CUSTOMERS) ? 'active' : ''; ?>
                                <a href="<?php echo $base_url; ?>/index.php/backend/customers" class="menu-item <?php echo $hidden; ?><?php echo $active; ?>"
                                   title="<?php echo $this->lang->line('manage_customers_hint'); ?>">
                                       <?php echo $this->lang->line('customers'); ?>
                                </a>				
                            </li>


                            <li>
                                <?php
                                // SERVICES MENU ITEM
// ------------------------------------------------------ 
                                ?>
                                <?php $hidden = ($privileges[PRIV_SERVICES]['view'] == TRUE) ? '' : 'hidden'; ?>
                                <?php $active = ($active_menu == PRIV_SERVICES) ? 'active' : ''; ?>
                                <a href="<?php echo $base_url; ?>/index.php/backend/services" class="menu-item <?php echo $hidden; ?><?php echo $active; ?>"
                                   title="<?php echo $this->lang->line('manage_services_hint'); ?>">
                                       <?php echo $this->lang->line('services'); ?>
                                </a>
                            </li>


                            <li>
                                <?php
                                // DASHBOARD MENU ITEM
                                // ------------------------------------------------------ 
                                ?>
                                <?php $hidden = ($privileges[PRIV_DASHBOARD]['view'] == TRUE) ? '' : 'hidden'; ?>
                                <?php $active = ($active_menu == PRIV_DASHBOARD) ? 'active' : ''; ?>
                                <a href="<?php echo $base_url; ?>/index.php/backend/dashboard" class="menu-item <?php echo $hidden; ?><?php echo $active; ?>"
                                   title="<?php echo $this->lang->line('manage_dashboard_hint'); ?>">
                                       <?php echo $this->lang->line('dashboard'); ?>
                                </a>
                            </li>


                            <li>
                                <?php
                                // USERS MENU ITEM
                                // ------------------------------------------------------ 
                                ?>
                                <?php $hidden = ($privileges[PRIV_USERS]['view'] == TRUE) ? '' : 'hidden'; ?>
                                <?php $active = ($active_menu == PRIV_USERS) ? 'active' : ''; ?>
                                <a href="<?php echo $base_url; ?>/index.php/backend/users" class="menu-item <?php echo $hidden; ?><?php echo $active; ?>"
                                   title="<?php echo $this->lang->line('manage_users_hint'); ?>">
                                       <?php echo $this->lang->line('users'); ?>
                                </a>
                            </li>



                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-alerts">

                                    <li id="notification_results">

                                    </li>
                                    <li class="divider"></li>                       
                                    <li>
                                        <a class="text-center" href="#">
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                                <!-- /.dropdown-alerts -->
                            </li>
                            <!-- /.dropdown -->



                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                    </li>

                                    <?php $hidden = ($privileges[PRIV_SYSTEM_SETTINGS]['view'] == TRUE || $privileges[PRIV_USER_SETTINGS]['view'] == TRUE) ? '' : 'hidden';
                                    ?>
                                    <?php $active = ($active_menu == PRIV_SYSTEM_SETTINGS) ? 'active' : ''; ?>

                                    <li><a href="<?php echo $base_url; ?>/index.php/backend/settings" class="menu-item <?php echo $hidden; ?><?php echo $active; ?>"
                                           title="<?php echo $this->lang->line('settings_hint'); ?>"><i class="fa fa-gear fa-fw"></i><?php echo $this->lang->line('settings'); ?></a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo $base_url; ?>/index.php/user/logout" class="menu-item"
                                           title="<?php echo $this->lang->line('log_out_hint'); ?>"><i class="fa fa-sign-out fa-fw"></i><?php echo $this->lang->line('log_out'); ?></a>
                                    </li>
                                </ul>
                                <!-- /.dropdown-user -->
                            </li>

                        </ul>



                    </div>
                </div>

                <div id="notification" style="display: none;"></div>


                <div id="loading" style="display: none;">
                    <img src="<?php echo $base_url; ?>/assets/img/loading.gif" />
                </div>



        </div>
    </div>
