(() => {
  const PRESETS = {
    sunset: {
      label: 'Sunset',
      colors: ['#ff6b6b', '#ffa726', '#ffeb3b'],
      type: 'linear',
      angle: 120,
    },
    ocean: {
      label: 'Ocean',
      colors: ['#2196f3', '#00bcd4', '#4caf50'],
      type: 'linear',
      angle: 135,
    },
    rainbow: {
      label: 'Rainbow',
      colors: ['#ff0080', '#ff8c00', '#ffeb3b', '#00c853', '#00bcd4', '#3d5afe'],
      type: 'linear',
      angle: 90,
    },
    fire: {
      label: 'Fire',
      colors: ['#ff4500', '#ff6347', '#ffa500'],
      type: 'linear',
      angle: 115,
    },
    neon: {
      label: 'Neon',
      colors: ['#ff0080', '#00ff80', '#8000ff'],
      type: 'linear',
      angle: 105,
    },
    purple: {
      label: 'Purple',
      colors: ['#9c27b0', '#e91e63', '#ff5722'],
      type: 'linear',
      angle: 130,
    },
  };

  const tester = document.createElement('span');

  const normalizeColor = (value) => {
    if (!value) return null;
    const trimmed = String(value).trim();
    if (!trimmed) return null;
    tester.style.color = '';
    tester.style.color = trimmed;
    if (!tester.style.color) {
      return null;
    }
    if (trimmed.startsWith('#') && (trimmed.length === 4 || trimmed.length === 7 || trimmed.length === 9)) {
      return trimmed;
    }
    return tester.style.color;
  };

  const clampAngle = (value) => {
    const number = Number(value);
    if (Number.isFinite(number)) {
      const mod = number % 360;
      return mod < 0 ? mod + 360 : mod;
    }
    return 0;
  };

  const escapeHtml = (value) =>
    value
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');

  const escapeRegExp = (value) => value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

  const bindPresetGradients = (buttons) => {
    buttons.forEach((button) => {
      const preset = PRESETS[button.dataset.preset];
      if (preset && preset.colors?.length) {
        button.style.setProperty('--preset-gradient', `linear-gradient(120deg, ${preset.colors.join(', ')})`);
      }
    });
  };

  const initInstance = (root) => {
    if (!root) {
      return;
    }

    const query = (selector) => root.querySelector(selector);

    const preview = query('#preview');
    const previewText = query('#previewText');
    const inputText = query('#inputText');
    const gradientToggle = query('#gradientToggle');
    const gradientType = query('#gradientType');
    const gradientAngle = query('#gradientAngle');
    const gradientScope = query('#gradientScope');
    const angleField = query('[data-angle-field]');
    const colorStop1 = query('#colorStop1');
    const colorStop2 = query('#colorStop2');
    const colorStop3 = query('#colorStop3');
    const presetButtons = Array.from(root.querySelectorAll('.preset'));
    const highlightWordsInput = query('#highlightWords');
    const highlightColorInput = query('#highlightColor');
    const textShadowToggle = query('#textShadowToggle');
    const shadowControls = query('[data-shadow-controls]');
    const shadowXInput = query('#shadowX');
    const shadowYInput = query('#shadowY');
    const shadowBlurInput = query('#shadowBlur');
    const shadowColorInput = query('#shadowColor');

    if (
      !preview ||
      !previewText ||
      !inputText ||
      !gradientToggle ||
      !gradientType ||
      !gradientAngle ||
      !gradientScope ||
      !angleField ||
      !colorStop1 ||
      !colorStop2 ||
      !colorStop3 ||
      !highlightWordsInput ||
      !highlightColorInput ||
      !textShadowToggle ||
      !shadowControls ||
      !shadowXInput ||
      !shadowYInput ||
      !shadowBlurInput ||
      !shadowColorInput
    ) {
      return;
    }

    const buildGradient = () => {
      const type = gradientType.value;
      const rawColors = [colorStop1.value, colorStop2.value, colorStop3.value];
      const colors = rawColors.map(normalizeColor).filter(Boolean);

      if (!colors.length) {
        return null;
      }

      const stops = colors.join(', ');
      const angle = clampAngle(gradientAngle.value || 0);

      if (type === 'linear') {
        return `linear-gradient(${angle}deg, ${stops})`;
      }
      if (type === 'radial') {
        return `radial-gradient(circle at center, ${stops})`;
      }
      return `conic-gradient(from ${angle}deg at 50% 50%, ${stops})`;
    };

    const updateAngleVisibility = () => {
      const type = gradientType.value;
      const shouldHide = type === 'radial';
      angleField.hidden = shouldHide;
    };

    const applyWordHighlights = (text) => {
      const raw = highlightWordsInput.value
        .split(',')
        .map((word) => word.trim())
        .filter(Boolean);

      if (!raw.length) {
        return escapeHtml(text).replace(/\n/g, '<br />');
      }

      const pattern = new RegExp(`(${raw.map(escapeRegExp).join('|')})`, 'gi');
      return escapeHtml(text).replace(pattern, '<mark>$1</mark>').replace(/\n/g, '<br />');
    };

    const updateGradient = () => {
      const gradient = buildGradient();
      const gradientEnabled = gradientToggle.checked;

      preview.dataset.gradient = gradientEnabled ? 'yes' : 'no';
      preview.dataset.gradientScope = gradientScope.value || 'all';

      if (gradientEnabled && gradient) {
        preview.style.setProperty('--highlight-gradient', gradient);
      } else {
        preview.style.removeProperty('--highlight-gradient');
      }

      const colors = [colorStop1.value, colorStop2.value, colorStop3.value]
        .map(normalizeColor)
        .filter(Boolean);

      const [c1, c2, c3] = [
        colors[0] || '#ff6b6b',
        colors[1] || colors[0] || '#ffa726',
        colors[2] || colors[1] || colors[0] || '#ffeb3b',
      ];

      preview.style.setProperty('--gradient-color-1', c1);
      preview.style.setProperty('--gradient-color-2', c2);
      preview.style.setProperty('--gradient-color-3', c3);
      preview.style.setProperty('--plain-highlight-color', c1);
    };

    const updatePresetState = (activePreset) => {
      presetButtons.forEach((button) => {
        if (button.dataset.preset === activePreset) {
          button.classList.add('is-active');
        } else {
          button.classList.remove('is-active');
        }
      });
    };

    const handlePresetClick = (event) => {
      const presetName = event.currentTarget.dataset.preset;
      const preset = PRESETS[presetName];
      if (!preset) return;

      const [c1, c2, c3 = c2] = preset.colors;
      colorStop1.value = c1;
      colorStop2.value = c2 || c1;
      colorStop3.value = c3 || c2 || c1;

      gradientType.value = preset.type || 'linear';
      gradientAngle.value = preset.angle ?? gradientAngle.value;
      updateAngleVisibility();
      updateGradient();
      updatePresetState(presetName);
      updatePreviewText();
    };

    const updateTextShadow = () => {
      const enabled = textShadowToggle.checked;
      preview.dataset.textShadow = enabled ? 'yes' : 'no';
      shadowControls.hidden = !enabled;

      if (!enabled) {
        preview.style.removeProperty('--text-shadow');
        return;
      }

      const x = Number(shadowXInput.value) || 0;
      const y = Number(shadowYInput.value) || 0;
      const blur = Math.max(0, Number(shadowBlurInput.value) || 0);
      const color = normalizeColor(shadowColorInput.value) || 'rgba(15, 23, 42, 0.55)';

      preview.style.setProperty('--text-shadow', `${x}px ${y}px ${blur}px ${color}`);
    };

    const updateWordHighlightColor = () => {
      const color = normalizeColor(highlightColorInput.value) || 'rgba(255, 245, 157, 0.65)';
      preview.style.setProperty('--word-highlight-color', color);
    };

    const updatePreviewText = () => {
      const text = inputText.value;
      previewText.innerHTML = applyWordHighlights(text);
    };

    const initializePresets = () => {
      presetButtons.forEach((button) => {
        button.addEventListener('click', handlePresetClick);
      });
      updatePresetState('sunset');
      bindPresetGradients(presetButtons);
    };

    const bindControls = () => {
      inputText.addEventListener('input', updatePreviewText);
      gradientToggle.addEventListener('change', updateGradient);
      gradientType.addEventListener('change', () => {
        updateAngleVisibility();
        updateGradient();
      });
      gradientAngle.addEventListener('input', updateGradient);
      gradientScope.addEventListener('change', updateGradient);
      colorStop1.addEventListener('input', updateGradient);
      colorStop2.addEventListener('input', updateGradient);
      colorStop3.addEventListener('input', updateGradient);
      highlightWordsInput.addEventListener('input', () => {
        updatePreviewText();
      });
      highlightColorInput.addEventListener('input', () => {
        updateWordHighlightColor();
        updatePreviewText();
      });
      textShadowToggle.addEventListener('change', updateTextShadow);
      shadowXInput.addEventListener('input', updateTextShadow);
      shadowYInput.addEventListener('input', updateTextShadow);
      shadowBlurInput.addEventListener('input', updateTextShadow);
      shadowColorInput.addEventListener('input', updateTextShadow);
    };

    const activateDefaultPreset = () => {
      const defaultPreset = PRESETS.sunset;
      if (!defaultPreset) return;
      colorStop1.value = defaultPreset.colors[0];
      colorStop2.value = defaultPreset.colors[1];
      colorStop3.value = defaultPreset.colors[2];
      gradientType.value = defaultPreset.type;
      gradientAngle.value = defaultPreset.angle;
      updatePresetState('sunset');
    };

    const init = () => {
      initializePresets();
      bindControls();
      activateDefaultPreset();
      updateAngleVisibility();
      updateGradient();
      updateWordHighlightColor();
      updateTextShadow();
      updatePreviewText();
    };

    init();
  };

  const bootstrap = () => {
    const roots = document.querySelectorAll('[data-supertext-highlighter]');
    roots.forEach((root) => {
      if (!root.__supertextHighlighterInitialized) {
        root.__supertextHighlighterInitialized = true;
        initInstance(root);
      }
    });
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootstrap);
  } else {
    bootstrap();
  }
})();
