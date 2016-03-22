


<style type="text/css">
.owl-theme .owl-controls{
    margin-top: -20px !important;
}

section #services{
    padding: 60px;
}

a.btn.btn-primary.services.btn-lg ,
button.btn.btn-primary.services.btn-lg{
     border-radius: 20px;
    border-color: #54debc;
    padding-left: 30px ;
     padding-right: 30px ;
}
a.btn.btn-primary.services.btn-lg:hover,
button.btn.btn-primary.services.btn-lg:hover
 {
   

    background-color: #fff !important;
    color: #54debc !important ;
    border-color: #fff !important;
}
section.reserver{
     padding: 4px 0px;
}
.titre{

    text-align: center !important;
        color: #fff !important;
}

section#contact{
    padding: 60px 0px;


}


.broun-block {
    padding-bottom: 30px;
}
.block-text {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 3px 0 #2c2222;
    color: #626262;
    font-size: 14px;
    margin-top: 27px;
    padding: 15px 18px;
}
.block-text .name {
 color: #961436 ;
    font-size: 25px;
    font-weight: bold;
    line-height: 21px;
    text-decoration: none;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}
.mark {
    padding: 12px 0;background:none;
}
.block-text p {
    color: #585858;
    font-family: Georgia;
    font-style: italic;
    line-height: 20px;
}

.sprite-i-triangle {
    background-position: 0 -1298px;
    height: 44px;
    width: 50px;
}
.block-text ins {
    bottom: -44px;
    left: 50%;
    margin-left: -60px;
}


.block {
    display: block;
}
.zmin {
    z-index: 1;
}
.ab {
    position: absolute;
}

.person-text {
    padding: 10px 0 0;
    text-align: center;
    z-index: 2;
}
.person-text a {
    color: #ffcc00;
    display: block;
    font-size: 14px;
    margin-top: 3px;
    text-decoration: underline;
}
.person-text i {
    color: #fff;
    font-family: Georgia;
    font-size: 13px;
}
.rel {
    position: relative;
}
@media (max-width: 320px) {
  body{
    width: 100%;
  }

}


</style>

<script type="text/javascript">
    var GlobalVariables = {
            'csrfToken': <?php echo json_encode($this->security->get_csrf_hash()); ?>,
            'baseUrl': <?php echo '"' . $base_url . '"'; ?>,

            'AJAX_SUCCESS': 'SUCCESS',
            'AJAX_FAILURE': 'FAILURE'
        };
        $(document).ready(function() {
    
      $('#contactus .required').each(function() {
       $(document).on("keypress" ,".required" , function() {
$(this).removeClass('has-error');
});

});

          $('#button-contact').click(function(event){
         



    var missingFields = false ; 

      $('#contactus .required').each(function() {
                if ($(this).val() == '') {
                    $(this).addClass('has-error');

      
                  missingFields = true;

  }

});
if(missingFields == true)
 {return false; }
 


   var formData = new Object();

        formData['customer'] = {
            'contactName': $('#contactName').val(),
            'contactAddress': $('#contactAddress').val(),

            'contactMessage': $('#contactMessage').val(),

            'contactSubject': $('#contactSubject').val()

        };

 var postData = {
            'csrfToken': GlobalVariables.csrfToken,
            'post_data': formData
        };
  var postUrl = GlobalVariables.baseUrl + 'index.php/user/contactUs';

                $('.alert.inscrit').addClass('hidden');

 $.post(postUrl, postData, function(response) {
                ////////////////////////////////////////////////////////////
               
                console.log(response);

                if (response == GlobalVariables.AJAX_SUCCESS) {

                  $('.alert').text('Votre message a été envoyé avec succés :)');

                                 $('.alert').removeClass('hidden')
                            .addClass('alert-success');         
                            document.getElementById("contactus").reset();

          } 
       else {              
                      json = JSON.parse(response.exceptions);
                        $('.alert').text(json.message);
                       $('.alert').removeClass('hidden')
                            .addClass('alert-danger');
                            
                    }

                ////////////////////////////////////////////////////////////
                }, 'json');



});
        });


