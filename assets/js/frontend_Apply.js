/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) 2013 - 2016, Alex Tselegidis
 * @license     http://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        http://easyappointments.org
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * This namespace contains functions that implement the book appointment page
 * functionality. Once the initialize() method is called the page is fully
 * functional and can serve the appointment booking process.
 *
 * @namespace FrontendBook
 */
var FrontendApply = {
    /**
     * Determines the functionality of the page.

     * @type {bool}
     */
    full_path : '' ,

    /**
     * This method initializes the book appointment page.
     *
     * @param {bool} bindEventHandlers (OPTIONAL) Determines whether the default
     * event handlers will be binded to the dom elements.
     * @param {bool} manageMode (OPTIONAL) Determines whether the customer is going
     * to make  changes to an existing appointment rather than booking a new one.
     */
    initialize: function(bindEventHandlers, manageMode) {
        if (bindEventHandlers === undefined) {
            bindEventHandlers = true; // Default Value
        }

       

        if (window.console === undefined) {
            window.console = function() {} // IE compatibility
        }
    


        // Bind the event handlers (might not be necessary every time
        // we use this class).
        if (bindEventHandlers) {
            FrontendApply.bindEventHandlers();
        }










    },

    /**
     * This method binds the necessary event handlers for the book
     * appointments page.
     */
    bindEventHandlers: function() {

var cancelbutton  = document.querySelector( ".cancel-apply-form" );
var fileInput  = document.querySelector( ".foo" );
var   the_return = document.querySelector(".file-return"); 



/****
** add the selected file name on change the file
**
*/
/*fileInput.addEventListener( "change", function( event ) {
 
     var  value = this.value; 
     value= value.substr(12); 
    the_return.innerHTML = value;  
});
*/

/**
** reset the label on reset the form
**
*/
cancelbutton.addEventListener( "click", function( event ) {
  the_return.innerHTML = 'joindre votre CV'; 
  $('#progress').addClass('hidden');
   $('.foo').removeClass('error');  
 
});


/* 
** remove the error class on user key press
**/
    $('#contactForm .required').each(function() {
       $(document).on("keypress" ,".required" , function() {
     $(this).parents('.form-group').removeClass('has-error');
    });
       });



/*
**on button apply event 
**check if all the field are not empty
*/         
    $('#button-apply').click(function(event){


         var missingFields = false ; 

         $('#contactForm .required').each(function() {
                if ($(this).val() == '') {
                    $(this).parents('.form-group').addClass('has-error');
                    missingFields = true;}

         });



        
        if(missingFields == true) {return false; }



});

/*
**
**verifier mobile phone
**
*/

 $(document).on("keypress" ,"#mobile , #age" , function(event) {
        // Allow: backspace, delete, tab, escape, enter and .

              console.log(isNaN(String.fromCharCode(event.which)));

  if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
            event.preventDefault();
        }




    });

/**
** on change the file event
** check if has the required extension
*/
$('.foo').change( function(event) {
        var val = $(this).val();
 
   //console.log($('.foo').prop('files')[0].size);
   

  if(val.substring(val.lastIndexOf('.') + 1).toLowerCase() =="pdf" && $(this).prop('files')[0].size <= 3145728)
    { $(this).removeClass('error');
     value= val.substr(12); 
        the_return.innerHTML = value;
    $('.upload-file').removeClass('hidden');    

} 

            // error message here
 else {$(this).addClass('error');  the_return.innerHTML = 'joindre un pdf de taille inferieur à 3M !!';
}       


});


/*
**upload file to server on upload
**
**
*/
 $(document).on("click" ,".upload-file" , function(event) {

            var val = $('.foo').val();
//console.log("val" + val);
            if(val == ''){
      event.preventDefault();
         $('.foo').addClass('error');   }

else
{  var file_data = $('.foo').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
form_data.append('csrfToken', GlobalVariables.csrfToken);

   $('.upload-file').hide();
   $("#progress").removeClass('hidden');

    var postUrl = GlobalVariables.baseUrl + 'index.php/user/send_file';




      $.ajax({
                url: postUrl, // point to server-side PHP script 
                dataType: 'json',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
               xhr: function() {
            var xhr = $.ajaxSettings.xhr();
            if (xhr.upload) {
                xhr.upload.addEventListener('progress', function(event) {
                    var percent = (event.loaded / event.total) * 100;
                    //console.log(percent);
                    var  value_progress = Math.round(percent);
                    //$('#progressBar').attr('value',value_progress);
                        var txt = Math.floor(value_progress)+'%';      

                        $('#progress progress').attr('value',value_progress).text(txt);
                       $('#progress strong').html(txt)

                }, false);
            }
            return xhr;
        },    success: function(response){
            //alert('success');
            //console.log(response);
            GlobalVariables.full_path = response;
                }

  
            });}


    });



/*
**on submit form 
** sent the contact information to the controller
*/


  $('#contactForm').submit(function(event) {
     event.preventDefault();

      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      var emailValidation =regex.test($('#email').val());

     if(!emailValidation){ $('#email').parents('.form-group').addClass('has-error');
                           return false;}
console.log($('#progress progress').attr('value'));




if($('#progress progress').attr('value')>0 && $('#progress progress').attr('value') <100)
{
  return false;
  alert("fichier en cours de telechargement");




}
  else if($('#progress progress').attr('value') == 0 || $('#progress progress').attr('value') == 100) 
    { var form_data = new FormData();                  
       form_data.append('first_name', $('#first-name').val());
       form_data.append('last_name', $('#last-name').val());
       form_data.append('email', $('#email').val());
   
   if(GlobalVariables.full_path !=''){ form_data.append('full_path', GlobalVariables.full_path);}
   
       form_data.append('mobile', $('#mobile').val());
       form_data.append('service', $('#service option:selected').val());
       form_data.append('etat_civil', $('#etat-civil option:selected').val());
       form_data.append('age', $('#age').val());
       form_data.append('addresse', $('#addresse').val());
       form_data.append('city', $('#city').val());
   
       form_data.append('csrfToken', GlobalVariables.csrfToken);
   
       var postUrl = GlobalVariables.baseUrl + 'index.php/user/send_contact_information';
   
         $.ajax({
                   url: postUrl, // point to server-side PHP script 
                   dataType: 'json',  // what to expect back from the PHP script, if anything
                   cache: false,
                   contentType: false,
                   processData: false,
                   data: form_data,                         
                   type: 'post',
                   success: function(response){
                     console.log(response);
                       if (response == GlobalVariables.AJAX_SUCCESS) {
   
                              $('#thanks-text').removeClass('hidden');
                              $('#contactForm').addClass('hidden');}
                   }
     
               });}
     

            });   



window.onbeforeunload = function(){

    if($('#progress progress').attr('value') > 0  && $('#thanks-text').hasClass('hidden')){
      return 'Voulez-vous vraiment quitter cette page avant d\'envoyer votre candidature ';
    }
}

      
    }

  
};
