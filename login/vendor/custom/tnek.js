/* Login Admin */
function adsign_in(){
    var user = document.getElementById("username").value;
    var pass = document.getElementById("password").value;
    $.ajax({
        type: "POST",
        url: "functions/adm_command.php",
        data: {"username": user, "password": pass},
       success: function(html){
            $('#kr-display').html(html);
        },
    });     
}

/* Register Admin */
function adregister(){
    var user_r = document.getElementById("username_r").value;
    var email_r = document.getElementById("email_r").value;
    var pass_r = document.getElementById("password_r").value;
    $.ajax({
        type: "POST",
        url: "functions/adm_command.php",
        data: {"username_r": user_r, "email_r": email_r, "password_r": pass_r},
       success: function(html){
            $('#kr-display').html(html);
        },
    });     
}