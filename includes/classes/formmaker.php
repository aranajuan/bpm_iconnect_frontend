<?php

/**
 * Genera formulario html y js
 */
class formmaker {

    private $vector;
    private $masterID;
    private $html_output;
    private $js;
    private $vectorIds;
    private $statics;

    /**
     * Requiere archivos adjuntos
     * @var boolean
     */
    private $fileRequired;
    /**
     *
     * @param type $id  formid - eventid
     */
    public function __construct($id=null) {
        $this->masterID = $id;
        $this->js = "";
        $this->vectorIds = array();
        $this->fileRequired=false;
    }

    public function load_vector($itformVector, $statics = null) {
        $this->vector = $itformVector;
        $this->statics = $statics;
    }

    private function make_html() {
        $html = "<div style='float:left;width:100%'><table>";
        foreach ($this->vector as &$el) {
            if (in_array($el["id"], $this->vectorIds) || $el["id"] === "" || !isset($el["id"])) {
                $html.=$this->putintable("error campo", print_r($el, true), "consulte a su administrador");
            } else {
                array_push($this->vectorIds, $el["id"]);
                $el["id"] = $this->masterID . "_" . $el["id"];
                $el["formclass"] = $this->masterID;
                switch (trim($el["type"])) {
                    case "input":
                        $html.=$this->make_input($el);
                        break;
                    case "text":
                        $html.=$this->make_text($el);
                        break;
                    case "inputlong":
                        $html.=$this->make_inputlong($el);
                        break;
                    case "month":
                        $html.=$this->make_month($el);
                        break;
                    case "date":
                        $html.=$this->make_date($el);
                        break;
                    case "datetime":
                        $html.=$this->make_datetime($el);
                        break;
                    case "link":
                        $html.=$this->make_link($el);
                        break;
                    case "select":
                        $html.=$this->make_select($el);
                        break;
                    case "hidden":
                        $html.=$this->make_hide($el);
                        break;
                    case "fileupl":
                        $this->fileRequired=true;
                        $html.=$this->make_fileupl($el);
                        break;
                    case "idsel":
                        $html.=$this->make_idsel($el);
                        break;
                    default:
                        $html.=$this->putintable("error campo", print_r($el, true), "consulte a su administrador");
                }
            }
        }
        $html.="</table></div>";
        $html.="<script>" . $this->js . "</script>";
        $this->html_output = $html;
    }

    public function get_html() {
        $this->make_html();
        return $this->html_output;
    }

    /**
     * Se requieren adjuntos (se carga despues del make)
     * @return boolean
     */
    public function isfileRequired(){
        return $this->fileRequired;
    }


    /**
     * Devuelve vista html
     * @param array<String> $hideTypes type a ocultar
     * @param boolean $hideTypes ocultar comentarios
     * @return string
     */
    public function get_htmlview($hideTypes = null,$hideCommets=false) {
        $html = "<div style='width:100%'><table>";
        foreach ($this->vector as &$el) {
            if (in_array($el["id"], $this->vectorIds) || $el["id"] === "" || !isset($el["id"])) {
                $html.=$this->putintable("error campo", print_r($el, true), "consulte a su administrador");
            } else {
                array_push($this->vectorIds, $el["id"]);
                $el["id"] = $this->masterID . "_" . $el["id"];
                $el["formclass"] = $this->masterID;
                $type = trim($el["type"]);
                if(in_array($type, $hideTypes)){
                    continue;
                }
                if($hideCommets){
                    $el["comment"]=null;
                }
                switch ($type) {
                    case "input":
                        $html.=$this->make_input_view($el);
                        break;
                    case "text":
                        $html.=$this->make_text_view($el);
                        break;
                    case "inputlong":
                        $html.=$this->make_inputlong_view($el);
                        break;
                    case "month":
                        $html.=$this->make_month_view($el);
                        break;
                    case "date":
                        $html.=$this->make_date_view($el);
                        break;
                    case "datetime":
                        $html.=$this->make_datetime_view($el);
                        break;
                    case "link":
                        $html.=$this->make_link_view($el);
                        break;
                    case "select":
                        $html.=$this->make_select_view($el);
                        break;
                    case "hidden":
                        $html.=$this->make_hide_view($el);
                        break;
                    case "fileupl":
                        $html.=$this->make_fileupl_view($el);
                        break;
                    case "idsel":
                        $html.=$this->make_idsel_view($el);
                        break;
                    default:
                        $html.=$this->putintable("error campo", print_r($el, true), "consulte a su administrador");
                }
            }
        }
        $html.="</table></div>";
        $html.="<script>" . $this->js . "</script>";
        return $html;
    }

    private function putintable($label, $field, $comment = null) {
        if ($comment == null) {
            return "<tr><td><b>" . $label . "&nbsp;</b></td><td colspan='2'>" . $field . "</td></tr>";
        }
        return "<tr><td><b>" . $label . "&nbsp;</b></td><td>" . $field . "</td><td>" . $comment . "&nbsp;</td></tr>";
    }

