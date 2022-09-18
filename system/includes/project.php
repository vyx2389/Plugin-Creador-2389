<?php

/**
 * @author Jasman
 * @copyright Ihsana IT Solution 2015
 * @package WordPress Plugin Maker
 * @license Commercial License
 */


defined('EXEC') or die();


if (!isset($_GET['id']))
{
    $_GET['id'] = $_SESSION['current_project'];
}

if (!isset($_GET['act']))
{
    $_GET['act'] = null;
}
if (!isset($_GET['sub']))
{
    $_GET['sub'] = null;
}

switch ($_GET['act'])
{
    case 'reset':
        $_SESSION['current_project'] = null;
        header('Location: ./?page=project&sub=new-project');
        break;

    case 'new':
        $_SESSION['current_project'] = null;
        header('Location: ./?page=project&sub=new-project');
        break;
    case 'active':
        $_SESSION['current_project'] = $_GET['id'];
        header('Location: ./?page=project&sub=project-manager');
        break;
    case 'pending':
        $_SESSION['current_project'] = null;
        header('Location: ./?page=project&sub=project-manager');
        break;

    case 'lock':
        $project_id = $_GET['id'];
        $project_file = PROJECT_PATH . '/' . $project_id . '.project.json';

        if (file_exists($project_file))
        {
            $new_properties = json_decode(file_get_contents($project_file), true);
            $new_properties['lock'] = 'true';
            file_put_contents($project_file, json_encode($new_properties));
        }
        header('Location: ./?page=project&sub=lock-project');
        break;

    case 'unlock':
        $project_id = $_GET['id'];
        $project_file = PROJECT_PATH . '/' . $project_id . '.project.json';

        if (file_exists($project_file))
        {
            $new_properties = json_decode(file_get_contents($project_file), true);
            $new_properties['lock'] = 'false';

            file_put_contents($project_file, json_encode($new_properties));
        }
        header('Location: ./?page=project&sub=unlock-project');
        break;
    case 'backup':
        $project_id = $_GET['id'];
        $project_file = PROJECT_PATH . '/' . $project_id . '.*.json';
        $zipDir = PROJECT_PATH . '/backups/';
        $zipFile = $zipDir . $project_id . '.' . time() . '.zip';

        @mkdir($zipDir, 0777, true);
        @unlink($zipFile);

        $zip = new ZipArchive();
        if ($zip->open($zipFile, ZIPARCHIVE::CREATE) !== true)
        {
            exit("There was an error, because it is not able to create a zip file (" . $filename . ")");
        }


        foreach (glob($project_file) as $filename)
        {
            $zip->addFile($filename, basename($filename));
        }
        $zip->close();
        header('Location: ./?page=project&sub=backup-project&err=backup_done');
        break;
    case 'restore':
        $project_backup = basename($_GET['file']);

        $zipDir = PROJECT_PATH . '/backups/';
        $zipFile = $zipDir . '/' . $project_backup;

        $zip = new ZipArchive();
        if ($zip->open($zipFile, ZIPARCHIVE::CREATE) == true)
        {
            $zip->extractTo(PROJECT_PATH . '/');
            $zip->close();
        }


        header('Location: ./?page=project&sub=backup-project&err=restore_done');
        break;
    case 'trash_backup':
        $project_backup = basename($_GET['file']);

        $zipDir = PROJECT_PATH . '/backups/';
        $zipFile = $zipDir . '/' . $project_backup;
        @unlink($zipFile);
        header('Location: ./?page=project&sub=backup-project&err=trash_done');
        break;
    case 'delete':
        $_SESSION['current_project'] = null;
        $project_id = $_GET['id'];
        $project_file = PROJECT_PATH . '/' . $project_id . '.*.json';
        foreach (glob($project_file) as $filename)
        {
            @unlink($filename);
        }
        header('Location: ./?page=project&sub=project-manager&err=delete_done');
        break;

    case 'import-project':
        if (isset($_FILES["file-restore"]['tmp_name']))
        {
            $zipFile = $_FILES["file-restore"]["tmp_name"];

            $zip = new ZipArchive();
            if ($zip->open($zipFile, ZIPARCHIVE::CREATE) == true)
            {
                $zip->extractTo(PROJECT_PATH . '/');
                $zip->close();
                header('Location: ./?page=project&sub=project-manager&err=restore_done');
            }
        }
        break;
}


