/**
 * Frontend Scripts for Subscribe2 Widget Pro
 * @since: v1.0
 */
jQuery(function($){

    jQuery('.s2w-form').on('submit',function(e){
        var email = jQuery(this).children('.s2w-email').val();
        console.log(email);
        //validate email
        if( !validateEmail(email)) {
            //not a valid email address
            s2wInvalidMessage(jQuery(this).parent());
            return false;
        } else {
            //passed validation
            return true;
        }

    });


});


function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if( !emailReg.test( $email ) ) {
    return false;
  } else {
    return true;
  }
}

function s2wInvalidMessage(form){
    var validation = jQuery(form).attr('data-validation-error');
    jQuery('.s2w-alert').fadeOut('fast').remove(); //remove any alerts already present
    jQuery(form).prepend('<div class="s2w-alert s2w-validation">'+ validation + '</div>');
    jQuery('.s2w-alert').slideDown('fast');
    jQuery(form).find('.s2w-email').addClass('s2w-input-invalid'); //add invalid class to input
}