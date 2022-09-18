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

    if (!isset($_GET['max-style']))
    {
        $_GET['max-style'] = 1;
    }

    if ($_GET['max-style'] == 0)
    {
        $_GET['max-style'] = 1;
    }

    if (isset($_POST['save']))
    {
        //check if project locked
        if ($current_properties['lock'] == 'true')
        {
            header('Location: ./?page=project&err=locked_project');
            exit(0);
        }
        $links = $_POST['styles'];
        file_put_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.style.json', json_encode($links));
        rebuild();
        header('Location: ./?page=style&max-style=' . (int)$_GET['max-style']);
    }
    if ($_GET['act'] == 'reset')
    {
        @unlink(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.style.json');
        header('Location: ./?page=style&max-style=' . (int)$_GET['max-style']);
    }

    $_content = null;

    $_content .= '<form action="" method="post" enctype="multipart/form-data" >';
    $_content .= '<div class="row">';

    if (file_exists(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.style.json'))
    {
        $current_styles = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.style.json'), true);
        $current_set = '<span class="badge">' . count($current_styles) . '</span>';
        if (count($current_styles) != $_GET['max-style'])
        {
            if (($_GET['act'] != 'max-style') && (count($current_styles) != 0))
            {
                header('Location: ./?page=style&max-style=' . count($current_styles));
            }

        }
    }

    for ($i = 1; $i <= (int)$_GET['max-style']; $i++)
    {
        $x = $i - 1;
        $style['name'] = '';
        $style['src'] = '';
        $style['admin'] = true;
        $style['version'] = '';

        if (isset($current_styles[$x]))
        {
            if (isset($current_styles[$x]['name']))
            {
                $style['name'] = $current_styles[$x]['name'];
            }

            if (isset($current_styles[$x]['src']))
            {
                $style['src'] = $current_styles[$x]['src'];
            }
            if (isset($current_styles[$x]['version']))
            {
                $style['version'] = $current_styles[$x]['version'];
            }
            if (isset($current_styles[$x]['admin']))
            {
                $style['admin'] = true;
            } else
            {
                $style['admin'] = false;
            }

            if (isset($current_styles[$x]['hooks']))
            {
                $style['hooks'] = $current_styles[$x]['hooks'];
            } else
            {
                $style['hooks'] = array();
            }

        }

        $_content .= '<div class="col-md-12" id="box-' . $x . '">';
        $_content .= '<div class="panel panel-default">';
        $_content .= '<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-jsfiddle"></i> CSS (' . $i . ') <a class="remove btn btn-default btn-xs pull-right" href="#box-' . $x . '"><span class="fa fa-trash"></span> ' . $style['name'] . '</a></h4></div>';
        $_content .= '<div class="panel-body">';
        $_content .= '<div class="form-group"><label>ID</label><input data-type="var" placeholder="bootstrap" class="form-control" type="text" name="styles[' . $x . '][name]" value="' . $style['name'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Source</label><input placeholder="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" class="form-control" type="text" name="styles[' . $x . '][src]" value="' . $style['src'] . '" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Version</label><input placeholder="3.3.5" class="form-control" type="number" name="styles[' . $x . '][version]" value="' . $style['version'] . '" /></div>';
        $_content .= '<div class="form-group">';
        $_content .= '<div class="checkbox">';
        if ($style['admin'] == true)
        {
            $_content .= '<label><input type="checkbox" checked="checked" name="styles[' . $x . '][admin]" value="1"/>Admin Area</label>';
        } else
        {
            $_content .= '<label><input type="checkbox" name="styles[' . $x . '][admin]" value="1"/>Admin Area</label>';
        }
        $_content .= '</div>';
        $_content .= '</div>';

        # hooks
        $_content .= '<div class="form-group">';
        $_content .= '<label>Hooks (Limit page)</label>';
        $_content .= '<div class="row">';
        for ($z = 0; $z < 6; $z++)
        {
            if (!isset($style['hooks'][$z]))
            {
                $style['hooks'][$z] = '';
            }
            $_content .= '
            <div class="col-md-4">
                <div class="form-group">
                    <input class="form-control input-sm" type="text" name="styles[' . $x . '][hooks][' . $z . ']" value="' . $style['hooks'][$z] . '" placeholder="fill blank if no need"  />
                </div>
            </div>';

        }
        $_content .= '</div>';
        $_content .= '</div>';
        # ./hooks
        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
    }


    $_content .= '</div>';
    $_content .= '<button type="submit" class="btn btn-primary" name="save">Save</button> ';
    $_content .= 'or <a href="./?page=style&act=reset">Remove</a> ';
    $_content .= '</form>';


    $content = null;
    $content .= '<a href="#help-box" data-toggle="collapse" class="label label-danger pull-right" ><span class="fa fa-question"></span></a>';
    $content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-css3 fa-stack-1x"></i></span> External <strong>Style</strong>  ' . $current_set . '</h2>';
    $content .= '<div id="help-box" class="panel-collapse collapse">';
    $content .= '<blockquote><p>Enqueue a CSS stylesheet.</p></blockquote>';
    $content .= '<hr/>';
    $content .= '</div>';

    $content .= '<div class="row">';
    $content .= '<div class="col-md-6">';
    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-body">';
    $content .= max_select('style');
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