if ($_SESSION['current_project'] != null)
{
    $current_properties = json_decode(file_get_contents(PROJECT_PATH . '/' . $_SESSION['current_project'] . '.project.json'), true);
} else
{
    $current_properties['Plugin_Name'] = null;
    $current_properties['Plugin_URI'] = null;
    $current_properties['Description'] = null;
    $current_properties['Version'] = null;
    $current_properties['Author'] = null;
    $current_properties['Author_URI'] = null;
    $current_properties['Tags'] = null;
    $current_properties['Requires_at_least'] = null;
    $current_properties['Tested_up_to'] = null;
    $current_properties['Stable_tag'] = null;
    $current_properties['License'] = null;
    $current_properties['License_URI'] = null;
    $current_properties['Plugin_ShortName'] = null;
    $current_properties['textdomain'] = null;
}


if (isset($_POST['project']))
{
    if (!isset($_POST['textdomain']))
    {
        $_POST['textdomain'] = 'false';
    } else
    {
        $_POST['textdomain'] = 'true';
    }
    $project['Plugin_Name'] = $_POST['Plugin_Name'];
    $project['Plugin_URI'] = $_POST['Plugin_URI'];
    $project['Description'] = $_POST['Description'];
    $project['Version'] = $_POST['Version'];
    $project['Author'] = $_POST['Author'];
    $project['Author_URI'] = $_POST['Author_URI'];
    $project['Tags'] = $_POST['Tags'];
    $project['Requires_at_least'] = $_POST['Requires_at_least'];
    $project['Tested_up_to'] = $_POST['Tested_up_to'];
    $project['Stable_tag'] = $_POST['Stable_tag'];
    $project['License'] = $_POST['License'];
    $project['License_URI'] = $_POST['License_URI'];
    $project['Plugin_ShortName'] = $_POST['Plugin_ShortName'];
    
    $project['textdomain'] = $_POST['textdomain'];
    $project['debug'] = $_POST['debug'];
    
    $project['lock'] = 'false';
    file_put_contents(PROJECT_PATH . '/' . sha1($project['Plugin_Name']) . '.project.json', json_encode($project));
    header('Location: ./?page=project&sub=project-manager');
}

$project_table = null;

$project_table .= '<h3>Projects</h3>';
$project_table .= '<div class="panel panel-default">';
$project_table .= '<div class="panel-body">';
$project_table .= '<div class="table-responsive">';
$project_table .= '<table class="table table-striped">';
$project_table .= '
<tr><th>Project Name</th>
<th>Author</th>
<th>Status</th>
<th>Lock</th>
<th>Delete</th>
</tr>';

