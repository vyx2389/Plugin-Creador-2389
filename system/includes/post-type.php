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
    $supports = array(
        array('value' => 'title', 'label' => 'Title'),
        array('value' => 'editor', 'label' => 'Editor/Content'),
        array('value' => 'author', 'label' => 'Author'),
        array('value' => 'custom-fields', 'label' => 'Custom Fields'),
        array('value' => 'trackbacks', 'label' => 'Trackbacks'),
        array('value' => 'thumbnail', 'label' => 'Thumbnail'),
        array('value' => 'excerpt', 'label' => 'Excerpt'),
        array('value' => 'comments', 'label' => 'Comments'),
        array('value' => 'revisions', 'label' => 'Revisions'),
        array('value' => 'post-formats', 'label' => 'Post Formats'),
        array('value' => 'page-attributes', 'label' => 'Page Attributes'),
        );


    $current_set = '';
    $current_properties = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.project.json'), true);
    if (!isset($_GET['act']))
    {
        $_GET['act'] = null;
    }

    if (!isset($_GET['max-post-type']))
    {
        $_GET['max-post-type'] = 1;
    }

    if ($_GET['max-post-type'] == 0)
    {
        $_GET['max-post-type'] = 1;
    }

    if (isset($_POST['save']))
    {
        //check if project locked
        if ($current_properties['lock'] == 'true')
        {
            header('Location: ./?page=project&err=locked_project');
            exit(0);
        }

        $_post_types = $_POST['post_types'];
        file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json', json_encode($_post_types));
        rebuild();
        header('Location: ./?page=post-type&max-post-type=' . (int)$_GET['max-post-type']);
    }
    if ($_GET['act'] == 'reset')
    {
        @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json');
        header('Location: ./?page=post-type&max-post-type=' . (int)$_GET['max-post-type']);
    }

    $_content = null;

    $_content .= '<form action="" method="post" enctype="multipart/form-data" >';
    $_content .= '<div class="row">';

    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'))
    {
        $current_post_types = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'), true);
        $current_set = '<span class="badge">' . count($current_post_types) . '</span>';
        if (count($current_post_types) != $_GET['max-post-type'])
        {
            if (($_GET['act'] != 'max-post-type') && (count($current_post_types) != 0))
            {
                header('Location: ./?page=post-type&max-post-type=' . count($current_post_types));
            }

        }
    }

    for ($i = 1; $i <= (int)$_GET['max-post-type']; $i++)
    {
        $x = $i - 1;
        $post_type['name'] = '';
        $post_type['desc'] = '';
        $post_type['icon'] = 'dashicons-tickets';
        $post_type['text-name'] = '';
        $post_type['text-singular_name'] = '';
        $post_type['text-menu_name'] = '';
        $post_type['text-name_admin_bar'] = '';
        $post_type['text-add_new'] = '';
        $post_type['text-add_new_item'] = '';
        $post_type['text-new_item'] = '';
        $post_type['text-edit_item'] = '';
        $post_type['text-view_item'] = '';
        $post_type['text-all_items'] = '';
        $post_type['text-search_items'] = '';
        $post_type['text-parent_item_colon'] = '';
        $post_type['text-not_found'] = '';
        $post_type['text-not_found_in_trash'] = '';
        $post_type['single_template'] = false;
        $post_type['publicly_queryable'] = false;
        $post_type['rest_api'] = false;

        if (isset($current_post_types[$x]))
        {

            if (isset($current_post_types[$x]['name']))
            {
                $post_type['name'] = $current_post_types[$x]['name'];
            }
            if (isset($current_post_types[$x]['desc']))
            {
                $post_type['desc'] = $current_post_types[$x]['desc'];
            }

            if (isset($current_post_types[$x]['icon']))
            {
                $post_type['icon'] = $current_post_types[$x]['icon'];
            }

            if (isset($current_post_types[$x]['supports']))
            {
                $post_type['supports'] = $current_post_types[$x]['supports'];
            } else
            {
                $post_type['supports'] = array();
            }


            if (isset($current_post_types[$x]['text-name']))
            {
                $post_type['text-name'] = $current_post_types[$x]['text-name'];
            }

            if (isset($current_post_types[$x]['text-singular_name']))
            {
                $post_type['text-singular_name'] = $current_post_types[$x]['text-singular_name'];
            }

            if (isset($current_post_types[$x]['text-menu_name']))
            {
                $post_type['text-menu_name'] = $current_post_types[$x]['text-menu_name'];
            }

            if (isset($current_post_types[$x]['text-name_admin_bar']))
            {
                $post_type['text-name_admin_bar'] = $current_post_types[$x]['text-name_admin_bar'];
            }


            if (isset($current_post_types[$x]['text-add_new']))
            {
                $post_type['text-add_new'] = $current_post_types[$x]['text-add_new'];
            }

            if (isset($current_post_types[$x]['text-add_new_item']))
            {
                $post_type['text-add_new_item'] = $current_post_types[$x]['text-add_new_item'];
            }

            if (isset($current_post_types[$x]['text-new_item']))
            {
                $post_type['text-new_item'] = $current_post_types[$x]['text-new_item'];
            }

            if (isset($current_post_types[$x]['text-edit_item']))
            {
                $post_type['text-edit_item'] = $current_post_types[$x]['text-edit_item'];
            }


            if (isset($current_post_types[$x]['text-view_item']))
            {
                $post_type['text-view_item'] = $current_post_types[$x]['text-view_item'];
            }

            if (isset($current_post_types[$x]['text-all_items']))
            {
                $post_type['text-all_items'] = $current_post_types[$x]['text-all_items'];
            }

            if (isset($current_post_types[$x]['text-search_items']))
            {
                $post_type['text-search_items'] = $current_post_types[$x]['text-search_items'];
            }

            if (isset($current_post_types[$x]['text-parent_item_colon']))
            {
                $post_type['text-parent_item_colon'] = $current_post_types[$x]['text-parent_item_colon'];
            }

            if (isset($current_post_types[$x]['text-not_found']))
            {
                $post_type['text-not_found'] = $current_post_types[$x]['text-not_found'];
            }

            if (isset($current_post_types[$x]['text-not_found_in_trash']))
            {
                $post_type['text-not_found_in_trash'] = $current_post_types[$x]['text-not_found_in_trash'];
            }

            if (isset($current_post_types[$x]['single_template']))
            {
                $post_type['single_template'] = $current_post_types[$x]['single_template'];
            }

            if (isset($current_post_types[$x]['publicly_queryable']))
            {
                $post_type['publicly_queryable'] = $current_post_types[$x]['publicly_queryable'];
            }

            if (isset($current_post_types[$x]['rest_api']))
            {
                $post_type['rest_api'] = $current_post_types[$x]['rest_api'];
            }

        }

        $_content .= '<div class="col-md-12" id="box-' . $x . '">';
        $_content .= '<div class="panel panel-default">';
        $_content .= '<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-book"></i> Post (' . $i . ') <a class="remove btn btn-default btn-xs pull-right" href="#box-' . $x . '"><span class="fa fa-trash"></span> ' . $post_type['name'] . '</a></h4></div>';
        $_content .= '<div class="panel-body">';
        $_content .= '<div class="form-group"><label>Name</label><input data-type="var" placeholder="book" class="form-control" type="text" name="post_types[' . $x . '][name]" value="' . $post_type['name'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Description</label><textarea class="form-control" type="text" name="post_types[' . $x . '][desc]">' . $post_type['desc'] . '</textarea></div>';
        $_content .= '
        <div class="form-group">
        <label>Icon</label>
            <div class="input-group">
                <input class="form-control" placeholder="dashicons-format-gallery" type="text" id="post_types_' . $x . '_icon" name="post_types[' . $x . '][icon]" value="' . $post_type['icon'] . '" />
                <span class="input-group-btn">
                    <a class="opener-dialog btn btn-default" target="_blank" href="./?page=dashicon&modal=true" data-target="#post_types_' . $x . '_icon" >Icon</a>
                </span>
            </div>
        </div>';

        $_content .= '<div class="form-group"><label>Supports</label>';
        $_content .= '<div class="row">';
        $z = 0;
        foreach ($supports as $support)
        {
            $_content .= '<div class="col-md-3">';
            $_content .= '<div class="checkbox">';

            if (!isset($post_type['supports']))
            {
                $post_type['supports'] = array();
            }

            if (!is_array($post_type['supports']))
            {
                $post_type['supports'] = array();
            }

            if (in_array(trim($support['value']), $post_type['supports']))
            {
                $_content .= '<label><input type="checkbox" checked="checked" name="post_types[' . $x . '][supports][' . $z . ']" value="' . $support['value'] . '"/>' . $support['label'] . '</label>';
            } else
            {
                $_content .= '<label><input type="checkbox" name="post_types[' . $x . '][supports][' . $z . ']" value="' . $support['value'] . '"/>' . $support['label'] . '</label>';
            }

            $_content .= '</div>';
            $_content .= '</div>';
            $z++;
        }
        $_content .= '</div>';
        $_content .= '</div>';

        $_content .= '<hr/>';

        $_content .= '<div class="row">';
        $_content .= '<div class="col-md-12">';


        $_content .= '<div class="checkbox">';
        if (!isset($post_type['single_template']))
        {
            $post_type['single_template'] == false;
        }
        if ($post_type['single_template'] == true)
        {
            $_content .= '<label><input type="checkbox" checked="checked" name="post_types[' . $x . '][single_template][' . $z . ']" value="1"/>Single Template by plugin</label>';
        } else
        {
            $_content .= '<label><input type="checkbox" name="post_types[' . $x . '][single_template][' . $z . ']" value="1"/>Single Template by plugin</label>';
        }
        $_content .= '</div>';


        $_content .= '<div class="checkbox">';
        if (!isset($post_type['publicly_queryable']))
        {
            $post_type['publicly_queryable'] == false;
        }

        if ($post_type['publicly_queryable'] == true)
        {
            $_content .= '<label><input type="checkbox" checked="checked" name="post_types[' . $x . '][publicly_queryable][' . $z . ']" value="1"/>Publicly Queryable (Display in frontend)</label>';
        } else
        {
            $_content .= '<label><input type="checkbox" name="post_types[' . $x . '][publicly_queryable][' . $z . ']" value="1"/>Publicly Queryable (Display in frontend)</label>';
        }
        $_content .= '</div>';


        $_content .= '<div class="checkbox">';
        if (!isset($post_type['rest_api']))
        {
            $post_type['rest_api'] == false;
        }

        if ($post_type['rest_api'] == true)
        {
            $_content .= '<label><input type="checkbox" checked="checked" name="post_types[' . $x . '][rest_api][' . $z . ']" value="1"/>REST API</label>';
        } else
        {
            $_content .= '<label><input type="checkbox" name="post_types[' . $x . '][rest_api][' . $z . ']" value="1"/>REST API</label>';
        }
        $_content .= '</div>';


        $_content .= '</div>';
        $_content .= '</div>';

        $_content .= '<hr/>';
        $_content .= '<div class="row">';
        $_content .= '<div class="col-md-6">';
        $_content .= '<div class="form-group"><label>General Name Text</label><input placeholder="Books" class="form-control" type="text" name="post_types[' . $x . '][text-name]" value="' . $post_type['text-name'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Name for Item Text</label><input placeholder="Book" class="form-control" type="text" name="post_types[' . $x . '][text-singular_name]" value="' . $post_type['text-singular_name'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Menu Name Text</label><input placeholder="Books" class="form-control" type="text" name="post_types[' . $x . '][text-menu_name]" value="' . $post_type['text-menu_name'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Name Admin Bar Text</label><input placeholder="Books" class="form-control" type="text" name="post_types[' . $x . '][text-name_admin_bar]" value="' . $post_type['text-name_admin_bar'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Add New Text</label><input placeholder="Add New" class="form-control" type="text" name="post_types[' . $x . '][text-add_new]" value="' . $post_type['text-add_new'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Add New Item Text</label><input placeholder="Add New Book" class="form-control" type="text" name="post_types[' . $x . '][text-add_new_item]" value="' . $post_type['text-add_new_item'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>New Item Text</label><input placeholder="New Book" class="form-control" type="text" name="post_types[' . $x . '][text-new_item]" value="' . $post_type['text-new_item'] . '" required="required"/></div>';
        $_content .= '</div>';
        $_content .= '<div class="col-md-6">';
        $_content .= '<div class="form-group"><label>Edit Item Text</label><input placeholder="Edit Book" class="form-control" type="text" name="post_types[' . $x . '][text-edit_item]" value="' . $post_type['text-edit_item'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>View Item Text</label><input placeholder="View Book" class="form-control" type="text" name="post_types[' . $x . '][text-view_item]" value="' . $post_type['text-view_item'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>All Items Text</label><input placeholder="All Books" class="form-control" type="text" name="post_types[' . $x . '][text-all_items]" value="' . $post_type['text-all_items'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Search Items Text</label><input placeholder="Search Books" class="form-control" type="text" name="post_types[' . $x . '][text-search_items]" value="' . $post_type['text-search_items'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Parent Items Text</label><input placeholder="Parent Books:" class="form-control" type="text" name="post_types[' . $x . '][text-parent_item_colon]" value="' . $post_type['text-parent_item_colon'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Not Found Text</label><input placeholder="No books found." class="form-control" type="text" name="post_types[' . $x . '][text-not_found]" value="' . $post_type['text-not_found'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>No Found in Trash Text</label><input placeholder="No books found in Trash." class="form-control" type="text" name="post_types[' . $x . '][text-not_found_in_trash]" value="' . $post_type['text-not_found_in_trash'] . '" required="required"/></div>';
        $_content .= '</div>';
        $_content .= '</div>';

        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
    }


    $_content .= '</div>';
    $_content .= '<button type="submit" class="btn btn-primary" name="save">Save</button> ';
    $_content .= 'or <a href="./?page=post-type&act=reset">Remove</a> ';
    $_content .= '</form>';


    $content = null;
    $content .= '<a href="#help-box" data-toggle="collapse" class="label label-danger pull-right" >Help <span class="fa fa-question"></span></a>';
    $content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-book fa-stack-1x"></i></span> <strong>Post</strong> Type  ' . $current_set . '</h2>';
    $content .= '<div id="help-box" class="panel-collapse collapse">';
    $content .= '
    <blockquote class="blockquote blockquote-danger">
    <h4>Help</h4>
    <p>Create or modify a post type, combination a costum <strong>post type</strong> and <strong>metabox</strong> can be use as <strong>database</strong></p>
    <p>For avoid page not found (Oops! That page can\'t be found) after create custom page type please go <strong>Settings</strong> Menu -&gt; <strong>permalinks</strong> and click <strong>Save Changes</strong> again.</p>
   ';

    $content .= '<div class="row">';
    $content .= '<div class="col-md-4"><a class="colorbox" href="./templates/images/post-type.png" title="Post Type"/><img class="img-thumbnail center-block" src="./templates/images/post-type.png" title="Post Type" /></a></div>';
    $content .= '</div>';

    $content .= ' </blockquote>';
    $content .= '<hr/>';

    $content .= '</div>';


    $content .= '<div class="row">';
    $content .= '<div class="col-md-6">';
    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-body">';
    $content .= max_select('post-type');
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