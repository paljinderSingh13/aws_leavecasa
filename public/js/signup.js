var $ = jQuery;
$(document).ready(function(){
    $('.signup_user').click(function(e){
        e.preventDefault();
        var email = $('input[name=email]').val().trim();
        var mobile = $('input[name=mobile]').val().trim();
        var password = $('input[name=password]').val().trim();
        var conf_pass = $('input[name=conf_password]').val().trim();
        if(email != '' && mobile != '' && password != '' && conf_pass != ''){
            alert('Please fill required fields!');
            return false;
        }
        $('form').submit()
    });
});