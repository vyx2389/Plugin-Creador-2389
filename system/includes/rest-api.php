<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @package WordPress Plugin Maker
 * @license Commercial License
 */


defined('EXEC') or die();

//detect current project
if ($_SESSION['current_project'] != null)
{

    if (isset($_POST['save']))
    {
        //check if project locked
        if ($current_properties['lock'] == 'true')
        {
            header('Location: ./?page=project&err=locked_project');
            exit(0);
        }

        $links = $_POST['rest-api'];
        file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.rest_api.json', json_encode($links));
        rebuild();
        header('Location: ./?page=rest-api');
    }
    $current_set = "";
    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.rest_api.json'))
    {
        $current_rest_api = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.rest_api.json'), true);
        $current_set = '<span class="badge">' . count($current_rest_api['post-type']) . '</span>';
    }


    $content .= '<a href="#help-box" data-toggle="collapse" class="label label-danger pull-right" ><span class="fa fa-question"></span></a>';
    $content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-list-alt fa-stack-1x"></i></span> WordPress REST API (Version 2) ' . $current_set . '</h2>';
    $content .= '<div id="help-box" class="panel-collapse collapse">';
    $content .= '<blockquote><p>Access your site\'s data through an easy-to-use HTTP REST API (Version 2), this features required https://wordpress.org/plugins/rest-api/</p></blockquote>';
    $content .= '</div>';

    $content .= '<div class="row">';
    $content .= '<div class="col-md-12">';
    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-body">';
    $content .= '<form action="" method="post" enctype="multipart/form-data" >';
    $content .= '<div class="form-group">';
    $content .= '<label>Register REST API:</label>';


    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'))
    {
        $current_post_types = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'), true);
        $z = 0;

        if (!isset($post_type['name']))
        {
            $post_type['name'] = '';
        }


        if (!isset($current_rest_api['post-type']))
        {
            $current_rest_api['post-type'] = array();
        }


        foreach ($current_post_types as $post_type)
        {
            $checked = "";
            if (in_array($post_type['name'], $current_rest_api['post-type']))
            {
                $checked = "checked";
            }

            $content .= '<div class="checkbox"><label><input type="checkbox" ' . $checked . ' name="rest-api[post-type][' . $z . ']"  value="' . $post_type['name'] . '" />Post Type ' . ucwords($post_type['name']) . '</label></div>';
            $z++;
        }
    }
    $content .= '</div>';
    $content .= '<button type="submit" class="btn btn-primary" name="save"><span class="fa fa-floppy-o"></span> Save</button> ';
    $content .= '</form>';


    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';

    //save to global constant
    define('JZ_CONTENT', $content);
    unset($content);
} else
{
    //redirect if project not set
    header('Location: ./?page=project&err=current_project');
}

?>