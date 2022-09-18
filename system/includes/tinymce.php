<?php

/**
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2015
 * @license Commercial License
 * 
 * @package WordPress Plugin Maker
 */

defined("EXEC") or die();


//detect current project
if ($_SESSION['current_project'] != null)
{

    //prepare sample data
    $sample_code[0]['value'] = 'no_code';
    $sample_code[0]['label'] = 'No Code';

    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.shortcode.json'))
    {
        $current_shortcodes = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.shortcode.json'), true);
        $r = 1;
        foreach ($current_shortcodes as $shortcodes)
        {
            $sample_code[$r]['value'] = $shortcodes['tag'];
            $sample_code[$r]['label'] = 'Shortcode - ' . $shortcodes['title'];
            $r++;
        }

    }


    $current_set = '';
    //get current project info
    $current_properties = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.project.json'), true);

    //error handle
    if (!isset($_GET['act']))
    {
        $_GET['act'] = null;
    }
    if (!isset($_GET['max-tinymce']))
    {
        $_GET['max-tinymce'] = 1;
    }
    if ($_GET['max-tinymce'] == 0)
    {
        $_GET['max-tinymce'] = 1;
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

        //save to file
        file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.tinymce.json', json_encode($_POST['tinymces']));
        //refix config project
        rebuild();
        //reload page
        header('Location: ./?page=tinymce&max-tinymce=' . (int)$_GET['max-tinymce']);
    }
    //reset parameter
    if ($_GET['act'] == 'reset')
    {
        //remove file parameter
        @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.tinymce.json');
        //reload page
        header('Location: ./?page=tinymce&max-tinymce=' . (int)$_GET['max-tinymce']);
    }
    //create html form
    $_content = null;
    $_content .= '<form action="" method="post" enctype="multipart/form-data" >';
    $_content .= '<div class="row">';
    //detect current parameter
    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.tinymce.json'))
    {
        $current_tinymces = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.tinymce.json'), true);
        $current_set = '<span class="badge">' . count($current_tinymces) . '</span>';
        //detect max parameter form
        if ((count($current_tinymces) != $_GET['max-tinymce']) && (count($current_tinymces) != 0))
        {
            if ($_GET['act'] != 'max-tinymce')
            {
                //reload page
                header('Location: ./?page=tinymce&max-tinymce=' . count($current_tinymces));
            }
        }
    }
    //start create form
    for ($i = 1; $i <= (int)$_GET['max-tinymce']; $i++)
    {
        $x = $i - 1;
        $tinymces['name'] = '';
        $tinymces['label'] = '';
        $tinymces['icon'] = 'dashicons-wordpress';

        if (isset($current_tinymces[$x]))
        {
            if (isset($current_tinymces[$x]['name']))
            {
                $tinymces['name'] = $current_tinymces[$x]['name'];
            }
            if (isset($current_tinymces[$x]['label']))
            {
                $tinymces['label'] = $current_tinymces[$x]['label'];
            }
            if (isset($current_tinymces[$x]['icon']))
            {
                $tinymces['icon'] = $current_tinymces[$x]['icon'];
            }
            if (isset($current_tinymces[$x]['sample_code']))
            {
                $tinymces['sample_code'] = $current_tinymces[$x]['sample_code'];
            }
        }
        $_content .= '<div class="col-md-6" id="box-' . $x . '">';
        $_content .= '<div class="panel panel-default">';
        $_content .= '<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-location-arrow"></i> Button (' . $i . ') <a class="remove btn btn-default btn-xs pull-right" href="#box-' . $x . '"><span class="fa fa-trash"></span> ' . $tinymces['name'] . '</a></h4></div>';
        $_content .= '<div class="panel-body">';
        $_content .= '<div class="form-group"><label>Button Name</label><input data-type="var" placeholder="ipsum_btn" class="form-control" type="text" name="tinymces[' . $x . '][name]" value="' . $tinymces['name'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Label</label><input  placeholder="Ipsum Button" class="form-control" type="text" name="tinymces[' . $x . '][label]" value="' . $tinymces['label'] . '" required="required"/></div>';
        $_content .= '
        <div class="form-group">
            <label>Icon</label>
            <div class="input-group">
                <input class="form-control" placeholder="dashicons-format-gallery" type="text" id="tinymces_' . $x . '_icon" name="tinymces[' . $x . '][icon]" value="' . $tinymces['icon'] . '" />
                <span class="input-group-btn">
                    <a class="opener-dialog btn btn-default" target="_blank" href="./?page=dashicon&modal=true" data-target="#tinymces_' . $x . '_icon" >Icon</a>
                </span>
            </div>
        </div>
        ';
        //sample code

        $_content .= '<hr/><div class="form-group"><label>Sample Code</label>';
        $_content .= '<select class="form-control" name="tinymces[' . $x . '][sample_code]">';
        foreach ($sample_code as $sample)
        {
            $selected = null;
            if (!isset($tinymces['sample_code']))
            {
                $tinymces['sample_code'] = null;
            }
            if ($tinymces['sample_code'] == $sample['value'])
            {
                $selected = 'selected="selected"';
            }
            $_content .= '<option value="' . $sample['value'] . '" ' . $selected . '>' . $sample['label'] . '</option>';
        }
        $_content .= '</select>';
        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
    }
    $_content .= '</div>';
    $_content .= '<button type="submit" class="btn btn-primary" name="save">Save</button> ';
    $_content .= 'or <a href="./?page=tinymce&act=reset">Remove</a> ';
    $_content .= '</form>';

    $content = null;
    $content .= '<a href="#help-box" data-toggle="collapse" class="label label-danger pull-right" ><span class="fa fa-question"></span></a>';
    $content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-location-arrow fa-stack-1x"></i></span> <strong>TinyMCE</strong> Plugin ' . $current_set . '</h2>';
    $content .= '<div id="help-box" class="panel-collapse collapse">';
    $content .= '<blockquote><p></p></blockquote>';
    $content .= '</div>';
    $content .= '<div class="row">';
    $content .= '<div class="col-md-6">';
    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-body">';
    $content .= max_select('tinymce');
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= $_content;
    //set global content
    define('JZ_CONTENT', $content);
    unset($content);
}
else
{
    //redirect if project not set
    header('Location: ./?page=project&err=current_project');
}
