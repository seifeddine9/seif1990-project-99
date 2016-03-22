

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
        src="<?php echo $base_url; ?>assets/js/frontend_waiting.js"></script>
        
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


#tabs-waiting{
    display: table;
    width: 100%;
    margin: 40px auto;
    height: 40px;
    padding: 0px;
        background: linear-gradient(deepskyblue, #23b08a);
    background: -webkit-linear-gradient(deepskyblue, #23b08a);
    background:    -moz-linear-gradient(deepskyblue, #23b08a);
    background:     -ms-linear-gradient(deepskyblue,#23b08a);
    background:      -o-linear-gradient(deepskyblue, #23b08a);
    background:         linear-gradient(deepskyblue, #23b08a);
        background: #23b08a;
 border-radius: 3px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .3),
                0 3px 5px rgba(0, 0, 0, .2),
                0 5px 10px rgba(0, 0, 0, .2),
                0 20px 20px rgba(0, 0, 0, .15);
}
#tabs-waiting li{
    display: table-cell;
}
#tabs-waiting li a{
    display: block;
    text-align: center;
    color: rgba(0, 0, 0, .7); 
    text-decoration: none;
    padding: 8px 8px 17px 8px;
        text-shadow: 0 1px 0 rgba(255, 255, 255, .4);
 box-shadow: 0 1px 0 rgba(255, 255, 255, .7) inset, 
                0 -1px 0 #23b08a inset, 
                0 -2px 0 #23b08a inset, 
                0 -3px 0 #23b08a inset, 
                0 -4px 0 #23b08a inset, 
                0 -5px 0 #23b08a inset;
                    transition: padding .3s, background .3s;
    transition: all .3s .1s;
    position: relative;

}

#tabs-waiting li:first-child a{
    border-radius: 3px 0 0 3px;
}
#tabs-waiting li:last-child a{
    border-radius: 0 3px 3px 0;
}

#tabs-waiting li a:hover, 
#tabs-waiting li a:focus{
    background: #23b08a;
    box-shadow: 0 1px 0 #23b08a inset, 
                0 -1px 0 #23b08a inset, 
                0 -2px 0 #23b08a inset, 
                0 -3px 0 #23b08a inset, 
                0 -4px 0 #23b08a inset, 
                0 -5px 0 #23b08a inset; 
                    padding: 8px 25px 17px 25px;
    transition: padding .3s;
    transition: all .3s 0s;

} 
#tabs-waiting li a:active{
    background: linear-gradient(rgba(0,0,0,.2),rgba(0,0,0,.1)); 
    box-shadow: 0 0 2px rgba(0,0,0,.3) inset;
}



#tabs-waiting li a::before{
    content: '';
    position: absolute;
    left: 50%;
    bottom: 9px;
    margin-left: -2px;
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background: rgba(0, 0, 0, .5);
}
#tabs-waiting li a:hover::before,
#tabs-waiting li a:focus::before{
    background: white;
    box-shadow: 0 0 2px white, 
                0 -1px 0 rgba(0, 0, 0, .4);
}


       table  {
            width: 80% !important;
             margin-left: 4%;
         }
         #edit-waiting{
          background-color: #24AFA9;
        }
            #modal-info-waiting .modal-dialog
             {
                 width: 40%;
                 margin-top: 15%;
                 }

#edit-modal .modal-dialog{

 z-index: 000;

}

         </style>
            <script type="text/javascript">
       

        var EALang = <?php echo json_encode($this->lang->language); ?>;

        
    </script>
    </head>
<body class=""><div id="wrapper">    <header>
        <div id="topbar">
    
</div>            <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navigation">
                    <span class="icon-navicon"></span>
                </button>
               
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
                                    <hr>
                                    <li><a href="<?php echo  site_url('user/logout');?>"><i class="fa fa-sign-out"></i> Déconnexion</a>
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
    </nav>      </header>




