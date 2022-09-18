<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @package WordPress Plugin Maker
 * @license Commercial License
 */

defined("EXEC") or die();

//switch page

if (!isset($_GET['page']))
{
    $_GET['page'] = 'default';
}
switch ($_GET['page'])
{
    case 'preferences':
        require_once SYSTEM_PATH . '/includes/preferences.php';
        break;
    case 'project':
        require_once SYSTEM_PATH . '/includes/project.php';
        break;
    case 'toolbar':
        require_once SYSTEM_PATH . '/includes/toolbar.php';
        break;
    case 'option':
        require_once SYSTEM_PATH . '/includes/option.php';
        break;
    case 'shortcode':
        require_once SYSTEM_PATH . '/includes/shortcode.php';
        break;
    case 'code-creator':
        require_once SYSTEM_PATH . '/includes/code-creator.php';
        break;
    case 'metabox':
        require_once SYSTEM_PATH . '/includes/metabox.php';
        break;
    case 'admin-menu':
        require_once SYSTEM_PATH . '/includes/admin-menu.php';
        break;
    case 'ajax':
        require_once SYSTEM_PATH . '/includes/ajax.php';
        break;
    case 'widget':
        require_once SYSTEM_PATH . '/includes/widget.php';
        break;
    case 'style':
        require_once SYSTEM_PATH . '/includes/style.php';
        break;
    case 'javascript':
        require_once SYSTEM_PATH . '/includes/javascript.php';
        break;
    case 'post-type':
        require_once SYSTEM_PATH . '/includes/post-type.php';
        break;
    case 'image-size':
        require_once SYSTEM_PATH . '/includes/image-size.php';
        break;
    case 'sample-code':
        require_once SYSTEM_PATH . '/includes/sample-code.php';
        break;
    case 'class-helper':
        require_once SYSTEM_PATH . '/includes/class-helper.php';
        break;

    case 'code-view':
        require_once SYSTEM_PATH . '/includes/code-view.php';
        break;

    case 'ajax-files':
        require_once SYSTEM_PATH . '/includes/ajax-files.php';
        break;

    case 'default':
        require_once SYSTEM_PATH . '/includes/default.php';
        break;

    case 'dashicon':
        require_once SYSTEM_PATH . '/includes/dashicon.php';
        break;

    case 'tinymce':
        require_once SYSTEM_PATH . '/includes/tinymce.php';
        break;

    case 'taxonomies':
        require_once SYSTEM_PATH . '/includes/taxonomies.php';
        break;

    case 'rest-api':
        require_once SYSTEM_PATH . '/includes/rest-api.php';
        break;

    case 'support':
        require_once SYSTEM_PATH . '/includes/support.php';
        break;

    default:
        require_once SYSTEM_PATH . '/includes/default.php';
        break;
}
