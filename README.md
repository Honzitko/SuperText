# SuperText for Elementor

**SuperText** is a powerful WordPress plugin that brings advanced text styling capabilities to Elementor. Create stunning text effects with gradients, highlights, animations, hover effects, and 3D transformations - all with an intuitive interface.

## 🚀 Features

### ✨ Advanced Text Styling
- **Gradient Text Effects**: Linear, radial, and conic gradients with customizable colors
- **Animated Gradients**: Shift, rotate, and pulse animations
- **Multiple Highlight Styles**: Background, underline, strikethrough, box, and circle highlights
- **Highlight Animations**: Fade, slide, bounce, and glow effects

### 🎭 Hover Effects
- **Scale**: Smooth scaling on hover
- **Rotation**: 3D rotation effects
- **Skew**: Dynamic skewing transformations
- **Glow**: Text glow effects
- **Shadow**: Dynamic shadow effects
- **Color Change**: Smooth color transitions
- **Gradient Shift**: Animated gradient movement
- **Text Reveal**: Reveal effects with gradient overlays
- **Typewriter**: Animated typing effect

### 🎬 Entrance Animations
- **Fade Effects**: Fade in from all directions
- **Slide Effects**: Slide in from all directions
- **Zoom Effects**: Zoom in animations
- **Bounce Effects**: Bouncy entrance animations
- **Rotate Effects**: Rotation-based entrances
- **Flip Effects**: 3D flip animations

### 🎯 3D Effects
- **3D Transformations**: Rotate on X, Y, and Z axes
- **Perspective Control**: Customizable 3D perspective
- **Mouse-Responsive**: 3D effects that respond to mouse movement

### 📱 Responsive Design
- **Mobile Optimized**: All effects work perfectly on mobile devices
- **Responsive Controls**: Different settings for different screen sizes
- **Performance Optimized**: Smooth animations on all devices

### ♿ Accessibility
- **Reduced Motion Support**: Respects user's motion preferences
- **Screen Reader Friendly**: Proper semantic markup
- **Keyboard Navigation**: Full keyboard accessibility

## 📦 Installation

### Method 1: WordPress Admin (Recommended)
1. Download the plugin ZIP file
2. Go to **Plugins > Add New** in your WordPress admin
3. Click **Upload Plugin** and select the ZIP file
4. Click **Install Now** and then **Activate**

### Method 2: FTP Upload
1. Extract the plugin ZIP file
2. Upload the `supertext` folder to `/wp-content/plugins/`
3. Go to **Plugins** in your WordPress admin
4. Find **SuperText for Elementor** and click **Activate**

### Method 3: WP-CLI
```bash
wp plugin install supertext.zip --activate
```

## 🔧 Requirements

- **WordPress**: 5.0 or higher
- **Elementor**: 3.0 or higher
- **PHP**: 7.4 or higher
- **Browser**: Modern browser with CSS3 support

## 🎨 Usage

### Basic Usage
1. **Add Widget**: In Elementor, drag the **SuperText** widget to your page
2. **Enter Text**: Add your text content in the Content section
3. **Choose HTML Tag**: Select the appropriate HTML tag (H1, H2, P, etc.)
4. **Style Your Text**: Use the various styling options to create amazing effects

### Gradient Effects
1. **Enable Gradient**: Turn on the "Enable Gradient" switch
2. **Choose Type**: Select Linear, Radial, or Conic gradient
3. **Set Colors**: Enter colors separated by commas (e.g., `#ff6b6b, #4ecdc4, #45b7d1`)
4. **Add Animation**: Choose from Shift, Rotate, or Pulse animations
5. **Adjust Speed**: Set the animation speed (1-10 seconds)

### Highlight Effects
1. **Enable Highlight**: Turn on the "Enable Highlight" switch
2. **Enter Text**: Type the exact text you want to highlight
3. **Choose Style**: Select from Background, Underline, Strikethrough, Box, or Circle
4. **Set Color**: Choose your highlight color
5. **Add Animation**: Select from Fade, Slide, Bounce, or Glow effects

### Hover Effects
1. **Select Effect**: Choose from Scale, Rotate, Skew, Glow, Shadow, Color Change, etc.
2. **Configure Settings**: Adjust scale amount, rotation angle, or hover color
3. **Set Duration**: Choose transition duration (0.1-3 seconds)

### Entrance Animations
1. **Choose Animation**: Select from Fade In, Slide In, Zoom In, Bounce In, etc.
2. **Set Delay**: Add animation delay (0-5 seconds)
3. **Adjust Duration**: Set animation duration (0.1-3 seconds)

### 3D Effects
1. **Enable 3D**: Turn on the "3D Effect" switch
2. **Set Perspective**: Adjust the 3D perspective (100-2000px)
3. **Rotate Axes**: Set rotation on X, Y, and Z axes (-180° to 180°)