</script>




<section  id = "slider" class="owl-carousel">
    <div class="main-slider " style="background-image: url(<?php echo $this->config->item('base_url'); ?>assets/img/headers/index1.jpg)">
    <div class="slider-caption"   >
        <h3>Besoin d'un coup de main dans votre jardin ?<br/>
Des haies à tailler, des arbres à couper, <br/>une pelouse à 
tondre,des fleurs  <br/>à planter, greffer … ? </h3>
<br/>
        <a href="<?php echo  site_url('user/services');?>" class="btn btn-primary btn-lg">Faites-vous aider</a>   
    </div>

</div>    
 <div class="main-slider " style="background-image: url(<?php echo $this->config->item('base_url'); ?>assets/img/headers/index2.jpg)">
    <div class="slider-caption"   >
        <h3>Besoin d'un coup de main dans votre jardin ?<br/>
Des haies à tailler, des arbres à couper, <br/>une pelouse à 
tondre,des fleurs  <br/>à planter, greffer … ? </h3>
<br/>
        <a href="<?php echo  site_url('user/services');?>" class="btn btn-primary btn-lg">Faites-vous aider</a>   
    </div>

</div> 
<div class="main-slider " style="background-image: url(<?php echo $this->config->item('base_url'); ?>assets/img/headers/index3.jpg)">
    <div class="slider-caption"   >
     <h3>Besoin d'un coup de main dans votre jardin ?<br/>
Des haies à tailler, des arbres à couper, <br/>une pelouse à 
tondre,des fleurs  <br/>à planter, greffer … ? </h3>
<br/>
        <a href="<?php echo  site_url('user/services');?>" class="btn btn-primary btn-lg">Faites-vous aider</a>     
    </div>

</div>    
 <div class="main-slider " style="background-image: url(<?php echo $this->config->item('base_url'); ?>assets/img/headers/index4.jpg)">
    <div class="slider-caption"   >
       <h3>Besoin d'un coup de main dans votre jardin ?<br/>
Des haies à tailler, des arbres à couper, <br/>une pelouse à 
tondre,des fleurs  <br/>à planter, greffer … ? </h3>
<br/>
        <a href="<?php echo  site_url('user/services');?>" class="btn btn-primary btn-lg">Faites-vous aider</a>   
    </div>

</div>

</section>


    <section id="services" style="padding: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Qualité et satisfaction</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <br/>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <br/><div class="wow animated fadeInLeft service-box">
                        <img class=" text-primary" src="<?php echo $this->config->item('base_url'); ?>assets/img/brands/button.png" ></i>
                        <h3>Simplicité</h3>
                        <p class="text-muted">Réservez en ligne en 60 secondes</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <br/>
                    <div class="service-box wow animated fadeInLeft" data-wow-delay=".4s">
       <img class="  text-primary" src="<?php echo $this->config->item('base_url'); ?>assets/img/brands/pro.png"   ></i>
                        <h3>Professionnalisme</h3>
                        <p class="text-muted">Aides ménagères qualifiées et assurées</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <br/><div class=" wow animated fadeInLeft service-box" data-wow-delay=".8s">
       <img class="  text-primary" src="<?php echo $this->config->item('base_url'); ?>assets/img/brands/shield.png"  ></i>
                         

                        <h3>securité</h3>
                        <p class="text-muted">Paiement en ligne sécurisé</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <br/><div class="wow animated fadeInLeft service-box" data-wow-delay="1.2s">
                        <img class=" text-primary" src="<?php echo $this->config->item('base_url'); ?>assets/img/brands/business.png" ></i>


                        <h3>Qualité</h3>
                        <p class="text-muted">Satisfaction garantie</p>
                    </div>
                </div>
            </div>
        </div>

    </section>


