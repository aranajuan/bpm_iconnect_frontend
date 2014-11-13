<?php

/**
 * Genera formulario html y js
 */
class formmaker {

    private $vector;
    private $masterID;
    private $html_output;
    private $vectorIds;

    public function __construct($id) {
        $this->masterID = $id;
        $this->vectorIds = array();
    }

    public function load_vector($itformVector) {
        $this->vector = $itformVector;
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
                switch ($el["type"]) {
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
                    case "file":
                        $html.=$this->make_file($el);
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
                        $html.=$this->make_fileupl($el);
                        break;
                    default:
                        $html.=$this->putintable("error campo", print_r($el, true), "consulte a su administrador");
                }
            }
        }
        $html.="</table></div>";
        $this->html_output = $html;
    }

    public function get_html() {
        $this->make_html();
        return $this->html_output;
    }

    private function putintable($label, $field, $comment = null) {
        if ($comment == null) {
            return "<tr><td>" . $label . "&nbsp;</td><td colspan='2'>" . $field . "</td></tr>";
        }
        return "<tr><td>" . $label . "&nbsp;</td><td>" . $field . "</td><td>" . $comment . "&nbsp;</td></tr>";
    }

    private function make_input($el) {
        return $this->putintable($el["label"], "<input type='text' class='" . $el["formclass"] . "' id='" . $el["id"] . "' />", $el["comment"]);
    }

    private function make_text($el) {
        return "<tr><td colspan='3'>" . $el["text"] . "</td></tr>";
    }

    private function make_inputlong($el) {
        return $this->putintable($el["label"], "<textarea class='" . $el["formclass"] . "' id='" . $el["id"] . "'></textarea>");
    }

    private function make_month($el) {
        return $this->putintable($el["label"], "<input type='text' class='" . $el["formclass"] . " monthselector' id='" . $el["id"] . "' />", $el["comment"]);
    }

    private function make_date($el) {
        return $this->putintable($el["label"], "<input type='text' class='" . $el["formclass"] . " dtpck' id='" . $el["id"] . "' />", $el["comment"]);
    }

    private function make_datetime($el) {
        return $this->putintable($el["label"], "<input type='text' class='" . $el["formclass"] . " tmpck' id='" . $el["id"] . "' />", $el["comment"]);
    }

    private function make_file($el) {
        return $this->putintable($el["label"], "<div type='text' class='" . $el["formclass"] . " FILEUPL' id='" . $el["id"] . "' />");
    }

    private function make_link($el) {
        return $this->putintable($el["label"], "<a target='_blank' href='?download=" . $el["path"] . "'>" . $el["text"] . "</a>", $el["comment"]);
    }

    private function make_select($el) {
        $select = "<select id='" . $el["id"] . "' class='" . $el["formclass"] . "'>";
        foreach ($el["option"] as $o) {
            $select.="<option value='" . $o["value"] . "' >" . $o["text"] . "</option>";
        }
        $select.="</select>";
        return $this->putintable($el["label"], $select, $el["comment"]);
    }

    private function make_hide($el) {
        return "<tr><td colspan'3'><input type='hidden' id='" . $el["id"] . "' class='" . $el["formclass"] . "'/></td></tr>";
    }
    
    private function make_fileupl($el) {
        return $this->putintable($el["label"], "<div id='" . $el["id"] . "' class='FILEUPL " . $el["formclass"] . "'></div>");
    }

    
}