function main() {
    $("#login").click(
            function() {
                doLogin();
            }
    );
    $("#pass").keydown(
            function(e) {
                if (e.keyCode  === 13)
                    doLogin();
            }
    );
}

function doLogin() {
    $.post("",
            {
                class: 'user',
                method: 'login',
                usr: $("#usr").val(),
                pass: $("#pass").val(),
                instancia: $("#instancia").val()
            }, function(data) {
        try {
            var obj = jQuery.parseJSON(data);
            if (obj !== null) {
                if (obj.result === "ok") {
                    location.href = "?L=" + obj.home + "&m=login";
                } else {
                    alert(obj.result + "->" + obj.detail);
                }
            }
        } catch (e) {
            alert("error al parsear");
        }

    }
    );
}