    private function make_input($el) {
        return $this->putintable($el["label"], "<input type='text' class='" . $el["formclass"] . "' id='" . $el["id"] . "' value='" . $el["value"] . "'/>", $el["comment"]);
    }

    private function make_text($el) {
        return "<tr><td colspan='3'>" . $el["text"] . "</td></tr>";
    }

    private function make_inputlong($el) {
        return $this->putintable($el["label"], "<textarea rows='4' cols='50' class='" . $el["formclass"] . "' id='" . $el["id"] . "'>" . $el["value"] . "</textarea>");
    }

    private function make_month($el) {
        return $this->putintable($el["label"], "<input type='text' class='" . $el["formclass"] . " monthpck' id='" . $el["id"] . "' value='" . $el["value"] . "' />", $el["comment"]);
    }

    private function make_date($el) {
        return $this->putintable($el["label"], "<input type='text' class='" . $el["formclass"] . " dtpck' id='" . $el["id"] . "' value='" . $el["value"] . "'/>", $el["comment"]);
    }

    private function make_datetime($el) {
        return $this->putintable($el["label"], "<input type='text' class='" . $el["formclass"] . " tmpck' id='" . $el["id"] . "' value='" . $el["value"] . "'/>", $el["comment"]);
    }

    private function make_link($el) {
        $value=$this->link_adapt($el["path"].$el["value"], $el["text"], true);
        return $this->putintable($el["label"],$value  , $el["comment"]);
    }

    private function make_select($el) {
        $select = "<select id='" . $el["id"] . "' class='" . $el["formclass"] . " multiselect_simple'>";
        $opts = make_arrayobj($el["option"]);
        foreach ($opts as $o) {
            $SELECTED="";
            if($o["value"] == $el["value"]){
                $SELECTED="SELECTED";
            }
            $select.="<option $SELECTED value='" . $o["value"] . "' >" . $o["text"] . "</option>";
        }
        $select.="</select>";
        return $this->putintable($el["label"], $select, $el["comment"]);
    }

    private function make_hide($el) {
        return "<tr><td colspan'3'><input type='hidden' id='" . $el["id"] . "' class='" . $el["formclass"] . "' value='" . $el["value"] . "'/></td></tr>";
    }

    private function make_fileupl($el) {
        return $this->putintable($el["label"], "<div id='" . $el["id"] . "' class='FILEUPL " . $el["formclass"] . "'></div>");
    }

    private function make_idsel($el) {
        $this->js.="$('#" . $el["id"] . "').idSEL({'class':'" . $el["idselparams"]["class"] . "','method':'" . $el["idselparams"]["method"] . "',params:{idtkt:'" . $this->statics["tkt"]["id"] . "'} });";
        return $this->putintable($el["label"], "<div id='" . $el["id"] . "' class='" . $el["formclass"] . "'></div>");
    }


    /* view */

    private function make_input_view($el) {
        $value=$this->link_adapt($el["value"]);
        return $this->putintable($el["label"], $value, $el["comment"]);
    }

    private function make_text_view($el) {
        return "<tr><td colspan='3'>" . $el["text"] . "</td></tr>";
    }

    private function make_inputlong_view($el) {
        return $this->putintable($el["label"],  $el["value"] );
    }

    private function make_month_view($el) {
        return $this->putintable($el["label"],$el["value"] , $el["comment"]);
    }

    private function make_date_view($el) {
        return $this->putintable($el["label"], $el["value"], $el["comment"]);
    }

    private function make_datetime_view($el) {
        return $this->putintable($el["label"], $el["value"], $el["comment"]);
    }

    private function make_link_view($el) {
        $value=$this->link_adapt($el["path"].$el["value"], $el["text"], true);
        return $this->putintable($el["label"], $value  , $el["comment"]);
    }

    /**
     * Verifica si es un link y lo devuelve armado
     * @param string $dest  posible link
     * @param string $text  texto link
     * @param boolean $force    forzar generacion de link
     * @return string   link o valor
     */
    private function link_adapt($dest,$text=null,$force=false){
        if(!$text || $text==""){
            $text=$dest;
        }
        $dest=trim($dest);
        if(filter_var($dest, FILTER_VALIDATE_URL) != false){
            return "<a class='lnk_blue' href='$dest' target='_blank'>$text</a>";
        }else{
            if($force){
                return "<a class='lnk_blue' href='?class=tkt&method=downloadfile&type=anexo&file=".$dest."' target='_blank'>" .$text."</a>";
            }else{
                return $dest;
            }
        }
    }

    private function make_select_view($el) {
        $ans="";
        $opts = make_arrayobj($el["option"]);
        foreach ($opts as $o) {
            if($o["value"]==$el["value"])
                $ans=$o["text"];
        }

        return $this->putintable($el["label"], $ans, $el["comment"]);
    }

    private function make_hide_view($el) {
        return "";
    }

    private function make_fileupl_view($el) {
        return "";
    }

    private function make_idsel_view($el) {
        return "";
    }

}
