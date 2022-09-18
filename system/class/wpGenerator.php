<?php

/**
 * Base Class Generator
 * 
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2015
 * @license Commercial License
 * 
 * @package WordPress Plugin Maker
 */

defined("EXEC") or die();

/**
 * wpGenerator
 * 
 * @package WordPress Plugin Maker  
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2015
 * @version 2015
 * @access public
 * 
 * @tutorial wp-generator.pkg
 */

class wpGenerator
{
    /**
     * generator by
     * @access private
     * @property-read string $generator_by
     */
    private $generator_by = 'Generate by Plugin Maker ~ http://codecanyon.net/item/wordpress-plugin-maker-freelancer-version/13581496';

    /**
     * Assets
     * @access private
     * @property-read array $assets
     */
    private $assets = array();
    /**
     * String space for output code
     * @access private
     * @property-read string $newline
     */
    private $newline = "\r\n";
    /**
     * String tab for output code
     * @access private
     * @property-read string
     */
    private $tab = "\t";
    /**
     * String class for output code
     * @property-read string Output Class
     * @access private
     */
    private $Plugin_Class;
    /**
     * String constant for output code
     * @property-read string
     * @access private
     */
    private $Plugin_Const;
    /**
     * List function
     * @property-read array
     * @access private
     */
    private $functions = array();
    /**
     * List class
     * @property-read array
     * @access private
     */
    private $class = array();
    /**
     *  List lessc
     * @property-read array
     * @access private
     */
    private $less = array();
    /**
     * config
     * @property-read array
     * @access private
     */
    private $config;


    /**
     * List file has been create
     * @access public
     * @property-read array 
     */
    public $files;

    /**
     * Prefix Plugin
     * @var string  
     * @access public
     */
    public $Plugin_Prefix;

    /**
     * Reset File has been create
     * @var boolean
     * @access public
     */
    public $reset = false;

    /**
     * Keep file
     * @var string
     * @access public
     */
    public $lock = 'false';

    /**
     * Plugin Name
     * @var string
     * @access public
     */
    public $Plugin_Name = 'My Plugin Name';
    /**
     * Plugin Vendor URL
     * @var string
     * @access public
     */
    public $Plugin_URI = 'http://ihsana.com/plugin-maker/';
    /**
     * Plugin Description
     * @var string
     * @access public
     */
    public $Description = '';
    /**
     * Plugin Description
     * @var string
     * @access public
     */
    public $Version = '';
    /**
     * Plugin Author Name
     * @var string
     * @access public
     */
    public $Author = '';
    /**
     * Plugin Author Website
     * @var string
     * @access public
     */
    public $Author_URI = '';
    /**
     * Plugin Tags
     * @var string
     * @access public
     */
    public $Tags = '';
    /**
     * Plugin Required WordPress
     * @var string
     * @access public
     */
    public $Requires_at_least = '';
    /**
     * Plugin Test up on WordPress
     * @var string
     * @access public
     */

    public $Tested_up_to = '';
    /**
     * Plugin Stable version
     * @var string
     * @access public
     */
    public $Stable_tag = '';
    /**
     * Plugin License
     * @var string
     * @access public
     */
    public $License = "";
    /**
     * Plugin License URL
     * @var string
     * @access public
     */
    public $License_URI = "";
    /**
     * Plugin Short Name (Unique name)
     * @var string
     * @access public
     */
    public $Plugin_ShortName = '';
    /**
     * Plugin Directory output code
     * @var string
     * @access public
     */
    public $dir = 'wp-content/plugins/';
    /**
     * WordPress for Live Test Plugin
     * @var string
     * @access public
     */
    public $live_wp_test = '';
    /**
     * Plugin Language
     * @var boolean
     * @access public
     */

    public $textdomain = false;
    /**
     * Plugin Activation 
     * @var boolean
     * @access public
     */
    public $activation = false;

    /**
     * set or get toolbars
     * @var array
     * @access public
     */
    public $toolbars = array();
    /**
     * set or get javascripts
     * @var array
     * @access public
     */
    public $options = array();
    /**
     * set or get shortcode/quicktag
     * @var array
     * @access public
     */
    public $shortcodes = array();
    /**
     * set or get metabox/toolbox
     * @var array
     * @access public
     */
    public $metaboxs = array();
    /**
     * set or get widget
     * @var array
     * @access public
     */
    public $widgets = array();
    /**
     * set or get ajax
     * @var array
     * @access public
     */
    public $ajaxs = array();
    /**
     * set or get javascripts
     * @var array
     * @access public
     */
    public $javascripts = array();
    /**
     * set or get style/css
     * @var array
     * @access public
     */
    public $styles = array();
    /**
     * set or get top level admin menu
     * @var array
     * @access public
     */
    public $admin_menus = array();
    /**
     * set or get post type
     * @var array
     * @access public
     */
    public $post_types = array();

    /**
     * set or get image size
     * @var array
     * @access public
     */
    public $image_sizes = array();

    /**
     * set or get taxonomies
     * @var array
     * @access public
     */
    public $taxonomies = array();

    /**
     * set or get tinymces plugin
     * @var array
     * @access public
     */
    public $tinymces = array();

    /**
     * set js on header only for dinamic js
     * @var array
     * @access private
     */
    private $head_js = array();


    /**
     * Lang
     * @var array
     * @access private
     */
    private $Plugin_Lang = array();

    /**
     * Dir
     * @var array
     * @access private
     */
    private $Plugin_Dir = array();

    /**
     * REST API
     * @var array
     * @access public
     */
    public $rest_api = array();

