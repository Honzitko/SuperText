/**
 * SuperText Frontend JavaScript
 * Advanced text effects and interactions
 */

(function($) {
    'use strict';

    class SuperText {
        constructor() {
            this.init();
        }

        init() {
            this.initElements();
            this.bindEvents();
            this.initAnimations();
            this.initGradients();
            this.initHighlights();
            this.initHoverEffects();
            this.init3DEffects();
        }

        initElements() {
            this.elements = $('.supertext-wrapper');
        }

        bindEvents() {
            // Intersection Observer for entrance animations
            if ('IntersectionObserver' in window) {
                this.initIntersectionObserver();
            }

            // Resize observer for responsive effects
            if ('ResizeObserver' in window) {
                this.initResizeObserver();
            }

            // Mouse move effects
            this.elements.on('mousemove', this.handleMouseMove.bind(this));
            this.elements.on('mouseleave', this.handleMouseLeave.bind(this));
        }

        initIntersectionObserver() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = $(entry.target);
                        this.triggerEntranceAnimation(element);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '50px'
            });

            this.elements.each((index, element) => {
                observer.observe(element);
            });
        }

        initResizeObserver() {
            const resizeObserver = new ResizeObserver((entries) => {
                entries.forEach(entry => {
                    const element = $(entry.target);
                    this.adjustResponsiveEffects(element);
                });
            });

            this.elements.each((index, element) => {
                resizeObserver.observe(element);
            });
        }

        initAnimations() {
            this.elements.each((index, element) => {
                const $element = $(element);
                const animation = $element.data('animation');
                
                if (animation && animation !== 'none') {
                    this.setupAnimation($element, animation);
                }
            });
        }

        setupAnimation($element, animation) {
            const delay = parseFloat($element.data('animation-delay')) || 0;
            const duration = parseFloat($element.data('animation-duration')) || 1;
            
            // Set CSS custom properties
            $element.css({
                '--animation-delay': delay + 's',
                '--animation-duration': duration + 's'
            });

            // Add animation class
            $element.addClass('supertext-animated');
        }

        triggerEntranceAnimation($element) {
            const animation = $element.data('animation');
            if (animation && animation !== 'none') {
                $element.addClass('supertext-animation-triggered');
            }
        }

        initGradients() {
            this.elements.filter('[data-gradient="true"]').each((index, element) => {
                const $element = $(element);
                this.setupGradient($element);
            });
        }

        setupGradient($element) {
            const type = $element.data('gradient-type');
            const angle = $element.data('gradient-angle');
            const colors = $element.data('gradient-colors');
            const animation = $element.data('gradient-animation');
            const speed = parseFloat($element.data('gradient-speed')) || 3;

            if (!colors) return;

            // Parse colors and clean them
            const colorArray = colors.split(',').map(color => color.trim()).filter(color => color);
            
            if (colorArray.length === 0) return;
            
            // Set CSS custom properties
            $element.css({
                '--gradient-angle': (angle || 90) + 'deg',
                '--gradient-colors': colorArray.join(', '),
                '--gradient-speed': speed + 's'
            });

            // Apply gradient animation
            if (animation && animation !== 'none') {
                $element.addClass('supertext-gradient-animated');
            }
        }

        initHighlights() {
            this.elements.filter('[data-highlight="true"]').each((index, element) => {
                const $element = $(element);
                this.setupHighlight($element);
            });
        }

        setupHighlight($element) {
            const text = $element.data('highlight-text');
            const color = $element.data('highlight-color');
            const style = $element.data('highlight-style');
            const animation = $element.data('highlight-animation');

            // Set CSS custom properties
            $element.css('--highlight-color', color);

            // Apply highlight animation
            if (animation && animation !== 'none') {
                $element.addClass('supertext-highlight-animated');
            }
        }

        initHoverEffects() {
            this.elements.filter('[data-hover-effect]').each((index, element) => {
                const $element = $(element);
                const effect = $element.data('hover-effect');
                
                if (effect && effect !== 'none') {
                    this.setupHoverEffect($element, effect);
                }
            });
        }

        setupHoverEffect($element, effect) {
            const duration = parseFloat($element.data('hover-duration')) || 0.3;
            
            $element.css('--hover-duration', duration + 's');

            switch (effect) {
                case 'scale':
                    const scale = parseFloat($element.data('hover-scale')) || 1.1;
                    $element.css('--hover-scale', scale);
                    break;
                case 'rotate':
                    const rotation = parseFloat($element.data('hover-rotation')) || 5;
                    $element.css('--hover-rotation', rotation + 'deg');
                    break;
                case 'color_change':
                    const color = $element.data('hover-color');
                    if (color) {
                        $element.css('--hover-color', color);
                    }
                    break;
                case 'text_reveal':
                    this.setupTextReveal($element);
                    break;
                case 'typewriter':
                    this.setupTypewriter($element);
                    break;
            }
        }

        setupTextReveal($element) {
            const $content = $element.find('.supertext-content');
            const text = $content.text();
            $content.attr('data-text', text);
        }

        setupTypewriter($element) {
            const $content = $element.find('.supertext-content');
            const text = $content.text();
            const speed = 50; // milliseconds per character
            
            $content.text('');
            $content.addClass('supertext-typewriter');
            
            let i = 0;
            const typeWriter = () => {
                if (i < text.length) {
                    $content.text($content.text() + text.charAt(i));
                    i++;
                    setTimeout(typeWriter, speed);
                } else {
                    $content.removeClass('supertext-typewriter');
                }
            };
            
            // Start typewriter effect on hover
            $element.one('mouseenter', typeWriter);
        }

        init3DEffects() {
            this.elements.filter('[data-3d="true"]').each((index, element) => {
                const $element = $(element);
                this.setup3DEffect($element);
            });
        }

        setup3DEffect($element) {
            const perspective = parseFloat($element.data('perspective')) || 1000;
            const rotateX = parseFloat($element.data('rotate-x')) || 0;
            const rotateY = parseFloat($element.data('rotate-y')) || 0;
            const rotateZ = parseFloat($element.data('rotate-z')) || 0;

            $element.css({
                '--perspective': perspective + 'px',
                '--rotate-x': rotateX + 'deg',
                '--rotate-y': rotateY + 'deg',
                '--rotate-z': rotateZ + 'deg'
            });
        }

        handleMouseMove(e) {
            const $element = $(e.currentTarget);
            const rect = e.currentTarget.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;

            // Apply 3D rotation based on mouse position
            if ($element.data('3d') === 'true') {
                $element.find('.supertext-content').css({
                    'transform': `rotateX(${rotateX}deg) rotateY(${rotateY}deg) rotateZ(${$element.data('rotate-z') || 0}deg)`
                });
            }

            // Parallax effect for gradients
            if ($element.data('gradient-animation') === 'shift') {
                const moveX = (x / rect.width) * 100;
                const moveY = (y / rect.height) * 100;
                $element.find('.supertext-content').css({
                    'background-position': `${moveX}% ${moveY}%`
                });
            }
        }

        handleMouseLeave(e) {
            const $element = $(e.currentTarget);
            
            // Reset 3D rotation
            if ($element.data('3d') === 'true') {
                $element.find('.supertext-content').css({
                    'transform': `rotateX(${$element.data('rotate-x') || 0}deg) rotateY(${$element.data('rotate-y') || 0}deg) rotateZ(${$element.data('rotate-z') || 0}deg)`
                });
            }

            // Reset gradient position
            if ($element.data('gradient-animation') === 'shift') {
                $element.find('.supertext-content').css({
                    'background-position': '0% 50%'
                });
            }
        }

        adjustResponsiveEffects($element) {
            const width = $element.width();
            
            // Adjust effects based on screen size
            if (width < 768) {
                $element.addClass('supertext-mobile');
            } else {
                $element.removeClass('supertext-mobile');
            }
        }

        // Public methods for external use
        triggerAnimation($element, animation) {
            if ($element.length) {
                $element.removeClass('supertext-animation-triggered');
                setTimeout(() => {
                    $element.addClass('supertext-animation-triggered');
                }, 10);
            }
        }

        updateGradient($element, colors) {
            if ($element.length) {
                $element.data('gradient-colors', colors);
                this.setupGradient($element);
            }
        }

        updateHighlight($element, text, color) {
            if ($element.length) {
                $element.data('highlight-text', text);
                $element.data('highlight-color', color);
                this.setupHighlight($element);
            }
        }
    }

    // Initialize when document is ready
    $(document).ready(function() {
        new SuperText();
    });

    // Re-initialize on Elementor frontend
    $(window).on('elementor/frontend/init', function() {
        new SuperText();
    });

    // Expose SuperText class globally for external use
    window.SuperText = SuperText;

})(jQuery);