foreach (glob(PROJECT_PATH . "/*.project.json") as $filename)
{
    $real_file = str_replace(".project", '', pathinfo($filename, PATHINFO_FILENAME));
    $project_properties = json_decode(file_get_contents($filename), true);

    /**
     * Change to Active Project
     */

    if ($_SESSION['current_project'] == $real_file)
    {
        $status_project = '
  <div class="btn-group btn-group-xs">
    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
      Active
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="./?page=project&id=' . $real_file . '&act=pending"><span class="fa fa-exchange"></span> Pending</a></li>
    </ul>
  </div>
        ';
    } else
    {
        $status_project = '
  <div class="btn-group btn-group-xs">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
      Pending
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="./?page=project&id=' . $real_file . '&act=active"><span class="fa fa-exchange"></span> Active</a></li>
    </ul>
  </div>
  ';

    }

    /**
     * Change to Lock/Unlock
     */
    if ($project_properties['lock'] == 'true')
    {
        $lock_project = '
    <div class="btn-group btn-group-xs">
    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
      <span class="fa fa-lock"></span> Lock
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="./?page=project&id=' . $real_file . '&act=unlock"><span class="fa fa-exchange"></span> Unlock</a></li>
    </ul>
  </div>
  ';
    } else
    {
        $lock_project = '
  <div class="btn-group btn-group-xs">
    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
      <span class="fa fa-lock"></span> Unlock
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="./?page=project&id=' . $real_file . '&act=lock"><span class="fa fa-exchange"></span> Lock</a></li>
    </ul>
  </div>
        
        ';
    }

    $delete_project = '<a href="./?page=project&id=' . $real_file . '&sub=project-manager&err=modal_delete" class="btn btn-xs btn-danger"><span class="fa fa-trash"></span> Delete</a>';

    $project_table .= '
    <tr>
        <td>' . $project_properties['Plugin_Name'] . '</td>
        <td>' . $project_properties['Author'] . '</td>
        <td>' . $status_project . '</td>
        <td>' . $lock_project . '</td>       
        <td>' . $delete_project . '</td> 
    </tr>
    ';
}
$project_table .= '</table>';
$project_table .= '<a href="./?page=project&act=reset" class="btn btn-danger">Reset Session</a>';
$project_table .= '</div>';
$project_table .= '</div>';
$project_table .= '</div>';

$backup_project = null;
$backup_project .= '<h3>Backup and Restore</h3>';
$backup_project .= '<div class="panel panel-default">';
$backup_project .= '<div class="panel-body">';
$backup_project .= '<div class="table-responsive">';
$backup_project .= '<table class="table table-striped">';
$backup_project .= '
<tr>
<th>Date</th>
<th></th>
<th></th>
<th></th>
</tr>';


foreach (glob(PROJECT_PATH . "/backups/" . $_SESSION['current_project'] . ".*.zip") as $filename)
{
    if (file_exists($filename))
    {
        $date_modified = date("m-d-Y H:i:s", filemtime($filename));

        $backup_time = $date_modified;


        $backup_file = '<a href="./project/backups/' . basename($filename) . '" class="btn btn-xs btn-success">Download</a>';
        $restore_file = '<a href="./?page=project&amp;sub=backup-project&amp;err=restore_dialog&amp;file=' . basename($filename) . '" class="btn btn-xs btn-warning">Restore</a>';
        $delete_file = '<a href="./?page=project&amp;sub=backup-project&amp;err=trash_dialog&amp;file=' . basename($filename) . '" class="btn btn-xs btn-danger">Delete</a>';

        $backup_project .= '
    <tr>
        <td>' . $backup_time . '</td> 
        <td>' . $backup_file . '</td> 
        <td>' . $restore_file . '</td> 
        <td>' . $delete_file . '</td>           
    </tr>
    ';

    }
}
$backup_project .= '</table>';
$backup_project .= '</div>';

$backup_project .= '<div>';
$backup_project .= '
<form method="post" enctype="multipart/form-data" class="form-inline" role="form" action="?page=project&act=import-project" >
<div class="form-group">
<label class="sr-only" for="file-restore">Upload File Backup</label>
<input name="file-restore" id="file-restore" type="file" class="form-control" />
</div>
<input type="submit" name="upload" class="btn btn-danger" value="Import Project"/>
</form>';
$backup_project .= '</div>';

$backup_project .= '</div>';
$backup_project .= '</div>';


