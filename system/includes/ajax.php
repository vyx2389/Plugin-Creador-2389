<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @package WordPress Plugin Maker
 * @license Commercial License
 */

defined("EXEC") or die();
//detect current project
if ($_SESSION['current_project'] != null)
{
    $current_set = '';
    //get current project info
    $current_properties = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.project.json'), true);

    //error handle
    if (!isset($_GET['act']))
    {
        $_GET['act'] = null;
    }
    if (!isset($_GET['max-ajax']))
    {
        $_GET['max-ajax'] = 1;
    }
    if ($_GET['max-ajax'] == 0)
    {
        $_GET['max-ajax'] = 1;
    }


    //save parameter
    if (isset($_POST['save']))
    {
        //check if project locked
        if ($current_properties['lock'] == 'true')
        {
            header('Location: ./?page=project&err=locked_project');
            exit(0);
        }
        $_ajaxs = $_POST['ajaxs'];
        //save to file
        file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.ajax.json', json_encode($_ajaxs));
        //refix config project
        rebuild();
        //reload page
        header('Location: ./?page=ajax&max-ajax=' . (int)$_GET['max-ajax']);
    }
    //reset parameter
    if ($_GET['act'] == 'reset')
    {
        //remove file parameter
        @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.ajax.json');
        //reload page
        header('Location: ./?page=ajax&max-ajax=' . (int)$_GET['max-ajax']);
    }


    //relation

    //prepare sample data
    $sample_code[0]['value'] = 'no_code';
    $sample_code[0]['label'] = 'None';

    $sample_code[1]['value'] = 'insert_post';
    $sample_code[1]['label'] = 'WordPress - Insert Post';

    $sample_code[2]['value'] = 'modal';
    $sample_code[2]['label'] = 'Modal - Dialog';
    
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


    //create html form
    $_content = null;
    $_content .= '<form action="" method="post" enctype="multipart/form-data" >';
    $_content .= '<div class="row">';
    //detect current parameter
    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.ajax.json'))
    {
        $current_ajaxs = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.ajax.json'), true);
        $current_set = '<span class="badge">' . count($current_ajaxs) . '</span>';
        //detect max parameter form
        if ((count($current_ajaxs) != $_GET['max-ajax']) && (count($current_ajaxs) != 0))
        {
            if ($_GET['act'] != 'max-ajax')
            {
                //reload page
                header('Location: ./?page=ajax&max-ajax=' . count($current_ajaxs));
            }
        }
    }
    //start create form
    for ($i = 1; $i <= (int)$_GET['max-ajax']; $i++)
    {
        $x = $i - 1;
        $ajax['submit'] = '';
        $ajax['query'] = array();
        $ajax['admin'] = false;
        
        $ajax['sample_code'] = 'no_code';
        $ajax['post_type'] = 'page';
        if (isset($current_ajaxs[$x]))
        {
            if (isset($current_ajaxs[$x]['submit']))
            {
                $ajax['submit'] = $current_ajaxs[$x]['submit'];
            }
            if (isset($current_ajaxs[$x]['query']))
            {
                $ajax['query'] = $current_ajaxs[$x]['query'];
            }

            if (isset($current_ajaxs[$x]['sample_code']))
            {
                $ajax['sample_code'] = $current_ajaxs[$x]['sample_code'];
            }

            if (isset($current_ajaxs[$x]['post_type']))
            {
                $ajax['post_type'] = $current_ajaxs[$x]['post_type'];
            }
            if (isset($current_ajaxs[$x]['admin']))
            {
                if ($current_ajaxs[$x]['admin'] == true)
                {
                    $ajax['admin'] = true;
                }
            } else
            {
                $ajax['admin'] = false;
            }
        }
        $_content .= '<div class="col-md-12" id="box-' . $x . '">';
        $_content .= '<div class="panel panel-default">';
        $_content .= '<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-location-arrow"></i> Ajax (' . $i . ') <a class="remove btn btn-default btn-xs pull-right" href="#box-' . $x . '"><span class="fa fa-trash"></span> ' . $ajax['submit'] . '</a></h4></div>';
        $_content .= '<div class="panel-body">';
        $_content .= '<div class="form-group"><label>Name/ID Submit</label><input data-type="var" placeholder="lorem_ipsum_btn" class="form-control" type="text" name="ajaxs[' . $x . '][submit]" value="' . $ajax['submit'] . '" required="required"/></div>';

        $_content .= '<div class="form-group">';
        $_content .= '<div class="checkbox">';
        if ($ajax['admin'] == true)
        {
            $_content .= '<label><input type="checkbox" checked="checked" name="ajaxs[' . $x . '][admin]" value="1" />Admin Area</label>';
        } else
        {
            $_content .= '<label><input type="checkbox" name="ajaxs[' . $x . '][admin]" value="1" />Admin Area</label>';
        }
        $_content .= '</div>';
        $_content .= '</div>';

        $_content .= '<div class="form-group">';
        $_content .= '<label>Form Query</label>';
        $_content .= '<div id="accordion">';
        for ($t = 0; $t <= 14; $t++)
        {
            if (!isset($ajax['query'][$t]))
            {
                $ajax['query'][$t] = '';
            }
            $_content .= '<div>';
            $_content .= '<div><a data-toggle="collapse" data-parent="#accordion" href="#query-' . $x . '-' . ($t) . '">+ parameter (' . ($t + 1) . ')</a><span class="label label-primary pull-right">' . $ajax['query'][$t] . '</span></div>';
            $_content .= '<div id="query-' . $x . '-' . ($t) . '" class="panel-collapse collapse">';
            $_content .= '<div class="form-group"><label></label><input placeholder="lorem_ipsum_input_' . ($t + 1) . '" class="form-control" type="text" name="ajaxs[' . $x . '][query][' . $t . ']" value="' . $ajax['query'][$t] . '" /></div>';
            $_content .= '</div>';
            $_content .= '</div>';
        }
        $_content .= '</div>';
        $_content .= '</div>';

        //sample code

        $_content .= '<hr/><div class="form-group"><label>Sample WordPress API</label>';
        $_content .= '<select class="form-control" name="ajaxs[' . $x . '][sample_code]">';
        foreach ($sample_code as $sample)
        {
            $selected = null;
            if (!isset($ajax['sample_code']))
            {
                $ajax['sample_code'] = null;
            }
            if ($ajax['sample_code'] == $sample['value'])
            {
                $selected = 'selected="selected"';
            }
            $_content .= '<option value="' . $sample['value'] . '" ' . $selected . '>' . $sample['label'] . '</option>';
        }
        $_content .= '</select>';
        $_content .= '</div>';

        // form post type


        $_content .= '<div class="form-group" id="ajaxs_' . $x . '_post_type" >';
        $_content .= '<label>Post Type</label>';
        $_content .= '<select class="form-control" name="ajaxs[' . $x . '][post_type]" >';

        foreach ($sub_type as $_sub_type)
        {
            if (!isset($ajax['post_type']))
            {
                $ajax['post_type'] = '';
            }
            $selected = '';
            if ($_sub_type == $ajax['post_type'])
            {
                $selected = 'selected';
            }
            $_content .= '<option value="' . $_sub_type . '" ' . $selected . '>' . $_sub_type . '</option>';
        }
        $_content .= '</select>';
        $_content .= '</div>';


        // .//form post type


        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
    }
    $_content .= '</div>';
    $_content .= '<button type="submit" class="btn btn-primary" name="save">Save</button> ';
    $_content .= 'or <a href="./?page=ajax&act=reset">Remove</a> ';
    $_content .= '</form>';
    //display html form
    $content = null;
    $content .= '<a href="#help-box" data-toggle="collapse" class="label label-danger pull-right" ><span class="fa fa-question"></span></a>';
    $content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-location-arrow fa-stack-1x"></i></span> <strong>Ajax</strong> Response &amp; Requests ' . $current_set . '</h2>';
    $content .= '<div id="help-box" class="panel-collapse collapse">';
    $content .= '<blockquote><p>WP Ajax is the standardization of processing ajax and php response in WordPress, it is very effective to avoid the vulnerability Auth by Pass</p></blockquote>';
    $content .= '</div>';
    $content .= '<div class="row">';
    $content .= '<div class="col-md-6">';
    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-body">';
    $content .= max_select('ajax');
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= $_content;
    //set global content
    define('JZ_CONTENT', $content);
    unset($content);
} else
{
    //redirect if project not set
    header('Location: ./?page=project&err=current_project');
}

?>