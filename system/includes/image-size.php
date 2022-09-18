<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @package WordPress Plugin Maker
 * @license Commercial License
 */


defined('EXEC') or die();

if($_SESSION['current_project'] != null)
{
    $current_set = '';
    $current_properties = json_decode(file_get_contents(PROJECT_PATH.'/'.$_SESSION['current_project'].'.project.json'),true);
    if(!isset($_GET['act']))
    {
        $_GET['act'] = null;
    }

    if(!isset($_GET['max-image-size']))
    {
        $_GET['max-image-size'] = 1;
    }

    if($_GET['max-image-size'] == 0)
    {
        $_GET['max-image-size'] = 1;
    }

    if(isset($_POST['save']))
    { //check if project locked
        if($current_properties['lock'] == 'true')
        {
            header('Location: ./?page=project&err=locked_project');
            exit(0);
        }
        $links = $_POST['image-sizes'];
        file_put_contents(PROJECT_PATH.'/'.$_SESSION['current_project'].'.image_size.json',json_encode($links));
        rebuild();
        header('Location: ./?page=image-size&max-image-size='.(int)$_GET['max-image-size']);
    }
    if($_GET['act'] == 'reset')
    {
        @unlink(PROJECT_PATH.'/'.$_SESSION['current_project'].'.image_size.json');
        header('Location: ./?page=image-size&max-image-size='.(int)$_GET['max-image-size']);
    }

    $_content = null;

    $_content .= '<form action="" method="post" enctype="multipart/form-data" >';
    $_content .= '<div class="row">';

    if(file_exists(PROJECT_PATH.'/'.$_SESSION['current_project'].'.image_size.json'))
    {
        $current_image_sizes = json_decode(file_get_contents(PROJECT_PATH.'/'.$_SESSION['current_project'].'.image_size.json'),true);
        $current_set = '<span class="badge">'.count($current_image_sizes).'</span>';
        if(count($current_image_sizes) != $_GET['max-image-size'])
        {
            if(($_GET['act'] != 'max-image-size') && (count($current_image_sizes) != 0))
            {
                header('Location: ./?page=image-size&max-image-size='.count($current_image_sizes));
            }

        }
    }

    for($i = 1; $i <= (int)$_GET['max-image-size']; $i++)
    {
        $x = $i - 1;
        $image_size['name'] = '';
        $image_size['label'] = '';

        $image_size['width'] = '';
        $image_size['height'] = '';
        $image_size['crop'] = '1';

        if(isset($current_image_sizes[$x]))
        {
            if(isset($current_image_sizes[$x]['name']))
            {
                $image_size['name'] = $current_image_sizes[$x]['name'];
            }

            if(isset($current_image_sizes[$x]['label']))
            {
                $image_size['label'] = $current_image_sizes[$x]['label'];
            }

            if(isset($current_image_sizes[$x]['width']))
            {
                $image_size['width'] = $current_image_sizes[$x]['width'];
            }

            if(isset($current_image_sizes[$x]['height']))
            {
                $image_size['height'] = $current_image_sizes[$x]['height'];
            }

            $image_size['crop'] = false;
            if(isset($current_image_sizes[$x]['crop']))
            {
                if($current_image_sizes[$x]['crop'] == '1')
                {
                    $image_size['crop'] = true;
                }

            }
        }

        $_content .= '<div class="col-md-6" id="box-'.$x.'">';
        $_content .= '<div class="panel panel-default">';
        $_content .= '<div class="panel-heading"><h4 class="panel-title"><i class="fa fa-image"></i> Image Setting ('.$i.') <a class="remove btn btn-default btn-xs pull-right" href="#box-'.$x.'"><span class="fa fa-trash"></span> '.$image_size['name'].'</a></h4></div>';
        $_content .= '<div class="panel-body">';

        $_content .= '<div class="form-group"><label>Name</label><input data-type="var" placeholder="mythumbnail" class="form-control" type="text" name="image-sizes['.$x.'][name]" value="'.$image_size['name'].'" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Label</label><input placeholder="My Thumbnail" class="form-control" type="text" name="image-sizes['.$x.'][label]" value="'.$image_size['label'].'" required="required"/></div>';

        $_content .= '<div class="form-group"><label>Width</label><input placeholder="300" class="form-control" type="number" name="image-sizes['.$x.'][width]" value="'.$image_size['width'].'" required="required"/></div>';
        $_content .= '<div class="form-group"><label>Height</label><input placeholder="400" class="form-control" type="number" name="image-sizes['.$x.'][height]" value="'.$image_size['height'].'" /></div>';
        $_content .= '<div class="form-group">';
        $_content .= '<div class="checkbox">';
        if($image_size['crop'] == true)
        {
            $_content .= '<label><input type="checkbox" checked="checked" name="image-sizes['.$x.'][crop]" value="1"/>Crop</label>';
        } else
        {
            $_content .= '<label><input type="checkbox" name="image-sizes['.$x.'][crop]" value="1"/>Crop</label>';
        }
        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
        $_content .= '</div>';
    }


    $_content .= '</div>';
    $_content .= '<button type="submit" class="btn btn-primary" name="save">Save</button> ';
    $_content .= 'or <a href="./?page=image-size&act=reset">Remove</a> ';
    $_content .= '</form>';


    $content = null;
    $content .= '<a href="#help-box" data-toggle="collapse" class="label label-danger pull-right" >Help <span class="fa fa-question"></span></a>';
    $content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-image fa-stack-1x"></i></span> Image <strong>Size</strong>  '.$current_set.'</h2>';
    $content .= '<div id="help-box" class="panel-collapse collapse">';
    $content .= '<blockquote class="blockquote blockquote-danger">';
        $content .= '<h4>Help</h4>';
    $content .= '<p>This menu create a thumbnail support certain size and cropping behavior for the image size is dependent on the value<br/>Code Reference: <a target="_blank" href="https://developer.wordpress.org/reference/functions/add_image_size/">add_image_size</a></p>';
  
      $content .= '<div class="row">';
    $content .= '<div class="col-md-4"><a class="colorbox" href="./templates/images/image-size.png" title="Image Size"/><img class="img-thumbnail center-block" src="./templates/images/image-size.png" title="Image Size" /></a></div>';
    $content .= '</div>';
 
    $content .= '</blockquote>';

    $content .= '<hr/>';
    $content .= '</div>';

    $content .= '<div class="row">';
    $content .= '<div class="col-md-6">';
    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-body">';
    $content .= max_select('image-size');
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= $_content;
    define('JZ_CONTENT',$content);
    unset($content);
} else
{
    header('Location: ./?page=project&err=current_project');
}

?>