<section  class=" reserver" style="background-color:#23b08a;">
    <div>
        <h3 class="titre ">Réservez votre prestation en quelques clics</h3>
        <p class="actions text-center">
            <br/><br/>
            <a class="btn btn-primary services btn-lg" href="<?php echo  site_url('user/services');?>">Réservez maintenant</a>
        </p>
    </div>
</section>

<section>
<div class="container">
    <div class="row">
        <h2 style="text-align: center;">Avis de nos clients</h2>
    </div>
</div>
<div class="carousel-reviews broun-block">
    <div class="container">
        <div class="row">
            <div id="carousel-reviews" class="carousel slide" data-ride="carousel">
            
                <div class="carousel-inner">
<div>
    <div class="col-md-4 col-sm-4 col-xs-12 ">
        <div class="block-text rel zmin">
            <span class="name">Mariam</span>
            <div class="mark">
                Rating: <span class="rating-input"><span class="glyphicon glyphicon-star" data-value="0"></span><span class=
                "glyphicon glyphicon-star" data-value="1"></span><span class="glyphicon glyphicon-star" data-value=
                "2"></span><span class="glyphicon glyphicon-star" data-value="3"></span><span class=
                "glyphicon glyphicon-star-empty" data-value="4"></span><span class="glyphicon glyphicon-star-empty" data-value=
                "5"></span></span>
            </div>
            <p>
                "Un grand appartement à entretenir et quatre enfants… ça laisse peu de temps pour d’autres activités ! Grâce à XXX,
                j’ai plus de temps pour moi." ...
            </p><ins class="ab zmin sprite sprite-i-triangle block"></ins><br>
            <br>
            <br>
        </div>
        <div class="person-text rel">
            <img src="<?php echo $this->config->item('base_url'); ?>assets/img/brands/one.jpg">
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="block-text rel zmin">
            <span class="name">Maleek</span>
            <div class="mark">
                Rating: <span class="rating-input"><span class="glyphicon glyphicon-star" data-value="0"></span><span class=
                "glyphicon glyphicon-star" data-value="1"></span><span class="glyphicon glyphicon-star-empty" data-value=
                "2"></span><span class="glyphicon glyphicon-star-empty" data-value="3"></span><span class=
                "glyphicon glyphicon-star-empty" data-value="4"></span><span class="glyphicon glyphicon-star-empty" data-value=
                "5"></span></span>
            </div>
            <p>
                "Une excellente prestation de la part de l'aide ménagère, je n’hésiterai pas à commander à nouveau Magdalena pour
                ses compétences ménagères !"
            </p><ins class="ab zmin sprite sprite-i-triangle block"></ins><br>
            <br>
            <br>
        </div>
        <div class="person-text rel">
            <img src="<?php echo $this->config->item('base_url'); ?>assets/img/brands/one.jpg">
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12 ">
        <div class="block-text rel zmin">
            <span class="name">Sonia</span>
            <div class="mark">
                Rating: <span class="rating-input"><span class="glyphicon glyphicon-star" data-value="0"></span><span class=
                "glyphicon glyphicon-star" data-value="1"></span><span class="glyphicon glyphicon-star" data-value=
                "2"></span><span class="glyphicon glyphicon-star" data-value="3"></span><span class="glyphicon glyphicon-star"
                data-value="4"></span><span class="glyphicon glyphicon-star" data-value="5"></span></span>
            </div>
         <p>
                "Une excellente prestation de la part de l'aide ménagère, je n’hésiterai pas à commander à nouveau Magdalena pour
                ses compétences ménagères !"
            </p><ins class="ab zmin sprite sprite-i-triangle block"></ins><br>
            <br>
            <br>
        </div>
        <div class="person-text rel">
            <img src="<?php echo $this->config->item('base_url'); ?>assets/img/brands/one.jpg">
        </div>
    </div>
</div>


             
                           
                </div>

            </div>
        </div>
    </div>
