<?
    require_once   'header.php';
    require_once 'clases/form_checker.php';
    
    error_reporting(E_ALL);
    $f= new form_checker();
    echo $f->get_java_valid();
?>
<link rel="stylesheet" media="all" type="text/css" href="<?=HINCLUDE_DIR;?>/css/tree.css" />
<div >
    <div><h2>NUEVO TICKET</h2></div>
</div>

<div id="tree" style="padding: 5px;"></div>
<div id="popup_similars" class="popup" style="overflow: auto;"></div>

<?
    require_once   'footer.php';
?>