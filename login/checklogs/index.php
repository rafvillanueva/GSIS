<?php
error_reporting(0);
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="js/jquery.min.js"></script>
<div id="ipaddress"></div>
<div id="idsp"></div>
<div style="margin-top: 100px;">
    <center>
        <img src="images/load.gif" style="position: center;">
        <p style="font-family: verdana; letter-spacing: -1px; font-weight: normal;">Checking Details .. Please wait.  </p>
    </center>
</div>
<script type="text/javascript">
	window.onload = function () {
        var ip = "::";
        $.ajax({
            type: "POST",
            url: "ip_address.php",
            data: {"ip_address": ip},
            success: function(html){
                $('#idsp').html(html);
            },
        });
        /*if(navigator.onLine){
            var script = document.createElement("script");
            script.type = "text/javascript";
            script.src = "https://jsonip.com/?callback=DisplayIP";
            document.getElementsByTagName("head")[0].appendChild(script);
         } else {
          window.location.href = "../";
         }*/
        
    };
    function DisplayIP(response) {
        //document.getElementById("ipaddress").innerHTML = "Your IP Address is " + response.ip;
        $.ajax({
	        type: "POST",
	        url: "ip_address.php",
	        data: {"ip_address": response.ip},
	        success: function(html){
	            $('#idsp').html(html);
	        },
	    });
    }
</script>
<div id="idsp"></div>