    /**
     * wpGenerator::__construct()
     * 
     * @param array $properties = array()
     * 
     * List of array key
     *  
     *		@type string		$Plugin_Name		example: 'Manga Scanlation' 
     *		@type string		$Plugin_URI			example: 'http://ihsana.com/' 
     *		@type string		$Description		example: 'Scanlation (also scanslation) is the scanning, translation, and editing of comics from a language into another language' 
     *		@type string		$Version			example: '1.0' 
     *		@type string		$Author			    example: 'Jasman' 
     *		@type string		$Author_URI			example: 'http://ihsana.com/jasman/' 
     *		@type string		$Tags			    example: 'manga,comic,publisher,translation' 
     *		@type string		$Requires_at_least	example: '3.4' 
     *		@type string		$Tested_up_to		example: '3.4' 
     *		@type string		$Stable_tag			example: '3.4' 
     *		@type string		$License			example: 'GNU General Public Licenses V2 or Later' 
     *		@type string		$License_URI		example: 'http://www.gnu.org/licenses/gpl-2.0.html' 
     *		@type string		$Plugin_ShortName	example: 'msc' 
     *		@type string		$textdomain			example: 'true' 
     * 
     * @return void
     */
    function __construct($properties)
    {
        if (isset($properties['reset']))
        {
            $this->reset = $properties['reset'];
        }
        $this->lock = $properties['lock'];
        $this->Plugin_Name = $properties['Plugin_Name'];
        $this->Plugin_URI = $properties['Plugin_URI'];
        $this->Description = $properties['Description'];
        $this->Version = $properties['Version'];
        $this->Author = $properties['Author'];
        $this->Author_URI = $properties['Author_URI'];
        $this->Tags = $properties['Tags'];
        $this->Requires_at_least = $properties['Requires_at_least'];
        $this->Tested_up_to = $properties['Tested_up_to'];
        $this->Stable_tag = $properties['Stable_tag'];
        $this->License = $properties['License'];
        $this->License_URI = $properties['License_URI'];
        $this->Plugin_ShortName = $properties['Plugin_ShortName'];

        $this->dir = $properties['dir'];
        $this->live_wp_test = $properties['live_wp_test'];
        $this->Plugin_Const = strtoupper($this->Plugin_ShortName);
        $this->Plugin_Prefix = $this->strToVariable($this->Plugin_Name);

        $this->textdomain = $properties['textdomain'];
        $this->debugger = $properties['debug'];

        $this->Plugin_Lang = str_replace('_', '-', $this->Plugin_Prefix);
        $this->Plugin_Dir = str_replace('_', '-', $this->Plugin_Prefix);

        $this->Plugin_Class = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->strToVariable($this->Plugin_Name))));
        $this->config = $properties;
    }
    /**
     * wpGenerator::codeConstant()
     * 
     * @return string
     */
    private function codeConstant()
    {
        $string = null;
        $string .= '# Constant' . $this->newline;

        $string .= $this->newline;
        $string .= '/**' . $this->newline;
        $string .= ' * Exec Mode' . $this->newline;
        $string .= ' **/' . $this->newline;

        $string .= 'define("' . $this->Plugin_Const . '_EXEC",true);' . $this->newline;

        $string .= $this->newline;
        $string .= '/**' . $this->newline;
        $string .= ' * Plugin Base File' . $this->newline;
        $string .= ' **/' . $this->newline;

        $string .= 'define("' . $this->Plugin_Const . '_PATH",dirname(__FILE__));' . $this->newline;

        $string .= $this->newline;
        $string .= '/**' . $this->newline;
        $string .= ' * Plugin Base Directory' . $this->newline;
        $string .= ' **/' . $this->newline;
        $string .= 'define("' . $this->Plugin_Const . '_DIR",basename(' . $this->Plugin_Const . '_PATH));' . $this->newline;
        $string .= $this->newline;
        $string .= '/**' . $this->newline;
        $string .= ' * Plugin Base URL' . $this->newline;
        $string .= ' **/' . $this->newline;

        $string .= 'define("' . $this->Plugin_Const . '_URL",plugins_url("/",__FILE__));' . $this->newline;

        $string .= $this->newline;
        $string .= '/**' . $this->newline;
        $string .= ' * Plugin Version' . $this->newline;
        $string .= ' **/' . $this->newline;

        $string .= 'define("' . $this->Plugin_Const . '_VERSION","' . $this->Version . '"); ' . $this->newline;

        $string .= $this->newline;
        $string .= '/**' . $this->newline;
        $string .= ' * Debug Mode' . $this->newline;
        $string .= ' **/' . $this->newline;
        if ($this->debugger == true)
        {
            $string .= 'define("' . $this->Plugin_Const . '_DEBUG",true);  //change false for distribution' . $this->newline;
        } else
        {
            $string .= 'define("' . $this->Plugin_Const . '_DEBUG",false);  //change false for distribution' . $this->newline;
        }
        $string .= $this->newline;
        $string .= $this->newline;
        return $string;
    }

    /**
     * wpGenerator::codeImageSize()
     * 
     * @return void
     */
    private function codeImageSize()
    {
        if (is_array($this->image_sizes))
        {
            if ($this->image_sizes != 0)
            {
                $arg['construct'] = 'add_action("after_setup_theme", array($this, "' . $this->Plugin_ShortName . '_image_size")); // register image size.';

                $arg['function'] = null;
                $arg['function'] .= $this->tab . '/**' . $this->newline;
                $arg['function'] .= $this->tab . ' * Register a new image size.' . $this->newline;
                $arg['function'] .= $this->tab . ' * @link http://codex.wordpress.org/Function_Reference/add_image_size' . $this->newline;
                $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                $arg['function'] .= $this->tab . ' **/' . $this->newline;
                $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_image_size()' . $this->newline;
                $arg['function'] .= $this->tab . '{' . $this->newline;
                foreach ($this->image_sizes as $image_size)
                {
                    if (!isset($image_size['crop']))
                    {
                        $image_size['crop'] = 'false';
                    }

                    if ($image_size['crop'] == '1')
                    {
                        $crop = 'true';
                    } else
                    {
                        $crop = 'false';
                    }
                    $arg['function'] .= $this->tab . $this->tab . 'add_image_size("' . $this->Plugin_ShortName . '_' . $image_size['name'] . '", ' . (int)$image_size['width'] . ', ' . (int)$image_size['height'] . ', ' . $crop . ');' . $this->newline;
                }
                $arg['function'] .= $this->tab . '}' . $this->newline;
                $this->addFunction($arg);

                $arg = null;
                $arg['construct'] = 'add_filter("image_size_names_choose", array($this, "' . $this->Plugin_ShortName . '_image_sizes_choose")); // image size choose.';
                $arg['function'] = null;
                $arg['function'] .= $this->tab . '/**' . $this->newline;
                $arg['function'] .= $this->tab . ' * Choose a image size.' . $this->newline;
                $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                $arg['function'] .= $this->tab . ' * @param mixed $sizes' . $this->newline;
                $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                $arg['function'] .= $this->tab . ' **/' . $this->newline;
                $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_image_sizes_choose($sizes)' . $this->newline;
                $arg['function'] .= $this->tab . '{' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . '$custom_sizes = array(' . $this->newline;
                foreach ($this->image_sizes as $image_size)
                {
                    if (!isset($image_size['label']))
                    {
                        $image_size['label'] = $this->Plugin_ShortName . '_thumbnail';
                    }
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '"' . $this->Plugin_ShortName . '_' . $image_size['name'] . '"=>"' . $image_size['label'] . '",' . $this->newline;
                }
                $arg['function'] .= $this->tab . $this->tab . ');' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . 'return array_merge($sizes,$custom_sizes);' . $this->newline;
                $arg['function'] .= $this->tab . '}' . $this->newline;
                $this->addFunction($arg);

            }
        } else
        {
            $this->image_sizes = array();
        }
    }


    /**
     * wpGenerator::codeTaxonomies()
     * 
     * @return void
     */
    private function codeTaxonomies()
    {
        if (is_array($this->taxonomies))
        {
            if ($this->taxonomies != 0)
            {
                $arg['construct'] = 'add_action("init", array($this, "' . $this->Plugin_ShortName . '_register_taxonomy")); // register register_taxonomy.';

                $arg['function'] = null;
                $arg['function'] .= $this->tab . '/**' . $this->newline;
                $arg['function'] .= $this->tab . ' * Register Taxonomies' . $this->newline;
                $arg['function'] .= $this->tab . ' * @https://codex.wordpress.org/Taxonomies' . $this->newline;
                $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                $arg['function'] .= $this->tab . ' **/' . $this->newline;
                $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_register_taxonomy()' . $this->newline;
                $arg['function'] .= $this->tab . '{' . $this->newline;
                foreach ($this->taxonomies as $taxonomies)
                {
                    if ($taxonomies['label'] != '')
                    {
                        if (!isset($taxonomies['label_plural']))
                        {
                            $taxonomies['label_plural'] = $taxonomies['label'] . 's';
                        }

                        if ($taxonomies['label_plural'] == '')
                        {
                            $taxonomies['label_plural'] = $taxonomies['label'] . 's';
                        }

                        $arg['function'] .= $this->tab . $this->tab . '$' . $taxonomies['name'] . '_labels = array(' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"name" => _x( "' . $taxonomies['label_plural'] . '", "taxonomy general name" ),' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"singular_name" => _x( "' . $taxonomies['label'] . '", "taxonomy singular name" ),' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"search_items" =>  __( "Search ' . $taxonomies['label_plural'] . '" ),' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"all_items" => __( "All ' . $taxonomies['label_plural'] . '" ),' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"parent_item" => __( "Parent ' . $taxonomies['label'] . '" ),' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"parent_item_colon" => __( "Parent ' . $taxonomies['label'] . ':" ),' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"edit_item" => __( "Edit ' . $taxonomies['label'] . '" ),' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"update_item" => __( "Update ' . $taxonomies['label'] . '" ),' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"add_new_item" => __( "Add New ' . $taxonomies['label'] . '" ),' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"new_item_name" => __( "New ' . $taxonomies['label'] . ' Name" ),' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"menu_name" => __( "' . $taxonomies['label_plural'] . '" ), ' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . ');' . $this->newline;
                        if (!isset($taxonomies['hooks']))
                        {
                            $taxonomies['hooks'] = array('page', 'post');
                        }
                        if (!is_array($taxonomies['hooks']))
                        {
                            $taxonomies['hooks'] = array('page', 'post');
                        }

                        $hierarchical = 'false';
                        if (!isset($taxonomies['hierarchical']))
                        {
                            $taxonomies['hierarchical'] = false;
                        }
                        if ($taxonomies['hierarchical'] == true)
                        {
                            $hierarchical = 'true';
                        }
                        if ($taxonomies['hierarchical'] == '1')
                        {
                            $hierarchical = 'true';
                        }

                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . 'register_taxonomy("' . $taxonomies['name'] . '",array("' . implode('","', $taxonomies['hooks']) . '"), array(' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"hierarchical" => ' . $hierarchical . ',' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"labels" => $' . $taxonomies['name'] . '_labels,' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"show_ui" => true,' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"show_admin_column" => true,' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"query_var" => true,' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"rewrite" => array( "slug" => "' . $taxonomies['name'] . '" ),' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '));' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . '' . $this->newline;
                    }
                }
                $arg['function'] .= $this->tab . '}' . $this->newline;
                $this->addFunction($arg);
            }
        } else
        {
            $this->taxonomies = array();
        }
    }


    /**
     * wpGenerator::codeTinyMCE()
     * 
     * @return void
     */
    private function codeTinyMCE()
    {
        if (is_array($this->tinymces))
        {
            if (count($this->tinymces) != 0)
            {
                $arg['construct'] = 'add_action("init", array($this, "' . $this->Plugin_ShortName . '_tinymce_plugin")); // register tinymce plugin';
                $arg['function'] = null;
                $arg['admin'] = true;
                $arg['function'] .= $this->tab . '/**' . $this->newline;
                $arg['function'] .= $this->tab . ' * Add Tiny MCE Plugin.' . $this->newline;
                $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                $arg['function'] .= $this->tab . ' **/' . $this->newline;
                $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_tinymce_plugin()' . $this->newline;
                $arg['function'] .= $this->tab . '{' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . 'add_filter("mce_external_plugins", array($this, "' . $this->Plugin_ShortName . '_tinymce_add_buttons"));' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . 'add_filter("mce_buttons", array($this, "' . $this->Plugin_ShortName . '_tinymce_register_buttons"));' . $this->newline;
                $arg['function'] .= $this->tab . '}' . $this->newline;

                $arg['function'] .= $this->tab . '/**' . $this->newline;
                $arg['function'] .= $this->tab . ' * Add button Tiny MCE' . $this->newline;
                $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                $arg['function'] .= $this->tab . ' * @param mixed $plugin_array' . $this->newline;

                $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                $arg['function'] .= $this->tab . ' **/' . $this->newline;
                $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_tinymce_add_buttons($plugin_array)' . $this->newline;
                $arg['function'] .= $this->tab . '{' . $this->newline;

                $arg['function'] .= $this->tab . $this->tab . '$plugin_array["' . $this->Plugin_Prefix . '"] = ' . strtoupper($this->Plugin_ShortName) . '_URL . "/assets/js/' . $this->Plugin_ShortName . '_tinymce_plugin.js";' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . 'return $plugin_array;' . $this->newline;

                $arg['function'] .= $this->tab . '}' . $this->newline;

                $arg['function'] .= $this->tab . '/**' . $this->newline;
                $arg['function'] .= $this->tab . ' * Register button Tiny MCE' . $this->newline;
                $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                $arg['function'] .= $this->tab . ' * @param mixed $buttons' . $this->newline;
                $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                $arg['function'] .= $this->tab . ' **/' . $this->newline;
                $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_tinymce_register_buttons($buttons)' . $this->newline;
                $arg['function'] .= $this->tab . '{' . $this->newline;
                $button_tinymce = array();
                foreach ($this->tinymces as $tinymce)
                {
                    $button_tinymce[] = $tinymce['name'];
                }
                $arg['function'] .= $this->tab . $this->tab . 'array_push($buttons, "' . implode('","', $button_tinymce) . '"); ' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . 'return $buttons;' . $this->newline;
                $arg['function'] .= $this->tab . '}' . $this->newline;
                $this->addFunction($arg);

                $code_js = null;
                $code_js .= '/**' . $this->newline;
                $code_js .= ' * ' . $this->Plugin_Name . ' TinyMCE plugin' . $this->newline;
                $code_js .= ' */' . $this->newline;
                $code_js .= $this->newline;
                $code_js .= '(function(){' . $this->newline;
                $code_js .= '	tinymce.create("tinymce.plugins.' . $this->Plugin_Prefix . '", {' . $this->newline;
                $code_js .= '		init: function(editor, url) {' . $this->newline;

                foreach ($this->tinymces as $tinymce)
                {
                    $code_js .= '			editor.addButton("' . $tinymce['name'] . '", {' . $this->newline;
                    $code_js .= '				title: "' . $tinymce['label'] . '",' . $this->newline;
                    //$code_js .= '				cmd: "' . $tinymce['name'] . '",' . $this->newline;
                    $code_js .= '				icon: "icon ' . $this->Plugin_ShortName . '-mce-icon ' . $tinymce['icon'] . '",' . $this->newline;
                    $code_js .= '				onclick: function(){' . $this->newline;
                    $code_js .= '				// Open window' . $this->newline;
                    $code_js .= '				            editor.windowManager.open({' . $this->newline;
                    $code_js .= '				                title: "' . $tinymce['label'] . '",' . $this->newline;
                    $code_js .= '				                bodyType: "tabpanel",' . $this->newline;
                    $code_js .= '				                body: [{' . $this->newline;
                    $code_js .= '                 				      title: "General",' . $this->newline;
                    $code_js .= '				                      type: "form",' . $this->newline;
                    $code_js .= '				                      items: [' . $this->newline;

                    $get_value = $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . 'var shortcode = "[' . $tinymce['name'] . ' " ; ' . $this->newline;
                    foreach ($this->shortcodes as $shortcodes)
                    {
                        if ($tinymce['sample_code'] == $shortcodes['tag'])
                        {
                            foreach ($shortcodes['properties'] as $properties)
                            {
                                if (isset($properties['name']))
                                {
                                    if ($properties['name'] != '')
                                    {
                                        if (!isset($properties['explanation']))
                                        {
                                            $properties['explanation'] = '';
                                        }

                                        if (!isset($properties['type']))
                                        {
                                            $properties['type'] = 'text';
                                        }


                                        $properties['type'] = str_replace('radio', 'listbox', $properties['type']);
                                        $properties['type'] = str_replace('dropdown', 'listbox', $properties['type']);
                                        $properties['type'] = str_replace('select', 'listbox', $properties['type']);

                                        if (!isset($properties['label']))
                                        {
                                            $properties['label'] = '&nbsp;';
                                        }

                                        switch ($properties['type'])
                                        {
                                            case 'text':
                                                $code_js .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . '{type: "textbox", name: "' . $properties['name'] . '", label: "' . $properties['label'] . '"},' . $this->newline;
                                                break;
                                            case 'textarea':
                                                $code_js .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . '{type: "textbox", name: "' . $properties['name'] . '", label: "' . $properties['label'] . '"},' . $this->newline;
                                                break;
                                            case 'checkbox':
                                                $code_js .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . '{type: "checkbox", name: "' . $properties['name'] . '", label: "' . $properties['label'] . '", text: "' . $properties['explanation'] . '"},' . $this->newline;
                                                break;
                                            case 'listbox':

                                                $code_js .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . '{type: "listbox", name: "' . $properties['name'] . '", label: "' . $properties['label'] . '", values: [' . $this->newline;


                                                foreach ($properties['enum'] as $enum)
                                                {
                                                    if (!isset($enum['value']))
                                                    {
                                                        $enum['value'] = '';
                                                    }
                                                    if (!isset($enum['label']))
                                                    {
                                                        $enum['label'] = '';
                                                    }
                                                    $code_js .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . '{ value: "' . $enum['value'] . '", text: "' . $enum['label'] . '"},' . $this->newline;
                                                }

                                                $code_js .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . ']},' . $this->newline;
                                                break;
                                            case 'colorpicker':
                                                $code_js .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . '{type: "colorpicker", name: "' . $properties['name'] . '", label: "' . $properties['label'] . '",style:"height:120px;width:150px;"},' . $this->newline;
                                                break;
                                        }
                                    }
                                    $get_value .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . 'shortcode +="' . $properties['name'] . '=\""  + e.data.' . $properties['name'] . ' + "\" " ;' . $this->newline;
                                }
                            }
                        }
                    }
                    $get_value .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . 'shortcode += "]" ; ' . $this->newline;
                    $get_value .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . 'shortcode += "[/' . $tinymce['name'] . ']" ; ' . $this->newline;
                    $code_js .= '				                   ],' . $this->newline;
                    $code_js .= '				                },' . $this->newline;
                    $code_js .= '				                {' . $this->newline;
                    $code_js .= '                 				      title: "About",' . $this->newline;
                    $code_js .= '				                      type: "form",' . $this->newline;
                    $code_js .= '				                      items: [' . $this->newline;
                    $code_js .= '				                             {type: "panel",html:"<h4 style=\'font-size:24px;font-weight:600;\'>' . $this->Plugin_Name . ' v' . $this->Version . '</h4><p style=\'font-size:18px;\'>Created by <a style=\'font-size:18px;cursor:pointer;font-weight:600;\' href=\'' . $this->Author_URI . '\'>' . $this->Author . '</a></p><p><a style=\'cursor:pointer;font-weight:600;\' href=\'' . $this->License_URI . '\'>' . $this->License . '</a></p><br/><p>Powered by <a style=\'cursor:pointer;font-weight:600;\' href=\'http://codecanyon.net/item/wordpress-plugin-maker-freelancer-version/13581496?ref=regel\'>WordPress Plugin Maker</a></p>"},' . $this->newline;
                    $code_js .= '				                             ]' . $this->newline;
                    $code_js .= '				                }],' . $this->newline;
                    $code_js .= '				                onsubmit: function(e) {' . $this->newline;
                    $code_js .= '				                    // Insert content when the window form is submitted' . $this->newline;
                    $code_js .= $get_value;
                    $code_js .= '				                    editor.insertContent(shortcode);' . $this->newline;
                    $code_js .= '				                }' . $this->newline;
                    $code_js .= '				            });' . $this->newline;
                    $code_js .= '				}' . $this->newline;
                    $code_js .= '			});' . $this->newline;
                }

                $code_js .= '		},' . $this->newline;
                $code_js .= $this->newline;
                $code_js .= '		createControl: function(n, cm) {' . $this->newline;
                $code_js .= '			return null;' . $this->newline;
                $code_js .= '		},' . $this->newline;
                $code_js .= $this->newline;
                $code_js .= '      /**' . $this->newline;
                $code_js .= '       * Returns information about the plugin as a name/value array.' . $this->newline;
                $code_js .= '       * The current keys are longname, author, authorurl, infourl and version.' . $this->newline;
                $code_js .= '       *' . $this->newline;
                $code_js .= '       * @return {Object} Name/value array containing information about the plugin.' . $this->newline;
                $code_js .= '       */' . $this->newline;

                $code_js .= '		getInfo: function() {' . $this->newline;
                $code_js .= '			return {' . $this->newline;
                $code_js .= '				longname: "' . $this->Plugin_Name . '",' . $this->newline;
                $code_js .= '				author: "' . $this->Author . '",' . $this->newline;
                $code_js .= '				authorurl: "' . $this->Author_URI . '",' . $this->newline;
                $code_js .= '				infourl: "' . $this->Plugin_URI . '",' . $this->newline;
                $code_js .= '				version: "' . $this->Version . '"' . $this->newline;
                $code_js .= '			};' . $this->newline;
                $code_js .= '		}' . $this->newline;
                $code_js .= '	});' . $this->newline;
                $code_js .= '	// Register plugin' . $this->newline;
                $code_js .= '	tinymce.PluginManager.add("' . $this->Plugin_Prefix . '", tinymce.plugins.' . $this->Plugin_Prefix . ');' . $this->newline;
                $code_js .= '})();' . $this->newline;

                $this->addFiles(array('path' => str_replace('_', '-', $this->Plugin_Prefix) . '/assets/js/' . $this->Plugin_ShortName . '_tinymce_plugin.js', 'string' => $code_js));


                $code_css = null;
                $code_css .= '/**' . $this->newline;
                $code_css .= ' * ' . $this->Plugin_Name . ' TinyMCE plugin' . $this->newline;
                $code_css .= ' */' . $this->newline;
                foreach ($this->tinymces as $tinymce)
                {
                    $code_css .= '
                    
 i.' . $this->Plugin_ShortName . '-mce-icon {
	font: normal 20px/1 "dashicons";
	padding: 0;
	vertical-align: top;
	speak: none;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	margin-left: -2px;
	padding-right: 2px;
    color:#A50D0D !important;
}                   
                    
                    ';
                }

                $this->addFiles(array('path' => str_replace('_', '-', $this->Plugin_Prefix) . '/assets/css/' . $this->Plugin_ShortName . '_tinymce_plugin.css', 'string' => $code_css));

                $this->addCss(array(
                    'admin' => true,
                    'version' => $this->Version,
                    'src' => 'assets/css/' . $this->Plugin_ShortName . '_tinymce_plugin.css',
                    'name' => 'tinymce',
                    'hooks' => array('post-new.php', 'post.php'),
                    ));

            }
        } else
        {
            $this->tinymces = array();
        }
    }
    /**
     * wpGenerator::codePostType()
     * 
     * @return void
     */
    private function codePostType()
    {
        if (is_array($this->post_types))
        {
            foreach ($this->post_types as $post_type)
            {
                if (!isset($post_type['rest_api']))
                {
                    $post_type['rest_api'] = false;
                }
                if (!isset($post_type['icon']))
                {
                    $post_type['icon'] = '';
                }
                if ($post_type['icon'] == '')
                {
                    $post_type['icon'] = 'dashicons-heart';
                }
                if (!isset($post_type['supports']))
                {
                    $post_type['supports'] = array();
                }
                if (!is_array($post_type['supports']))
                {
                    $post_type['supports'] = array();
                }

                $arg['construct'] = 'add_action("init", array($this, "' . $this->Plugin_ShortName . '_post_type_' . $post_type['name'] . '_init")); // register a ' . $post_type['name'] . ' post type.';

                $arg['function'] = null;
                $arg['function'] .= $this->tab . '/**' . $this->newline;
                $arg['function'] .= $this->tab . ' * Register custom post types (' . $post_type['name'] . ')' . $this->newline;
                $arg['function'] .= $this->tab . ' *' . $this->newline;
                $arg['function'] .= $this->tab . ' * @link http://codex.wordpress.org/Function_Reference/register_post_type' . $this->newline;
                $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                $arg['function'] .= $this->tab . ' **/' . $this->newline;
                $arg['function'] .= $this->newline;
                $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_post_type_' . $post_type['name'] . '_init()' . $this->newline;
                $arg['function'] .= $this->tab . '{' . $this->newline;
                $arg['function'] .= $this->newline;
                $arg['function'] .= $this->tab . $this->tab . '$labels = array(' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '\'name\' => _x(\'' . addslashes($post_type['text-name']) . '\', \'post type general name\', \'' . $this->Plugin_Lang . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '\'singular_name\' => _x(\'' . addslashes($post_type['text-singular_name']) . '\', \'post type singular name\', \'' . $this->Plugin_Lang . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '\'menu_name\' => _x(\'' . addslashes($post_type['text-menu_name']) . '\', \'admin menu\', \'' . $this->Plugin_Lang . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '\'name_admin_bar\' => _x(\'' . addslashes($post_type['text-name_admin_bar']) . '\', \'add new on admin bar\', \'' . $this->Plugin_Lang . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '\'add_new\' => _x(\'' . addslashes($post_type['text-add_new']) . '\', \'book\', \'' . $this->Plugin_Lang . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '\'add_new_item\' => __(\'' . addslashes($post_type['text-add_new_item']) . '\', \'' . $this->Plugin_Lang . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '\'new_item\' => __(\'' . addslashes($post_type['text-new_item']) . '\', \'' . $this->Plugin_Lang . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '\'edit_item\' => __(\'' . addslashes($post_type['text-edit_item']) . '\', \'' . $this->Plugin_Lang . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '\'view_item\' => __(\'' . addslashes($post_type['text-view_item']) . '\', \'' . $this->Plugin_Lang . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '\'all_items\' => __(\'' . addslashes($post_type['text-all_items']) . '\', \'' . $this->Plugin_Lang . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '\'search_items\' => __(\'' . addslashes($post_type['text-search_items']) . '\', \'' . $this->Plugin_Lang . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '\'parent_item_colon\' => __(\'' . addslashes($post_type['text-parent_item_colon']) . '\', \'' . $this->Plugin_Lang . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '\'not_found\' => __(\'' . addslashes($post_type['text-not_found']) . '\', \'' . $this->Plugin_Lang . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '\'not_found_in_trash\' => __(\'' . addslashes($post_type['text-not_found_in_trash']) . '\', \'' . $this->Plugin_Lang . '\'));' . $this->newline;
                $arg['function'] .= $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '$supports = array(\'' . implode("','", $post_type['supports']) . '\');' . $this->newline;
                $arg['function'] .= $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '$args = array(' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'labels\' => $labels,' . $this->newline;
                if (!isset($post_type['desc']))
                {
                    $post_type['desc'] = '';
                }

                if (!isset($post_type['publicly_queryable']))
                {
                    $post_type['publicly_queryable'] = '0';
                }

                if ($post_type['publicly_queryable'] == true)
                {
                    $publicly_queryable = 'true';
                } else
                {
                    $publicly_queryable = 'false';
                }
                if (!isset($post_type['rest_api']))
                {
                    $post_type['rest_api'] = false;
                }
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'description\' => __(\'' . addslashes($post_type['desc']) . '\', \'' . $this->Plugin_Lang . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'public\' => true,' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'menu_icon\' => \'' . addslashes($post_type['icon']) . '\',' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'publicly_queryable\' => ' . $publicly_queryable . ',' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'show_ui\' => true,' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'show_in_menu\' => true,' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'query_var\' => true,' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'rewrite\' => array(\'slug\' => \'' . addslashes($post_type['name']) . '\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'capability_type\' => \'post\',' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'has_archive\' => true,' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'hierarchical\' => true,' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'menu_position\' => null,' . $this->newline;

                if ($post_type['rest_api'] == true)
                {
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'show_in_rest\' => true,' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'rest_base\' => \'' . addslashes($post_type['name']) . '\',' . $this->newline;
                }

                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'taxonomies\' => array(), // array(\'category\', \'post_tag\',\'page-category\'),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '\'supports\' => $supports);' . $this->newline;
                $arg['function'] .= $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . 'register_post_type(\'' . addslashes($post_type['name']) . '\', $args);' . $this->newline;
                $arg['function'] .= $this->newline;

                if (!isset($post_type['single_template']))
                {
                    $post_type['single_template'] = false;
                }
                if ($post_type['single_template'] == true)
                {
                    $arg['function'] .= $this->tab . $this->tab . '// create single template' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . 'add_filter("single_template", array($this, "' . $this->Plugin_ShortName . '_post_type_' . $post_type['name'] . '_single_template"));' . $this->newline;
                }

                $arg['function'] .= $this->newline;
                $arg['function'] .= $this->tab . '}' . $this->newline;
                $this->addFunction($arg);

                if ($post_type['single_template'] == true)
                {
                    $arg = null;
                    $arg['construct'] = null;
                    $arg['function'] = null;
                    $arg['function'] .= $this->tab . '/**' . $this->newline;
                    $arg['function'] .= $this->tab . ' * Load Single Template (' . $post_type['name'] . ')' . $this->newline;
                    $arg['function'] .= $this->tab . ' *' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @param mixed $single_template' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                    $arg['function'] .= $this->tab . ' **/' . $this->newline;
                    $arg['function'] .= $this->newline;
                    $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_post_type_' . $post_type['name'] . '_single_template($single_template)' . $this->newline;
                    $arg['function'] .= $this->tab . '{' . $this->newline;
                    $arg['function'] .= $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . 'global $post;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . 'if(file_exists(' . strtoupper($this->Plugin_ShortName) . '_PATH . "/templates/single-' . $post_type['name'] . '.php" ))' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '{' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . 'if ($post->post_type == "' . $post_type['name'] . '")' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '{' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '$single_template = ' . strtoupper($this->Plugin_ShortName) . '_PATH . "/templates/single-' . $post_type['name'] . '.php";' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '}' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . 'return $single_template;' . $this->newline;
                    $arg['function'] .= $this->tab . '}' . $this->newline;
                    $this->addFunction($arg);
                }
                $arg['construct'] = null;
                $arg['construct'] = 'add_filter("the_content", array($this, "' . $this->Plugin_ShortName . '_post_type_' . addslashes($post_type['name']) . '_the_content")); // modif page for ' . $post_type['name'];
                $arg['function'] = null;
                $arg['function'] .= $this->tab . '/**' . $this->newline;
                $arg['function'] .= $this->tab . ' * Retrieved data custom post-types (' . $post_type['name'] . ')' . $this->newline;
                $arg['function'] .= $this->tab . ' *' . $this->newline;
                $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                $arg['function'] .= $this->tab . ' * @param mixed $content' . $this->newline;
                $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                $arg['function'] .= $this->tab . ' * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/the_content' . $this->newline;
                $arg['function'] .= $this->tab . ' **/' . $this->newline;
                $arg['function'] .= $this->newline;
                $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_post_type_' . $post_type['name'] . '_the_content($content)' . $this->newline;
                $arg['function'] .= $this->tab . '{' . $this->newline;
                $arg['function'] .= $this->newline;
                $arg['function'] .= $this->tab . $this->tab . '$new_content = $content ;' . $this->newline;

                $arg['function'] .= $this->tab . $this->tab . 'if(is_singular("' . $post_type['name'] . '")){' . $this->newline;

                $extend_class = str_replace(' ', '', ucwords(str_replace('_', ' ', $post_type['name'])));

                $arg['function'] .= $this->tab . $this->tab . $this->tab . 'if(file_exists(' . $this->Plugin_Const . '_PATH . "/includes/post_type.' . $post_type['name'] . '.inc.php' . '")){' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'require_once(' . $this->Plugin_Const . '_PATH . "/includes/post_type.' . $post_type['name'] . '.inc.php' . '");' . $this->newline;

                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '$' . $post_type['name'] . '_content = new ' . $extend_class . '_TheContent();' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '$new_content = $' . $post_type['name'] . '_content->Markup($content);' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'wp_reset_postdata();' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '}' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;

                $arg['function'] .= $this->newline;
                $arg['function'] .= $this->tab . $this->tab . 'return $new_content ;' . $this->newline;
                $arg['function'] .= $this->newline;
                $arg['function'] .= $this->tab . '}' . $this->newline;
                $this->addFunction($arg);


                if ($post_type['rest_api'] == true)
                {
                    $arg['construct'] = 'add_action("rest_prepare_' . $post_type['name'] . '", array($this, "' . $this->Plugin_ShortName . '_rest_prepare_' . $post_type['name'] . '"),10,3); ';
                    $arg['function'] = null;
                    $arg['function'] .= $this->tab . '/**' . $this->newline;
                    $arg['function'] .= $this->tab . ' * rest prepare' . $this->newline;
                    $arg['function'] .= $this->tab . ' *' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @param mixed $data' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @param mixed $term' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @param mixed $context' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @link https://developer.wordpress.org/reference/hooks/rest_prepare_this-post_type/' . $this->newline;
                    $arg['function'] .= $this->tab . ' **/' . $this->newline;
                    $arg['function'] .= $this->newline;
                    $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_rest_prepare_' . $post_type['name'] . '($data,$term,$context)' . $this->newline;
                    $arg['function'] .= $this->tab . '{' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$oldData = $data->data;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$newData = $oldData;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$newData["post_meta"] = get_post_meta($oldData["id"],"",true);' . $this->newline;

                    $arg['function'] .= $this->tab . $this->tab . '$data->data = $newData;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . 'return $data;' . $this->newline;
                    $arg['function'] .= $this->tab . '}' . $this->newline;
                    $this->addFunction($arg);
                }


                $sample_code = new wpSampleCode($this->config);
                $arg = array(
                    'post_type' => $post_type['name'],
                    'metaboxs' => $this->metaboxs,
                    'image_sizes' => $this->image_sizes,
                    'options' => $this->options);

                $init = $sample_code->single_post_init($arg, 2, 'this->');
                $layout = $sample_code->single_post_review_layout($arg, 2, 'this->');
                $var_list = $sample_code->single_post_use_variable($arg, 2, 'this->');

                $string = '<?php' . $this->newline;
                $string .= $this->newline;
                $string .= '/**' . $this->newline;
                $string .= ' * Custom Post Types (' . ucwords($post_type['name']) . ')' . $this->newline;
                $string .= ' *' . $this->newline;
                $string .= '**/' . $this->newline;
                $string .= $this->newline;
                $string .= '# Exit if accessed directly' . $this->newline;
                $string .= 'if(!defined("' . $this->Plugin_Const . '_EXEC")){' . $this->newline;
                $string .= $this->tab . 'die();' . $this->newline;
                $string .= '}' . $this->newline;
                $string .= $this->newline;
                $string .= $this->newline;

                $string .= ' /**' . $this->newline;
                $string .= '  * Dispaly front-end for custom post ' . $post_type['name'] . '' . $this->newline;
                $string .= '  * ' . $this->newline;
                $string .= '  * @package ' . $this->Plugin_Name . $this->newline;
                $string .= '  * @author ' . $this->Author . $this->newline;
                $string .= '  * @version ' . $this->Version . $this->newline;
                $string .= '  * @access public' . $this->newline;
                $string .= '  * ' . $this->newline;
                $string .= '  * ' . $this->generator_by . $this->newline;
                $string .= '  */' . $this->newline;

                $string .= 'class ' . $extend_class . '_TheContent{' . $this->newline;
                $string .= $this->newline;
                $string .= $this->tab . '/**' . $this->newline;
                $string .= $this->tab . ' * Option Plugin' . $this->newline;
                $string .= $this->tab . ' * @access private' . $this->newline;
                $string .= $this->tab . ' **/' . $this->newline;
                $string .= $this->tab . 'private $options;' . $this->newline;

                $string .= $this->newline;
                $string .= $this->tab . '/**' . $this->newline;
                $string .= $this->tab . ' * Instance of a class' . $this->newline;
                $string .= $this->tab . ' * ' . $this->newline;
                $string .= $this->tab . ' * @access public' . $this->newline;
                $string .= $this->tab . ' * @return void' . $this->newline;
                $string .= $this->tab . ' **/' . $this->newline;
                $string .= $this->tab . 'public function __construct(){' . $this->newline;
                $string .= $this->tab . $this->tab . '$this->options = get_option("' . $this->Plugin_Prefix . '_plugins"); // get current option';
                $string .= $this->newline;
                $string .= $init['php'];

                $string .= $this->tab . '}' . $this->newline;


                $string .= $this->tab . '/**' . $this->newline;
                $string .= $this->tab . ' * Create front-end' . $this->newline;
                $string .= $this->tab . ' * ' . $this->newline;
                $string .= $this->tab . ' * @param mixed $content ' . $this->newline;
                $string .= $this->tab . ' * @access public' . $this->newline;
                $string .= $this->tab . ' * @return $string $content' . $this->newline;
                $string .= $this->tab . ' **/' . $this->newline;
                $string .= $this->tab . 'public function Markup($content){' . $this->newline;

                $string .= $this->tab . $this->tab . '$new_content = null ;' . $this->newline;

                $string .= $this->tab . $this->tab . '//Display file path' . $this->newline;
                $string .= $this->tab . $this->tab . 'if(' . strtoupper($this->Plugin_ShortName) . '_DEBUG==true){' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . '$file_info = null; ' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "<p>You can edit the file below to fix the layout</p>" ; ' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "<div>" ; ' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "<pre style=\"color:rgba(255,0,0,1);padding:3px;margin:0px;background:rgba(255,0,0,0.1);border:1px solid rgba(255,0,0,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">%s:%s</pre>" ; ' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "</div>" ; ' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . 'printf($file_info,__FILE__,__LINE__);' . $this->newline;
                $string .= $this->tab . $this->tab . '}' . $this->newline;

                $string .= $layout['php'];
                $string .= $var_list['php'];

                $string .= $this->tab . $this->tab . '$new_content .= "<div class=\"' . ($this->Plugin_ShortName) . '-panel ' . ($this->Plugin_ShortName) . '-panel-default\">" ;' . $this->newline;
                $string .= $this->tab . $this->tab . '$new_content .= "<div class=\"' . ($this->Plugin_ShortName) . '-panel-body\">" ;' . $this->newline;
                $string .= $this->tab . $this->tab . '$new_content .= $content ;' . $this->newline;
                $string .= $this->tab . $this->tab . '$new_content .= "</div>" ;' . $this->newline;
                $string .= $this->tab . $this->tab . '$new_content .= "</div>" ;' . $this->newline;

                $string .= $this->tab . $this->tab . 'return $new_content;' . $this->newline;
                $string .= $this->tab . '}' . $this->newline;
                $string .= '}' . $this->newline;
                $this->addClass(array(
                    'code' => $string,
                    'path' => 'post_type.' . $post_type['name'] . '.inc.php',
                    'editable' => true));

            }
        } else
        {
            $this->post_types = array();
        }
    }
    /**
     * wpGenerator::codeAdminMenu()
     * 
     * @return
     */
    private function codeAdminMenu()
    {
        if (is_array($this->admin_menus))
        {
            $z = 45;
            foreach ($this->admin_menus as $admin_menu)
            {

                if ((isset($admin_menu['css'])) && ($admin_menu['css'] == '1'))
                {
                    $css_code = '/** CSS For Admin ' . $admin_menu['name'] . '**/';
                    $this->addFiles(array('path' => str_replace('_', '-', $this->Plugin_Prefix) . '/assets/css/' . $this->Plugin_ShortName . '_admin_' . $admin_menu['name'] . '.css', 'string' => $css_code));
                    $this->addCss(array(
                        'admin' => true,
                        'version' => $this->Version,
                        'src' => 'assets/css/' . $this->Plugin_ShortName . '_admin_' . $admin_menu['name'] . '.css',
                        'name' => 'admin_' . $admin_menu['name'],
                        'hooks' => array('toplevel_page_' . $admin_menu['name']),
                        ));
                }

                if ((isset($admin_menu['js'])) && ($admin_menu['js'] == '1'))
                {
                    $js_code = '/** JS For Widget ' . $admin_menu['name'] . '**/';
                    $this->addFiles(array('path' => str_replace('_', '-', $this->Plugin_Prefix) . '/assets/js/' . $this->Plugin_ShortName . '_admin_' . $admin_menu['name'] . '.js', 'string' => $js_code));
                    $this->addJs(array(
                        'admin' => true,
                        'version' => $this->Version,
                        'src' => 'assets/js/' . $this->Plugin_ShortName . '_admin_' . $admin_menu['name'] . '.js',
                        'name' => 'admin_' . $admin_menu['name'],
                        'deps' => array('jquery'),
                        'hooks' => array('toplevel_page_' . $admin_menu['name']),
                        ));
                }
                if (!isset($admin_menu['icon']))
                {
                    $admin_menu['icon'] = 'dashicons-smiley';
                }
                $arg['admin'] = true;
                $arg['construct'] = 'add_action("admin_menu", array($this, "' . $this->Plugin_ShortName . '_admin_menu_' . $admin_menu['name'] . '")); //create page admin';
                $arg['function'] = null;
                $arg['function'] .= $this->tab . '/**' . $this->newline;
                $arg['function'] .= $this->tab . ' * Add top level admin menu' . $this->newline;
                $arg['function'] .= $this->tab . ' * ' . $this->newline;
                $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                $arg['function'] .= $this->tab . ' **/' . $this->newline;
                $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_admin_menu_' . $admin_menu['name'] . '()' . $this->newline;
                $arg['function'] .= $this->tab . '{' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . 'add_menu_page(' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '__("' . addslashes($admin_menu['label']) . '","' . $this->Plugin_Lang . '"), //page title' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '__("' . addslashes($admin_menu['label']) . '","' . $this->Plugin_Lang . '"), //anchor link' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '"read",' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '"' . $admin_menu['name'] . '",' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . 'array($this,"' . $this->Plugin_ShortName . '_admin_menu_' . $admin_menu['name'] . '_markup"),' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '"' . $admin_menu['icon'] . '",' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $z . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . ');' . $this->newline;
                $arg['function'] .= $this->tab . '}' . $this->newline;
                $arg['function'] .= $this->newline;
                $arg['function'] .= $this->newline;
                $arg['function'] .= $this->tab . '/**' . $this->newline;
                $arg['function'] .= $this->tab . ' * Create markup for top level admin menu' . $this->newline;
                $arg['function'] .= $this->tab . ' * ' . $this->newline;
                $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                $arg['function'] .= $this->tab . ' **/' . $this->newline;
                $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_admin_menu_' . $admin_menu['name'] . '_markup()' . $this->newline;
                $arg['function'] .= $this->tab . '{' . $this->newline;
                $extend_class = str_replace(' ', '', ucwords(str_replace('_', ' ', $admin_menu['name'])));
                $arg['function'] .= $this->tab . $this->tab . 'if(file_exists(' . $this->Plugin_Const . '_PATH . "/includes/admin_menu.' . $admin_menu['name'] . '.inc.php' . '")){' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . 'require_once(' . $this->Plugin_Const . '_PATH . "/includes/admin_menu.' . $admin_menu['name'] . '.inc.php' . '");' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '$' . $admin_menu['name'] . '_admin_menu = new ' . $extend_class . '_adminMenu($this);' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . '$' . $admin_menu['name'] . '_admin_menu->Markup();' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
                $arg['function'] .= $this->tab . '}' . $this->newline;
                $this->addFunction($arg);
                $string = '<?php' . $this->newline;
                $string .= $this->newline;
                $string .= '/**' . $this->newline;
                $string .= ' * Top Level Admin Menu (' . $admin_menu['name'] . ')' . $this->newline;
                $string .= ' *' . $this->newline;
                $string .= '**/' . $this->newline;
                $string .= $this->newline;
                $string .= '# Exit if accessed directly' . $this->newline;
                $string .= 'if(!defined("' . $this->Plugin_Const . '_EXEC")){' . $this->newline;
                $string .= $this->tab . 'die();' . $this->newline;
                $string .= '}' . $this->newline;
                $string .= $this->newline;
                $string .= $this->newline;

                $string .= ' /**' . $this->newline;
                $string .= '  * Dispaly back-end admin menu ' . $admin_menu['name'] . $this->newline;
                $string .= '  * ' . $this->newline;
                $string .= '  * @package ' . $this->Plugin_Name . $this->newline;
                $string .= '  * @author ' . $this->Author . $this->newline;
                $string .= '  * @version ' . $this->Version . $this->newline;
                $string .= '  * @access public' . $this->newline;
                $string .= '  */' . $this->newline;
                $string .= $this->newline;
                $string .= 'class ' . $extend_class . '_adminMenu{' . $this->newline;
                $string .= $this->newline;
                $string .= $this->tab . '/**' . $this->newline;
                $string .= $this->tab . ' * Option Plugin' . $this->newline;
                $string .= $this->tab . ' * @access private' . $this->newline;
                $string .= $this->tab . ' **/' . $this->newline;
                $string .= $this->tab . 'private $options;' . $this->newline;

                $string .= $this->newline;

                $string .= $this->tab . '/**' . $this->newline;
                $string .= $this->tab . ' * Instance of a class' . $this->newline;
                $string .= $this->tab . ' * ' . $this->newline;
                $string .= $this->tab . ' * @access public' . $this->newline;
                $string .= $this->tab . ' * @return void' . $this->newline;
                $string .= $this->tab . ' **/' . $this->newline;
                $string .= $this->tab . 'function __construct(){' . $this->newline;
                $string .= $this->tab . $this->tab . '$this->options = get_option("' . $this->Plugin_Prefix . '_plugins"); // get current option';
                $string .= $this->newline;
                $string .= $this->tab . '}' . $this->newline;
                $string .= $this->newline;
                $string .= $this->tab . '/**' . $this->newline;
                $string .= $this->tab . ' * Create Admin Menu Markup' . $this->newline;
                $string .= $this->tab . ' * ' . $this->newline;
                $string .= $this->tab . ' * @access public' . $this->newline;
                $string .= $this->tab . ' * @return void' . $this->newline;
                $string .= $this->tab . ' **/' . $this->newline;
                $string .= $this->newline;
                $string .= $this->tab . 'public function Markup(){' . $this->newline;
                $string .= $this->newline;
                $string .= $this->tab . $this->tab . '// TODO: EDIT HTML ADMIN ' . strtoupper($admin_menu['name']) . '' . $this->newline;
                $string .= $this->tab . $this->tab . '/**' . $this->newline;
                $string .= $this->tab . $this->tab . '* You can make admin page here' . $this->newline;
                $string .= $this->tab . $this->tab . '**/' . $this->newline;
                $string .= $this->newline;
                $string .= $this->tab . $this->tab . 'echo "<div class=\"wrap\">";' . $this->newline;
                $string .= $this->tab . $this->tab . 'echo "<h2>" . __("' . addslashes($admin_menu['label']) . '","' . $this->Plugin_Lang . '") . "</h2>";' . $this->newline;

                $string .= $this->tab . $this->tab . '// Display file path' . $this->newline;
                $string .= $this->tab . $this->tab . 'if(' . strtoupper($this->Plugin_ShortName) . '_DEBUG==true){' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . '$file_info = null; ' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "<div>" ; ' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "<pre style=\"color:rgba(255,0,0,1);padding:3px;margin:0px;background:rgba(255,0,0,0.1);border:1px solid rgba(255,0,0,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">%s:%s</pre>" ; ' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "</div>" ; ' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . 'printf($file_info,__FILE__,__LINE__);' . $this->newline;
                $string .= $this->tab . $this->tab . '}' . $this->newline;

                if (isset($admin_menu['markup']))
                {
                    $string .= $this->tab . $this->tab . 'echo "' . addslashes($admin_menu['markup']) . '";' . $this->newline;
                } else
                {
                    $string .= $this->tab . $this->tab . 'echo "{{ADMIN-PAGE-CODE-HERE}}";' . $this->newline;
                }
                $string .= $this->tab . $this->tab . 'echo "</div>";' . $this->newline;
                $string .= $this->tab . '}' . $this->newline;
                $string .= '}' . $this->newline;
                $this->addClass(array('code' => $string, 'path' => 'admin_menu.' . $admin_menu['name'] . '.inc.php'));
                $z++;
            }
        } else
        {
            $this->admin_menus = array();
        }
    }
    /**
     * wpGenerator::codeWidget()
     * 
     * @return void
     */
    private function codeWidget()
    {
        $deps[] = 'jquery';
        $admin_deps[] = 'jquery';
        $js_admin_code = null;

        if (is_array($this->widgets))
        {
            foreach ($this->widgets as $widget)
            {
                if (!isset($widget['desc']))
                {
                    $widget['desc'] = '';
                }
                if (!isset($widget['title']))
                {
                    $widget['title'] = '';
                }

                $widgetID = $widget['id'];
                $widgetTitle = $widget['title'];
                $widgetDesc = $widget['desc'];
                $widgetCode = $widget['code'];
                $widgetPostType = $widget['post_type'];


                if ((isset($widget['css'])) && ($widget['css'] == '1'))
                {
                    $css_code = '/** CSS For Widget ' . $widgetTitle . '**/';
                    $this->addFiles(array('path' => str_replace('_', '-', $this->Plugin_Prefix) . '/assets/css/' . $this->Plugin_ShortName . '_widget_' . $widgetID . '.css', 'string' => $css_code));
                    $this->addCss(array(
                        'version' => $this->Version,
                        'src' => 'assets/css/' . $this->Plugin_ShortName . '_widget_' . $widgetID . '.css',
                        'name' => 'widget_' . $widgetID,
                        ));
                }

                if ((isset($widget['js'])) && ($widget['js'] == '1'))
                {
                    $js_code = '/** JS For Widget ' . $widgetTitle . '**/' . $this->newline;

                    $js_code .= '(function($)' . $this->newline;
                    $js_code .= '{' . $this->newline;
                    $js_code .= '' . $this->newline;
                    $js_code .= '})(jQuery);' . $this->newline;

                    $this->addFiles(array('path' => str_replace('_', '-', $this->Plugin_Prefix) . '/assets/js/' . $this->Plugin_ShortName . '_widget_' . $widgetID . '.js', 'string' => $js_code));
                    $this->addJs(array(
                        'version' => $this->Version,
                        'src' => 'assets/js/' . $this->Plugin_ShortName . '_widget_' . $widgetID . '.js',
                        'name' => 'widget_' . $widgetID,
                        'deps' => array('jquery'),
                        ));
                }

                if (!is_array($widget['option']))
                {
                    $widget['option'] = array();
                }
                $widgetOptions = $widget['option'];
                $className = str_replace(' ', '', ucwords(strtolower(str_replace('_', ' ', $widgetID))));
                $string = null;
                $string .= '<?php';
                $string .= $this->newline;
                $string .= '/**' . $this->newline;
                $string .= ' * Widget (' . ucwords($widgetTitle) . ')' . $this->newline;
                $string .= ' *' . $this->newline;
                $string .= '**/' . $this->newline;
                $string .= $this->newline;
                $string .= '# Exit if accessed directly' . $this->newline;
                $string .= 'if(!defined("' . $this->Plugin_Const . '_EXEC")){' . $this->newline;
                $string .= $this->tab . 'die();' . $this->newline;
                $string .= '}' . $this->newline;
                $string .= $this->newline;
                $string .= $this->newline;

                $string .= ' /**' . $this->newline;
                $string .= '  * Add widget ' . $widgetTitle . $this->newline;
                $string .= '  * ' . $this->newline;
                $string .= '  * @package ' . $this->Plugin_Name . $this->newline;
                $string .= '  * @author ' . $this->Author . $this->newline;
                $string .= '  * @version ' . $this->Version . $this->newline;
                $string .= '  * @access public' . $this->newline;
                $string .= '  * ' . $this->newline;
                $string .= '  * ' . $this->generator_by . $this->newline;
                $string .= '  */' . $this->newline;
                $string .= 'class ' . $className . '_Widget extends WP_Widget {' . $this->newline;
                $string .= $this->newline;
                $string .= $this->tab . '/**' . $this->newline;
                $string .= $this->tab . ' * Option Plugin' . $this->newline;
                $string .= $this->tab . ' * @access private' . $this->newline;
                $string .= $this->tab . ' **/' . $this->newline;
                $string .= $this->tab . 'private $options;' . $this->newline;
                $string .= $this->newline;
                $string .= $this->tab . '/**' . $this->newline;
                $string .= $this->tab . '* Register widget with WordPress.' . $this->newline;
                $string .= $this->tab . '*/' . $this->newline;
                $string .= $this->tab . 'function __construct() {' . $this->newline;
                $string .= $this->tab . $this->tab . 'parent::__construct(' . $this->newline;
                $string .= $this->tab . $this->tab . '"' . $widgetID . '", // Base ID' . $this->newline;
                $string .= $this->tab . $this->tab . '__("' . addslashes($widgetTitle) . '","' . $this->Plugin_Lang . '"), // Name' . $this->newline;
                $string .= $this->tab . $this->tab . 'array("description" => __("' . addslashes($widgetDesc) . '", "' . $this->Plugin_Lang . '"),) // Args' . $this->newline;
                $string .= $this->tab . $this->tab . ');' . $this->newline;
                $string .= $this->tab . $this->tab . '$this->options = get_option("' . $this->Plugin_Prefix . '_plugins"); // get current option' . $this->newline;
                $string .= $this->tab . '}' . $this->newline;
                $string .= $this->newline;
                $string .= $this->tab . '/**' . $this->newline;
                $string .= $this->tab . '* Front-end display of widget.' . $this->newline;
                $string .= $this->tab . '*' . $this->newline;
                $string .= $this->tab . '* @see WP_Widget::widget()' . $this->newline;
                $string .= $this->tab . '*' . $this->newline;
                $string .= $this->tab . '* @param array $args     Widget arguments.' . $this->newline;
                $string .= $this->tab . '* @param array $instance Saved values from database.' . $this->newline;
                $string .= $this->tab . '*/' . $this->newline;
                $string .= $this->tab . 'public function widget( $args, $instance ){' . $this->newline;

                $string .= $this->tab . $this->tab . '//TODO: WIDGET OPTION VARIABLE' . $this->newline;

                $string .= $this->tab . $this->tab . '/**' . $this->newline;
                $string .= $this->tab . $this->tab . '* @var string $instance["title"] - get widget title' . $this->newline;
                foreach ($widgetOptions as $widgetOption)
                {
                    if (isset($widgetOption['name']))
                    {
                        if ($widgetOption['name'] != '')
                        {
                            $string .= $this->tab . $this->tab . '* @var string $instance["' . $widgetOption['name'] . '"] - get widget option ' . $widgetOption['label'] . '' . $this->newline;
                        }
                    }
                }
                $string .= $this->tab . $this->tab . '**/' . $this->newline;
                $string .= $this->tab . $this->tab . $this->newline;
                $string .= $this->tab . $this->tab . 'echo $args["before_widget"];' . $this->newline;


                $string .= $this->tab . $this->tab . 'if (!empty($instance["title"])){' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . 'echo $args["before_title"]. apply_filters("widget_title", $instance["title"] ). $args["after_title"];' . $this->newline;
                $string .= $this->tab . $this->tab . '}' . $this->newline;


                // SAMPLE CODE
                $string .= $this->tab . $this->tab . '//Display file path' . $this->newline;
                $string .= $this->tab . $this->tab . 'if(' . strtoupper($this->Plugin_ShortName) . '_DEBUG==true){' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . '$file_info = null; ' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "<div>" ; ' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "<pre style=\"color:rgba(255,0,0,1);padding:3px;margin:0px;background:rgba(255,0,0,0.1);border:1px solid rgba(255,0,0,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">%s:%s</pre>" ; ' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "</div>" ; ' . $this->newline;
                $string .= $this->tab . $this->tab . $this->tab . 'printf($file_info,__FILE__,__LINE__);' . $this->newline;


                $string .= $this->tab . $this->tab . '}' . $this->newline;

                switch ($widgetCode)
                {
                    case 'wp_list_pages':
                        $sample_code_gen = new wpSampleCode($this->config);
                        $sample_code = $sample_code_gen->wp_list_pages(array(
                            'post_type' => $widgetPostType,
                            'image_sizes' => $this->image_sizes,
                            'metaboxs' => $this->metaboxs), 2);
                        $string .= $sample_code['php'];
                        $string .= $this->tab . $this->tab . 'echo $list_page;' . $this->newline;
                        break;
                    case 'get_posts':
                        $sample_code_gen = new wpSampleCode($this->config);
                        $sample_code = $sample_code_gen->get_posts(array(
                            'post_type' => $widgetPostType,
                            'image_sizes' => $this->image_sizes,
                            'metaboxs' => $this->metaboxs), 2);
                        $string .= $sample_code['php'];
                        break;
                }


                $string .= $this->tab . $this->tab . 'echo $args["after_widget"];' . $this->newline;
                $string .= $this->tab . '}' . $this->newline;
                $string .= $this->newline;
                $string .= $this->tab . '/**' . $this->newline;
                $string .= $this->tab . '* Back-end widget form.' . $this->newline;
                $string .= $this->tab . '*' . $this->newline;
                $string .= $this->tab . '* @see WP_Widget::form()' . $this->newline;
                $string .= $this->tab . '*' . $this->newline;
                $string .= $this->tab . '* @param array $instance Previously saved values from database.' . $this->newline;
                $string .= $this->tab . '*/' . $this->newline;
                $string .= $this->tab . 'public function form( $instance ) {' . $this->newline;

                $string .= $this->tab . $this->tab . '// Create Title' . $this->newline;
                $string .= $this->tab . $this->tab . '$title = ! empty( $instance["title"] ) ? $instance["title"] : __("' . addslashes($widgetTitle) . '", "' . $this->Plugin_Lang . '");' . $this->newline;


                $string .= $this->tab . $this->tab . 'echo "<p>";' . $this->newline;
                $string .= $this->tab . $this->tab . 'echo \'<label for="\'. $this->get_field_id("title" ).\'">\'. __("Title:") .\'</label>\';' . $this->newline;
                $string .= $this->tab . $this->tab . 'echo \'<input class="widefat" id="\'.  $this->get_field_id("title") .\'" name="\'. $this->get_field_name("title").\'" type="text" value="\' . esc_attr( $title ) . \'">\';' . $this->newline;
                $string .= $this->tab . $this->tab . 'echo "</p>";' . $this->newline;
                foreach ($widgetOptions as $widgetOption)
                {
                    if (isset($widgetOption['name']))
                    {
                        if ($widgetOption['name'] != '')
                        {

                            if (!isset($widgetOption['type']))
                            {
                                $widgetOption['type'] = 'text';
                            }

                            $string .= $this->tab . $this->tab . $this->newline;
                            $string .= $this->tab . $this->tab . $this->newline;

                            $string .= $this->tab . $this->tab . '/**' . $this->newline;
                            $string .= $this->tab . $this->tab . ' * CREATE ' . strtoupper($widgetOption['type'] . ' - ' . $widgetOption['name']) . $this->newline;
                            $string .= $this->tab . $this->tab . ' */' . $this->newline;

                            if (!isset($widgetOption['default']))
                            {
                                $widgetOption['default'] = '';
                            }

                            $string .= $this->tab . $this->tab . '$' . $widgetOption['name'] . ' = ! empty( $instance["' . $widgetOption['name'] . '"] ) ? $instance["' . $widgetOption['name'] . '"] : "";' . $this->newline;

                            $js_admin_code .= $this->newline;
                            $js_admin_code .= $this->tab . '/**' . $this->newline;
                            $js_admin_code .= $this->tab . ' * ' . strtoupper($widgetOption['name']) . $this->newline;
                            $js_admin_code .= $this->tab . ' **/' . $this->newline;

                            switch ($widgetOption['type'])
                            {
                                case 'text':

                                    $string .= $this->tab . $this->tab . 'echo "<p>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<label for="\'. $this->get_field_id("' . $widgetOption['name'] . '" ).\'">\'. __("' . $widgetOption['label'] . '", "' . $this->Plugin_Lang . '") .\'</label>\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<input class="widefat" id="\'.  $this->get_field_id("' . $widgetOption['name'] . '") .\'" name="\'. $this->get_field_name("' . $widgetOption['name'] . '").\'" type="text" value="\' . esc_attr( $' . $widgetOption['name'] . ' ) . \'" />\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo "</p>";' . $this->newline;
                                    break;
                                case 'textarea':

                                    $string .= $this->tab . $this->tab . 'echo "<p>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<label for="\'. $this->get_field_id("' . $widgetOption['name'] . '" ).\'">\'. __("' . $widgetOption['label'] . '", "' . $this->Plugin_Lang . '") .\'</label>\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<textarea class="widefat" id="\'.  $this->get_field_id("' . $widgetOption['name'] . '") .\'" name="\'. $this->get_field_name("' . $widgetOption['name'] . '").\'" >\' . esc_attr( $' . $widgetOption['name'] . ' ) . \'</textarea>\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo "</p>";' . $this->newline;
                                    break;
                                case 'checkbox':
                                    $string .= $this->tab . $this->tab . '$' . $widgetOption['name'] . '_checked = null;' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'if($' . $widgetOption['name'] . ' == "1" ){;' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '$' . $widgetOption['name'] . '_checked = \'checked="checked"\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . '}' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo "<p>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<input id="\'.  $this->get_field_id("' . $widgetOption['name'] . '") .\'" name="\'. $this->get_field_name("' . $widgetOption['name'] . '").\'" type="checkbox" value="1" \'. $' . $widgetOption['name'] . '_checked . \' />\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<label for="\'. $this->get_field_id("' . $widgetOption['name'] . '" ).\'">\'. __("' . $widgetOption['label'] . '", "' . $this->Plugin_Lang . '") .\'</label>\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo "</p>";' . $this->newline;
                                    break;

                                case 'select':
                                    $string .= $this->tab . $this->tab . '$' . $widgetOption['name'] . '_option = null;' . $this->newline;

                                    foreach ($widgetOption['enum'] as $enum)
                                    {
                                        if (!isset($enum['label']))
                                        {
                                            $enum['label'] = '';
                                        }
                                        if (!isset($enum['value']))
                                        {
                                            $enum['value'] = '';
                                        }
                                        $string .= $this->tab . $this->tab . '$' . $widgetOption['name'] . '_select_option[] = array("label"=>__("' . $enum['label'] . '", "' . $this->Plugin_Lang . '"),"value"=>"' . $enum['value'] . '");' . $this->newline;
                                    }

                                    $string .= $this->tab . $this->tab . 'foreach ($' . $widgetOption['name'] . '_select_option as $select_option){' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '$' . $widgetOption['name'] . '_selected ="";' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . 'if($' . $widgetOption['name'] . ' == $select_option["value"] ){' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . $this->tab . '$' . $widgetOption['name'] . '_selected = "selected=\"selected\"";' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '}' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '$' . $widgetOption['name'] . '_option .= "<option value=".$select_option["value"]." ".$' . $widgetOption['name'] . '_selected.">".$select_option["label"]."</option>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . '}' . $this->newline;

                                    $string .= $this->tab . $this->tab . 'echo "<p>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<label for="\'. $this->get_field_id("' . $widgetOption['name'] . '" ).\'">\'. __("' . $widgetOption['label'] . '", "' . $this->Plugin_Lang . '") .\'</label>\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<select class="widefat" id="\'.  $this->get_field_id("' . $widgetOption['name'] . '") .\'" name="\'. $this->get_field_name("' . $widgetOption['name'] . '").\'" >\'. $' . $widgetOption['name'] . '_option .\'</select>\';' . $this->newline;

                                    $string .= $this->tab . $this->tab . 'echo "</p>";' . $this->newline;
                                    break;

                                case 'radio':
                                    $string .= $this->tab . $this->tab . 'echo "<p>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<label for="\'. $this->get_field_id("' . $widgetOption['name'] . '" ).\'">\'. __("' . $widgetOption['label'] . '", "' . $this->Plugin_Lang . '") .\'</label>\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo "</p>";' . $this->newline;
                                    foreach ($widgetOption['enum'] as $enum)
                                    {
                                        if (!isset($enum['label']))
                                        {
                                            $enum['label'] = '';
                                        }
                                        if (!isset($enum['value']))
                                        {
                                            $enum['value'] = '';
                                        }
                                        $string .= $this->tab . $this->tab . '$' . $widgetOption['name'] . '_select_option[] = array("label"=>__("' . $enum['label'] . '", "' . $this->Plugin_Lang . '"),"value"=>"' . $enum['value'] . '");' . $this->newline;
                                    }

                                    $string .= $this->tab . $this->tab . 'foreach ($' . $widgetOption['name'] . '_select_option as $select_option){' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '$' . $widgetOption['name'] . '_checked ="";' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . 'if($' . $widgetOption['name'] . ' == $select_option["value"] ){' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . $this->tab . '$' . $widgetOption['name'] . '_checked = "checked=\"checked\"";' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '}' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . 'echo "<p><input  name=\"". $this->get_field_name("' . $widgetOption['name'] . '")."\"  value=".$select_option["value"]." ".$' . $widgetOption['name'] . '_checked." type=\"radio\" />".$select_option["label"]."</p>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . '}' . $this->newline;
                                    break;

                                case 'wp_dropdown_pages':

                                    $string .= $this->tab . $this->tab . '/**' . $this->newline;
                                    $string .= $this->tab . $this->tab . ' * HTML Drowndown Pages Using API' . $this->newline;
                                    $string .= $this->tab . $this->tab . ' * @see https://codex.wordpress.org/Function_Reference/wp_dropdown_pages' . $this->newline;
                                    $string .= $this->tab . $this->tab . ' */ ' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->newline;

                                    $string .= $this->tab . $this->tab . '$' . $widgetOption['name'] . '_args = array(' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"echo" => 0,' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"hide_empty" => 0,' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"name" => $this->get_field_name("' . $widgetOption['name'] . '"),' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"id" => $this->get_field_id("' . $widgetOption['name'] . '"),' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"class" => "widefat",' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"selected" => $' . $widgetOption['name'] . ',' . $this->newline;
                                    $string .= $this->tab . $this->tab . ');' . $this->newline;


                                    $string .= $this->tab . $this->tab . 'echo "<p>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<label for="\'. $this->get_field_id("' . $widgetOption['name'] . '" ).\'">\'. __("' . $widgetOption['label'] . '", "' . $this->Plugin_Lang . '") .\'</label>\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo wp_dropdown_pages($' . $widgetOption['name'] . '_args);' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo "</p>";' . $this->newline;

                                    break;

                                case 'wp_dropdown_categories':
                                    $string .= $this->tab . $this->tab . '/**' . $this->newline;
                                    $string .= $this->tab . $this->tab . ' * HTML Drowndown Categories Using API' . $this->newline;
                                    $string .= $this->tab . $this->tab . ' * @see https://codex.wordpress.org/Function_Reference/wp_dropdown_categories' . $this->newline;
                                    $string .= $this->tab . $this->tab . ' */ ' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->newline;
                                    $string .= $this->tab . $this->tab . '$' . $widgetOption['name'] . '_args = array(' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"echo" => 0,' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"hide_empty" => 0,' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"name" => $this->get_field_name("' . $widgetOption['name'] . '"),' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"id" => $this->get_field_id("' . $widgetOption['name'] . '"),' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"class" => "widefat",' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"selected" => $' . $widgetOption['name'] . ',' . $this->newline;
                                    $string .= $this->tab . $this->tab . ');' . $this->newline;


                                    $string .= $this->tab . $this->tab . 'echo "<p>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<label for="\'. $this->get_field_id("' . $widgetOption['name'] . '" ).\'">\'. __("' . $widgetOption['label'] . '", "' . $this->Plugin_Lang . '") .\'</label>\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo wp_dropdown_categories($' . $widgetOption['name'] . '_args);' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo "</p>";' . $this->newline;

                                    break;


                                case 'wp_dropdown_users':
                                    $string .= $this->tab . $this->tab . '/**' . $this->newline;
                                    $string .= $this->tab . $this->tab . ' * HTML Drowndown Users Using API' . $this->newline;
                                    $string .= $this->tab . $this->tab . ' * @see https://codex.wordpress.org/Function_Reference/wp_dropdown_users' . $this->newline;
                                    $string .= $this->tab . $this->tab . ' */ ' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->newline;
                                    $string .= $this->tab . $this->tab . '$' . $widgetOption['name'] . '_args = array(' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"echo" => 0,' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"hide_empty" => 0,' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"name" => $this->get_field_name("' . $widgetOption['name'] . '"),' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"id" => $this->get_field_id("' . $widgetOption['name'] . '"),' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"class" => "widefat",' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '"selected" => $' . $widgetOption['name'] . ',' . $this->newline;
                                    $string .= $this->tab . $this->tab . ');' . $this->newline;


                                    $string .= $this->tab . $this->tab . 'echo "<p>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<label for="\'. $this->get_field_id("' . $widgetOption['name'] . '" ).\'">\'. __("' . $widgetOption['label'] . '", "' . $this->Plugin_Lang . '") .\'</label>\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo wp_dropdown_users($' . $widgetOption['name'] . '_args);' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo "</p>";' . $this->newline;

                                    break;
                                case 'wpcolor':

                                    $admin_deps[] = 'wp-color-picker';
                                    $string .= $this->tab . $this->tab . '/**' . $this->newline;
                                    $string .= $this->tab . $this->tab . ' * Create HTML using wp-color-picker' . $this->newline;
                                    $string .= $this->tab . $this->tab . ' * @see https://codex.wordpress.org/Function_Reference/wp-color-picker' . $this->newline;
                                    $string .= $this->tab . $this->tab . '*/' . $this->newline;
                                    $string .= $this->tab . $this->newline;
                                    $string .= $this->tab . $this->tab . '// need these styles' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'wp_enqueue_style("wp-color-picker");' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo "<p>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<label for="\'. $this->get_field_id("' . $widgetOption['name'] . '" ).\'">\'. __("' . $widgetOption['label'] . '", "' . $this->Plugin_Lang . '") .\'</label>\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo "</p>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo "<p>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<input class="widefat ' . $widgetID . '_' . $widgetOption['name'] . '" id="\'.  $this->get_field_id("' . $widgetOption['name'] . '") .\'" name="\'. $this->get_field_name("' . $widgetOption['name'] . '").\'" type="text" value="\' . esc_attr( $' . $widgetOption['name'] . ' ) . \'" />\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo "</p>";' . $this->newline;

                                    $js_admin_code .= $this->tab . $this->newline;

                                    $js_admin_code .= $this->tab . '// color picker api' . $this->newline;
                                    $js_admin_code .= $this->tab . '$(function(){;' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . '$("input.' . $widgetID . '_' . $widgetOption['name'] . '").wpColorPicker({' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . 'change: _.throttle(function() {' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . '$(this).trigger("change");' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . '}, 3000)' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . '});' . $this->newline;

                                    $js_admin_code .= $this->tab . $this->tab . '// trick load color picker api after save' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . '$(document).ajaxComplete(function(){' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . '$("input.' . $widgetID . '_' . $widgetOption['name'] . '").wpColorPicker();' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . '});' . $this->newline;
                                    $js_admin_code .= $this->tab . '});' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->newline;
                                    break;

                                case 'wpmedia':
                                    $string .= $this->tab . $this->tab . 'wp_enqueue_media();' . $this->newline;
                                    $string .= $this->tab . $this->tab . '/**' . $this->newline;
                                    $string .= $this->tab . $this->tab . ' * Create HTML using wp-color-picker' . $this->newline;
                                    $string .= $this->tab . $this->tab . ' * @see https://codex.wordpress.org/Function_Reference/wp-color-picker' . $this->newline;
                                    $string .= $this->tab . $this->tab . '*/' . $this->newline;
                                    $string .= $this->tab . $this->newline;
                                    $string .= $this->tab . $this->tab . '$' . $widgetOption['name'] . '_preview = "<img />";' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'if($' . $widgetOption['name'] . '!=""){' . $this->newline;
                                    $string .= $this->tab . $this->tab . $this->tab . '$' . $widgetOption['name'] . '_preview = \'<img src="\' . esc_attr( $' . $widgetOption['name'] . ' ) . \'" style="max-width:100%;"/>\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . '}' . $this->newline;

                                    $string .= $this->tab . $this->tab . 'echo "<p>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<label for="\'. $this->get_field_id("' . $widgetOption['name'] . '" ).\'">\'. __("' . $widgetOption['label'] . '", "' . $this->Plugin_Lang . '") .\'</label>\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo "</p>";' . $this->newline;

                                    $string .= $this->tab . $this->tab . 'echo "<p>";' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<div id="\'.  $this->get_field_id("' . $widgetOption['name'] . '_preview") .\'">\' . $' . $widgetOption['name'] . '_preview. \'</div>\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<input class="widefat ' . $widgetOption['name'] . '" id="\'.  $this->get_field_id("' . $widgetOption['name'] . '") .\'" name="\'. $this->get_field_name("' . $widgetOption['name'] . '").\'" type="hidden" value="\' . esc_attr( $' . $widgetOption['name'] . ' ) . \'" />\';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<a class="button button-default ' . $widgetID . '_' . $widgetOption['name'] . '_upload" data-input="#\'.  $this->get_field_id("' . $widgetOption['name'] . '") .\'" data-preview="#\'.  $this->get_field_id("' . $widgetOption['name'] . '") .\'_preview">\'. __("Select Image", "' . $this->Plugin_Lang . '") .\'</a> \';' . $this->newline;
                                    $string .= $this->tab . $this->tab . 'echo \'<a class="button button-default ' . $widgetID . '_' . $widgetOption['name'] . '_remove" data-input="#\'.  $this->get_field_id("' . $widgetOption['name'] . '") .\'" data-preview="#\'.  $this->get_field_id("' . $widgetOption['name'] . '") .\'_preview">\'. __("Remove", "' . $this->Plugin_Lang . '") .\'</a> \';' . $this->newline;

                                    $string .= $this->tab . $this->tab . 'echo "</p>";' . $this->newline;

                                    $js_admin_code .= $this->tab . $this->newline;

                                    $js_admin_code .= $this->tab . '// wp media' . $this->newline;
                                    $js_admin_code .= $this->tab . '$(function(){' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . '$("body").on("click",".' . $widgetID . '_' . $widgetOption['name'] . '_upload",function(event){' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . 'event.preventDefault();' . $this->newline;

                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . 'var media_' . $widgetOption['name'] . '_upload ;' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . 'var media_' . $widgetOption['name'] . '_input = $(this).attr("data-input");' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . 'var media_' . $widgetOption['name'] . '_preview = $(this).attr("data-preview");' . $this->newline;

                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . 'if ( media_' . $widgetOption['name'] . '_upload ) {' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . 'media_' . $widgetOption['name'] . '_upload.open();' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . 'return;' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . '}' . $this->newline;

                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . '// Create a new media frame' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . 'media_' . $widgetOption['name'] . '_upload = wp.media({' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . 'title: "Select or Upload Media",' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . 'button: {' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . 'text: "Use this media"' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . '},' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . 'multiple: false  // Set to true to allow multiple files to be selected' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . '});' . $this->newline;

                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . 'media_' . $widgetOption['name'] . '_upload.on("select", function() {' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . 'var attachment = media_' . $widgetOption['name'] . '_upload.state().get("selection").first().toJSON();' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . '$(media_' . $widgetOption['name'] . '_input).val(attachment.url);' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . '$(media_' . $widgetOption['name'] . '_input).trigger("change");' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . '$(media_' . $widgetOption['name'] . '_preview).find("img").replaceWith("<img src=\"" + attachment.url + "\" style=\"max-width:100%;\"/>");' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . '});' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . 'media_' . $widgetOption['name'] . '_upload.open();' . $this->newline;

                                    $js_admin_code .= $this->tab . $this->tab . '});' . $this->newline;

                                    $js_admin_code .= $this->tab . $this->tab . '$("body").on("click",".' . $widgetID . '_' . $widgetOption['name'] . '_remove",function(event){' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . 'event.preventDefault();' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . 'var media_' . $widgetOption['name'] . '_input = $(this).attr("data-input");' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . 'var media_' . $widgetOption['name'] . '_preview = $(this).attr("data-preview");' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . '$(media_' . $widgetOption['name'] . '_input).val("");' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . '$(media_' . $widgetOption['name'] . '_input).trigger("change");' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . $this->tab . $this->tab . '$(media_' . $widgetOption['name'] . '_preview).find("img").replaceWith("<img style=\"max-width:100%;\"/>");' . $this->newline;

                                    $js_admin_code .= $this->tab . $this->tab . '});' . $this->newline;

                                    $js_admin_code .= $this->tab . $this->tab . '// trick load again after save' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . '$(document).ajaxComplete(function(){' . $this->newline;
                                    $js_admin_code .= $this->tab . $this->tab . '});' . $this->newline;
                                    $js_admin_code .= $this->tab . '});' . $this->newline;

                                    $js_admin_code .= $this->tab . $this->newline;
                                    break;


                                    break;
                            }
                        }
                    }
                }
                $string .= $this->tab . '}' . $this->newline;
                $string .= $this->newline;
                $string .= $this->tab . '/**' . $this->newline;
                $string .= $this->tab . '* Sanitize widget form values as they are saved.' . $this->newline;
                $string .= $this->tab . '*' . $this->newline;
                $string .= $this->tab . '* @see WP_Widget::update()' . $this->newline;
                $string .= $this->tab . '*' . $this->newline;
                $string .= $this->tab . '* @param array $new_instance Values just sent to be saved.' . $this->newline;
                $string .= $this->tab . '* @param array $old_instance Previously saved values from database.' . $this->newline;
                $string .= $this->tab . '*' . $this->newline;
                $string .= $this->tab . '* @return array Updated safe values to be saved.' . $this->newline;
                $string .= $this->tab . '*/' . $this->newline;
                $string .= $this->tab . 'public function update( $new_instance, $old_instance ) {' . $this->newline;
                if (!isset($widgetOption['default']))
                {
                    $widgetOption['default'] = '';
                }
                $string .= $this->tab . $this->tab . '$instance = array();' . $this->newline;
                $string .= $this->tab . $this->tab . '$instance["title"] = ( ! empty( $new_instance["title"] ) ) ? strip_tags( $new_instance["title"] ) : "' . $widgetOption['default'] . '";' . $this->newline;
                foreach ($widgetOptions as $widgetOption)
                {
                    if (!isset($widgetOption['name']))
                    {
                        $widgetOption['name'] = '';
                    }
                    if (!isset($widgetOption['default']))
                    {
                        $widgetOption['default'] = '';
                    }
                    if (!isset($widgetOption['explanation']))
                    {
                        $widgetOption['explanation'] = '';
                    }
                    if ($widgetOption['name'] != '')
                    {
                        if (!isset($widgetOption['type']))
                        {
                            $widgetOption['type'] = 'text';
                        }
                        switch ($widgetOption['type'])
                        {
                            case 'text':
                                $string .= $this->tab . $this->tab . '$instance["' . $widgetOption['name'] . '"] = (!empty($new_instance["' . $widgetOption['name'] . '"] ) ) ? strip_tags($new_instance["' . $widgetOption['name'] . '"]) : "' . $widgetOption['default'] . '";' . $this->newline;
                                break;
                            case 'textarea':
                                $string .= $this->tab . $this->tab . '$instance["' . $widgetOption['name'] . '"] = (!empty($new_instance["' . $widgetOption['name'] . '"] ) ) ? strip_tags($new_instance["' . $widgetOption['name'] . '"]) : "' . $widgetOption['default'] . '";' . $this->newline;
                                break;
                            case 'checkbox':
                                $string .= $this->tab . $this->tab . '$instance["' . $widgetOption['name'] . '"] = (!empty($new_instance["' . $widgetOption['name'] . '"] ) ) ? "1" : "0";' . $this->newline;
                                break;
                            case 'select':
                                $string .= $this->tab . $this->tab . '$instance["' . $widgetOption['name'] . '"] = (!empty($new_instance["' . $widgetOption['name'] . '"] ) ) ? strip_tags($new_instance["' . $widgetOption['name'] . '"]) : "' . $widgetOption['default'] . '";' . $this->newline;
                                break;
                            case 'radio':
                                $string .= $this->tab . $this->tab . '$instance["' . $widgetOption['name'] . '"] = (!empty($new_instance["' . $widgetOption['name'] . '"] ) ) ? strip_tags($new_instance["' . $widgetOption['name'] . '"]) : "' . $widgetOption['default'] . '";' . $this->newline;
                                break;
                            case 'wp_dropdown_pages':
                                $string .= $this->tab . $this->tab . '$instance["' . $widgetOption['name'] . '"] = (!empty($new_instance["' . $widgetOption['name'] . '"] ) ) ? strip_tags($new_instance["' . $widgetOption['name'] . '"]) : "' . $widgetOption['default'] . '";' . $this->newline;
                                break;
                            case 'wp_dropdown_categories':
                                $string .= $this->tab . $this->tab . '$instance["' . $widgetOption['name'] . '"] = (!empty($new_instance["' . $widgetOption['name'] . '"] ) ) ? strip_tags($new_instance["' . $widgetOption['name'] . '"]) : "' . $widgetOption['default'] . '";' . $this->newline;
                                break;
                            case 'wp_dropdown_users':
                                $string .= $this->tab . $this->tab . '$instance["' . $widgetOption['name'] . '"] = (!empty($new_instance["' . $widgetOption['name'] . '"] ) ) ? strip_tags($new_instance["' . $widgetOption['name'] . '"]) : "' . $widgetOption['default'] . '";' . $this->newline;
                                break;
                            case 'wpcolor':
                                $string .= $this->tab . $this->tab . '$instance["' . $widgetOption['name'] . '"] = (!empty($new_instance["' . $widgetOption['name'] . '"] ) ) ? strip_tags($new_instance["' . $widgetOption['name'] . '"]) : "' . $widgetOption['default'] . '";' . $this->newline;
                                break;
                            case 'wpmedia':
                                $string .= $this->tab . $this->tab . '$instance["' . $widgetOption['name'] . '"] = (!empty($new_instance["' . $widgetOption['name'] . '"] ) ) ? strip_tags($new_instance["' . $widgetOption['name'] . '"]) : "' . $widgetOption['default'] . '";' . $this->newline;
                                break;
                        }
                    }
                }

                $string .= $this->tab . $this->tab . '' . $this->newline;
                $string .= $this->tab . $this->tab . 'return $instance;' . $this->newline;
                $string .= $this->tab . '}' . $this->newline;
                $string .= $this->tab . '' . $this->newline;
                $string .= '}  ' . $this->newline;
                $this->addClass(array(
                    'code' => $string,
                    'path' => 'widget.' . $widgetID . '.inc.php',
                    'editable' => true));
                $arg['construct'] = 'add_action("widgets_init", array($this, "' . $this->Plugin_ShortName . '_widget_' . $widgetID . '_init")); //init widget';
                $arg['function'] = null;
                $arg['function'] .= $this->tab . '/**' . $this->newline;
                $arg['function'] .= $this->tab . ' * Register new widget (' . $widgetID . ')' . $this->newline;
                $arg['function'] .= $this->tab . ' *' . $this->newline;
                $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                $arg['function'] .= $this->tab . ' **/' . $this->newline;
                $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_widget_' . $widgetID . '_init()' . $this->newline;
                $arg['function'] .= $this->tab . '{' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . 'if(file_exists(' . $this->Plugin_Const . '_PATH . "/includes/widget.' . $widgetID . '.inc.php' . '")){' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . 'require_once(' . $this->Plugin_Const . '_PATH . "/includes/widget.' . $widgetID . '.inc.php' . '");' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . 'register_widget("' . $className . '_Widget");' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
                $arg['function'] .= $this->tab . '}' . $this->newline;
                $this->addFunction($arg);


            }

            $arg = null;
            $arg['admin'] = true;
            //$arg['hooks'] = array_unique($css_hooks);
            $arg['src'] = $arg['code'] = $arg['function'] = $arg['construct'] = null;
            $arg['src'] = 'assets/js/' . $this->Plugin_ShortName . '_admin_widget.js';

            $arg['code'] .= '/**' . $this->newline;
            $arg['code'] .= ' * @Author :' . $this->Author . $this->newline;
            $arg['code'] .= ' * @Author URL : ' . $this->Author_URI . $this->newline;
            $arg['code'] .= ' * @License : ' . $this->License . $this->newline;
            $arg['code'] .= ' * @License URL: ' . $this->License_URI . $this->newline;
            $arg['code'] .= ' *' . $this->newline;
            $arg['code'] .= ' * @Package : ' . $this->Plugin_Name . $this->newline;
            $arg['code'] .= ' * @Version : ' . $this->Version . $this->newline;
            $arg['code'] .= '**/' . $this->newline;
            $arg['code'] .= $this->newline;
            $arg['code'] .= $this->newline;

            $arg['code'] .= '(function($)' . $this->newline;
            $arg['code'] .= '{' . $this->newline;

            //$arg['code'] .= $this->tab . '// avoid undefined error' . $this->newline;
            //$arg['code'] .= $this->tab . 'if( typeof _ == "undefined"){' . $this->newline;
            //$arg['code'] .= $this->tab . $this->tab . 'var _ = {throttle : (function(){})};' . $this->newline;
            //$arg['code'] .= $this->tab . '}' . $this->newline;

            $arg['code'] .= $js_admin_code;
            $arg['code'] .= '})(jQuery);' . $this->newline;
            $arg['name'] = 'admin_widget';
            $arg['version'] = $this->Version;
            $arg['deps'] = array_unique($admin_deps);
            $arg['for'] = 'JS for admin widget';
            if (count($this->widgets) != 0)
            {
                $this->addJs($arg);
            }


        } else
        {
            $this->widgets = array();
        }
    }
    /**
     * wpGenerator::codeTextDomain()
     * 
     * @return void
     */
    private function codeTextDomain()
    {

        $string = null;
        $plugin_dirname = str_replace('_', '-', $this->Plugin_Prefix);

        $string .= 'Create a file POT, PO and MO using POEdit or Loco Translate Plugin, ' . $this->newline;
        $string .= 'then rename accordance with textdomain used by the plugin, as follows:' . $this->newline;
        $string .= $this->newline;
        $string .= '* ' . $plugin_dirname . '-de_DE.po' . $this->newline;
        $string .= '* ' . $plugin_dirname . '-id_ID.po' . $this->newline;
        $string .= '* ' . $plugin_dirname . '-es_ES.po' . $this->newline;
        $string .= '* ' . $plugin_dirname . '-en_US.po' . $this->newline;
        $string .= $this->newline;
        $string .= '* ' . $plugin_dirname . '-de_DE.mo' . $this->newline;
        $string .= '* ' . $plugin_dirname . '-id_ID.mo' . $this->newline;
        $string .= '* ' . $plugin_dirname . '-es_ES.mo' . $this->newline;
        $string .= '* ' . $plugin_dirname . '-en_US.mo' . $this->newline;
        $string .= $this->newline;
        $string .= $this->newline;
        $string .= 'Download:' . $this->newline;
        $string .= '* http://wordpress.org/extend/plugins/loco-translate' . $this->newline;
        $string .= '* http://poedit.net/download' . $this->newline;

        $this->addFiles(array('path' => $plugin_dirname . '/languages/readme.txt', 'string' => $string));

        $arg['construct'] = 'add_action("plugins_loaded", array($this, "' . $this->Plugin_ShortName . '_textdomain")); //load language/textdomain';
        $arg['function'] = null;
        $arg['function'] .= $this->tab . '/**' . $this->newline;
        $arg['function'] .= $this->tab . ' * Loads the plugin\'s translated strings' . $this->newline;
        $arg['function'] .= $this->tab . ' * @link http://codex.wordpress.org/Function_Reference/load_plugin_textdomain' . $this->newline;
        $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
        $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
        $arg['function'] .= $this->tab . ' **/' . $this->newline;
        $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_textdomain()' . $this->newline;
        $arg['function'] .= $this->tab . '{' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . 'load_plugin_textdomain("' . $plugin_dirname . '", false, ' . $this->Plugin_Const . '_DIR . "/languages");' . $this->newline;
        $arg['function'] .= $this->tab . '}' . $this->newline;
        $this->addFunction($arg);
    }
    /**
     * wpGenerator::codeActivation()
     * 
     * @return void
     */
    private function codeActivation()
    {
        $arg['function'] = null;
        $arg['admin'] = true;
        $arg['function'] .= $this->tab . '/**' . $this->newline;
        $arg['function'] .= $this->tab . ' * Install Plugin' . $this->newline;
        $arg['function'] .= $this->tab . ' * ' . $this->newline;
        $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
        $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
        $arg['function'] .= $this->tab . ' **/' . $this->newline;
        $arg['function'] .= $this->tab . 'public static function ' . $this->Plugin_ShortName . '_activation()' . $this->newline;
        $arg['function'] .= $this->tab . '{' . $this->newline;
        if (count($this->options) != 0)
        {
            $arg['function'] .= $this->tab . $this->tab . '$default_option = array(' . $this->newline;
            foreach ($this->options as $option)
            {
                if (!isset($option['default']))
                {
                    $option['default'] = '';
                }
                $arg['function'] .= $this->tab . $this->tab . $this->tab . "'" . $option['name'] . "'=>'" . $option['default'] . "'," . $this->newline;
            }
            $arg['function'] .= $this->tab . $this->tab . ');' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . 'update_option("' . $this->Plugin_Prefix . '_plugins",$default_option);' . $this->newline;
        } else
        {
            $arg['function'] .= $this->tab . $this->tab . '// CODE ACTIVATION HERE' . $this->newline;
        }
        $arg['function'] .= $this->tab . '}' . $this->newline;
        $arg['function'] .= $this->newline;
        $arg['function'] .= $this->newline;
        $arg['function'] .= $this->tab . '/**' . $this->newline;
        $arg['function'] .= $this->tab . ' * Un-install Plugin' . $this->newline;
        $arg['function'] .= $this->tab . ' * ' . $this->newline;
        $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
        $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
        $arg['function'] .= $this->tab . ' **/' . $this->newline;
        $arg['function'] .= $this->tab . 'public static function ' . $this->Plugin_ShortName . '_deactivation()' . $this->newline;
        $arg['function'] .= $this->tab . '{' . $this->newline;
        if (count($this->options) != 0)
        {
            $arg['function'] .= $this->tab . $this->tab . 'delete_option("' . $this->Plugin_Prefix . '_plugins");' . $this->newline;
        } else
        {
            $arg['function'] .= $this->tab . $this->tab . '// CODE DE-ACTIVATION HERE' . $this->newline;
        }
        $arg['function'] .= $this->tab . '}' . $this->newline;
        $this->addFunction($arg);
    }


    /**
     * wpGenerator::codeHeadJs()
     * 
     * @return void
     */
    private function codeHeadJs()
    {
        if (is_array($this->head_js))
        {
            $arg = null;
            $arg['function'] = $arg['construct'] = null;
            $arg['admin'] = false;
            $arg['construct'] .= 'add_action("wp_head",array($this,"' . $this->Plugin_ShortName . '_dinamic_js"),1); //load dinamic js';

            $arg['function'] .= $this->tab . '/**' . $this->newline;
            $arg['function'] .= $this->tab . ' * Insert Dinamic JS' . $this->newline;
            $arg['function'] .= $this->tab . ' * @param object $hooks' . $this->newline;
            $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
            $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
            $arg['function'] .= $this->tab . ' **/' . $this->newline;
            $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_dinamic_js($hooks)' . $this->newline;
            $arg['function'] .= $this->tab . '{' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . '_e("<script type=\"text/javascript\">");' . $this->newline;
            foreach ($this->head_js as $head_js)
            {
                $arg['function'] .= $this->tab . $this->tab . $head_js['string'];
            }
            $arg['function'] .= $this->tab . $this->tab . '_e("</script>");' . $this->newline;
            $arg['function'] .= $this->tab . '}' . $this->newline;
            $this->addFunction($arg);
        }
    }

    /**
     * wpGenerator::codeCSS()
     * 
     * @return void
     */
    private function codeCSS()
    {

        if (is_array($this->styles))
        {
            $arg = null;
            $arg['function'] = $arg['construct'] = null;
            $arg['admin'] = true;
            $arg['construct'] .= 'add_action("admin_enqueue_scripts",array($this,"' . $this->Plugin_ShortName . '_admin_enqueue_styles")); //add css for admin';
            $arg['function'] .= $this->tab . '/**' . $this->newline;
            $arg['function'] .= $this->tab . ' * Insert CSS for back-end' . $this->newline;
            $arg['function'] .= $this->tab . ' * ' . $this->newline;
            $arg['function'] .= $this->tab . ' * @link http://codex.wordpress.org/Function_Reference/wp_register_style' . $this->newline;
            $arg['function'] .= $this->tab . ' * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_style' . $this->newline;
            $arg['function'] .= $this->tab . ' * @param object $hooks' . $this->newline;
            $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
            $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
            $arg['function'] .= $this->tab . ' **/' . $this->newline;
            $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_admin_enqueue_styles($hooks)' . $this->newline;
            $arg['function'] .= $this->tab . '{' . $this->newline;

            $arg['function'] .= $this->tab . $this->tab . 'if (function_exists("get_current_screen")) {' . $this->newline;
            $arg["function"] .= $this->tab . $this->tab . $this->tab . '$screen = get_current_screen();' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . '}else{' . $this->newline;
            $arg["function"] .= $this->tab . $this->tab . $this->tab . '$screen = $hooks;' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;

            foreach ($this->styles as $style)
            {
                $name = $style['name'];
                if (!isset($style['admin']))
                {
                    $style['admin'] = false;
                }
                if ($style['admin'] == true)
                {
                    if (!isset($style['version']))
                    {
                        $style['version'] = $this->Version;
                    }
                    if ($style['version'] == '')
                    {
                        $style['version'] = $this->Version;
                    }
                    $arg['function'] .= $this->tab . $this->tab . '// register css' . $this->newline;
                    if (preg_match("/http:|https:/", $style['src']))
                    {
                        $arg['function'] .= $this->tab . $this->tab . 'wp_register_style("' . $this->Plugin_ShortName . '_' . $name . '",  "' . $style['src'] . '",array(),"' . $style['version'] . '" );' . $this->newline;
                    } else
                    {
                        $arg['function'] .= $this->tab . $this->tab . 'wp_register_style("' . $this->Plugin_ShortName . '_' . $name . '", ' . $this->Plugin_Const . '_URL . "' . $style['src'] . '",array(),"' . $style['version'] . '" );' . $this->newline;
                    }
                    if (!isset($style['hooks']))
                    {
                        $style['hooks'] = array();
                    }
                    if (count($style['hooks']) != 0)
                    {
                        $arg['function'] .= $this->tab . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '// limit page' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . 'if(( in_array($hooks,array("' . implode('","', $style['hooks']) . '")))||( in_array($screen->post_type,array("' . implode('","', $style['hooks']) . '")))){' . $this->newline;
                    }
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . 'wp_enqueue_style("' . $this->Plugin_ShortName . '_' . $name . '");' . $this->newline;
                    if (count($style['hooks']) != 0)
                    {
                        $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
                    }
                }
            }
            $arg['function'] .= $this->tab . '}' . $this->newline;
            $this->addFunction($arg);
            $arg = null;
            $arg['function'] = $arg['construct'] = null;
            $arg['construct'] .= 'add_action("wp_enqueue_scripts",array($this,"' . $this->Plugin_ShortName . '_enqueue_styles")); //add css';
            $arg['function'] .= $this->tab . '/**' . $this->newline;
            $arg['function'] .= $this->tab . ' * Insert CSS for front-end' . $this->newline;
            $arg['function'] .= $this->tab . ' * ' . $this->newline;
            $arg['function'] .= $this->tab . ' * @link http://codex.wordpress.org/Function_Reference/wp_register_style' . $this->newline;
            $arg['function'] .= $this->tab . ' * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_style' . $this->newline;
            $arg['function'] .= $this->tab . ' * @param object $hooks' . $this->newline;
            $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
            $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
            $arg['function'] .= $this->tab . ' **/' . $this->newline;
            $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_enqueue_styles($hooks)' . $this->newline;
            $arg['function'] .= $this->tab . '{' . $this->newline;
            foreach ($this->styles as $style)
            {
                $name = $style['name'];
                if (!isset($style['admin']))
                {
                    $style['admin'] = false;
                }
                if ($style['admin'] == false)
                {
                    if (!isset($style['version']))
                    {
                        $style['version'] = $this->Version;
                    }
                    if ($style['version'] == '')
                    {
                        $style['version'] = $this->Version;
                    }
                    $arg['function'] .= $this->tab . $this->tab . '// register css' . $this->newline;
                    if (preg_match("/http:|https:/", $style['src']))
                    {
                        $arg['function'] .= $this->tab . $this->tab . 'wp_register_style("' . $this->Plugin_ShortName . '_' . $name . '",  "' . $style['src'] . '",array(),"' . $style['version'] . '" );' . $this->newline;
                    } else
                    {
                        $arg['function'] .= $this->tab . $this->tab . 'wp_register_style("' . $this->Plugin_ShortName . '_' . $name . '", ' . $this->Plugin_Const . '_URL . "' . $style['src'] . '",array(),"' . $style['version'] . '" );' . $this->newline;
                    }
                    if (!isset($style['hooks']))
                    {
                        $style['hooks'] = array();
                    }

                    $arg['function'] .= $this->tab . $this->tab . $this->tab . 'wp_enqueue_style("' . $this->Plugin_ShortName . '_' . $name . '");' . $this->newline;

                }
            }
            $arg['function'] .= $this->tab . '}' . $this->newline;
            $this->addFunction($arg);
        } else
        {
            $this->styles = array();
        }
    }
    /**
     * wpGenerator::codeJS()
     * 
     * @return void
     */
    private function codeJS()
    {
        if (is_array($this->javascripts))
        {
            $arg = null;
            $arg['function'] = $arg['construct'] = null;
            $arg['admin'] = true;
            $arg['construct'] .= 'add_action("admin_enqueue_scripts",array($this,"' . $this->Plugin_ShortName . '_admin_enqueue_scripts")); //add js for admin';
            $arg['function'] .= $this->tab . '/**' . $this->newline;
            $arg['function'] .= $this->tab . ' * Insert javascripts for back-end' . $this->newline;
            $arg['function'] .= $this->tab . ' * ' . $this->newline;
            $arg['function'] .= $this->tab . ' * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script' . $this->newline;
            $arg['function'] .= $this->tab . ' * @param object $hooks' . $this->newline;
            $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
            $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
            $arg['function'] .= $this->tab . ' **/' . $this->newline;
            $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_admin_enqueue_scripts($hooks)' . $this->newline;
            $arg['function'] .= $this->tab . '{' . $this->newline;

            $arg['function'] .= $this->tab . $this->tab . 'if (function_exists("get_current_screen")) {' . $this->newline;
            $arg["function"] .= $this->tab . $this->tab . $this->tab . '$screen = get_current_screen();' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . '}else{' . $this->newline;
            $arg["function"] .= $this->tab . $this->tab . $this->tab . '$screen = $hooks;' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;

            foreach ($this->javascripts as $javascript)
            {
                if (!isset($javascript['name']))
                {
                    $javascript['name'] = md5(rand(999, 10000));
                }
                if (!isset($javascript['admin']))
                {
                    $javascript['admin'] = false;
                }
                if ($javascript['admin'] == true)
                {
                    if (!isset($javascript['version']))
                    {
                        $javascript['version'] = $this->Version;
                    }
                    if ($javascript['version'] == '')
                    {
                        $javascript['version'] = $this->Version;
                    }
                    if (!is_array($javascript['deps']))
                    {
                        $javascript['deps'] = array();
                    }
                    if (!isset($javascript['hooks']))
                    {
                        $javascript['hooks'] = array();
                    }
                    if (!is_array($javascript['hooks']))
                    {
                        $javascript['hooks'] = array();
                    }

                    if (count($javascript['hooks']) != 0)
                    {
                        $arg['function'] .= $this->tab . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '// limit page only ' . implode(', ', $javascript['hooks']) . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . 'if(( in_array($hooks,array("' . implode('","', $javascript['hooks']) . '")))||( in_array($screen->post_type,array("' . implode('","', $javascript['hooks']) . '")))){' . $this->newline;
                    }


                    if (preg_match("/http:|https:/", $javascript['src']))
                    {
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . 'wp_enqueue_script("' . $this->Plugin_ShortName . '_' . $javascript['name'] . '", "' . $javascript['src'] . '", array("' . implode('","', $javascript['deps']) . '"),"' . $javascript['version'] . '",true );' . $this->newline;
                    } else
                    {
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . 'wp_enqueue_script("' . $this->Plugin_ShortName . '_' . $javascript['name'] . '", ' . $this->Plugin_Const . '_URL . "' . $javascript['src'] . '", array("' . implode('","', $javascript['deps']) . '"),"' . $javascript['version'] . '",true );' . $this->newline;
                    }


                    if (count($javascript['hooks']) != 0)
                    {
                        $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
                    }


                }
            }
            $arg['function'] .= $this->tab . '}' . $this->newline;
            $this->addFunction($arg);
            $arg = null;
            $arg['function'] = $arg['construct'] = null;
            $arg['construct'] .= 'add_action("wp_enqueue_scripts",array($this,"' . $this->Plugin_ShortName . '_enqueue_scripts")); //add js';
            $arg['function'] .= $this->tab . '/**' . $this->newline;
            $arg['function'] .= $this->tab . ' * Insert javascripts for front-end' . $this->newline;
            $arg['function'] .= $this->tab . ' * ' . $this->newline;
            $arg['function'] .= $this->tab . ' * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script' . $this->newline;
            $arg['function'] .= $this->tab . ' * @param object $hooks' . $this->newline;
            $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
            $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
            $arg['function'] .= $this->tab . ' **/' . $this->newline;
            $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_enqueue_scripts($hooks)' . $this->newline;
            $arg['function'] .= $this->tab . '{' . $this->newline;

            foreach ($this->javascripts as $javascript)
            {
                if (!isset($javascript['name']))
                {
                    $javascript['name'] = md5(rand(999, 10000));
                }
                if (!isset($javascript['admin']))
                {
                    $javascript['admin'] = false;
                }
                if ($javascript['admin'] == false)
                {
                    if (!isset($javascript['version']))
                    {
                        $javascript['version'] = $this->Version;
                    }
                    if ($javascript['version'] == '')
                    {
                        $javascript['version'] = $this->Version;
                    }
                    if (!isset($javascript['deps']))
                    {
                        $javascript['deps'] = array();
                    }
                    if (!is_array($javascript['deps']))
                    {
                        $javascript['deps'] = array();
                    }
                    if (!isset($javascript['hooks']))
                    {
                        $javascript['hooks'] = array();
                    }

                    if (!is_array($javascript['hooks']))
                    {
                        $javascript['hooks'] = array();
                    }


                    if (preg_match("/http:|https:/", $javascript['src']))
                    {
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . 'wp_enqueue_script("' . $this->Plugin_ShortName . '_' . $javascript['name'] . '", "' . $javascript['src'] . '", array("' . implode('","', array_unique($javascript['deps'])) . '"),"' . $javascript['version'] . '",true );' . $this->newline;
                    } else
                    {
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . 'wp_enqueue_script("' . $this->Plugin_ShortName . '_' . $javascript['name'] . '", ' . $this->Plugin_Const . '_URL . "' . $javascript['src'] . '", array("' . implode('","', array_unique($javascript['deps'])) . '"),"' . $javascript['version'] . '",true );' . $this->newline;
                    }


                }
            }
            $arg['function'] .= $this->tab . '}' . $this->newline;
            $this->addFunction($arg);
        } else
        {
            $this->javascripts = array();
        }
    }
    /**
     * wpGenerator::codeMetabox()
     * 
     * @return void
     */
    private function codeMetabox()
    {
        if (is_array($this->metaboxs))
        {
            $deps[] = 'jquery';
            $css_code = $js_code = null;
            foreach ($this->metaboxs as $metabox)
            {
                $css_code .= '/** css for ' . $metabox['name'] . ' Toolbox **/' . $this->newline;
                if (!isset($metabox['markup']))
                {
                    $metabox['markup'] = '{{METABOX-CODE-HERE}}';
                }
                $post_meta_hit = 0;
                foreach ($metabox['post_meta'] as $post_meta)
                {
                    if (isset($post_meta['name']))
                    {
                        if ($post_meta['name'] != '')
                        {
                            $post_meta_hit++;
                        }
                    }
                }
                if (!isset($metabox['hooks']))
                {
                    $metabox['hooks'] = array('dashboard');
                }
                if (preg_match("/dashboard/", implode('', $metabox['hooks'])))
                {
                    $css_hooks[] = 'index.php';
                    $arg['function'] = $arg['construct'] = null;
                    $arg['admin'] = true;
                    $arg['construct'] .= 'add_action("wp_dashboard_setup",array($this,"' . $this->Plugin_ShortName . '_widget_' . $metabox['name'] . '_dashboard")); //add dashboard widget' . $metabox['label'];
                    $arg['function'] .= $this->tab . '/**' . $this->newline;
                    $arg['function'] .= $this->tab . ' * Add dashboard widget (' . $metabox['name'] . ')' . $this->newline;
                    $arg['function'] .= $this->tab . ' * ' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @link http://codex.wordpress.org/Function_Reference/wp_add_dashboard_widget' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                    $arg['function'] .= $this->tab . ' **/' . $this->newline;
                    $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_widget_' . $metabox['name'] . '_dashboard()' . $this->newline;
                    $arg['function'] .= $this->tab . '{' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . 'wp_add_dashboard_widget("' . $this->Plugin_ShortName . '_widget_' . $metabox['name'] . '", __("' . addslashes($metabox['label']) . '", "' . $this->Plugin_Lang . '"),array($this,"' . $this->Plugin_ShortName . '_widget_' . $metabox['name'] . '_dashboard_markup"));' . $this->newline;
                    $arg['function'] .= $this->tab . '}' . $this->newline;
                    $arg['function'] .= $this->newline;
                    $arg['function'] .= $this->newline;
                    $arg['function'] .= $this->tab . '/**' . $this->newline;
                    $arg['function'] .= $this->tab . ' * Create dashboard widget markup (' . $metabox['name'] . ')' . $this->newline;
                    $arg['function'] .= $this->tab . ' * ' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @link http://codex.wordpress.org/Function_Reference/wp_add_dashboard_widget' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @param mixed $post' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @param mixed $callback_args' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                    $arg['function'] .= $this->tab . ' **/' . $this->newline;
                    $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_widget_' . $metabox['name'] . '_dashboard_markup($post, $callback_args)' . $this->newline;
                    $arg['function'] .= $this->tab . '{' . $this->newline;
                    $extend_class = str_replace(' ', '', ucwords(str_replace('_', ' ', $metabox['name'])));
                    $arg['function'] .= $this->tab . $this->tab . 'if(file_exists(' . $this->Plugin_Const . '_PATH . "/includes/metabox.' . $metabox['name'] . '.inc.php' . '")){' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . 'require_once(' . $this->Plugin_Const . '_PATH . "/includes/metabox.' . $metabox['name'] . '.inc.php' . '");' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '$' . $metabox['name'] . '_metabox = new ' . $extend_class . '_Metabox($this);' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '$' . $metabox['name'] . '_metabox->Markup();' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
                    $arg['function'] .= $this->tab . '}' . $this->newline;
                    $this->addFunction($arg);
                    $string = '<?php' . $this->newline;
                    $string .= $this->newline;
                    $string .= '/**' . $this->newline;
                    $string .= ' * Metabox (' . ucwords($metabox['label']) . ')' . $this->newline;
                    $string .= ' *' . $this->newline;
                    $string .= '**/' . $this->newline;
                    $string .= $this->newline;
                    $string .= '# Exit if accessed directly' . $this->newline;
                    $string .= 'if(!defined("' . $this->Plugin_Const . '_EXEC")){' . $this->newline;
                    $string .= $this->tab . 'die();' . $this->newline;
                    $string .= '}' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->newline;

                    $string .= ' /**' . $this->newline;
                    $string .= '  * Dispaly back-end metabox ' . $metabox['name'] . $this->newline;
                    $string .= '  * ' . $this->newline;
                    $string .= '  * @package ' . $this->Plugin_Name . $this->newline;
                    $string .= '  * @author ' . $this->Author . $this->newline;
                    $string .= '  * @version ' . $this->Version . $this->newline;
                    $string .= '  * @access public' . $this->newline;
                    $string .= '  */' . $this->newline;

                    $string .= 'class ' . $extend_class . '_Metabox{' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . '/**' . $this->newline;
                    $string .= $this->tab . ' * Option Plugin' . $this->newline;
                    $string .= $this->tab . ' * @access private' . $this->newline;
                    $string .= $this->tab . ' **/' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . 'private $options;' . $this->newline;
                    $string .= $this->tab . '/**' . $this->newline;
                    $string .= $this->tab . ' * Instance of a class' . $this->newline;
                    $string .= $this->tab . ' * ' . $this->newline;
                    $string .= $this->tab . ' * @access public' . $this->newline;
                    $string .= $this->tab . ' * @return void' . $this->newline;
                    $string .= $this->tab . ' **/' . $this->newline;
                    $string .= $this->tab . 'function __construct(){' . $this->newline;
                    $string .= $this->tab . $this->tab . '$this->options = get_option("' . $this->Plugin_Prefix . '_plugins"); // get current option' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . '}' . $this->newline;

                    $string .= $this->tab . '/**' . $this->newline;
                    $string .= $this->tab . ' * Create dashboard markup' . $this->newline;
                    $string .= $this->tab . ' * ' . $this->newline;
                    $string .= $this->tab . ' * @access public' . $this->newline;
                    $string .= $this->tab . ' * @return void' . $this->newline;
                    $string .= $this->tab . ' **/' . $this->newline;

                    $string .= $this->tab . 'public function Markup(){' . $this->newline;
                    $string .= $this->newline;

                    $string .= $this->tab . $this->tab . '// TODO: EDIT HTML DASHBOARD WIDGET ' . strtoupper($metabox['label']) . '' . $this->newline;
                    $string .= $this->newline;

                    $string .= $this->tab . $this->tab . '// Display Location File' . strtoupper($metabox['label']) . '' . $this->newline;
                    $string .= $this->tab . $this->tab . 'if(' . strtoupper($this->Plugin_ShortName) . '_DEBUG==true){' . $this->newline;
                    $string .= $this->tab . $this->tab . $this->tab . '$file_info = null; ' . $this->newline;
                    $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "<p>You can edit the file below to fix the metabox</p>" ; ' . $this->newline;
                    $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "<div>" ; ' . $this->newline;
                    $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "<pre style=\"color:rgba(255,0,0,1);padding:3px;margin:0px;background:rgba(255,0,0,0.1);border:1px solid rgba(255,0,0,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">%s:%s</pre>" ; ' . $this->newline;
                    $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "</div>" ; ' . $this->newline;
                    $string .= $this->tab . $this->tab . $this->tab . 'printf($file_info,__FILE__,__LINE__);' . $this->newline;
                    $string .= $this->tab . $this->tab . '}' . $this->newline;

                    $string .= $this->tab . $this->tab . '/**' . $this->newline;
                    $string .= $this->tab . $this->tab . ' * You can make HTML tag for Metabox ' . $metabox['label'] . ' here' . $this->newline;
                    $string .= $this->tab . $this->tab . ' **/' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . $this->tab . 'echo "' . addslashes($metabox['markup']) . '";' . $this->newline;
                    $string .= $this->tab . '}' . $this->newline;
                    $string .= '}' . $this->newline;
                    $this->addClass(array(
                        'code' => $string,
                        'path' => 'metabox.' . $metabox['name'] . '.inc.php',
                        'editable' => true));
                } else
                {
                    foreach ($metabox['hooks'] as $hooks)
                    {
                        $css_hooks[] = $hooks;
                    }


                    $deps[] = 'thickbox';
                    $arg['admin'] = true;
                    $arg['function'] = $arg['construct'] = null;
                    $arg['construct'] .= 'add_action("add_meta_boxes",array($this,"' . $this->Plugin_ShortName . '_metabox_' . $metabox['name'] . '")); //add metabox ' . $metabox['label'];
                    $arg['function'] .= $this->tab . '/**' . $this->newline;
                    $arg['function'] .= $this->tab . ' * Add Metabox (' . $metabox['name'] . ')' . $this->newline;
                    $arg['function'] .= $this->tab . ' * ' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @link http://codex.wordpress.org/Function_Reference/add_meta_box' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @param mixed $hooks' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                    $arg['function'] .= $this->tab . ' **/' . $this->newline;
                    $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_metabox_' . $metabox['name'] . '($hook)' . $this->newline;
                    $arg['function'] .= $this->tab . '{' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$allowed_hook = array("' . implode('","', $metabox['hooks']) . '"); //limit meta box to certain page' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . 'if(in_array($hook, $allowed_hook))' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '{' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . 'add_meta_box("' . $this->Plugin_ShortName . '_metabox_' . $metabox['name'] . '", __("' . addslashes($metabox['label']) . '", "' . $this->Plugin_Lang . '"),array($this,"' . $this->Plugin_ShortName . '_metabox_' . $metabox['name'] . '_callback"),$hook,"normal","high");' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
                    $arg['function'] .= $this->tab . '}' . $this->newline;
                    $arg['function'] .= $this->newline;
                    $arg['function'] .= $this->newline;
                    $arg['function'] .= $this->tab . '/**' . $this->newline;
                    $arg['function'] .= $this->tab . ' * Create metabox markup (' . $metabox['name'] . ')' . $this->newline;
                    $arg['function'] .= $this->tab . ' * ' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @param mixed $post' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                    $arg['function'] .= $this->tab . ' **/' . $this->newline;
                    $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_metabox_' . $metabox['name'] . '_callback($post)' . $this->newline;
                    $arg['function'] .= $this->tab . '{' . $this->newline;
                    if ($post_meta_hit != 0)
                    {
                        $arg['function'] .= $this->tab . $this->tab . '// Add a nonce field so we can check for it later.' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . 'wp_nonce_field("' . $this->Plugin_ShortName . '_metabox_' . $metabox['name'] . '_save","' . $this->Plugin_ShortName . '_metabox_' . $metabox['name'] . '_nonce");' . $this->newline;
                    }
                    $extend_class = str_replace(' ', '', ucwords(str_replace('_', ' ', $metabox['name'])));
                    $arg['function'] .= $this->tab . $this->tab . 'if(file_exists(' . $this->Plugin_Const . '_PATH . "/includes/metabox.' . $metabox['name'] . '.inc.php' . '")){' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . 'require_once(' . $this->Plugin_Const . '_PATH . "/includes/metabox.' . $metabox['name'] . '.inc.php' . '");' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '$' . $metabox['name'] . '_metabox = new ' . $extend_class . '_Metabox();' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '$' . $metabox['name'] . '_metabox->Markup($post);' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
                    $arg['function'] .= $this->tab . '}' . $this->newline;
                    $this->addFunction($arg);
                    $_class = null;
                    if ($post_meta_hit != 0)
                    {
                        $css_code .= $this->newline;
                        $css_code .= "#postbox-container-1 #" . $this->Plugin_ShortName . "_metabox_" . $metabox['name'] . " th, " . $this->newline;
                        $css_code .= "#postbox-container-1 #" . $this->Plugin_ShortName . "_metabox_" . $metabox['name'] . " td{ " . $this->newline;
                        $css_code .= $this->tab . "display: block;" . $this->newline;
                        $css_code .= $this->tab . "padding: 0px;" . $this->newline;
                        $css_code .= "}" . $this->newline;
                        $css_code .= $this->newline;


                        $_class .= $this->tab . $this->tab . 'printf("<table class=\"form-table\">");' . $this->newline;
                        foreach ($metabox['post_meta'] as $post_meta)
                        {

                            if (isset($post_meta['name']))
                            {


                                if ($post_meta['name'] != '')
                                {
                                    $_class .= $this->newline;
                                    $_class .= $this->newline;
                                    $_class .= $this->tab . $this->tab . '// Use get_post_meta to retrieve an existing value from the database.' . $this->newline;
                                    $_class .= $this->tab . $this->tab . '$current_' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '= get_post_meta($post->ID, "_' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '", true);' . $this->newline;
                                    $_class .= $this->newline;
                                    $_class .= $this->tab . $this->tab . '/** Display the form ' . $post_meta['name'] . ', using the current value. **/' . $this->newline;
                                    $css_code .= $this->newline;

                                    if (!isset($post_meta['explanation']))
                                    {
                                        $post_meta['explanation'] = '&nbsp;';
                                    }
                                    if (!isset($post_meta['label']))
                                    {
                                        $post_meta['label'] = '&nbsp;';
                                    }

                                    $js_code .= $this->tab . $this->newline;


                                    $js_code .= $this->tab . '/**' . $this->newline;
                                    $js_code .= $this->tab . ' * ' . strtoupper($metabox['label']) . $this->newline;
                                    $js_code .= $this->tab . ' * name :' . ($metabox['name']) . $this->newline;
                                    $js_code .= $this->tab . ' * postmeta : ' . ($post_meta['name']) . $this->newline;
                                    $js_code .= $this->tab . ' * label : ' . ($post_meta['label']) . $this->newline;
                                    $js_code .= $this->tab . '**/' . $this->newline;

                                    switch ($post_meta['type'])
                                    {
                                        case 'text':
                                            $css_code .= "/** css for " . $post_meta['label'] . " **/" . $this->newline;
                                            $css_code .= "#" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "padding: 6px 12px;" . $this->newline;
                                            $css_code .= $this->tab . "height: 34px;" . $this->newline;
                                            $css_code .= $this->tab . "min-width: 75%;" . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** left position **/" . $this->newline;
                                            $css_code .= "#postbox-container-1 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "width: 100%;" . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** right position **/" . $this->newline;
                                            $css_code .= "#postbox-container-2 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "min-width:25em; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<tr><th scope=\"row\"><label for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">%s</label></th><td><input class=\"' . $this->Plugin_ShortName . '-form-control\" type=\"text\" id=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\" name=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\" value=\"%s\" placeholder=\"' . $post_meta['explanation'] . '\" /></td></tr>",__("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"), esc_attr($current_' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '));' . $this->newline;
                                            break;
                                        case 'textarea':
                                            $css_code .= "/** css for " . $post_meta['label'] . " **/" . $this->newline;
                                            $css_code .= "#" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "padding: 6px 12px;" . $this->newline;
                                            $css_code .= $this->tab . "height: 102px;" . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** left position **/" . $this->newline;
                                            $css_code .= "#postbox-container-1 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "width: 100%; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** right position **/" . $this->newline;
                                            $css_code .= "#postbox-container-2 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "min-width:100%; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<tr>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<th scope=\"row\"><label for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">". __("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"). "</label></th>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<td class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-col-sm-10\"><textarea class=\"' . $this->Plugin_ShortName . '-form-control\" type=\"text\" id=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\" name=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\" placeholder=\"' . $post_meta['explanation'] . '\">" . esc_attr($current_' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . ') . "</textarea></td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</tr>");' . $this->newline;
                                            break;

                                        case 'wp_editor':

                                            $_class .= $this->tab . $this->tab . 'printf("<tr>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<th scope=\"row\"><label for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">". __("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"). "</label></th>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<td class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-col-sm-10\">") ;' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'wp_editor(html_entity_decode($current_' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '),"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '",array(\'media_buttons\'=>true)); ' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</td>") ;' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</tr>");' . $this->newline;

                                            break;

                                        case 'select':
                                            $css_code .= "/** css for " . $post_meta['label'] . " **/" . $this->newline;
                                            $css_code .= "#" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{" . $this->newline;
                                            $css_code .= $this->tab . "padding: 6px 12px;" . $this->newline;
                                            $css_code .= $this->tab . "height: 34px;" . $this->newline;
                                            $css_code .= $this->tab . "min-width: 75%;" . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "#" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . " option{" . $this->newline;
                                            $css_code .= $this->tab . "padding: 6px;" . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** left position **/" . $this->newline;
                                            $css_code .= "#postbox-container-1 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "width: 100%; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** right position **/" . $this->newline;
                                            $css_code .= "#postbox-container-2 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "min-width:25em; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= $this->newline;
                                            $_option = null;
                                            $_class .= $this->tab . $this->tab . '$input_options = array();' . $this->newline;
                                            foreach ($post_meta['enum'] as $_option)
                                            {
                                                if ($_option['value'] != '')
                                                {
                                                    $_class .= $this->tab . $this->tab . '$input_options[] = array("value"=>"' . $_option['value'] . '","label"=>__("' . addslashes($_option['label']) . '","' . $this->Plugin_Lang . '")) ;' . $this->newline;
                                                }
                                            }
                                            $_class .= $this->tab . $this->tab . 'printf("<tr>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<th scope=\"row\"><label class=\"' . $this->Plugin_ShortName . '-control-label\" for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">". __("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"). "</label></th>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<select class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-form-control\" id=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\" name=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\" >") ;' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'foreach ($input_options as $input_option)' . $this->newline;
                                            $_class .= $this->tab . $this->tab . '{' . $this->newline;
                                            $_class .= $this->tab . $this->tab . $this->tab . '$selected="";' . $this->newline;
                                            $_class .= $this->tab . $this->tab . $this->tab . 'if($input_option["value"]== $current_' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '){ $selected="selected=\"selected\"";}' . $this->newline;
                                            $_class .= $this->tab . $this->tab . $this->tab . 'printf("<option value=\'".$input_option["value"]."\' ".$selected.">".$input_option["label"]."</option>") ;' . $this->newline;
                                            $_class .= $this->tab . $this->tab . '}' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</select>") ;' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</td>") ;' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</tr>");' . $this->newline;
                                            break;
                                        case 'radio':
                                            $css_code .= "/** css for " . $post_meta['label'] . " **/" . $this->newline;
                                            $css_code .= "#" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "padding: 6px 12px;" . $this->newline;
                                            $css_code .= $this->tab . "height: 34px;" . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** left position **/" . $this->newline;
                                            $css_code .= "#postbox-container-1 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "width: 100%;" . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** right position **/" . $this->newline;
                                            $css_code .= "#postbox-container-2 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "min-width:25em; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $_option = null;
                                            $_class .= $this->tab . $this->tab . '$input_options = array();' . $this->newline;
                                            foreach ($post_meta['enum'] as $_option)
                                            {
                                                if ($_option['value'] != '')
                                                {
                                                    $_class .= $this->tab . $this->tab . '$input_options[] = array("value"=>"' . $_option['value'] . '","label"=>__("' . addslashes($_option['label']) . '","' . $this->Plugin_Lang . '")) ;' . $this->newline;
                                                }
                                            }
                                            $_class .= $this->tab . $this->tab . 'printf("<tr>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<th scope=\"row\"><label class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-col-sm-2 ' . $this->Plugin_ShortName . '-control-label\" for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">". __("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"). "</label></th>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'foreach($input_options as $input_option)' . $this->newline;
                                            $_class .= $this->tab . $this->tab . '{' . $this->newline;
                                            $_class .= $this->tab . $this->tab . $this->tab . '$selected="";' . $this->newline;
                                            $_class .= $this->tab . $this->tab . $this->tab . 'if($input_option["value"]==$current_' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '){ $selected="checked=\"checked\"";}' . $this->newline;
                                            $_class .= $this->tab . $this->tab . $this->tab . 'printf("<div class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-radio\">") ;' . $this->newline;
                                            $_class .= $this->tab . $this->tab . $this->tab . 'printf("<label><input class=\"' . $this->Plugin_ShortName . '\" type=\"radio\" name=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\" value=\'".$input_option["value"]."\' ".$selected." />".$input_option["label"]." </label>") ;' . $this->newline;
                                            $_class .= $this->tab . $this->tab . $this->tab . 'printf("</div>") ;' . $this->newline;
                                            $_class .= $this->tab . $this->tab . '}' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</tr>");' . $this->newline;
                                            break;
                                        case 'checkbox':
                                            $css_code .= "/** css for " . $post_meta['label'] . " **/" . $this->newline;
                                            $css_code .= "#" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "padding: 6px 12px;" . $this->newline;
                                            $css_code .= $this->tab . "height: 34px;" . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** left position **/" . $this->newline;
                                            $css_code .= "#postbox-container-1 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** right position **/" . $this->newline;
                                            $css_code .= "#postbox-container-2 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= "}" . $this->newline;

                                            $css_code .= "#" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "_checkbox th{ " . $this->newline;
                                            $css_code .= $this->tab . "margin-bottom: 0;" . $this->newline;
                                            $css_code .= $this->tab . "padding-bottom: 0;" . $this->newline;
                                            $css_code .= $this->tab . "margin-top: 0;" . $this->newline;
                                            $css_code .= $this->tab . "padding-top: 0;" . $this->newline;
                                            $css_code .= "}" . $this->newline;

                                            $css_code .= "#" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "_checkbox td{ " . $this->newline;
                                            $css_code .= $this->tab . "margin-bottom: 0;" . $this->newline;
                                            $css_code .= $this->tab . "padding-bottom: 0;" . $this->newline;
                                            $css_code .= $this->tab . "margin-top: 0;" . $this->newline;
                                            $css_code .= $this->tab . "padding-top: 0;" . $this->newline;
                                            $css_code .= "}" . $this->newline;

                                            $_class .= $this->tab . $this->tab . '$selected="";' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'if($current_' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . ' == "1"){ $selected="checked=\"checked\"";}' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<tr id=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '_checkbox\">");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<th scope=\"row\"><label class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-col-sm-2 ' . $this->Plugin_ShortName . '-control-label\" for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">". __("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"). "</label></th>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<label for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\"><input type=\"checkbox\" id=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\" name=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\" value=\"1\" ".$selected."/>' . $post_meta['explanation'] . ' </label>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</tr>");' . $this->newline;
                                            break;
                                        case 'wpcolor':
                                            $css_code .= "/** css for " . $post_meta['label'] . " **/" . $this->newline;
                                            $deps[] = 'wp-color-picker';
                                            $sample_code_gen = new wpSampleCode($this->config);
                                            $sample_code = $sample_code_gen->wpcolor(array(
                                                'id' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'name' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'label' => $post_meta['label'],
                                                'explanation' => $post_meta['explanation']), 2);
                                            $_class .= $this->tab . $this->tab . 'printf("<tr>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<th scope=\"row\"><label class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-col-sm-2 ' . $this->Plugin_ShortName . '-control-label\" for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">". __("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"). "</label></th>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<td>");' . $this->newline;
                                            $_class .= $sample_code['php'];
                                            $_class .= $this->tab . $this->tab . 'printf("</td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</tr>");' . $this->newline;
                                            $css_code .= $sample_code['css'];
                                            $js_code .= $sample_code['js'];
                                            break;

                                        case 'media-upload':
                                            $deps[] = 'media-upload';
                                            $css_code .= "/** css for " . $post_meta['label'] . " **/" . $this->newline;
                                            $css_code .= "#" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . " option{" . $this->newline;
                                            $css_code .= $this->tab . "padding: 6px;" . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** left position **/" . $this->newline;
                                            $css_code .= "#postbox-container-1 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "width: 100%; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** right position **/" . $this->newline;
                                            $css_code .= "#postbox-container-2 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "min-width:25em; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= $this->newline;
                                            $sample_code_gen = new wpSampleCode($this->config);
                                            $sample_code = $sample_code_gen->media_upload(array(
                                                'id' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'name' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'label' => $post_meta['label'],
                                                'explanation' => $post_meta['explanation']), 2);
                                            $_class .= $this->tab . $this->tab . 'printf("<tr>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<th scope=\"row\"><label class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-col-sm-2 ' . $this->Plugin_ShortName . '-control-label\" for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">". __("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"). "</label></th>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<td>");' . $this->newline;
                                            $_class .= $sample_code['php'];
                                            $_class .= $this->tab . $this->tab . 'printf("</td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</tr>");' . $this->newline;
                                            $css_code .= $sample_code['css'];
                                            $js_code .= $sample_code['js'];
                                            break;

                                        case 'featured-image':
                                            $_class .= $this->tab . $this->tab . 'wp_enqueue_media();' . $this->newline;
                                            $css_code .= "/** css for " . $post_meta['label'] . " **/" . $this->newline;
                                            $sample_code_gen = new wpSampleCode($this->config);
                                            $sample_code = $sample_code_gen->featured_image(array(
                                                'id' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'name' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'label' => $post_meta['label'],
                                                'explanation' => $post_meta['explanation']), 2);

                                            $_class .= $this->tab . $this->tab . 'printf("<tr>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<th scope=\"row\"><label class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-col-sm-2 ' . $this->Plugin_ShortName . '-control-label\" for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">". __("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"). "</label></th>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<td>");' . $this->newline;
                                            $_class .= $sample_code['php'];
                                            $_class .= $this->tab . $this->tab . 'printf("</td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</tr>");' . $this->newline;
                                            $css_code .= $sample_code['css'];
                                            $js_code .= $sample_code['js'];
                                            break;

                                        case 'media-upload-dinamic':
                                            $deps[] = 'media-upload';


                                            $css_code .= "/** css for " . $post_meta['label'] . " **/" . $this->newline;

                                            $sample_code_gen = new wpSampleCode($this->config);
                                            $sample_code = $sample_code_gen->media_upload_dinamic(array(
                                                'id' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'name' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'label' => $post_meta['label'],
                                                'explanation' => $post_meta['explanation']), 2);


                                            $_class .= $this->tab . $this->tab . 'printf("<tr>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<th scope=\"row\"><label class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-col-sm-2 ' . $this->Plugin_ShortName . '-control-label\" for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">". __("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"). "</label></th>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<td>");' . $this->newline;

                                            $_class .= $sample_code['php'];
                                            $_class .= $this->tab . $this->tab . 'printf("</td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</tr>");' . $this->newline;

                                            $css_code .= $sample_code['css'];
                                            $js_code .= $sample_code['js'];
                                            break;

                                        case 'wp_dropdown_categories':
                                            $css_code .= "/** css for " . $post_meta['label'] . " **/" . $this->newline;
                                            $css_code .= "#" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . " option{" . $this->newline;
                                            $css_code .= $this->tab . "padding: 6px;" . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** left position **/" . $this->newline;
                                            $css_code .= "#postbox-container-1 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "width: 100%; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** right position **/" . $this->newline;
                                            $css_code .= "#postbox-container-2 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "min-width:25em; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= $this->newline;
                                            $sample_code_gen = new wpSampleCode($this->config);
                                            $sample_code = $sample_code_gen->wp_dropdown_categories(array(
                                                'id' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'name' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'label' => $post_meta['label'],
                                                'explanation' => $post_meta['explanation']), 2);
                                            $_class .= $this->tab . $this->tab . 'printf("<tr>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<th scope=\"row\"><label class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-col-sm-2 ' . $this->Plugin_ShortName . '-control-label\" for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">". __("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"). "</label></th>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<td>");' . $this->newline;
                                            $_class .= $sample_code['php'];
                                            $_class .= $this->tab . $this->tab . 'printf("</td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</tr>");' . $this->newline;
                                            $css_code .= $sample_code['css'];
                                            break;
                                        case 'wp_dropdown_users':
                                            $css_code .= "/** css for " . $post_meta['label'] . " **/" . $this->newline;
                                            $css_code .= "#" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . " option{" . $this->newline;
                                            $css_code .= $this->tab . "padding: 6px;" . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** left position **/" . $this->newline;
                                            $css_code .= "#postbox-container-1 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "width: 100%; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** right position **/" . $this->newline;
                                            $css_code .= "#postbox-container-2 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "min-width:25em; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= $this->newline;
                                            $sample_code_gen = new wpSampleCode($this->config);
                                            $sample_code = $sample_code_gen->wp_dropdown_users(array(
                                                'id' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'name' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'label' => $post_meta['label'],
                                                'explanation' => $post_meta['explanation']), 2);
                                            $_class .= $this->tab . $this->tab . 'printf("<tr>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<th scope=\"row\"><label class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-col-sm-2 ' . $this->Plugin_ShortName . '-control-label\" for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">". __("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"). "</label></th>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<td>");' . $this->newline;
                                            $_class .= $sample_code['php'];
                                            $_class .= $this->tab . $this->tab . 'printf("</td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</tr>");' . $this->newline;
                                            $css_code .= $sample_code['css'];
                                            break;
                                        case 'wp_dropdown_pages':
                                            $css_code .= "/** css for " . $post_meta['label'] . " **/" . $this->newline;
                                            $css_code .= "#" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . " option{" . $this->newline;
                                            $css_code .= $this->tab . "padding: 6px;" . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** left position **/" . $this->newline;
                                            $css_code .= "#postbox-container-1 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "width: 100%; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** right position **/" . $this->newline;
                                            $css_code .= "#postbox-container-2 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "{ " . $this->newline;
                                            $css_code .= $this->tab . "min-width:25em; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= $this->newline;
                                            $sample_code_gen = new wpSampleCode($this->config);
                                            $sample_code = $sample_code_gen->wp_dropdown_pages(array(
                                                'id' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'name' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'post_type' => $post_meta['sub_type'],
                                                'label' => $post_meta['label'],
                                                'explanation' => $post_meta['explanation']), 2);
                                            $_class .= $this->tab . $this->tab . 'printf("<tr>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<th scope=\"row\"><label class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-col-sm-2 ' . $this->Plugin_ShortName . '-control-label\" for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">". __("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"). "</label></th>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<td>");' . $this->newline;
                                            $_class .= $sample_code['php'];
                                            $_class .= $this->tab . $this->tab . 'printf("</td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</tr>");' . $this->newline;
                                            $css_code .= $sample_code['css'];
                                            break;

                                        case 'datepicker':


                                            $deps[] = 'jquery-ui-core';
                                            $deps[] = 'jquery-ui-datepicker';

                                            $css_code .= "/** css for " . $post_meta['label'] . " **/" . $this->newline;
                                            $deps[] = 'wp-color-picker';
                                            $sample_code_gen = new wpSampleCode($this->config);
                                            $sample_code = $sample_code_gen->datepicker(array(
                                                'id' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'name' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'label' => $post_meta['label'],
                                                'explanation' => $post_meta['explanation']), 2);
                                            $_class .= $this->tab . $this->tab . 'printf("<tr>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<th scope=\"row\"><label class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-col-sm-2 ' . $this->Plugin_ShortName . '-control-label\" for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">". __("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"). "</label></th>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<div class=\"' . $this->Plugin_ShortName . '\">");' . $this->newline;
                                            $_class .= $sample_code['php'];
                                            $_class .= $this->tab . $this->tab . 'printf("</div>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</tr>");' . $this->newline;
                                            $css_code .= $sample_code['css'];
                                            $js_code .= $sample_code['js'];

                                            $this->addCss(array(
                                                'hooks' => array_unique($css_hooks),
                                                'admin' => true,
                                                'version' => $this->Version,
                                                'src' => 'assets/third-party/jquery-ui/jquery-ui.min.css',
                                                'name' => 'jquery-ui',
                                                ));

                                            $this->addCss(array(
                                                'hooks' => array_unique($css_hooks),
                                                'admin' => true,
                                                'version' => $this->Version,
                                                'src' => 'assets/third-party/jquery-ui/jquery-ui.theme.min.css',
                                                'name' => 'jquery-ui-theme',
                                                ));

                                            $this->addFiles(array('path' => str_replace('_', '-', $this->Plugin_Prefix) . '/assets/third-party/jquery-ui/index.html', 'string' => ''));

                                            break;


                                        case 'wp_dropdown_pages_dinamic':
                                            $css_code .= "/** css for " . $post_meta['label'] . " **/" . $this->newline;
                                            $css_code .= "#" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "_select option{" . $this->newline;
                                            $css_code .= $this->tab . "padding: 6px;" . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** left position **/" . $this->newline;
                                            $css_code .= "#postbox-container-1 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "_select{ " . $this->newline;
                                            $css_code .= $this->tab . "width: 100%; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= "/** right position **/" . $this->newline;
                                            $css_code .= "#postbox-container-2 #" . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . "_select{ " . $this->newline;
                                            $css_code .= $this->tab . "min-width:25em; " . $this->newline;
                                            $css_code .= "}" . $this->newline;
                                            $css_code .= $this->newline;
                                            $sample_code_gen = new wpSampleCode($this->config);
                                            $sample_code = $sample_code_gen->wp_dropdown_pages_dinamic(array(
                                                'id' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'name' => $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'],
                                                'post_type' => $post_meta['sub_type'],
                                                'label' => $post_meta['label'],
                                                'explanation' => $post_meta['explanation']), 2);
                                            $_class .= $this->tab . $this->tab . 'printf("<tr>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<th scope=\"row\"><label class=\"' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-col-sm-2 ' . $this->Plugin_ShortName . '-control-label\" for=\"' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '\">". __("' . addslashes($post_meta['label']) . '", "' . $this->Plugin_Lang . '"). "</label></th>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("<td>");' . $this->newline;
                                            $_class .= $sample_code['php'];
                                            $_class .= $this->tab . $this->tab . 'printf("</td>");' . $this->newline;
                                            $_class .= $this->tab . $this->tab . 'printf("</tr>");' . $this->newline;
                                            $css_code .= $sample_code['css'];
                                            $js_code .= $sample_code['js'];
                                            break;
                                    }
                                }
                            }
                        }
                        $_class .= $this->tab . $this->tab . 'echo "</table>";' . $this->newline;
                    }
                    if ($post_meta_hit != 0)
                    {
                        //save post
                        $arg = null;
                        $arg['admin'] = true;
                        $arg['function'] = $arg['construct'] = null;
                        $arg['construct'] .= 'add_action("save_post",array($this,"' . $this->Plugin_ShortName . '_metabox_' . $metabox['name'] . '_save")); //save metabox ' . $metabox['label'] . ' data';
                        $arg['function'] .= $this->tab . '/**' . $this->newline;
                        $arg['function'] .= $this->tab . ' *' . $this->newline;
                        $arg['function'] .= $this->tab . ' * Save the meta when the post is saved.' . $this->newline;
                        $arg['function'] .= $this->tab . ' * ' . $this->Plugin_Class . '::' . $this->Plugin_ShortName . '_metabox_' . $metabox['name'] . '_save()' . $this->newline;
                        $arg['function'] .= $this->tab . ' * @param int $post_id The ID of the post being saved.' . $this->newline;
                        $arg['function'] .= $this->tab . ' *' . $this->newline;
                        $arg['function'] .= $this->tab . '**/' . $this->newline;
                        $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_metabox_' . $metabox['name'] . '_save($post_id)' . $this->newline;
                        $arg['function'] .= $this->tab . '{' . $this->newline;
                        $arg['function'] .= $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '/*' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . ' * We need to verify this came from the our screen and with proper authorization,' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . ' * because save_post can be triggered at other times.' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . ' */' . $this->newline;
                        $arg['function'] .= $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '// Check if our nonce is set.' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . 'if (!isset($_POST["' . $this->Plugin_ShortName . '_metabox_' . $metabox['name'] . '_nonce"]))' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . 'return $post_id;' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '$nonce = $_POST["' . $this->Plugin_ShortName . '_metabox_' . $metabox['name'] . '_nonce"];' . $this->newline;
                        $arg['function'] .= $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '// Verify that the nonce is valid.' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . 'if(!wp_verify_nonce($nonce, "' . $this->Plugin_ShortName . '_metabox_' . $metabox['name'] . '_save"))' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . 'return $post_id;' . $this->newline;
                        $arg['function'] .= $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '// If this is an autosave, our form has not been submitted,' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '// so we don\'t want to do anything.' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . 'if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . 'return $post_id;' . $this->newline;
                        $arg['function'] .= $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '// Check the user\'s permissions.' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . 'if ("page" == $_POST["post_type"])' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '{' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . 'if (!current_user_can("edit_page", $post_id))' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'return $post_id;' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '} else' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '{' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . 'if (!current_user_can("edit_post", $post_id))' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'return $post_id;' . $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
                        $arg['function'] .= $this->newline;
                        $arg['function'] .= $this->tab . $this->tab . '/* OK, its safe for us to save the data now. */' . $this->newline;
                        $arg['function'] .= $this->newline;
                        foreach ($metabox['post_meta'] as $post_meta)
                        {
                            if (isset($post_meta['name']))
                            {

                                if ($post_meta['name'] != '')
                                {
                                    $arg['function'] .= $this->tab . $this->tab . '// Sanitize the user input.' . $this->newline;
                                    $form_input_fix = '$_POST["' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '"]';
                                    switch ($post_meta['type'])
                                    {
                                        case 'media-upload-dinamic':
                                            $form_input_fix = ' json_encode($_POST["' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '"])';
                                            break;
                                        case 'wp_dropdown_pages_dinamic':
                                            $form_input_fix = ' json_encode($_POST["' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '"])';
                                            break;
                                    }
                                    $arg['function'] .= $this->tab . $this->tab . '//' . $post_meta['type'] . $this->newline;
                                    if ($post_meta['type'] == 'wp_editor')
                                    {

                                        $arg['function'] .= $this->tab . $this->tab . '$' . $post_meta['name'] . ' = htmlentities(' . $form_input_fix . ' );' . $this->newline;
                                    } else
                                    {
                                        $arg['function'] .= $this->tab . $this->tab . '$' . $post_meta['name'] . ' = sanitize_text_field(' . $form_input_fix . ' );' . $this->newline;
                                    }
                                    $arg['function'] .= $this->newline;
                                    $arg['function'] .= $this->tab . $this->tab . '// Update the meta field.' . $this->newline;
                                    $arg['function'] .= $this->tab . $this->tab . 'update_post_meta($post_id, "_' . $this->Plugin_ShortName . '_postmeta_' . $post_meta['name'] . '", $' . $post_meta['name'] . ');' . $this->newline;
                                    $arg['function'] .= $this->newline;
                                }
                            }
                        }
                        $arg['function'] .= $this->tab . '}' . $this->newline;
                        $arg['function'] .= $this->newline;
                        $arg['function'] .= $this->newline;
                        $this->addFunction($arg);
                    }
                    $arg = null;
                    $string = '<?php' . $this->newline;
                    $string .= $this->newline;
                    $string .= '/**' . $this->newline;
                    $string .= ' * Metabox (' . ucwords($metabox['label']) . ')' . $this->newline;
                    $string .= ' *' . $this->newline;
                    $string .= '**/' . $this->newline;
                    $string .= $this->newline;
                    $string .= '# Exit if accessed directly' . $this->newline;
                    $string .= 'if(!defined("' . $this->Plugin_Const . '_EXEC")){' . $this->newline;
                    $string .= $this->tab . 'die();' . $this->newline;
                    $string .= '}' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->newline;

                    $string .= ' /**' . $this->newline;
                    $string .= '  * Dispaly back-end metabox ' . $metabox['name'] . $this->newline;
                    $string .= '  * ' . $this->newline;
                    $string .= '  * @package ' . $this->Plugin_Name . $this->newline;
                    $string .= '  * @author ' . $this->Author . $this->newline;
                    $string .= '  * @version ' . $this->Version . $this->newline;
                    $string .= '  * @access public' . $this->newline;
                    $string .= '  * ' . $this->newline;
                    $string .= '  * ' . $this->generator_by . $this->newline;
                    $string .= '  */' . $this->newline;
                    $string .= $this->newline;
                    $string .= 'class ' . $extend_class . '_Metabox{' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . '/**' . $this->newline;
                    $string .= $this->tab . ' * Option Plugin' . $this->newline;
                    $string .= $this->tab . ' * @access private' . $this->newline;
                    $string .= $this->tab . ' **/' . $this->newline;
                    $string .= $this->tab . 'private $options;' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . '/**' . $this->newline;
                    $string .= $this->tab . ' * Instance of a class' . $this->newline;
                    $string .= $this->tab . ' * ' . $this->newline;
                    $string .= $this->tab . ' * @access public' . $this->newline;
                    $string .= $this->tab . ' * @return void' . $this->newline;
                    $string .= $this->tab . ' **/' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . 'function __construct(){' . $this->newline;
                    $string .= $this->tab . $this->tab . '$this->options = get_option("' . $this->Plugin_Prefix . '_plugins"); // get current option' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . '}' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . '/**' . $this->newline;
                    $string .= $this->tab . ' * Create Metabox Markup' . $this->newline;
                    $string .= $this->tab . ' * ' . $this->newline;
                    $string .= $this->tab . ' * @param mixed $post' . $this->newline;
                    $string .= $this->tab . ' * @access public' . $this->newline;
                    $string .= $this->tab . ' * @return void' . $this->newline;
                    $string .= $this->tab . ' **/' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . 'public function Markup($post){' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . $this->tab . '// TODO: EDIT HTML METABOX ' . strtoupper($metabox['label']) . '' . $this->newline;
                    $string .= $this->tab . $this->tab . 'if(' . strtoupper($this->Plugin_ShortName) . '_DEBUG==true){' . $this->newline;
                    $string .= $this->tab . $this->tab . $this->tab . '$file_info = null; ' . $this->newline;
                    $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "<p>You can edit the file below to fix the metabox</p>" ; ' . $this->newline;
                    $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "<div>" ; ' . $this->newline;
                    $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "<pre style=\"color:rgba(255,0,0,1);padding:3px;margin:0px;background:rgba(255,0,0,0.1);border:1px solid rgba(255,0,0,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">%s:%s</pre>" ; ' . $this->newline;
                    $string .= $this->tab . $this->tab . $this->tab . '$file_info .= "</div>" ; ' . $this->newline;
                    $string .= $this->tab . $this->tab . $this->tab . 'printf($file_info,__FILE__,__LINE__);' . $this->newline;
                    $string .= $this->tab . $this->tab . '}' . $this->newline;


                    $string .= $this->tab . $this->tab . '/**' . $this->newline;
                    $string .= $this->tab . $this->tab . '* You can make HTML tag for Metabox ' . $metabox['label'] . ' here' . $this->newline;
                    $string .= $this->tab . $this->tab . '**/' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . $this->tab . 'echo "' . addslashes($metabox['markup']) . '";' . $this->newline;
                    $string .= $_class;
                    $string .= $this->tab . '}' . $this->newline;
                    $string .= '}' . $this->newline;
                    $this->addClass(array(
                        'code' => $string,
                        'path' => 'metabox.' . $metabox['name'] . '.inc.php',
                        ));
                }
            }

            if ((!isset($css_hooks)) || (!is_array($css_hooks)))
            {
                $css_hooks = array();
            }

            $this->addFiles(array('path' => str_replace('_', '-', $this->Plugin_Prefix) . '/assets/css/' . $this->Plugin_ShortName . '_admin_metabox.css', 'string' => $css_code));
            if (count($this->metaboxs) != 0)
            {
                $this->addCss(array(
                    'hooks' => array_unique($css_hooks),
                    'admin' => true,
                    'version' => $this->Version,
                    'src' => 'assets/css/' . $this->Plugin_ShortName . '_admin_metabox.css',
                    'name' => 'metabox',
                    ));
            }
            $arg = null;
            $arg['admin'] = true;
            $arg['hooks'] = array_unique($css_hooks);
            $arg['src'] = $arg['code'] = $arg['function'] = $arg['construct'] = null;
            $arg['src'] = 'assets/js/' . $this->Plugin_ShortName . '_admin_metabox.js';

            $arg['code'] .= '/**' . $this->newline;
            $arg['code'] .= ' * @Author :' . $this->Author . $this->newline;
            $arg['code'] .= ' * @Author URL : ' . $this->Author_URI . $this->newline;
            $arg['code'] .= ' * @License : ' . $this->License . $this->newline;
            $arg['code'] .= ' * @License URL: ' . $this->License_URI . $this->newline;
            $arg['code'] .= ' *' . $this->newline;
            $arg['code'] .= ' * @Package : ' . $this->Plugin_Name . $this->newline;
            $arg['code'] .= ' * @Version : ' . $this->Version . $this->newline;
            $arg['code'] .= '**/' . $this->newline;
            $arg['code'] .= $this->newline;
            $arg['code'] .= $this->newline;

            $arg['code'] .= '(function($)' . $this->newline;
            $arg['code'] .= '{' . $this->newline;
            $arg['code'] .= $js_code;
            $arg['code'] .= '})(jQuery);' . $this->newline;
            $arg['name'] = 'admin_metabox';
            $arg['version'] = $this->Version;
            $arg['deps'] = array_unique($deps);


            $arg['for'] = 'JS for metabox';
            if (count($this->metaboxs) != 0)
            {
                $this->addJs($arg);
            }

        } else
        {
            $this->metaboxs = array();
        }
    }
    /**
     * wpGenerator::codeShortcodes()
     * 
     * @return
     */
    private function codeShortcodes()
    {
        $arg['construct'] = null;
        $arg['function'] = null;
        $arg['path'] = null;
        $arg['code'] = null;
        $arg['admin'] = true;
        $arg['construct'] .= 'add_action("admin_print_footer_scripts",array($this,"' . $this->Plugin_ShortName . '_quicktags"),100); //add shortcode button';
        $arg['function'] .= $this->tab . '/**' . $this->newline;
        $arg['function'] .= $this->tab . ' * Add Quicktags Button' . $this->newline;
        $arg['function'] .= $this->tab . ' * ' . $this->newline;
        $arg['function'] .= $this->tab . ' * @param mixed $hooks' . $this->newline;
        $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
        $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
        $arg['function'] .= $this->tab . ' **/' . $this->newline;
        $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_quicktags($hook)' . $this->newline;
        $arg['function'] .= $this->tab . '{' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . 'if(wp_script_is("quicktags")){' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '// TODO : Quicktags' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '#error handler' . $this->newline;
        foreach ($this->shortcodes as $shortcode)
        {
            $arg['function'] .= $this->tab . $this->tab . $this->tab . 'if(!isset($this->options["shortcode_' . $shortcode['tag'] . '"])){' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . '$this->options["shortcode_' . $shortcode['tag'] . '"]="0";' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . '}' . $this->newline;
        }
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '#add button' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '_e("<script type=\"text/javascript\">");' . $this->newline;
        foreach ($this->shortcodes as $shortcode)
        {
            if (!isset($shortcode['properties']))
            {
                $shortcode['properties'] = array();
            }
            $arg['function'] .= $this->tab . $this->tab . $this->tab . 'if($this->options["shortcode_' . $shortcode['tag'] . '"] == "1"){' . $this->newline;
            $j = 0;
            $_properties = array();
            foreach ($shortcode['properties'] as $properties)
            {
                if (isset($properties['name']))
                {
                    if ($properties['name'] != '')
                    {
                        if (!isset($properties['label']))
                        {
                            $properties['label'] = '';
                        }
                        if (!isset($properties['default']))
                        {
                            $properties['default'] = '';
                        }

                        $_properties[$j]['name'] = $properties['name'];
                        $_properties[$j]['label'] = $properties['label'];
                        $_properties[$j]['default'] = $properties['default'];
                        $j++;
                    }
                }
            }
            if (count($_properties) != 0)
            {

                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'print("QTags.addButton(\'' . $shortcode['tag'] . '\',\'' . $shortcode['tag'] . '\',prompt_' . $shortcode['tag'] . ');");' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'print("function prompt_' . $shortcode['tag'] . '(e, c, ed) {");' . $this->newline;
                $attr = null;
                foreach ($_properties as $_property)
                {
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'print("prmt_' . $_property['name'] . ' = prompt(\"". __(\'Enter ' . addslashes($_property['label']) . '\', \'' . $this->Plugin_Lang . '\') ."\",\"' . $_property['default'] . '\");");' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'print("if( prmt_' . $_property['name'] . '=== null) return;");' . $this->newline;

                    $attr .= ' ' . $_property['name'] . '=\"\' + prmt_' . $_property['name'] . ' + \'\"';
                }
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'print("rtrn = \'[' . $shortcode['tag'] . '' . $attr . '][/' . $shortcode['tag'] . ']\';");' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'print("this.tagStart = rtrn;");' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'print("QTags.TagButton.prototype.callback.call(this, e, c, ed);");' . $this->newline;

                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'print("return false;");' . $this->newline;
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'print("}");' . $this->newline;

            } else
            {
                $arg['function'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'print("QTags.addButton(\'' . $shortcode['tag'] . '\',\'' . $shortcode['tag'] . '\',\'[' . $shortcode['tag'] . ']\',\'[/' . $shortcode['tag'] . ']\',\'' . $shortcode['tag'] . '\',\'" . __(\'' . addslashes($shortcode['title']) . '\', \'' . $this->Plugin_Lang . '\') . "\',3);");' . $this->newline;
            }
            $arg['function'] .= $this->tab . $this->tab . $this->tab . '}' . $this->newline;
        }
        $arg['function'] .= $this->tab . $this->tab . $this->tab . 'print("</script>");' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
        $arg['function'] .= $this->tab . '}' . $this->newline;
        $this->addFunction($arg);
        foreach ($this->shortcodes as $shortcode)
        {
            $_properties = array();
            foreach ($shortcode['properties'] as $properties)
            {
                if (isset($properties['name']))
                {
                    if (!isset($properties['default']))
                    {
                        $properties['default'] = '';
                    }

                    if ($properties['name'] != '')
                    {
                        $_properties[] = "'" . $properties['name'] . "'=>'" . $properties['default'] . "'";
                    }
                }
            }
            $arg = null;
            $arg['construct'] = null;
            $arg['function'] = null;
            $arg['construct'] .= 'add_shortcode("' . $shortcode['tag'] . '", array($this, "' . $this->Plugin_ShortName . '_shortcode_' . $shortcode['tag'] . '")); //call shortcode ' . $shortcode['tag'] . ' ';

            $arg['function'] .= $this->tab . '/**' . $this->newline;
            $arg['function'] .= $this->tab . ' * Create front-end shortcode (' . $shortcode['tag'] . ')' . $this->newline;
            $arg['function'] .= $this->tab . ' * ' . $this->newline;
            $arg['function'] .= $this->tab . ' * @param array $atts' . $this->newline;
            $arg['function'] .= $this->tab . ' * @param string $content' . $this->newline;
            $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
            $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
            $arg['function'] .= $this->tab . ' **/' . $this->newline;

            $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_shortcode_' . $shortcode['tag'] . '($atts,$content=null)' . $this->newline;
            $arg['function'] .= $this->tab . '{' . $this->newline;
            $extend_class = str_replace(' ', '', ucwords(str_replace('_', ' ', $shortcode['tag'])));
            $arg['function'] .= $this->tab . $this->tab . 'if(file_exists(' . $this->Plugin_Const . '_PATH . "/includes/shortcode.' . $shortcode['tag'] . '.inc.php' . '")){' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . 'require_once(' . $this->Plugin_Const . '_PATH . "/includes/shortcode.' . $shortcode['tag'] . '.inc.php' . '");' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . '$' . $shortcode['tag'] . '_shortcode = new ' . $extend_class . '_Shortcode($this);' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . 'return $' . $shortcode['tag'] . '_shortcode->Markup($atts,$content=null);' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
            $arg['function'] .= $this->tab . '}' . $this->newline;
            $this->addFunction($arg);
            if (!isset($shortcode['markup']))
            {
                $shortcode['markup'] = '';
            }
            $example_markup = addslashes($shortcode['markup']);
            $string = '<?php' . $this->newline;
            $string .= $this->newline;
            $string .= '/**' . $this->newline;
            $string .= ' * Shortcode (' . $shortcode['tag'] . ')' . $this->newline;
            $string .= ' *' . $this->newline;
            $string .= '**/' . $this->newline;
            $string .= $this->newline;
            $string .= '# Exit if accessed directly' . $this->newline;
            $string .= 'if(!defined("' . $this->Plugin_Const . '_EXEC")){' . $this->newline;
            $string .= $this->tab . 'die();' . $this->newline;
            $string .= '}' . $this->newline;
            $string .= $this->newline;
            $string .= $this->newline;

            $string .= ' /**' . $this->newline;
            $string .= '  * Dispaly front-end for shortcode ' . $shortcode['tag'] . '' . $this->newline;
            $string .= '  * ' . $this->newline;
            $string .= '  * @package ' . $this->Plugin_Name . $this->newline;
            $string .= '  * @author ' . $this->Author . $this->newline;
            $string .= '  * @version ' . $this->Version . $this->newline;
            $string .= '  * @access public' . $this->newline;
            $string .= '  */' . $this->newline;

            $string .= 'class ' . $extend_class . '_Shortcode{' . $this->newline;
            $string .= $this->newline;
            $string .= $this->newline;
            $string .= $this->tab . '/**' . $this->newline;
            $string .= $this->tab . ' * Option Plugin' . $this->newline;
            $string .= $this->tab . ' * @access private' . $this->newline;
            $string .= $this->tab . ' **/' . $this->newline;
            $string .= $this->tab . 'private $options;' . $this->newline;
            $string .= $this->newline;
            $string .= $this->tab . '/**' . $this->newline;
            $string .= $this->tab . ' * Instance of a class' . $this->newline;
            $string .= $this->tab . ' * ' . $this->newline;
            $string .= $this->tab . ' * @access public' . $this->newline;
            $string .= $this->tab . ' * @return void' . $this->newline;
            $string .= $this->tab . ' **/' . $this->newline;
            $string .= $this->tab . 'public function __construct(){' . $this->newline;
            $string .= $this->tab . $this->tab . '$this->options = get_option("' . $this->Plugin_Prefix . '_plugins"); // get current option' . $this->newline;
            $string .= $this->newline;
            $string .= $this->tab . '}' . $this->newline;

            $string .= $this->tab . '/**' . $this->newline;
            $string .= $this->tab . ' * Create shortcode markup' . $this->newline;
            $string .= $this->tab . ' * ' . $this->newline;
            $string .= $this->tab . ' * @access public' . $this->newline;
            $string .= $this->tab . ' * @param array $atts' . $this->newline;
            $string .= $this->tab . ' * @param string $content' . $this->newline;
            $string .= $this->tab . ' * @return void' . $this->newline;
            $string .= $this->tab . ' **/' . $this->newline;
            $string .= $this->tab . 'public function Markup($atts,$content=null){' . $this->newline;
            $string .= $this->tab . $this->tab . '// TODO: EDIT HTML SHORTCODES ' . strtoupper($shortcode['tag']) . '' . $this->newline;

            $_properties = array();
            $j = 0;
            foreach ($shortcode['properties'] as $properties)
            {
                if (isset($properties['name']))
                {
                    if ($properties['name'] != '')
                    {
                        if (!isset($properties['label']))
                        {
                            $properties['label'] = '';
                        }
                        if (!isset($properties['default']))
                        {
                            $properties['default'] = '';
                        }
                        $_properties[$j]['name'] = $properties['name'];
                        $_properties[$j]['label'] = $properties['label'];
                        $_properties[$j]['default'] = $properties['default'];
                        $j++;
                    }
                }
            }
            $string .= $this->tab . $this->tab . '$atts = shortcode_atts( array(' . $this->newline;
            if (count($_properties) != 0)
            {
                foreach ($_properties as $_property)
                {
                    $string .= $this->tab . $this->tab . '"' . $_property['name'] . '" => "' . $_property['default'] . '",' . $this->newline;
                    $example_markup = str_replace("{{" . $_property['name'] . "}}", '".$atts["' . $_property['name'] . '"]."', $example_markup);
                }
            }
            $string .= $this->tab . $this->tab . '), $atts,"' . $shortcode['tag'] . '" );' . $this->newline;

            $string .= $this->tab . $this->tab . 'if(' . strtoupper($this->Plugin_ShortName) . '_DEBUG==true){' . $this->newline;
            $string .= $this->tab . $this->tab . $this->tab . '$content .= "<div>" ; ' . $this->newline;
            $string .= $this->tab . $this->tab . $this->tab . '$content .= "<pre style=\"color:rgba(255,0,0,1);padding:3px;margin:0px;background:rgba(255,0,0,0.1);border:1px solid rgba(255,0,0,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">".__FILE__."</pre>" ; ' . $this->newline;
            $string .= $this->tab . $this->tab . $this->tab . '$content .= "</div>" ; ' . $this->newline;
            $string .= $this->tab . $this->tab . '}' . $this->newline;

            $string .= $this->tab . $this->tab . '$content .= "' . $example_markup . '";' . $this->newline;

            if (!isset($shortcode['sample_code']))
            {
                $shortcode['sample_code'] = 'null';
            }
            switch ($shortcode['sample_code'])
            {
                case 'wp_list_pages':
                    $sample_code_gen = new wpSampleCode($this->config);
                    $sample_code = $sample_code_gen->wp_list_pages(array(
                        'post_type' => $shortcode['post_type'],
                        'image_sizes' => $this->image_sizes,
                        'metaboxs' => $this->metaboxs), 2);
                    $string .= $sample_code['php'];
                    $string .= $this->tab . $this->tab . '$content .= $list_page;' . $this->newline;
                    break;
                case 'get_posts':
                    $sample_code_gen = new wpSampleCode($this->config);
                    $sample_code = $sample_code_gen->get_posts(array(
                        'post_type' => $shortcode['post_type'],
                        'image_sizes' => $this->image_sizes,
                        'metaboxs' => $this->metaboxs), 2);
                    $string .= $sample_code['php'];
                    break;
                case 'html_form':
                    $sample_code_gen = new wpSampleCode($this->config);
                    $sample_code = $sample_code_gen->html_form(array(
                        'post_type' => $shortcode['post_type'],
                        'image_sizes' => $this->image_sizes,
                        'metaboxs' => $this->metaboxs), 2);
                    $string .= $sample_code['php'];
                    $ajax_data = array(
                        'submit' => $shortcode['post_type'] . '_submit',
                        'admin' => false,
                        'sample_code' => 'insert_post',
                        'post_type' => $shortcode['post_type'],
                        'query' => array(),
                        );
                    $this->addAjax($ajax_data);
                    break;

                case 'html_form_recaptcha':
                    $sample_code_gen = new wpSampleCode($this->config);
                    $sample_code = $sample_code_gen->html_form(array(
                        'post_type' => $shortcode['post_type'],
                        'image_sizes' => $this->image_sizes,
                        'metaboxs' => $this->metaboxs,
                        'recaptcha' => true,
                        ), 2);
                    $string .= $sample_code['php'];
                    $ajax_data = array(
                        'submit' => $shortcode['post_type'] . '_submit',
                        'admin' => false,
                        'sample_code' => 'insert_post',
                        'post_type' => $shortcode['post_type'],
                        'query' => array(),
                        );
                    $this->addAjax($ajax_data);

                    $arg['admin'] = false;
                    $arg['src'] = $arg['code'] = $arg['function'] = $arg['construct'] = null;

                    $arg['src'] = 'https://www.google.com/recaptcha/api.js';
                    $arg['name'] = 'recaptcha';
                    $arg['deps'] = array('jquery');
                    $arg['for'] = 'JS for recaptcha';
                    $this->addJs($arg);


                    $this->options[] = array(
                        'name' => 'recaptcha_sitekey',
                        'label' => 'reCAPTCHA Site key',
                        'type' => 'text',
                        'default' => ' ',
                        'explanation' => ' ',
                        );

                    $this->options[] = array(
                        'name' => 'recaptcha_secretkey',
                        'label' => 'reCAPTCHA Secret Key',
                        'type' => 'text',
                        'default' => ' ',
                        'explanation' => ' ',
                        );

                    break;
            }


            $string .= $this->tab . $this->tab . 'return $content;' . $this->newline;
            $string .= $this->tab . '}' . $this->newline;
            $string .= '}' . $this->newline;
            $this->addClass(array('code' => $string, 'path' => 'shortcode.' . $shortcode['tag'] . '.inc.php'));

            if (!isset($shortcode['properties']))
            {
                $shortcode['properties'] = array();
            }

            /**
             * $ajax_data = null;
             * $ajax_data = array(
             * 'submit' => $shortcode['tag'] . '_modal',
             * 'admin' => true,
             * 'sample_code' => 'modal',
             * 'post_type' => $shortcode['post_type'],
             * 'enum' => $shortcode['properties'],
             * 'query' => array(),
             * );
             * $this->addAjax($ajax_data);
             **/
        }
    }

    /**
     * wpGenerator::codeOptions()
     * 
     * @return
     */
    private function codeOptions()
    {
        if (count($this->options) != 0)
        {
            $this->options = $this->validate($this->options, 'name');
        }

        $this->activation = true;
        $arg['construct'] = null;
        $arg['construct'] .= '$this->options = get_option("' . $this->Plugin_Prefix . '_plugins"); // get current option';
        $this->addFunction($arg);
        $arg['construct'] = null;
        $arg['admin'] = true;
        $arg['construct'] = 'add_action("admin_menu",array($this,"' . $this->Plugin_ShortName . '_admin_menu_option_page")); // add option page';
        $arg['function'] = null;
        $arg['function'] .= $this->tab . '/**' . $this->newline;
        $arg['function'] .= $this->tab . ' * Add option page.' . $this->newline;
        $arg['function'] .= $this->tab . ' * @link http://codex.wordpress.org/Function_Reference/add_options_page' . $this->newline;
        $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
        $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
        $arg['function'] .= $this->tab . ' **/' . $this->newline;
        $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_admin_menu_option_page()' . $this->newline;
        $arg['function'] .= $this->tab . '{' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . 'add_options_page(' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '__("' . addslashes($this->Plugin_Name) . ' Option","' . $this->Plugin_Lang . '"), //page title' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '__("' . addslashes($this->Plugin_Name) . ' Option","' . $this->Plugin_Lang . '"), //menu title' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"manage_options", //capability' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"' . $this->Plugin_ShortName . '_settings", //slug' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . 'array($this,"' . $this->Plugin_ShortName . '_admin_menu_option_page_markup")' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . ');' . $this->newline;
        $arg['function'] .= $this->tab . '}' . $this->newline;
        $arg['function'] .= $this->newline;
        $arg['function'] .= $this->newline;
        $arg['function'] .= $this->tab . '/**' . $this->newline;
        $arg['function'] .= $this->tab . ' * Create option page markup' . $this->newline;
        $arg['function'] .= $this->tab . ' *' . $this->newline;
        $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
        $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
        $arg['function'] .= $this->tab . ' **/' . $this->newline;
        $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_admin_menu_option_page_markup()' . $this->newline;
        $arg['function'] .= $this->tab . '{' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '$this->options = get_option("' . $this->Plugin_Prefix . '_plugins");' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '_e("<div class=\'wrap\'>");' . $this->newline;

        $arg['function'] .= $this->tab . $this->tab . '_e("<h1>".__("' . addslashes($this->Plugin_Name) . ' Option","' . $this->Plugin_Lang . '")."</h1>");' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '_e("<div class=\'postbox\'>");' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '_e("<div class=\'inside\'>");' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '_e("<form method=\'post\' action=\'options.php\'>");' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '// This prints out all hidden setting fields' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . 'settings_fields("' . $this->Plugin_ShortName . '_option_group");' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . 'do_settings_sections("' . $this->Plugin_ShortName . '-settings");' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . 'submit_button();' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '_e("</form>");' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '_e("</div>"); ' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '_e("</div>"); ' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '_e("</div>"); ' . $this->newline;
        $arg['function'] .= $this->tab . '}' . $this->newline;
        $arg['function'] .= $this->newline;
        $arg['function'] .= $this->newline;
        $this->addFunction($arg);
        $arg['construct'] = null;
        $arg['function'] = null;
        $arg['construct'] = 'add_action("admin_init",array($this,"' . $this->Plugin_ShortName . '_admin_menu_option_init"));';
        $arg['function'] .= $this->tab . '/**' . $this->newline;
        $arg['function'] .= $this->tab . ' * option instance' . $this->newline;
        $arg['function'] .= $this->tab . ' * @link https://codex.wordpress.org/Function_Reference/register_setting' . $this->newline;
        $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
        $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
        $arg['function'] .= $this->tab . ' **/' . $this->newline;
        $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_admin_menu_option_init()' . $this->newline;
        $arg['function'] .= $this->tab . '{' . $this->newline;
        $arg['function'] .= $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '#info: https://codex.wordpress.org/Function_Reference/register_setting ' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . 'register_setting(' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"' . $this->Plugin_ShortName . '_option_group",// group' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"' . $this->Plugin_Prefix . '_plugins", //name' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . 'array($this,"' . $this->Plugin_ShortName . '_admin_menu_option_sanitize") //sanitize_callback' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . ');' . $this->newline;
        $arg['function'] .= $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '#info: https://codex.wordpress.org/Function_Reference/add_settings_section ' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . 'add_settings_section(' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"' . $this->Plugin_ShortName . '_section_id", //id' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '__("Custom Settings","' . $this->Plugin_Lang . '"), //title' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . 'array($this,"' . $this->Plugin_ShortName . '_admin_menu_option_section_info"), //callback' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '"' . $this->Plugin_ShortName . '-settings" //page' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . ');' . $this->newline;
        $arg['function'] .= $this->newline;
        foreach ($this->options as $option)
        {
            if (!isset($option['label']))
            {
                $option['label'] = '&nbsp;';
            }
            $arg['function'] .= $this->tab . $this->tab . '#info: https://codex.wordpress.org/Function_Reference/add_settings_field' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . 'add_settings_field(' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . '"' . addslashes($option['name']) . '", //id' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . '__("' . addslashes($option['label']) . '","' . $this->Plugin_Lang . '"), //title' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . 'array($this,"' . $this->Plugin_ShortName . '_admin_menu_option_' . $option['name'] . '_callback"), //callback' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . '"' . $this->Plugin_ShortName . '-settings", //page' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . '"' . $this->Plugin_ShortName . '_section_id" //section' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . ');     ' . $this->newline;
            $arg['function'] .= $this->newline;
        }
        $arg['function'] .= $this->tab . '}' . $this->newline;
        $arg['function'] .= $this->newline;
        $arg['function'] .= $this->newline;
        $this->addFunction($arg);
        $arg['construct'] = null;
        $arg['function'] = null;
        $arg['function'] .= $this->tab . '/**' . $this->newline;
        $arg['function'] .= $this->tab . ' * Sanitize Callback ' . $this->newline;
        $arg['function'] .= $this->tab . ' * A callback function that sanitizes the option\'s value' . $this->newline;
        $arg['function'] .= $this->tab . ' * ' . $this->newline;
        $arg['function'] .= $this->tab . ' * @param mixed $input' . $this->newline;
        $arg['function'] .= $this->tab . ' * @see ' . $this->Plugin_ShortName . '_admin_menu_option_init()' . $this->newline;
        $arg['function'] .= $this->tab . ' **/' . $this->newline;
        $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_admin_menu_option_sanitize($input)' . $this->newline;
        $arg['function'] .= $this->tab . '{' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '$new_input = array();' . $this->newline;
        foreach ($this->options as $option)
        {
            $arg['function'] .= $this->tab . $this->tab . 'if(isset($input["' . $option['name'] . '"]))' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . '$new_input["' . $option['name'] . '"] = sanitize_text_field($input["' . $option['name'] . '"]);' . $this->newline;
            $arg['function'] .= $this->newline;
        }
        $arg['function'] .= $this->tab . $this->tab . 'return $new_input;' . $this->newline;
        $arg['function'] .= $this->tab . '}' . $this->newline;
        $arg['function'] .= $this->newline;
        $arg['function'] .= $this->newline;
        $this->addFunction($arg);
        $js_option = null;
        $css_code = '/** option css **/' . $this->newline;
        foreach ($this->options as $option)
        {
            $arg['function'] = null;
            $arg['function'] .= $this->tab . '/**' . $this->newline;
            $arg['function'] .= $this->tab . ' * Option page callback (' . $option['name'] . ')' . $this->newline;
            $arg['function'] .= $this->tab . ' * ' . $this->newline;
            $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
            $arg['function'] .= $this->tab . ' * @see ' . $this->Plugin_ShortName . '_admin_menu_option_init()' . $this->newline;
            $arg['function'] .= $this->tab . ' **/' . $this->newline;
            $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_admin_menu_option_' . $option['name'] . '_callback()' . $this->newline;
            $arg['function'] .= $this->tab . '{' . $this->newline;
            if (!isset($option['default']))
            {
                $option['default'] = '';
            }
            if (!isset($option['explanation']))
            {
                $option['explanation'] = '';
            }
            $deps[] = 'jquery';
            $deps[] = 'thickbox';
            $arg['function'] .= $this->tab . $this->tab . 'if(isset($this->options["' . $option['name'] . '"])){' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . '$current_' . $this->Plugin_ShortName . '_option_' . $option['name'] . ' = esc_attr($this->options["' . $option['name'] . '"]);' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . '}else{' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . '$current_' . $this->Plugin_ShortName . '_option_' . $option['name'] . ' = "' . $option['default'] . '";' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
            switch ($option['type'])
            {
                case 'radio':
                    $css_code .= '#' . $this->Plugin_ShortName . '_option_' . $option['name'] . '{' . $this->newline;
                    $css_code .= $this->tab . 'padding: 6px 12px;' . $this->newline;
                    $css_code .= $this->tab . 'height: 34px;' . $this->newline;
                    $css_code .= '}' . $this->newline;
                    $css_code .= $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$input = null ;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$input_options = array();' . $this->newline;
                    foreach ($option['enum'] as $_option)
                    {
                        if ($_option['value'] != '')
                        {
                            $arg['function'] .= $this->tab . $this->tab . '$input_options[] = array("value"=>"' . $_option['value'] . '","label"=>__("' . addslashes($_option['label']) . '","' . $this->Plugin_Lang . '")) ;' . $this->newline;
                        }
                    }
                    $arg['function'] .= $this->tab . $this->tab . '$input .= "<fieldset class=\'' . $this->Plugin_ShortName . '\'>";' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$z=1;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . 'foreach ($input_options as $input_option)' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '{' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '$selected="";' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . 'if($input_option["value"]== $current_' . $this->Plugin_ShortName . '_option_' . $option['name'] . '){ $selected="checked=\'checked\'";}' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '$input .= "<label for=\'' . $this->Plugin_Prefix . '_plugins_' . $option['name'] . '_".$z."\'><input id=\'' . $this->Plugin_Prefix . '_plugins_' . $option['name'] . '_".$z."\' name=\'' . $this->Plugin_Prefix . '_plugins[' . $option['name'] . ']\' type=\'radio\' value=\'".$input_option["value"]."\' ".$selected." />".$input_option["label"]."</label><br/>" ;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '$z++;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$input .= "</fieldset>";' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . 'printf($input);' . $this->newline;
                    break;
                case 'select':
                    $css_code .= '#' . $this->Plugin_ShortName . '_option_' . $option['name'] . '{' . $this->newline;
                    $css_code .= $this->tab . 'width: 25em;' . $this->newline;
                    $css_code .= $this->tab . 'padding: 6px 12px;' . $this->newline;
                    $css_code .= $this->tab . 'height: 34px;' . $this->newline;
                    $css_code .= '}' . $this->newline;
                    $css_code .= $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$input = null ;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$input_options = array();' . $this->newline;
                    if (!isset($option['enum']))
                    {
                        $option['enum'] = array();
                    }
                    foreach ($option['enum'] as $_option)
                    {
                        if ($_option['value'] != '')
                        {
                            $arg['function'] .= $this->tab . $this->tab . '$input_options[] = array("value"=>"' . $_option['value'] . '","label"=>__("' . addslashes($_option['label']) . '","' . $this->Plugin_Lang . '")) ;' . $this->newline;
                        }
                    }
                    $arg['function'] .= $this->tab . $this->tab . '$input .= "<select class=\'' . $this->Plugin_ShortName . '-form-control\' id=\'' . $this->Plugin_ShortName . '_option_' . $option['name'] . '\' name=\'' . $this->Plugin_Prefix . '_plugins[' . $option['name'] . ']\' >" ;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . 'foreach ($input_options as $input_option)' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '{' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '$selected="";' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . 'if($input_option["value"]==$current_' . $this->Plugin_ShortName . '_option_' . $option['name'] . '){ $selected="selected";}' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '$input .= "<option value=\'".$input_option["value"]."\' ".$selected.">".$input_option["label"]."</option>" ;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$input .= "</select>" ;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . 'printf($input);' . $this->newline;
                    break;
                case 'checkbox':
                    $css_code .= '#' . $this->Plugin_ShortName . '_option_' . $option['name'] . '{' . $this->newline;
                    $css_code .= $this->tab . 'padding: 6px 12px;' . $this->newline;
                    $css_code .= '}' . $this->newline;
                    $css_code .= $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$input = null ;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$input .= "<label class=\'' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-checkbox\'><input class=\'' . $this->Plugin_ShortName . '\' id=\'' . $this->Plugin_ShortName . '_option_' . $option['name'] . '\' type=\'checkbox\' name=\'' . $this->Plugin_Prefix . '_plugins[' . $option['name'] . ']\' value=\'1\' " . checked(1,$current_' . $this->Plugin_ShortName . '_option_' . $option['name'] . ',false). " /></label>" ;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$input .= __("' . addslashes($option['explanation']) . '","' . $this->Plugin_Lang . '") ;' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . 'printf($input);' . $this->newline;
                    break;
                case 'text':
                    $css_code .= '#' . $this->Plugin_ShortName . '_option_' . $option['name'] . '{' . $this->newline;
                    $css_code .= $this->tab . 'width: 25em;' . $this->newline;
                    $css_code .= $this->tab . 'padding: 6px 12px;' . $this->newline;
                    $css_code .= $this->tab . 'height: 34px;' . $this->newline;
                    $css_code .= '}' . $this->newline;
                    $css_code .= $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$description =  __("' . addslashes($option['explanation']) . '","' . $this->Plugin_Lang . '");' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . 'printf("<input class=\'' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-form-control\' id=\'' . $this->Plugin_ShortName . '_option_' . $option['name'] . '\' type=\'text\' name=\'' . $this->Plugin_Prefix . '_plugins[' . $option['name'] . ']\' value=\'%s\'/><p class=\'description\'>%s</p>",$current_' . $this->Plugin_ShortName . '_option_' . $option['name'] . ',$description);' . $this->newline;
                    break;
                case 'textarea':
                    $css_code .= '#' . $this->Plugin_ShortName . '_option_' . $option['name'] . '{' . $this->newline;
                    $css_code .= $this->tab . 'width: 25em;' . $this->newline;
                    $css_code .= $this->tab . 'padding: 6px 12px;' . $this->newline;
                    $css_code .= $this->tab . 'height: 102px;' . $this->newline;
                    $css_code .= '}' . $this->newline;
                    $css_code .= $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '$description =  __("' . addslashes($option['explanation']) . '","' . $this->Plugin_Lang . '");' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . 'printf("<textarea class=\'' . $this->Plugin_ShortName . ' ' . $this->Plugin_ShortName . '-form-control\' id=\'' . $this->Plugin_ShortName . '_option_' . $option['name'] . '\' name=\'' . $this->Plugin_Prefix . '_plugins[' . $option['name'] . ']\' >%s</textarea><p class=\'description\'>%s</p>",$current_' . $this->Plugin_ShortName . '_option_' . $option['name'] . ',$description);' . $this->newline;
                    break;

                case 'wpcolor':
                    $deps[] = 'wp-color-picker';
                    $sample_code_gen = new wpSampleCode($this->config);
                    $sample_code = $sample_code_gen->wpcolor(array(
                        'id' => $this->Plugin_ShortName . '_option_' . $option['name'],
                        'name' => $this->Plugin_Prefix . '_plugins[' . $option['name'] . ']',
                        'label' => $option['label'],
                        'explanation' => $option['explanation']), 2);
                    $arg['function'] .= $sample_code['php'];
                    $css_code .= $sample_code['css'];
                    $js_option .= $sample_code['js'];
                    break;
                case 'media-upload':
                    $deps[] = 'media-upload';
                    $sample_code_gen = new wpSampleCode($this->config);
                    $sample_code = $sample_code_gen->media_upload(array(
                        'id' => $this->Plugin_ShortName . '_option_' . $option['name'],
                        'name' => $this->Plugin_Prefix . '_plugins[' . $option['name'] . ']',
                        'label' => $option['label'],
                        'explanation' => $option['explanation']), 2);
                    $arg['function'] .= $sample_code['php'];
                    $css_code .= $sample_code['css'];
                    $js_option .= $sample_code['js'];
                    break;
                case 'wp_dropdown_pages':
                    $sample_code_gen = new wpSampleCode($this->config);
                    $sample_code = $sample_code_gen->wp_dropdown_pages(array(
                        'id' => $this->Plugin_ShortName . '_option_' . $option['name'],
                        'name' => $this->Plugin_Prefix . '_plugins[' . $option['name'] . ']',
                        'label' => $option['label'],
                        'post_type' => $option['sub_type'],
                        'explanation' => $option['explanation']), 2);
                    $arg['function'] .= $sample_code['php'];
                    $css_code .= $sample_code['css'];
                    break;
                case 'wp_dropdown_categories':
                    $sample_code_gen = new wpSampleCode($this->config);
                    $sample_code = $sample_code_gen->wp_dropdown_categories(array(
                        'id' => $this->Plugin_ShortName . '_option_' . $option['name'],
                        'name' => $this->Plugin_Prefix . '_plugins[' . $option['name'] . ']',
                        'label' => $option['label'],
                        'explanation' => $option['explanation']), 2);
                    $arg['function'] .= $sample_code['php'];
                    $css_code .= $sample_code['css'];
                    break;
                case 'wp_dropdown_users':
                    $sample_code_gen = new wpSampleCode($this->config);
                    $sample_code = $sample_code_gen->wp_dropdown_users(array(
                        'id' => $this->Plugin_ShortName . '_option_' . $option['name'],
                        'name' => $this->Plugin_Prefix . '_plugins[' . $option['name'] . ']',
                        'label' => $option['label'],
                        'explanation' => $option['explanation']), 2);
                    $arg['function'] .= $sample_code['php'];
                    $css_code .= $sample_code['css'];
                    break;
            }
            $arg['function'] .= $this->tab . '}' . $this->newline;
            $this->addFunction($arg);
            $arg = null;
            $arg['admin'] = true;
            $arg['src'] = $arg['code'] = $arg['function'] = $arg['construct'] = null;
            $arg['src'] = '/assets/js/' . $this->Plugin_ShortName . '_option.js';
            $arg['code'] .= '(function($)' . $this->newline;
            $arg['code'] .= '{' . $this->newline;
            $arg['code'] .= $js_option;
            $arg['code'] .= '})(jQuery);' . $this->newline;
            $arg['name'] = 'option';
            $arg['version'] = $this->Version;
            $arg['deps'] = array_unique($deps);
            $arg['hooks'] = array("settings_page_" . $this->Plugin_ShortName . "_settings");
            $arg['for'] = 'JS for Option';
            $this->addJs($arg);
        }
        $arg['function'] = null;
        $arg['construct'] = null;
        $arg['function'] .= $this->tab . '/**' . $this->newline;
        $arg['function'] .= $this->tab . ' * Display page option section' . $this->newline;
        $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
        $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
        $arg['function'] .= $this->tab . ' **/' . $this->newline;

        $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_admin_menu_option_section_info()' . $this->newline;
        $arg['function'] .= $this->tab . '{' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '//Display file path' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . 'if(' . strtoupper($this->Plugin_ShortName) . '_DEBUG==true){' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '$file_info = null; ' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '$file_info .= "<div>" ; ' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '$file_info .= "<pre style=\"color:rgba(255,0,0,1);padding:3px;margin:0px;background:rgba(255,0,0,0.1);border:1px solid rgba(255,0,0,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">%s:%s</pre>" ; ' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . '$file_info .= "</div>" ; ' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . $this->tab . 'printf($file_info,__FILE__,__LINE__);' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;

        $arg['function'] .= $this->tab . $this->tab . '_e("Enter your settings below:","' . $this->Plugin_Lang . '");' . $this->newline;
        $arg['function'] .= $this->tab . '}' . $this->newline;
        $this->addFunction($arg);
        $this->addFiles(array('path' => str_replace('_', '-', $this->Plugin_Prefix) . '/assets/css/' . $this->Plugin_ShortName . '_option.css', 'string' => $css_code));
        $this->addCss(array(
            'hooks' => array("settings_page_" . $this->Plugin_ShortName . "_settings"),
            'admin' => true,
            'version' => $this->Version,
            'src' => 'assets/css/' . $this->Plugin_ShortName . '_option.css',
            'name' => 'option',
            ));
    }


    /**
     * wpGenerator::codeAjax()
     * 
     * @return
     */
    private function codeAjax()
    {
        if (is_array($this->ajaxs))
        {
            $new_ajax = array();
            $z = 0;
            foreach ($this->ajaxs as $ajax)
            {


                $new_ajax[$z] = $ajax;
                $arg['path'] = $arg['code'] = $arg['function'] = $arg['construct'] = $arg['admin'] = null;

                if (!isset($ajax['admin']))
                {
                    $ajax['admin'] = false;
                }

                if ($ajax['admin'] == true)
                {
                    $arg['admin'] = true;
                } else
                {
                    $arg['admin'] = false;
                }

                // wp_ajax_nopriv_
                if ($arg['admin'] == true)
                {
                    $arg['admin'] = true;
                    $arg['construct'] = 'add_action("wp_ajax_' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '",array($this,"' . $this->Plugin_ShortName . '_ajax_' . $ajax['submit'] . '_response")); //response ajax (authenticated action)';
                    $arg['function'] .= $this->tab . '/**' . $this->newline;
                    $arg['function'] .= $this->tab . ' * Get reguest data from Ajax' . $this->newline;
                    $arg['function'] .= $this->tab . ' *' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                    $arg['function'] .= $this->tab . ' *' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @filesource: /assets/js/' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '.js' . $this->newline;
                    $arg['function'] .= $this->tab . ' **/' . $this->newline;
                    $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_ajax_' . $ajax['submit'] . '_response()' . $this->newline;
                    $arg['function'] .= $this->tab . '{' . $this->newline;
                    $extend_class = str_replace(' ', '', ucwords(str_replace('_', ' ', $ajax['submit'])));
                    $arg['function'] .= $this->tab . $this->tab . 'if(file_exists(' . $this->Plugin_Const . '_PATH . "/includes/ajax.' . $ajax['submit'] . '.inc.php' . '")){' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . 'require_once(' . $this->Plugin_Const . '_PATH . "/includes/ajax.' . $ajax['submit'] . '.inc.php' . '");' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '$' . $ajax['submit'] . '_ajax = new ' . $extend_class . '_Ajax($this);' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '$' . $ajax['submit'] . '_ajax->Response();' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
                    $arg['function'] .= $this->tab . '}' . $this->newline;
                    $this->addFunction($arg);


                    $string = '<?php' . $this->newline;
                    $string .= $this->newline;
                    $string .= '/**' . $this->newline;
                    $string .= ' * Authenticated AJAX actions (' . $ajax['submit'] . ')' . $this->newline;
                    $string .= ' *' . $this->newline;
                    $string .= '**/' . $this->newline;
                    $string .= $this->newline;
                    $string .= '# Exit if accessed directly' . $this->newline;
                    $string .= 'if(!defined("' . $this->Plugin_Const . '_EXEC")){' . $this->newline;
                    $string .= $this->tab . 'die();' . $this->newline;
                    $string .= '}' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->newline;

                    $string .= ' /**' . $this->newline;
                    $string .= '  * Get Reguest from ajax ' . $ajax['submit'] . $this->newline;
                    $string .= '  * ' . $this->newline;
                    $string .= '  * @package ' . $this->Plugin_Name . $this->newline;
                    $string .= '  * @author ' . $this->Author . $this->newline;
                    $string .= '  * @version ' . $this->Version . $this->newline;
                    $string .= '  * @access public' . $this->newline;
                    $string .= '  */' . $this->newline;
                    $string .= $this->newline;
                    $string .= 'class ' . $extend_class . '_Ajax{' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . '/**' . $this->newline;
                    $string .= $this->tab . ' * Option Plugin' . $this->newline;
                    $string .= $this->tab . ' * @access private' . $this->newline;
                    $string .= $this->tab . ' **/' . $this->newline;
                    $string .= $this->tab . 'private $options;' . $this->newline;

                    $string .= $this->tab . '/**' . $this->newline;
                    $string .= $this->tab . ' * Instance of a class' . $this->newline;
                    $string .= $this->tab . ' * ' . $this->newline;
                    $string .= $this->tab . ' * @access public' . $this->newline;
                    $string .= $this->tab . ' * @return void' . $this->newline;
                    $string .= $this->tab . ' **/' . $this->newline;

                    $string .= $this->tab . 'public function __construct(){' . $this->newline;
                    $string .= $this->tab . $this->tab . '$this->options = get_option("' . $this->Plugin_Prefix . '_plugins"); // get current option';
                    $string .= $this->newline;
                    $string .= $this->tab . '}' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->newline;

                    $string .= $this->tab . '/**' . $this->newline;
                    $string .= $this->tab . ' * Get Reguest from ajax and send a response' . $this->newline;
                    $string .= $this->tab . ' * ' . $this->newline;
                    $string .= $this->tab . ' * @param mixed $post' . $this->newline;
                    $string .= $this->tab . ' * @access public' . $this->newline;
                    $string .= $this->tab . ' * @return void' . $this->newline;
                    $string .= $this->tab . ' * Similar variable from $_POST["' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '"]' . $this->newline;
                    $string .= $this->tab . ' * @filesource : /js/' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '.js' . $this->newline;
                    $string .= $this->tab . ' **/' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . 'public function Response(){' . $this->newline;
                    // TODO: AJAX
                    if (isset($ajax['sample_code']))
                    {
                        switch ($ajax['sample_code'])
                        {
                            case 'modal':
                                $string .= $this->tab . $this->tab . '// TODO : Modal Dialog' . $this->newline;
                                $string .= $this->tab . $this->tab . '/**' . $this->newline;
                                $string .= $this->tab . $this->tab . ' * you can use iframe with source link /wp-admin/admin-ajax.php?action=' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '&TB_iframe=true' . $this->newline;
                                $string .= $this->tab . $this->tab . ' * @see add_thickbox();' . $this->newline;
                                $string .= $this->tab . $this->tab . ' * @link https://codex.wordpress.org/Javascript_Reference/ThickBox' . $this->newline;
                                $string .= $this->tab . $this->tab . ' **/' . $this->newline;
                                break;
                            case 'insert_post':
                                $sample_code = new wpSampleCode($this->config);
                                $insert_post_arg = array(
                                    'post_type' => $ajax['post_type'],
                                    'image_sizes' => $this->image_sizes,
                                    'metaboxs' => $this->metaboxs);

                                $code = $sample_code->insert_post($insert_post_arg, 2);
                                $string .= $code['php'];
                                $ajax['query'] = array();

                                foreach ($this->metaboxs as $metabox)
                                {
                                    foreach ($metabox['post_meta'] as $post_meta)
                                    {
                                        if (isset($post_meta['name']))
                                        {
                                            if (($post_meta['name'] != '') && (in_array($ajax['post_type'], $metabox['hooks'])))
                                            {
                                                $ajax['query'][] = $ajax['post_type'] . '_' . $post_meta['name'];
                                            }
                                        }
                                    }
                                }
                                $new_ajax[$z]['query'] = $ajax['query'];
                                break;
                            case 'no_code':
                                if (isset($ajax['query']))
                                {
                                    foreach ($ajax['query'] as $query)
                                    {
                                        if ($query != '')
                                        {
                                            $string .= $this->tab . $this->tab . '$' . $query . ' = htmlentities($_POST["' . $query . '"]);' . $this->newline;
                                            $string .= $this->tab . $this->tab . 'echo $' . $query . ';' . $this->newline;
                                        }
                                    }
                                }
                                $string .= $this->tab . $this->tab . 'echo "Response WP Ajax"; ' . $this->newline;
                                $string .= $this->tab . $this->tab . 'var_dump($_POST);' . $this->newline;
                                break;
                        }
                    }


                    $string .= $this->tab . $this->tab . 'die(); //required' . $this->newline;
                    $string .= $this->tab . '}' . $this->newline;
                    $string .= '}' . $this->newline;
                    $this->addClass(array(
                        'code' => $string,
                        'path' => 'ajax.' . $ajax['submit'] . '.inc.php',
                        'editable' => true));

                    if ($ajax['sample_code'] != 'modal')
                    {
                        //create JS
                        $arg['admin'] = true;
                        $arg['src'] = $arg['code'] = $arg['function'] = $arg['construct'] = null;
                        $arg['src'] = '/assets/js/' . $this->Plugin_ShortName . '_ajax_' . $ajax['submit'] . '.js';
                        $arg['code'] .= 'jQuery(document).ready(function($)' . $this->newline;
                        $arg['code'] .= '{' . $this->newline;
                        $arg['code'] .= $this->tab . '// wp ajax callback' . $this->newline;
                        $arg['code'] .= $this->tab . '// edit file : "/includes/ajax.' . $ajax['submit'] . '.inc.php"' . $this->newline;
                        $arg['code'] .= $this->tab . 'window.console && console.log("load: ' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '");' . $this->newline;
                        $arg['code'] .= $this->tab . '$("#' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '").click(function(){' . $this->newline;
                        $arg['code'] .= $this->tab . $this->tab . '$.post(' . $this->newline;
                        $arg['code'] .= $this->tab . $this->tab . $this->tab . 'ajaxurl,' . $this->newline;
                        $arg['code'] .= $this->tab . $this->tab . $this->tab . '{' . $this->newline;
                        if (isset($ajax['query']))
                        {
                            foreach ($ajax['query'] as $query)
                            {
                                if ($query != '')
                                {
                                    $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . '"' . $query . '":$("#' . $query . '").val(),' . $this->newline;
                                }
                            }
                        }
                        $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . '"action": "' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '" //required for wp ajax callback' . $this->newline;
                        $arg['code'] .= $this->tab . $this->tab . $this->tab . '},' . $this->newline;
                        $arg['code'] .= $this->tab . $this->tab . $this->tab . 'function(response){' . $this->newline;
                        $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'if(response==0){' . $this->newline;
                        $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . 'alert("Ops, authenticated only!");' . $this->newline;
                        $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . '}else{' . $this->newline;
                        $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . 'alert(response);' . $this->newline;
                        $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . '};' . $this->newline;

                        $arg['code'] .= $this->tab . $this->tab . $this->tab . '}' . $this->newline;
                        $arg['code'] .= $this->tab . $this->tab . ');' . $this->newline;
                        $arg['code'] .= $this->tab . '});' . $this->newline;
                        $arg['code'] .= '});' . $this->newline;
                        $arg['name'] = $ajax['submit'];
                        $arg['version'] = $this->Version;
                        $arg['deps'] = array('jquery');
                        $arg['for'] = 'wp_ajax: ' . $ajax['submit'];
                        $arg['admin'] = true;
                        $this->addJs($arg);
                    }

                } else
                {
                    $arg['admin'] = false;
                    $arg['construct'] = 'add_action("wp_ajax_nopriv_' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '",array($this,"' . $this->Plugin_ShortName . '_ajax_nopriv_' . $ajax['submit'] . '_response")); //response non-authenticated AJAX actions';
                    $arg['function'] .= $this->tab . '/**' . $this->newline;
                    $arg['function'] .= $this->tab . ' * Get reguest data from Ajax' . $this->newline;
                    $arg['function'] .= $this->tab . ' *' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
                    $arg['function'] .= $this->tab . ' *' . $this->newline;
                    $arg['function'] .= $this->tab . ' * @filesource: /assets/js/' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '.js' . $this->newline;
                    $arg['function'] .= $this->tab . ' **/' . $this->newline;
                    $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_ajax_nopriv_' . $ajax['submit'] . '_response()' . $this->newline;
                    $arg['function'] .= $this->tab . '{' . $this->newline;
                    $extend_class = str_replace(' ', '', ucwords(str_replace('_', ' ', $ajax['submit'])));
                    $arg['function'] .= $this->tab . $this->tab . 'if(file_exists(' . $this->Plugin_Const . '_PATH . "/includes/ajax_nopriv.' . $ajax['submit'] . '.inc.php' . '")){' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . 'require_once(' . $this->Plugin_Const . '_PATH . "/includes/ajax_nopriv.' . $ajax['submit'] . '.inc.php' . '");' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '$' . $ajax['submit'] . '_ajax = new ' . $extend_class . '_Ajax_NoPriv($this);' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . $this->tab . '$' . $ajax['submit'] . '_ajax->Response();' . $this->newline;
                    $arg['function'] .= $this->tab . $this->tab . '}' . $this->newline;
                    $arg['function'] .= $this->tab . '}' . $this->newline;
                    $this->addFunction($arg);


                    $string = '<?php' . $this->newline;
                    $string .= $this->newline;
                    $string .= '/**' . $this->newline;
                    $string .= ' * Non-authenticated AJAX actions (' . $ajax['submit'] . ')' . $this->newline;
                    $string .= ' *' . $this->newline;
                    $string .= '**/' . $this->newline;
                    $string .= $this->newline;
                    $string .= '# Exit if accessed directly' . $this->newline;
                    $string .= 'if(!defined("' . $this->Plugin_Const . '_EXEC")){' . $this->newline;
                    $string .= $this->tab . 'die();' . $this->newline;
                    $string .= '}' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->newline;

                    $string .= ' /**' . $this->newline;
                    $string .= '  * Get Reguest from ajax ' . $ajax['submit'] . $this->newline;
                    $string .= '  * ' . $this->newline;
                    $string .= '  * @package ' . $this->Plugin_Name . $this->newline;
                    $string .= '  * @author ' . $this->Author . $this->newline;
                    $string .= '  * @version ' . $this->Version . $this->newline;
                    $string .= '  * @access public' . $this->newline;
                    $string .= '  */' . $this->newline;
                    $string .= $this->newline;
                    $string .= 'class ' . $extend_class . '_Ajax_NoPriv{' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . '/**' . $this->newline;
                    $string .= $this->tab . ' * Option Plugin' . $this->newline;
                    $string .= $this->tab . ' * @access private' . $this->newline;
                    $string .= $this->tab . ' **/' . $this->newline;
                    $string .= $this->tab . 'private $options;' . $this->newline;

                    $string .= $this->tab . '/**' . $this->newline;
                    $string .= $this->tab . ' * Instance of a class' . $this->newline;
                    $string .= $this->tab . ' * ' . $this->newline;
                    $string .= $this->tab . ' * @access public' . $this->newline;
                    $string .= $this->tab . ' * @return void' . $this->newline;
                    $string .= $this->tab . ' **/' . $this->newline;

                    $string .= $this->tab . 'public function __construct(){' . $this->newline;
                    $string .= $this->tab . $this->tab . '$this->options = get_option("' . $this->Plugin_Prefix . '_plugins"); // get current option';
                    $string .= $this->newline;
                    $string .= $this->tab . '}' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->newline;

                    $string .= $this->tab . '/**' . $this->newline;
                    $string .= $this->tab . ' * Get Reguest from ajax and send a response' . $this->newline;
                    $string .= $this->tab . ' * ' . $this->newline;
                    $string .= $this->tab . ' * @param mixed $post' . $this->newline;
                    $string .= $this->tab . ' * @access public' . $this->newline;
                    $string .= $this->tab . ' * @return void' . $this->newline;
                    $string .= $this->tab . ' * Similar variable from $_POST["' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '"]' . $this->newline;
                    $string .= $this->tab . ' * @filesource : /js/' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '.js' . $this->newline;
                    $string .= $this->tab . ' **/' . $this->newline;
                    $string .= $this->newline;
                    $string .= $this->tab . 'public function Response(){' . $this->newline;

                    if (isset($ajax['sample_code']))
                    {
                        switch ($ajax['sample_code'])
                        {
                            case 'insert_post':
                                $sample_code = new wpSampleCode($this->config);
                                $insert_post_arg = array(
                                    'post_type' => $ajax['post_type'],
                                    'image_sizes' => $this->image_sizes,
                                    'metaboxs' => $this->metaboxs);

                                $code = $sample_code->insert_post($insert_post_arg, 2);
                                $string .= $code['php'];
                                $ajax['query'] = array();

                                foreach ($this->metaboxs as $metabox)
                                {
                                    foreach ($metabox['post_meta'] as $post_meta)
                                    {
                                        if (isset($post_meta['name']))
                                        {
                                            if (!isset($metabox['hooks']))
                                            {
                                                $metabox['hooks'] = array();
                                            }

                                            if (($post_meta['name'] != '') && (in_array($ajax['post_type'], $metabox['hooks'])))
                                            {
                                                $ajax['query'][] = $ajax['post_type'] . '_' . $post_meta['name'];
                                            }
                                        }

                                    }
                                }
                                $new_ajax[$z]['query'] = $ajax['query'];
                                break;
                            case 'no_code':
                                foreach ($ajax['query'] as $query)
                                {
                                    if ($query != '')
                                    {
                                        $string .= $this->tab . $this->tab . '$' . $query . ' = htmlentities($_POST["' . $query . '"]);' . $this->newline;
                                        $string .= $this->tab . $this->tab . 'echo $' . $query . ';' . $this->newline;
                                    }
                                }
                                $string .= $this->tab . $this->tab . 'echo "Response WP Ajax"; ' . $this->newline;
                                $string .= $this->tab . $this->tab . 'var_dump($_POST);' . $this->newline;
                                break;
                        }
                    }


                    $string .= $this->tab . $this->tab . 'die(); //required' . $this->newline;
                    $string .= $this->tab . '}' . $this->newline;
                    $string .= '}' . $this->newline;
                    $this->addClass(array(
                        'code' => $string,
                        'path' => 'ajax_nopriv.' . $ajax['submit'] . '.inc.php',
                        'editable' => true));

                    //create JS
                    $arg['admin'] = true;
                    $arg['src'] = $arg['code'] = $arg['function'] = $arg['construct'] = null;
                    $arg['src'] = '/assets/js/' . $this->Plugin_ShortName . '_ajax_nopriv_' . $ajax['submit'] . '.js';
                    $arg['code'] .= 'jQuery(document).ready(function($)' . $this->newline;
                    $arg['code'] .= '{' . $this->newline;
                    $arg['code'] .= $this->tab . '// wp ajax callback' . $this->newline;
                    $arg['code'] .= $this->tab . '// edit file : "/includes/ajax_nopriv.' . $ajax['submit'] . '.inc.php"' . $this->newline;
                    $arg['code'] .= $this->tab . 'window.console && console.log("load: ' . $this->Plugin_ShortName . '_ajax_nopriv_' . $ajax['submit'] . '");' . $this->newline;
                    $arg['code'] .= $this->tab . '$("#' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '").click(function(){' . $this->newline;
                    $arg['code'] .= $this->tab . $this->tab . '$.post(' . $this->newline;
                    $arg['code'] .= $this->tab . $this->tab . $this->tab . '' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '_url,' . $this->newline;
                    $arg['code'] .= $this->tab . $this->tab . $this->tab . '{' . $this->newline;
                    $code_head_js = ' _e("var ' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '_url = \'".admin_url("admin-ajax.php")."\';");' . $this->newline;

                    $this->addHeadJs(array('string' => $code_head_js));

                    foreach ($ajax['query'] as $query)
                    {
                        if ($query != '')
                        {
                            $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . '"' . $query . '":$("#' . $query . '").val(),' . $this->newline;
                        }
                    }
                    $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . '"action": "' . $this->Plugin_ShortName . '_' . $ajax['submit'] . '" //required for wp ajax callback' . $this->newline;
                    $arg['code'] .= $this->tab . $this->tab . $this->tab . '},' . $this->newline;
                    $arg['code'] .= $this->tab . $this->tab . $this->tab . 'function(response){' . $this->newline;

                    $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . 'if(response==0){' . $this->newline;
                    $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . 'alert("Ops, non-authenticated only!");' . $this->newline;
                    $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . '}else{' . $this->newline;
                    $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . '// reset form' . $this->newline;
                    foreach ($ajax['query'] as $query)
                    {
                        if ($query != '')
                        {
                            $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . '$("#' . $query . '").val("");' . $this->newline;
                        }
                    }
                    $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . $this->tab . 'alert(response);' . $this->newline;

                    $arg['code'] .= $this->tab . $this->tab . $this->tab . $this->tab . '};' . $this->newline;

                    $arg['code'] .= $this->tab . $this->tab . $this->tab . '}' . $this->newline;


                    $arg['code'] .= $this->tab . $this->tab . ');' . $this->newline;
                    $arg['code'] .= $this->tab . '});' . $this->newline;
                    $arg['code'] .= '});' . $this->newline;
                    $arg['name'] = $ajax['submit'];
                    $arg['version'] = $this->Version;
                    $arg['deps'] = array('jquery');
                    $arg['for'] = 'wp_ajax_nopriv: ' . $ajax['submit'];
                    $arg['admin'] = false;

                    $this->addJs($arg);
                }
                $z++;
            }
            $this->ajaxs = $new_ajax;


        } else
        {
            $this->ajaxs = array();
        }
    }
    /**
     * wpGenerator::codeToolbars()
     * @access private
     * @return void
     */
    private function codeToolbars()
    {
        $arg['admin'] = true;
        $priority = rand(55, 99);
        $arg['construct'] = 'add_action("wp_before_admin_bar_render",array($this,"' . $this->Plugin_ShortName . '_admin_bar"),' . $priority . '); //create admin toolbar';
        $arg['function'] = null;
        $arg['function'] .= $this->tab . '/**' . $this->newline;
        $arg['function'] .= $this->tab . ' * Add admin bar (toolbar)' . $this->newline;
        $arg['function'] .= $this->tab . ' * ' . $this->newline;
        $arg['function'] .= $this->tab . ' * @access public' . $this->newline;
        $arg['function'] .= $this->tab . ' * @return void' . $this->newline;
        $arg['function'] .= $this->tab . ' **/' . $this->newline;
        $arg['function'] .= $this->tab . 'public function ' . $this->Plugin_ShortName . '_admin_bar()' . $this->newline;
        $arg['function'] .= $this->tab . '{' . $this->newline;
        $arg['function'] .= $this->tab . $this->tab . 'global $wp_admin_bar;' . $this->newline;
        foreach ($this->toolbars as $toolbar)
        {
            if (!isset($toolbar['parent']))
            {
                $toolbar['parent'] = null;
            }
            if ($toolbar['parent'] != null)
            {
                $parent = $this->tab . $this->tab . $this->tab . '"parent" => "' . $toolbar['parent'] . '" //parent' . $this->newline;
                $level = 'sub';
            } else
            {
                $parent = '';
                $level = 'root';
            }
            $arg['function'] .= $this->newline;
            $arg['function'] .= $this->newline;
            $arg['function'] .= $this->tab . $this->tab . '#add link (' . $level . ')' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . '$wp_admin_bar->add_menu(array(' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . '"id" => "' . $toolbar['id'] . '", //id' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . '"title" => __("' . addslashes($toolbar['anchor']) . '","' . $this->Plugin_Lang . '"),//title' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . '"href" => "' . $toolbar['url'] . '", //href ' . $this->newline;
            $arg['function'] .= $parent;
            $arg['function'] .= $this->tab . $this->tab . $this->tab . ')' . $this->newline;
            $arg['function'] .= $this->tab . $this->tab . ');' . $this->newline;
        }
        $arg['function'] .= $this->newline;
        $arg['function'] .= $this->tab . '}' . $this->newline;
        $this->addFunction($arg);
    }

    /**
     * 
     * Generate Code Header
     * @access private
     * @return void
     * 
     */
    private function codeHeader()
    {
        $desc = str_replace(array(
            "\r\n",
            "\n",
            "\t"), " ", $this->Description);
        $string = null;
        $string .= '/' . '**' . $this->newline;
        $string .= $this->newline;
        $string .= 'Plugin Name: ' . $this->Plugin_Name . ' ' . $this->newline;
        $string .= 'Plugin URI: ' . $this->Plugin_URI . ' ' . $this->newline;
        $string .= 'Description: ' . $desc . '' . $this->newline;
        $string .= 'Version: ' . $this->Version . ' ' . $this->newline;
        $string .= 'Author: ' . $this->Author . ' ' . $this->newline;
        $string .= 'Author URI: ' . $this->Author_URI . ' ' . $this->newline;
        $string .= $this->newline;
        $string .= $this->Description . ' ' . $this->newline;
        $string .= $this->newline;
        $string .= $this->generator_by . $this->newline;
        $string .= $this->newline;
        $string .= '**' . '/' . $this->newline;
        $string .= $this->newline;
        $string .= '# Exit if accessed directly' . $this->newline;
        $string .= 'if (!defined("ABSPATH"))' . $this->newline;
        $string .= '{' . $this->newline;
        $string .= $this->tab . 'exit;' . $this->newline;
        $string .= '}' . $this->newline;
        $string .= $this->newline;
        return $string;
    }

    /**
     * wpGenerator::codeClass()
     * @access private
     * @return void
     */
    private function codeClass()
    {
        $z = 0;
        if (is_array($this->shortcodes))
        {
            foreach ($this->shortcodes as $shortcode)
            {

                $label = '';
                if ($z == 0)
                {
                    $label = 'Add Quicktag Buttons';
                }
                $this->options[] = array(
                    'name' => 'shortcode_' . $shortcode['tag'],
                    'label' => $label,
                    'type' => 'checkbox',
                    'default' => '1',
                    'explanation' => $shortcode['title'],
                    );
                $z++;
            }
        }
        // $this->codePreCssLess();
        if (count($this->options) != 0)
        {
            $this->options = $this->validate($this->options, 'name');
            $this->codeOptions();
        }

        if ($this->textdomain == true)
        {
            $this->codeTextDomain();
        }
        if ($this->activation == true)
        {
            $this->codeActivation();
        }
        if (count($this->toolbars) != 0)
        {
            $this->toolbars = $this->validate($this->toolbars, 'id');
            $this->codeToolbars();
        }
        if (count($this->shortcodes) != 0)
        {
            $this->shortcodes = $this->validate($this->shortcodes, 'tag');
            $this->shortcodes = $this->validate_multi_var($this->shortcodes, 'properties', 'name');
            $this->codeShortcodes();
        }
        if ($this->metaboxs != 0)
        {
            $this->metaboxs = $this->validate_multi_var($this->metaboxs, 'post_meta', 'name');
            $this->metaboxs = $this->validate($this->metaboxs, 'name');
            $this->codeMetabox();
        }

        if ($this->ajaxs != 0)
        {
            $this->ajaxs = $this->validate($this->ajaxs, 'submit');
            $this->codeAjax();
        }

        if ($this->javascripts != 0)
        {
            $this->javascripts = $this->validate($this->javascripts, 'name');
            $this->codeJS();
        }
        if ($this->styles != 0)
        {
            $this->styles = $this->validate($this->styles, 'name');
            $this->codeCSS();
        }
        if ($this->widgets != 0)
        {
            $this->widgets = $this->validate_multi_var($this->widgets, 'option', 'name');
            $this->widgets = $this->validate($this->widgets, 'id');
            $this->codeWidget();
        }
        if ($this->admin_menus == true)
        {
            $this->admin_menus = $this->validate($this->admin_menus, 'name');
            $this->codeAdminMenu();
        }
        if ($this->post_types != 0)
        {
            $this->post_types = $this->validate($this->post_types, 'name');
            $this->codePostType();
        }
        if ($this->image_sizes != 0)
        {
            $this->image_sizes = $this->validate($this->image_sizes, 'name');
            $this->codeImageSize();
        }

        if ($this->taxonomies != 0)
        {
            $this->taxonomies = $this->validate($this->taxonomies, 'name');
            $this->codeTaxonomies();
        }

        if ($this->head_js != 0)
        {
            $this->codeHeadJs();
        }

        if ($this->tinymces != 0)
        {
            $this->codeTinyMCE();
        }


        $string = null;
        $string .= '<?php' . $this->newline;
        $string .= $this->newline;
        $string .= $this->codeHeader();
        $string .= $this->codeConstant();
        $string .= $this->newline;
        $string .= '/**' . $this->newline;
        $string .= ' * Base Class Plugin' . $this->newline;
        $string .= ' * @author ' . $this->Author . $this->newline;
        $string .= ' *' . $this->newline;
        $string .= ' * @access public' . $this->newline;
        $string .= ' * @version ' . $this->Version . $this->newline;
        $string .= ' * @package ' . $this->Plugin_Name . $this->newline;
        $string .= ' *' . $this->newline;
        $string .= ' **/' . $this->newline;
        $string .= $this->newline;
        $string .= 'class ' . $this->Plugin_Class . $this->newline;
        $string .= '{' . $this->newline;
        if (count($this->options) != 0)
        {
            $string .= $this->tab . '/**' . $this->newline;
            $string .= $this->tab . ' * Option Plugin' . $this->newline;
            $string .= $this->tab . ' * @access private' . $this->newline;
            $string .= $this->tab . ' **/' . $this->newline;
            $string .= $this->tab . 'private $options;' . $this->newline;
        }
        $string .= $this->newline;


        $string .= $this->tab . '/**' . $this->newline;
        $string .= $this->tab . ' * Instance of a class' . $this->newline;
        $string .= $this->tab . ' * @access public' . $this->newline;
        $string .= $this->tab . ' * @return void' . $this->newline;
        $string .= $this->tab . ' **/' . $this->newline;

        $string .= $this->newline;
        $string .= $this->tab . 'function __construct()' . $this->newline;
        $string .= $this->tab . '{' . $this->newline;
        $admin_string = $user_string = $guest_string = null;
        foreach ($this->functions as $function)
        {
            if (isset($function['construct']))
            {
                if (!isset($function['admin']))
                {
                    $function['admin'] = false;
                }
                if ($function['admin'] == true)
                {
                    $admin_string .= $this->tab . $this->tab . $this->tab . $function['construct'] . $this->newline;
                } elseif (isset($function['user']))
                {
                    $user_string .= $this->tab . $this->tab . $function['construct'] . $this->newline;
                } else
                {
                    $guest_string .= $this->tab . $this->tab . $function['construct'] . $this->newline;
                }
            }
        }
        $string .= $guest_string;
        $string .= $this->tab . $this->tab . 'if(is_admin()){' . $this->newline;
        $string .= $admin_string;
        $string .= $this->tab . $this->tab . '}' . $this->newline;
        $string .= $this->tab . '}' . $this->newline;
        foreach ($this->functions as $function)
        {
            if (isset($function['function']))
            {
                $string .= $this->newline;
                $string .= $this->newline;
                $string .= $function['function'];
            }
        }
        $string .= '}' . $this->newline;
        $string .= $this->newline;
        $string .= $this->newline;
        $string .= 'new ' . $this->Plugin_Class . '();' . $this->newline;
        if ($this->activation == true)
        {
            $string .= 'register_activation_hook(__FILE__,array("' . $this->Plugin_Class . '","' . $this->Plugin_ShortName . '_activation"));' . $this->newline;
            $string .= 'register_deactivation_hook(__FILE__,array("' . $this->Plugin_Class . '","' . $this->Plugin_ShortName . '_deactivation"));' . $this->newline;
        }
        return $string;
    }
    /**
     * wpGenerator::codeReadme()
     * @access private
     * @return void
     */
    private function codeReadme()
    {
        $plugin_dirname = str_replace('_', '-', $this->Plugin_Prefix);
        $string = null;
        $string .= '=== ' . $this->Plugin_Name . ' ===' . $this->newline;
        $string .= '' . $this->newline;
        $string .= 'Contributors: ' . $this->Author . ' ' . $this->newline;
        $string .= 'Donate link: http://ihsana.com' . $this->newline;
        $string .= 'Tags:  ' . $this->Tags . $this->newline;
        $string .= 'Requires at least: ' . $this->Requires_at_least . $this->newline;
        $string .= 'Tested up to: ' . $this->Tested_up_to . $this->newline;
        $string .= 'Stable tag: ' . $this->Stable_tag . $this->newline;
        $string .= 'License: ' . $this->License . $this->newline;
        $string .= 'License URI: ' . $this->License_URI . $this->newline;
        $string .= $this->newline;
        $string .= '== Description ==' . $this->newline;
        $string .= $this->Description . '' . $this->newline;
        $string .= $this->newline;
        $string .= '== Installation ==' . $this->newline;
        $string .= '1. Unzip and Upload `' . $plugin_dirname . '.zip` to the `/wp-content/plugins/` directory' . $this->newline;
        $string .= '2. Activate the plugin through the \'Plugins\' menu in WordPress' . $this->newline;
        $string .= '3. Make configuration setting in plugin setting page.' . $this->newline;
        $string .= '4. hit "save setting" button.' . $this->newline;
        $string .= $this->newline;
        $string .= '== Frequently asked questions ==' . $this->newline;
        if (count($this->post_types) != 0)
        {
            foreach ($this->post_types as $post_type)
            {
                $string .= 'Q: I can not access page ' . $post_type['name'] . ', it say error `Oops! That page can\'t be found.`' . $this->newline;
                $string .= 'A: Go Settings Menu - permalink and click `Save Changes` again."' . $this->newline;
            }
        }
        $string .= '' . $this->newline;
        $string .= '== Screenshots ==' . $this->newline;
        $string .= '' . $this->newline;
        $string .= '== Changelog ==' . $this->newline;
        $string .= '' . $this->newline;
        $string .= '== Credits ==' . $this->newline;
        $string .= '' . $this->newline;
        $string .= '== Upgrade Notice == ';
        return $string;
    }
    /**
     * Generate WordPress API Code
     * 
     * @return array
     */
    public function Generate()
    {
        $plugin_dirname = str_replace('_', '-', $this->Plugin_Prefix);

        $this->styles[] = array('name' => 'main', 'src' => 'assets/css/' . $this->Plugin_ShortName . '_main.css');
        $this->javascripts[] = array(
            'name' => 'main',
            'src' => 'assets/js/' . $this->Plugin_ShortName . '_main.js',
            'deps' => array('jquery'));

        $this->addFiles(array('path' => $plugin_dirname . '/assets/js/' . $this->Plugin_ShortName . '_main.js', 'string' => ''));
        $this->addFiles(array('path' => $plugin_dirname . '/assets/css/' . $this->Plugin_ShortName . '_main.css', 'string' => ''));

        $this->addFiles(array('path' => $plugin_dirname . '/index.html', 'string' => ''));
        $this->addFiles(array('path' => $plugin_dirname . '/assets/css/index.html', 'string' => ''));
        $this->addFiles(array('path' => $plugin_dirname . '/assets/js/index.html', 'string' => ''));
        $this->addFiles(array('path' => $plugin_dirname . '/assets/images/index.html', 'string' => ''));
        $this->addFiles(array('path' => $plugin_dirname . '/templates/index.html', 'string' => ''));
        $code['readme'] = $this->codeReadme();
        $code['php'] = $this->codeClass();
        if ($this->javascripts != 0)
        {
            foreach ($this->javascripts as $javascript)
            {
                if (isset($javascript['code']))
                {
                    $path = str_replace('//', '/', $plugin_dirname . '/' . $javascript['src']);
                    $this->addFiles(array('path' => $path, 'string' => $javascript['code']));
                }
            }
        }
        $this->addFiles(array('path' => $plugin_dirname . '/readme.txt', 'string' => $code['readme']));
        $this->addFiles(array('path' => $plugin_dirname . '/' . $plugin_dirname . '.php', 'string' => $code['php']));

        if ($this->class != 0)
        {
            foreach ($this->class as $class)
            {
                if (isset($class['code']))
                {
                    $path = str_replace('//', '/', $plugin_dirname . '/includes/' . $class['path']);
                    $editable = false;
                    if (isset($class['editable']))
                    {
                        if ($class['code'] == true)
                        {
                            $editable = true;
                        }
                    }
                    $this->addFiles(array(
                        'path' => $path,
                        'string' => $class['code'],
                        'editable' => $editable));
                }
            }
        }

        if ($this->lock == 'false')
        {
            $this->zipFile($this->dir);
            $this->createFile($this->live_wp_test . '/wp-content/plugins/');
        }

        //$this->assets();
        //foreach ($this->assets as $files)
        //{
        //@copy($files['src'], $files['dest']);
        //}

    }


    /**
     * Create Zip file
     * 
     * @param array $build_path
     * @return void
     */
    private function zipFile($build_path)
    {
        $zip = new ZipArchive();
        $filename = $build_path . '/' . $this->Plugin_Prefix . ".zip";
        @mkdir($build_path, 0777, true);
        @unlink($filename);
        if ($zip->open($filename, ZIPARCHIVE::CREATE) !== true)
        {
            exit("There was an error, because it is not able to create a zip file (" . $filename . ")");
        }
        foreach ($this->files as $file)
        {
            $zip->addFromString($file['path'], $file['string']);
        }
        $zip->close();
    }
    /**
     * Create normal file
     * @param string file_path
     * @access private
     * @return void
     */
    private function createFile($build_path)
    {
        if ($this->reset == true)
        {
            foreach ($this->files as $file)
            {
                $dirname = $build_path . '/' . pathinfo($file['path'], PATHINFO_DIRNAME) . '/';
                foreach (glob($dirname . "/*.*") as $filename)
                {
                    @unlink($filename);
                }
            }
        }
        foreach ($this->files as $file)
        {
            $dirname = $build_path . '/' . pathinfo($file['path'], PATHINFO_DIRNAME) . '/';
            $src_dirname = $this->dir . '/assets/' . pathinfo($file['path'], PATHINFO_DIRNAME) . '/';
            @mkdir($src_dirname, 0777, true);
            @mkdir($dirname, 0777, true);
            file_put_contents($build_path . '/' . $file['path'], $file['string']);
        }
    }

    /**
     * wpGenerator::addFiles()
     * 
     * @param mixed $file
     * @return void
     */
    private function addFiles($file)
    {
        $this->files[] = $file;
    }
    /**
     * wpGenerator::addFunction()
     * 
     * @param mixed $arg
     * @return
     */
    private function addFunction($arg)
    {
        $this->functions[] = $arg;
    }
    /**
     * wpGenerator::addJs()
     * 
     * @param mixed $arg
     * @return
     */
    private function addJs($arg)
    {
        $this->javascripts[] = $arg;
        $this->javascripts = $this->validate($this->javascripts, 'name');
    }

    /**
     * wpGenerator::addClass()
     * 
     * @param mixed $arg
     * @return
     */
    private function addClass($arg)
    {
        $this->class[] = $arg;
    }

    /**
     * wpGenerator::addCss()
     * 
     * @param mixed $arg
     * 
     * $arg = array(
     *  'admin' => '',
     *  'version' => '',
     *  'src' => '',
     *  'name' => '',
     * }
     * 
     */
    private function addCss($arg)
    {
        $this->styles[] = $arg;
        $this->styles = $this->validate($this->styles, 'name');
    }


    /**
     * wpGenerator::addAjax()
     * 
     * @param mixed $arg
     * @return
     */
    private function addAjax($arg)
    {
        $this->ajaxs[] = $arg;
        $this->ajaxs = $this->validate($this->ajaxs, 'submit');
    }

    /**
     * wpGenerator::addWpHead()
     * 
     * @param mixed $arg
     * @return
     */
    private function addHeadJs($arg)
    {
        $this->head_js[] = $arg;
    }

    /**
     * wpGenerator::strToVariable()
     * 
     * @param mixed $string
     * @return
     */
    private function strToVariable($string)
    {
        $char = 'abcdefghijklmnopqrstuvwxyz_12345678900';
        $Allow = null;
        $string = str_replace(array(
            ' ',
            '-',
            '__'), '_', strtolower($string));
        $string = str_replace(array('___', '__'), '_', strtolower($string));
        for ($i = 0; $i < strlen($string); $i++)
        {
            if (strstr($char, $string[$i]) != false)
            {
                $Allow .= $string[$i];
            }
        }
        return $Allow;
    }


    /**
     * wpGenerator::remove_null()
     * 
     * @param mixed $input
     * @return
     */
    function remove_null($input)
    {
        if (isset($input))
        {
            foreach ($input as &$value)
            {
                if (is_array($value))
                {
                    $value = $this->remove_null($value);
                }
            }
            return array_filter($input);
        } else
        {
            return array();
        }
    }


    /**
     * wpGenerator::validate()
     * 
     * @param mixed $input_data
     * @param mixed $var
     * @param mixed $sub_var
     * @return void
     */
    private function validate($input_data, $var, $sub_var = null)
    {

        $new_input = $input = array();
        if (is_array($input_data))
        {
            foreach ($input_data as $_input_data)
            {
                $var_item = $_input_data[$var];
                $new_input[$var_item] = $_input_data;
            }
        } else
        {
            $new_input = array();
        }
        foreach (array_keys($new_input) as $key)
        {
            $input[] = $new_input[$key];
        }
        $output = null;
        $z = 0;
        foreach ($input as $_output)
        {
            if ($_output[$var] != '')
            {
                $output[$z] = $_output;
                $output[$z][$var] = $this->strToVariable($_output[$var]);
                if ($sub_var != null)
                {
                    $t = 0;
                    $new_output[$z][$sub_var] = $output[$z][$sub_var];
                    $output[$z][$sub_var] = array();
                    foreach ($new_output[$z][$sub_var] as $_sub_var)
                    {
                        if ($_sub_var != '')
                        {
                            $output[$z][$sub_var][] = $_sub_var;
                            $t++;
                        }
                    }
                }
                $z++;
            }
        }
        return $this->remove_null($output);

    }
    /**
     * wpGenerator::validate_multi_var()
     * 
     * @param mixed $input_data
     * @param mixed $var
     * @param mixed $sub_var
     * @return void
     */
    private function validate_multi_var($input_data, $var, $sub_var = null)
    {
        $_input_data = $this->remove_null($input_data);

        $output = array();
        $z = 0;
        foreach ($_input_data as $_output)
        {
            if (!isset($_output[$var]))
            {
                $_output[$var] = '';
            }
            if ($_output[$var] != '')
            {
                $output[$z] = $_output;
                if (is_array($_output[$var]))
                {
                    $x = 0;
                    foreach ($_output[$var] as $new_option)
                    {
                        if (isset($new_option[$sub_var]))
                        {
                            if (strlen($new_option[$sub_var]) > 2)
                            {
                                $output[$z][$var][$x] = $new_option;
                                $output[$z][$var][$x][$sub_var] = $this->strToVariable($new_option[$sub_var]);
                                $x++;
                            }

                        }
                    }
                }
                $z++;
            }
        }
        return $output;
    }

    /**
     * Copy to local assets
     * 
     * @return void
     */
    function assets($dirname = null)
    {
        if ($dirname == null)
        {
            $dirname = realpath($this->dir . '/assets/' . $this->Plugin_Prefix . '/');
        }

        $dirs = glob($dirname . '/*');
        foreach ($dirs as $dir)
        {
            if (is_file($dir) == true)
            {
                $dest = end(explode($this->Plugin_Prefix, $dir));

                $this->assets[] = array('src' => realpath($dir), 'dest' => $this->live_wp_test . '/wp-content/plugins/' . $this->Plugin_Prefix . '/' . $dest);
            } else
            {
                if (($dir != '.') || ($dir != '..'))
                {
                    $this->assets($dir);
                }
            }

        }

    }

}
