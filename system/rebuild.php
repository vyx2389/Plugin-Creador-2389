<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @package WordPress Plugin Maker
 * @license Commercial License
 */

defined("EXEC") or die();

function rebuild($reset = false)
{
    if ($_SESSION['current_project'] != null)
    {
        $current_properties = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.project.json'), true);
        $current_properties['reset'] = $reset;
        $current_properties['dir'] = PROJECT_OUTPUT;
        $current_properties['live_wp_test'] = realpath(PROJECT_LIVE_WP_TEST);


        $code = new wpGenerator($current_properties);

        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.admin-menu.json'))
        {
            $current_admin_menus = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.admin-menu.json'), true);
            if (!is_array($current_admin_menus))
            {
                @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.admin-menu.json');
                $current_admin_menus = array();
            }
            $code->admin_menus = $current_admin_menus;
        }

        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.toolbar.json'))
        {
            $current_toolbars = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.toolbar.json'), true);
            $code->toolbars = $current_toolbars;
        }

        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.option.json'))
        {
            $current_options = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.option.json'), true);
            if (!is_array($current_options))
            {
                @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.option.json');
                $current_options = array();
            }
            $code->options = $current_options;
        }

        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.shortcode.json'))
        {
            $current_shortcodes = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.shortcode.json'), true);

            if (!is_array($current_shortcodes))
            {
                @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.shortcode.json');
                $current_shortcodes = array();
            }
            $code->shortcodes = $current_shortcodes;
        }

        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.metabox.json'))
        {
            $current_metaboxs = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.metabox.json'), true);
            $code->metaboxs = $current_metaboxs;
        }

        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.rest_api.json'))
        {
            $current_rest_api = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.rest_api.json'), true);
            $code->rest_api = $current_rest_api;
        }
        
        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.ajax.json'))
        {
            $current_ajaxs = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.ajax.json'), true);
            $code->ajaxs = $current_ajaxs;
        }

        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.javascript.json'))
        {
            $current_javascripts = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.javascript.json'), true);

            if (!is_array($current_javascripts))
            {
                @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.javascript.json');
                $current_javascripts = array();
            }
            $code->javascripts = $current_javascripts;
        }

        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.style.json'))
        {
            $current_styles = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.style.json'), true);
            if (!is_array($current_styles))
            {
                @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.style.json');
                $current_styles = array();
            }
            $code->styles = $current_styles;
        }

        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.widget.json'))
        {
            $current_widgets = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.widget.json'), true);
            if (!is_array($current_widgets))
            {
                @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.widget.json');
                $current_widgets = array();
            }
            $code->widgets = $current_widgets;
        }

        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'))
        {
            $current_post_types = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json'), true);
            $code->post_types = $current_post_types;
        }

        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.image_size.json'))
        {
            $current_image_sizes = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.image_size.json'), true);
            $code->image_sizes = $current_image_sizes;
        }
        
                if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.taxonomies.json'))
        {
            $current_taxonomies = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.taxonomies.json'), true);
            $code->taxonomies = $current_taxonomies;
        }
        
        
        if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.tinymce.json'))
        {
            $current_tinymces = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.tinymce.json'), true);
            $code->tinymces = $current_tinymces;
        }
        $content = null;
        $output = $code->Generate();

        if (count($code->toolbars) != 0)
        {
            file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.toolbar.json', json_encode($code->toolbars));
        }
        if (count($code->shortcodes) != 0)
        {
            file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.shortcode.json', json_encode($code->shortcodes));
        }

        if (count($code->ajaxs) != 0)
        {
            file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.ajax.json', json_encode($code->ajaxs));
        }
        if (count($code->metaboxs) != 0)
        {
            file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.metabox.json', json_encode($code->metaboxs));
        }
        if (count($code->options) != 0)
        {
            file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.option.json', json_encode($code->options));
        }
        if (count($code->widgets) != 0)
        {
            file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.widget.json', json_encode($code->widgets));
        }

        if (count($code->styles) != 0)
        {
            file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.style.json', json_encode($code->styles));
        }
        if (count($code->javascripts) != 0)
        {
            file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.javascript.json', json_encode($code->javascripts));
        }
        if (count($code->admin_menus) != 0)
        {
            file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.admin-menu.json', json_encode($code->admin_menus));
        }

        if (count($code->post_types) != 0)
        {
            file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.post_type.json', json_encode($code->post_types));
        }

        if (count($code->image_sizes) != 0)
        {
            file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.image_size.json', json_encode($code->image_sizes));
        }
        if(!isset($code->rest_api)){
            $code->rest_api = array();
        }
        if (count($code->rest_api) != 0)
        {
            file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.rest_api.json', json_encode($code->rest_api));
        }

        if (count($code->taxonomies) != 0)
        {
            file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.taxonomies.json', json_encode($code->taxonomies));
        }
        
        if (count($code->tinymces) != 0)
        {
            file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.tinymce.json', json_encode($code->tinymces));
        }
        return $code;
    }
}

?>