</div>
</section>

<section  class=" reserver" style="background-color:#23b08a;">
    <div>
        <h3 class="titre ">Choisissez la prestation qui vous convient le mieux</h3>
        <p class="actions text-center">
            <br/><br/>
            <a class="btn btn-primary services btn-lg deco"  href="<?php echo  site_url('user/services');?>">Découvrez nos services</a>
        </p>
    </div>
</section>

    <section id="services"  style="padding: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Devenez partenaire</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <br/><div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                     <br/><div class=" wow bounceIn animated service-box">
       <img class="text-primary" src="<?php echo $this->config->item('base_url'); ?>assets/img/brands/sign.png" ></i>
                        <h3>100% flexible</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                     <br/><div class=" wow bounceIn animated service-box">
       <img class="text-primary" src="<?php echo $this->config->item('base_url'); ?>assets/img/brands/line.png" data-wow-delay=".1s"></i>
                        <h3>Augmentez votre clientèle</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                     <br/><div class=" wow bounceIn animated service-box">
       <img class="text-primary" src="<?php echo $this->config->item('base_url'); ?>assets/img/brands/money.png" data-wow-delay=".2s"></i>


                        <h3>Rémunération attractive</h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                     <br/><div class="wow bounceIn animated service-box">
       <img class="  text-primary" src="<?php echo $this->config->item('base_url'); ?>assets/img/brands/people.png" data-wow-delay=".3s"></i>
                        <h3>Une équipe professionnelle</h3>
                    </div>
                </div>
            </div>
        </div>
          <p class="actions text-center">
            <br/><br/>
            <a class="btn btn-primary services btn-lg rejoinn" href="<?php echo  site_url('user/work_for_us');?>">Rejoignez&nbsp;&nbsp;nous</a>
        </p>
    </section>



    <section class="content-section form contact light">
        <div class="container">
            
                <div class="col-lg-8  col-md-8  col-sm-8 col-md-offset-2 col-sm-offset-2 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Contactez-nous!</h2>
                    <hr class="primary">
                    <p></p>
                </div>
            
            <form id="contactus" name="contact">
 
                <div class="col-lg-12  col-md-12  col-sm-12  col-xs-12 animated bounceIn">

                    <span class="input-group col-lg-5  col-md-5  col-sm-5  col-xs-12">
                        <i class="fa fa-user"></i>
                        <input type="text" name="contactName" id="contactName"  class="required " placeholder="Nom et Prénom"  maxlength="250"  />
                    </span><!-- .input-group -->
                     <span class="input-group col-lg-1  col-md-21  col-sm-1  col-xs-0"></span>
                    <span class="input-group col-lg-5  col-md-5  col-sm-5  col-xs-12">
                        <i class="fa fa-envelope"></i>
                        <input type="email" name="contactEmail" id="contactAddress" class="required" placeholder="Address email"  maxlength="250" />
                    </span><!-- .input-group -->
                    
                    <span class="input-group col-lg-12  col-md-12  col-sm-12  col-xs-12">
                        <i class="fa fa-book"></i>
                        <input type="text" name="contactSubject" id="contactSubject" class="required"  placeholder="Sujet"  maxlength="250" />
                    </span><!-- .input-group -->
                    
        
                
                
                    <span class="input-group col-lg-12  col-md-12  col-sm-12  col-xs-12">
                        <textarea name="contactMessage" id="contactMessage" class="lg" placeholder="Description ..."></textarea>
                    </span><!-- .input-group -->
                     <div class="alert col-lg-12  col-md-12  col-sm-12  col-xs-12 " style="width: 84%;"></div>

                    <span class="text-right">
            <button class="btn btn-primary services btn-lg rejoinn"  id="button-contact" type="button">Envoyer</button>
                    </span><!-- .input-group -->
                </div>
            </form>
        </div><!-- .container -->
        
       
        
    </section><!-- .content-section .form -->