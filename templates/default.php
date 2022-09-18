<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>WordPress Plugin Maker</title>
    <link href="templates/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="templates/css/bootstrap-theme.min.css" rel="stylesheet"/>
    <link href="templates/css/dashicons.min.css" rel="stylesheet"/>
    <link href="templates/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="templates/js/colorbox/themes/colorbox.css" rel="stylesheet"/>
    <link href="templates/js/tagsinput/css/bootstrap.tagsinput.css" rel="stylesheet"/>
    <link href="templates/css/style.css" rel="stylesheet"/>
    <link href="./templates/js/jstree/themes/default/style.min.css" rel="stylesheet"/>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>
<body>

<!-- Fixed navbar -->

<?php if( JZ_NO_CONTAINER == false ){ ?>
<?php echo JZ_DROPDOWN ?>

<div class="md-70"></div> 
<div class="<?php echo TEMPLATES_CONTAINER; ?>">
   <!-- <div class="alert alert-success">
    <h4><strong>iWP-DevToolz v2 (Beta)</strong></h4>
    <p>Hi! We have made the plugin maker v2, this is more features and easier to use than the previous version, We ask for help trying this latest version. If you have an idea or bug report, send it to: <strong>iwpdev@ihsana.com</strong></p>
    </div> -->
            
    <div class="row">
    <?php if( JZ_FULL_PAGE == false ){ ?>
        <div class="col-sm-3 col-md-3">
            <?php echo JZ_SIDEBAR ?>        
        </div> 
        <div class="col-sm-9 col-md-9 main">
        

            
            <div class="panel panel-default">
                <div class="panel-body"  id="page-content">
                    <?php echo JZ_CONTENT; ?>
                </div>
            </div>
            <!-- <p>Copyright &copy; 2021 - <a href="https://codecanyon.net/item/wordpress-plugin-maker-freelancer-version/13581496?ref=codegenerator">WP Plugin Maker</a>, you have version: <label class="text-danger">rev21.01.01</label></p> -->
        </div>

    <?php }else{ ?>           
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body"  id="page-content">
                    <?php echo JZ_CONTENT; ?>
                </div>
            </div>
        </div>  
    <?php } ?>
        
    </div>
</div>
<?php }else{ ?> 
<?php echo JZ_CONTENT; ?>
 <?php } ?> 


 
<script src="templates/js/jquery.min.js"></script>
<script src="templates/js/jquery-migrate.min.js"></script>
<script src="templates/js/holder.min.js"></script>
<script src="templates/js/bootstrap.min.js"></script>
<script src="templates/js/colorbox/jquery.colorbox.min.js"></script>
<script src="templates/js/validate/jquery.validate.min.js"></script>
<script src="templates/js/tagsinput/js/bootstrap.tagsinput.min.js"></script>
<script src="templates/js/jstree/jstree.min.js"></script>
<script src="templates/js/edit_area/edit_area_full.js"></script>

<script src="templates/js/main.js"></script>
</body>
</html>