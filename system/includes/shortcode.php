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

    $type_options[] = array('type' => 'text', 'label' => 'Tiny Text');
    $type_options[] = array('type' => 'textarea', 'label' => 'Large Text (textarea)');
    $type_options[] = array('type' => 'checkbox', 'label' => 'Checkbox');
    $type_options[] = array('type' => 'select', 'label' => 'Select (Option)');
    $type_options[] = array('type' => 'colorpicker', 'label' => 'Color Picker');

    $current_set = '';
    $current_properties = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.project.json'), true);

    //prepare sample data
    $sample_code[0]['value'] = 'no_code';
    $sample_code[0]['label'] = 'HTML Only';


    $sample_code[1]['value'] = 'wp_list_pages';
    $sample_code[1]['label'] = 'WordPress - List Page (Default)';

    $sample_code[2]['value'] = 'get_posts';
    $sample_code[2]['label'] = 'WordPress - Get Posts (Manual)';

    $sample_code[2]['value'] = 'html_form';
    $sample_code[2]['label'] = 'HTML - Front End Submition + WP Ajax';

    //$sample_code[3]['value'] = 'html_form_recaptcha';
    //$sample_code[3]['label'] = 'HTML - Front End Submition + WP Ajax +  reCAPTCHA';

    $sample_code_enum[] = 'page';
    $sample_code_enum[] = 'post';

    //sample data from post type
    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'))
    {
        $current_post_types = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'), true);
        foreach ($current_post_types as $post_type)
        {
            $sample_code_enum[] = $post_type['name'];
        }
    }


    if (!isset($_GET['act']))
    {
        $_GET['act'] = null;
    }

    if (!isset($_GET['max-shortcode']))
    {
        $_GET['max-shortcode'] = 1;
    }

    if ($_GET['max-shortcode'] == 0)
    {
        $_GET['max-shortcode'] = 1;
    }

    if (isset($_POST['save']))
    {
        //check if project locked
        if ($current_properties['lock'] == 'true')
        {
            header('Location: ./?page=project&err=locked_project');
            exit(0);
        }
        $_shortcodes = $_POST['shortcodes'];
        file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.shortcode.json', json_encode($_shortcodes));
        rebuild();
        header('Location: ./?page=shortcode&max-shortcode=' . (int)$_GET['max-shortcode']);
    }
    if ($_GET['act'] == 'reset')
    {
        @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.shortcode.json');
        header('Location: ./?page=shortcode&max-shortcode=' . (int)$_GET['max-shortcode']);
    }

    $content = null;


    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.shortcode.json'))
    {
        $current_shortcodes = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.shortcode.json'), true);
        $current_set = '<span class="badge">' . count($current_shortcodes) . '</span>';
        if (count($current_shortcodes) != $_GET['max-shortcode'])
        {
            if ($_GET['act'] != 'max-shortcode')
            {
                header('Location: ./?page=shortcode&max-shortcode=' . count($current_shortcodes));
            }

        }
    }

    //print_r($current_shortcodes);

    $_content = $_preview = null;

    for ($i = 1; $i <= (int)$_GET['max-shortcode']; $i++)
    {
        $x = $i - 1;

        $shortcode['tag'] = '';
        $shortcode['title'] = '';
        $shortcode['markup'] = '';
        $shortcode['sample_code'] = 'no_code';
        $shortcode['post_type'] = '';

        if (isset($current_shortcodes[$x]))
        {
            $shortcode = $current_shortcodes[$x];
        } else
        {
            if (isset($shortcodes[$x]))
            {
                $shortcode = $shortcodes[$x];
            }
        }

        $attr_html = array();
        $_preview = null;
        if ($shortcode['tag'] != "")
        {
            $_preview .= '<code>[' . $shortcode['tag'];
        }

        $_prop_content = null;
        for ($t = 1; $t <= 10; $t++)
        {
            $properties = null;
            if (isset($shortcode['properties'][($t - 1)]))
            {
                $properties = $shortcode['properties'][($t - 1)];
            }

            if (!isset($properties['explanation']))
            {
                $properties['explanation'] = '';
            }

            if (!isset($properties['type']))
            {
                $properties['type'] = 'text';
            }
            if (!isset($properties['name']))
            {
                $properties['name'] = '';
            }
            if (!isset($properties['label']))
            {
                $properties['label'] = '';
            }
            if (!isset($properties['default']))
            {
                $properties['default'] = '';
            }

            if ($shortcode['tag'] != "")
            {
                if ($properties['name'] != "")
                {
                    $_preview .= " " . $properties['name'] . '="' . $properties['default'] . '"';
                    $attr_html[] = '{{' . $properties['name'] . '}}';
                }
            }


            $_prop_content .= '<div><a data-toggle="collapse" data-parent="#accordion" href="#prop-' . $x . '-' . ($t) . '">+ Properties (' . ($t) . ') </a><span class="pull-right label label-primary">' . $properties['name'] . '</span></div>';
            $_prop_content .= '<div id="prop-' . $x . '-' . ($t) . '" class="panel-collapse collapse">';
            $_prop_content .= '<div class="form-group"><label>Name</label><input data-type="var" class="form-control" type="text" name="shortcodes[' . $x . '][properties][' . ($t - 1) . '][name]" value="' . $properties['name'] . '" /></div>';
            $_prop_content .= '<div class="form-group"><label>Label</label><input class="form-control" type="text" name="shortcodes[' . $x . '][properties][' . ($t - 1) . '][label]" value="' . $properties['label'] . '" /></div>';

            $_prop_content .= '<div class="form-group" id="shortcodes_' . $x . '_properties_' . $t . '_type"><label for="shortcodes[' . $x . '][properties][' . $t . '][type]">Type</label>';

            $_prop_content .= '<select class="option_type form-control" name="shortcodes[' . $x . '][properties][' . ($t - 1) . '][type]" data-label="#shortcodes_' . $x . '_properties_' . ($t - 1) . '_label" data-explanation="#shortcodes_' . $x . '_properties_' . $t . '_explanation" data-enum="#shortcodes_' . $x . '_properties_' . $t . '_enum" data-sub-type="#shortcodes_' . $x . '_properties_' . $t . '_sub_type" >';
            foreach ($type_options as $type_option)
            {
                $selected = '';
                if ($type_option['type'] == $properties['type'])
                {
                    $selected = 'selected';
                }
                $_prop_content .= '<option value="' . $type_option['type'] . '" ' . $selected . '>' . $type_option['label'] . '</option>';
            }
            $_prop_content .= '</select>';
            $_prop_content .= '</div>';

            $_prop_content .= '<div class="form-group" id="shortcodes_' . $x . '_properties_' . $t . '_explanation"><label>Explanation</label><input class="form-control" type="text" name="shortcodes[' . $x . '][properties][' . ($t - 1) . '][explanation]" value="' . $properties['explanation'] . '"/></div>';
            $_prop_content .= '<div class="form-group" id="shortcodes_' . $x . '_properties_' . $t . '_default" ><label>Default Value</label><input  class="form-control" type="text" name="shortcodes[' . $x . '][properties][' . ($t - 1) . '][default]" value="' . $properties['default'] . '" /></div>';

            $_prop_content .= '<div class="form-group" id="shortcodes_' . $x . '_properties_' . $t . '_enum" >';
            $_prop_content .= '<label>Enumerate (Option)</label>';
            for ($z = 0; $z < MAX_METABOX_ENUM_OPTION; $z++)
            {
                if (!isset($properties['enum'][$z]['value']))
                {
                    $properties['enum'][$z]['value'] = '';
                    $properties['enum'][$z]['label'] = '';
                }
                $_prop_content .= '<div>';
                $_prop_content .= '<div class="col-md-6"><div class="form-group"><input data-type="var" class="form-control" placeholder="value" type="text" name="shortcodes[' . $x . '][properties][' . ($t - 1) . '][enum][' . $z . '][value]" value="' . $properties['enum'][$z]['value'] . '" /></div></div>';
                $_prop_content .= '<div class="col-md-6"><div class="form-group"><input class="form-control" placeholder="label" type="text" name="shortcodes[' . $x . '][properties][' . ($t - 1) . '][enum][' . $z . '][label]" value="' . $properties['enum'][$z]['label'] . '" /></div></div>';
                $_prop_content .= '</div>';
            }
            $_prop_content .= '</div>';


            $_prop_content .= '</div>';

        }
        if ($shortcode['tag'] != "")
        {
            $_preview .= '][/' . $shortcode['tag'] . ']</code><br/>';
        }

        if (!isset($shortcode['markup']))
        {
            $shortcode['markup'] = '';
        }

        $_content .= '<div class="col-md-12" id="box-' . $x . '">';
        $_content .= '<div class="panel panel-default">';
        $_content .= '<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-file-code-o"></i> Code (' . $i . ') <a class="remove btn btn-default btn-xs pull-right" href="#box-' . $x . '"><span class="fa fa-trash"></span> ' . $shortcode['tag'] . '</a></h4></div>';
        $_content .= '<div class="panel-body">';
        $_content .= '<div class="form-group"><label>' . $_preview . '</label></div>';
        $_content .= '<div class="form-group"><label>Tag</label><input data-type="var" class="form-control" placeholder="lorem_ipsum" type="text" name="shortcodes[' . $x . '][tag]" value="' . $shortcode['tag'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Title</label><input class="form-control" placeholder="Lorem Ipsum" type="text" name="shortcodes[' . $x . '][title]" value="' . $shortcode['title'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>HTML Markup</label><textarea class="form-control" type="text" name="shortcodes[' . $x . '][markup]">' . htmlentities(stripcslashes($shortcode['markup'])) . '</textarea><p class="help-block">Display attributes : ' . implode(', ', $attr_html) . '</p></div>';

        $_content .= '<div class="form-group"><label>Sample WordPress API</label>';
        $_content .= '<select  class="form-control" name="shortcodes[' . $x . '][sample_code]">';
        foreach ($sample_code as $sample)
        {
            $selected = null;
            if (!isset($shortcode['sample_code']))
            {
                $shortcode['sample_code'] = null;
            }
            if ($shortcode['sample_code'] == $sample['value'])
            {
                $selected = 'selected="selected"';
            }
            $_content .= '<option value="' . $sample['value'] . '" ' . $selected . '>' . $sample['label'] . '</option>';
        }
        $_content .= '</select>';
        $_content .= '</div>';
        $sample = null;
        $_content .= '<div class="form-group"><label>Post Type</label>';
        $_content .= '<select  class="form-control" name="shortcodes[' . $x . '][post_type]">';
        foreach ($sample_code_enum as $post_type)
        {
            $selected = null;
            if (!isset($shortcode['post_type']))
            {
                $shortcode['post_type'] = null;
            }
            if ($shortcode['post_type'] == $post_type)
            {
                $selected = 'selected="selected"';
            }
            $_content .= '<option value="' . $post_type . '" ' . $selected . '>' . ucwords($post_type) . '</option>';
        }
        $_content .= '</select>';
        $_content .= '</div>';

        $_content .= '<div id="accordion">';
        $_content .= $_prop_content;
        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';

    }
    $content .= '<a href="#help-box" data-toggle="collapse" class="label label-danger pull-right" ><span class="fa fa-question"></span></a>';
    $content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-file-code-o fa-stack-1x"></i></span> <strong>Short</strong>codes and <strong>Quick</strong>tags ' . $current_set . '</h2>';
    $content .= '<div id="help-box" class="panel-collapse collapse">';
    $content .= '<blockquote><p><strong>Shortcodes</strong> have been introduced for creating macros to be used in a post\'s content. and <strong>Quicktags</strong> is additional buttons in the Text (HTML) mode of the WordPress editor.</p></blockquote>';
    $content .= '<div class="row">';
    $content .= '<div class="col-md-4"><a class="colorbox" href="./templates/images/shortcode.png" title="Quicktag and Shortcode"/><img class="img-thumbnail center-block" src="./templates/images/shortcode.png" title="Quicktag and Shortcode" /></a></div>';
    $content .= '</div>';
    $content .= '<hr/>';
    $content .= '</div>';


    $content .= '<div class="row">';
    $content .= '<div class="col-md-6">';
    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-body">';
    $content .= max_select('shortcode');
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';

    $content .= '<div class="col-md-6">';
    $content .= '</div>';

    $content .= '</div>';


    $content .= '<form action="" method="post" enctype="multipart/form-data" >';
    $content .= '<div class="row">';
    $content .= $_content;
    $content .= '</div>';
    $content .= '<button type="submit" class="btn btn-primary" name="save"><span class="fa fa-floppy-o"></span> Save</button> ';
    $content .= 'or <a href="./?page=shortcode&act=reset">Remove</a> ';
    $content .= '</form>';
    define('JZ_CONTENT', $content);
    unset($content);

} else
{
    header('Location: ./?page=project&err=current_project');
}

?>