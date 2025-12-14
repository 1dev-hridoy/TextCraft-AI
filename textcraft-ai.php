<?php
/**
 * Plugin Name: TextCraft AI
 * Plugin URI: https://github.com/yourusername/textcraft-ai
 * Description: An AI-powered content studio for WordPress featuring grammar checking, rewriting, and content enhancement tools.
 * Version: 1.0.0
 * Author: 1dv-hridoy
 * Author URI: https://github.com/1dev-hridoy
 * License: GPL v2 or later
 * Text Domain: textcraft-ai
 * Requires at least: 5.8
 * Requires PHP: 7.4
 */



if (!defined('ABSPATH')) {
    exit;
}


define('TEXTCRAFT_AI_VERSION', '1.0.0');
define('TEXTCRAFT_AI_URL', plugin_dir_url(__FILE__));
define('TEXTCRAFT_AI_PATH', plugin_dir_path(__FILE__));


require_once TEXTCRAFT_AI_PATH . 'includes/class-textcraft-api.php';
require_once TEXTCRAFT_AI_PATH . 'includes/class-textcraft-admin.php';
require_once TEXTCRAFT_AI_PATH . 'includes/class-textcraft-ajax.php';

/**
 * Main Plugin Class
 */
class TextCraft_AI
{

    public function __construct()
    {
        add_action('init', array($this, 'init'));

       
        new TextCraft_Admin();
        new TextCraft_Ajax();
    }



    /**
     * Initialize the plugin
     */
    public function init()
    {
        // Load text domain for translations
        load_plugin_textdomain('textcraft-ai', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }
}




new TextCraft_AI();
