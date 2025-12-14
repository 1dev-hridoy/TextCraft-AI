<?php
/**
 * TextCraft AI Ajax Handler
 *
 * @package TextCraft_AI
 */

if (!defined('ABSPATH')) {
    exit;
}

class TextCraft_Ajax
{

    private $api;

    public function __construct()
    {
        $this->api = new TextCraft_API();

        add_action('wp_ajax_textcraft_check_grammar', array($this, 'handle_check_grammar'));
        add_action('wp_ajax_textcraft_humanize_text', array($this, 'handle_humanize_text'));
        add_action('wp_ajax_textcraft_bypass_ai_detection', array($this, 'handle_bypass_ai_detection'));
    }

  



    public function handle_check_grammar()
    {
        if (!wp_verify_nonce($_POST['nonce'], 'textcraft_nonce')) {
            wp_die(__('Security check failed', 'textcraft-ai'));
        }

        $text = isset($_POST['text']) ? sanitize_textarea_field($_POST['text']) : '';

        if (empty($text)) {
            wp_send_json_error(__('No text provided', 'textcraft-ai'));
        }

        $result = $this->api->call_grammar_api($text);

        if ($result === false) {
            wp_send_json_error(__('Failed to check grammar. Please try again.', 'textcraft-ai'));
        }

        wp_send_json_success($result);
    }

  
    
    
    public function handle_humanize_text()
    {
        if (!wp_verify_nonce($_POST['nonce'], 'textcraft_nonce')) {
            wp_die(__('Security check failed', 'textcraft-ai'));
        }

        $text = isset($_POST['text']) ? sanitize_textarea_field($_POST['text']) : '';

        if (empty($text)) {
            wp_send_json_error(__('No text provided', 'textcraft-ai'));
        }

        $result = $this->api->call_humanize_api($text);

        if ($result === false) {
            wp_send_json_error(__('Failed to humanize text. Please try again.', 'textcraft-ai'));
        }

        wp_send_json_success($result);
    }

    /**
     * Handle AJAX request to bypass AI detection
     */
    public function handle_bypass_ai_detection()
    {
        if (!wp_verify_nonce($_POST['nonce'], 'textcraft_nonce')) {
            wp_die(__('Security check failed', 'textcraft-ai'));
        }

        $text = isset($_POST['text']) ? sanitize_textarea_field($_POST['text']) : '';

        if (empty($text)) {
            wp_send_json_error(__('No text provided', 'textcraft-ai'));
        }

        $result = $this->api->call_bypass_ai_api($text);

        if ($result === false) {
            wp_send_json_error(__('Failed to bypass AI detection. Please try again.', 'textcraft-ai'));
        }

        wp_send_json_success($result);
    }
}