## 🎯 Advanced Examples

### Rainbow Gradient Text
```
Gradient Colors: #ff0000, #ff8000, #ffff00, #80ff00, #00ff00, #00ff80, #00ffff, #0080ff, #0000ff, #8000ff, #ff00ff, #ff0080
Gradient Type: Linear
Gradient Angle: 90deg
Gradient Animation: Shift
Animation Speed: 3s
```

### Highlighted Keywords
```
Text: "Welcome to our amazing website with incredible features!"
Highlight Text: "amazing"
Highlight Style: Background
Highlight Color: #ffeb3b
Highlight Animation: Bounce
```

### 3D Hover Effect
```
Hover Effect: Scale
Scale: 1.2
Enable 3D: Yes
Rotate X: 10deg
Rotate Y: 5deg
Perspective: 1000px
```

### Typewriter Effect
```
Hover Effect: Typewriter
Text: "Hello World! This text will type itself out."
```

## 🛠️ Customization

### Custom CSS
You can add custom CSS to further customize the effects:

```css
/* Custom gradient animation */
.supertext-wrapper[data-gradient-animation="custom"] .supertext-content {
    animation: customGradient 4s ease-in-out infinite;
}

@keyframes customGradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Custom highlight style */
.supertext-highlight-custom {
    background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
```

### JavaScript API
Access the SuperText class for advanced customization:

```javascript
// Trigger animation programmatically
SuperText.triggerAnimation($('.supertext-wrapper'), 'fadeInUp');

// Update gradient colors
SuperText.updateGradient($('.supertext-wrapper'), '#ff6b6b, #4ecdc4, #45b7d1');

// Update highlight
SuperText.updateHighlight($('.supertext-wrapper'), 'highlighted text', '#ffeb3b');
```

## 🎨 Color Palettes

### Popular Gradient Combinations
- **Sunset**: `#ff6b6b, #ffa726, #ffeb3b`
- **Ocean**: `#2196f3, #00bcd4, #4caf50`
- **Purple**: `#9c27b0, #e91e63, #ff5722`
- **Rainbow**: `#ff0000, #ff8000, #ffff00, #80ff00, #00ff00, #00ff80, #00ffff, #0080ff, #0000ff, #8000ff, #ff00ff, #ff0080`
- **Neon**: `#ff0080, #00ff80, #8000ff`
- **Fire**: `#ff4500, #ff6347, #ffa500`

### Highlight Colors
- **Yellow**: `#ffeb3b`
- **Pink**: `#e91e63`
- **Blue**: `#2196f3`
- **Green**: `#4caf50`
- **Orange**: `#ff9800`
- **Purple**: `#9c27b0`

## 🔧 Troubleshooting

### Common Issues

**Q: Gradients not showing?**
A: Make sure you're using a modern browser with CSS3 support. Try refreshing the page.

**Q: Animations not working?**
A: Check if you have JavaScript enabled and that there are no console errors.

**Q: Effects look different on mobile?**
A: This is normal - some effects are optimized for mobile devices for better performance.

**Q: Text not highlighting?**
A: Make sure the highlight text matches exactly (case-sensitive) and is present in your content.

### Performance Tips
1. **Limit Animations**: Don't use too many animated elements on one page
2. **Optimize Images**: Use optimized images if you're combining with other elements
3. **Test on Mobile**: Always test your effects on mobile devices
4. **Use Reduced Motion**: Respect users' motion preferences

## 🆘 Support

### Getting Help
- **Documentation**: Check this README for detailed instructions
- **Video Tutorials**: Watch our video guides on YouTube
- **Community**: Join our Facebook group for community support
- **Email Support**: Contact us at support@yoursite.com

### Reporting Bugs
When reporting bugs, please include:
- WordPress version
- Elementor version
- PHP version
- Browser and version
- Steps to reproduce the issue
- Screenshots or videos if possible

## 🔄 Updates

### Version 1.0.0
- Initial release
- All core features implemented
- Full Elementor integration
- Responsive design
- Accessibility features

### Upcoming Features
- **Text Masking**: Mask text with images or patterns
- **Particle Effects**: Animated particle backgrounds
- **Morphing Text**: Text that morphs between different words
- **Sound Effects**: Audio feedback for interactions
- **More Animations**: Additional entrance and hover effects

## 📄 License

This plugin is licensed under the GPL v2 or later.

## 🤝 Contributing

We welcome contributions! Please:
1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 🙏 Credits

- **Elementor**: For the amazing page builder
- **WordPress**: For the robust CMS
- **CSS3**: For the powerful styling capabilities
- **JavaScript**: For the interactive features

## 📞 Contact

- **Website**: https://yoursite.com
- **Email**: contact@yoursite.com
- **Twitter**: @yoursite
- **Facebook**: /yoursite

---

**SuperText for Elementor** - Make your text super amazing! 🚀✨
