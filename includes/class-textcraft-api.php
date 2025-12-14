<?php
/**
 * TextCraft AI API Handler
 *
 * @package TextCraft_AI
 */

if (!defined('ABSPATH')) {
    exit;
}

class TextCraft_API
{




    public function call_grammar_api($text)
    {
        $api_url = 'https://ai-bypass-one.vercel.app/api/grammar/check';

        $args = array(
            'body' => json_encode(array('text' => $text)),
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
            'timeout' => 30,
        );

        $response = wp_remote_post($api_url, $args);

        if (is_wp_error($response)) {
            error_log('TextCraft AI API Error: ' . $response->get_error_message());
            return false;
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('TextCraft AI API JSON Error: ' . json_last_error_msg());
            return false;
        }

        return $data;
    }

   




    public function call_humanize_api($text)
    {
        $api_url = 'https://ai-bypass-one.vercel.app/api/ai/humanize';

        $args = array(
            'body' => json_encode(array('text' => $text)),
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
            'timeout' => 30,
        );

        $response = wp_remote_post($api_url, $args);

        if (is_wp_error($response)) {
            error_log('TextCraft AI Humanize API Error: ' . $response->get_error_message());
            return false;
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('TextCraft AI Humanize API JSON Error: ' . json_last_error_msg());
            return false;
        }

        return $data;
    }

   
    


    
    public function call_bypass_ai_api($text)
    {
        $api_url = 'https://ai-bypass-one.vercel.app/api/ai/bypass';

        $args = array(
            'body' => json_encode(array('text' => $text)),
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
            'timeout' => 30,
        );

        $response = wp_remote_post($api_url, $args);

        if (is_wp_error($response)) {
            error_log('TextCraft AI Bypass AI API Error: ' . $response->get_error_message());
            return false;
        }

        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('TextCraft AI Bypass AI API JSON Error: ' . json_last_error_msg());
            return false;
        }

        return $data;
    }
}
