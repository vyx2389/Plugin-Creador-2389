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
    if (!isset($_GET['act']))
    {
        $_GET['act'] = 'default';
    }

    $content = null;
    $content .= '<h3><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-list-alt fa-stack-1x"></i></span> Build Project</h3>';

    switch ($_GET['act'])
    {
        case 'default':
            //check if project locked
            $code = rebuild(true);

            $download_file = './' . str_replace(BASE_PATH, '', PROJECT_OUTPUT) . '/' . $code->Plugin_Prefix . '.zip';
            $content .= '<ul class="nav nav-tabs">';
            $content .= '<li class="active"><a href="#files" data-toggle="tab">Build Project</a></li>';
            $content .= '<li><a href="#main" data-toggle="tab" >Review Project</a></li>';
            $content .= '<li><a href="./?page=code-view" >Code View</a></li>';
            $content .= '</ul>';
            $content .= '<div class="tab-content">';
            $content .= '<div class="tab-pane fade in active" id="files">';
            $content .= '<h4>List of files that have been created</h4>';
            $content .= '<table class="table table-striped">';
            $_SESSION['OUTPUT_FILE'] = null;
            foreach ($code->files as $file)
            {
                $path_file = PROJECT_LIVE_WP_TEST . '/wp-content/plugins/' . $file['path'];
                if (file_exists($path_file))
                {
                    $hash = sha1(md5($file['path']));
                    $editable = '<span class="label label-warning">Edit</span>';
                    if (!isset($file['editable']))
                    {
                        $file['editable'] = false;
                    }
                    if ($file['editable'] == false)
                    {
                        $editable = '';
                    }
                    $content .= '<tr>';
                    $content .= '<td><a target="_blank" href="./?page=code-creator&amp;act=source&amp;hash_file=' . $hash . '" >' . $file['path'] . '</a></td>';
                    $content .= '<td>' . $editable . '</td>';
                    $content .= '</tr>';

                    $_SESSION['OUTPUT_FILE'][$hash] = $file['path'];
                }
            }
            $content .= '</table>';

            $content .= '<div class="alert alert-warning"><h4>Note!</h4><p>Reset button will erase all files that have been created, If there are files that you edited manually or you added, its will be removed automatically. this will not remove the project settings you have made.</p></div>';
            $content .= '<a class="btn btn-lg btn-danger" href="./?page=code-creator&amp;act=default&amp;reset=true"><span class="fa fa-reset"></span> Reset</a>';
            $content .= '<a class="btn btn-lg btn-warning" href="' . $download_file . '"><span class="fa fa-download"></span> Download</a>';


            $content .= '</div>';


            $content .= '<div class="tab-pane fade" id="main">';
            $content .= '<h4>Review Project</h4>';

            if (count($code->post_types) != 0)
            {
                $content .= '<div class="panel panel-default">';
                $content .= '<div class="panel-heading"><h4 class="panel-title"><strong>Image</strong> Size</h4></div>';
                $content .= '<div class="panel-body">';
                $content .= '<div class="table-responsive">';
                $content .= '<table class="table table-striped">';
                $content .= '<thead>';
                $content .= '<tr><th>Name</th><th>Size</th><th>Crop</th></tr>';
                $content .= '</thead>';
                $content .= '<tbody>';
                        if (!is_array($code->image_sizes))
        {
            $code->image_sizes = array();
        }
                foreach ($code->image_sizes as $image_sizes)
                {
                    $image_sizes['crop'] = '<span class="label label-warning">false</span>';
                    if (!isset($image_sizes['crop']))
                    {
                        $image_sizes['crop'] = '<span class="label label-warning">false</span>';
                    }
                    if ($image_sizes['crop'] == '1')
                    {
                        $image_sizes['crop'] = '<span class="label label-success">true</span>';
                    }
                    $content .= '<tr><td>' . $image_sizes['name'] . '</td><td>' . $image_sizes['width'] . 'x' . $image_sizes['height'] . '</td><td>' . $image_sizes['crop'] . '</td></tr>';
                }
                $content .= '</tbody>';
                $content .= '</table>';
                $content .= '</div>';
                $content .= '</div>';
                $content .= '</div>';
            }

            if (count($code->post_types) != 0)
            {
                $content .= '<div class="panel panel-default">';
                $content .= '<div class="panel-heading"><h4 class="panel-title"><strong>Post</strong>Type</h4></div>';
                $content .= '<div class="panel-body">';
                $content .= '<div class="table-responsive">';
                $content .= '<table class="table table-striped">';
                $content .= '<thead>';
                $content .= '<tr><th>Name</th><th>Desc</th><th>Icon</th></tr>';
                $content .= '</thead>';
                $content .= '<tbody>';
                foreach ($code->post_types as $post_types)
                {
                    if (!isset($post_types['desc']))
                    {
                        $post_types['desc'] = '';
                    }
                    $content .= '<tr><td>' . $post_types['name'] . '</td><td>' . $post_types['desc'] . '</td><td>' . $post_types['icon'] . '</td></tr>';
                }
                $content .= '</tbody>';
                $content .= '</table>';
                $content .= '</div>';
                $content .= '</div>';
                $content .= '</div>';
            }
            if (count($code->metaboxs) != 0)
            {
                $content .= '<div class="panel panel-default">';
                $content .= '<div class="panel-heading"><h4 class="panel-title"><strong>Meta</strong>box</h4></div>';
                $content .= '<div class="panel-body">';
                $content .= '<div class="table-responsive">';
                $content .= '<table class="table table-striped">';
                $content .= '<thead>';
                $content .= '<tr><th>Name</th><th>Label</th><th>Display at</th></tr>';
                $content .= '</thead>';
                $content .= '<tbody>';
                foreach ($code->metaboxs as $metaboxs)
                {
                    if (!isset($metaboxs['hooks']))
                    {
                        $metaboxs['hooks'] = array();
                    }
                    if (!is_array($metaboxs['hooks']))
                    {
                        $metaboxs['hooks'] = array();
                    }
                    $content .= '<tr><td>' . $metaboxs['name'] . '</td><td>' . $metaboxs['label'] . '</td><td>' . implode(', ', $metaboxs['hooks']) . '</td></tr>';
                }
                $content .= '</tbody>';
                $content .= '</table>';
                $content .= '</div>';
                $content .= '</div>';
                $content .= '</div>';
            }


            if (count($code->toolbars) != 0)
            {
                $content .= '<div class="panel panel-default">';
                $content .= '<div class="panel-heading"><h4 class="panel-title">Tool<strong>bar</strong></h4></div>';
                $content .= '<div class="panel-body">';
                $content .= '<div class="table-responsive">';
                $content .= '<table class="table table-striped">';
                $content .= '<thead>';
                $content .= '<tr><th>ID</th><th>Anchor</th><th>URL</th><th>Parent</th></tr>';
                $content .= '</thead>';
                $content .= '<tbody>';
                foreach ($code->toolbars as $toolbars)
                {
                    if (!isset($toolbars['parent']))
                    {
                        $toolbars['parent'] = '';
                    }
                    $content .= '<tr><td>' . $toolbars['id'] . '</td><td>' . $toolbars['anchor'] . '</td><td>' . $toolbars['url'] . '</td><td>' . $toolbars['parent'] . '</td></tr>';
                }
                $content .= '</tbody>';
                $content .= '</table>';
                $content .= '</div>';
                $content .= '</div>';
                $content .= '</div>';
            }


            if (count($code->shortcodes) != 0)
            {
                $content .= '<div class="panel panel-default">';
                $content .= '<div class="panel-heading"><h4 class="panel-title">Short<strong>code</strong></h4></div>';
                $content .= '<div class="panel-body">';
                $content .= '<div class="table-responsive">';
                $content .= '<table class="table table-striped">';
                $content .= '<thead>';
                $content .= '<tr><th>Tag</th><th>Title</th><th>Code</th><th>Post Type</th></tr>';
                $content .= '</thead>';
                $content .= '<tbody>';
                foreach ($code->shortcodes as $shortcodes)
                {
                    $content .= '<tr><td>' . $shortcodes['tag'] . '</td><td>' . $shortcodes['title'] . '</td><td>' . $shortcodes['sample_code'] . '</td><td>' . $shortcodes['post_type'] . '</td></tr>';
                }
                $content .= '</tbody>';
                $content .= '</table>';
                $content .= '</div>';
                $content .= '</div>';
                $content .= '</div>';

            }


            if (count($code->options) != 0)
            {
                $content .= '<div class="panel panel-default">';
                $content .= '<div class="panel-heading"><h4 class="panel-title"><strong>Option</strong></h4></div>';
                $content .= '<div class="panel-body">';
                $content .= '<div class="table-responsive">';
                $content .= '<table class="table table-striped">';
                $content .= '<thead>';
                $content .= '<tr><th>Name</th><th>Label</th><th>Explanation</th><th>Type</th><th>Default</th></tr>';
                $content .= '</thead>';
                $content .= '<tbody>';
                foreach ($code->options as $options)
                {
                    if (!isset($options['label']))
                    {
                        $options['label'] = '';
                    }
                                        if (!isset($options['explanation']))
                    {
                        $options['explanation'] = ' ';
                    }
                                        if (!isset($options['default']))
                    {
                        $options['default'] = '';
                    }
                       
                       
                    $content .= '<tr><td>' . $options['name'] . '</td><td>' . $options['label'] . '</td><td>' . $options['explanation'] . '</td><td>' . $options['type'] . '</td><td>' . $options['default'] . '</td></tr>';
                }
                $content .= '</tbody>';
                $content .= '</table>';
                $content .= '</div>';
                $content .= '</div>';
                $content .= '</div>';
            }

            if (count($code->widgets) != 0)
            {
                $content .= '<div class="panel panel-default">';
                $content .= '<div class="panel-heading"><h4 class="panel-title"><strong>Widget</strong></h4></div>';
                $content .= '<div class="panel-body">';
                $content .= '<div class="table-responsive">';
                $content .= '<table class="table table-striped">';
                $content .= '<thead>';
                $content .= '<tr><th>ID</th><th>Title</th><th>Desc</th></tr>';
                $content .= '</thead>';
                $content .= '<tbody>';
                foreach ($code->widgets as $widgets)
                {
                    if(!isset($widgets['desc'])){
                        $widgets['desc'] = '';
                    }
                    $content .= '<tr><td>' . $widgets['id'] . '</td><td>' . $widgets['title'] . '</td><td>' . $widgets['desc'] . '</td></tr>';
                }
                $content .= '</tbody>';
                $content .= '</table>';
                $content .= '</div>';
                $content .= '</div>';
                $content .= '</div>';
            }
            if (count($code->ajaxs) != 0)
            {
                $content .= '<div class="panel panel-default">';
                $content .= '<div class="panel-heading"><h4 class="panel-title">WP <strong>Ajax</strong></h4></div>';
                $content .= '<div class="panel-body">';
                $content .= '<div class="table-responsive">';
                $content .= '<table class="table table-striped">';
                $content .= '<thead>';
                $content .= '<tr><th>ID</th><th>Query</th><th>Page</th></tr>';
                $content .= '</thead>';
                $content .= '<tbody>';
                foreach ($code->ajaxs as $ajaxs)
                {
                    $admin = '<span class="label label-danger">Front-End</span>';
                    if (isset($ajaxs['admin']))
                    {
                        if ($ajaxs['admin'] == '1')
                        {
                            $admin = '<span class="label label-warning">Back-End</span>';
                        }
                    }
                    if (!isset($ajaxs['query']))
                    {
                        $ajaxs['query'] = array();
                    }
                    $content .= '<tr><td>' . $ajaxs['submit'] . '</td><td>' . implode(', ', $ajaxs['query']) . '</td><td>' . $admin . '</td></tr>';
                }
                $content .= '</tbody>';
                $content .= '</table>';
                $content .= '</div>';
                $content .= '</div>';
                $content .= '</div>';
            }


            if (count($code->styles) != 0)
            {
                $content .= '<div class="panel panel-default">';
                $content .= '<div class="panel-heading"><h4 class="panel-title"><strong>Styles</strong></h4></div>';
                $content .= '<div class="panel-body">';
                $content .= '<div class="table-responsive">';
                $content .= '<table class="table table-striped">';
                $content .= '<thead>';
                $content .= '<tr><th>Name</th><th>Source</th><th>Page</th></tr>';
                $content .= '</thead>';
                $content .= '<tbody>';
                foreach ($code->styles as $styles)
                {
                    $admin = '<span class="label label-danger">Front-End</span>';
                    if (isset($styles['admin']))
                    {
                        if ($styles['admin'] == '1')
                        {
                            $admin = '<span class="label label-warning">Back-End</span>';
                        }
                    }
                    if (!isset($ajaxs['deps']))
                    {
                        $ajaxs['deps'] = array();
                    }
                    $content .= '<tr><td>' . $styles['name'] . '</td><td>' . $styles['src'] . '</td><td>' . $admin . '</td></tr>';
                }
                $content .= '</tbody>';
                $content .= '</table>';
                $content .= '</div>';
                $content .= '</div>';
                $content .= '</div>';
            }
            if (count($code->javascripts) != 0)
            {
                $content .= '<div class="panel panel-default">';
                $content .= '<div class="panel-heading"><h4 class="panel-title"><strong>Javascripts</strong></h4></div>';
                $content .= '<div class="panel-body">';
                $content .= '<div class="table-responsive">';
                $content .= '<table class="table table-striped">';
                $content .= '<thead>';
                $content .= '<tr><th>ID</th><th>Source</th><th>Required</th><th>For</th><th>Page</th></tr>';
                $content .= '</thead>';
                $content .= '<tbody>';
                foreach ($code->javascripts as $javascripts)
                {
                    $admin = '<span class="label label-danger">Front-End</span>';
                    if (!isset($javascripts['for']))
                    {
                        $javascripts['for'] = null;
                    }
                    if (!isset($javascripts['version']))
                    {
                        $javascripts['version'] = null;
                    }
                    if (isset($javascripts['admin']))
                    {
                        if ($javascripts['admin'] == '1')
                        {
                            $admin = '<span class="label label-warning">Back-End</span>';
                        }
                    }
                    if (!isset($javascripts['deps']))
                    {
                        $javascripts['deps'] = array();
                    }
                    $content .= '<tr><td>' . $javascripts['name'] . '<br/>Version: ' . $javascripts['version'] . '</td><td>' . $javascripts['src'] . '</td><td>' . implode(', ', $javascripts['deps']) . '</td><td>' . $javascripts['for'] . '</td><td>' . $admin . '</td></tr>';
                }
                $content .= '</tbody>';
                $content .= '</table>';
                $content .= '</div>';
                $content .= '</div>';
                $content .= '</div>';
            }

            if (count($code->admin_menus) != 0)
            {
                $content .= '<div class="panel panel-default">';
                $content .= '<div class="panel-heading"><h4 class="panel-title"><strong>Admin</strong> Menu</h4></div>';
                $content .= '<div class="panel-body">';
                $content .= '<div class="table-responsive">';
                $content .= '<table class="table table-striped">';
                $content .= '<thead>';
                $content .= '<tr><th>Name</th><th>Label</th><th>Icon</th></tr>';
                $content .= '</thead>';
                $content .= '<tbody>';
                foreach ($code->admin_menus as $admin_menus)
                {
                    if (!isset($admin_menus['icon']))
                    {
                        $admin_menus['icon'] = 'dashicons-smiley';
                    }

                    $content .= '<tr><td>' . $admin_menus['name'] . '</td><td>' . $admin_menus['label'] . '</td><td>' . $admin_menus['icon'] . '</td></tr>';
                }
                $content .= '</tbody>';
                $content .= '</table>';
                $content .= '</div>';
                $content .= '</div>';
                $content .= '</div>';
            }


            $content .= '</div>';
            $content .= '</div>';


            break;
        case 'source':
            if (!isset($_GET['hash_file']))
            {
                $_GET['hash_file'] = null;
            }
            $hash = $_GET['hash_file'];
            if (isset($_SESSION['OUTPUT_FILE'][$hash]))
            {
                $dec_hash = $_SESSION['OUTPUT_FILE'][$hash];
                $filename = (PROJECT_LIVE_WP_TEST . '/wp-content/plugins/' . $dec_hash);

                header('Content-type: text/plain');
                if (file_exists($filename))
                {

                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $source_code = file_get_contents($filename);
                    die($source_code);
                } else
                {
                    die('File not found');
                }
            } else
            {
                die('Invalid hash file');
            }
            break;
    }

    define('JZ_CONTENT', $content);
} else
{
    header('Location: ./?page=project');
}

?>