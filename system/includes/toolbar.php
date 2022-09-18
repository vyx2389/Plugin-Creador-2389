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
	
    if (!isset($_GET['max-toolbar']))
    {
        $_GET['max-toolbar'] = 3;
    }
	
    if ($_GET['max-toolbar'] == 0)
    {
        $_GET['max-toolbar'] = 3;
    }
	
    if (isset($_POST['save']))
    {
        //check if project locked
        if ($current_properties['lock'] == 'true')
        {
            header('Location: ./?page=project&err=locked_project');
            exit(0);
        }

        $links = $_POST['toolbar'];
        file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.toolbar.json', json_encode($links));
        rebuild();
        header('Location: ./?page=toolbar&max-toolbar=' . (int)$_GET['max-toolbar']);
    }
    if ($_GET['act'] == 'reset')
    {
        @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.toolbar.json');
        header('Location: ./?page=toolbar&max-toolbar=' . (int)$_GET['max-toolbar']);
    }
    $_content = null;
    $_content .= '<form action="" method="post" enctype="multipart/form-data" >';
    $_content .= '<div class="row">';
    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.toolbar.json'))
    {
        $current_toolbars = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.toolbar.json'), true);
        $current_set = '<span class="badge">' . count($current_toolbars) . '</span>';

        if (count($current_toolbars) != $_GET['max-toolbar'])
        {
            if (($_GET['act'] != 'max-toolbar') && (count($current_toolbars) != 0))
            {
                header('Location: ./?page=toolbar&max-toolbar=' . count($current_toolbars));
            }
        }
    }
    //print_r($current_properties);
    $toolbars[0]['id'] = 'root_toolbar';
    $toolbars[0]['url'] = '#';
    $toolbars[0]['anchor'] = $current_properties['Plugin_Name'];
    $toolbars[0]['parent'] = '';
    $toolbars[1]['id'] = 'settings_toolbar';
    $toolbars[1]['url'] = 'options-general.php?page=' . $current_properties['Plugin_ShortName'] . '_settings';
    $toolbars[1]['anchor'] = 'Settings';
    $toolbars[1]['parent'] = 'root_toolbar';
    $toolbars[2]['id'] = 'help_toolbar';
    $toolbars[2]['url'] = 'options-general.php?page=' . $current_properties['Plugin_ShortName'] . '_help';
    $toolbars[2]['anchor'] = 'Help';
    $toolbars[2]['parent'] = 'root_toolbar';
    for ($i = 1; $i <= (int)$_GET['max-toolbar']; $i++)
    {
        $x = $i - 1;
        $toolbar['id'] = '';
        $toolbar['name'] = '';
        $toolbar['url'] = '';
        $toolbar['anchor'] = '';
        $toolbar['parent'] = '';
        if (isset($current_toolbars[$x]))
        {
            $toolbar = $current_toolbars[$x];
        }
        else
        {
            if (isset($toolbars[$x]))
            {
                $toolbar = $toolbars[$x];
            }
        }
        if (!isset($toolbar['parent']))
        {
            $toolbar['parent'] = '';
        }
        if (!isset($toolbar['url']))
        {
            $toolbar['url'] = '#';
        }
        $_content .= '<div class="col-md-6" id="box-' . $x . '">';
        $_content .= '<div class="panel panel-default">';
        $_content .= '<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-anchor"></i> Link (' . $i . ') <a class="remove btn btn-default btn-xs pull-right" href="#box-' . $x . '"><span class="fa fa-trash"></span> ' . $toolbar['id'] . '</a></h4></div>';
        $_content .= '<div class="panel-body">';
        $_content .= '<div class="form-group"><label>ID</label><input data-type="var" placeholder="lorem_ipsum" class="form-control" type="text" name="toolbar[' . $x . '][id]" value="' . $toolbar['id'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Anchor</label><input placeholder="Lorem Ipsum" class="form-control" type="text" name="toolbar[' . $x . '][anchor]" value="' . $toolbar['anchor'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>URL</label><input placeholder="options-general.php?page=query" class="form-control" type="text" name="toolbar[' . $x . '][url]" value="' . $toolbar['url'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Parent (blank=root)</label><input  class="form-control" type="text" name="toolbar[' . $x . '][parent]" value="' . $toolbar['parent'] . '" /></div>';
        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
    }
    $_content .= '</div>';
    $_content .= '<button type="submit" class="btn btn-primary" name="save"><span class="fa fa-floppy-o"></span> Save</button> ';
    $_content .= 'or <a href="./?page=toolbar&act=reset">Remove</a> ';
    $_content .= '</form>';
    $content = null;
    $content .= '<a href="#help-box" data-toggle="collapse" class="label label-danger pull-right" ><span class="fa fa-question"></span></a>';
    $content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-link fa-stack-1x"></i></span> Admin <strong>Bars</strong> (toolbar)' . $current_set . '</h2>';
    $content .= '<div id="help-box" class="panel-collapse collapse">';
    $content .= '<blockquote><p>While you are logged in to WordPress, this <strong>toolbar</strong> on the top the admin bar.</p></blockquote>';
    $content .= '<div class="row">';
    $content .= '<div class="col-md-4"><a class="colorbox" href="./templates/images/toolbar.png" title="Admin Toolbar"/><img class="img-thumbnail center-block" src="./templates/images/toolbar.png" title="Admin Toolbar" /></a></div>';
    $content .= '</div>';
    $content .= '<hr/>';
    $content .= '</div>';

    $content .= '<div class="row">';
    $content .= '<div class="col-md-6">';
    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-body">';
    $content .= max_select('toolbar');
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="col-md-6">';
    $content .= '</div>';
    $content .= '</div>';

    $content .= $_content;
    define('JZ_CONTENT', $content);
    unset($content);
}
else
{
    header('Location: ./?page=project&err=current_project');
}

?>