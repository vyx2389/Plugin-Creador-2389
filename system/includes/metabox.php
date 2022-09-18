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
    $current_set = '';

    $current_properties = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.project.json'), true);
    if (!isset($_GET['act']))
    {
        $_GET['act'] = null;
    }

    if (!isset($_GET['max-metabox']))
    {
        $_GET['max-metabox'] = 1;
    }

    if ($_GET['max-metabox'] == 0)
    {
        $_GET['max-metabox'] = 1;
    }

    if (isset($_POST['save']))
    {
        //check if project locked
        if ($current_properties['lock'] == 'true')
        {
            header('Location: ./?page=project&err=locked_project');
            exit(0);
        }

        $links = $_POST['metaboxs'];
        file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.metabox.json', json_encode($links));
        rebuild();
        header('Location: ./?page=metabox&max-metabox=' . (int)$_GET['max-metabox']);
    }
    if ($_GET['act'] == 'reset')
    {
        @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.metabox.json');
        header('Location: ./?page=metabox&max-metabox=' . (int)$_GET['max-metabox']);
    }

    $_content = null;
    $_content .= '<form action="" method="post" enctype="multipart/form-data" >';
    $_content .= '<div class="row">';

    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.metabox.json'))
    {
        $current_metaboxs = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.metabox.json'), true);
        $current_set = '<span class="badge">' . count($current_metaboxs) . '</span>';
        if (count($current_metaboxs) != $_GET['max-metabox'])
        {
            if (($_GET['act'] != 'max-metabox') && (count($current_metaboxs) != 0))
            {
                header('Location: ./?page=metabox&max-metabox=' . count($current_metaboxs));
            }

        }
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

    $metabox_hooks[] = 'dashboard';
    $metabox_hooks[] = 'post';
    $metabox_hooks[] = 'page';


    $type_options[] = array('type' => 'text', 'label' => 'Tiny Text');
    $type_options[] = array('type' => 'textarea', 'label' => 'Large Text (textarea)');


    $type_options[] = array('type' => 'checkbox', 'label' => 'Checkbox');
    $type_options[] = array('type' => 'select', 'label' => 'Select (Option)');
    $type_options[] = array('type' => 'radio', 'label' => 'Select (Radio)');

    $type_options[] = array('type' => 'wpcolor', 'label' => 'WordPress - Color Picker');

    $type_options[] = array('type' => 'wp_editor', 'label' => 'WordPress - Editor');
    $type_options[] = array('type' => 'featured-image', 'label' => 'WordPress - Featured Image');
    //$type_options[] = array('type' => 'media-upload', 'label' => 'WordPress - Media Upload (output: image/src)');
    //$type_options[] = array('type' => 'media-upload-dinamic', 'label' => 'WordPress - Media Upload - Multi (output: image/src)');

    $type_options[] = array('type' => 'wp_dropdown_pages_dinamic', 'label' => 'WordPress - Dropdown Pages (Dinamic)');

    $type_options[] = array('type' => 'wp_dropdown_pages', 'label' => 'WordPress - Dropdown Pages');
    $type_options[] = array('type' => 'wp_dropdown_categories', 'label' => 'WordPress - Dropdown Categories');
    $type_options[] = array('type' => 'wp_dropdown_users', 'label' => 'WordPress - Dropdown Users');

    $type_options[] = array('type' => 'datepicker', 'label' => 'jQuery UI - Datepicker (Required jQuery UI CSS)');

    for ($i = 1; $i <= (int)$_GET['max-metabox']; $i++)
    {
        $x = $i - 1;
        $metabox['name'] = '';
        $metabox['label'] = '';
        $metabox['hooks'] = '';
        $metabox['markup'] = '<h4>Example Metabox</h4>';
        $metabox['post_meta'] = array();

        if (isset($current_metaboxs[$x]))
        {
            if (isset($current_metaboxs[$x]['name']))
            {
                $metabox['name'] = $current_metaboxs[$x]['name'];
            }
            if (isset($current_metaboxs[$x]['label']))
            {
                $metabox['label'] = $current_metaboxs[$x]['label'];
            }
            if (isset($current_metaboxs[$x]['hooks']))
            {
                $metabox['hooks'] = $current_metaboxs[$x]['hooks'];
            } else
            {
                $metabox['hooks'] = array();
            }

            if (isset($current_metaboxs[$x]['markup']))
            {
                $metabox['markup'] = $current_metaboxs[$x]['markup'];
            }

            if (isset($current_metaboxs[$x]['post_meta']))
            {
                $metabox['post_meta'] = $current_metaboxs[$x]['post_meta'];
            }

        }

        $_content .= '<div class="col-md-6"  id="box-' . $x . '">';
        $_content .= '<div class="panel panel-default">';
        $_content .= '<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-th"></i> Box (' . $i . ') <a class="remove btn btn-default btn-xs pull-right" href="#box-' . $x . '"><span class="fa fa-trash"></span> ' . $metabox['name'] . '</a></h4></div>';
        $_content .= '<div class="panel-body">';
        $_content .= '<div class="form-group"><label>Name</label><input data-type="var" placeholder="lorem_ipsum" class="form-control" type="text" name="metaboxs[' . $x . '][name]" value="' . $metabox['name'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Label</label><input placeholder="Lorem Ipsum" class="form-control" type="text" name="metaboxs[' . $x . '][label]" value="' . $metabox['label'] . '" required="required"/></div>';

        $_content .= '<div class="form-group">';
        $_content .= '<label>Display at</label>';
        $z = 0;
        foreach ($metabox_hooks as $hooks)
        {
            if (isset($metabox['hooks'][$z]))
            {
                if ($metabox['hooks'][$z] == $hooks)
                {
                    $_content .= '<div class="checkbox"><label><input type="checkbox" name="metaboxs[' . $x . '][hooks][' . $z . ']"  value="' . $hooks . '" checked="checked"/> ' . ucwords($hooks) . '</label></div>';
                } else
                {
                    $_content .= '<div class="checkbox"><label><input type="checkbox" name="metaboxs[' . $x . '][hooks][' . $z . ']"  value="' . $hooks . '" /> ' . ucwords($hooks) . '</label></div>';
                }
            } else
            {
                $_content .= '<div class="checkbox"><label><input type="checkbox" name="metaboxs[' . $x . '][hooks][' . $z . ']"  value="' . $hooks . '" /> ' . ucwords($hooks) . '</label></div>';
            }
            $z++;
        }
        $_content .= '</div>';

        $_content .= '<div class="form-group"><label>HTML Markup</label><textarea class="form-control" type="text" name="metaboxs[' . $x . '][markup]">' . htmlentities(stripcslashes($metabox['markup'])) . '</textarea></div>';
        $_content .= '<div>';
        for ($t = 0; $t < MAX_METABOX_POSTMETA; $t++)
        {
            if ((!isset($metabox['post_meta'][$t]['name'])) || ($metabox['post_meta'][$t]['name'] == ''))
            {
                $metabox['post_meta'][$t]['name'] = '';
                $metabox['post_meta'][$t]['label'] = '';
                $metabox['post_meta'][$t]['type'] = 'text';
                $metabox['post_meta'][$t]['sub_type'] = '';
                $metabox['post_meta'][$t]['explanation'] = '';
                $metabox['post_meta'][$t]['enum'] = array();
            }

            if (!isset($metabox['post_meta'][$t]['label']))
            {
                $metabox['post_meta'][$t]['label'] = ' ';
            }

            if (!isset($metabox['post_meta'][$t]['explanation']))
            {
                $metabox['post_meta'][$t]['explanation'] = ' ';
            }

            //start
            if (isset($metabox['post_meta'][$t]['name']))
            {


                $_content .= '<div><a data-toggle="collapse" href="#post-meta-' . $x . '-' . ($t) . '">+ Post Meta (' . ($t + 1) . ')</a> <span class="pull-right label label-primary">' . $metabox['post_meta'][$t]['name'] . '</span></div>';
                $_content .= '<div id="post-meta-' . $x . '-' . ($t) . '" class="panel-collapse collapse">';
                $_content .= '<div class="form-group" id="metaboxs_' . $x . '_post_meta_' . $t . '_name"><label>Name</label><input data-type="var" placeholder="lorem_ipsum" class="form-control" type="text" name="metaboxs[' . $x . '][post_meta][' . $t . '][name]" value="' . $metabox['post_meta'][$t]['name'] . '"/></div>';
                $_content .= '<div class="form-group" id="metaboxs_' . $x . '_post_meta_' . $t . '_label"><label>Label</label><input placeholder="Lorem Ipsum" class="form-control" type="text" name="metaboxs[' . $x . '][post_meta][' . $t . '][label]" value="' . $metabox['post_meta'][$t]['label'] . '"/></div>';


                $_content .= '<div class="form-group" id="metaboxs_' . $x . '_post_meta_' . $t . '_type"><label for="metaboxs[' . $x . '][post_meta][' . $t . '][type]">Type</label>';

                $_content .= '<select class="option_type form-control" name="metaboxs[' . $x . '][post_meta][' . $t . '][type]" data-label="#metaboxs_' . $x . '_post_meta_' . $t . '_label" data-explanation="#metaboxs_' . $x . '_post_meta_' . $t . '_explanation" data-enum="#metaboxs_' . $x . '_post_meta_' . $t . '_enum" data-sub-type="#metaboxs_' . $x . '_post_meta_' . $t . '_sub_type" >';
                foreach ($type_options as $type_option)
                {
                    $selected = '';
                    if ($type_option['type'] == $metabox['post_meta'][$t]['type'])
                    {
                        $selected = 'selected';
                    }
                    $_content .= '<option value="' . $type_option['type'] . '" ' . $selected . '>' . $type_option['label'] . '</option>';
                }
                $_content .= '</select>';
                $_content .= '</div>';


                $_content .= '<div class="form-group" id="metaboxs_' . $x . '_post_meta_' . $t . '_sub_type" >';
                $_content .= '<label>Data</label>';
                $_content .= '<select class="form-control" name="metaboxs[' . $x . '][post_meta][' . $t . '][sub_type]" >';

                foreach ($sub_type as $_sub_type)
                {
                    if (!isset($metabox['post_meta'][$t]['sub_type']))
                    {
                        $metabox['post_meta'][$t]['sub_type'] = '';
                    }
                    $selected = '';
                    if ($_sub_type == $metabox['post_meta'][$t]['sub_type'])
                    {
                        $selected = 'selected';
                    }
                    $_content .= '<option value="' . $_sub_type . '" ' . $selected . '>' . $_sub_type . '</option>';
                }
                $_content .= '</select>';
                $_content .= '</div>';


                $_content .= '<div class="form-group" id="metaboxs_' . $x . '_post_meta_' . $t . '_explanation"><label>Explanation</label><input class="form-control" type="text" name="metaboxs[' . $x . '][post_meta][' . $t . '][explanation]" value="' . $metabox['post_meta'][$t]['explanation'] . '"/></div>';

                $_content .= '<div class="form-group" id="metaboxs_' . $x . '_post_meta_' . $t . '_enum" >';
                $_content .= '<label>Enumerate (Option)</label>';
                for ($z = 0; $z < MAX_METABOX_ENUM_OPTION; $z++)
                {
                    if (!isset($metabox['post_meta'][$t]['enum'][$z]['value']))
                    {
                        $metabox['post_meta'][$t]['enum'][$z]['value'] = '';
                        $metabox['post_meta'][$t]['enum'][$z]['label'] = '';
                    }
                    $_content .= '<div>';
                    $_content .= '<div class="col-md-6"><div class="form-group"><input data-type="var" class="form-control" placeholder="value" type="text" name="metaboxs[' . $x . '][post_meta][' . $t . '][enum][' . $z . '][value]" value="' . $metabox['post_meta'][$t]['enum'][$z]['value'] . '" /></div></div>';
                    $_content .= '<div class="col-md-6"><div class="form-group"><input class="form-control" placeholder="label" type="text" name="metaboxs[' . $x . '][post_meta][' . $t . '][enum][' . $z . '][label]" value="' . $metabox['post_meta'][$t]['enum'][$z]['label'] . '" /></div></div>';
                    $_content .= '</div>';
                }
                $_content .= '</div>';


                $_content .= '</div>';
                //end
            }
        }
        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
    }


    $_content .= '</div>';
    $_content .= '<button type="submit" class="btn btn-primary" name="save"><span class="fa fa-floppy-o"></span> Save</button> ';
    $_content .= 'or <a href="./?page=metabox&act=reset">Remove</a> ';
    $_content .= '</form>';

    $content = null;
    $content .= '<a href="#help-box" data-toggle="collapse" class="label label-danger pull-right" ><span class="fa fa-question"></span></a>';
    $content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-list-alt fa-stack-1x"></i></span> Metabox ' . $current_set . '</h2>';

    $content .= '<div id="help-box" class="panel-collapse collapse">';
    $content .= '<blockquote><p><strong>Metabox</strong> is a toolbox available in several screens of the WordPress admin menu, like as welcome toolbox, feature box and other.</p></blockquote>';
    $content .= '<div class="row">';
    $content .= '<div class="col-md-3"><a class="colorbox" href="./templates/images/metabox-1.png" title="Metabox"/><img class="img-thumbnail center-block" src="./templates/images/metabox-1.png" title="Metabox Dashboard" /></a></div>';
    $content .= '<div class="col-md-3"><a class="colorbox" href="./templates/images/metabox-2.png" title="Metabox"/><img class="img-thumbnail center-block" src="./templates/images/metabox-2.png" title="Metabox Page/Post" /></a></div>';
    $content .= '</div>';
    $content .= '<hr/>';
    $content .= '</div>';


    $content .= '<div class="row">';
    $content .= '<div class="col-md-6">';
    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-body">';
    $content .= max_select('metabox');
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="col-md-6">';
    $content .= '</div>';

    $content .= '</div>';

    $content .= $_content;

    define('JZ_CONTENT', $content);
    unset($_content);
} else
{
    header('Location: ./?page=project&err=current_project');
}

?>