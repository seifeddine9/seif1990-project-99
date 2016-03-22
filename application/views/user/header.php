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
            href="<?php echo $this->config->item('base_url'); ?>assets/ext/bootstrap/css/bootstrap.min.css">



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
        src="<?php echo $this->config->item('base_url'); ?>assets/ext/sweetalert/sweetalert2.min.js"></script>  

        <script
            type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery/jquery.min.js"></script>   
        <script
            type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>assets/js/init.js"></script>  
        <script
            type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery-qtip/jquery.qtip.min.js"></script>

        <script
            type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>assets/ext/datejs/date.js"></script>
        <script
            type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>assets/ext/jquery-ui/jquery-ui.min.js"></script>

        <!-- Extra CSS Libraries End -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style type="text/css">

        </style>
        <script type="text/javascript">


            var EALang = <?php echo json_encode($this->lang->language); ?>;


        </script>
    </head>
    <body class=""><div id="wrapper">  <header>
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

                                <li><a href="<?php echo $this->config->item('base_url'); ?>" ><strong>Acceuil</strong></a></li>
                                <li><a href="<?php echo site_url('user/company'); ?>" ><strong>Notre  agence</strong></a></li>
                                <li><a href="<?php echo site_url('user/services'); ?>"><strong>Nos services</strong></a></li>
                                <li><a href="<?php echo site_url('user/tarif'); ?>"><strong>Tarifs</strong></a></li>
                                <li><a href="<?php echo site_url('user/work_for_us'); ?>"><strong>Nous rejoindre</strong></a></li>

                                <?php if ($customer_data && $role_slug == "customer") { ?>

                                    <li id="logged-in">
                                        <a href="#" class="" data-toggle="dropdown" >
                                            <strong><?php echo $customer_data['first_name'] . "&nbsp;&nbsp;" . $customer_data['last_name']; ?>
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
                                            <li><a href="<?php echo site_url('user/logout'); ?>"><hr><i class="fa fa-sign-out pull-right"></i> Déconnexion</a>
                                            </li>
                                        </ul>

                                    </li>
                                <?php } else if ($customer_data && $role_slug != "customer") {
                                    ?> 

                                    <li ><a href="<?php echo site_url('backend'); ?>"><strong>Backend</strong></a></li>


                                <?php } else {
                                    ?>
                                    <li id="not-logged-in"><a href="<?php echo site_url('user/login'); ?>"><strong>Se connecter</strong></a></li>
                                    <?php } ?>


                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container-->
                </nav>      </header>