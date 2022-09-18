<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @package WordPress Plugin Maker
 * @license Commercial License
 */

defined("EXEC") or die();
$my_project = rebuild();
$image_sizes = $taxonomies = $tinymces = $post_types = $metaboxs = $toolbars = $shortcodes = $admin_menus = $javascripts = $styles = $ajaxs = $options = $widgets = null;

if (isset($my_project->image_sizes))
{
    $image_sizes = '<span class="badge pull-right">' . count($my_project->image_sizes) . '</span>';
}

if (isset($my_project->post_types))
{
    $post_types = '<span class="badge pull-right">' . count($my_project->post_types) . '</span>';
}

if (isset($my_project->metaboxs))
{
    $metaboxs = '<span class="badge pull-right">' . count($my_project->metaboxs) . '</span>';
}

if (isset($my_project->toolbars))
{
    $toolbars = '<span class="badge pull-right">' . count($my_project->toolbars) . '</span>';
}

if (isset($my_project->shortcodes))
{
    $shortcodes = '<span class="badge pull-right">' . count($my_project->shortcodes) . '</span>';
}


if (isset($my_project->options))
{
    $options = '<span class="badge pull-right">' . count($my_project->options) . '</span>';
}
if (isset($my_project->widgets))
{
    $widgets = '<span class="badge pull-right">' . count($my_project->widgets) . '</span>';
}
if (isset($my_project->ajaxs))
{
    $ajaxs = '<span class="badge pull-right">' . count($my_project->ajaxs) . '</span>';
}
if (isset($my_project->styles))
{
    $styles = '<span class="badge pull-right">' . count($my_project->styles) . '</span>';
}
if (isset($my_project->javascripts))
{
    $javascripts = '<span class="badge pull-right">' . count($my_project->javascripts) . '</span>';
}
if (isset($my_project->admin_menus))
{
    $admin_menus = '<span class="badge pull-right">' . count($my_project->admin_menus) . '</span>';
}

if (isset($my_project->tinymces))
{
    $tinymces = '<span class="badge pull-right">' . count($my_project->tinymces) . '</span>';
}

if (isset($my_project->taxonomies))
{
    $taxonomies = '<span class="badge pull-right">' . count($my_project->taxonomies) . '</span>';
}

 
 

$_sidebars[] = array(
    'link' => 'image-size',
    'label' => '<span class="fa fa-image"></span> Image Size',
    'badge' => $image_sizes);
$_sidebars[] = array(
    'link' => 'post-type',
    'label' => '<span class="fa fa-book"></span> Post-Type',
    'badge' => $post_types);

$_sidebars[] = array(
    'link' => 'taxonomies',
    'label' => '<span class="fa fa-bookmark"></span> Taxonomies',
    'badge' => $taxonomies);

$_sidebars[] = array(
    'link' => 'metabox',
    'label' => '<span class="fa fa-list-alt"></span> Metabox',
    'badge' => $metaboxs);

$_sidebars[] = array(
    'link' => 'toolbar',
    'label' => '<span class="fa fa-link"></span> Admin Bar',
    'badge' => $toolbars);
$_sidebars[] = array(
    'link' => 'shortcode',
    'label' => '<span class="fa fa-code"></span> Shortcodes',
    'badge' => $shortcodes);
$_sidebars[] = array(
    'link' => 'option',
    'label' => '<span class="fa fa-gavel"></span> Plugin Option',
    'badge' => $options);
$_sidebars[] = array(
    'link' => 'widget',
    'label' => '<span class="fa fa-server"></span> Widgets',
    'badge' => $widgets);
$_sidebars[] = array(
    'link' => 'ajax',
    'label' => '<span class="fa fa-location-arrow"></span> WP Ajax ',
    'badge' => $ajaxs);
$_sidebars[] = array(
    'link' => 'style',
    'label' => '<span class="fa fa-css3"></span> Styles',
    'badge' => $styles);
$_sidebars[] = array(
    'link' => 'javascript',
    'label' => '<span class="fa fa-jsfiddle"></span> Javascripts ',
    'badge' => $javascripts);
$_sidebars[] = array(
    'link' => 'admin-menu',
    'label' => '<span class="fa fa-line-chart"></span> Admin Menu ',
    'badge' => $admin_menus);
$_sidebars[] = array(
    'link' => 'tinymce',
    'label' => '<span class="fa fa-line-chart"></span> TinyMCE Plugin ',
    'badge' => $tinymces);

 

if (isset($my_project->lock))
{
    $_is_lock = $my_project->lock;
} else
{
    $_is_lock = 'true';
}


$curent_project_name = 'No Project';
$project_list = '<ul class="dropdown-menu">';
$project_list .= '<li class="dropdown-header">Project</li>';
$project_list .= '<li><a href="./?page=project&amp;act=new"><span class="fa fa-file-o"></span> New Project</a></li>';
$project_list .= '<li><a href="./?page=project&amp;act=backup"><span class="fa fa-floppy-o"></span> Backup</a></li>';
$project_list .= '<li><a href="./?page=project&amp;sub=project-properties"><span class="fa fa-list"></span> Project Properties</a></li>';
$project_list .= '<li><a href="./?page=project&amp;sub=project-manager"><span class="fa fa-star"></span> Project Manager</a></li>';
$project_list .= '<li class="dropdown-header">Switch Project</li>';
foreach (glob(PROJECT_PATH . "/*.project.json") as $filename)
{
    $real_file = str_replace(".project", '', pathinfo($filename, PATHINFO_FILENAME));
    $project_properties = json_decode(file_get_contents($filename), true);

    if ($_SESSION['current_project'] == $real_file)
    {
        $project_list .= '<li><a href="./?page=project&amp;id=' . $real_file . '&amp;act=pending"><span class="fa fa-exchange"></span> ' . $project_properties['Plugin_Name'] . ' <span class="label label-danger">active</span></a></li>';
        $curent_project_name = $project_properties['Plugin_Name'];
    } else
    {
        $project_list .= '<li><a href="./?page=project&amp;id=' . $real_file . '&amp;act=active" ><span class="fa fa-exchange"></span> ' . $project_properties['Plugin_Name'] . '</a></li>';
    }

}
$project_list .= '<li class="dropdown-header">Settings</li>';

