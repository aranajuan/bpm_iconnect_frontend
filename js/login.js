function main() {
    if ($_GET("e")) {
        alert_p($_GET("e"), "Error");
    }
    $("#login").click(
            function () {
                doLogin();
            }
    );
    $("#pass").keydown(
            function (e) {
                if (e.keyCode === 13)
                    doLogin();
            }
    );
    
    $("#captchatext").keydown(
            function (e) {
                if (e.keyCode === 13)
                    doLogin();
            }
    );
    if($_GET("usr")){
        autoLogin();
    }
    
}

function doLogin() {
    if($("#usr").val()=="" || $("#pass").val()==""){
        alert_p("Complete usuario y contrase&ntilde;a.","Error");
        return;
    }
    $.post("",
            {
                class: 'user',
                method: 'login',
                usr: $("#usr").val(),
                pass: $("#pass").val(),
                instancia: $("#instancia").val(),
                captchatext: $("#captchatext").val()
            }, function (data) {
        try {
            var obj = jQuery.parseJSON(data);
            if (obj !== null) {
                if (obj.result === "ok") {
                    location.href = "?L=" + obj.home + "&m=login";
                } else {
                    if (obj.reload == "true") {
                        location.href = "?L=login&e=" + encodeURIComponent(obj.detail);
                    } else {
                        alert_p(obj.detail, obj.result);
                    }
                }
            }
        } catch (e) {
            alert_p(data);
        }

    }
    );
}


function autoLogin() {
    $.post("",
            {
                class: 'user',
                method: 'login',
                usr: $_GET("usr"),
                pass: $_GET("pass"),
                instancia: $_GET("instancia")
            }, function (data) {
        try {
            var obj = jQuery.parseJSON(data);
            if (obj !== null) {
                if (obj.result === "ok") {
                    location.href = "?L=" + obj.home + "&m=login";
                } else {
                    if (obj.reload == "true") {
                        location.href = "?L=login&e=" + encodeURIComponent(obj.detail);
                    } else {
                        alert_p(obj.detail, obj.result);
                    }
                }
            }
        } catch (e) {
            alert_p(data);
        }

    }
    );
}
