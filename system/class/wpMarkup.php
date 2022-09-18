<?php

class wpMarkup
{
    var $fields = array();

    /**
     * html_form::addField()
     * 
     * @param mixed $field
     * @return
     */
    public function addField($field)
    {
        if ($field['name'] != '')
        {
            $this->fields[] = $field;
        }

    }
    /**
     * html_form::Code()
     * 
     * @return
     */
    function Code()
    {
        $code = null;
        foreach ($this->fields as $field)
        {
            $code .= $this->input($field);
        }
        return $code;
    }

    private function input($field)
    {
        $enter = "\r\n";
        $tab = "\t";
        $html = null;
        $type = strtolower($field['type']);
        switch ($type)
        {

            case 'text':
                $html .= '<div class="form-group">' . $enter;
                $html .= $tab . '<label for="' . $field['name'] . '">' . $field['label'] . '</label>' . $enter;
                $html .= $tab . '<input class="form-control" type="text" name="' . $field['name'] . '" placeholder="' . $field['explanation'] . '"/>' . $enter;
                //$html .= $tab . '<p class="help-block">' . $field['explanation'] . '</p>' . $enter;
                $html .= '</div>';
                $html .=  $enter;
                break;
            case 'textarea':
                $html .= '<div class="form-group">' . $enter;
                $html .= $tab . '<label for="' . $field['name'] . '">' . $field['label'] . '</label>' . $enter;
                $html .= $tab . '<textarea class="form-control" name="' . $field['name'] . '" ></textarea>' . $enter;
                //$html .= $tab . '<p class="help-block">' . $field['explanation'] . '</p>' . $enter;
                $html .= '</div>';
                $html .=  $enter;
                break;

        
        }
        return $html;
    }
}

?>