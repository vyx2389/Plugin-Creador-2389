<?php

/**
 * Example WordPress Code
 * 
 * @author Jasman <jasman@ihsana.com>
 * @copyright Ihsana IT Solution 2015
 * @license Commercial License
 * 
 * @package WordPress Plugin Maker
 */

/**
 * wpSampleCode
 * 
 * @package WordPress Plugin Maker
 * @author Jasman
 * @copyright 2015
 * @access public
 */
class wpSampleCode
{

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
     * config
     * @property-read array
     * @access private
     */
    private $config;

    /**
     * arg posts
     * @property-read array
     * @access private
     */


    private $arg_posts = array(
        'ID',
        'post_author',
        'post_date',
        'post_date_gmt',
        'post_content',
        'post_title',
        'post_excerpt',
        'post_status',
        'comment_status',
        'ping_status',
        'post_password',
        'post_name',
        'to_ping',
        'pinged',
        'post_modified',
        'post_modified_gmt',
        'post_content_filtered',
        'post_parent',
        'guid',
        'menu_order',
        'post_type',
        'post_mime_type',
        'comment_count',
        'filter');
    /**
     * arg users
     * @property-read array
     * @access private
     */
    private $arg_users = array(
        'user_nicename',
        'user_email',
        'user_url',
        'user_registered',
        'user_status',
        'display_name');

    /**
     * wpSampleCode::__construct()
     * 
     * @param mixed $config
     */
    function __construct($config)
    {
        $this->config = $config;
        $this->config['Plugin_Prefix'] = $this->strToVariable($this->config['Plugin_Name']);
    }


