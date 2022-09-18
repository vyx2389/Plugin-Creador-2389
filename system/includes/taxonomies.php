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

    if (!isset($_GET['max-taxonomies']))
    {
        $_GET['max-taxonomies'] = 1;
    }

    if ($_GET['max-taxonomies'] == 0)
    {
        $_GET['max-taxonomies'] = 1;
    }

    if (isset($_POST['save']))
    { //check if project locked
        if ($current_properties['lock'] == 'true')
        {
            header('Location: ./?page=project&err=locked_project');
            exit(0);
        }
        $links = $_POST['taxonomiess'];
        file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.taxonomies.json', json_encode($links));
        rebuild();
        header('Location: ./?page=taxonomies&max-taxonomies=' . (int)$_GET['max-taxonomies']);
    }
    if ($_GET['act'] == 'reset')
    {
        @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.taxonomies.json');
        header('Location: ./?page=taxonomies&max-taxonomies=' . (int)$_GET['max-taxonomies']);
    }

    $_content = null;
    $taxonomies_hooks[] = 'post';
    $taxonomies_hooks[] = 'page';
    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'))
    {
        $current_post_types = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'), true);
        foreach ($current_post_types as $post_type)
        {
            $taxonomies_hooks[] = $post_type['name'];

        }
    }

    $_content .= '<form action="" method="post" enctype="multipart/form-data" >';
    $_content .= '<div class="row">';

    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.taxonomies.json'))
    {
        $current_taxonomiess = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.taxonomies.json'), true);
        $current_set = '<span class="badge">' . count($current_taxonomiess) . '</span>';
        if (count($current_taxonomiess) != $_GET['max-taxonomies'])
        {
            if (($_GET['act'] != 'max-taxonomies') && (count($current_taxonomiess) != 0))
            {
                header('Location: ./?page=taxonomies&max-taxonomies=' . count($current_taxonomiess));
            }

        }
    }


    for ($i = 1; $i <= (int)$_GET['max-taxonomies']; $i++)
    {
        $x = $i - 1;
        $taxonomies['name'] = '';
        $taxonomies['label'] = '';
        $taxonomies['hierarchical'] = 1;

        if (isset($current_taxonomiess[$x]))
        {
            if (isset($current_taxonomiess[$x]['name']))
            {
                $taxonomies['name'] = $current_taxonomiess[$x]['name'];
            }

            if (isset($current_taxonomiess[$x]['label']))
            {
                $taxonomies['label'] = $current_taxonomiess[$x]['label'];
            }
            
            if (isset($current_taxonomiess[$x]['label_plural']))
            {
                $taxonomies['label_plural'] = $current_taxonomiess[$x]['label_plural'];
            }

            if (isset($current_taxonomiess[$x]['hooks']))
            {
                $taxonomies['hooks'] = $current_taxonomiess[$x]['hooks'];
            } else
            {
                $taxonomies['hooks'] = array();
            }

            $taxonomies['hierarchical'] = false;
            if (isset($current_taxonomiess[$x]['hierarchical']))
            {
                if ($current_taxonomiess[$x]['hierarchical'] == '1')
                {
                    $taxonomies['hierarchical'] = true;
                }

            }

        }

        $_content .= '<div class="col-md-6" id="box-' . $x . '">';
        $_content .= '<div class="panel panel-default">';
        $_content .= '<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-bookmark-o"></i> Taxonomies (' . $i . ') <a class="remove btn btn-default btn-xs pull-right" href="#box-' . $x . '"><span class="fa fa-trash"></span> ' . $taxonomies['name'] . '</a></h4></div>';
        $_content .= '<div class="panel-body">';

        $_content .= '<div class="form-group"><label>Name</label><input data-type="var" placeholder="category" class="form-control" type="text" name="taxonomiess[' . $x . '][name]" value="' . $taxonomies['name'] . '" required="required"/></div>';

        $_content .= '<div class="form-group"><label>Label Singular</label><input placeholder="Category" class="form-control" type="text" name="taxonomiess[' . $x . '][label]" value="' . $taxonomies['label'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Label Plural</label><input placeholder="Categories" class="form-control" type="text" name="taxonomiess[' . $x . '][label_plural]" value="' . $taxonomies['label_plural'] . '" /></div>';

        $_content .= '<div class="form-group">';
        $_content .= '<label>Display at</label>';
        $z = 0;
        foreach ($taxonomies_hooks as $hooks)
        {
            if (isset($taxonomies['hooks'][$z]))
            {
                if ($taxonomies['hooks'][$z] == $hooks)
                {
                    $_content .= '<div class="checkbox"><label><input type="checkbox" name="taxonomiess[' . $x . '][hooks][' . $z . ']"  value="' . $hooks . '" checked="checked"/> ' . ucwords($hooks) . '</label></div>';
                } else
                {
                    $_content .= '<div class="checkbox"><label><input type="checkbox" name="taxonomiess[' . $x . '][hooks][' . $z . ']"  value="' . $hooks . '" /> ' . ucwords($hooks) . '</label></div>';
                }
            } else
            {
                $_content .= '<div class="checkbox"><label><input type="checkbox" name="taxonomiess[' . $x . '][hooks][' . $z . ']"  value="' . $hooks . '" /> ' . ucwords($hooks) . '</label></div>';
            }
            $z++;
        }
        $_content .= '</div>';

        $_content .= '<div class="form-group">';
        $_content .= '<label>Hierarchical</label>';

        if ($taxonomies['hierarchical'] == true)
        {
            $_content .= '<div class="checkbox"><label><input type="checkbox" name="taxonomiess[' . $x . '][hierarchical]"  value="1" checked="checked"/>True</label></div>';
        } else
        {
            $_content .= '<div class="checkbox"><label><input type="checkbox" name="taxonomiess[' . $x . '][hierarchical]"  value="1" />True</label></div>';
        }

        $_content .= '</div>';


        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
    }


    $_content .= '</div>';
    $_content .= '<button type="submit" class="btn btn-primary" name="save">Save</button> ';
    $_content .= 'or <a href="./?page=taxonomies&act=reset">Remove</a> ';
    $_content .= '</form>';


    $content = null;
    $content .= '<a href="#help-box" data-toggle="collapse" class="label label-danger pull-right" ><span class="fa fa-question"></span></a>';
    $content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa fa-bookmark fa-stack-1x"></i></span> <strong>T</strong>axonomies ' . $current_set . '</h2>';
    $content .= '<div id="help-box" class="panel-collapse collapse">';
    $content .= '<blockquote><p>Register new taxonomies.</p></blockquote>';
    $content .= '<hr/>';
    $content .= '</div>';

    $content .= '<div class="row">';
    $content .= '<div class="col-md-6">';
    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-body">';
    $content .= max_select('taxonomies');
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= $_content;
    define('JZ_CONTENT', $content);
    unset($content);
} else
{
    header('Location: ./?page=project&err=current_project');
}

?>