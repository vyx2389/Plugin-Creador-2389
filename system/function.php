<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @package WordPress Plugin Maker
 * @license Commercial License
 */

defined("EXEC") or die();


function max_select($name)
{
    $content = null;

    $content .= '<select class="form-control" name="input" onchange="var val=this.options[this.selectedIndex].value;this.selectedIndex=0;window.top.location.href=\'./?page=' . $name . '&amp;act=max-' . $name . '&amp;max-' . $name . '=\' + val">';
    $content .= '<option>-- Max ' . ucwords(str_replace('-', ' ', ($name))) . '</option>';
    for ($i = 0; $i < 50; $i++)
    {
        $selected = '';
        if (isset($_GET['max-' . $name]))
        {
            if ($_GET['max-' . $name] == ($i + 1))
            {
                $selected = 'selected';
            }
        }
        $content .= '<option value="' . ($i + 1) . '" ' . $selected . '>' . ($i + 1) . ' ' . ucwords(str_replace('-', ' ', ($name))) . '</option>';
    }
    $content .= '</select>';
    return $content;
}

