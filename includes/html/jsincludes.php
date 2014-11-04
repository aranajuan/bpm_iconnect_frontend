<link rel="stylesheet" media="all" type="text/css" href="css/base.css" />
<link rel="stylesheet" media="all" type="text/css" href="css/menu.css" />

<link rel="stylesheet" media="all" type="text/css" href="js/classes/jui/themes/smoothness/jquery-ui.css" />
<script src="js/classes/jui/external/jquery/jquery.js" type="text/javascript"></script>
<script src="js/classes/jui/jquery-ui.js" type="text/javascript"></script>

<script src="js/classes/FileUploader/js/vendor/jquery.ui.widget.js"></script>
<script src="js/classes/FileUploader/js/jquery.iframe-transport.js"></script>
<script src="js/classes/FileUploader/js/jquery.fileupload.js"></script>
<script src="js/classes/datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="js/classes/FileUploader/fileuploader.js" type="text/javascript"></script>
<script src="js/classes/multiselect/src/jquery.multiselect.js" type="text/javascript"></script>
<script src="js/classes/multiselect/src/jquery.multiselect.filter.js" type="text/javascript"></script>
<script src="js/classes/idSEL/idSEL.js" type="text/javascript"></script>
<script src="js/classes/tinymce/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
<script src="js/classes/tinyscrollbar.js" type="text/javascript"></script>
<script src="js/classes/timepicker/jquery-ui-timepicker-addon.js" type="text/javascript"></script>

<script src="js/classes/basic_functions.js" type="text/javascript"></script>
<script src="js/classes/notify_functions.js" type="text/javascript"></script>
<script src="js/classes/postcontrol.js" type="text/javascript"></script>
<script src="js/classes/user.js" type="text/javascript"></script>


<script src="js/menu.js" type="text/javascript"></script>
<script src="js/header_H.js" type="text/javascript"></script>

<link rel="stylesheet" media="all" type="text/css" href="js/classes/multiselect/jquery.multiselect.css" />
<link rel="stylesheet" media="all" type="text/css" href="js/classes/multiselect/jquery.multiselect.filter.css" />


<link rel="stylesheet" media="all" type="text/css" href="js/classes/timepicker/timepicker.css" />

<style>
    @import "js/classes/datatable/css/demo_table_jui.css";
    .dataTables_info { padding-top: 0; }
    .dataTables_paginate { padding-top: 0; }
    .css_right { float: right; }
    #example_wrapper .fg-toolbar { font-size: 0.8em }
    #theme_links span { float: left; padding: 2px 10px; }
</style>



<script>
    user.id = '<?= $U->get_prop("usr"); ?>';
    user.name = '<?= $U->get_prop("nombre"); ?>';
</script>
<?
if ($canAccess) {
    ?>
    <script src="js/<?= $R->get_param("L"); ?>.js" type="text/javascript"></script>

<? } else {
    ?>
    <script>
        function main() {
            fatal_error('<? echo strToJava($HeaderMsjUser); ?>');
        }
    </script>
<?
}?>

    <script>
        var JAVA_LOADING = '<img src="img/loading.gif" width="20" height="20" alt="cargando.." />';
        var JAVA_ERROR = 'Error en JS/JQ.';
    </script>