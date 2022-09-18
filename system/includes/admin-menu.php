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
    //get current project info
    $current_properties = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.project.json'), true);

    //error handle
    if (!isset($_GET['act']))
    {
        $_GET['act'] = null;
    }

    if (!isset($_GET['max-admin-menu']))
    {
        $_GET['max-admin-menu'] = 1;
    }

    if ($_GET['max-admin-menu'] == 0)
    {
        $_GET['max-admin-menu'] = 1;
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


        $admin_menus = $_POST['admin-menus'];
        //save to file
        file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.admin-menu.json', json_encode($admin_menus));

        //refix config project
        rebuild();

        //reload page
        header('Location: ./?page=admin-menu&save=true&max-admin-menu=' . (int)$_GET['max-admin-menu']);
    }

    //reset config
    if ($_GET['act'] == 'reset')
    {
        //remove file config
        @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.admin-menu.json');
        //reload file
        header('Location: ./?page=admin-menu&max-admin-menu=' . (int)$_GET['max-admin-menu']);
    }

    //start create form
    $_content = null;
    $_content .= '<form action="" method="post" enctype="multipart/form-data" >';
    $_content .= '<div class="row">';

    $current_set = '';
    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.admin-menu.json'))
    {
        //get current parameter
        $current_admin_menus = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.admin-menu.json'), true);

        //display html
        $current_set = '<span class="badge">' . count($current_admin_menus) . '</span>';

        //ceate form according max parameter
        if (count($current_admin_menus) != $_GET['max-admin-menu'])
        {
            if (($_GET['act'] != 'max-admin-menu') && (count($current_admin_menus) != 0))
            {
                //reload page
                header('Location: ./?page=admin-menu&max-admin-menu=' . count($current_admin_menus));
            }

        }
    }

    //display html form
    for ($i = 1; $i <= (int)$_GET['max-admin-menu']; $i++)
    {
        $x = $i - 1;
        $admin_menu['name'] = '';
        $admin_menu['label'] = '';
        $admin_menu['icon'] = '';
        $admin_menu['markup'] = '<h4>This Admin Menu Code</h4>';

        if (isset($current_admin_menus[$x]))
        {
            if (isset($current_admin_menus[$x]['name']))
            {
                $admin_menu['name'] = $current_admin_menus[$x]['name'];
            }

            if (isset($current_admin_menus[$x]['label']))
            {
                $admin_menu['label'] = $current_admin_menus[$x]['label'];
            }

            if (isset($current_admin_menus[$x]['icon']))
            {
                $admin_menu['icon'] = $current_admin_menus[$x]['icon'];
            }
            if (isset($current_admin_menus[$x]['markup']))
            {
                $admin_menu['markup'] = $current_admin_menus[$x]['markup'];
            }


            if (isset($current_admin_menus[$x]['js']))
            {
                $admin_menu['js'] = $current_admin_menus[$x]['js'];
            }
            if (isset($current_admin_menus[$x]['css']))
            {
                $admin_menu['css'] = $current_admin_menus[$x]['css'];
            }

        }

        $_content .= '<div class="col-md-12" id="box-' . $x . '">';
        $_content .= '<div class="panel panel-default">';
        $_content .= '<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-line-chart "></i> Page (' . $i . ') <a class="remove btn btn-default btn-xs pull-right" href="#box-' . $x . '"><span class="fa fa-trash"></span></a></h4></div>';
        $_content .= '<div class="panel-body">';
        $_content .= '<div class="form-group"><label>Name</label><input data-type="var" placeholder="lorem_ipsum" class="form-control" type="text" name="admin-menus[' . $x . '][name]" value="' . $admin_menu['name'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Label</label><input placeholder="Lorem Ipsum" class="form-control" type="text" name="admin-menus[' . $x . '][label]" value="' . $admin_menu['label'] . '" required="required"/></div>';
        $_content .= '
        <div class="form-group">
            <label>Icon</label>
            <div class="input-group">
                <input class="form-control" placeholder="dashicons-format-gallery" type="text" id="admin_menus_' . $x . '_icon" name="admin-menus[' . $x . '][icon]" value="' . $admin_menu['icon'] . '" />
                <span class="input-group-btn">
                    <a class="opener-dialog btn btn-default" target="_blank" href="./?page=dashicon&modal=true" data-target="#admin_menus_' . $x . '_icon" >Icon</a>
                </span>
            </div>
        </div>
        ';
        $_content .= '<div class="form-group"><label>HTML Markup</label><textarea class="form-control" name="admin-menus[' . $x . '][markup]">' . htmlentities(stripcslashes($admin_menu['markup'])) . '</textarea></div>';
        $js_checked = '';
        if ((isset($admin_menu['js'])) && ($admin_menu['js'] == '1'))
        {
            $js_checked = 'checked="checked"';
        }
        $css_checked = '';
        if ((isset($admin_menu['css'])) && ($admin_menu['css'] == '1'))
        {
            $css_checked = 'checked="checked"';
        }
        $_content .= '
        <div class="form-group">
            <div class="checkbox"><label><input type="checkbox" name="admin-menus[' . $x . '][js]" value="1" ' . $js_checked . '/> External Javascript</label></div>
            <div class="checkbox"><label><input type="checkbox" name="admin-menus[' . $x . '][css]" value="1" ' . $css_checked . '/> External CSS</label></div>
        </div>';

        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
    }


    $_content .= '</div>';
    $_content .= '<button type="submit" class="btn btn-primary" name="save">Save</button> ';
    $_content .= 'or <a href="./?page=admin-menu&act=reset">Remove</a> ';
    $_content .= '</form>';
    //end form


    //create HTML form end
    $content = null;
    $content .= '<a href="#help-box" data-toggle="collapse" class="label label-danger pull-right" ><span class="fa fa-question"></span></a>';

    $content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-line-chart fa-stack-1x"></i></span>Top Level <strong>Admin Menu</strong>  ' . $current_set . '</h2>';
    $content .= '<div id="help-box" class="panel-collapse collapse">';
    $content .= '<blockquote><p>This form will be create admin menu and admin page code</p></blockquote>';
    $content .= '</div>';

    $content .= '<div class="row">';
    $content .= '<div class="col-md-6">';
    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-body">';
    $content .= max_select('admin-menu');
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';

    $content .= $_content;

    //save to global constant
    define('JZ_CONTENT', $content);
    unset($content);
} else
{
    //redirect if project not set
    header('Location: ./?page=project&err=current_project');
}

?>