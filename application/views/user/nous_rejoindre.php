  
          <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>assets/js/frontend_Apply.js"></script>   

  
   

<style type="text/css">


.col-md-offset-7 {
     margin-left: 0 !important; 
}
.form-apply{
      width: 85%;
}

 i.overlay {
  position: absolute;
  left: 20px;
  top: 10px;
  color: #aaa;
}
 .post-input {
  position: relative;
}
 .text-input {
  padding-left: 30px;
}
.detail-description{

margin-left: 25px;

}
.foo {
  
    position: relative;
    width: 150px;
   
    cursor: pointer;
    border: 0;
    border-radius: 5px;
    outline: none !important;
}
.foo:hover:after {
    background: #666666;
}
.foo:after {
    transition: 200ms all ease;
    border-bottom: solid rgba(0,0,0,.2);
    background: #24AFA9;
    text-align: center;
    color: #fff;
    
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: block;
    content: 'joindre votre CV';
    line-height: 30px;
    border-radius: 5px;
}
.error:after {
   
    background: red !important;
   
    content: 'fichier erroné' !important;
}
.boutton-command{

  margin-top: 25px;
}
@media (max-width: 380px) {
.fileR{
  width: 100%;
}

}
@media (max-width: 500px) {
#contactForm{
  margin-right: -60px;
}

}

#progress{
    width: 240px;
