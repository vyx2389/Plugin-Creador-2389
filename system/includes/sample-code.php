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

    $content = null;
    $content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-wordpress fa-stack-1x"></i></span> WordPress API Tool</h2>';

    $_properties = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.project.json'), true);


    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'))
    {
        $current_post_types = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'), true);
        foreach ($current_post_types as $_post_type)
        {
            $post_types[] = $_post_type['name'];

        }
    }

    $post_types[] = 'post';
    $post_types[] = 'page';


    $sample_apis[] = array('label' => 'WordPress - Single POST Layout', 'value' => 'single_post_layout');
    $sample_apis[] = array('label' => 'WordPress - Get POSTs', 'value' => 'get_posts');
    $sample_apis[] = array('label' => 'WordPress - List PAGEs', 'value' => 'wp_list_pages');
    $sample_apis[] = array('label' => 'WordPress - Insert POST', 'value' => 'insert_post');
    $sample_apis[] = array('label' => 'WordPress - Dropdown PAGEs', 'value' => 'wp_dropdown_pages');


    $content .= '<div class="row">';
    $content .= '<div class="col-md-12">';
    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-heading"><h4 class="panel-title">My Project</h4></div>';
    $content .= '<div class="panel-body">';
    $content .= '<form action="" method="post" enctype="multipart/form-data" role="form" class="form-horizontal" >';

    $content .= '<div class="form-group">';
    $content .= '<label class="col-sm-3 control-label">API</label>';
    $content .= '<div class="col-sm-7">';
    $content .= '<select class="form-control" name="apis">';
    foreach ($sample_apis as $sample)
    {
        $content .= '<option value="' . $sample['value'] . '">' . $sample['label'] . '</option>';
    }
    $content .= '</select>';
    $content .= '</div>';
    $content .= '</div>';

    $content .= '<div class="form-group">';
    $content .= '<label class="col-sm-3 control-label">POST Type</label>';
    $content .= '<div class="col-sm-7">';
    $content .= '<select class="form-control" name="post_type">';
    foreach ($post_types as $post_type)
    {
        $content .= '<option value="' . $post_type . '">' . $post_type . '</option>';
    }
    $content .= '</select>';
    $content .= '</div>';
    $content .= '</div>';

    $content .= '<div class="form-group">';
    $content .= '<div class="col-sm-offset-3 col-sm-7">';
    $content .= '<button type="submit" class="btn btn-primary" name="generate"><span class="fa fa-floppy-o"></span> Generate</button> ';
    $content .= '</div>';
    $content .= '</div>';

    $content .= '</form>';


    if (isset($_POST['generate']))
    {
        $sample_code = new wpSampleCode($_properties);
        $image_sizes = array();
        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.image_size.json'))
        {
            $image_sizes = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.image_size.json'), true);
        }

        $metaboxs = array();
        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.metabox.json'))
        {
            $metaboxs = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.metabox.json'), true);
        }

        switch ($_POST['apis'])
        {
            case 'single_post_layout':
                $arg = array(
                    'post_type' => $_POST['post_type'],
                    'image_sizes' => $image_sizes,
                    'metaboxs' => $metaboxs);

                $code = $sample_code->single_post_init($arg);
                break;
            case 'get_posts':
                $arg = array(
                    'post_type' => $_POST['post_type'],
                    'image_sizes' => $image_sizes,
                    'metaboxs' => $metaboxs);

                $code = $sample_code->get_posts($arg);
                break;
            case 'wp_list_pages':
                $arg = array(
                    'post_type' => $_POST['post_type'],
                    'image_sizes' => $image_sizes,
                    'metaboxs' => $metaboxs);

                $code = $sample_code->wp_list_pages($arg);
                break;
            case 'insert_post':
                $arg = array(
                    'post_type' => $_POST['post_type'],
                    'image_sizes' => $image_sizes,
                    'metaboxs' => $metaboxs);

                $code = $sample_code->insert_post($arg);
                break;
            case 'wp_dropdown_pages':
                $arg = array(
                    'post_type' => $_POST['post_type'],
                    'image_sizes' => $image_sizes,
                    'metaboxs' => $metaboxs);

                $code = $sample_code->wp_dropdown_pages($arg);
                break;

        }

        if (isset($code['php']))
        {

            $content .= '<div class="code">';
            $content .= highlight_string("<?php \r\n" . $code['php'], true);
            $content .= '</div>';
        }


    }
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    


    define('JZ_CONTENT', $content);
    unset($content);

} else
{
    //redirect if project not set
    header('Location: ./?page=project&err=current_project');
}