$read_only = 'readonly="readonly"';
if ($_GET['sub'] == 'new-project')
{
    $read_only = '';
}
$project_properties = null;
$project_properties .= '<h3>Properties <a class="btn-sm btn btn-warning" href="./?page=project&act=new">New</a></h3>';
$project_properties .= '<div class="panel panel-default">';
$project_properties .= '<div class="panel-body">';
$project_properties .= '<form action="" method="post" enctype="multipart/form-data" role="form" class="form-horizontal" >';
$project_properties .= '';
$project_properties .= '<div class="form-group">';
$project_properties .= '<label class="col-sm-2 control-label" for="Plugin_Name">Plugin Name</label>';
$project_properties .= '<div class="col-sm-7">';
$project_properties .= '<input ' . $read_only . ' type="text" minlength="4" maxlength="120" id="Plugin_Name" name="Plugin_Name" class="form-control" required="true" value="' . $current_properties['Plugin_Name'] . '" />';
$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '<div class="form-group">';
$project_properties .= '<label class="col-sm-2 control-label" for="Plugin_ShortName">Short Name</label>';
$project_properties .= '<div class="col-sm-7">';
$project_properties .= '<input type="text" minlength="2" maxlength="3" id="Plugin_ShortName" name="Plugin_ShortName" class="form-control" required="true" value="' . $current_properties['Plugin_ShortName'] . '" />';
$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '<div class="form-group">';
$project_properties .= '<label class="col-sm-2 control-label" for="Plugin_URI">Plugin URL</label>';
$project_properties .= '<div class="col-sm-8">';
$project_properties .= '<input type="url" id="Plugin_URI" name="Plugin_URI" class="form-control" required="true" placeholder="http://ihsana.com/wp/plugin/" value="' . $current_properties['Plugin_URI'] . '" />';
$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '';
$project_properties .= '<div class="form-group">';
$project_properties .= '<label class="col-sm-2 control-label" for="Description">Description</label>';
$project_properties .= '<div class="col-sm-10">';
$project_properties .= '<textarea id="Description" name="Description" class="form-control" required="true">' . $current_properties['Description'] . '</textarea>';
$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '<div class="form-group">';
$project_properties .= '<label class="col-sm-2 control-label" for="Tags">Tags</label>';
$project_properties .= '<div class="col-sm-10">';
$project_properties .= '<input type="text" id="Tags" name="Tags" required="true" class="form-control" placeholder="slider" value="' . $current_properties['Tags'] . '" />';
$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '';
$project_properties .= '<div class="form-group"> ';
$project_properties .= '<label class="col-sm-2 control-label" for="Version">Version</label>';
$project_properties .= '<div class="col-sm-3">';
$project_properties .= '<input type="number" id="Version" name="Version" required="true" class="form-control" placeholder="1.0" value="' . $current_properties['Version'] . '" />';
$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '';
$project_properties .= '<div class="form-group">';
$project_properties .= '<label class="col-sm-2 control-label">Requires</label>';
$project_properties .= '<div class="col-sm-10">';
$project_properties .= '';
$project_properties .= '<label class="col-sm-2 control-label" for="Requires_at_least">At least</label>';
$project_properties .= '<div class="col-sm-2">';
$project_properties .= '<input type="number" id="Requires_at_least" name="Requires_at_least" required="true" class="form-control" placeholder="3.4" value="' . $current_properties['Requires_at_least'] . '" />';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '<label class="col-sm-2 control-label" for="Tested_up_to">Up to</label>';
$project_properties .= '<div class="col-sm-2">';
$project_properties .= '<input type="number" id="Tested_up_to" name="Tested_up_to" required="true" class="form-control" placeholder="3.6" value="' . $current_properties['Tested_up_to'] . '" />';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '<label class="col-sm-2 control-label" for="Stable_tag">Stable tag</label>';
$project_properties .= '<div class="col-sm-2">';
$project_properties .= '<input type="number" id="Stable_tag" name="Stable_tag" required="true" class="form-control" placeholder="3.6" value="' . $current_properties['Stable_tag'] . '" />';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '<div class="form-group">';
$project_properties .= '<div class="col-sm-8 col-sm-offset-2">';
$project_properties .= '<div class="checkbox">';
$project_properties .= '<label>';
if ($current_properties['textdomain'] == 'true')
{
    $project_properties .= '<input type="checkbox" name="textdomain" value="true" checked="checked"/> Localization ';
} else
{
    $project_properties .= '<input type="checkbox" name="textdomain" value="true" /> Localization ';
}
$project_properties .= '</label>';
$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '<hr />';
$project_properties .= '';
$project_properties .= '<div class="form-group">';
$project_properties .= '<label class="col-sm-2 control-label" for="Author">Author</label>';
$project_properties .= '<div class="col-sm-7">';
$project_properties .= '<input type="text" id="Author" minlength="4" maxlength="120" name="Author" required="true" class="form-control" placeholder="JasmanXcrew" value="' . $current_properties['Author'] . '" />';
$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '<div class="form-group">';
$project_properties .= '<label class="col-sm-2 control-label" for="Author_URI">Author URL</label>';
$project_properties .= '<div class="col-sm-8">';
$project_properties .= '<input type="url" id="Author_URI" name="Author_URI" required="true" class="form-control" placeholder="http://facebook.com/jasman.z" value="' . $current_properties['Author_URI'] . '" />';
$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '<div class="form-group">';
$project_properties .= '<label class="col-sm-2 control-label" for="License">License</label>';
$project_properties .= '<div class="col-sm-8">';
$project_properties .= '<input type="text" minlength="4" maxlength="360" id="License" name="License" required="true" class="form-control" placeholder="GNU General Public License v2 or later" value="' . $current_properties['License'] . '" />';
$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '';
$project_properties .= '<div class="form-group">';
$project_properties .= '<label class="col-sm-2 control-label" for="License_URI">License URL</label>';
$project_properties .= '<div class="col-sm-8">';
$project_properties .= '<input type="url" id="License_URI" name="License_URI" required="true" class="form-control" placeholder="http://www.gnu.org/licenses/gpl-2.0.html" value="' . $current_properties['License_URI'] . '"/>';
$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '';
$project_properties .= '';

