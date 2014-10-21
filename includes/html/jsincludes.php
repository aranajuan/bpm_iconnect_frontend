<link rel="stylesheet" media="all" type="text/css" href="css/base.css" />
<link rel="stylesheet" media="all" type="text/css" href="css/menu.css" />
<script src="js/menu.js" type="text/javascript"></script>
<script src="js/header_H.js" type="text/javascript"></script>
<script src="js/jq/js/jquery-1.6.2.js" type="text/javascript"></script>

<script src="js/jq/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>

<script src="js/jq/FileUploader/js/vendor/jquery.ui.widget.js"></script>
<script src="js/jq/FileUploader/js/jquery.iframe-transport.js"></script>
<script src="js/jq/FileUploader/js/jquery.fileupload.js"></script>

<script src="js/jq/datatable/js/jquery.dataTables.min.js" type="text/javascript"></script>


<script src="js/jq/FileUploader/fileuploader.js" type="text/javascript"></script>


<script src="js/jq/multiselect/src/jquery.multiselect.js" type="text/javascript"></script>
<script src="js/jq/multiselect/src/jquery.multiselect.filter.js" type="text/javascript"></script>

<script src="js/jq/idSEL/idSEL.js" type="text/javascript"></script>

<script src="js/jq/tinymce/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
<script src="js/jq/tinyscrollbar.js" type="text/javascript"></script>


<link rel="stylesheet" media="all" type="text/css" href="js/jq/multiselect/jquery.multiselect.css" />
<link rel="stylesheet" media="all" type="text/css" href="js/jq/multiselect/jquery.multiselect.filter.css" />
<link rel="stylesheet" media="all" type="text/css" href="js/jq/css/cupertino/jquery-ui-1.8.23.custom.css" />
<link rel="stylesheet" media="all" type="text/css" href="js/jq/css/custom-theme/jquery.ui.theme.css" />


<script src="js/jq/timepicker/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
<link rel="stylesheet" media="all" type="text/css" href="js/jq/timepicker/timepicker.css" />

<style>
    @import "js/jq/datatable/css/demo_table_jui.css";
    .dataTables_info { padding-top: 0; }
    .dataTables_paginate { padding-top: 0; }
    .css_right { float: right; }
    #example_wrapper .fg-toolbar { font-size: 0.8em }
    #theme_links span { float: left; padding: 2px 10px; }
</style>


<script src="js/jq/basic_functions.js" type="text/javascript"></script>
<script src="js/jq/notify_functions.js" type="text/javascript"></script>
<script src="js/jq/postcontrol.js" type="text/javascript"></script>
<script src="js/jq/user.js" type="text/javascript"></script>
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