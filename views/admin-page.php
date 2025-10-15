<main class="app" data-supertext-highlighter>
  <header class="app__header">
    <h1>SuperText Highlighter</h1>
    <p class="app__tagline">
      Create vibrant gradient highlights, accent important words, and fine tune advanced text effects in real time.
    </p>
  </header>

  <section class="panel panel--input">
    <label class="field" for="inputText">
      <span class="field__label">Your text</span>
      <textarea
        id="inputText"
        class="field__textarea"
        rows="6"
        aria-describedby="inputText-help"
      >The gradient highlighter now comes with presets like Sunset, Ocean, Rainbow, Fire, Neon, and Purple. Toggle extra highlights for specific words and enable text shadows from the advanced section.</textarea>
      <small id="inputText-help" class="field__help">
        Enter any text to see the highlighting update instantly.
      </small>
    </label>
  </section>

  <section class="panels">
    <section class="panel">
      <header class="panel__header">
        <h2>Text Highlighting &amp; Gradients</h2>
        <p class="panel__description">
          Gradient highlighting is the primary method and is enabled by default. Choose a preset or craft custom colors for the effect.
        </p>
      </header>

      <label class="toggle">
        <input type="checkbox" id="gradientToggle" checked />
        <span class="toggle__label">Enable Gradient Highlighting</span>
      </label>
      <p class="toggle__description">
        When enabled the text is filled with a multi-stop gradient instead of a solid color.
      </p>

      <div class="preset-picker" role="list">
        <button class="preset" type="button" data-preset="sunset">Sunset</button>
        <button class="preset" type="button" data-preset="ocean">Ocean</button>
        <button class="preset" type="button" data-preset="rainbow">Rainbow</button>
        <button class="preset" type="button" data-preset="fire">Fire</button>
        <button class="preset" type="button" data-preset="neon">Neon</button>
        <button class="preset" type="button" data-preset="purple">Purple</button>
      </div>

      <div class="field-grid">
        <label class="field">
          <span class="field__label">Gradient Type</span>
          <select id="gradientType" class="field__select">
            <option value="linear" selected>Linear</option>
            <option value="radial">Radial</option>
            <option value="conic">Conic</option>
          </select>
        </label>
        <label class="field" data-angle-field>
          <span class="field__label">Angle (°)</span>
          <input
            id="gradientAngle"
            class="field__input"
            type="number"
            min="0"
            max="360"
            step="1"
            value="45"
          />
        </label>
      </div>

      <fieldset class="field field--colors">
        <legend class="field__label">Custom Colors</legend>
        <div class="color-grid">
          <label>
            <span>Color 1</span>
            <input type="color" id="colorStop1" value="#ff6b6b" />
          </label>
          <label>
            <span>Color 2</span>
            <input type="color" id="colorStop2" value="#ffa726" />
          </label>
          <label>
            <span>Color 3</span>
            <input type="color" id="colorStop3" value="#ffeb3b" />
          </label>
        </div>
      </fieldset>
    </section>

    <section class="panel">
      <header class="panel__header">
        <h2>Additional Text Highlights</h2>
        <p class="panel__description">
          Add secondary highlights for specific words or phrases while keeping the gradient as the primary effect.
        </p>
      </header>
      <label class="field" for="highlightWords">
        <span class="field__label">Words or phrases</span>
        <input
          id="highlightWords"
          class="field__input"
          type="text"
          placeholder="comma,separated,words"
          aria-describedby="highlightWords-help"
        />
        <small id="highlightWords-help" class="field__help">
          Separate entries with commas to highlight multiple terms.
        </small>
      </label>
      <label class="field" for="highlightColor">
        <span class="field__label">Highlight color</span>
        <input id="highlightColor" type="color" value="#fff59d" />
      </label>
    </section>

    <section class="panel">
      <header class="panel__header">
        <h2>Advanced Effects</h2>
        <p class="panel__description">
          Optional polish such as text shadows that respect the same CSS custom properties used in the preview.
        </p>
      </header>

      <label class="toggle">
        <input type="checkbox" id="textShadowToggle" />
        <span class="toggle__label">Enable Text Shadow</span>
      </label>
      <div class="shadow-grid" data-shadow-controls hidden>
        <label>
          <span>Horizontal offset</span>
          <input type="number" id="shadowX" value="2" step="1" />
        </label>
        <label>
          <span>Vertical offset</span>
          <input type="number" id="shadowY" value="4" step="1" />
        </label>
        <label>
          <span>Blur radius</span>
          <input type="number" id="shadowBlur" value="18" step="1" min="0" />
        </label>
        <label>
          <span>Shadow color</span>
          <input type="color" id="shadowColor" value="#0f172a" />
        </label>
      </div>
    </section>
  </section>

  <section class="panel panel--preview">
    <header class="panel__header">
      <h2>Preview</h2>
      <p class="panel__description">
        The preview uses data attributes and CSS custom properties so the effect is resilient even when values are missing or invalid.
      </p>
    </header>
    <div
      id="preview"
      class="preview"
      data-gradient="yes"
      data-text-shadow="no"
    >
      <p id="previewText" class="preview__text">
        The gradient highlighter now comes with presets like Sunset, Ocean, Rainbow, Fire, Neon, and Purple. Toggle extra highlights for specific words and enable text shadows from the advanced section.
      </p>
    </div>
  </section>
</main>