$project_properties .= '<hr/>';
$project_properties .= '<div class="form-group">';
$project_properties .= '<label class="col-sm-2 control-label" for="debug">Debugger</label>';
$project_properties .= '<div class="col-sm-8">';
$project_properties .= '<div class="checkbox">';
$project_properties .= '<label>';
if ($current_properties['debug'] == 'true')
{
    $project_properties .= '<input type="checkbox" name="debug" value="true" checked="checked"/> Displays files and lines of code ';
} else
{
    $project_properties .= '<input type="checkbox" name="debug" value="true" /> Displays files and lines of code ';
}
$project_properties .= '</label>';
$project_properties .= '<p class="help-block">Unchecked for distribution</p>';

$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '</div>';


$project_properties .= '<input type="hidden" name="lock" value="false" />';
$project_properties .= '<hr />';
$project_properties .= '';
$project_properties .= '<div class="form-group">';
$project_properties .= '<div class="col-sm-8 col-sm-offset-2">';
$project_properties .= '<button type="submit" class="btn btn-primary" name="project"><span class="fa fa-floppy-o"></span> Save</button> ';
$project_properties .= '</div>';
$project_properties .= '</div>';
$project_properties .= '</form>';
$project_properties .= '</div> ';
$project_properties .= '</div>';


$content = null;
//$content .= '<img class="pull-right img-thumbnail" src="./templates/images/project.png" width="300" height="100" />';
$content .= '<h2><span class="fa-stack fa-lg"><i class="fa fa-square-o fa-stack-2x"></i><i class="fa fa-star fa-stack-1x"></i></span><strong>Projects</strong> Manager</h2>';


if (!isset($_GET['sub']))
{
    $_GET['sub'] = 'project-manager';
}

