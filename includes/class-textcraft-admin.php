<?php
/**
 * TextCraft AI Admin Handler
 *
 * @package TextCraft_AI
 */

if (!defined('ABSPATH')) {
    exit;
}

class TextCraft_Admin
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

  
  
  
    /**
     * Add admin menu items
     */
    public function add_admin_menu()
    {
        add_menu_page(
            __('TextCraft AI', 'textcraft-ai'),
            __('TextCraft AI', 'textcraft-ai'),
            'manage_options',
            'textcraft-ai',
            array($this, 'render_admin_page'),
            'dashicons-editor-spellcheck',
            30
        );
    }

  


    public function add_meta_boxes()
    {
        $screens = array('post', 'page', 'product'); 
        foreach ($screens as $screen) {
            add_meta_box(
                'textcraft_ai_metabox',
                __('TextCraft AI', 'textcraft-ai'),
                array($this, 'render_metabox'),
                $screen,
                'side', 
                'high'
            );
        }
    }




    /**
     * Render the metabox content
     */
    public function render_metabox($post)
    {
      
        $view_file = TEXTCRAFT_AI_PATH . 'views/metabox.php';

        if (file_exists($view_file)) {
            include $view_file;
        } else {
            echo '<p>' . __('Metabox view file missing.', 'textcraft-ai') . '</p>';
        }
    }

    
    public function render_admin_page()
    {


        $view_file = TEXTCRAFT_AI_PATH . 'views/admin-page.php';

        if (file_exists($view_file)) {
            include $view_file;
        } else {
            echo '<div class="error"><p>' . __('Admin view file missing.', 'textcraft-ai') . '</p></div>';
        }
    }

   
    
    
    public function enqueue_admin_scripts($hook)
    {
        $allowed_hooks = array(
            'toplevel_page_textcraft-ai',
            'post.php',
            'post-new.php'
        );

        if (!in_array($hook, $allowed_hooks)) {
            return;
        }

        wp_enqueue_script(
            'textcraft-admin-script',
            TEXTCRAFT_AI_URL . 'assets/js/admin.js',
            array('jquery', 'wp-blocks', 'wp-element', 'wp-editor'),
            TEXTCRAFT_AI_VERSION,
            true
        );

        wp_localize_script('textcraft-admin-script', 'textcraft_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('textcraft_nonce')
        ));

        wp_enqueue_style(
            'textcraft-admin-style',
            TEXTCRAFT_AI_URL . 'assets/css/admin.css',
            array(),
            TEXTCRAFT_AI_VERSION
        );
    }
}
