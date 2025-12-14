<?php
/**
 * Admin Page View
 *
 * @package TextCraft_AI
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap">
  
    <div class="textcraft-header">
        <div>
            <h1>TextCraft AI <span
                    style="font-size: 12px; background: #6366f1; color: white; padding: 2px 8px; border-radius: 10px; vertical-align: middle;">PRO</span>
            </h1>
            <div class="subtitle"><?php _e('Advanced AI-Powered Content Enhancement Studio', 'textcraft-ai'); ?></div>
        </div>
    </div>

    <div id="textcraft-container">
     
        <div class="textcraft-card">
            <div class="textcraft-studio">

             
                <div class="textcraft-pane textcraft-left-pane">
                    <div class="textcraft-pane-header">
                        <h2 class="textcraft-pane-title"><?php _e('Editor', 'textcraft-ai'); ?></h2>
                    </div>

                    <textarea id="textcraft-input"
                        placeholder="<?php _e('Paste your content here to begin enhancement...', 'textcraft-ai'); ?>"></textarea>

                    <div class="textcraft-toolbar">
                        <button id="textcraft-check-btn" class="textcraft-btn textcraft-btn-primary">
                            <span class="dashicons dashicons-editor-spellcheck" style="margin-right:5px"></span>
                            <?php _e('Check Grammar', 'textcraft-ai'); ?>
                        </button>

                        <button id="textcraft-humanize-btn" class="textcraft-btn textcraft-btn-secondary">
                            <span class="dashicons dashicons-buddicons-buddypress-logo" style="margin-right:5px"></span>
                            <?php _e('Humanize Text', 'textcraft-ai'); ?>
                        </button>

                        <button id="textcraft-bypass-btn" class="textcraft-btn textcraft-btn-secondary">
                            <span class="dashicons dashicons-shield" style="margin-right:5px"></span>
                            <?php _e('Bypass AI', 'textcraft-ai'); ?>
                        </button>

                        <button id="textcraft-clear-btn" class="textcraft-btn textcraft-btn-ghost"
                            style="margin-left: auto;">
                            <?php _e('Clear', 'textcraft-ai'); ?>
                        </button>
                    </div>
                </div>

             


                <div class="textcraft-pane textcraft-right-pane">
                    <div class="textcraft-pane-header">
                        <h2 class="textcraft-pane-title"><?php _e('Analysis & Output', 'textcraft-ai'); ?></h2>
                    </div>

                    <div id="textcraft-error-message" class="notice notice-error"
                        style="display:none; margin: 0 0 15px 0;">
                        <p></p>
                    </div>

                    <div id="textcraft-results-section" style="display:none;">
                        <div id="textcraft-loading" style="display:none;">
                            <div class="loader-ring"><div></div><div></div><div></div><div></div></div>
                            <p style="font-weight:500;"><?php _e('Generating magic...', 'textcraft-ai'); ?></p>
                            <p style="font-size:13px; margin-top:5px; opacity:0.7;"><?php _e('This usually takes a few seconds', 'textcraft-ai'); ?></p>
                        </div>
                        <div id="textcraft-results"></div>
                    </div>

                   

                    <div id="textcraft-empty-state"
                        style="display:flex; flex-direction:column; align-items:center; justify-content:center; height:100%; color:#9ca3af; text-align:center;">
                        <span class="dashicons dashicons-analytics"
                            style="font-size: 48px; height: 48px; width: 48px; margin-bottom: 15px; color: #e5e7eb;"></span>
                        <p><?php _e('Results will appear here based on your actions.', 'textcraft-ai'); ?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
   
   
    jQuery(document).ready(function ($) {
        // Hide empty state when results are shown
        var Observer = new MutationObserver(function (mutations) {
            if ($('#textcraft-results-section').is(':visible')) {
                $('#textcraft-empty-state').hide();
            } else {
                $('#textcraft-empty-state').show();
            }
        });
        Observer.observe(document.querySelector('#textcraft-results-section'), { attributes: true, style: true });
    });
</script>