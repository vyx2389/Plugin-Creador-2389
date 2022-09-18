<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @package WordPress Plugin Maker
 * @license Commercial License
 */


defined("EXEC") or die();


$path_live_test = realpath(BASE_PATH) . DIRECTORY_SEPARATOR;
if (defined('PROJECT_LIVE_WP_TEST'))
{
    $path_live_test = PROJECT_LIVE_WP_TEST;
}

$max_postmeta = 20;
if (defined('MAX_METABOX_POSTMETA'))
{
    $max_postmeta = MAX_METABOX_POSTMETA;
}
$purchase_code = null;
if (defined('PURCHASE_CODE'))
{
    $purchase_code = PURCHASE_CODE;
}

$live_test = $path_live_test;
$content = '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-gavel fa-stack-1x"></i></span> <strong>Pre</strong>ferences</h2>';

if (isset($_POST['save']))
{
    $live_test = htmlentities($_POST['live_wp_test']);
    $test_wp = $_POST['live_wp_test'] . '/wp-config.php';
    $purchase_code = $_POST['purchase_code'];
    if (!file_exists($test_wp))
    {
        $content .= '<div class="alert alert-danger alert-dismissable">';
        $content .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        $content .= '<p><strong>Oh snap!</strong>, WordPress not found</p>';
        $content .= '</div>';
    } else
    {
        $content .= '<div class="alert alert-success alert-dismissable">';
        $content .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        $content .= '<p><strong>Well done!</strong>, Your successfully install this tool, now you can start a project.</p>';
        $content .= '<p><a href="./?page=project" class="btn btn-success">Start Project</a></p>';
        $content .= '</div>';

        $config = null;
        $config .= '<?php' . "\r\n";
        $config .= "\r\n";
        $config .= '/**' . "\r\n";
        $config .= ' * @author Jasman' . "\r\n";
        $config .= ' * @copyright Ihsana IT Solution 2015' . "\r\n";
        $config .= ' * @package WordPress Plugin Maker' . "\r\n";
        $config .= ' * @license Commercial License' . "\r\n";
        $config .= ' */' . "\r\n";
        $config .= "\r\n";
        $config .= 'defined("EXEC") or die();' . "\r\n";
        $config .= '' . "\r\n";
        $config .= 'define("PROJECT_LIVE_WP_TEST", "' . addslashes($_POST['live_wp_test']) . '");' . "\r\n";
        $config .= 'define("TEMPLATES_CONTAINER", "' . addslashes($_POST['template_layout']) . '");' . "\r\n";
        $config .= 'define("MAX_METABOX_POSTMETA", "' . (int)($_POST['max_postmeta']) . '");' . "\r\n";
        $config .= 'define("PURCHASE_CODE", "' . $purchase_code . '");' . "\r\n";


        $config .= '' . "\r\n";
        $config .= '?>';
        file_put_contents(BASE_PATH . '/config.php', $config);
    }
}

$content .= '<div class="panel panel-default">';
$content .= '<div class="panel-heading"><h4 class="panel-title">General</h4></div>';
$content .= '<div class="panel-body">';
$content .= '<form method="post" action="" class="form-horizontal">';

$content .= '<div class="form-group">';
$content .= '<label class="col-sm-4 control-label" for="live_wp_test">WordPress Live Test</label>';

$content .= '<div class="col-sm-8">';
$content .= '<input type="text" id="live_wp_test" name="live_wp_test" required="true" class="form-control" placeholder="' . $path_live_test . '" value="' . $live_test . '" />';
$content .= '<p class="help-block">fill with <strong>root WordPress</strong>, if you do not want to lose your other job, please install a new WordPress.</p>';
$content .= '</div>';

$content .= '</div>';

$content .= '<div class="form-group">';
$content .= '<label class="col-sm-4 control-label" for="template_layout">Layout</label>';

$content .= '<div class="col-sm-5">';
$content .= '<select class="form-control" size="1" name="template_layout">';

$template_options = array(
    array('value' => 'container', 'label' => 'Container'),
    array('value' => 'container-fluid', 'label' => 'Fluid'),
    );

foreach ($template_options as $template_option)
{
    $selected = '';
    if (TEMPLATES_CONTAINER == $template_option['value'])
    {
        $selected = 'selected';
    }
    $content .= '<option value="' . $template_option['value'] . '" ' . $selected . '>' . $template_option['label'] . '</option>';
}


$content .= '</select>';
$content .= '</div>';
$content .= '</div>';


$content .= '<div class="form-group">';
$content .= '<label class="col-sm-4 control-label" for="max_postmeta">Max POSTMETA</label>';
$content .= '<div class="col-sm-4">';
$content .= '<input type="number" id="max_postmeta" name="max_postmeta" required="true" class="form-control" placeholder="5" value="' . $max_postmeta . '" />';
$content .= '</div>';
$content .= '</div>';

$content .= '<hr/>';




$content .= '<hr/>';
$content .= '<div class="form-group">';
$content .= '<div class="col-sm-8 col-sm-offset-4">';
$content .= '<button type="text" class="btn btn-primary" name="save"><span class="fa fa-floppy-o"></span> Save</button> ';
$content .= '</div>';
$content .= '</div>';


$content .= '</form>';
$content .= '</div>';
$content .= '</div>';

define('JZ_CONTENT', $content);
unset($content);

?>