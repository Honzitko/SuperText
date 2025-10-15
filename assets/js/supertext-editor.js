/**
 * SuperText Editor JavaScript for Elementor
 * Enhanced editor experience and live preview
 */

(function($) {
    'use strict';

    class SuperTextEditor {
        constructor() {
            this.init();
        }

        init() {
            this.bindEvents();
            this.initLivePreview();
            this.initColorPicker();
            this.initGradientPreview();
        }

        bindEvents() {
            // Elementor editor events
            $(window).on('elementor/frontend/init', this.onElementorInit.bind(this));
            $(window).on('elementor/popup/show', this.onPopupShow.bind(this));
            
            // Custom control events
            $(document).on('change', '.elementor-control-supertext_gradient_colors input', this.onGradientColorsChange.bind(this));
            $(document).on('change', '.elementor-control-supertext_highlight_text input', this.onHighlightTextChange.bind(this));
        }

        onElementorInit() {
            // Initialize editor enhancements
            this.initEditorEnhancements();
        }

        onPopupShow() {
            // Re-initialize when popup opens
            setTimeout(() => {
                this.initLivePreview();
            }, 100);
        }

        initEditorEnhancements() {
            // Add custom CSS for editor
            this.addEditorStyles();
            
            // Enhance gradient color picker
            this.enhanceGradientPicker();
            
            // Add live preview for highlights
            this.addHighlightPreview();
        }

        addEditorStyles() {
            const style = `
                <style id="supertext-editor-styles">
                    .elementor-control-supertext_gradient_colors .elementor-control-input-wrapper {
                        position: relative;
                    }
                    
                    .elementor-control-supertext_gradient_colors .gradient-preview {
                        width: 100%;
                        height: 40px;
                        border-radius: 4px;
                        margin-top: 10px;
                        border: 1px solid #ddd;
                        background: linear-gradient(90deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #feca57);
                    }
                    
                    .elementor-control-supertext_highlight_text .highlight-preview {
                        margin-top: 10px;
                        padding: 10px;
                        background: #f8f9fa;
                        border-radius: 4px;
                        border: 1px solid #ddd;
                    }
                    
                    .elementor-control-supertext_highlight_text .highlight-preview .preview-text {
                        font-size: 16px;
                        line-height: 1.5;
                    }
                    
                    .supertext-editor-preview {
                        position: relative;
                        display: inline-block;
                        margin: 10px 0;
                    }
                </style>
            `;
            
            if (!$('#supertext-editor-styles').length) {
                $('head').append(style);
            }
        }

        enhanceGradientPicker() {
            $('.elementor-control-supertext_gradient_colors').each((index, control) => {
                const $control = $(control);
                const $input = $control.find('input');
                
                if (!$control.find('.gradient-preview').length) {
                    $input.after('<div class="gradient-preview"></div>');
                }
                
                this.updateGradientPreview($input);
            });
        }

        updateGradientPreview($input) {
            const colors = $input.val();
            const $preview = $input.siblings('.gradient-preview');
            
            if (colors) {
                const colorArray = colors.split(',').map(color => color.trim());
                const gradient = `linear-gradient(90deg, ${colorArray.join(', ')})`;
                $preview.css('background', gradient);
            }
        }

        onGradientColorsChange(e) {
            const $input = $(e.target);
            this.updateGradientPreview($input);
            
            // Update live preview
            this.updateLivePreview();
        }

        addHighlightPreview() {
            $('.elementor-control-supertext_highlight_text').each((index, control) => {
                const $control = $(control);
                const $input = $control.find('input');
                
                if (!$control.find('.highlight-preview').length) {
                    const previewHtml = `
                        <div class="highlight-preview">
                            <div class="preview-text">This is a preview of your highlighted text</div>
                        </div>
                    `;
                    $input.after(previewHtml);
                }
                
                this.updateHighlightPreview($input);
            });
        }

        updateHighlightPreview($input) {
            const $control = $input.closest('.elementor-control-supertext_highlight_text');
            const $preview = $control.find('.highlight-preview .preview-text');
            const highlightText = $input.val();
            
            if (highlightText) {
                const $colorControl = $control.siblings('.elementor-control-supertext_highlight_color');
                const $styleControl = $control.siblings('.elementor-control-supertext_highlight_style');
                
                let color = '#ffeb3b';
                let style = 'background';
                
                if ($colorControl.length) {
                    const colorInput = $colorControl.find('input').val();
                    if (colorInput) color = colorInput;
                }
                
                if ($styleControl.length) {
                    const styleSelect = $styleControl.find('select').val();
                    if (styleSelect) style = styleSelect;
                }
                
                const highlightedText = this.applyHighlightStyle(highlightText, color, style);
                $preview.html(`This is a preview of your ${highlightedText} text`);
            } else {
                $preview.text('This is a preview of your highlighted text');
            }
        }

        applyHighlightStyle(text, color, style) {
            const styles = {
                background: `background-color: ${color}; padding: 2px 4px; border-radius: 3px;`,
                underline: `border-bottom: 3px solid ${color}; padding-bottom: 1px;`,
                strikethrough: `position: relative; text-decoration: line-through; text-decoration-color: ${color};`,
                box: `background-color: ${color}; border: 2px solid ${color}; border-radius: 5px; padding: 2px 6px;`,
                circle: `background-color: ${color}; border-radius: 50%; padding: 4px 8px; display: inline-block; min-width: 1.2em; text-align: center;`
            };
            
            return `<span style="${styles[style] || styles.background}">${text}</span>`;
        }

        onHighlightTextChange(e) {
            const $input = $(e.target);
            this.updateHighlightPreview($input);
            
            // Update live preview
            this.updateLivePreview();
        }

        initLivePreview() {
            // Initialize live preview for all SuperText widgets
            $('.elementor-widget-supertext').each((index, widget) => {
                this.setupLivePreview($(widget));
            });
        }

        setupLivePreview($widget) {
            const $element = $widget.find('.supertext-wrapper');
            
            if ($element.length) {
                // Add editor-specific classes
                $element.addClass('supertext-editor-preview');
                
                // Setup real-time updates
                this.setupRealTimeUpdates($element);
            }
        }

        setupRealTimeUpdates($element) {
            // This would be called when controls change
            // For now, we'll set up the structure
            $element.data('editor-preview', true);
        }

        updateLivePreview() {
            // Update all SuperText widgets in the editor
            $('.elementor-widget-supertext .supertext-wrapper').each((index, element) => {
                const $element = $(element);
                if ($element.data('editor-preview')) {
                    this.refreshWidgetPreview($element);
                }
            });
        }

        refreshWidgetPreview($element) {
            // Force refresh of the widget preview
            if (window.elementor && window.elementor.getPreviewView) {
                const widgetView = window.elementor.getPreviewView($element.closest('.elementor-widget').data('id'));
                if (widgetView) {
                    widgetView.render();
                }
            }
        }

        initColorPicker() {
            // Enhance color picker for better UX
            $(document).on('click', '.elementor-control-supertext_highlight_color .elementor-control-input-wrapper', function() {
                const $this = $(this);
                const $input = $this.find('input');
                
                // Add custom color picker if needed
                if (!$input.hasClass('supertext-enhanced-picker')) {
                    $input.addClass('supertext-enhanced-picker');
                }
            });
        }

        initGradientPreview() {
            // Initialize gradient preview for all gradient controls
            setTimeout(() => {
                this.enhanceGradientPicker();
            }, 500);
        }

        // Public methods for external use
        updateGradientPreview(colors) {
            $('.elementor-control-supertext_gradient_colors input').val(colors).trigger('change');
        }

        updateHighlightPreview(text, color, style) {
            $('.elementor-control-supertext_highlight_text input').val(text).trigger('change');
            $('.elementor-control-supertext_highlight_color input').val(color).trigger('change');
            $('.elementor-control-supertext_highlight_style select').val(style).trigger('change');
        }

        refreshAllPreviews() {
            this.updateLivePreview();
        }
    }

    // Initialize when document is ready
    $(document).ready(function() {
        new SuperTextEditor();
    });

    // Re-initialize on Elementor editor load
    $(window).on('elementor/editor/init', function() {
        new SuperTextEditor();
    });

    // Expose SuperTextEditor class globally
    window.SuperTextEditor = SuperTextEditor;

})(jQuery);