switch ($_GET['sub'])
{
    case 'new-project':
        $content .= '<ul class="nav nav-tabs">';
        $content .= '<li><a href="#projects" data-toggle="tab" >Existing Projects</a></li>';
        $content .= '<li class="active"><a href="#properties" data-toggle="tab">Properties</a></li>';
        $content .= '</ul>';

        $content .= '<div class="tab-content">';
        $content .= '<div class="tab-pane fade"  id="projects">';
        $content .= '<br/>';
        $content .= $project_table;
        $content .= '</div>';
        $content .= '<div class="tab-pane fade in active" id="properties">';
        $content .= '<br/>';
        $content .= $project_properties;
        $content .= '</div>';
        $content .= '</div>';


        break;
    case 'project-manager':
        $content .= '<ul class="nav nav-tabs">';
        $content .= '<li class="active"><a href="#projects" data-toggle="tab" >Existing Projects</a></li>';
        $content .= '<li><a href="#properties" data-toggle="tab">Properties</a></li>';
        $content .= '<li><a href="#backup" data-toggle="tab" >Backup</a></li>';
        $content .= '</ul>';

        $content .= '<div class="tab-content">';
        $content .= '<div class="tab-pane fade in active"  id="projects">';
        $content .= '<br/>';

        if (isset($_GET['err']))
        {

            switch ($_GET['err'])
            {
                case 'delete_done':
                    $content .= '<div class="alert alert-success" ><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><strong>Well done!</strong> You successfully delete the project</p></div>';
                    break;
                case 'current_project':

                    $content .= '
<div id="modal_dialog" class="modal fade alert-modal-sm" tabindex="-1" role="dialog" aria-labelledby="Error!" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Oh snap! You got an error!</h4>
      </div>
        <div class="modal-body">
            <p>Please create a new project and then turned on, or activated already existing project.</p>
            ' . $project_table . '
        </div>
   </div>
  </div>
</div>
';
                    break;

                case 'locked_project':

                    $content .= '
<div id="modal_dialog" class="modal fade alert-modal-sm" tabindex="-1" role="dialog" aria-labelledby="Error!" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Oh snap! You got an error!</h4>
      </div>
        <div class="modal-body">
            <p>This project is locked, please unlock before.</p>
            ' . $project_table . '
        </div>
   </div>
  </div>
</div>
';
                    break;

                case 'modal_delete':
                    $content .= '
<div id="modal_dialog" class="modal fade alert-modal-sm" tabindex="-1" role="dialog" aria-labelledby="Error!" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Confirmation!</h4>
      </div>
        <div class="modal-body">
             Are you sure you want to delete this project?<br/>
             It must be remembered, a project that has been deleted can not be restored.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a href="./?page=project&act=delete&id=' . $_GET['id'] . '"  class="btn btn-primary">Yes, I agree</a>
      </div>
   </div>
  </div>
</div>
';
                    break;

            }

        }
        $content .= $project_table;
        $content .= '</div>';
        $content .= '<div class="tab-pane fade" id="properties">';
        $content .= '<br/>';
        $content .= $project_properties;
        $content .= '</div>';
        $content .= '<div class="tab-pane" id="backup">';
        $content .= '<br/>';
        $content .= $backup_project;
        $content .= '</div>';
        $content .= '</div>';

        break;
    case 'project-properties':
        $content .= '<ul class="nav nav-tabs">';
        $content .= '<li><a href="#projects" data-toggle="tab" >Existing Projects</a></li>';
        $content .= '<li class="active"><a href="#properties" data-toggle="tab">Properties</a></li>';
        $content .= '<li><a href="#backup" data-toggle="tab" >Backup</a></li>';
        $content .= '</ul>';

        $content .= '<div class="tab-content">';
        $content .= '<div class="tab-pane fade"  id="projects">';
        $content .= '<br/>';

        $content .= $project_table;
        $content .= '</div>';
        $content .= '<div class="tab-pane fade in active" id="properties">';
        $content .= '<br/>';
        $content .= $project_properties;
        $content .= '</div>';
        $content .= '<div class="tab-pane fade" id="backup">';
        $content .= '<br/>';
        $content .= $backup_project;
        $content .= '</div>';
        $content .= '</div>';
        break;
    case 'backup-project':
        $content .= '<ul class="nav nav-tabs">';
        $content .= '<li><a href="#projects" data-toggle="tab" >Existing Projects</a></li>';
        $content .= '<li><a href="#properties" data-toggle="tab">Properties</a></li>';
        $content .= '<li class="active"><a href="#backup" data-toggle="tab" >Backup</a></li>';
        $content .= '</ul>';

        $content .= '<div class="tab-content">';
        $content .= '<div class="tab-pane fade"  id="projects">';
        $content .= '<br/>';
        $content .= $project_table;
        $content .= '</div>';
        $content .= '<div class="tab-pane fade" id="properties">';
        $content .= '<br/>';
        $content .= $project_properties;
        $content .= '</div>';

        $content .= '<div class="tab-pane fade in active" id="backup">';
        $content .= '<br/>';
        if (isset($_GET['err']))
        {

            switch ($_GET['err'])
            {

                case 'backup_done':
                    $content .= '<div class="alert alert-success" ><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><strong>Well done!</strong> You successfully backup this project</p></div>';
                    break;
                case 'restore_done':
                    $content .= '<div class="alert alert-success" ><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><strong>Well done!</strong> You successfully restore the project</p></div>';
                    break;
                case 'trash_done':
                    $content .= '<div class="alert alert-success" ><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><strong>Well done!</strong> You successfully delete restore file the project</p></div>';
                    break;
                case 'restore_dialog':
                    $content .= '
<div id="modal_dialog" class="modal fade alert-modal-sm" tabindex="-1" role="dialog" aria-labelledby="Error!" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Confirmation!</h4>
      </div>
        <div class="modal-body">
             This action will be overwrite current project, are you sure to restore this project?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a href="./?page=project&act=restore&file=' . $_GET['file'] . '"  class="btn btn-primary">Yes, I agree</a>
      </div>
   </div>
  </div>
</div>
';
                    break;
                case 'trash_dialog':
                    $content .= '
<div id="modal_dialog" class="modal fade alert-modal-sm" tabindex="-1" role="dialog" aria-labelledby="Error!" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Confirmation!</h4>
      </div>
        <div class="modal-body">
             Are you want to delete this restore file?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <a href="./?page=project&act=trash_backup&file=' . $_GET['file'] . '"  class="btn btn-primary">Yes, I agree</a>
      </div>
   </div>
  </div>
</div>
';
                    break;
            }
        }
        $content .= $backup_project;
        $content .= '</div>';

        $content .= '</div>';
        break;
    case 'unlock-project':
        $content .= '<ul class="nav nav-tabs">';
        $content .= '<li class="active"><a href="#projects" data-toggle="tab" >Existing Projects</a></li>';
        $content .= '<li><a href="#properties" data-toggle="tab">Properties</a></li>';
        $content .= '<li><a href="#backup" data-toggle="tab" >Backup</a></li>';
        $content .= '</ul>';

        $content .= '<div class="tab-content">';
        $content .= '<div class="tab-pane fade in active"  id="projects">';
        $content .= '<br/>';
        $content .= '<div class="alert alert-success" ><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><strong>Well done!</strong> You successfully unlock this project, now you <ins>can edit</ins> this project</p></div>';
        $content .= $project_table;
        $content .= '</div>';
        $content .= '<div class="tab-pane fade" id="properties">';
        $content .= '<br/>';
        $content .= $project_properties;
        $content .= '</div>';
        $content .= '<div class="tab-pane fade" id="backup">';
        $content .= '<br/>';
        $content .= $backup_project;
        $content .= '</div>';
        $content .= '</div>';
        break;
    case 'lock-project':
        $content .= '<ul class="nav nav-tabs">';
        $content .= '<li class="active"><a href="#projects" data-toggle="tab" >Existing Projects</a></li>';
        $content .= '<li><a href="#properties" data-toggle="tab">Properties</a></li>';
        $content .= '<li><a href="#backup" data-toggle="tab" >Backup</a></li>';
        $content .= '</ul>';

        $content .= '<div class="tab-content">';
        $content .= '<div class="tab-pane fade in active"  id="projects">';
        $content .= '<br/>';
        $content .= '<div class="alert alert-success" ><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><strong>Well done!</strong> You successfully lock this project, now you <ins>can not edit</ins> this project</p></div>';
        $content .= $project_table;
        $content .= '</div>';
        $content .= '<div class="tab-pane fade" id="properties">';
        $content .= '<br/>';
        $content .= $project_properties;
        $content .= '</div>';

        $content .= '<div class="tab-pane fade" id="backup">';
        $content .= '<br/>';
        $content .= $backup_project;
        $content .= '</div>';
        $content .= '</div>';

        break;
}


define('JZ_CONTENT', $content);
unset($content);
