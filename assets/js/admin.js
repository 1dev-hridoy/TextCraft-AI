jQuery(document).ready(function ($) {
    $('#textcraft-check-btn').on('click', function (e) {
        e.preventDefault();

        var text = $('#textcraft-input').val().trim();

        if (text === '') {
            showError('Please enter some text to check.');
            return;
        }

       

        $('#textcraft-loading').show();
        $('#textcraft-results-section').show();
        $('#textcraft-results').hide();
        hideError();

        // Send AJAX request
        $.ajax({
            url: textcraft_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'textcraft_check_grammar',
                text: text,
                nonce: textcraft_ajax.nonce
            },
            success: function (response) {
                $('#textcraft-loading').hide();

                if (response.success) {
                    displayGrammarResults(response.data);
                } else {
                    showError(response.data || 'An error occurred while checking grammar.');
                }
            },
            error: function (xhr, status, error) {
                $('#textcraft-loading').hide();
                showError('An error occurred while checking grammar: ' + error);
            }
        });
    });


    

    $('#textcraft-humanize-btn').on('click', function (e) {
        e.preventDefault();

        var text = $('#textcraft-input').val().trim();

        if (text === '') {
            showError('Please enter some text to humanize.');
            return;
        }

     
        
        $('#textcraft-loading').show();
        $('#textcraft-results-section').show();
        $('#textcraft-results').hide();
        hideError();

        // Send AJAX request
        $.ajax({
            url: textcraft_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'textcraft_humanize_text',
                text: text,
                nonce: textcraft_ajax.nonce
            },
            success: function (response) {
                $('#textcraft-loading').hide();

                if (response.success) {
                    displayHumanizeResults(response.data);
                } else {
                    showError(response.data || 'An error occurred while humanizing text.');
                }
            },
            error: function (xhr, status, error) {
                $('#textcraft-loading').hide();
                showError('An error occurred while humanizing text: ' + error);
            }
        });
    });

   
    $('#textcraft-bypass-btn').on('click', function (e) {
        e.preventDefault();

        var text = $('#textcraft-input').val().trim();

        if (text === '') {
            showError('Please enter some text to bypass AI detection.');
            return;
        }

     
        $('#textcraft-loading').show();
        $('#textcraft-results-section').show();
        $('#textcraft-results').hide();
        hideError();



        $.ajax({
            url: textcraft_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'textcraft_bypass_ai_detection',
                text: text,
                nonce: textcraft_ajax.nonce
            },
            success: function (response) {
                $('#textcraft-loading').hide();

                if (response.success) {
                    displayBypassResults(response.data);
                } else {
                    showError(response.data || 'An error occurred while bypassing AI detection.');
                }
            },
            error: function (xhr, status, error) {
                $('#textcraft-loading').hide();
                showError('An error occurred while bypassing AI detection: ' + error);
            }
        });
    });

  
    $('#textcraft-load-editor-btn').on('click', function (e) {
        e.preventDefault();
        var content = '';

   
        if (typeof wp !== 'undefined' && wp.data && wp.data.select('core/editor')) {
            try {
                content = wp.data.select('core/editor').getEditedPostAttribute('content');
            } catch (err) {
                console.log('TextCraft: Gutenberg not detected or error accessing data.');
            }
        }

   
        if (!content && typeof tinyMCE !== 'undefined' && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden()) {
            content = tinyMCE.activeEditor.getContent({ format: 'text' });
        } else if (!content) {
            content = $('#content').val();
        }

        if (content) {
            


            var div = document.createElement("div");
            div.innerHTML = content;
            var text = div.textContent || div.innerText || "";
            $('#textcraft-input').val(text.trim());
        } else {
            showError('Could not retrieve content from editor.');
        }
    });



    $('#textcraft-apply-editor-btn').on('click', function (e) {
        e.preventDefault();
        var text = $('#textcraft-input').val();

        if (!text) {
            showError('No text to apply.');
            return;
        }


        if (typeof wp !== 'undefined' && wp.data) {
            var blockEditorDispatch = wp.data.dispatch('core/block-editor');
            var editorDispatch = wp.data.dispatch('core/editor');

            if (blockEditorDispatch && blockEditorDispatch.resetBlocks) {
                try {
                    var blocks = wp.blocks.parse(text);
                    blockEditorDispatch.resetBlocks(blocks);
                    return;
                } catch (err) {
                    console.log('TextCraft: Error applying to Gutenberg (block-editor).');
                }
            } else if (editorDispatch && editorDispatch.resetBlocks) {
                try {
                    var blocks = wp.blocks.parse(text);
                    editorDispatch.resetBlocks(blocks);
                    return;
                } catch (err) {
                    console.log('TextCraft: Error applying to Gutenberg (core/editor).');
                }
            }
        }

       
        if (typeof tinyMCE !== 'undefined' && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden()) {
            tinyMCE.activeEditor.setContent(text);
        } else if ($('#content').length) {
            $('#content').val(text);
        } else {
            showError('Could not apply content to editor.');
        }
    });


    $('#textcraft-clear-btn').on('click', function (e) {
        e.preventDefault();
        $('#textcraft-input').val('');
        $('#textcraft-results-section').hide();
        hideError();
    });

  
    function displayGrammarResults(data) {
        if (!data || !data.data || !data.data.report_data) {
            showError('Invalid response from grammar checker.');
            return;
        }

        var reportData = data.data.report_data;
        var sourceText = reportData.source_text;
        var correctedText = reportData.corrected_text;
        var errors = reportData.errors;

        var html = '<div class="textcraft-result-content">';

    
        html += '<h3>Original Text:</h3>';
        html += '<div class="textcraft-original-text">' + escapeHtml(sourceText) + '</div>';

   
        html += '<h3>Corrected Text:</h3>';
        html += '<div class="textcraft-corrected-text">' + escapeHtml(correctedText) + '</div>';

    
        if (errors && errors.length > 0) {
            html += '<h3>Errors Found (' + errors.length + '):</h3>';
            html += '<div class="textcraft-errors-list">';

            errors.forEach(function (error, index) {
                html += '<div class="textcraft-error-item">';
                html += '<strong>Error ' + (index + 1) + ':</strong> ';
                html += '<span class="textcraft-error-source">"' + escapeHtml(error.source) + '"</span> ';
                html += '<span class="textcraft-error-type">(' + escapeHtml(error.error_type) + ')</span> ';
                html += '→ <span class="textcraft-error-replacement">"' + escapeHtml(error.replacement) + '"</span>';
                html += '</div>';
            });

            html += '</div>';
        } else {
            html += '<p>No errors found!</p>';
        }

        html += '</div>';

        $('#textcraft-results').html(html);
        $('#textcraft-results').show();
    }


    function displayHumanizeResults(data) {
        if (!data || !data.data) {
            showError('Invalid response from humanize API.');
            return;
        }

        var sourceText = $('#textcraft-input').val().trim();
        var humanizedText = data.data;

        var html = '<div class="textcraft-result-content">';

   
        html += '<h3>Original Text:</h3>';
        html += '<div class="textcraft-original-text">' + escapeHtml(sourceText) + '</div>';



        html += '<h3>Humanized Text:</h3>';
        html += '<div class="textcraft-corrected-text">' + escapeHtml(humanizedText) + '</div>';

        html += '<p class="textcraft-success-message">Text has been successfully humanized!</p>';

        html += '</div>';

        $('#textcraft-results').html(html);
        $('#textcraft-results').show();
    }

   
    function displayBypassResults(data) {
        if (!data || !data.data) {
            showError('Invalid response from bypass AI detection API.');
            return;
        }

        var sourceText = $('#textcraft-input').val().trim();
        var bypassedText = data.data;

        var html = '<div class="textcraft-result-content">';

       
        html += '<h3>Original Text:</h3>';
        html += '<div class="textcraft-original-text">' + escapeHtml(sourceText) + '</div>';

   
        html += '<h3>Bypassed Text:</h3>';
        html += '<div class="textcraft-corrected-text">' + escapeHtml(bypassedText) + '</div>';

        html += '<p class="textcraft-success-message">Text has been successfully processed to bypass AI detection!</p>';

        html += '</div>';

        $('#textcraft-results').html(html);
        $('#textcraft-results').show();
    }


    function showError(message) {
        $('#textcraft-error-message p').text(message);
        $('#textcraft-error-message').show();
    }

   
    function hideError() {
        $('#textcraft-error-message').hide();
    }


    function escapeHtml(text) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };

        return text.replace(/[&<>"']/g, function (m) { return map[m]; });
    }
});