<script type="text/javascript">
    var GlobalVariables = {
        'csrfToken': <?php echo json_encode($this->security->get_csrf_hash()); ?>,
        'availableProviders': <?php echo json_encode($available_providers); ?>,
        'availableServices' : <?php echo json_encode($available_services); ?>,
        'dateFormat'        : <?php echo json_encode($date_format); ?>,
        'baseUrl'           : <?php echo '"' . $base_url . '"'; ?>,
        'waiting'      : <?php echo json_encode($waitings); ?>,
        'manageMode'          : <?php echo ($manage_mode) ? 'true' : 'false'; ?>,
        'appointmentData'     : <?php echo json_encode($appointment_data); ?>,
        'providerData'        : <?php echo json_encode($provider_data); ?>,
        'customerData'       : <?php echo json_encode($customer_data); ?>,
        'googleApiKey'      : <?php echo '"' . Config::GOOGLE_API_KEY . '"'; ?>,
        'googleClientId'    : <?php echo '"' . Config::GOOGLE_CLIENT_ID . '"'; ?>,
        'googleApiScope'    : 'https://www.googleapis.com/auth/calendar',
        'AJAX_SUCCESS'     : 'SUCCESS',
        'AJAX_FAILURE'      : 'FAILURE'
    };

  $(document).ready(function() {
            FrontendWaiting.initialize(true, GlobalVariables.manageMode);
            

    });
</script>

<div class="container">
    <div class="container-fluid" id="customer-waiting">
        <div class="row-fluid no-appointment" style="display:none;">
            <br>
            <br>
            <br>
            <h5>
                <?php echo $this->lang->line('no_appointment'); ?>
            </h5>
        </div>
        <div class="row-fluid waiting-customer">
            <div class="col-md-12 list-waiting">
                <h3>
                    Ma liste d'attente
                </h3>
                <div id="my-waiting">

                      <ul id="tabs-waiting" >
                         <li><a href="#future-waiting"><strong>Future liste d'attente</strong></a></li>
                         <li><a href="#all-waiting"><strong>Toute la liste d'attente</strong></a></li>
                         <li><a href="#past-waiting"><strong> Liste attente Passés</strong></a></li>
                      </ul>


                     <div id= "future-waiting" class="display">

                            <table id="list-future-waiting" class="table table-striped " cellspacing="0" width="100%">
                            <thead><tr><th>Service</th><th>Prestation</th></tr>
                            </thead><tbody></tbody> </table>

                     </div>
      
                     <div id= "all-waiting" class="display">
                         <table id="list-waiting" class="table table-striped " cellspacing="0" width="100%">
                         <thead><tr><th>Service</th><th>Prestation</th></tr>
                         </thead><tbody></tbody> </table>

                     </div>
 
                     <div id= "past-waiting" class="display">
                         <table id="list-past-waiting" class="table table-striped " cellspacing="0" width="100%">
                         <thead><tr><th>Service</th><th>Prestation</th></tr>
                         </thead><tbody></tbody> </table>

                     </div>






                     </div>








                </div>
            </div>
          
             
            </div>
        </div>
    </div>
    
  
    </div>

 



<div id="modal-info-waiting" class="modal fade " role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Détail demande liste d'attente</h4>
      </div>
      <div class="modal-body" id="general-info">
       



      </div>
      <div class="modal-footer" id="button-command">
      </div>
    </div>

  </div>
</div>









  <?php /***************************************************************************************/
        /****************************************************************************************/?>
   <footer >
            <div class="container " >
                <div class="row" >
                    <div class="col-sm-4"  style="height:10%;">
                           <h4>Plan de site</h4>
                        <ul class="list-unstyled company-info">
                            <li><a href ="<?php echo $this->config->item('base_url'); ?>">Acceuil</a></li>
                            <li><a href="<?php echo  site_url('user/tarif');?>">Tarifs</a></li>
                            <li><a  href="<?php echo  site_url('user/services');?>">Nos services</a></li>
                            <li><a  href="<?php echo  site_url('user/company');?>">Notre agence</a></li>
                            <li><a  href="<?php echo  site_url('user/work_for_us');?>">Nous rejoindre</a></li>
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
                            <li><a href ="<javascript;">Femme de ménage</a></li>
                            <li><a href ="<javascript;">jardinage</a></li>
                            <li><a href ="<javascript;">coursier</a></li>
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
       
