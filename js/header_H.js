// FUNCIONES GENERALES HEADER

/*
 * Aplica estilos a los botones
 */

function build_buttons() {
    $.fn.monthYearPicker = function(options) {
        options = $.extend({
            dateFormat: "mm-yy",
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            showAnim: ""
        }, options);
        function hideDaysFromCalendar() {
            var thisCalendar = $(this);
            $('.ui-datepicker-calendar').hide();
            $('.ui-datepicker-close').unbind("click").click(function() {
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                thisCalendar.datepicker('setDate', new Date(year, month, 1));
                $('.ui-datepicker-calendar').hide();
            });
        }
        $(this).datepicker(options).focus(hideDaysFromCalendar);
    };

    $(".multiselect_multiple").multiselect({
        selectedList: 1
    });
    $(".multiselect_simple").multiselect({
        multiple: false,
        header: "Seleccione una opcion",
        noneSelectedText: "Seleccione una opcion",
        selectedList: 1
    });
    $(".button").button();
    if (arguments[0] == "txthtml") {
        tinyMCE.init({
            mode: "specific_textareas",
            editor_selector: "txthtml",
            plugins: "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
            // Theme options 
            theme_advanced_buttons1: "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
            theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview",
            theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,advhr,|,print,|,ltr,rtl,|,fullscreen",
            theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,blockquote,pagebreak,|,insertfile,insertimage,|,forecolor,backcolor",
            theme_advanced_toolbar_location: "top",
            theme_advanced_toolbar_align: "left",
            theme_advanced_statusbar_location: "bottom",
            theme_advanced_resizing: true,
            // Skin options 
            skin: "o2k7",
            skin_variant: "silver"
        });
    }
    $(".tmpck").datetimepicker();
    $(".dtpck").datepicker();
    $('.monthpck').monthYearPicker();
    $(".PRINT").each(function() {
        if (!$(this).hasClass("LOADED")) {
            $(this).addClass("LOADED");
            $(this).fileuploader();
        }
    });
    $(".FILEUPL").each(function() {
        if (!$(this).hasClass("LOADED")) {
            $(this).addClass("LOADED");
            $(this).fileuploader();
        }
    });


    // si hay un mensaje ponerlo al frente     
    if ($('#alert_p').is(':visible')) {
        $("#alert_p").dialog('close');
        $("#alert_p").dialog('open');
    }
}

function get_text_from_editor(id) {
    return String(tinyMCE.get(id).getContent());
}


function clear_text_from_editor(id) {
    return String(tinyMCE.get(id).setContent(''));
}

/*
 * cambiar datos de contacto
 */
function ucontact_p() {
    $("#ucontact_p").dialog({
        title: "Datos de contacto",
        resizable: false,
        modal: true,
        width: 350,
        height: 150
    });
}
// FIN

$(document).ready(function() {
    //bloquear boton backspace
    $(document).keydown(function(e) {
        var elid = $(document.activeElement).is('input[type="text"]:focus, textarea:focus,input[type="password"]:focus');
        if (e.keyCode === 8 && !elid) {
            return false;
        }
        ;
    });

    // Configuracion datepicker

    $("#details_ok_ucontact").click(function()
    {
        $.post("includes/ajaxQ/USER_ucontact_Update.php",
                {
                    mail: $("#txt_mail_ucontact").val(),
                    tel: $("#txt_tel_ucontact").val()
                },
        function(data) {
            if ($.trim(data) != "ok")
                alert_p(data + "<br />Imposible guardar.", "Error");
            else
                $("#ucontact_p").dialog('close');
        }
        );
    }
    );
    $("#details_exit_ucontact").click(function()
    {
        $("#ucontact_p").dialog('close');
    }
    );

    $.datepicker.regional['ar'] = {
        closeText: 'ok',
        prevText: 'Anterior',
        nextText: 'Siguiente',
        currentText: 'hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Мayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
            'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
        weekHeader: 'Sem',
        dateFormat: 'dd-mm-yy',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['ar']);
    build_buttons("txthtml");
    $(document).mousemove(function() {
        user.user_activity();
    });
    $(document).keydown(function() {
        user.user_activity();
    });
    user.user_activity();

    if (typeof main == 'function')
        main(); // EJECUTA MAIN EN JS DE PAGINA EN INCLUDE
    //notice_information(MSJ_INFORMATION);
});

