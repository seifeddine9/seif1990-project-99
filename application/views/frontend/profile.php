
 <style>
section.wrapper{

      margin-left: 15%;
}


 .div-profile{

  width: 95% !important;
  height: 100%;
  background: #ffffff;
  position: relative;
  -webkit-transition: opacity 500ms ease-out;
  -moz-transition: opacity 500ms ease-out;
  -ms-transition: opacity 500ms ease-out;
  -o-transition: opacity 500ms ease-out;
  transition: opacity 500ms ease-out;


 }



 .profile-widget-info{
  border-top-right-radius: 2em;
    border-top-left-radius: 2em;
  
 }


.title-profile,
.info-mail,
.info-phone{
   color : #d3d3d3    !important;
}


.detailed-info
{
      margin-left: 15px;

}

.info-detail ,
.coord,
.password{

    display: none;
}


a{
  border: none !important;
}
.display-pic
 {display:inline-block;
  position:relative;
}
  #update-info ,
  #update-address {background-color: #FFF !important;
        border-color: #fff !important;
        color: #24AFA9;
      }
   #update-info:hover ,
  #update-address:hover {

    background-color: #23b08a !important;
        border-color: #23b08a !important;
        color: #fff;
      }


.btn-file {
    position: absolute;
    overflow: hidden;
    top: 70%;
    left: 0;
    bottom: 0;

}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
   
    font-size: 100px;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    cursor: inherit;
    display: block;
}
#add-adress{
  margin-left: 70%;
}
.photo-profile
{
  max-width: 150px;
  max-height: 150px;
  min-width: 150px;
  min-height: 150px;
}
.camera{
 background-color: transparent;
 border-radius: 28%;
 border: none;
}

.camera:hover{
 background-color: transparent !important;
 border-radius: 28%;
 border: none;
}
 i.overlay {
  position: absolute;
    left: 30px;
    top: 15px;
  color: #aaa;
}

 .text-input {
  padding-left: 30px;
  margin: 5px;
}
.col-xxxs h2 .nom{
 text-align: left;
}

@media (max-width: 600px) { 
   .col-xxs-hidden {
display: none;
   }
.col-xxxs h2 .nom{
 text-align: center;
}
.col-xxxs {
  width: 100%;
}

}
@media(max-width: 530px){
section.wrapper{

      margin-left: 0 ! important;
}
 .div-profile{

  width: 100% !important;

 }
}

/* Large desktops and laptops */
@media (min-width: 1200px) {
tr td:first-child{
  width: 20%;
  
 }
 tr td:last-child {
  width: 80%;
 }

}

/* Landscape tablets and medium desktops */
@media (min-width: 992px) and (max-width: 1199px) {

tr td:first-child{
  width: 25%;
  
 }
 tr td:last-child {
  width: 75%;
 }
}

/* Portrait tablets and small desktops */
@media (min-width: 768px) and (max-width: 991px) {

tr td:first-child{
  width: 35%;
  
 }
 tr td:last-child {
  width: 65%;
 }
}

/* Landscape phones and portrait tablets */
@media (max-width: 767px) {
tr td:first-child{
  width: 10%;
  
 }
 tr td:last-child {
  width: 90%;
 }
}



</style>
      
<script type="text/javascript"
        src="<?php echo $base_url; ?>assets/js/frontend_profile.js"></script>

<script type="text/javascript">
    var GlobalVariables = {

        'csrfToken': <?php echo json_encode($this->security->get_csrf_hash()); ?>,
         
        'baseUrl'           : <?php echo '"' . $base_url . '"'; ?>,
        'customer'      : <?php echo json_encode($customer_data); ?>,
        'AJAX_SUCCESS': 'SUCCESS',
        'AJAX_FAILURE': 'FAILURE'
        
    };
 var EALang = <?php echo json_encode($this->lang->language); ?>;

  $(document).ready(function() {
            FrontendProfile.initialize(true);

    });
  

 