margin-top: -20px;
}
progress{
    display: inline-block;
    -moz-box-sizing: border-box;
         box-sizing: border-box;
    width: 300px;
    height: 20px;
    padding: 3px 3px 2px 3px;
    background: #23b08a; 
    background: -webkit-linear-gradient(#2d2d2d,#444);
    background:    -moz-linear-gradient(#2d2d2d,#444);
    background:      -o-linear-gradient(#2d2d2d,#444);
    background:         linear-gradient(#2d2d2d,#444);
    border: 1px solid rgba(0,0,0,.5);
    border-radius: 15px;
    box-shadow: 0 1px 0 rgba(255,255,255,.2);   
}
progress::-moz-progress-bar{
    border-radius:10px;
    background: #09c;
    background: 
      -moz-repeating-linear-gradient(
        45deg, 
        rgba(255,255,255,.2) 0,
        rgba(255,255,255,.2) 10px, 
        rgba(255,255,255,0) 10px,
        rgba(255,255,255,0) 20px
      ),
      -moz-linear-gradient(
        rgba(255,255,255,.1) 50%,
        rgba(255,255,255,0) 60%
      ),
      #09c;
    background: 
      repeating-linear-gradient(
        45deg, 
        rgba(255,255,255,.2) 0,
        rgba(255,255,255,.2) 10px, 
        rgba(255,255,255,0) 10px,
        rgba(255,255,255,0) 20px
      ),
  linear-gradient(-45deg, #23b08a, #23b08a 5px);
    background-size: 300px 20px, auto, auto;
    background-position: -300px 0, top, top;
    background-position: top right, top, top;
    box-shadow: 0 1px 0 rgba(255,255,255,.5) inset, 
                0 -1px 0 rgba(0,0,0,.8) inset,
                0 0 2px black;
  
}
progress::-webkit-progress-value{
    border-radius:10px;
    background: #23b08a;
    background: 
      -moz-repeating-linear-gradient(
        45deg, 
        rgba(255,255,255,.2) 0,
        rgba(255,255,255,.2) 10px, 
        rgba(255,255,255,0) 10px,
        rgba(255,255,255,0) 20px
      ),
      -moz-linear-gradient(
        rgba(255,255,255,.1) 50%,
        rgba(255,255,255,0) 60%
      ),
      #09c;
    background: 
      repeating-linear-gradient(
        45deg, 
        rgba(255,255,255,.2) 0,
        rgba(255,255,255,.2) 10px, 
        rgba(255,255,255,0) 10px,
        rgba(255,255,255,0) 20px
      ),
      linear-gradient(-45deg, #23b08a, #23b08a 5px);
    background-size: 300px 20px, auto, auto;
    background-position: -300px 0, top, top;
    background-position: top right, top, top;
    box-shadow: 0 1px 0 rgba(255,255,255,.5) inset, 
                0 -1px 0 rgba(0,0,0,.8) inset,
                0 0 2px black;
  
}
progress::-webkit-progress-bar{
    background: transparent;
}
</style>
<script type="text/javascript">
 var GlobalVariables = {
            availableCategories   : <?php echo json_encode($available_categories); ?>,
            baseUrl             : <?php echo '"' . $this->config->item('base_url') . '"'; ?>,
            csrfToken           : <?php echo json_encode($this->security->get_csrf_hash()); ?>,
            full_path          : '',

            AJAX_SUCCESS: 'SUCCESS',
            AJAX_FAILURE : 'FAILURE'
        };

        var EALang = <?php echo json_encode($this->lang->language); ?>;

$(document).ready(function() {
            FrontendApply.initialize(true , GlobalVariables.full_path );
  
        });



</script>





    <section id="contact-form" class="contact-form block">
        <div class="container">
            <div class=" description">
               <h3> Vous souhaitez…</h3>
                           
               <div class="detail-description">
<i class="fa fa-check-square-o" style=" font-size: 1.5em; color: #23b08a;"></i>&nbsp;  Augmenter votre nombre d'heures de travail <br/> <br/>
<i class="fa fa-check-square-o" style=" font-size: 1.5em; color: #23b08a;"></i>&nbsp; Avoir des conditions de travail sérieuses et avantageuses<br/> <br/>
<i class="fa fa-check-square-o" style=" font-size: 1.5em; color: #23b08a;"></i>&nbsp; Planifier  votre semaine afin que vous n'ayez pas de difficultés à trouver vos lieux de travail <br/> <br/>


</div>


             </div>

             <br/>
             <br/>
    <div class="row">
        <div class="col-sm-12">
            <div id="thanks-text" class="hidden" ><h4><span class="glyphicon glyphicon-ok" style="color:#23b08a; font-size:1.5em;"></span>&nbsp;&nbsp;Merci d'avoir consacré votre temps à remplir ce formulaire !
                            Nous vous contacterons dans les meilleurs délais.</h4>
            </div>
        </div>
            </div>

            <div class="row">

                <div class="col-sm-12 form-apply">
           
                    <form name="sentMessage" id="contactForm"  enctype="multipart/form-data"  novalidate >
                        <legend style="color: #23b08a">Envoyer votre candidature</legend>
                      <form class="form-horizontal form-label-left input_mask">

                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group post-input  ">
                                                <i class="fa fa-user overlay"></i>
                                            <input type="text" class="form-control text-input required" id="first-name" placeholder=" Nom" autofocus required>
                                         
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group post-input  ">
                                              <i class="fa fa-user overlay"></i>
                                            <input type="text" class="form-control text-input required" id="last-name" placeholder="Prénom" required>
                                          
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group post-input  ">
                                              <i class="fa fa-envelope overlay"></i>
                                             <input type="email" class="form-control text-input required" id="email" placeholder="Email" required>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group post-input ">
                                          <i class="fa fa-phone overlay"></i>
                                          <input type="number" class="form-control text-input required" id="mobile" placeholder="Téléphone" maxlength ="15" required>
                                        </div>


                                       <div class="col-md-6 col-sm-6 col-xs-6 form-group post-input  ">
                                               <i class="fa fa-users overlay"></i>

                                              <select class="form-control text-input" id="etat-civil">
                                             <option value="no option"  disabled selected>Etat civil </option>
                                             <option value="Célibataire(e)" >Célibataire(e) </option>
                                             <option value="Marié(e)" >Marié(e) </option>
                                             <option value="Divorcé(e)" >Divorcé(e)</option>
                                             <option value="Veuf(ve)" >Veuf(ve)</option>
                                         </select>
                                     </div>

                                        <div class="col-md-6 col-sm-6 col-xs-6 form-group post-input ">
                                          <i class="fa fa-birthday-cake overlay"></i>
                                          <input type="number" class="form-control text-input required" id="age" placeholder="Votre age" maxlength ="2" required>
                                        </div>

                                      <div class="col-md-6 col-sm-6 col-xs-12 form-group post-input  ">
                                              <i class="fa fa-map-marker overlay"></i>
                                             <input type="text" class="form-control text-input required" id="addresse" placeholder="Votre addresse" required>
                                        </div>

                                        <div class="col-md-6 col-sm-6 col-xs-12 form-group post-input ">
                                          <i class="fa fa-map-marker overlay"></i>
                                          <input type="text" class="form-control text-input required" id="city" placeholder="Ville"  required>
                                        </div>

                                         <div class="col-md-12 col-sm-12 col-xs-12 form-group post-input ">
                                          <i class="fa fa-briefcase overlay"></i>
                                           <select class="form-control text-input" id="service">
                                                     <option value="" disabled selected>Métier qui vous intéresse </option>
                                                      <?php
                                        // Group services by category, only if there is at least one service
                                        // with a parent category.
                                        foreach($available_categories as $category) {
                                             echo '<option value="' . $category['name'] . '">'
                                                            . $category['name'] . '</option>';
                                        }

                                      
                                    ?>



                                          </select>

                                        </div>
                        
                                     <div class="col-md-2 col-sm-4 col-xs-6 form-group post-input  ">
                                           <input type="file" class=" btn btn-primary foo " >
                                    </div>

                                   <div class="col-md-4 col-sm-5 col-xs-6 form-group post-input  fileR " style="margin-top: 10px;">
                                    
                                          <label class="file-return" style=" margin-left: 10%;">&nbsp;&nbsp;joindre votre CV</label>
                                    </div>


                                     <div class="col-md-6 col-sm-3 col-xs-12 form-group post-input " >
                                    
                                                <button type="button" class="btn hidden btn-success upload-file">Telecharger</button>
                                    </div>
                                              

                                          <div id="progress" class="col-md-12 col-sm-12 col-xs-12 hidden ">
                                      <strong>0%</strong>
                                        <progress id="progressBar" value="0" min="0" max="100">0%</progress> 
                                           </div>
                                   

                                    

                                       <div class="  col-xs-12  col-md-12 col-sm-12   text-right form-group boutton-command">
                                                <button type="reset" class=" btn btn-danger cancel-apply-form">Annuler</button>
                                              

                                                <button type="submit"  id="button-apply" class="   btn  btn-primary">Envoyer</button>
                                        </div>
                                    </form>

                    </form>

                     

                </div>
     
            </div>
        </div>         

    </section>
