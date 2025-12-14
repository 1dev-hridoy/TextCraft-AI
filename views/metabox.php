<?php
/**
 * Metabox View
 *
 * @package TextCraft_AI
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div id="textcraft-metabox-container">
    <div id="textcraft-metabox-controls" style="margin-bottom: 10px;">
        <button type="button" id="textcraft-load-editor-btn" class="button button-secondary"
            style="width: 48%;"><?php _e('Load from Editor', 'textcraft-ai'); ?></button>
        <button type="button" id="textcraft-apply-editor-btn" class="button button-primary"
            style="width: 48%; float: right;"><?php _e('Apply to Editor', 'textcraft-ai'); ?></button>
    </div>

    <textarea id="textcraft-input" rows="8" style="width:100%; box-sizing:border-box;"
        placeholder="<?php _e('Enter text or load from editor...', 'textcraft-ai'); ?>"></textarea>

    <div style="margin-top: 10px;">
        <button type="button" id="textcraft-check-btn" class="button button-secondary"
            style="margin-bottom: 5px; width: 100%;"><?php _e('Check Grammar', 'textcraft-ai'); ?></button>
        <button type="button" id="textcraft-humanize-btn" class="button button-secondary"
            style="margin-bottom: 5px; width: 100%;"><?php _e('Humanize AI Text', 'textcraft-ai'); ?></button>
        <button type="button" id="textcraft-bypass-btn" class="button button-secondary"
            style="margin-bottom: 5px; width: 100%;"><?php _e('Bypass AI Detection', 'textcraft-ai'); ?></button>
        <button type="button" id="textcraft-clear-btn" class="button"
            style="width: 100%;"><?php _e('Clear', 'textcraft-ai'); ?></button>
    </div>

    <div id="textcraft-results-section"
        style="display:none; margin-top: 15px; border-top: 1px solid #ddd; padding-top: 10px;">
        <h3><?php _e('Results', 'textcraft-ai'); ?></h3>
        <div id="textcraft-loading" style="display:none;">
            <p class="description"><?php _e('Processing...', 'textcraft-ai'); ?></p>
        </div>
        <div id="textcraft-results" style="max-height: 300px; overflow-y: auto;"></div>
    </div>

    <div id="textcraft-error-message" class="notice notice-error" style="display:none; margin-top: 10px;">
        <p></p>
    </div>
</div>