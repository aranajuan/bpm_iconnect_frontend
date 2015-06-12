<link rel="stylesheet" media="all" type="text/css" href="css/base.css?v=<?=VERSION;?>" />
<link rel="stylesheet" media="all" type="text/css" href="css/menu.css?v=<?=VERSION;?>" />
<link rel="stylesheet" media="all" type="text/css" href="css/tkt_details.css?v=<?=VERSION;?>" />
<script src="js/classes/jsonie.js?v=<?=VERSION;?>" type="text/javascript"></script>
<link rel="stylesheet" media="all" type="text/css" href="js/classes/jui/themes/smoothness/jquery-ui.css?v=<?=VERSION;?>" />
<script src="js/classes/jui/external/jquery/jquery.js?v=<?=VERSION;?>" type="text/javascript"></script>
<script src="js/classes/jui/jquery-ui.js?v=<?=VERSION;?>" type="text/javascript"></script>

<script src="js/classes/FileUploader/js/vendor/jquery.ui.widget.js?v=<?=VERSION;?>"></script>
<script src="js/classes/FileUploader/js/jquery.iframe-transport.js?v=<?=VERSION;?>"></script>
<script src="js/classes/FileUploader/js/jquery.fileupload.js?v=<?=VERSION;?>"></script>
<script src="js/classes/datatable/js/jquery.dataTables.min.js?v=<?=VERSION;?>" type="text/javascript"></script>
<script src="js/classes/FileUploader/fileuploader.js?v=<?=VERSION;?>" type="text/javascript"></script>
<script src="js/classes/multiselect/src/jquery.multiselect.js?v=<?=VERSION;?>" type="text/javascript"></script>
<script src="js/classes/multiselect/src/jquery.multiselect.filter.js?v=<?=VERSION;?>" type="text/javascript"></script>
<script src="js/classes/idSEL/idSEL.js?v=<?=VERSION;?>" type="text/javascript"></script>
<script src="js/classes/tinymce/jscripts/tiny_mce/tiny_mce.js?v=<?=VERSION;?>" type="text/javascript"></script>
<script src="js/classes/tinyscrollbar.js?v=<?=VERSION;?>" type="text/javascript"></script>
<script src="js/classes/timepicker/jquery-ui-timepicker-addon.js?v=<?=VERSION;?>" type="text/javascript"></script>

<script src="js/classes/basic_functions.js?v=<?=VERSION;?>" type="text/javascript"></script>
<script src="js/classes/notify_functions.js?v=<?=VERSION;?>" type="text/javascript"></script>
<script src="js/classes/postcontrol.js?v=<?=VERSION;?>" type="text/javascript"></script>
<script src="js/classes/user.js?v=<?=VERSION;?>" type="text/javascript"></script>


<script src="js/menu.js?v=<?=VERSION;?>" type="text/javascript"></script>
<script src="js/header_H.js?v=<?=VERSION;?>" type="text/javascript"></script>

<link rel="stylesheet" media="all" type="text/css" href="js/classes/multiselect/jquery.multiselect.css?v=<?=VERSION;?>" />
<link rel="stylesheet" media="all" type="text/css" href="js/classes/multiselect/jquery.multiselect.filter.css?v=<?=VERSION;?>" />


<link rel="stylesheet" media="all" type="text/css" href="js/classes/timepicker/timepicker.css?v=<?=VERSION;?>" />

<style>
    @import "js/classes/datatable/css/demo_table_jui.css?v=<?=VERSION;?>";
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
    <script src="js/<?= $R->get_param("L"); ?>.js?v=<?=VERSION;?>" type="text/javascript"></script>
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