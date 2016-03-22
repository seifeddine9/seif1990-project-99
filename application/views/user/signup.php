               <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo $this->config->item('base_url'); ?>assets/ext/intl-tel-input/intlTelInput.css">

                 <script
        type="text/javascript"
        src="<?php echo $this->config->item('base_url'); ?>assets/ext/intl-tel-input/intlTelInput.js"></script>   

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
label{
color : #53a585 !important;

}
.intl-tel-input .country-list .flag-box, .intl-tel-input .country-list .country-name {
   color : #53a585 !important; 
}


</style>


  <script type="text/javascript">
        var GlobalVariables = {
            'csrfToken': <?php echo json_encode($this->security->get_csrf_hash()); ?>,
            'baseUrl': <?php echo '"' . $base_url . '"'; ?>,
            'destUrl': <?php echo '"' . $dest_url . '"'; ?>,
            'destUrlCustomer': <?php echo '"' . $dest_url_customer . '"'; ?>,
            'AJAX_SUCCESS': 'SUCCESS',
            'AJAX_FAILURE': 'FAILURE'
        };

        var EALang = <?php echo json_encode($this->lang->language); ?>;

        $(document).ready(function() {

           
       


             /**
             * Event: sign uo Button "Click"
             *
             * Make an ajax call to the server and check whether the user's informations  are right.
             * If yes then  add him to database and redirect him to his desired page,
             * otherwise display a message.
             */



      $('#inscription-form .required').each(function() {
       $(document).on("keypress" ,".required" , function() {
$(this).parents('.form-group').removeClass('has-error');
});

});



 $(document).on("keypress" ,"#phone-number" , function(event) {
             // console.log(isNaN(String.fromCharCode(event.which)));

  if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
            event.preventDefault();
        }
});




    $('#button-inscrit').click(function(event){



    var missingFields = false ; 

      $('#inscription-form .required').each(function() {
                if ($(this).val() == '') {
                    $(this).parents('.form-group').addClass('has-error');

      
                  missingFields = true;

  }

});
if(missingFields == true)
 {return false; }
 


   var formData = new Object();

        formData['customer'] = {
            'last_name': $('#last-name').val(),
            'first_name': $('#first-name').val(),
            'password': $('#newpassword').val(),
            'email': $('#email').val(),
            'phone_number': $("#phone-number").intlTelInput("getNumber"),
            'address': $('#address').val(),
            'city': $('#city').val(),
            'zip_code': $('#zip-code').val(),
            'src_photo': $('#default-image').val()

        };

 var postData = {
            'csrfToken': GlobalVariables.csrfToken,
            'post_data': formData
        };
  var postUrl = GlobalVariables.baseUrl + 'index.php/user/inscription';

                $('.alert.inscrit').addClass('hidden');

 $.post(postUrl, postData, function(response) {
                ////////////////////////////////////////////////////////////
               
                console.log(response);

                if (response == GlobalVariables.AJAX_SUCCESS) {
                        window.location.href = GlobalVariables.baseUrl + 'index.php/home';;
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








<div class="container login-page">
        <div class="full-content-center">

            <div class="login-wrap animated flipInX">
                <div class="login-block">
          
          <h3><?php echo $this->lang->line('step_three_title'); ?></h3>
        <br/>
              
                
<form id ="inscription-form" action="appointments/book">
           <div id="wizard-frame-3" class="wizard-frame" > 
                    <div class="frame-container">
                        <div class="alert"></div>
                        <div class="frame-content row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name" class="control-label"><?php echo $this->lang->line('first_name'); ?> *</label>
                                    <input type="text" id="first-name" name="first-name"  class="required form-control" maxlength="100" autofocus />
                                </div>
                                <div class="form-group">
                                    <label for="last-name" class="control-label"><?php echo $this->lang->line('last_name'); ?> *</label>
                                    <input type="text" id="last-name" name="last-name" class="required form-control" maxlength="250" />
                                </div>
                                    
                                <div class="form-group">
                                    <label for="email" class="control-label"><?php echo $this->lang->line('email'); ?> *</label>
                                    <input type="text" id="email" name="email" class="required form-control" maxlength="250" />
                                </div>
                               
                                 <div class="form-group">
                                    <label for="newpassword" class="control-label"><?php echo $this->lang->line('password'); ?> *</label>
                                    <input type="password" id="newpassword" name="newpassword" class="required form-control" maxlength="60"  />
                                </div>
                                    <div class="form-group">
                                    <label for="phone-number" class="control-label"><?php echo $this->lang->line('phone_number'); ?> *</label>
                                    <input type="tel" id="phone-number" name="phone-number" class="required form-control" maxlength="60"  />
                                </div>
                            </div>

                            <div class="col-md-6">
                              
                                <div class="form-group">
                                    <label for="address" class="control-label"><?php echo $this->lang->line('address'); ?>*</label>
                                    <input type="text" id="address" name="address" class="required  form-control" maxlength="250" />
                                </div>

                                <div class="form-group">
                                    <label for="city" class="control-label"><?php echo $this->lang->line('city'); ?>*</label>
                                    <input type="text" id="city" name="city" class="required form-control" maxlength="120" />
                                </div>
                                <div class="form-group">
                                    <label for="zip-code" class="control-label"><?php echo $this->lang->line('zip_code'); ?>*</label>
                                    <input type="text" id="zip-code" name="zip-code" class="required form-control" maxlength="120" />
                                </div>
                                <div class="form-group">
                                    <label for="notes" class="control-label"><?php echo $this->lang->line('notes'); ?></label>
                                    <textarea id="notes" name="notes" maxlength="500" class="form-control" rows="3"></textarea>
                                </div>
                                <input type="hidden" name="default-image"  id ="default-image" value="assets/img/default_image.jpg">

                            </div>

                        </div>

                    </div>

                    <div class="command-buttons-inscrit">
                       
                        <button type="button" id="button-inscrit" class="btn button-inscrit btn-primary" >
                            <?php echo $this->lang->line('next'); ?>
                            <span class="glyphicon glyphicon-forward"></span>
                        </button>
                    </div>
                </div>

</form>
                </div>
            </div>
            
        </div>
    </div>

    <script type="text/javascript">
$("#phone-number").intlTelInput({
  nationalMode: true,
  utilsScript: GlobalVariables.baseUrl+"assets/ext/intl-tel-input/utils.js", // just for formatting/placeholders etc
  autoPlaceholder: false
});

    </script>