</script>
               <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>assets/css/style1.css">

               
   <section  class="div-profile principale"> 
          <section class="wrapper">
		 
              <div class="row profile-header">
                <!-- profile-widget -->
                <div class="col-lg-11 col-sm-11 col-md-11 col-xs-12">
                    <div class="profile-widget profile-widget-info">
                          <div class="panel-body">
                            <div class="col-lg-3 col-sm-3 col-md-3 col-xs-5 col-xxxs">
                               
							 <div class="display-pic">
                    <img src="<?php echo $base_url.$customer_data['src_photo'];?>" class=" photo-profile img-thumbnail img-responsive" alt="photo profile"  />
                        <span class="btn btn-default btn-file camera">
                              <span class="fa fa-camera" style="font-size: 2.5em; color: #fff;" ></span>
                              <?php  $attributes = array('id' => 'myform'); ?>
                               <?php echo form_open_multipart('home/do_upload' , $attributes) ;?>
                             <input type="file" name="userfile"   id="File"/>
                             </form>
                         </span>
                 </div>
               </div>

                       <div class="col-lg-9 col-sm-9 col-md-9  col-xs-7 col-xxxs" >
                          <h2 style="color: #fff; " class ="nom"></h2>  
                        
                        <h4 style="color: #fff; text-align:left; padding: 5px;" class="col-xxs-hidden"><i class="fa fa-envelope" style=" color: #fff;" ></i>&nbsp;<span class ="mail"></span></h4>
                           <h4 style="color: #fff; text-align:left; padding: 5px;" class="col-xxs-hidden"><i class="fa fa-phone" style=" color: #fff;" ></i>&nbsp;<span class ="telephone"></span></h4>
                           <h4 style="color: #fff; text-align:left; padding: 5px;" class="col-xxs-hidden"><i class="fa fa-map-marker" style=" color: #fff;" ></i>&nbsp;<span class="address-principal"></span></h4>
                           </div>
                   
                            
                         
                          </div>
                    </div>
                </div>
              </div>
              <!-- page start-->
              <div class="row">
                 <div class="col-lg-11 col-sm-11 col-md-11 col-xs-12">
                    <section class="panel">
                          <header class="panel-heading tab-bg-info">
                              <ul class="nav nav-tabs">
                               
                                  <li class="edit active">
                                    
                                  </li>
                              </ul>
                          </header>
                       
                              <div class="tab-content">
                          
                                  <!-- edit-profile -->
                                 <div id="edit-profile" class="tab-pane active">
                                    <section class="panel">                                          
                                          <div class="panel-body bio-graph-info">

                                            <?php /*********************************General INFO ************

                                            ******************************************************************/?>

                                            <div class="col-md-12 col-sm-12 col-xs-12 info">
                                             
                                            <h5>
                                         
                                              INFORMATIONS GÉNÉRALES
                                              <button type="button" id="update-info" class="btn btn-primary"> <i class="fa fa-pencil"></i>Modifier</button>
                                            </h5>
                                            
                                            <hr>


                                                     <div class="table-responsive">
                                                        <table class="table table-borderless">
                                                              <thead>
                                                                  <tr> <th></th>
                                                                       <th></th>
                                                                 </tr>
                                                              </thead>
                                                            <tbody>
                                                                <tr>

                                                                    <td class="label-nom-prenom " ><span class="glyphicon glyphicon-user" style="font-size:1.5em;"></span>&nbsp;&nbsp;&nbsp;&nbsp; <span class="hidden-xs">Nom &
                                                              Prénom</span></td>
                                                                    <td class="nom" ></td>
                                                                </tr>
                                                                     <tr>

                                                                    <td class="label-mail" ><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="hidden-xs">Adresse email</span></td>
                                                                    <td  class="mail" ></td>
                                                                </tr>
                                                                    <tr>

                                                                    <td class="label-telephone" ><span class="glyphicon glyphicon-phone" style="font-size:1.5em;"></span> &nbsp;&nbsp;&nbsp;&nbsp;<span class="hidden-xs">Téléphone</span></td>
                                                                    <td class="telephone" ></td>
                                                                </tr>
                                                                  <tr>

                                                                    <td  class="label-mobile" ><span class="glyphicon glyphicon-phone" style="font-size:1.5em;"></span> &nbsp;&nbsp;&nbsp;&nbsp;<span class="hidden-xs">Téléphone 2</span></td>
                                                                    <td class="mobile" ></td>
                                                                </tr>
                                                              </tbody>
                                                           </table>


                                                     </div>


                                                     

                                                  <div class="col-md-12 col-sm-12 col-xs-12 ajout-tel">
                                                  <a href="javascript:" style="color: #33ceb2" class="ajout-input-phone"><i class="fa fa-plus" style="font-size:1.2em;"></i>&nbsp;&nbsp;Ajouter un autre téléphone mobile</a>
                                                    <div class="new-phone hidden">
                                                        <div class="col-xs-12  new-mobile-number ">
                                                             <i class="fa fa-phone overlay"></i><input class="form-control text-input"  id ="new-mobile-number" type="number" />
                                                         </div>
                                                                    <br>
                                                                 <br>
                                                                     
                                                           <div class="col-xs-12 text-center"> 
                                                            <button class=" save-update btn btn-success " id="save-new-mobile-number" type="button"> <i class="fa fa-floppy-o"></i>&nbsp;<span class="hidden-xs">Enregistrer</span></button>
                                                            <button class=" annuler btn btn-danger " id="canceal-update-new-phone" type="button">  <i class="fa fa-times"></i>&nbsp;<span class="hidden-xs">Annuler</span></button>
                                                            </div>



                                                    </div>
                                                  </div>
 
                                                
                                              </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12 edit-info hidden">
                                            <h5>INFORMATIONS GÉNÉRALES</h5><hr>
                                               

                                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <br/><div class="col-md-4 col-sm-4 col-xs-12 group-form">
                                                        <i class="fa fa-user overlay"></i> <input class="form-control text-input require" id ="last_name" type="text" required/>
                                                        </div>
                                               <div class="col-md-4 col-sm-4 col-xs-12 group-form">
                                                <i class="fa fa-user overlay"></i><input class="form-control text-input require"  id ="first_name" type="text" required/>
                                                   </div><br/><br/><br/>
                                                        <div class="col-md-8 col-sm-8 col-xs-12 group-form">
                                                          <i class="fa fa-envelope overlay"></i><input class="form-control text-input require" id ="email" type="email" required/>
                                                          </div><br/><br/><br/>
                                                               <div class="col-md-8 col-sm-8 col-xs-12 group-form">
                                                         <i class="fa fa-phone overlay"></i><input class="form-control text-input require"  id ="phone-number" type="number" required/>
                                                            </div><br/><br/><br/> 
                                                       <div class="col-md-8 col-sm-8 col-xs-12  hidden mobile-number">
                                                             <i class="fa fa-phone overlay"></i><input class="form-control text-input"  id ="mobile-number" type="number" />
                                                         </div>
                                                                  
                                                                    
                                                           <div class="col-xs-12 text-center"> 
                                                            <button class=" save-update btn btn-success " id="save-update" type="button">  <i class="fa fa-floppy-o"></i>&nbsp;<span class="hidden-xs">Enregistrer</span></button>
                                                            <button class=" annuler btn btn-danger " id="canceal-update-info" type="button"> <i class="fa fa-times"></i>&nbsp;<span class="hidden-xs">Annuler</span></button>
                                                            </div>
                                                     </div>

                                                
                                              </div>

        

                                            <?php /*********************************COORDONNEE ************

                                            ******************************************************************/?>
                      
                                     <div class="col-md-12 col-sm-12 col-xs-12 info-address">
                                      <br/>
                                              <h5>COORDONNEES <button type="button" id="update-address" class="btn btn-primary"> <i class="fa fa-pencil"></i>Modifier</button>
                                               </h5>
                                                <hr>
                                                 
                                                  
                                        

                                                               <div class="table-responsive">
                                                        <table class="table table-borderless">
                                                              <thead>
                                                                  <tr> <th></th>
                                                                       <th></th>
                                                                 </tr>
                                                              </thead>
                                                            <tbody>
                                                                <tr>

                                                                    <td  class="label-address-principal" ><span class="glyphicon glyphicon-map-marker" style="font-size:1.5em;"></span>&nbsp;&nbsp;&nbsp;<span class="hidden-xs">Addresse Principal</span></span></td>
                                                                    <td class="address-principal" ></td>
                                                                </tr>
                                                                     <tr>

                                                                    <td class="label-address-secondaire" ><span class="glyphicon glyphicon-map-marker" style="font-size:1.5em;"></span>&nbsp;&nbsp;&nbsp;<span class="hidden-xs">Addresse Secondaire</span></span></td>
                                                                    <td  class="address-secondaire" ></td>
                                                                </tr>
                                                           

                                                              </tbody>
                                                           </table>


                                                     </div>

                                                    <div class="col-md-12 col-sm-12 col-xs-12 ajout-address">
                                                  <a href="javascript:" style="color: #33ceb2" class="ajout-input-address"><i class="fa fa-plus" style="font-size:1.2em;"></i>&nbsp;&nbsp;Ajouter une autre address</a>
                                                    <div class="ajout-new-address hidden">
                                                        <div class="col-xs-12 group-form">
                                                        <i class="glyphicon glyphicon-map-marker overlay"></i> <input class="form-control text-input " placeholder ="addresse" id ="new-address2" type="text" />
                                                        </div>
                                               <div class="col-xs-12 group-form">
                                                <input class="form-control text-input"  id ="new-city2" placeholder ="ville" type="text" />
                                                   </div>
                                                   <div class="col-xs-12 group-form">
                                               <input class="form-control text-input"  id ="new-zip_code2" placeholder ="code postal" type="text" />
                                                   </div>
                                                      <div class="col-xs-12 text-center"> 
                                                  <br/><br/>
                                                            <button class=" save-update btn btn-success " id="save-update-new-address" type="button"> <i class="fa fa-floppy-o"></i>&nbsp;<span class="hidden-xs">Enregistrer</span></button>
                                                            <button class=" annuler btn btn-danger " id="canceal-update-new-address" type="button">  <i class="fa fa-times"></i>&nbsp;<span class="hidden-xs">Annuler</span></button>
                                                            </div>
                                                    </div>
                                                  </div>

                                     </div>         

                                      <div class="col-md-12 col-sm-12 col-xs-12 edit-info-address hidden">
                                        <br/>    
                                             <h5>COORDONNEES</h5><hr>
                                               <div class="address1">
                                                <div class="col-xs-12 group-form">
                                                        <i class="glyphicon glyphicon-map-marker overlay"></i> <input class="form-control text-input " id ="address" type="text" />
                                                        </div>
                                               <div class="col-xs-12 group-form">
                                                <input class="form-control text-input "  id ="city" type="text" />
                                                   </div>
                                                   <div class="col-xs-12 group-form">
                                               <input class="form-control text-input "  id ="zip_code" type="text" />
                                                   </div>
                                             </div>
                                                
                                              <div class="address2 hidden">
                                                 <br/> <br/>
                                                <div class="col-xs-12 group-form">
                                                        <i class="glyphicon glyphicon-map-marker overlay"></i> <input class="form-control text-input " id ="address2" type="text" />
                                                        </div>
                                               <div class="col-xs-12 group-form">
                                                <input class="form-control text-input"  id ="city2" type="text" />
                                                   </div>
                                                   <div class="col-xs-12 group-form">
                                               <input class="form-control text-input"  id ="zip_code2" type="text" />
                                                   </div>
                                             </div>
                                                <div class="col-xs-12 text-center"> 
                                                  <br/><br/>
                                                            <button class=" save-update btn btn-success " id="save-update-address" type="button"> <i class="fa fa-floppy-o"></i>&nbsp;<span class="hidden-xs">Enregistrer</span></button>
                                                            <button class=" annuler btn btn-danger " id="canceal-update-address" type="button">   <i class="fa fa-times"></i>&nbsp;<span class="hidden-xs">Annuler</span></button>
                                                 </div>

                                     </div>



                                         <?php /*********************************MOt de pass************

                                            ******************************************************************/?>



                                    <div class="col-md-12 col-sm-12 col-xs-12 edit-password" ><br/><br/>
                                            <h5>MODIFIER MOT DE PASSE</h5><hr>
                                               

                                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                                         <form id="edit-mdp" role="form">
                                                           <div class ="alert alert-danger " >
                                                            <span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Ancien Mot de passe erroné
                                                                </div>
                                                           <div class =" alert alert-success " ><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;Mot de passe enregistré avec succes</div>

                                                       
                                                        <div class="col-xs-12 group-form form-group">
                                                          <i class="fa fa-key overlay"></i> 
                                                          <input type="password" placeholder="ancien mot de passe" class="form-control text-input required" id="old-password"  />
                                                          </div>
                                                               <div class="col-xs-12  group-form form-group">
                                                         <i class="fa fa-key overlay"></i>
                                                              <input type="password" class="form-control text-input required" placeholder="nouveau mot de passe" id="new-password"   />
                                                            </div><br>
                                                               <br>
                                                     

                                                                   <div class="col-xs-12 text-center"> 

                                                          <button type="button" id="save-new-password" class="btn btn-primary "><i class="fa fa-floppy-o"></i>&nbsp;<span class="hidden-xs">Enregistrer</span></button>
                                                            <button class=" annuler btn btn-danger " id="canceal-update-password" type="button">   <i class="fa fa-times"></i>&nbsp;<span class="hidden-xs">Annuler</span></button>
                                                            </div>
                                                         </form>

                                                     </div>

                                                
                                              </div>








                                      </section>
                                  </div>
								  <!--fin edit profile-->
                              </div>
               
                      </section>
                 </div>
              </div>

              <!-- page end-->
          </section>
      </section>
	  <!--main content end-->
	 