<?php

class JlLikePro{

    static function loadScriptAndOG()
    {
        if(defined('JLLIKEPRO_SCRIPT_LOADED')) return;

        define('JLLIKEPRO_SCRIPT_LOADED', 1);

        global $wp_query;
        $params = get_option('jllikepro_plgn_options');

        $isCategory = (int)is_category();
        $isPost = (!empty($wp_query->queried_object) && $wp_query->queried_object->post_type == 'post');

        if(!($isCategory && $params['allow_in_category'] == 1) && !$isPost)
        {
            return;
        }

        $params = get_option('jllikepro_plgn_options');
        $helper = PlgJLLikeProHelper::getInstance($params);

        $url = 'http://' . $params['pathbase']. str_replace('www.', '', $_SERVER['HTTP_HOST']);

        if($wp_query->queried_object->ID && $params['enable_opengraph'])
        {
            $helper->addOpenGraphTags($wp_query->queried_object);
        }
        ?>
        <script type="text/javascript">
            var jllickeproSettings = {
                url : "<?php echo $url; ?>",
                ajaxUrl: "<?php echo plugins_url('includes/ajax.php', JL_LIKE_PRO_BASE); ?>",
                typeGet : "<?php echo $params['typesget']; ?>",
                disableMoreLikes : <?php echo $params['disable_more_likes']; ?>,
                isCategory : <?php echo $isCategory; ?>,
                buttonsContayner : "<?php echo $params['buttons_contayner']; ?>",
                parentContayner : "<?php echo $params['parent_contayner']; ?>"
            };
        </script>
        <?php
    }

    static function loadScriptsAndStyles()
    {
        global $wp_query;

        $params = get_option('jllikepro_plgn_options');

        $isCategory = (int)is_category();
        $isPost = (!empty($wp_query->queried_object) && $wp_query->queried_object->post_type == 'post');


        if(!($isCategory && $params['allow_in_category'] == 1) && !$isPost)
        {
            return;
        }

        if ($params['jqload'] == 1)
        {
            wp_register_script('jllikepro-jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2');
            wp_enqueue_script('jllikepro-jquery');
        }
        wp_register_script('jllikepro-buttons', plugins_url('assets/js/buttons.js', JL_LIKE_PRO_BASE), array( 'jquery' ), false, '1.0');
        wp_enqueue_script('jllikepro-buttons');
        wp_register_style('jllikepro-css', plugins_url('assets/css/buttons.css', JL_LIKE_PRO_BASE), false, '1.0');
        wp_enqueue_style('jllikepro-css');
    }

    static function add_pages()
    {
        add_submenu_page(
            'plugins.php',
            __( 'JL Like Pro', 'jl-like-pro' ),
            __( 'JL Like Pro', 'jl-like-pro' ),
            'manage_options',
            "jl-like-pro",
            array('JlLikePro', 'settings_page')
        );

        //call register settings function
        add_action( 'admin_init', array('JlLikePro', 'plgn_settings') );
    }

    static function plgn_settings()
    {
        $options = PlgJLLikeProHelper::getPluginParams();
        update_option('jllikepro_plgn_options', $options);
    }

