<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @package WordPress Plugin Maker
 * @license Commercial License
 */

defined("EXEC") or die();


//detect current project
if ($_SESSION['current_project'] != null)
{


    $content .= '<div id="icons">';

    $content .= '<div class="panel panel-default">';
    $content .= '<div class="panel-body">';
    $content .= '<div class="row">';
    $content .= '<div class="col-xs-3"><input id="filter-icon" type="text" class="form-control" placeholder="Enter keyword" /></div>';
    $content .= '<div class="col-xs-7">HTML:<br/><code id="code-icon">&nbsp;</code></div>';
    $content .= '<div class="col-xs-2">Preview:<br/><span id="preview-icon"></span></div>';
    $content .= '</div><!-- .//row -->';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '<div class="row">';
    $content .= '<div class="col-md-12">';
    $content .= '<div id="list-icon">';
    $dashicons = json_decode(file_get_contents(SYSTEM_PATH . '/data/dashicons.json'), true);
    foreach ($dashicons as $dashicon)
    {
        $content .= '<a href="#" class="insert-icon" data-icon="dashicons-' . $dashicon['class'] . '" data-class="dashicons dashicons-' . $dashicon['class'] . '"><span class="dashicons dashicons-' . $dashicon['class'] . '"></span></a>';
    }
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div><!-- .//row -->';

    $content .= '</div>';

    if (!isset($_GET['modal']))
    {
        $html_content = null;
        $html_content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-flag fa-stack-1x"></i></span><strong>Dashicons</strong></h2>';
        $html_content .= $content;
        define('JZ_CONTENT', $html_content);
        unset($html_content);
    }
    else
    {
        if ($_GET['modal'] == 'true')
        {
            $html_content = null;
            $html_content .= '<html>';
            $html_content .= '<head>';
            $html_content .= '<meta charset="utf-8"/>';
            $html_content .= '<link href="./templates/css/font-awesome.min.css" rel="stylesheet" type="text/css" />';
            $html_content .= '<link href="./templates/css/bootstrap.min.css" rel="stylesheet" type="text/css" />';
            $html_content .= '<link href="./templates/css/dashicons.min.css" rel="stylesheet" type="text/css" />';
            $html_content .= '<style type="text/css">';
            $html_content .= '#icons a.insert-icon:link,#icons a.insert-icon:visited,#icons a.insert-icon{background:#fafafa;color:#5BC0DE;position:relative;box-sizing:content-box;padding:10px;line-height:1;cursor:pointer;text-align:center;vertical-align:top;display:inline-block;width:40px;height:40px;margin:2px;}';
            $html_content .= '#icons a.insert-icon:hover{background:#ddd;}';
            $html_content .= '#icons .insert-icon span{position:relative;box-sizing:content-box;overflow:hidden;white-space:nowrap;font-size:40px;line-height:1;cursor:pointer;font-style:normal;text-align:center;vertical-align:top;font-weight:400;text-decoration:inherit;width:40px;height:40px;}';
            $html_content .= '#icons .insert-icon::before{margin-right:40px;}';
            $html_content .= '#list-icon{width:100%;overflow-y:scroll;height:380px;border:1px solid #fefefe;}';
            $html_content .= '</style>';
            $html_content .= '</head>';
            $html_content .= '<body>';

            $html_content .= '<div class="container-fluid">';
            $html_content .= '<div class="modal-body">';
            $html_content .= $content;
            $html_content .= '</div>';
            $html_content .= '<div class="modal-footer">';
            $html_content .= '<button type="button" class="window-close btn btn-default" >Close</button>';
            $html_content .= '<button type="button" class="send-icon btn btn-primary">Insert icon</button>';
            $html_content .= '</div>';
            $html_content .= '</div>';

            $html_content .= '<script src="./templates/js/jquery.min.js"></script>';
            $html_content .= '
<script type="text/javascript">
 $(document).ready(function() {
    
	$("#filter-icon").keyup(function() {
		var keyword = $(this).val();
		$(".insert-icon").each(function() {
			var find_icon = $(this).attr("href");
			find_icon = find_icon.substr(1, (find_icon.length - 1));
			$(this).addClass("hidden");
			if (find_icon.toLowerCase().indexOf(keyword) >= 0) {
				$(this).removeClass("hidden");
			}
		});
	});
    
	$(".insert-icon").click(function() {
		var value_icon = $(this).attr("data-icon");
		var class_icon = $(this).attr("data-class");
		$("#preview-icon").attr("class", null);
		$("#preview-icon").addClass(class_icon);
		$("#code-icon").html(\'&lt;i class="\' + class_icon + \'"&gt;&lt;/i&gt;\');
        $("#filter-icon").val(value_icon);
        //console.log(window.opener.jzOpener);        
	});
    
    $(".send-icon").click(function(){
        var value_icon = $("#filter-icon").val();
  		if (window.opener.jzOpener) {
			window.opener.jzOpener.callback(value_icon);
            window.close();
		}        
    });
    
    $(".window-close").click(function(){
        window.close();
    });
    
});
</script>
            ';
            $html_content .= '</body>';
            $html_content .= '</html>';
            die($html_content);
        }
        else
        {
            $html_content = null;
            $html_content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-flag fa-stack-1x"></i></span><strong>Dashicons</strong></h2>';
            $html_content .= $content;
            define('JZ_CONTENT', $html_content);
            unset($html_content);
        }
    }

}
else
{
    //redirect if project not set
    header('Location: ./?page=project&err=current_project');
}
