<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @package WordPress Plugin Maker
 * @license Commercial License
 */


if ($_SESSION['current_project'] != null)
{
    $content = null;
    $content .= '<h3><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-list-alt fa-stack-1x"></i></span>  Build Project</h3>';


    $content .= '<ul class="nav nav-tabs">';
    $content .= '<li><a href="./?page=code-creator">Build Project</a></li>';
    $content .= '<li class="active"><a data-toggle="tab" >Code View</a></li>';
    $content .= '</ul>';
    $content .= '<h4>List of code that has been generate</h4>';
    $content .= '<div id="treefiles" class="col-md-4">';
    foreach ($_SESSION['OUTPUT_FILE'] as $file)
    {
        $new_files[$file] = $file;
    }
    function explodeTree($array, $delimiter = '_', $baseval = false)
    {
        if (!is_array($array))
            return false;
        $splitRE = '/' . preg_quote($delimiter, '/') . '/';
        $returnArr = array();
        foreach ($array as $key => $val)
        {
            // Get parent parts and the current leaf
            $parts = preg_split($splitRE, $key, -1, PREG_SPLIT_NO_EMPTY);
            $leafPart = array_pop($parts);

            // Build parent structure
            // Might be slow for really deep and large structures
            $parentArr = &$returnArr;
            foreach ($parts as $part)
            {
                if (!isset($parentArr[$part]))
                {
                    $parentArr[$part] = array();
                } elseif (!is_array($parentArr[$part]))
                {
                    if ($baseval)
                    {
                        $parentArr[$part] = array('__base_val' => $parentArr[$part]);
                    } else
                    {
                        $parentArr[$part] = array();
                    }
                }
                $parentArr = &$parentArr[$part];
            }

            // Add the final part to the structure
            if (empty($parentArr[$leafPart]))
            {
                $parentArr[$leafPart] = $val;
            } elseif ($baseval && is_array($parentArr[$leafPart]))
            {
                $parentArr[$leafPart]['__base_val'] = $val;
            }
        }
        return $returnArr;
    }

    $tree = explodeTree($new_files, "/", true);


    function plotTree($arr, $indent = 0, $mother_run = true)
    {
        global $content;
        if ($mother_run)
        {
            // the beginning of plotTree. We're at rootlevel
            $content .= "<ul>\n";
        }

        foreach ($arr as $k => $v)
        {
            // skip the baseval thingy. Not a real node.
            if ($k == "__base_val")
                continue;
            // determine the real value of this node.
            $show_val = (is_array($v) ? @$v["__base_val"] : $v);
            // show the indents
            $content .= str_repeat("  ", $indent);

            $ext = pathinfo($show_val, PATHINFO_EXTENSION);
            $hash = sha1(md5($show_val));

            if ($indent == 0)
            {
                // this is a root node. no parents
                $content .= "<li data-file='" . $hash . "' data-ext='" . $ext . "' data-jstree='{\"icon\":\"file file-" . $ext . "\"}'>";
            } elseif (is_array($v))
            {
                // this is a normal node. parents and children
                $content .= "<li data-jstree='{\"icon\":\"folder\"}' data-jstree='{\"opened\":true}' >";
            } else
            {
                // this is a leaf node. no children
                $content .= "<li data-file='" . $hash . "' data-ext='" . $ext . "' data-jstree='{\"icon\":\"file file-" . $ext . "\"}'>";
            }

            // show the actual node
            $content .= $k; // <!--(" . $show_val . ")-->
            if (is_array($v))
            {
                // this is what makes it recursive, rerun for childs
                $content .= "<ul>\n";
                plotTree($v, ($indent + 1), false);
                $content .= "</ul>\n";
            }
            $content .= '</li>';
        }

        if ($mother_run)
        {
            $content .= "</ul>\n";
        }
    }


    plotTree($tree);

    $content .= '</div>';

    $content .= '<div class="col-md-8">';
    $content .= '<textarea id="code-edit" style="width: 100%;height:600px;"></textarea>';
    $content .= '</div>';

    define('JZ_CONTENT', $content);
    define('JZ_FULL_PAGE', true);
} else
{
    header('Location: ./?page=project');
}
