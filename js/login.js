function main() {
    if ($_GET("e")) {
        alert_p($_GET("e"), "Error");
    }
    $("#pass").keydown(
            function(e) {
                if (e.keyCode === 13)
                    doLogin();
            }
    );

    $("#captchatext").keydown(
            function(e) {
                if (e.keyCode === 13)
                    doLogin();
            }
    );
    if ($_GET("usr")) {
        autoLogin();
    } else if (autologin) {
        login('', '', instance, null, false);
    } else {
        $("#statusform").hide();
        $("#loginform").show();
    }

}

function doLogin() {
    if ($("#usr").val() == "" || $("#pass").val() == "") {
        alert_p("Complete usuario y contrase&ntilde;a.", "Error");
        return;
    }

    login($("#usr").val(), $("#pass").val(), $("#instancia").val(), $("#captchatext").val(), true);

}


function autoLogin() {
    login($_GET("usr"), $_GET("pass"), $_GET("instancia"), null, false);
}


function login(usr, pass, instance, captchatext, allowlogin) {
    $("#loginform").hide();
    $("#statusform").html("<img src=\"img/loading.gif\" height=\"50\" width=\"50\"><h2>Ingresando</h2>");
    $("#statusform").show();
    $.post("",
            {
                'class': 'user',
                method: 'login',
                usr: usr,
                pass: pass,
                instancia: instance,
                captchatext: captchatext
            }, function(data) {
        try {
            var obj = jQuery.parseJSON(data);
            if (obj !== null) {
                if (obj.result === "ok") {
                    if ($_GET('R')) {
                        location.href = decodeURIComponent($_GET('R'));
                    } else {
                        location.href = "?L=" + obj.home + "&m=login";
                    }
                } else {
                    if (obj.reload == "true") {
                        location.href = "?L=login&e=" + encodeURIComponent(obj.detail);
                    } else {
                        alert_p(obj.detail, obj.result);
                        $("#statusform").html("<h2>Error al iniciar: " + obj.detail + "</h2>");
                        if (allowlogin) {
                            $("#statusform").hide();
                            $("#loginform").show();
                        }
                    }
                }
            }
        } catch (e) {
            alert_p(data);
            $("#statusform").html("<h2>Error al iniciar: " + data + "</h2>");
            if (allowlogin) {
                $("#statusform").hide();
                $("#loginform").show();
            }
        }

    }
    );
}