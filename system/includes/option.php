<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @package WordPress Plugin Maker
 * @license Commercial License
 */

defined("EXEC") or die();

if ($_SESSION['current_project'] != null)
{
    $current_set = '';

    $current_properties = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.project.json'), true);
    if (!isset($_GET['act']))
    {
        $_GET['act'] = null;
    }

    if (!isset($_GET['max-option']))
    {
        $_GET['max-option'] = 3;
    }

    if ($_GET['max-option'] == 0)
    {
        $_GET['max-option'] = 3;
    }

    if (isset($_POST['save']))
    {
        //check if project locked
        if ($current_properties['lock'] == 'true')
        {
            header('Location: ./?page=project&err=locked_project');
            exit(0);
        }
        $links = $_POST['options'];
        file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.option.json', json_encode($links));
        rebuild();
        header('Location: ./?page=option&max-option=' . (int)$_GET['max-option']);
    }
    if ($_GET['act'] == 'reset')
    {
        @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.option.json');
        header('Location: ./?page=option&max-option=' . (int)$_GET['max-option']);
    }

    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'))
    {
        $current_post_types = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'), true);
        foreach ($current_post_types as $post_type)
        {
            $metabox_hooks[] = $post_type['name'];
            $sub_type[] = $post_type['name'];

        }
    }
    $sub_type[] = 'post';
    $sub_type[] = 'page';


    $_content = null;
    $_content .= '<form action="" method="post" enctype="multipart/form-data" >';
    $_content .= '<div class="row">';

    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.option.json'))
    {
        $current_options = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.option.json'), true);
        $current_set = '<span class="badge">' . count($current_options) . '</span>';
        if (count($current_options) != $_GET['max-option'])
        {
            if ($_GET['act'] != 'max-option')
            {
                header('Location: ./?page=option&max-option=' . count($current_options));
            }

        }
    }

    $type_options[] = array('type' => 'text', 'label' => 'Tiny Text');
    $type_options[] = array('type' => 'textarea', 'label' => 'Large Text (textarea)');
    $type_options[] = array('type' => 'checkbox', 'label' => 'Checkbox');
    $type_options[] = array('type' => 'select', 'label' => 'Select (Dropdown)');
    $type_options[] = array('type' => 'radio', 'label' => 'Select (Radio)');
    $type_options[] = array('type' => 'wpcolor', 'label' => 'WordPress - Color Picker');
    $type_options[] = array('type' => 'media-upload', 'label' => 'WordPress - Media Upload');
    $type_options[] = array('type' => 'wp_dropdown_pages', 'label' => 'WordPress - Dropdown Pages');
 
    $type_options[] = array('type' => 'wp_dropdown_categories', 'label' => 'WordPress - Dropdown Categories');
    $type_options[] = array('type' => 'wp_dropdown_users', 'label' => 'WordPress - Dropdown Users');

    for ($i = 1; $i <= (int)$_GET['max-option']; $i++)
    {
        $x = $i - 1;
        $option['name'] = '';
        $option['type'] = '';
        $option['sub_type'] = '';
        $option['label'] = '';
        $option['default'] = '';
        $option['explanation'] = '';
        $option['enum'] = array();

        if (isset($current_options[$x]))
        {
            $option = $current_options[$x];
            if (!isset($option['label']))
            {
                $option['label'] = '';
            }
        }

        $_content .= '<div class="col-md-6" id="box-' . $x . '">';
        $_content .= '<div class="panel panel-default">';
        $_content .= '<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-wrench"></i> Option (' . $i . ') <a class="remove btn btn-default btn-xs pull-right" href="#box-' . $x . '"><span class="fa fa-trash"></span> ' . $option['name'] . '</a></h4></div>';
        $_content .= '<div class="panel-body">';
        $_content .= '<div class="form-group" id="options_' . $x . '_name"><label>Name</label><input data-type="var" placeholder="lorem_ipsum" class="form-control" type="text" name="options[' . $x . '][name]" value="' . $option['name'] . '" required="required"/></div>';
        $_content .= '<div class="form-group" id="options_' . $x . '_label"><label>Label</label><input placeholder="Lorem Ipsum" class="form-control" type="text" name="options[' . $x . '][label]" value="' . $option['label'] . '" /></div>';
        $option_tag = null;
        $option_tag .= '<select class="option_type form-control" name="options[' . $x . '][type]" data-explanation="#options_' . $x . '_explanation" data-label="#options_' . $x . '_label" data-enum="#options_' . $x . '_enum" data-sub-type="#options_' . $x . '_sub_type">';
        foreach ($type_options as $type_option)
        {
            $selected = '';
            if ($type_option['type'] == $option['type'])
            {
                $selected = 'selected';
            }
            $option_tag .= '<option value="' . $type_option['type'] . '" ' . $selected . '>' . $type_option['label'] . '</option>';
        }
        $option_tag .= '</select>';

        $_content .= '<div class="form-group"><label>Type</label>' . $option_tag . '</div>';


        $_content .= '<div class="form-group" id="options_' . $x . '_sub_type" >';
        $_content .= '<label>Data</label>';
        $_content .= '<select class="form-control" name="options[' . $x . '][sub_type]" >';

        foreach ($sub_type as $_sub_type)
        {
            if (!isset($option['sub_type']))
            {
                $option['sub_type'] = '';
            }
            $selected = '';
            if ($_sub_type == $option['sub_type'])
            {
                $selected = 'selected';
            }
            $_content .= '<option value="' . $_sub_type . '" ' . $selected . '>' . $_sub_type . '</option>';
        }
        $_content .= '</select>';
        $_content .= '</div>';

        if (!isset($option['explanation']))
        {
            $option['explanation'] = '';
        }
        $_content .= '<div class="form-group" id="options_' . $x . '_default" ><label>Default Value</label><input  class="form-control" type="text" name="options[' . $x . '][default]" value="' . $option['default'] . '" /></div>';
        $_content .= '<div class="form-group" id="options_' . $x . '_explanation" ><label>Explanation</label><input class="form-control" type="text" name="options[' . $x . '][explanation]" value="' . $option['explanation'] . '" /></div>';


        $_content .= '<div class="form-group" id="options_' . $x . '_enum" >';
        $_content .= '<label>Enumerate (Option)</label>';
        for ($z = 0; $z < MAX_OPTION_ENUM_OPTION; $z++)
        {
            if (!isset($option['enum'][$z]['value']))
            {
                $option['enum'][$z]['value'] = '';
                $option['enum'][$z]['label'] = '';
            }
            $_content .= '<div>';
            $_content .= '<div class="col-md-6"><div class="form-group"><input data-type="var" class="form-control" placeholder="value" type="text" name="options[' . $x . '][enum][' . $z . '][value]" value="' . $option['enum'][$z]['value'] . '" /></div></div>';
            $_content .= '<div class="col-md-6"><div class="form-group"><input class="form-control" placeholder="label" type="text" name="options[' . $x . '][enum][' . $z . '][label]" value="' . $option['enum'][$z]['label'] . '" /></div></div>';
            $_content .= '</div>';
        }
        $_content .= '</div>';


        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
    }
    $_content .= '</div>';
    $_content .= '<button type="submit" class="btn btn-primary" name="save"><span class="fa fa-floppy-o"></span> Save</button> ';
    $_content .= 'or <a href="./?page=option&act=reset">Remove</a> ';
    $_content .= '</form>';


    $content = null;
    $content .= '<a href="#help-box" data-toggle="collapse" class="label label-danger pull-right" ><span class="fa fa-question"></span></a>';

    $content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-gavel fa-stack-1x"></i></span> Options ' . $current_set . '</h2>';
    $content .= '<div id="help-box" class="panel-collapse collapse">';
    $content .= '<blockquote><p>Creating <strong>custom options</strong> panels in WordPress.</p></blockquote>';
    $content .= '<div class="row">';
    $content .= '<div class="col-md-4"><a class="colorbox" href="./templates/images/option.png" title="Custom Options" ><img class="img-thumbnail center-block" src="./templates/images/option.png" title="Custom Options" /></a></div>';
    $content .= '</div>';
    $content .= '<hr/>';
    $content .= '</div>';

    $content .= '<div class="row">';
    $content .= '<div class="col-md-6">';
    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-body">';
    $content .= max_select('option');
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="col-md-6">';
    $content .= '</div>';
    $content .= '</div>';


    $content .= $_content;

    define('JZ_CONTENT', $content);
    unset($content);
} else
{
    header('Location: ./?page=project&err=current_project');
}

?>