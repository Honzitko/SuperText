<?php
/**
 * SuperText Widget for Elementor
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class SuperText_Widget extends Widget_Base {

    public function get_name() {
        return 'supertext';
    }

    public function get_title() {
        return esc_html__('SuperText', 'supertext');
    }

    public function get_icon() {
        return 'eicon-text';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_keywords() {
        return ['text', 'gradient', 'highlight', 'animation', 'hover', 'effects'];
    }

    public function get_script_depends() {
        return ['supertext-script'];
    }

    public function get_style_depends() {
        return ['supertext-style'];
    }

    protected function register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'supertext'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text_content',
            [
                'label' => esc_html__('Text Content', 'supertext'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__('Enter your amazing text here!', 'supertext'),
                'placeholder' => esc_html__('Type your text here...', 'supertext'),
            ]
        );

        $this->add_control(
            'html_tag',
            [
                'label' => esc_html__('HTML Tag', 'supertext'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h2',
            ]
        );

        $this->end_controls_section();

        // Text Styling Section
        $this->start_controls_section(
            'text_style_section',
            [
                'label' => esc_html__('Text Styling', 'supertext'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Typography', 'supertext'),
                'selector' => '{{WRAPPER}} .supertext-content',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'supertext'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .supertext-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label' => esc_html__('Alignment', 'supertext'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'supertext'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'supertext'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'supertext'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'supertext'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .supertext-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Gradient Section - Primary Highlighting Method
        $this->start_controls_section(
            'gradient_section',
            [
                'label' => esc_html__('Text Highlighting & Gradients', 'supertext'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'enable_gradient',
            [
                'label' => esc_html__('Enable Gradient Highlighting', 'supertext'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'supertext'),
                'label_off' => esc_html__('No', 'supertext'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__('Use gradient colors to highlight your text. This is the primary highlighting method.', 'supertext'),
            ]
        );

        $this->add_control(
            'gradient_type',
            [
                'label' => esc_html__('Gradient Type', 'supertext'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'linear' => esc_html__('Linear', 'supertext'),
                    'radial' => esc_html__('Radial', 'supertext'),
                    'conic' => esc_html__('Conic', 'supertext'),
                ],
                'default' => 'linear',
                'condition' => [
                    'enable_gradient' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'gradient_angle',
            [
                'label' => esc_html__('Angle', 'supertext'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 90,
                ],
                'condition' => [
                    'enable_gradient' => 'yes',
                    'gradient_type' => 'linear',
                ],
            ]
        );

        $this->add_control(
            'gradient_preset',
            [
                'label' => esc_html__('Gradient Preset', 'supertext'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'custom' => esc_html__('Custom Colors', 'supertext'),
                    'sunset' => esc_html__('Sunset', 'supertext'),
                    'ocean' => esc_html__('Ocean', 'supertext'),
                    'rainbow' => esc_html__('Rainbow', 'supertext'),
                    'fire' => esc_html__('Fire', 'supertext'),
                    'neon' => esc_html__('Neon', 'supertext'),
                    'purple' => esc_html__('Purple', 'supertext'),
                ],
                'default' => 'custom',
                'condition' => [
                    'enable_gradient' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'gradient_colors',
            [
                'label' => esc_html__('Custom Gradient Colors', 'supertext'),
                'type' => Controls_Manager::TEXT,
                'default' => '#ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #feca57',
                'description' => esc_html__('Enter colors separated by commas (e.g., #ff6b6b, #4ecdc4, #45b7d1). Use hex codes, rgb(), or color names.', 'supertext'),
                'condition' => [
                    'enable_gradient' => 'yes',
                    'gradient_preset' => 'custom',
                ],
                'placeholder' => esc_html__('#ff6b6b, #4ecdc4, #45b7d1', 'supertext'),
            ]
        );

        $this->add_control(
            'gradient_animation',
            [
                'label' => esc_html__('Gradient Animation', 'supertext'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__('None', 'supertext'),
                    'shift' => esc_html__('Shift', 'supertext'),
                    'rotate' => esc_html__('Rotate', 'supertext'),
                    'pulse' => esc_html__('Pulse', 'supertext'),
                ],
                'default' => 'none',
                'condition' => [
                    'enable_gradient' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'gradient_animation_speed',
            [
                'label' => esc_html__('Animation Speed', 'supertext'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['s'],
                'range' => [
                    's' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 3,
                ],
                'condition' => [
                    'enable_gradient' => 'yes',
                    'gradient_animation!' => 'none',
                ],
            ]
        );

        $this->end_controls_section();

        // Highlight Section - Secondary Highlighting
        $this->start_controls_section(
            'highlight_section',
            [
                'label' => esc_html__('Additional Text Highlights', 'supertext'),
                'tab' => Controls_Manager::TAB_STYLE,
                'description' => esc_html__('Add additional highlighting effects to specific words or phrases in your text.', 'supertext'),
            ]
        );

        $this->add_control(
            'enable_highlight',
            [
                'label' => esc_html__('Enable Highlight', 'supertext'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'supertext'),
                'label_off' => esc_html__('No', 'supertext'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'highlight_text',
            [
                'label' => esc_html__('Text to Highlight', 'supertext'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'description' => esc_html__('Enter the text you want to highlight (case sensitive)', 'supertext'),
                'condition' => [
                    'enable_highlight' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'highlight_color',
            [
                'label' => esc_html__('Highlight Color', 'supertext'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffeb3b',
                'condition' => [
                    'enable_highlight' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'highlight_style',
            [
                'label' => esc_html__('Highlight Style', 'supertext'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'background' => esc_html__('Background', 'supertext'),
                    'underline' => esc_html__('Underline', 'supertext'),
                    'strikethrough' => esc_html__('Strikethrough', 'supertext'),
                    'box' => esc_html__('Box', 'supertext'),
                    'circle' => esc_html__('Circle', 'supertext'),
                ],
                'default' => 'background',
                'condition' => [
                    'enable_highlight' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'highlight_animation',
            [
                'label' => esc_html__('Highlight Animation', 'supertext'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__('None', 'supertext'),
                    'fade' => esc_html__('Fade In', 'supertext'),
                    'slide' => esc_html__('Slide In', 'supertext'),
                    'bounce' => esc_html__('Bounce', 'supertext'),
                    'glow' => esc_html__('Glow', 'supertext'),
                ],
                'default' => 'none',
                'condition' => [
                    'enable_highlight' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Hover Effects Section
        $this->start_controls_section(
            'hover_section',
            [
                'label' => esc_html__('Hover Effects', 'supertext'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'hover_effect',
            [
                'label' => esc_html__('Hover Effect', 'supertext'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__('None', 'supertext'),
                    'scale' => esc_html__('Scale', 'supertext'),
                    'rotate' => esc_html__('Rotate', 'supertext'),
                    'skew' => esc_html__('Skew', 'supertext'),
                    'glow' => esc_html__('Glow', 'supertext'),
                    'shadow' => esc_html__('Shadow', 'supertext'),
                    'color_change' => esc_html__('Color Change', 'supertext'),
                    'gradient_shift' => esc_html__('Gradient Shift', 'supertext'),
                    'text_reveal' => esc_html__('Text Reveal', 'supertext'),
                    'typewriter' => esc_html__('Typewriter', 'supertext'),
                ],
                'default' => 'none',
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label' => esc_html__('Hover Color', 'supertext'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'hover_effect' => 'color_change',
                ],
            ]
        );

        $this->add_control(
            'hover_scale',
            [
                'label' => esc_html__('Scale', 'supertext'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0.5,
                        'max' => 2,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1.1,
                ],
                'condition' => [
                    'hover_effect' => 'scale',
                ],
            ]
        );

        $this->add_control(
            'hover_rotation',
            [
                'label' => esc_html__('Rotation', 'supertext'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -360,
                        'max' => 360,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 5,
                ],
                'condition' => [
                    'hover_effect' => 'rotate',
                ],
            ]
        );

        $this->add_control(
            'hover_duration',
            [
                'label' => esc_html__('Transition Duration', 'supertext'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['s'],
                'range' => [
                    's' => [
                        'min' => 0.1,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 0.3,
                ],
                'condition' => [
                    'hover_effect!' => 'none',
                ],
            ]
        );

        $this->end_controls_section();

        // Animation Section
        $this->start_controls_section(
            'animation_section',
            [
                'label' => esc_html__('Animations', 'supertext'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'entrance_animation',
            [
                'label' => esc_html__('Entrance Animation', 'supertext'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__('None', 'supertext'),
                    'fadeIn' => esc_html__('Fade In', 'supertext'),
                    'fadeInUp' => esc_html__('Fade In Up', 'supertext'),
                    'fadeInDown' => esc_html__('Fade In Down', 'supertext'),
                    'fadeInLeft' => esc_html__('Fade In Left', 'supertext'),
                    'fadeInRight' => esc_html__('Fade In Right', 'supertext'),
                    'slideInUp' => esc_html__('Slide In Up', 'supertext'),
                    'slideInDown' => esc_html__('Slide In Down', 'supertext'),
                    'slideInLeft' => esc_html__('Slide In Left', 'supertext'),
                    'slideInRight' => esc_html__('Slide In Right', 'supertext'),
                    'zoomIn' => esc_html__('Zoom In', 'supertext'),
                    'bounceIn' => esc_html__('Bounce In', 'supertext'),
                    'rotateIn' => esc_html__('Rotate In', 'supertext'),
                    'flipInX' => esc_html__('Flip In X', 'supertext'),
                    'flipInY' => esc_html__('Flip In Y', 'supertext'),
                ],
                'default' => 'none',
            ]
        );

        $this->add_control(
            'animation_delay',
            [
                'label' => esc_html__('Animation Delay', 'supertext'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['s'],
                'range' => [
                    's' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 0,
                ],
                'condition' => [
                    'entrance_animation!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'animation_duration',
            [
                'label' => esc_html__('Animation Duration', 'supertext'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['s'],
                'range' => [
                    's' => [
                        'min' => 0.1,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 's',
                    'size' => 1,
                ],
                'condition' => [
                    'entrance_animation!' => 'none',
                ],
            ]
        );

        $this->end_controls_section();

        // Advanced Effects Section
        $this->start_controls_section(
            'advanced_section',
            [
                'label' => esc_html__('Advanced Effects', 'supertext'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_shadow',
            [
                'label' => esc_html__('Text Shadow', 'supertext'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'supertext'),
                'label_off' => esc_html__('No', 'supertext'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow_control',
                'label' => esc_html__('Text Shadow', 'supertext'),
                'selector' => '{{WRAPPER}} .supertext-content',
                'condition' => [
                    'text_shadow' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'enable_3d',
            [
                'label' => esc_html__('3D Effect', 'supertext'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'supertext'),
                'label_off' => esc_html__('No', 'supertext'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'perspective',
            [
                'label' => esc_html__('Perspective', 'supertext'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 2000,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1000,
                ],
                'condition' => [
                    'enable_3d' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'rotate_x',
            [
                'label' => esc_html__('Rotate X', 'supertext'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'condition' => [
                    'enable_3d' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'rotate_y',
            [
                'label' => esc_html__('Rotate Y', 'supertext'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'condition' => [
                    'enable_3d' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'rotate_z',
            [
                'label' => esc_html__('Rotate Z', 'supertext'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => [
                    'deg' => [
                        'min' => -180,
                        'max' => 180,
                    ],
                ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'condition' => [
                    'enable_3d' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Responsive Section
        $this->start_controls_section(
            'responsive_section',
            [
                'label' => esc_html__('Responsive', 'supertext'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'font_size',
            [
                'label' => esc_html__('Font Size', 'supertext'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'em' => [
                        'min' => 0.1,
                        'max' => 10,
                    ],
                    'rem' => [
                        'min' => 0.1,
                        'max' => 10,
                    ],
                    'vw' => [
                        'min' => 0.1,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .supertext-content' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'line_height',
            [
                'label' => esc_html__('Line Height', 'supertext'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0.1,
                        'max' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'em',
                    'size' => 1.2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .supertext-content' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $this->add_render_attribute('wrapper', 'class', 'supertext-wrapper');
        $this->add_render_attribute('content', 'class', 'supertext-content');
        
        // Add data attributes for JavaScript with safety checks
        if (isset($settings['enable_gradient']) && $settings['enable_gradient'] === 'yes') {
            $this->add_render_attribute('wrapper', 'data-gradient', 'true');
            $this->add_render_attribute('wrapper', 'data-gradient-type', isset($settings['gradient_type']) ? $settings['gradient_type'] : 'linear');
            $this->add_render_attribute('wrapper', 'data-gradient-angle', isset($settings['gradient_angle']['size']) ? $settings['gradient_angle']['size'] : 90);
            
            // Handle gradient presets
            $gradient_colors = $this->get_gradient_colors($settings);
            $this->add_render_attribute('wrapper', 'data-gradient-colors', $gradient_colors);
            $this->add_render_attribute('wrapper', 'data-gradient-animation', isset($settings['gradient_animation']) ? $settings['gradient_animation'] : 'none');
            $this->add_render_attribute('wrapper', 'data-gradient-speed', isset($settings['gradient_animation_speed']['size']) ? $settings['gradient_animation_speed']['size'] : 3);
        }
        
        if (isset($settings['enable_highlight']) && $settings['enable_highlight'] === 'yes' && !empty($settings['highlight_text'])) {
            $this->add_render_attribute('wrapper', 'data-highlight', 'true');
            $this->add_render_attribute('wrapper', 'data-highlight-text', $settings['highlight_text']);
            $this->add_render_attribute('wrapper', 'data-highlight-color', isset($settings['highlight_color']) ? $settings['highlight_color'] : '#ffeb3b');
            $this->add_render_attribute('wrapper', 'data-highlight-style', isset($settings['highlight_style']) ? $settings['highlight_style'] : 'background');
            $this->add_render_attribute('wrapper', 'data-highlight-animation', isset($settings['highlight_animation']) ? $settings['highlight_animation'] : 'none');
        }
        
        if (isset($settings['hover_effect']) && $settings['hover_effect'] !== 'none') {
            $this->add_render_attribute('wrapper', 'data-hover-effect', $settings['hover_effect']);
            $this->add_render_attribute('wrapper', 'data-hover-duration', isset($settings['hover_duration']['size']) ? $settings['hover_duration']['size'] : 0.3);
            
            if ($settings['hover_effect'] === 'scale' && isset($settings['hover_scale']['size'])) {
                $this->add_render_attribute('wrapper', 'data-hover-scale', $settings['hover_scale']['size']);
            }
            if ($settings['hover_effect'] === 'rotate' && isset($settings['hover_rotation']['size'])) {
                $this->add_render_attribute('wrapper', 'data-hover-rotation', $settings['hover_rotation']['size']);
            }
            if ($settings['hover_effect'] === 'color_change' && !empty($settings['hover_color'])) {
                $this->add_render_attribute('wrapper', 'data-hover-color', $settings['hover_color']);
            }
        }
        
        if (isset($settings['entrance_animation']) && $settings['entrance_animation'] !== 'none') {
            $this->add_render_attribute('wrapper', 'data-animation', $settings['entrance_animation']);
            $this->add_render_attribute('wrapper', 'data-animation-delay', isset($settings['animation_delay']['size']) ? $settings['animation_delay']['size'] : 0);
            $this->add_render_attribute('wrapper', 'data-animation-duration', isset($settings['animation_duration']['size']) ? $settings['animation_duration']['size'] : 1);
        }
        
        if (isset($settings['enable_3d']) && $settings['enable_3d'] === 'yes') {
            $this->add_render_attribute('wrapper', 'data-3d', 'true');
            $this->add_render_attribute('wrapper', 'data-perspective', isset($settings['perspective']['size']) ? $settings['perspective']['size'] : 1000);
            $this->add_render_attribute('wrapper', 'data-rotate-x', isset($settings['rotate_x']['size']) ? $settings['rotate_x']['size'] : 0);
            $this->add_render_attribute('wrapper', 'data-rotate-y', isset($settings['rotate_y']['size']) ? $settings['rotate_y']['size'] : 0);
            $this->add_render_attribute('wrapper', 'data-rotate-z', isset($settings['rotate_z']['size']) ? $settings['rotate_z']['size'] : 0);
        }
        
        // Add text shadow data attribute
        if (isset($settings['text_shadow']) && $settings['text_shadow'] === 'yes') {
            $this->add_render_attribute('wrapper', 'data-text-shadow', 'yes');
        }
        
        // Process content for highlights
        $content = isset($settings['text_content']) ? $settings['text_content'] : '';
        if (isset($settings['enable_highlight']) && $settings['enable_highlight'] === 'yes' && !empty($settings['highlight_text'])) {
            $highlight_class = 'supertext-highlight supertext-highlight-' . (isset($settings['highlight_style']) ? $settings['highlight_style'] : 'background');
            if (isset($settings['highlight_animation']) && $settings['highlight_animation'] !== 'none') {
                $highlight_class .= ' supertext-highlight-' . $settings['highlight_animation'];
            }
            $content = str_replace(
                $settings['highlight_text'],
                '<span class="' . $highlight_class . '" style="--highlight-color: ' . (isset($settings['highlight_color']) ? $settings['highlight_color'] : '#ffeb3b') . '">' . $settings['highlight_text'] . '</span>',
                $content
            );
        }
        
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <<?php echo esc_attr(isset($settings['html_tag']) ? $settings['html_tag'] : 'h2'); ?> <?php echo $this->get_render_attribute_string('content'); ?>>
                <?php echo wp_kses_post($content); ?>
            </<?php echo esc_attr(isset($settings['html_tag']) ? $settings['html_tag'] : 'h2'); ?>>
        </div>
        <?php
    }

    /**
     * Get gradient colors based on preset or custom colors
     */
    private function get_gradient_colors($settings) {
        $preset = isset($settings['gradient_preset']) ? $settings['gradient_preset'] : 'custom';
        
        if ($preset === 'custom') {
            return isset($settings['gradient_colors']) ? $settings['gradient_colors'] : '#ff6b6b, #4ecdc4';
        }
        
        $presets = [
            'sunset' => '#ff6b6b, #ffa726, #ffeb3b',
            'ocean' => '#2196f3, #00bcd4, #4caf50',
            'rainbow' => '#ff0000, #ff8000, #ffff00, #80ff00, #00ff00, #00ff80, #00ffff, #0080ff, #0000ff, #8000ff, #ff00ff, #ff0080',
            'fire' => '#ff4500, #ff6347, #ffa500',
            'neon' => '#ff0080, #00ff80, #8000ff',
            'purple' => '#9c27b0, #e91e63, #ff5722',
        ];
        
        return isset($presets[$preset]) ? $presets[$preset] : '#ff6b6b, #4ecdc4';
    }

    protected function content_template() {
        ?>
        <#
        view.addRenderAttribute('wrapper', 'class', 'supertext-wrapper');
        view.addRenderAttribute('content', 'class', 'supertext-content');
        
        if (settings.enable_gradient === 'yes') {
            view.addRenderAttribute('wrapper', 'data-gradient', 'true');
            view.addRenderAttribute('wrapper', 'data-gradient-type', settings.gradient_type);
            view.addRenderAttribute('wrapper', 'data-gradient-angle', settings.gradient_angle.size);
            view.addRenderAttribute('wrapper', 'data-gradient-colors', settings.gradient_colors);
            view.addRenderAttribute('wrapper', 'data-gradient-animation', settings.gradient_animation);
            view.addRenderAttribute('wrapper', 'data-gradient-speed', settings.gradient_animation_speed.size);
        }
        
        if (settings.enable_highlight === 'yes' && settings.highlight_text) {
            view.addRenderAttribute('wrapper', 'data-highlight', 'true');
            view.addRenderAttribute('wrapper', 'data-highlight-text', settings.highlight_text);
            view.addRenderAttribute('wrapper', 'data-highlight-color', settings.highlight_color);
            view.addRenderAttribute('wrapper', 'data-highlight-style', settings.highlight_style);
            view.addRenderAttribute('wrapper', 'data-highlight-animation', settings.highlight_animation);
        }
        
        if (settings.hover_effect !== 'none') {
            view.addRenderAttribute('wrapper', 'data-hover-effect', settings.hover_effect);
            view.addRenderAttribute('wrapper', 'data-hover-duration', settings.hover_duration.size);
            
            if (settings.hover_effect === 'scale') {
                view.addRenderAttribute('wrapper', 'data-hover-scale', settings.hover_scale.size);
            }
            if (settings.hover_effect === 'rotate') {
                view.addRenderAttribute('wrapper', 'data-hover-rotation', settings.hover_rotation.size);
            }
            if (settings.hover_effect === 'color_change' && settings.hover_color) {
                view.addRenderAttribute('wrapper', 'data-hover-color', settings.hover_color);
            }
        }
        
        if (settings.entrance_animation !== 'none') {
            view.addRenderAttribute('wrapper', 'data-animation', settings.entrance_animation);
            view.addRenderAttribute('wrapper', 'data-animation-delay', settings.animation_delay.size);
            view.addRenderAttribute('wrapper', 'data-animation-duration', settings.animation_duration.size);
        }
        
        if (settings.enable_3d === 'yes') {
            view.addRenderAttribute('wrapper', 'data-3d', 'true');
            view.addRenderAttribute('wrapper', 'data-perspective', settings.perspective.size);
            view.addRenderAttribute('wrapper', 'data-rotate-x', settings.rotate_x.size);
            view.addRenderAttribute('wrapper', 'data-rotate-y', settings.rotate_y.size);
            view.addRenderAttribute('wrapper', 'data-rotate-z', settings.rotate_z.size);
        }
        
        var content = settings.text_content;
        if (settings.enable_highlight === 'yes' && settings.highlight_text) {
            var highlightClass = 'supertext-highlight supertext-highlight-' + settings.highlight_style;
            if (settings.highlight_animation !== 'none') {
                highlightClass += ' supertext-highlight-' + settings.highlight_animation;
            }
            content = content.replace(
                new RegExp(settings.highlight_text, 'g'),
                '<span class="' + highlightClass + '" style="--highlight-color: ' + settings.highlight_color + '">' + settings.highlight_text + '</span>'
            );
        }
        #>
        <div {{{ view.getRenderAttributeString('wrapper') }}}>
            <{{{ settings.html_tag }}} {{{ view.getRenderAttributeString('content') }}}>
                {{{ content }}}
            </{{{ settings.html_tag }}}>
        </div>
        <?php
    }
}