    /**
     * Insert HTML Form
     * 
     * @access public 
     * @param mixed $arg
     * @param integer $tab
     * @param string '' 
     * @return
     */
    public function html_form($arg, $numtab = 0, $str = '')
    {
        $metaboxs = $arg['metaboxs'];
        $post_type = $arg['post_type'];
        $image_sizes = $arg['image_sizes'];
        $code['php'] = null;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . '// TODO: FRONT-END FORM SUBMITION' . $this->newline;

        foreach ($metaboxs as $metabox)
        {
            foreach ($metabox['post_meta'] as $post_meta)
            {
                if (isset($post_meta['name']))
                {

                    if (!isset($post_meta['explanation']))
                    {
                        $post_meta['explanation'] = '';
                    }
                    if (!isset($metabox['hooks']))
                    {
                        $metabox['hooks'] = array();
                    }

                    if (($post_meta['name'] != '') && (in_array($post_type, $metabox['hooks'])))
                    {
                        switch (trim($post_meta['type']))
                        {
                            case 'text':

                                $code['php'] .= $this->tab($numtab) . '$content .= "<div class=\"' . $this->config['Plugin_ShortName'] . '-form-group\">";' . $this->newline;
                                $code['php'] .= $this->tab($numtab) . '$content .= "<label for=\"' . $post_type . '_' . $post_meta['name'] . '\">" . __("' . $post_meta['label'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain") ."</label>";' . $this->newline;
                                $code['php'] .= $this->tab($numtab) . '$content .= "<input class=\"' . $this->config['Plugin_ShortName'] . '-form-control\" type=\"text\" name=\"' . $post_type . '_' . $post_meta['name'] . '\" id=\"' . $post_type . '_' . $post_meta['name'] . '\" placeholder=\"' . $post_meta['explanation'] . '\"/>";' . $this->newline;
                                $code['php'] .= $this->tab($numtab) . '$content .= "</div>";' . $this->newline;

                                break;
                            case 'textarea':
                                $code['php'] .= $this->tab($numtab) . '$content .= "<div class=\"' . $this->config['Plugin_ShortName'] . '-form-group\">";' . $this->newline;
                                $code['php'] .= $this->tab($numtab) . '$content .= "<label for=\"' . $post_type . '_' . $post_meta['name'] . '\">" . __("' . $post_meta['label'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain") ."</label>";' . $this->newline;
                                $code['php'] .= $this->tab($numtab) . '$content .= "<textarea class=\"' . $this->config['Plugin_ShortName'] . '-form-control\" name=\"' . $post_type . '_' . $post_meta['name'] . '\" id=\"' . $post_type . '_' . $post_meta['name'] . '\" placeholder=\"' . $post_meta['explanation'] . '\"></textarea>";' . $this->newline;
                                $code['php'] .= $this->tab($numtab) . '$content .= "</div>";' . $this->newline;
                                break;
                            case 'select':
                                $code['php'] .= $this->tab($numtab) . '$content .= "<div class=\"' . $this->config['Plugin_ShortName'] . '-form-group\">";' . $this->newline;
                                $code['php'] .= $this->tab($numtab) . '$content .= "<label for=\"' . $post_type . '_' . $post_meta['name'] . '\">" . __("' . $post_meta['label'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain") ."</label>";' . $this->newline;

                                $code['php'] .= $this->tab($numtab) . '$content .= "<select class=\"' . $this->config['Plugin_ShortName'] . '-form-control\" name=\"' . $post_type . '_' . $post_meta['name'] . '\" id=\"' . $post_type . '_' . $post_meta['name'] . '\" >";' . $this->newline;
                                if (isset($post_meta['enum']))
                                {
                                    foreach ($post_meta['enum'] as $enum)
                                    {
                                        $code['php'] .= $this->tab($numtab) . '$content .= "<option value=\"' . $enum['value'] . '\">".__("' . $enum['label'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain")."</option>";' . $this->newline;
                                    }
                                }
                                $code['php'] .= $this->tab($numtab) . '$content .= "</select>";' . $this->newline;

                                $code['php'] .= $this->tab($numtab) . '$content .= "</div>";' . $this->newline;
                                break;
                            case 'radio':
                                $code['php'] .= $this->tab($numtab) . '$content .= "<div class=\"' . $this->config['Plugin_ShortName'] . '-form-group\">";' . $this->newline;
                                $code['php'] .= $this->tab($numtab) . '$content .= "<label for=\"' . $post_type . '_' . $post_meta['name'] . '\">" . __("' . $post_meta['label'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain") ."</label>";' . $this->newline;
                                $code['php'] .= $this->tab($numtab) . '$content .= "<div class=\"' . $this->config['Plugin_ShortName'] . '-radio\">";' . $this->newline;
                                if (isset($post_meta['enum']))
                                {
                                    foreach ($post_meta['enum'] as $enum)
                                    {
                                        $code['php'] .= $this->tab($numtab) . '$content .= "<label><input name=\"' . $post_type . '_' . $post_meta['name'] . '\" value=\"' . $enum['value'] . '\" type=\"radio\" />".__("' . $enum['label'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain")."</label>";' . $this->newline;
                                    }
                                }
                                $code['php'] .= $this->tab($numtab) . '$content .= "</div>";' . $this->newline;
                                $code['php'] .= $this->tab($numtab) . '$content .= "</div>";' . $this->newline;
                                break;
                            case 'checkbox':
                                $code['php'] .= $this->tab($numtab) . '$content .= "<div class=\"' . $this->config['Plugin_ShortName'] . '-form-group\">";' . $this->newline;
                                $code['php'] .= $this->tab($numtab) . '$content .= "<label for=\"' . $post_type . '_' . $post_meta['name'] . '\">" . __("' . $post_meta['label'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain") ."</label>";' . $this->newline;
                                $code['php'] .= $this->tab($numtab) . '$content .= "<div class=\"' . $this->config['Plugin_ShortName'] . '-checkbox\"><label><input type=\"checkbox\" name=\"' . $post_type . '_' . $post_meta['name'] . '\" id=\"' . $post_type . '_' . $post_meta['name'] . '\" />' . $post_meta['explanation'] . '</label></div>";' . $this->newline;

                                $code['php'] .= $this->tab($numtab) . '$content .= "</div>";' . $this->newline;
                                break;
                        }


                        $code['php'] .= $this->newline;

                    }
                }

            }
        }
        if (!isset($arg['recaptcha']))
        {
            $arg['recaptcha'] = false;
        }

        if ($arg['recaptcha'] == true)
        {
            $code['php'] .= $this->tab($numtab) . '// TODO: Adding reCAPTCHA ' . $this->newline;
            $code['php'] .= $this->tab($numtab) . '$content .= "<div class=\"' . $this->config['Plugin_ShortName'] . '-form-group\">";' . $this->newline;
            $code['php'] .= $this->tab($numtab) . '$content .= "<div class=\"g-recaptcha\" data-sitekey=\"".$this->options["recaptcha_sitekey"]."\"></div>";' . $this->newline;
            $code['php'] .= $this->tab($numtab) . '$content .= "</div>";' . $this->newline;
        }

        $code['php'] .= $this->tab($numtab) . '$content .= "<div class=\"' . $this->config['Plugin_ShortName'] . '-form-group\">";' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$content .= "<input id=\"' . $this->config['Plugin_ShortName'] . '_' . $post_type . '_submit\" class=\"' . $this->config['Plugin_ShortName'] . '-btn ' . $this->config['Plugin_ShortName'] . '-btn-primary\" type=\"submit\" name=\"' . $post_type . '_submit\" value=\"Submit\"/>";' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$content .= "</div>";' . $this->newline;


        return $code;
    }

    /**
     * Insert Post
     * 
     * @access public 
     * @param mixed $arg
     * @param integer $tab
     * @param string '' 
     * @return
     */

    public function insert_post($arg, $numtab = 0, $str = '')
    {
        $metaboxs = $arg['metaboxs'];
        $post_type = $arg['post_type'];
        $image_sizes = $arg['image_sizes'];
        if (!is_array($image_sizes))
        {
            $image_sizes = array();
        }
        $code['php'] = null;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . '// TODO: INSERT POST AND NECESSARY SANITIZATION AND VALIDATION' . $this->newline;

        $code['php'] .= $this->tab($numtab) . '/**' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * Insert the post into the database' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * @link https://codex.wordpress.org/Function_Reference/wp_insert_post' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * wp_insert_post() passes data through sanitize_post(), which itself handles all necessary sanitization and validation (kses, etc.)' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' **/' . $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . '//get variable post' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $post_type . '_title = "";' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'if(isset($_POST["' . $post_type . '_title"])){' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $post_type . '_title = wp_strip_all_tags($_POST["' . $post_type . '_title"]) ;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '}' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $post_type . '_content = "";' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'if(isset($_POST["' . $post_type . '_content"])){' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $post_type . '_content = wp_strip_all_tags($_POST["' . $post_type . '_content"]) ;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '}' . $this->newline;
        foreach ($metaboxs as $metabox)
        {
            foreach ($metabox['post_meta'] as $post_meta)
            {
                if (isset($post_meta['name']))
                {
                    if (!isset($metabox['hooks']))
                    {
                        $metabox['hooks'] = array();
                    }
                    if (($post_meta['name'] != '') && (in_array($post_type, $metabox['hooks'])))
                    {
                        $code['php'] .= $this->tab($numtab) . '$' . $post_type . '_postmeta_' . $post_meta['name'] . ' = "";' . $this->newline;
                        $code['php'] .= $this->tab($numtab) . 'if(isset($_POST["' . $post_type . '_' . $post_meta['name'] . '"])){' . $this->newline;
                        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $post_type . '_postmeta_' . $post_meta['name'] . ' = wp_strip_all_tags($_POST["' . $post_type . '_' . $post_meta['name'] . '"]) ;' . $this->newline;
                        $code['php'] .= $this->tab($numtab) . '}' . $this->newline;
                    }
                }
            }
        }
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . '//prepare data post' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$new_' . $post_type . '_post_arg = array(' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"post_title" => $' . $post_type . '_title,' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"post_content" => $' . $post_type . '_content,' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"post_status" => "pending", // (draft|publish|pending|future|private)' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"post_type" => "' . $post_type . '",' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ');' . $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . '//insert data post to database' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$new_' . $post_type . '_post_id = wp_insert_post($new_' . $post_type . '_post_arg);' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'if($new_' . $post_type . '_post_id){' . $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '//now you can use $post_id within add_post_meta or update_post_meta' . $this->newline;
        foreach ($metaboxs as $metabox)
        {
            foreach ($metabox['post_meta'] as $post_meta)
            {
                if (isset($post_meta['name']))
                {
                    if (!isset($metabox['hooks']))
                    {
                        $metabox['hooks'] = array();
                    }

                    if (($post_meta['name'] != '') && (in_array($post_type, $metabox['hooks'])))
                    {
                        $code['php'] .= $this->tab($numtab) . $this->tab . 'if (!add_post_meta($new_' . $post_type . '_post_id ,"_' . $this->config['Plugin_ShortName'] . '_postmeta_' . $post_meta['name'] . '", $' . $post_type . '_postmeta_' . $post_meta['name'] . ', true))' . $this->newline;
                        $code['php'] .= $this->tab($numtab) . $this->tab . '{' . $this->newline;
                        $code['php'] .= $this->tab($numtab) . $this->tab . $this->tab . 'update_post_meta($new_' . $post_type . '_post_id , "_' . $this->config['Plugin_ShortName'] . '_postmeta_' . $post_meta['name'] . '", $' . $post_type . '_postmeta_' . $post_meta['name'] . ');' . $this->newline;
                        $code['php'] .= $this->tab($numtab) . $this->tab . '}' . $this->newline;
                    }
                }
            }
        }
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . 'echo __("Thank you for submit","' . $this->config['Plugin_ShortName'] . '-textdomain") ;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '}else{' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . 'echo __("Error","' . $this->config['Plugin_ShortName'] . '-textdomain") ;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '}' . $this->newline;
        return $code;
    }


    /**
     * Display Get Single Post Variabel
     * 
     * @access public 
     * @param mixed $arg
     * @param integer $tab
     * @param string '' 
     * @return
     */
    public function single_post_init($arg, $numtab = 0, $str = '')
    {
        $metaboxs = $arg['metaboxs'];
        $post_type = $arg['post_type'];
        $image_sizes = $arg['image_sizes'];
        if (!is_array($image_sizes))
        {
            $image_sizes = array();
        }

        $code['php'] = null;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . '// TODO: EDIT SINGLE POST INIT' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '/**' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '* Single Post Variable' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '*/' . $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . '// get post id' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $str . 'postID = get_the_ID();' . $this->newline;

        $code['php'] .= $this->tab($numtab) . '// get current post' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$post = get_post();' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '// element post' . $this->newline;
        foreach ($this->arg_posts as $arg_post)
        {
            $code['php'] .= $this->tab($numtab) . '$' . $str . $arg_post . ' = $post->' . $arg_post . ';' . $this->newline;
        }

        $code['php'] .= $this->tab($numtab) . '// get post meta' . $this->newline;
        foreach ($metaboxs as $metabox)
        {
            foreach ($metabox['post_meta'] as $post_meta)
            {
                if (isset($post_meta['name']))
                {
                    if (!isset($metabox['hooks']))
                    {
                        $metabox['hooks'] = array();
                    }

                    if (($post_meta['name'] != '') && (in_array($post_type, $metabox['hooks'])))
                    {
                        $code['php'] .= $this->tab($numtab) . '$' . $str . 'post_meta_' . $post_meta['name'] . ' = get_post_meta($' . $str . 'postID,"_' . $this->config['Plugin_ShortName'] . '_postmeta_' . $post_meta['name'] . '",true);' . $this->newline;

                    }
                }
            }
        }
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . '// get attachment' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $str . 'thumbnail_id = get_post_thumbnail_id($' . $str . 'postID); //get attachment id ' . $this->newline;

        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . '// get thumbnail' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $str . 'image_thumbnail = get_the_post_thumbnail(); //with html' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $str . 'image_thumbnail_src = wp_get_attachment_image_src($' . $str . 'thumbnail_id);  ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $str . 'image_large_src = wp_get_attachment_image_src($' . $str . 'thumbnail_id,"large");  ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $str . 'image_medium_src = wp_get_attachment_image_src($' . $str . 'thumbnail_id,"medium"); ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $str . 'image_full_src = wp_get_attachment_image_src($' . $str . 'thumbnail_id,"full");' . $this->newline;
        foreach ($image_sizes as $image_size)
        {
            $code['php'] .= $this->tab($numtab) . '$' . $str . 'image_' . $image_size['name'] . '_src = wp_get_attachment_image_src($' . $str . 'thumbnail_id,"' . $this->config['Plugin_ShortName'] . '_' . $image_size['name'] . '");' . $this->newline;
        }


        $code['php'] .= $this->newline;
        $code['php'] .= $this->newline;
        return $code;
    }

    /**
     * Display Code Single Post
     * 
     * @access public 
     * 
     * @param mixed $arg
     * @param integer $tab
     * @param string ''
     * @return
     */

    public function single_post_use_variable($arg, $numtab = 0, $str = '')
    {
        $metaboxs = $arg['metaboxs'];
        $post_type = $arg['post_type'];
        $image_sizes = $arg['image_sizes'];
        $options = $arg['options'];

        $code['php'] = null;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . '// TODO: VIEW ALL VARIABLE' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '// start ~ please remove for distribution' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'if(' . strtoupper($this->config['Plugin_ShortName']) . '_DEBUG==true){' . $this->newline;
        $code['php'] .= $this->newline;

        $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<table style=\"font-size:12px;color:green;border-collapse: collapse;\">" ; ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><th>Type</th><th>Code</th><th>Current Value</th></tr>";' . $this->newline;

        foreach ($options as $option)
        {
            $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><td>option</td><td><pre style=\"color:rgba(0,0,255,1);padding:3px;margin:0px;background:rgba(0,0,255,0.1);border:1px solid rgba(0,0,255,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">\$' . $str . 'options[\"' . $option['name'] . '\"]</pre></td><td>".$' . $str . 'options["' . $option['name'] . '"]."</td></tr>";' . $this->newline;
        }


        $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><td>post</td><td><pre style=\"color:rgba(0,0,255,1);padding:3px;margin:0px;background:rgba(0,0,255,0.1);border:1px solid rgba(0,0,255,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">\$' . $str . 'postID</pre></td><td>".$' . $str . 'postID."</td></tr>";' . $this->newline;

        foreach ($this->arg_posts as $arg_post)
        {
            $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><td>post</td><td><pre style=\"color:rgba(0,0,255,1);padding:3px;margin:0px;background:rgba(0,0,255,0.1);border:1px solid rgba(0,0,255,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">\$' . $str . $arg_post . '</pre></td><td>".print_r($' . $str . $arg_post . ',true)."</td></tr>";' . $this->newline;

        }


        foreach ($metaboxs as $metabox)
        {
            foreach ($metabox['post_meta'] as $post_meta)
            {
                if (isset($post_meta['name']))
                {
                    if (!isset($metabox['hooks']))
                    {
                        $metabox['hooks'] = array();
                    }

                    if (($post_meta['name'] != '') && (in_array($post_type, $metabox['hooks'])))
                    {
                        //$code['php'] .= $this->tab($numtab)."//".$post_meta['type'].$this->newline;
                        $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><td>postmeta</td><td><pre style=\"color:rgba(0,0,255,1);padding:3px;margin:0px;background:rgba(0,0,255,0.1);border:1px solid rgba(0,0,255,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">\$' . $str . 'post_meta_' . $post_meta['name'] . '</pre></td><td>".print_r($' . $str . 'post_meta_' . $post_meta['name'] . ',true)."</td></tr>";' . $this->newline;
                        if ($post_meta['type'] == 'wp_dropdown_categories')
                        {
                            $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><td>postmeta</td><td><pre style=\"color:rgba(0,0,255,1);padding:3px;margin:0px;background:rgba(0,0,255,0.1);border:1px solid rgba(0,0,255,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">get_cat_name(\$' . $str . 'post_meta_' . $post_meta['name'] . ')</pre></td><td>".print_r(get_cat_name($' . $str . 'post_meta_' . $post_meta['name'] . '),true)."</td></tr>";' . $this->newline;
                        }
                        if ($post_meta['type'] == 'featured-image')
                        {
                            $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><td>postmeta</td><td><pre style=\"color:rgba(0,0,255,1);padding:3px;margin:0px;background:rgba(0,0,255,0.1);border:1px solid rgba(0,0,255,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">wp_get_attachment_image(\$' . $str . 'post_meta_' . $post_meta['name'] . ')</pre></td><td>".print_r(wp_get_attachment_image($' . $str . 'post_meta_' . $post_meta['name'] . '),true)."</td></tr>";' . $this->newline;
                            $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><td>postmeta</td><td><pre style=\"color:rgba(0,0,255,1);padding:3px;margin:0px;background:rgba(0,0,255,0.1);border:1px solid rgba(0,0,255,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">wp_get_attachment_url(\$' . $str . 'post_meta_' . $post_meta['name'] . ')</pre></td><td>".print_r(wp_get_attachment_url($' . $str . 'post_meta_' . $post_meta['name'] . '),true)."</td></tr>";' . $this->newline;
                        }
                    }
                }
            }
        }


        $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><td>thumbnail</td><td><pre style=\"color:rgba(0,0,255,1);padding:3px;margin:0px;background:rgba(0,0,255,0.1);border:1px solid rgba(0,0,255,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">\$' . $str . 'thumbnail_id</pre></td><td>".$' . $str . 'thumbnail_id."</td></tr>";' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><td>thumbnail</td><td><pre style=\"color:rgba(0,0,255,1);padding:3px;margin:0px;background:rgba(0,0,255,0.1);border:1px solid rgba(0,0,255,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">\$' . $str . 'image_thumbnail</pre></td><td>".$' . $str . 'image_thumbnail."</td></tr>";' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><td>thumbnail</td><td><pre style=\"color:rgba(0,0,255,1);padding:3px;margin:0px;background:rgba(0,0,255,0.1);border:1px solid rgba(0,0,255,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">\$' . $str . 'image_thumbnail_src</pre></td><td>".$' . $str . 'image_thumbnail_src."</td></tr>";' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><td>thumbnail</td><td><pre style=\"color:rgba(0,0,255,1);padding:3px;margin:0px;background:rgba(0,0,255,0.1);border:1px solid rgba(0,0,255,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">\$' . $str . 'image_large_src</pre></td><td>".$' . $str . 'image_large_src."</td></tr>";' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><td>thumbnail</td><td><pre style=\"color:rgba(0,0,255,1);padding:3px;margin:0px;background:rgba(0,0,255,0.1);border:1px solid rgba(0,0,255,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">\$' . $str . 'image_medium_src</pre></td><td>".$' . $str . 'image_medium_src."</td></tr>";' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><td>thumbnail</td><td><pre style=\"color:rgba(0,0,255,1);padding:3px;margin:0px;background:rgba(0,0,255,0.1);border:1px solid rgba(0,0,255,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">\$' . $str . 'image_full_src</pre></td><td>".$' . $str . 'image_full_src."</td></tr>";' . $this->newline;
        if (!is_array($image_sizes))
        {
            $image_sizes = array();
        }
        foreach ($image_sizes as $image_size)
        {
            $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "<tr><td>costum thumbnail</td><td><pre style=\"color:rgba(0,0,255,1);padding:3px;margin:0px;background:rgba(0,0,255,0.1);border:1px solid rgba(0,0,255,0.5);font-size:11px;font-family:monospace;white-space:pre-wrap;\">\$' . $str . 'image_' . $image_size['name'] . '_src</pre></td><td>".$' . $str . 'image_' . $image_size['name'] . '_src."</td></tr>";' . $this->newline;
        }

        $code['php'] .= $this->tab($numtab) . $this->tab . '$new_content .= "</table>" ; ' . $this->newline;

        $code['php'] .= $this->tab($numtab) . $this->tab . '// end' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '}' . $this->newline;
        return $code;
    }

    /**
     * Display Code Single Post
     * 
     * @access public 
     * 
     * @param mixed $arg
     * @param integer $tab
     * @param string ''
     * @return
     */

    public function single_post_review_layout($arg, $numtab = 0, $str = '')
    {
        $metaboxs = $arg['metaboxs'];
        $post_type = $arg['post_type'];
        $image_sizes = $arg['image_sizes'];
        if (!is_array($image_sizes))
        {
            $image_sizes = array();
        }
        $code['php'] = null;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . '// TODO: EDIT SINGLE POST LAYOUT' . $this->newline;
        $code['php'] .= $this->newline;

        $code['php'] .= $this->tab($numtab) . '$new_content .= "<div class=\"' . $this->config['Plugin_ShortName'] . '-row\">" ; ' . $this->newline;

        $code['php'] .= $this->tab($numtab) . '$new_content .= "<div class=\"' . $this->config['Plugin_ShortName'] . '-col-md-4\">" ; ' . $this->newline;


        foreach ($metaboxs as $metabox)
        {
            foreach ($metabox['post_meta'] as $post_meta)
            {
                if (isset($post_meta['name']))
                {
                    if (($post_meta['type'] == 'media-upload') && (in_array($post_type, $metabox['hooks'])))
                    {
                        $code['php'] .= $this->tab($numtab) . '$new_content .= "<img data-src=\"holder.js/207x300\" src=\"". $' . $str . 'post_meta_' . $post_meta['name'] . ' . "\" class=\"' . $this->config['Plugin_ShortName'] . '-thumbnail ' . $this->config['Plugin_ShortName'] . '-' . $post_type . '-' . $post_meta['name'] . ' \" />" ; ' . $this->newline;
                    }
                }
            }
        }

        $code['php'] .= $this->tab($numtab) . '$new_content .= "</div><!-- .//' . $this->config['Plugin_ShortName'] . '-col-md-4 -->" ; ' . $this->newline;

        $code['php'] .= $this->tab($numtab) . '$new_content .= "<div class=\"' . $this->config['Plugin_ShortName'] . '-col-md-8\">" ; ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$new_content .= "<dl class=\"' . $this->config['Plugin_ShortName'] . '-dl-horizontal\">" ; ' . $this->newline;
        foreach ($metaboxs as $metabox)
        {
            foreach ($metabox['post_meta'] as $post_meta)
            {
                if (isset($post_meta['name']))
                {
                    $code['php'] .= $this->tab($numtab) . "//" . $post_meta['type'] . $this->newline;

                    if (!isset($post_meta['label']))
                    {
                        $post_meta['label'] = '';
                    }
                    if (!isset($metabox['hooks']))
                    {
                        $metabox['hooks'] = array();
                    }

                    if (($post_meta['type'] != 'media-upload') && ($post_meta['name'] != '') && (in_array($post_type, $metabox['hooks'])))
                    {
                        $code['php'] .= $this->tab($numtab) . '$new_content .= "<dt>". __("' . $post_meta['label'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain"). "</dt><dd>".$' . $str . 'post_meta_' . $post_meta['name'] . '."</dd>";' . $this->newline;
                    }

                    if (($post_meta['type'] == 'wp_dropdown_categories') && ($post_meta['name'] != '') && (in_array($post_type, $metabox['hooks'])))
                    {
                        $code['php'] .= $this->tab($numtab) . '$new_content .= "<dt>". __("' . $post_meta['label'] . ' Text","' . $this->config['Plugin_ShortName'] . '-textdomain"). "</dt><dd>".get_cat_name($' . $str . 'post_meta_' . $post_meta['name'] . ')."</dd>";' . $this->newline;
                    }
                    if (($post_meta['type'] == 'featured-image') && ($post_meta['name'] != '') && (in_array($post_type, $metabox['hooks'])))
                    {
                        $code['php'] .= $this->tab($numtab) . '$new_content .= "<dt>". __("' . $post_meta['label'] . ' URL","' . $this->config['Plugin_ShortName'] . '-textdomain"). "</dt><dd>".wp_get_attachment_url($' . $str . 'post_meta_' . $post_meta['name'] . ')."</dd>";' . $this->newline;
                    }

                }
            }
        }
        $code['php'] .= $this->tab($numtab) . '$new_content .= "<dl>" ; ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$new_content .= "</div><!-- .//' . $this->config['Plugin_ShortName'] . '-col-md-8 -->" ; ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$new_content .= "</div><!-- .//' . $this->config['Plugin_ShortName'] . '-row -->" ; ' . $this->newline;


        return $code;
    }


    /**
     * Display list page
     * 
     * @param mixed $arg
     * @param integer $tab
     * @return
     */
    public function get_posts($arg, $numtab = 0)
    {
        $post_type = $arg['post_type'];
        $image_sizes = $arg['image_sizes'];
        $metaboxs = $arg['metaboxs'];
        $code['php'] = null;
        $code['php'] .= $this->tab($numtab) . '// TODO: EDIT LAYOUT POST DATA' . $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . '/**' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '* Example Get ' . $post_type . '.' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '*/' . $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . '$posts_args = array(' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"posts_per_page" => 5, ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"post_status" => "publish", ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"post_type" => "' . $post_type . '", ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ');' . $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . '$_' . $post_type . 's = get_posts($posts_args);' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'foreach($_' . $post_type . 's as $_' . $post_type . '){' . $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '/** ======= VARIABLE PER POST ======= **/' . $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '/** get attachment **/' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$attachment_id = get_post_thumbnail_id($_' . $post_type . '->ID); //get attachment id ' . $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '/** get thumbnail */' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$image_thumbnail_src = wp_get_attachment_image_src($attachment_id);  ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$image_large_src = wp_get_attachment_image_src($attachment_id,"large");  ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$image_medium_src = wp_get_attachment_image_src($attachment_id,"medium"); ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$image_full_src = wp_get_attachment_image_src($attachment_id,"full");' . $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '/** costum thumbnail */' . $this->newline;
        if (is_array($image_sizes))
        {
            foreach ($image_sizes as $image_size)
            {
                $code['php'] .= $this->tab($numtab) . $this->tab . '$image_' . $image_size['name'] . '_src = wp_get_attachment_image_src($attachment_id,"' . $this->config['Plugin_ShortName'] . '_' . $image_size['name'] . '");' . $this->newline;
            }
        }
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab . $this->tab . $this->tab . '/** post meta (from metabox) **/' . $this->newline;
        foreach ($metaboxs as $metabox)
        {
            foreach ($metabox['post_meta'] as $post_meta)
            {
                if (isset($post_meta['name']))
                {
                    if ($post_meta['name'] != '')
                    {
                        if (!isset($metabox['hooks']))
                        {
                            $metabox['hooks'] = array();
                        }

                        if (($post_meta['name'] != '') && (in_array($post_type, $metabox['hooks'])))
                        {
                            $code['php'] .= $this->tab($numtab) . $this->tab . '$post_meta_' . $post_meta['name'] . ' = get_post_meta($_' . $post_type . '->ID,"_' . $this->config['Plugin_ShortName'] . '_postmeta_' . $post_meta['name'] . '",true);' . $this->newline;
                        }
                    }
                }
            }
        }
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '/**' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '* Retrieve full permalink for current post or post ID.' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '* This function is an alias for get_permalink().' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '* @since 3.9.0' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '**/ ' . $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . 'if(function_exists("get_the_permalink")){' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . $this->tab . '$' . $post_type . '_link = get_the_permalink($_' . $post_type . '->ID); ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '}else{' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . $this->tab . '$' . $post_type . '_link = get_permalink($_' . $post_type . '->ID); ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '}' . $this->newline;

        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '/**' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . ' * get post author.' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . ' * you can also use $' . $post_type . '_post_author = get_userdata($_' . $post_type . '->post_author); ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . ' **/ ' . $this->newline;
        $code['php'] .= $this->newline;

        foreach ($this->arg_users as $arg_user)
        {
            $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $post_type . '_post_author["' . $arg_user . '"] = get_the_author_meta("' . $arg_user . '",$_' . $post_type . '->post_author); ' . $this->newline;
        }

        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '/** ======= .//VARIABLE PER POST ======= **/' . $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '// var_dump($_' . $post_type . '); // remove comment for display all properties' . $this->newline;

        $code['php'] .= $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . 'echo "<div>";' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . 'echo "<h4><a href=\"".$' . $post_type . '_link."\">" . $_' . $post_type . '->post_title . "</a></h4>"; ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . 'echo "<p>By <a href=\"".$' . $post_type . '_post_author["user_url"]."\">" . $' . $post_type . '_post_author["display_name"] . "</a></p>"; ' . $this->newline;

        $code['php'] .= $this->tab($numtab) . $this->tab . 'if($image_thumbnail_src[0] != ""){ ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . $this->tab . 'echo "<img src=\'".$image_thumbnail_src[0]."\' />"; ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '} ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . 'echo "</div>"; ' . $this->newline;

        $code['php'] .= $this->tab($numtab) . '}' . $this->newline;

        $code['php'] .= $this->newline;
        $code['php'] .= $this->newline;

        return $code;
    }


    /**
     * Display List page costum
     * 
     * @param mixed $arg
     * @param integer $numtab
     * @return
     */
    function wp_list_pages($arg, $numtab = 0)
    {

        //TODO TAMBAH WALKER
        // create php
        $code['php'] = null;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '// TODO: EDIT LAYOUT LIST PAGE' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '/**' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * Create HTML List Pages Using API' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * @see https://codex.wordpress.org/Function_Reference/wp_list_pages' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '*/' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $arg['post_type'] . '_args = array(' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"link_after" => "", //markup after link' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"link_before" => "", //markup before link' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"title_li" => "",' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"echo" => 0,' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"post_type" => "' . $arg['post_type'] . '",' . $this->newline;

        $code['php'] .= $this->tab($numtab) . ');' . $this->newline;

        $code['php'] .= $this->tab($numtab) . '$list_' . $arg['post_type'] . ' = wp_list_pages($' . $arg['post_type'] . '_args) ;' . $this->newline;

        $code['php'] .= $this->tab($numtab) . '$list_page = null;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$list_page .= "<ul>";' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$list_page .= $list_' . $arg['post_type'] . ';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$list_page .= "</ul>";' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        return $code;

    }
    /**
     * Display Code Color Picker
     * 
     * @param mixed $var
     * @param integer $numtab
     * @return void
     */
    public function wpcolor($var = array(), $numtab = 0)
    {
        $code['css'] = $code['php'] = $code['js'] = null;
        // create css
        $code['css'] .= '#' . $var['id'] . '{' . $this->newline;
        $code['css'] .= $this->tab . 'padding: 6px 12px;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;
        // create php
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '/**' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * Create HTML using wp-color-picker' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * @see https://codex.wordpress.org/Function_Reference/wp-color-picker' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '*/' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '// need these styles' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'wp_enqueue_style("wp-color-picker");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '// create form input' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'printf("<input class=\'' . $this->config['Plugin_ShortName'] . '-form-control\' id=\'' . $var['id'] . '\' type=\'text\' name=\'' . $var['name'] . '\' value=\'%s\'/><p class=\'description\'>". __("' . $var['explanation'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain") . "</p>",$current_' . $var['id'] . ');' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->newline;
        $code['js'] .= $this->tab($numtab) . '/** color picker api **/' . $this->newline;
        $code['js'] .= $this->tab($numtab) . '$(function(){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . '$("#' . $var['id'] . '").wpColorPicker();' . $this->newline;
        $code['js'] .= $this->tab($numtab) . '});' . $this->newline;

        return $code;
    }

    /**
     * Display Datepicker
     * 
     * @param mixed $var
     * @param integer $numtab
     * @return void
     */
    public function datepicker($var = array(), $numtab = 0)
    {
        $code['css'] = $code['php'] = $code['js'] = null;
        // create css
        $code['css'] .= '#' . $var['id'] . '{' . $this->newline;
        $code['css'] .= $this->tab . 'padding: 6px 12px;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        $code['css'] .= '#ui-datepicker-div{' . $this->newline;
        $code['css'] .= $this->tab . 'font-size:85%;' . $this->newline;
        $code['css'] .= $this->tab . 'border-radius:0;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;
        $code['css'] .= '#ui-datepicker-div .ui-datepicker-header{' . $this->newline;
        $code['css'] .= $this->tab . 'border-radius:0;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        // create php
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '/**' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * Create jQuery IU - Datepicker' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '*/' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '// need these styles' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'wp_enqueue_style("jquery-ui-datepicker");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '// create form input' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'printf("<input class=\'' . $this->config['Plugin_ShortName'] . '-form-control\' id=\'' . $var['id'] . '\' type=\'text\' name=\'' . $var['name'] . '\' value=\'%s\'/><p class=\'description\'>". __("' . $var['explanation'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain") . "</p>",$current_' . $var['id'] . ');' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->newline;
        $code['js'] .= $this->tab($numtab) . '/** datepicker api **/' . $this->newline;
        $code['js'] .= $this->tab($numtab) . '$(function(){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . '$("#' . $var['id'] . '").datepicker({dateFormat:"d MM, yy"});' . $this->newline;
        $code['js'] .= $this->tab($numtab) . '});' . $this->newline;

        return $code;
    }

    /**
     * Featured Upload
     * 
     * @param mixed $var
     * @param integer $numtab
     * @return string
     * 
     * @var $var = array('name' =>'','default' => '','explanation' => '','label'=>'')
     * 
     */
    function featured_image($var, $numtab = 0, $str = '')
    {
        $code['css'] = $code['php'] = $code['js'] = null;

        $code['js'] .= $this->tab($numtab) . $this->newline;


        $code['php'] .= $this->tab($numtab) . 'global $post;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '// Get WordPress media upload URL' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $var['name'] . '_upload_link = esc_url( get_upload_iframe_src("image", $post->ID ) );' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '// Get the image src' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $var['name'] . '_img_src = wp_get_attachment_image_src($current_' . $var['name'] . ', "full" );' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '// For convenience, see if the array is valid' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $var['name'] . '_have_img = is_array( $' . $var['name'] . '_img_src );' . $this->newline;


        $code['php'] .= $this->tab($numtab) . 'print( "<div class=\"' . $var['name'] . '-img-container\">");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'if ( $' . $var['name'] . '_have_img ){' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'print("<img src=\"". $' . $var['name'] . '_img_src[0] ."\" alt=\"\" style=\"max-width:100%;\" />");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '}' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'print("</div>");' . $this->newline;

        $code['php'] .= $this->tab($numtab) . 'print("<p class=\"hide-if-no-js\">");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'print("<a class=\"' . $var['name'] . '-upload-img ");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'if($' . $var['name'] . '_have_img){echo "hidden";}' . $this->newline;

        $code['php'] .= $this->tab($numtab) . 'print( "\"  href=\"".  $upload_link ."\">");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '_e("Set custom image");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'print( "</a>");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'print( "<a class=\"' . $var['name'] . '-delete-img ");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'if ( ! $' . $var['name'] . '_have_img  ) { echo "hidden"; }' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'print( "\" href=\"#\">");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '_e("Remove this image");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'print( "</a>");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'print( "</p>");' . $this->newline;

        $code['php'] .= $this->tab($numtab) . 'print( "<input class=\"' . $var['name'] . '-img-id\" name=\"' . $var['name'] . '\" type=\"hidden\" value=\"". esc_attr($current_' . $var['name'] . ')."\" />");' . $this->newline;


        $code['js'] .= $this->tab($numtab) . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->newline;
        $code['js'] .= $this->tab($numtab) . '$(function(){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . "  // Set all variables to be used in scope" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "  var frame_" . $var['id'] . "," . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      metaBox_" . $var['id'] . " = $('.postbox'), // Your meta box id here" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      addImgLink_" . $var['id'] . "= metaBox_" . $var['id'] . ".find('." . $var['name'] . "-upload-img')," . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      delImgLink_" . $var['id'] . " = metaBox_" . $var['id'] . ".find( '." . $var['name'] . "-delete-img')," . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      imgContainer_" . $var['id'] . " = metaBox_" . $var['id'] . ".find( '." . $var['name'] . "-img-container')," . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      imgIdInput_" . $var['id'] . " = metaBox_" . $var['id'] . ".find( '." . $var['name'] . "-img-id' );" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "  " . $this->newline;
        $code['js'] .= $this->tab($numtab) . "  // ADD IMAGE LINK" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "  addImgLink_" . $var['id'] . ".on( 'click', function( event ){" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    " . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    event.preventDefault();" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    " . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    // If the media frame already exists, reopen it." . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    if ( frame_" . $var['id'] . " ) {" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      frame_" . $var['id'] . ".open();" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      return;" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    }" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    " . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    // Create a new media frame" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    frame_" . $var['id'] . " = wp.media({" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      title: 'Select or Upload Media Of Your Chosen Persuasion'," . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      button: {" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "        text: 'Use this media'" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      }," . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      multiple: false  // Set to true to allow multiple files to be selected" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    });" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    " . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    // When an image is selected in the media frame..." . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    frame_" . $var['id'] . ".on( 'select', function() {" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      " . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      // Get media attachment details from the frame state" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      var attachment = frame_" . $var['id'] . ".state().get('selection').first().toJSON();" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      // Send the attachment URL to our custom image input field." . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      imgContainer_" . $var['id'] . ".append( '<img src=\"'+attachment.url+'\" alt=\"\" style=\"max-width:180px;\"/>' );" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      // Send the attachment id to our hidden input" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      imgIdInput_" . $var['id'] . ".val( attachment.id );" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      // Hide the add image link" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      addImgLink_" . $var['id'] . ".addClass( 'hidden' );" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      // Unhide the remove image link" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "      delImgLink_" . $var['id'] . ".removeClass( 'hidden' );" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    });" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    // Finally, open the modal on click" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    frame_" . $var['id'] . ".open();" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "  });" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "  " . $this->newline;
        $code['js'] .= $this->tab($numtab) . "  " . $this->newline;
        $code['js'] .= $this->tab($numtab) . "  // DELETE IMAGE LINK" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "  delImgLink_" . $var['id'] . ".on( 'click', function( event ){" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    event.preventDefault();" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    // Clear out the preview image" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    imgContainer_" . $var['id'] . ".html( '' );" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    // Un-hide the add image link" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    addImgLink_" . $var['id'] . ".removeClass( 'hidden' );" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    // Hide the delete image link" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    delImgLink_" . $var['id'] . ".addClass( 'hidden' );" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    // Delete the image id from the hidden input" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "    imgIdInput_" . $var['id'] . ".val( '' );" . $this->newline;
        $code['js'] .= $this->tab($numtab) . "  });" . $this->newline;

        $code['js'] .= $this->tab($numtab) . '});' . $this->newline;
        return $code;

    }


    /**
     * Display Code Upload Multiplex
     * 
     * @param mixed $var
     * @param integer $numtab
     * @return string
     * 
     * @var $var = array('name' =>'','default' => '','explanation' => '','label'=>'')
     * 
     */

    public function media_upload_dinamic($var = array(), $numtab = 0)
    {
        $code['css'] = $code['php'] = $code['js'] = null;

        $code['css'] .= '.' . $var['id'] . '_form_input{' . $this->newline;
        $code['css'] .= $this->tab . "padding: 6px 12px;" . $this->newline;
        $code['css'] .= $this->tab . "height: 34px;" . $this->newline;
        $code['css'] .= $this->tab . "min-width: 100%;" . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        // create css
        $code['css'] .= $this->newline;
        $code['css'] .= '.' . $var['id'] . '_preview img{' . $this->newline;
        $code['css'] .= $this->tab . 'margin: 5px 5px 5px 0;' . $this->newline;
        $code['css'] .= $this->tab . 'padding: 4px;' . $this->newline;
        $code['css'] .= $this->tab . 'background-color: #fff;' . $this->newline;
        $code['css'] .= $this->tab . 'border: 1px solid #ddd;' . $this->newline;
        $code['css'] .= $this->tab . 'box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.075);' . $this->newline;
        $code['css'] .= $this->tab . '-moz-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.075);' . $this->newline;
        $code['css'] .= $this->tab . '-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.075);' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        $code['css'] .= '.' . $var['id'] . '_add_image{' . $this->newline;
        $code['css'] .= $this->tab . 'margin-top: 15px;' . $this->newline;
        $code['css'] .= $this->tab . 'padding-top: 15px;' . $this->newline;

        $code['css'] .= '}' . $this->newline;

        $code['css'] .= $this->newline;
        $code['css'] .= '.' . $var['id'] . '_action .button{' . $this->newline;
        $code['css'] .= $this->tab . 'margin-bottom: 6px;' . $this->newline;
        $code['css'] .= $this->tab . 'margin-top: 6px;' . $this->newline;
        $code['css'] .= $this->tab . 'margin-right: 6px;' . $this->newline;
        $code['css'] .= $this->tab . 'margin-left: 0;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        $code['css'] .= '.' . $var['id'] . '_remove_image{' . $this->newline;
        $code['css'] .= $this->tab . 'display: inline-block;' . $this->newline;
        $code['css'] .= $this->tab . 'margin-bottom: 6px;' . $this->newline;
        $code['css'] .= $this->tab . 'margin-top: 10px;' . $this->newline;
        $code['css'] .= $this->tab . 'margin-right: 6px;' . $this->newline;
        $code['css'] .= $this->tab . 'height: 28px;' . $this->newline;
        $code['css'] .= $this->tab . 'height: 28px;' . $this->newline;
        $code['css'] .= $this->tab . 'padding: 0px 10px 1px;' . $this->newline;
        $code['css'] .= $this->tab . 'color: #999;' . $this->newline;
        $code['css'] .= $this->tab . 'text-decoration: none;' . $this->newline;
        $code['css'] .= $this->tab . 'font-size: 13px;' . $this->newline;
        $code['css'] .= $this->tab . 'line-height: 1.8em;' . $this->newline;
        $code['css'] .= $this->tab . 'margin-left: 0;' . $this->newline;
        $code['css'] .= '}' . $this->newline;

        $code['css'] .= '.' . $var['id'] . '_remove_image:hover{' . $this->newline;
        $code['css'] .= $this->tab . 'color: #CD1010;' . $this->newline;
        $code['css'] .= '}' . $this->newline;


        $code['css'] .= $this->newline;
        $code['css'] .= '#' . $var['id'] . '_new_images{' . $this->newline;
        $code['css'] .= $this->tab . 'margin-left: 0px;' . $this->newline;
        $code['css'] .= $this->tab . 'margin-bottom: 5px;' . $this->newline;
        $code['css'] .= $this->tab . 'margin-top: 5px;' . $this->newline;
        $code['css'] .= $this->tab . 'margin-right: 5px;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        $code['css'] .= '#' . $var['id'] . '_box{' . $this->newline;


        $code['css'] .= $this->tab . 'min-height: 42px;' . $this->newline;
        $code['css'] .= $this->tab . 'max-height: 640px;' . $this->newline;
        $code['css'] .= $this->tab . 'overflow: auto;' . $this->newline;
        $code['css'] .= $this->tab . 'padding: 0px;' . $this->newline;
        $code['css'] .= $this->tab . 'border: 1px solid #DFDFDF;' . $this->newline;
        //$code['css'] .= $this->tab . 'background-color: #FDFDFD;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        $code['css'] .= 'table.table-' . $var['id'] . '{' . $this->newline;
        $code['css'] .= $this->tab . 'margin: 0;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;
        $code['css'] .= 'table.table-' . $var['id'] . ' td{' . $this->newline;
        $code['css'] .= $this->tab . 'margin: 5px;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        $code['css'] .= 'table.table-' . $var['id'] . ' >tbody >tr:nth-of-type(odd){' . $this->newline;
        $code['css'] .= $this->tab . 'background-color:#f9f9f9;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        $code['css'] .= 'table.table-' . $var['id'] . ' td{' . $this->newline;
        $code['css'] .= $this->tab . 'vertical-align: top;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        // create php
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '/**' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * Create HTML and Using Thickbox for Iframe From Upload' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * @see https://codex.wordpress.org/Function_Reference/thickbox' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '*/' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '// need these styles' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'wp_enqueue_style("thickbox");' . $this->newline;

        $code['php'] .= $this->tab($numtab) . '$description = __("' . $var['explanation'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$remove_this = __("Remove this image","' . $this->config['Plugin_ShortName'] . '-textdomain");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$add_this = __("Change image","' . $this->config['Plugin_ShortName'] . '-textdomain");' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $var['id'] . '_input = null;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $var['id'] . '_input .= \'<div id="' . $var['id'] . '_box">\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $var['id'] . '_input .= \'<table id="' . $var['id'] . '_form_upload" class="form-table table-' . $var['id'] . '">\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $var['id'] . '_input .= \'<tbody>\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$z=0;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$arr_current_' . $var['id'] . ' = json_decode($current_' . $var['id'] . ',true);' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'if(!is_array($arr_current_' . $var['id'] . ')){' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$arr_current_' . $var['id'] . ' = array();' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '}' . $this->newline;

        $code['php'] .= $this->tab($numtab) . 'foreach($arr_current_' . $var['id'] . ' as $_' . $var['id'] . '){' . $this->newline;

        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $var['id'] . '_input .= \'<tr>\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $var['id'] . '_input .= \'<td style="width:200px;">\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $var['id'] . '_input .= \'<div class="' . $var['id'] . '_preview"><img height="120" src="\'.$_' . $var['id'] . '.\'" /></div>\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $var['id'] . '_input .= \'</td>\';' . $this->newline;

        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $var['id'] . '_input .= \'<td>\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $var['id'] . '_input .= \'<input type="text" class="' . $var['id'] . '_form_input" name="' . $var['name'] . '[]" value="\'. $_' . $var['id'] . '. \'" />\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $var['id'] . '_input .= \'<br/>\';' . $this->newline;

        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $var['id'] . '_input .= \'<div class="' . $var['id'] . '_action">\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $var['id'] . '_input .= \'<a class="' . $var['id'] . '_change_image button button-primary" href="#"><span class="dashicons dashicons-upload"></span></a>\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $var['id'] . '_input .= \'<a class="' . $var['id'] . '_remove_image" href="#"><span class="dashicons dashicons-dismiss"></span></a>\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $var['id'] . '_input .= \'</div>\';' . $this->newline;

        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $var['id'] . '_input .= \'</td>\';' . $this->newline;


        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $var['id'] . '_input .= \'</tr>\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$z++;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '}' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $var['id'] . '_input .= \'</tbody>\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $var['id'] . '_input .= \'</table>\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $var['id'] . '_input .= \'</div>\';' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$' . $var['id'] . '_input .= \'<a class="button button-default" href="#" id="' . $var['id'] . '_new_images" >\'. __("Add new Images","' . $this->config['Plugin_ShortName'] . '-textdomain") . \'</a>\';' . $this->newline;

        $code['php'] .= $this->tab($numtab) . 'printf($' . $var['id'] . '_input);' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->newline;


        $code['js'] .= $this->tab($numtab) . $this->newline;
        $code['js'] .= $this->tab($numtab) . '//media upload api (Dinamic File Upload)' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->newline;
        $code['js'] .= $this->tab($numtab) . '$(function(){' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . '$("#' . $var['id'] . '_form_upload").on("click",".' . $var['id'] . '_form_input",function(event){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'var markup_preview = $(this).parent().parent().find(".' . $var['id'] . '_preview");' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . 'imgurl = $(this).val();' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . 'var preview = $("<img/>").attr("src",imgurl).height(120);' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . '$(markup_preview).html(preview).fadeIn();' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . '});' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . '$("#' . $var['id'] . '_new_images").on("click",function(event){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'event.preventDefault();' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'var domElm = "";' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'domElm += "<tr>";' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'domElm += "<td style=\"width:200px;\"><div class=\"' . $var['id'] . '_preview\"><img height=\"120\" src=\"data:image/gif;base64,R0lGODlhAQABAPcAAAAAAAAAMwAAZgAAmQAAzAAA/wArAAArMwArZgArmQArzAAr/wBVAABVMwBVZgBVmQBVzABV/wCAAACAMwCAZgCAmQCAzACA/wCqAACqMwCqZgCqmQCqzACq/wDVAADVMwDVZgDVmQDVzADV/wD/AAD/MwD/ZgD/mQD/zAD//zMAADMAMzMAZjMAmTMAzDMA/zMrADMrMzMrZjMrmTMrzDMr/zNVADNVMzNVZjNVmTNVzDNV/zOAADOAMzOAZjOAmTOAzDOA/zOqADOqMzOqZjOqmTOqzDOq/zPVADPVMzPVZjPVmTPVzDPV/zP/ADP/MzP/ZjP/mTP/zDP//2YAAGYAM2YAZmYAmWYAzGYA/2YrAGYrM2YrZmYrmWYrzGYr/2ZVAGZVM2ZVZmZVmWZVzGZV/2aAAGaAM2aAZmaAmWaAzGaA/2aqAGaqM2aqZmaqmWaqzGaq/2bVAGbVM2bVZmbVmWbVzGbV/2b/AGb/M2b/Zmb/mWb/zGb//5kAAJkAM5kAZpkAmZkAzJkA/5krAJkrM5krZpkrmZkrzJkr/5lVAJlVM5lVZplVmZlVzJlV/5mAAJmAM5mAZpmAmZmAzJmA/5mqAJmqM5mqZpmqmZmqzJmq/5nVAJnVM5nVZpnVmZnVzJnV/5n/AJn/M5n/Zpn/mZn/zJn//8wAAMwAM8wAZswAmcwAzMwA/8wrAMwrM8wrZswrmcwrzMwr/8xVAMxVM8xVZsxVmcxVzMxV/8yAAMyAM8yAZsyAmcyAzMyA/8yqAMyqM8yqZsyqmcyqzMyq/8zVAMzVM8zVZszVmczVzMzV/8z/AMz/M8z/Zsz/mcz/zMz///8AAP8AM/8AZv8Amf8AzP8A//8rAP8rM/8rZv8rmf8rzP8r//9VAP9VM/9VZv9Vmf9VzP9V//+AAP+AM/+AZv+Amf+AzP+A//+qAP+qM/+qZv+qmf+qzP+q///VAP/VM//VZv/Vmf/VzP/V////AP//M///Zv//mf//zP///wAAAAAAAAAAAAAAACH5BAEAAPwALAAAAAABAAEAAAgEANEEBAA7\" /></div></td>";' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'domElm += "<td><input type=\"text\" class=\"' . $var['id'] . '_form_input\" name=\"' . $var['name'] . '[]\" /><br/><div class=\"' . $var['id'] . '_action\"> <a class=\"' . $var['id'] . '_change_image button button-primary\" href=\"#\" ><span class=\"dashicons dashicons-upload\"></span></a> <a class=\"' . $var['id'] . '_remove_image\" href=\"#\" ><span class=\"dashicons dashicons-dismiss\"></span></a></td></div>";' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'domElm += "</tr>";' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '$("#' . $var['id'] . '_form_upload tbody").append(domElm);' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . '});' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . '$("#' . $var['id'] . '_form_upload").on("click",".' . $var['id'] . '_remove_image",function(event){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'event.preventDefault();' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '$(this).parent().parent().parent().replaceWith("");' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . '});' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . '$("#' . $var['id'] . '_form_upload").on("click",".' . $var['id'] . '_change_image",function(event){' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'var markup_preview = $(this).parent().parent().parent().find(".' . $var['id'] . '_preview");' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'var image_form_input = $(this).parent().parent().parent().find(".' . $var['id'] . '_form_input");' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'event.preventDefault();' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'var send_to_editor_old = window.send_to_editor ;' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'window.send_to_editor = function(content_html){' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . 'imgurl = $(content_html).attr("src");' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . 'var preview = $("<img/>").attr("src",imgurl).height(120);' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . '$(markup_preview).html(preview).fadeIn();' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . '$(image_form_input).val(imgurl);' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . 'tb_remove();' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . 'window.send_to_editor = send_to_editor_old ;' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '};' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'tb_show("' . $var['label'] . '","media-upload.php?type=image&amp;TB_iframe=1&amp;referer=' . $this->config['Plugin_ShortName'] . '_option");' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'return false;' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . '});' . $this->newline;
        $code['js'] .= $this->tab($numtab) . '});' . $this->newline;

        return $code;

    }

    /**
     * Display Code Upload
     * 
     * @param mixed $var
     * @param integer $numtab
     * @return string
     * 
     * @var $var = array('name' =>'','default' => '','explanation' => '','label'=>'')
     * 
     */

    public function media_upload($var = array(), $numtab = 0)
    {
        $code['css'] = $code['php'] = $code['js'] = null;

        // create css
        $code['css'] .= '#' . $var['id'] . '{' . $this->newline;
        $code['css'] .= $this->tab . 'padding: 6px 12px;' . $this->newline;
        $code['css'] .= $this->tab . 'height: 34px;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;
        $code['css'] .= '#' . $var['id'] . '_preview img{' . $this->newline;
        $code['css'] .= $this->tab . 'margin: 5px 5px 5px 0;' . $this->newline;
        $code['css'] .= $this->tab . 'padding: 4px;' . $this->newline;
        $code['css'] .= $this->tab . 'background-color: #fff;' . $this->newline;
        $code['css'] .= $this->tab . 'border: 1px solid #ddd;' . $this->newline;
        $code['css'] .= $this->tab . 'box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.075);' . $this->newline;
        $code['css'] .= $this->tab . '-moz-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.075);' . $this->newline;
        $code['css'] .= $this->tab . '-webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.075);' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;
        $code['css'] .= '#' . $var['id'] . '_remove{' . $this->newline;
        $code['css'] .= $this->tab . 'margin-left: 5px;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;
        // create php
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '/**' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * Create HTML and Using Thickbox for Iframe From Upload' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * @see https://codex.wordpress.org/Function_Reference/thickbox' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '*/' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '// need these styles' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'wp_enqueue_style("thickbox");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$description = __("' . $var['explanation'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$remove_this = __("Remove this image","' . $this->config['Plugin_ShortName'] . '-textdomain");' . $this->newline;

        $code['php'] .= $this->tab($numtab) . 'printf("<input id=\"' . $var['id'] . '\" type=\"hidden\" name=\"' . $var['name'] . '\" value=\"%s\"/><div id=\"' . $var['id'] . '_preview\"></div> <a id=\"' . $var['id'] . '_upload\" href=\"#\" class=\"button button-primary\"><span class=\"dashicons dashicons-upload\"></span>%s</a>  <a href=\"#\" id=\"' . $var['id'] . '_remove\" class=\"button button-default\">%s</a>",$current_' . $var['id'] . ',$description,$remove_this);' . $this->newline;


        $code['js'] .= $this->tab($numtab) . $this->newline;
        $code['js'] .= $this->tab($numtab) . '//media upload api' . $this->newline;

        $code['js'] .= $this->tab($numtab) . '$(function(){' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . 'var imgurl = $("#' . $var['id'] . '").val();' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . '$("#' . $var['id'] . '_remove").addClass("disabled");' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . 'if(imgurl!=""){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'var preview = $("<img/>").attr("src",imgurl).height(300);' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '$("#' . $var['id'] . '_preview").html(preview);' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '$("#' . $var['id'] . '_remove").removeClass("disabled");' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . '}' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . '$("#' . $var['id'] . '_remove").on("click",function(event){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'event.preventDefault();' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '$("#' . $var['id'] . '").val("");' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '$("#' . $var['id'] . '_preview").fadeOut("slow").html("");' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '$("#' . $var['id'] . '").val("");' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '$(this).addClass("disabled");' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'return false;' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . '});' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . '$("#' . $var['id'] . '_upload").on("click",function(event){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'event.preventDefault();' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'var send_to_editor_old = window.send_to_editor ;' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'window.send_to_editor = function(html){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . 'imgurl = $(html).attr("src");' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . 'window.console && console.log(imgurl);' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . '$("#' . $var['id'] . '").val(imgurl);' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . 'var preview = $("<img/>").attr("src",imgurl).height(300);' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . '$("#' . $var['id'] . '_preview").html(preview).fadeIn();' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . '$("#' . $var['id'] . '_remove").removeClass("disabled");' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . 'tb_remove();' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . 'window.send_to_editor = send_to_editor_old ;' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '};' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'tb_show("' . $var['label'] . '","media-upload.php?type=image&amp;TB_iframe=1&amp;referer=' . $this->config['Plugin_ShortName'] . '_option");' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'return false;' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . '});' . $this->newline;
        $code['js'] .= $this->tab($numtab) . '});' . $this->newline;

        return $code;

    }


    /**
     * Display Code Dropdown User
     * 
     * @param mixed $var
     * @param integer $numtab
     * @return string
     * 
     * @var $var = array('name' =>'','default' => '','explanation' => '')
     * 
     */

    public function wp_dropdown_users($var = array(), $numtab = 0)
    {
        $code['css'] = $code['php'] = $code['js'] = null;
        // create css
        $code['css'] .= '#' . $var['id'] . '{' . $this->newline;
        $code['css'] .= $this->tab . 'padding: 6px 12px;' . $this->newline;
        $code['css'] .= $this->tab . 'height: 34px;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;
        // create php
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '/**' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * Create HTML Drowndown Users Using API' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * @see https://codex.wordpress.org/Function_Reference/wp_dropdown_users' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '*/' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;

        $code['php'] .= $this->tab($numtab) . '$args = array(' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"echo" => 0,' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"name" => "' . $var['name'] . '",' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"id" => "' . $var['id'] . '", // string' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"class" => "' . $this->config['Plugin_ShortName'] . ' ' . $this->config['Plugin_ShortName'] . '-form-control", // string' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"selected" => $current_' . $var['id'] . ' // string' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ');' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$dropdown_users = wp_dropdown_users($args) ;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$description = __("' . $var['explanation'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'printf("%s<p class=\'description\'>%s</p>", $dropdown_users, $description );' . $this->newline;
        return $code;
    }

    /**
     * Display Code Dropdown Category
     * 
     * @param mixed $var
     * @param integer $numtab
     * @return string
     * 
     * @var $var = array('name' =>'','default' => '','explanation' => '')
     * 
     */

    public function wp_dropdown_categories($var = array(), $numtab = 0)
    {
        $code['css'] = $code['php'] = $code['js'] = null;
        // create css
        $code['css'] .= '#' . $var['id'] . '{' . $this->newline;
        $code['css'] .= $this->tab . 'padding: 6px 12px;' . $this->newline;
        $code['css'] .= $this->tab . 'height: 34px;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        // create php
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '/**' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * Create HTML Drowndown Category Using API' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * @see https://codex.wordpress.org/Function_Reference/wp_dropdown_categories' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '*/' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$args = array(' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"hide_empty" => 0,' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"echo" => 0,' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"name" => "' . $var['name'] . '",' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"id" => "' . $var['id'] . '", // string' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"class" => "' . $this->config['Plugin_ShortName'] . ' ' . $this->config['Plugin_ShortName'] . '-form-control", // string' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"selected" => $current_' . $var['id'] . ' // string' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ');' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$dropdown_categories = wp_dropdown_categories($args) ;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$description = __("' . $var['explanation'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'printf("%s<p class=\'description\'>%s</p>", $dropdown_categories, $description );' . $this->newline;
        return $code;
    }


    /**
     * Display Code Dropdown Page
     * 
     * @param mixed $var
     * @param integer $numtab
     * @return string
     * 
     * @var $var = array('name' =>'','default' => '','explanation' => '')
     * 
     */

    public function wp_dropdown_pages($var = array(), $numtab = 0)
    {

        if (!isset($var['name']))
        {
            $var['name'] = $var['post_type'];
        }
        if (!isset($var['explanation']))
        {
            $var['explanation'] = $var['post_type'];
        }
        if (!isset($var['id']))
        {
            $var['id'] = $this->config['Plugin_ShortName'] . '-' . $var['post_type'];
        }

        $code['css'] = $code['php'] = $code['js'] = null;
        // create css
        $code['css'] .= '#' . $var['id'] . '{' . $this->newline;
        $code['css'] .= $this->tab . 'padding: 6px 12px;' . $this->newline;
        $code['css'] .= $this->tab . 'height: 34px;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        // create php


        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '/**' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * Create HTML Drowndown Pages Using API' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * @see https://codex.wordpress.org/Function_Reference/wp_dropdown_pages' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '*/' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$args = array(' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"post_type" => "' . $var['post_type'] . '",' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"echo" => 0,' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"name" => "' . $var['name'] . '",' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"id" => "' . $var['id'] . '", // string' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"class" => "' . $this->config['Plugin_ShortName'] . ' ' . $this->config['Plugin_ShortName'] . '-form-control", // string' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"selected" => $current_' . $var['id'] . ' // string' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ');' . $this->newline;

        $code['php'] .= $this->tab($numtab) . '$dropdown_pages = wp_dropdown_pages($args) ;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$description = __("' . $var['explanation'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'printf("%s<p class=\'description\'>%s</p>", $dropdown_pages, $description );' . $this->newline;


        return $code;
    }

    /**
     * Display Code Dropdown Page Dinamic
     * 
     * @param mixed $var
     * @param integer $numtab
     * @return string
     * 
     * @var $var = array('name' =>'','default' => '','explanation' => '')
     * 
     */

    public function wp_dropdown_pages_dinamic($var = array(), $numtab = 0)
    {

        if (!isset($var['name']))
        {
            $var['name'] = $var['post_type'];
        }
        if (!isset($var['explanation']))
        {
            $var['explanation'] = $var['post_type'];
        }
        if (!isset($var['id']))
        {
            $var['id'] = $this->config['Plugin_ShortName'] . '-' . $var['post_type'];
        }

        $code['css'] = $code['php'] = $code['js'] = null;
        // create css
        $code['css'] .= '#' . $var['id'] . '_select{' . $this->newline;
        $code['css'] .= $this->tab . 'margin-top: 6px; ' . $this->newline;
        $code['css'] .= $this->tab . 'padding: 6px 12px; ' . $this->newline;
        $code['css'] .= $this->tab . 'height: 34px;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        $code['css'] .= '#' . $var['id'] . '_list{' . $this->newline;
        $code['css'] .= $this->tab . 'margin-top: 6px; ' . $this->newline;
        $code['css'] .= $this->tab . 'min-height: 42px;' . $this->newline;
        $code['css'] .= $this->tab . 'max-height: 200px;' . $this->newline;
        $code['css'] .= $this->tab . 'overflow: auto;' . $this->newline;
        $code['css'] .= $this->tab . 'padding: 0px 12px;' . $this->newline;
        $code['css'] .= $this->tab . 'border: 1px solid #DFDFDF;' . $this->newline;
        $code['css'] .= $this->tab . 'background-color: #FDFDFD;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        $code['css'] .= '.' . $var['id'] . '_item_remove{' . $this->newline;
        $code['css'] .= $this->tab . 'color: #999;' . $this->newline;
        $code['css'] .= $this->tab . 'text-decoration: none;' . $this->newline;
        $code['css'] .= $this->tab . 'font-size: 13px;' . $this->newline;
        $code['css'] .= $this->tab . 'line-height: 1.8em;' . $this->newline;
        $code['css'] .= '}' . $this->newline;
        $code['css'] .= $this->newline;

        // create php


        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '/**' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * Create HTML Drowndown Pages Using API' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ' * @see https://codex.wordpress.org/Function_Reference/wp_dropdown_pages' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '*/' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$args = array(' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"post_type" => "' . $var['post_type'] . '",' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"echo" => 0,' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"name" => "' . $var['name'] . '_select",' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"id" => "' . $var['id'] . '_select", // string' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '"class" => "' . $this->config['Plugin_ShortName'] . ' ' . $this->config['Plugin_ShortName'] . '-form-control", // string' . $this->newline;
        $code['php'] .= $this->tab($numtab) . ');' . $this->newline;

        $code['php'] .= $this->tab($numtab) . '$dropdown_pages = wp_dropdown_pages($args) ;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$description = __("' . $var['explanation'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain");' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$add_pages = "<input id=\"' . $var['id'] . '_add\" type=\"button\" class=\"button button-secondary\" value=\"".__("Add New ' . $var['label'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain")."\" />" ;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$list_item = __("List of ' . $var['label'] . '","' . $this->config['Plugin_ShortName'] . '-textdomain");' . $this->newline;

        $code['php'] .= $this->tab($numtab) . 'if(is_array($current_' . $var['id'] . ')){' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$current_' . $var['id'] . ' = json_encode($current_' . $var['id'] . ');' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '}else{' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$current_' . $var['id'] . ' = "[]";' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '}' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'if(json_decode($current_' . $var['id'] . ',true)){' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$current_' . $var['id'] . ' = json_decode($current_' . $var['id'] . ',true);' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '}else{' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '$current_' . $var['id'] . ' = array();' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '}' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$list_items = null;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '$z=0;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . 'foreach($current_' . $var['id'] . ' as $_' . $var['id'] . '){' . $this->newline;

        $code['php'] .= $this->tab($numtab) . $this->tab . '$' . $var['id'] . '_postdata = get_post($_' . $var['id'] . ');' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . 'if(isset($' . $var['id'] . '_postdata->post_title)){' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . $this->tab . '$list_items .= "<li><a class=\"msc_postmeta_advertise_item_remove\" href=\"#\"><span class=\"dashicons dashicons-dismiss\"></span></a> <span>" . $' . $var['id'] . '_postdata->post_title . " </span> <input name=\"msc_postmeta_advertise[]\" type=\"hidden\" value=\"". $_' . $var['id'] . '."\"/></li>"; ' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . $this->tab . '$z++;' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . $this->tab . 'unset($' . $var['id'] . '_postdata);' . $this->newline;
        $code['php'] .= $this->tab($numtab) . $this->tab . '}' . $this->newline;
        $code['php'] .= $this->tab($numtab) . '}' . $this->newline;


        $code['php'] .= $this->tab($numtab) . 'printf("%s<p class=\'description\'>%s</p><p>%s</p><p>%s</p><div id=\"' . $var['id'] . '_list\"><ul>%s</ul></div>", $dropdown_pages, $description , $add_pages,$list_item,$list_items);' . $this->newline;

        $code['js'] .= $this->tab($numtab) . '$(function(){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . '$("#' . $var['id'] . '_add").on("click",function(event){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'event.preventDefault();' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '/** get value option **/' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'var strValue = $("#' . $var['id'] . '_select").val();' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '/** get text option **/' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'var strText = "";' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '$("#' . $var['id'] . '_select option").each(function(){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . 'if( $(this).val() == strValue){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . $this->tab . 'strText =$(this).text();' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . $this->tab . '};' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '});' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '/** create dom **/' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'var domElm = "<li><a class=\"' . $var['id'] . '_item_remove\" href=\"#\"><span class=\"dashicons dashicons-dismiss\"></span></a>"+strText+"<input name=\"' . $var['name'] . '[]\" type=\"hidden\" value=\""+strValue+"\"/></li>";' . $this->newline;

        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '/** append option to item list **/' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '$("#' . $var['id'] . '_list ul").append(domElm);' . $this->newline;


        $code['js'] .= $this->tab($numtab) . $this->tab . '});' . $this->newline;


        $code['js'] .= $this->tab($numtab) . $this->tab . '$("#' . $var['id'] . '_list").on("click",".' . $var['id'] . '_item_remove",function(event){' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . 'event.preventDefault();' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . $this->tab . '$(this).parent().replaceWith("");' . $this->newline;
        $code['js'] .= $this->tab($numtab) . $this->tab . '});' . $this->newline;

        $code['js'] .= $this->tab($numtab) . '});' . $this->newline;
        return $code;
    }

    /**
     * WP Remote Code
     * 
     * @param mixed $var
     * @param integer $numtab
     * @return string
     * 
     * @var $var = array('name' =>'','default' => '','explanation' => '')
     * 
     */

    public function wp_remote_get($var = array(), $numtab = 0)
    {
        $code['php'] .= $this->tab($numtab) . "url = 'http://example.com/rss.xml';" . $this->newline;
        $code['php'] .= $this->tab($numtab) . "\$args = array(" . $this->newline;
        $code['php'] .= $this->tab($numtab) . "'timeout' => 5," . $this->newline;
        $code['php'] .= $this->tab($numtab) . "'redirection' => 5," . $this->newline;
        $code['php'] .= $this->tab($numtab) . "'httpversion' => '1.0'," . $this->newline;
        $code['php'] .= $this->tab($numtab) . "'user-agent' => 'WordPress/' . \$wp_version . '; ' . get_bloginfo('url')," . $this->newline;
        $code['php'] .= $this->tab($numtab) . "'blocking' => true," . $this->newline;
        $code['php'] .= $this->tab($numtab) . "'headers' => array()," . $this->newline;
        $code['php'] .= $this->tab($numtab) . "'cookies' => array()," . $this->newline;
        $code['php'] .= $this->tab($numtab) . "'body' => null," . $this->newline;
        $code['php'] .= $this->tab($numtab) . "'compress' => false," . $this->newline;
        $code['php'] .= $this->tab($numtab) . "'decompress' => true," . $this->newline;
        $code['php'] .= $this->tab($numtab) . "'sslverify' => true," . $this->newline;
        $code['php'] .= $this->tab($numtab) . "'stream' => false," . $this->newline;
        $code['php'] .= $this->tab($numtab) . "'filename' => null);" . $this->newline;


        $code['php'] .= $this->tab($numtab) . "\$response = wp_remote_get(\$url, \$args);" . $this->newline;
        $code['php'] .= $this->tab($numtab) . "if (is_array(\$response))" . $this->newline;
        $code['php'] .= $this->tab($numtab) . "{" . $this->newline;
        $code['php'] .= $this->tab($numtab) . "\$header = \$response['headers']; // array of http header lines" . $this->newline;
        $code['php'] .= $this->tab($numtab) . "\$body = \$response['body']; // use the content" . $this->newline;
        $code['php'] .= $this->tab($numtab) . "}" . $this->newline;
        return $code;
    }


    /**
     * Tab Repeat
     * 
     * @param integer $num
     * @return string
     */
    private function tab($num = 0)
    {
        return str_repeat($this->tab, $num);
    }

    /**
     * Convert String to Variabel
     * 
     * @param string $string
     * @return string
     */
    private function strToVariable($string)
    {
        $char = 'abcdefghijklmnopqrstuvwxyz_';
        $Allow = null;
        $string = str_replace(array(' ', '-'), '_', strtolower($string));
        for ($i = 0; $i < strlen($string); $i++)
        {
            if (strstr($char, $string[$i]) != false)
            {
                $Allow .= $string[$i];
            }
        }
        return $Allow;
    }

}

?>