jQuery.fn.fileuploader = function (options) {
    var obj = this[0];
    var idObj = $(obj).attr("id");
    if (idObj == undefined)
        idObj = $(obj).attr("name");
    $(obj).html('<div id="DIVfiles_' + idObj + '" style="width:400px;display:none;" onclick="clear_tmp(\'' + idObj + '\');">' +
            '<b>Estas subiendo archivos en otra ventana de itracker?</b><br/>' +
            'Solo se puede subir archivos de un caso a la vez, cuando finalices o si no estas cargando nada presiona en <div class="lnk_blue" style="cursor:pointer;">CONTINUAR</div><br/>' +
            '</div><div id="DIVall_' + idObj + '" style="width:400px;display:none;">' +
            '<div style="padding-top:20px;padding-left:50px;background-image:url(img/fileuploader.png);background-repeat:no-repeat;height:95px;width:350px">' +
            '<p style="color: gray;font-size:12px;">Puede pegar imagenes con el atajo CTRL+V<br/>' +
            '<input id="INPadd_' + idObj + '" type="file" name="files[]">' +
            '<div style="margin:0px;padding:0px;font-size:9px;" id="DIVstatus_' + idObj + '"></div>' +
            '</p>' +
            '</div>' +
            '<div style="height:80px;" id="DIVadded_' + idObj + '"></div>' +
            '</div>');
    $("#INPadd_" + idObj).fileupload({
        url: '?L=fileuploader',
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (id, item) {
                if (item.error == undefined) {
                    $('#DIVstatus_' + idObj).html("<b>Archivo cargado.</b>");
                    add_pv(item.name, idObj);
                } else {
                    $('#DIVstatus_' + idObj).html("<b>" + item.error + "</b>");
                }

            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            if (progress == 100) {
                $('#DIVstatus_' + idObj).html("<b>" + "Cargado, procesando..." + "</b>");
            } else {
                $('#DIVstatus_' + idObj).html("<b>" + "Subiendo: " + progress + "%" + "</b>");
            }
        }
    }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    $.post("?L=fileuploader", {'function': 'empty'},
    function (data) {
        if (data == 0) {
            $("#DIVall_" + idObj).show();
            $("#DIVfiles_" + idObj).hide();
        } else {
            $("#DIVfiles_" + idObj).show();
            $("#DIVall_" + idObj).hide();
        }
    }
    )
            ;
};

/*
 * Elimina un temporal
 **/
function file_delete(file) {
    dirI = file;
    $.post(
            "?L=fileuploader",
            {
                'function': 'delete',
                file: dirI.replace("-", "/")
            }, function (data) {
        if ($.trim(data) == "ok")
        {
            $(".FILEPV").each(function () {
                if ($(this).attr('id') == file) {
                    $(this).remove();
                }
            })

        }
        else
            alert_p("Error al eliminar archivo:" + data, 'Error');
    }
    );

}

/*
 *Elimina todas las imagenes del servidor
 **/
function clear_tmp(idObj) {

    $.post(
            "?L=fileuploader",
            {
                'function': 'clear_tmp'
            }, function (data) {
        if (data != "ok") {
            alert_p("Error al eliminar temporales, consulte a su administrador." + data, "Error");
            return;
        }
        $(".FILEPV").each(function () {
            $(this).remove();
        });
        $(".CANCELBT").each(function () {
            $(this).click();
        });

        $(".DIVADD").css("height", "0px");
        $("#SUBIENDO").remove();
        $("#DIVall_" + idObj).show();
        $("#DIVfiles_" + idObj).hide();
    }
    );

}

/*
 * Agrega el Preview
 **/
function add_pv(fileName, idUpl) {
    var splitName = fileName.split(".");
    var fileNameEXT = splitName[splitName.length - 1].toLowerCase();
    $('#DIVadded_' + idUpl).append('<div class="FILEPV" id="' + fileName.replace("/", "-") + '" style="margin:5px;width:100px;height:40px;float:left;text-align:center;"><table style="width:100%;height:100%;text-align:center;"><tr><td valign="middle"><a <a href="download.php?path=includes/js/jq/FileUploader/TMP&file=' + fileName + '&internal=1" target="_blank" ><img  height="30" src="img/thumbnail/' + fileNameEXT + '.png" /></a></td></tr><tr><td style="height:10px;"><a href="javascript:file_delete(\'' + fileName.replace("/", "-") + '\')"><img height="15" width="55" src="img/fileuploader_delete.png" /></a></td></tr></table></div>');
}

