<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @package WordPress Plugin Maker
 * @license Commercial License
 */


defined('EXEC') or die();

if ($_SESSION['current_project'] != null)
{
    $type_options[] = array('type' => 'text', 'label' => 'Tiny Text');
    $type_options[] = array('type' => 'textarea', 'label' => 'Large Text (textarea)');
    $type_options[] = array('type' => 'checkbox', 'label' => 'Checkbox');
    $type_options[] = array('type' => 'select', 'label' => 'Select (Option)');
    $type_options[] = array('type' => 'radio', 'label' => 'Select (Radio)');
    $type_options[] = array('type' => 'wp_dropdown_pages', 'label' => 'WordPress - Dropdown Pages');
    $type_options[] = array('type' => 'wp_dropdown_categories', 'label' => 'WordPress - Dropdown Categories');
    $type_options[] = array('type' => 'wp_dropdown_users', 'label' => 'WordPress - Dropdown Users');

    $type_options[] = array('type' => 'wpcolor', 'label' => 'WordPress - Color Picker');
    $type_options[] = array('type' => 'wpmedia', 'label' => 'WordPress - Media (Upload)');

    //$type_options[] = array('type' => 'media-upload', 'label' => 'WordPress - Media Upload');
    //$type_options[] = array('type' => 'media-upload-dinamic', 'label' => 'WordPress - Media Upload (Dinamic)');
    //$type_options[] = array('type' => 'wp_dropdown_pages_dinamic', 'label' => 'WordPress - Dropdown Pages (Dinamic)');

    $current_set = '';
    $current_properties = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.project.json'), true);
    if (!isset($_GET['act']))
    {
        $_GET['act'] = null;
    }

    if (!isset($_GET['max-widget']))
    {
        $_GET['max-widget'] = 1;
    }

    if ($_GET['max-widget'] == 0)
    {
        $_GET['max-widget'] = 1;
    }

    $sample_code[0]['value'] = 'no_code';
    $sample_code[0]['label'] = 'HTML Only';

    $sample_code[1]['value'] = 'wp_list_pages';
    $sample_code[1]['label'] = 'WordPress - List Page (Default)';

    $sample_code[2]['value'] = 'get_posts';
    $sample_code[2]['label'] = 'WordPress - Get Posts (Manual)';

    $sample_code_enum[] = 'page';
    $sample_code_enum[] = 'post';
    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'))
    {
        $current_post_types = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'), true);
        foreach ($current_post_types as $post_type)
        {
            $sample_code_enum[] = $post_type['name'];
        }
    }


    if (isset($_POST['save']))
    { //check if project locked
        if ($current_properties['lock'] == 'true')
        {
            header('Location: ./?page=project&err=locked_project');
            exit(0);
        }
        $links = $_POST['widgets'];
        file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.widget.json', json_encode($links));
        rebuild();
        header('Location: ./?page=widget&max-widget=' . (int)$_GET['max-widget']);
    }
    if ($_GET['act'] == 'reset')
    {
        @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.widget.json');
        header('Location: ./?page=widget&max-widget=' . (int)$_GET['max-widget']);
    }
    $_content = null;

    $_content .= '<form action="" method="post" enctype="multipart/form-data" >';
    $_content .= '<div class="row">';

    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.widget.json'))
    {
        $current_widgets = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.widget.json'), true);
        $current_set = '<span class="badge">' . count($current_widgets) . '</span>';
        if (count($current_widgets) != $_GET['max-widget'])
        {
            if (($_GET['act'] != 'max-widget') && (count($current_widgets) != 0))
            {
                header('Location: ./?page=widget&max-widget=' . count($current_widgets));
            }

        }
    }

    for ($i = 1; $i <= (int)$_GET['max-widget']; $i++)
    {
        $x = $i - 1;
        $widget['id'] = '';
        $widget['title'] = '';
        $widget['desc'] = '';
        $widget['markup'] = '<h4>This Front End Widget Code</h4>';
        $widget['option'] = array();
        $widget['code'] = 'no_code';
        $widget['post_type'] = 'page';


        if (isset($current_widgets[$x]))
        {
            if (isset($current_widgets[$x]['id']))
            {
                $widget['id'] = $current_widgets[$x]['id'];
            }
            if (isset($current_widgets[$x]['title']))
            {
                $widget['title'] = $current_widgets[$x]['title'];
            }
            if (isset($current_widgets[$x]['desc']))
            {
                $widget['desc'] = $current_widgets[$x]['desc'];
            }
            if (isset($current_widgets[$x]['markup']))
            {
                $widget['markup'] = $current_widgets[$x]['markup'];
            }
            if (isset($current_widgets[$x]['option']))
            {
                $widget['option'] = $current_widgets[$x]['option'];
            }

            if (isset($current_widgets[$x]['code']))
            {
                $widget['code'] = $current_widgets[$x]['code'];
            }

            if (isset($current_widgets[$x]['post_type']))
            {
                $widget['post_type'] = $current_widgets[$x]['post_type'];
            }
            if (isset($current_widgets[$x]['js']))
            {
                $widget['js'] = $current_widgets[$x]['js'];
            }
            if (isset($current_widgets[$x]['css']))
            {
                $widget['css'] = $current_widgets[$x]['css'];
            }
        }

        $_content .= '<div class="col-md-6" id="box-' . $x . '">';
        $_content .= '<div class="panel panel-default">';
        $_content .= '<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-server"></i> Widget (' . $i . ') <a class="remove btn btn-default btn-xs pull-right" href="#box-' . $x . '"><span class="fa fa-trash"></span> ' . $widget['id'] . ' </a></h4></div>';
        $_content .= '<div class="panel-body">';
        $_content .= '<div class="form-group"><label>ID</label><input data-type="var" placeholder="lorem_ipsum" class="form-control" type="text" name="widgets[' . $x . '][id]" value="' . $widget['id'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Title</label><input placeholder="Lorem Ipsum" class="form-control" type="text" name="widgets[' . $x . '][title]" value="' . $widget['title'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Desc</label><textarea class="form-control" name="widgets[' . $x . '][desc]">' . $widget['desc'] . '</textarea></div>';
        $_content .= '<hr/>';
        $_content .= '<h4>Front-end Display</h4>';

        $_content .= '<div class="form-group"><label>Sample WordPress API</label>';
        $_content .= '<select  class="form-control" name="widgets[' . $x . '][code]">';
        foreach ($sample_code as $sample)
        {
            $selected = null;
            if ($widget['code'] == $sample['value'])
            {
                $selected = 'selected="selected"';
            }
            $_content .= '<option value="' . $sample['value'] . '" ' . $selected . '>' . $sample['label'] . '</option>';
        }
        $_content .= '</select>';
        $_content .= '</div>';
        $sample = null;
        $_content .= '<div class="form-group"><label>Post Type</label>';
        $_content .= '<select  class="form-control" name="widgets[' . $x . '][post_type]">';
        foreach ($sample_code_enum as $post_type)
        {
            $selected = null;
            if ($widget['post_type'] == $post_type)
            {
                $selected = 'selected="selected"';
            }
            $_content .= '<option value="' . $post_type . '" ' . $selected . '>' . ucwords($post_type) . '</option>';
        }
        $_content .= '</select>';
        $_content .= '</div>';

        $js_checked = '';
        if ((isset($widget['js'])) && ($widget['js'] == '1'))
        {
            $js_checked = 'checked="checked"';
        }
        $css_checked = '';
        if ((isset($widget['css'])) && ($widget['css'] == '1'))
        {
            $css_checked = 'checked="checked"';
        }
        $_content .= '
        <div class="form-group">
            <div class="checkbox"><label><input type="checkbox" name="widgets[' . $x . '][js]" value="1" ' . $js_checked . '/> External Javascript</label></div>
            <div class="checkbox"><label><input type="checkbox" name="widgets[' . $x . '][css]" value="1" ' . $css_checked . '/> External CSS</label></div>
        </div>';

        $_content .= '<hr/>';
        $_content .= '<h4>Back-end Widget Form</h4>';
        $_content .= '<div class="form-group"><label>HTML Markup</label><textarea class="form-control" name="widgets[' . $x . '][markup]">' . htmlentities(stripcslashes($widget['markup'])) . '</textarea></div>';

        $_content .= '<div>';
        for ($t = 0; $t < 20; $t++)
        {
            if (!isset($widget['option'][$t]['name']))
            {
                $widget['option'][$t]['name'] = '';
                $widget['option'][$t]['label'] = '';
                $widget['option'][$t]['default'] = '';
                $widget['option'][$t]['type'] = 'text';
                $widget['option'][$t]['explanation'] = '';
            }

            if (!isset($widget['option'][$t]['default']))
            {
                $widget['option'][$t]['default'] = '';
            }
            if (!isset($widget['option'][$t]['explanation']))
            {
                $widget['option'][$t]['explanation'] = '';
            }


            $_content .= '<div><a data-toggle="collapse" href="#option-' . $x . '-' . ($t) . '">+ Option (' . ($t + 1) . ')</a><span class="pull-right label label-primary">' . $widget['option'][$t]['name'] . '</span></div>';
            $_content .= '<div id="option-' . $x . '-' . ($t) . '" class="panel-collapse collapse">';
            $_content .= '<div class="form-group"><label>Name</label><input placeholder="lorem_ipsum" class="form-control" type="text" name="widgets[' . $x . '][option][' . $t . '][name]" value="' . $widget['option'][$t]['name'] . '"/></div>';

            $_content .= '<div class="form-group" id="widgets_' . $x . '_option_' . $t . '_label" ><label>Label</label><input placeholder="Lorem Ipsum" class="form-control" type="text" name="widgets[' . $x . '][option][' . $t . '][label]" value="' . $widget['option'][$t]['label'] . '"/></div>';
            $_option = null;
            foreach ($type_options as $type_option)
            {
                $selected = '';
                if ($type_option['type'] == $widget['option'][$t]['type'])
                {
                    $selected = 'selected';
                }
                $_option .= '<option value="' . $type_option['type'] . '" ' . $selected . '>' . $type_option['label'] . '</option>';
            }
            $_content .= '<div class="form-group"><label>Type</label><select data-explanation="#widgets_' . $x . '_option_' . $t . '_explanation" data-enum="#widgets_' . $x . '_option_' . $t . '_enum" data-label="#widgets_' . $x . '_option_' . $t . '_label" class="option_type form-control" name="widgets[' . $x . '][option][' . $t . '][type]" />' . $_option . '</select></div>';

            $_content .= '<div class="form-group" id="widgets_' . $x . '_option_' . $t . '_explanation"><label>Place Holder</label><input placeholder="Lorem Ipsum" class="form-control" type="text" name="widgets[' . $x . '][option][' . $t . '][explanation]" value="' . $widget['option'][$t]['explanation'] . '"/></div>';
            $_content .= '<div class="form-group"><label>Default Value</label><input placeholder="Lorem Ipsum" class="form-control" type="text" name="widgets[' . $x . '][option][' . $t . '][default]" value="' . $widget['option'][$t]['default'] . '"/></div>';
            //enum option
            $_content .= '<div class="form-group" id="widgets_' . $x . '_option_' . $t . '_enum">';
            $_content .= '<label>Enumerate (Option)</label>';
            for ($z = 0; $z < MAX_METABOX_ENUM_OPTION; $z++)
            {
                if (!isset($widget['option'][$t]['enum'][$z]['value']))
                {
                    $widget['option'][$t]['enum'][$z]['value'] = '';
                    $widget['option'][$t]['enum'][$z]['label'] = '';
                }

                $_content .= '<div>';
                $_content .= '<div class="col-md-6"><div class="form-group"><input data-type="var" class="form-control" placeholder="value" type="text" name="widgets[' . $x . '][option][' . $t . '][enum][' . $z . '][value]" value="' . $widget['option'][$t]['enum'][$z]['value'] . '" /></div></div>';
                $_content .= '<div class="col-md-6"><div class="form-group"><input class="form-control" placeholder="label" type="text" name="widgets[' . $x . '][option][' . $t . '][enum][' . $z . '][label]" value="' . $widget['option'][$t]['enum'][$z]['label'] . '" /></div></div>';
                $_content .= '</div>';
            }
            $_content .= '</div>';


            $_content .= '</div>';
        }
        $_content .= '</div>';

        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
    }


    $_content .= '</div>';
    $_content .= '<button type="submit" class="btn btn-primary" name="save">Save</button> ';
    $_content .= 'or <a href="./?page=widget&act=reset">Remove</a> ';
    $_content .= '</form>';


    $content = null;
    $content .= '<a href="#help-box" data-toggle="collapse" class="label label-danger pull-right" ><span class="fa fa-question"></span></a>';
    $content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-server fa-stack-1x"></i></span> <strong>Widgets</strong> ' . $current_set . '</h2>';
    $content .= '<div id="help-box" class="panel-collapse collapse">';
    $content .= '<blockquote><p>This form will be create widget and widget option</p></blockquote>';
    $content .= '<hr/>';
    $content .= '</div>';

    $content .= '<div class="row">';
    $content .= '<div class="col-md-6">';
    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-body">';
    $content .= max_select('widget');
    $content .= '</div>';
    $content .= '</div>';
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