$project_list .= '<li><a href="./?page=preferences"><span class="fa fa-sliders"></span> Preferences</a></li>';
$project_list .= '</ul>';


$sidebar = null;
if (TEMPLATES_CONTAINER == 'container')
{
    $sidebar .= '<div id="container-sidebar" class="panel panel-default">';
    $sidebar .= '<div class="panel-body">';

    $sidebar .= '<div class="project-name">';
    $sidebar .= '<h4>' . $curent_project_name . '</h4>';
    $sidebar .= '<div class="btn-group btn-group-xs" >';
    $sidebar .= '<a href="./?page=project&amp;act=new" class="btn-xs btn btn-info"><span class="fa fa-file-o"></span> New</a>';
    if ($_is_lock == 'true')
    {
        $sidebar .= '<a href="./?page=project&amp;id=' . $_SESSION['current_project'] . '&amp;act=unlock" class="btn-xs btn btn-success"><span class="fa fa-lock"></span></a>';
    } else
    {
        $sidebar .= '<a href="./?page=project&amp;id=' . $_SESSION['current_project'] . '&amp;act=lock" class="btn-xs btn btn-warning"><span class="fa fa-unlock"></span></a>';

    }
    $sidebar .= '</div>';
    $sidebar .= '</div>';
    $sidebar .= '</div>';
    $sidebar .= '<ul class="nav nav-stacked">';
} else
{
    $sidebar .= '<div class="sidebar">';
    $sidebar .= '<div class="project-name">';
    $sidebar .= '<h4>' . $curent_project_name . '</h4>';
    $sidebar .= '<div class="btn-group btn-group-xs" >';
    $sidebar .= '<a href="./?page=project&amp;act=new" class="btn-xs btn btn-info"><span class="fa fa-file-o"></span> New</a>';
    if ($_is_lock == 'true')
    {
        $sidebar .= '<a href="./?page=project&amp;id=' . $_SESSION['current_project'] . '&amp;act=unlock" class="btn-xs btn btn-success"><span class="fa fa-lock"></span></a>';
    } else
    {
        $sidebar .= '<a href="./?page=project&amp;id=' . $_SESSION['current_project'] . '&amp;act=lock" class="btn-xs btn btn-warning"><span class="fa fa-unlock"></span></a>';

    }
    $sidebar .= '</div>';
    $sidebar .= '</div>';

    $sidebar .= '<ul class="nav nav-sidebar">';
}

foreach ($_sidebars as $_sidebar)
{
    $active = '';
    if ($_sidebar['link'] == $_GET['page'])
    {
        $active = 'active';
    }
    $sidebar .= '<li class="' . $active . '"><a href="./?page=' . $_sidebar['link'] . '">' . $_sidebar['label'] . ' ' . $_sidebar['badge'] . '</a></li>';
}
$sidebar .= '</ul>';

if (TEMPLATES_CONTAINER == 'container')
{
    $sidebar .= '<div class="panel-body">';
    $sidebar .= '<hr />';
    $sidebar .= '<a href="./?page=code-creator" class="btn btn-lg btn-danger"><span class="fa fa-circle"></span> Build Project</a>';
    $sidebar .= '</div>';
    $sidebar .= '</div>';

} else
{
    $sidebar .= '<hr />';
    $sidebar .= '<a href="./?page=code-creator" class="btn btn-lg btn-danger"><span class="fa fa-circle"></span> Build Project</a>';
    $sidebar .= '</div>';
}

$goto = '<ul class="dropdown-menu">';
foreach ($_sidebars as $_sidebar)
{
    $goto .= '<li><a href="./?page=' . $_sidebar['link'] . '">' . $_sidebar['label'] . '</a></li>';
}
$goto .= '</ul>';

$dropdown = null;
$dropdown .= '
<div id="dropdown" class="navbar navbar-custom navbar-fixed-top" role="navigation">
  <div class="' . TEMPLATES_CONTAINER . '">
  
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".js-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./"><strong>WP Plugin</strong> Maker</a>
    </div>
    
    <div class="navbar-collapse collapse js-navbar-collapse" role="navigation">
      
       
      <ul class="nav navbar-nav">
        <li><a href="./"><span class="fa fa-home"></span> Home</a></li>
        
        <li>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-th"></span> Go to</a>
        ' . $goto . '
        </li>
        
        <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-gavel"></span> Tools</a>
                <ul class="dropdown-menu">
                    <li class=""><a href="./?page=sample-code"><span class="fa fa-wordpress"></span> WordPress API Tool</a></li>
                    <li class=""><a href="./?page=dashicon"><span class="fa fa-flag"></span> Dashicon</a></li>
                </ul>
        </li>
        <li><a href="./?page=support"><span class="fa fa-support"></span> Contact Us</a></li>
        <li><a href="./docs/"><span class="fa fa-question"></span> Help</a></li>
         
      </ul>
      
      
      <ul class="nav navbar-nav navbar-right">
        <li><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="fa fa-th"></span> Menu <b class="caret"></b></a>' . $project_list . '</li>
      </ul>
      
    </div>
    
  </div>
</div>';

define('JZ_SIDEBAR', $sidebar);

define('JZ_DROPDOWN', $dropdown);