    static function loadTPL($name, $options)
    {
        $tmpl = JL_LIKE_PRO_BASE_DIR . '/tmpl/' . $name . '.php';

        if(!is_file($tmpl))
            return __('Error Load Template', 'jl-like-pro');

        extract($options, EXTR_PREFIX_SAME, "asd");

        ob_start();

        include $tmpl;

        return ob_get_clean();
    }

//Function formed content of the plugin's admin page.
    static function settings_page()
    {

        $message = "";
        $error = "";
        $plgn_options = PlgJLLikeProHelper::getPluginParams();

        $submit = PlgJLLikeProHelper::request('jllikepro_bttn_plgn_form_submit', '');
        if (!empty($submit) && check_admin_referer(plugin_basename(JL_LIKE_PRO_BASE), 'jllikepro_bttn_plgn_nonce_name'))
        {

            $default = PlgJLLikeProHelper::$defaultSettings;

            foreach($default as $k => $v)
            {
                $plgn_options [$k] = PlgJLLikeProHelper::request($k, $v);
            }

            update_option('jllikepro_plgn_options', $plgn_options);

            $message = __("Settings saved", 'jl-like-pro');
        }

        $options = array(
            'jllikepro_plgn_options' => $plgn_options,
            'message' => $message,
            'error' => $error,
        );

        echo self::loadTPL('adminform', $options);
    }

//Function 'facebook_button' taking from array 'jllikepro_plgn_options' necessnd reacting to your choise in plugin menu - points where it appears.
    static function display_button($content)
    {
        global $post;
        global $wp_query;
        $helper = PlgJLLikeProHelper::getInstance();

        //Query the database to receive array 'jllikepro_plgn_options' and receiving necessary information to create button
        $params = get_option('jllikepro_plgn_options');
        $isCategory = (int)is_category();
        $isPost = (!empty($wp_query->queried_object) && $wp_query->queried_object->post_type == 'post');


        if(($isCategory && $params['allow_in_category'] == 0) || (!$isCategory && !$isPost))
        {
            return $content;
        }

        $permalink_post = get_permalink($post->ID);

        $postText = explode('<!--more-->', $post->post_content);
        $desc = $postText[0];
        $full = (isset($postText[1])) ? $postText[1] : '';

        $title = $post->post_title;
        $text = $helper->getShareText('', $desc, $full);
        $image = $helper->getImage($post);


        //Button
        $button = $helper->ShowIn($post->ID, $permalink_post, $title, $image, $text);

        //Indication where show Facebook Button depending on selected item in admin page.
        switch($params['shares_position']){
            case 'before':
                return $button . $content;
                break;
            case 'after':
                return $content . $button;
                break;
            case 'beforeandafter':
                return $button . $content . $button;
                break;
            case 'shortcode':
            default:
                return $content;
                break;
        }
    }

//Function are using to create shortcode by Facebook Button.
    static function shortcode($content)
    {
        global $post;
        $helper = PlgJLLikeProHelper::getInstance();
        $permalink_post = get_permalink($post->ID);

        $postText = explode('<!--more-->', $post->post_content);
        $desc = $postText[0];
        $full = (isset($postText[1])) ? $postText[1] : '';

        $title = $post->post_title;
        $text = $helper->getShareText('', $desc, $full);
        $image = $helper->getImage($post);

        $button = $helper->ShowIn($post->ID, $permalink_post, $title, $image, $text);
        return $button;
    }

//Function are using to create action links on admin page.
    static function action_links($links, $file)
    {
        //Static so we don't call plugin_basename on every plugin row.
        static $this_plugin;

        if (!$this_plugin)
        {
            $this_plugin = plugin_basename(JL_LIKE_PRO_BASE);
        }

        if ($file == $this_plugin)
        {
            $settings_link = '<a href="admin.php?page=jl-like-pro">' . __('Settings', 'jl-like-pro') . '</a>';
            array_unshift($links, $settings_link);
        }
        return $links;
    }


    static function plgn_links($links, $file)
    {
        $base = plugin_basename(JL_LIKE_PRO_BASE);
        if ($file == $base) {
            $links[] = '<a href="admin.php?page=jl-like-pro">' . __('Settings', 'jl-like-pro') . '</a>';
            $links[] = '<a href="' . __('http://joomline.net/forum/plugins-wordpress.html', 'jl-like-pro') . '">' . __('Support', 'jl-like-pro') . '</a>';
        }
        return $links;
    }

//Function are using to add language files.
    static function init()
    {
        load_plugin_textdomain('jl-like-pro', false, dirname(plugin_basename(JL_LIKE_PRO_BASE)) . '/languages/');
    }

// Function for delete options
    function delete_options()
    {
        delete_option('jllikepro_plgn_options');
    }
}