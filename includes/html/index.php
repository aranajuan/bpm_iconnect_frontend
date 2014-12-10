<div style="width: 100%;text-align: center;padding-top:40px;padding-bottom:40px;">
    <div style="width: 49%;text-align: center;float:left;">
        <? if($U->check_access("PAGE", "mytkts")){ ?>
            <a href="?L=mytkts"><img src="img/con_but.png" class="img_lnk" onmouseover="this.src='img/con_but_over.png'" onmouseout="this.src='img/con_but.png'"/></a>
        <?}elseif($U->check_access("PAGE", "staffhome")){?>
            <a href="?L=staffhome"><img src="img/con_but.png" class="img_lnk" onmouseover="this.src='img/con_but_over.png'" onmouseout="this.src='img/con_but.png'"/></a>
        <?}?>
    </div>
    <div style="width: 50%;text-align: center;float:left;">
        <a href="?L=newtkt"><img src="img/new_but.png" class="img_lnk" onmouseover="this.src='img/new_but_over.png'" onmouseout="this.src='img/new_but.png'"/></a>
    </div>
    
</div>