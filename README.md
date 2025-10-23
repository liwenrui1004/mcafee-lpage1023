# 🛡️ Security Review Landing Page

A modern, responsive landing page for cybersecurity product reviews with an anxiety-to-hope emotional journey design.

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![HTML](https://img.shields.io/badge/HTML-5-orange.svg)
![CSS](https://img.shields.io/badge/CSS-3-blue.svg)
![Responsive](https://img.shields.io/badge/Responsive-Yes-green.svg)

## ✨ Features

- 🎨 **Modern Dark Theme** - Sophisticated dark design with red accents
- 📱 **Fully Responsive** - Works perfectly on all devices
- ⚡ **Fast & Lightweight** - Pure HTML/CSS, no dependencies
- 🎭 **Emotional Design** - Anxiety-to-hope user journey
- 🔒 **Security Focused** - Built for cybersecurity reviews
- ♿ **Accessible** - WCAG compliant design

## 📄 Pages Included

1. **Home** (`preview-english.html`) - Main landing page with threat awareness and solutions
2. **About** (`about.html`) - Mission, values, and team information
3. **Contact** (`contact.html`) - Contact form and information
4. **Privacy Policy** (`privacy-policy.html`) - Comprehensive privacy policy

## 🚀 Quick Start

### Option 1: View Locally

Simply open `preview-english.html` in your browser:

```bash
# Windows
start preview-english.html

# macOS
open preview-english.html

# Linux
xdg-open preview-english.html
```

### Option 2: Local Web Server

```bash
# Python 3
python -m http.server 8000

# Python 2
python -m SimpleHTTPServer 8000

# Then visit: http://localhost:8000/preview-english.html
```

### Option 3: Deploy to Vercel (Recommended)

1. **Fork or Clone this repository**

```bash
git clone https://github.com/YOUR-USERNAME/mcafee-landing-page.git
cd mcafee-landing-page
```

2. **Push to your GitHub**

```bash
git remote set-url origin https://github.com/YOUR-USERNAME/mcafee-landing-page.git
git push -u origin main
```

3. **Deploy on Vercel**

[![Deploy with Vercel](https://vercel.com/button)](https://vercel.com/new/clone?repository-url=https://github.com/YOUR-USERNAME/mcafee-landing-page)

Or manually:
- Visit [vercel.com](https://vercel.com)
- Click "New Project"
- Import your GitHub repository
- Click "Deploy"

🎉 Done! Your site is live!

### Option 4: Deploy to Netlify

[![Deploy to Netlify](https://www.netlify.com/img/deploy/button.svg)](https://app.netlify.com/start)

Or drag and drop:
1. Zip all HTML files
2. Visit [netlify.com/drop](https://app.netlify.com/drop)
3. Drag and drop the zip file

## 📁 Project Structure

```
mcafee-landing-page/
├── preview-english.html      # Home page (main entry)
├── about.html                # About page
├── contact.html              # Contact page
├── privacy-policy.html       # Privacy policy
├── vercel.json              # Vercel configuration
├── DEPLOYMENT-GUIDE.md      # Detailed deployment guide
├── README.md                # This file
└── wordpress-integration/
    └── page-mcafee-landing.php  # WordPress template
```

## 🎨 Design System

### Color Palette

```css
/* Dark Theme */
--dark-bg: #0f1419           /* Main background */
--dark-secondary: #1a1f2e    /* Section background */

/* Accent Colors */
--danger-red: #dc2626        /* Primary accent */
--success-green: #10b981     /* Success states */
--warning-orange: #f97316    /* Warnings */

/* Text Colors */
--text-light: #e2e8f0        /* Primary text */
--text-muted: #64748b        /* Secondary text */
```

### Typography

- **Font Family**: System font stack for optimal performance
- **Headings**: 800 weight, responsive sizing
- **Body**: 400 weight, 1.6 line-height

### Components

- **Hero Section**: Animated background particles with red glow
- **Threat Cards**: Hover effects with red borders and shadows
- **CTA Buttons**: Gradient backgrounds with hover animations
- **Navigation**: Fixed header with scroll effects

## 🔧 Customization

### Change Colors

Edit the CSS variables in each HTML file:

```css
:root {
    --danger-red: #your-color;
    --dark-bg: #your-color;
    /* ... */
}
```

### Update Content

1. **Home Page**: Edit `preview-english.html`
2. **About Page**: Edit `about.html`
3. **Contact Page**: Edit `contact.html`
4. **Privacy**: Edit `privacy-policy.html`

### Add New Pages

1. Copy an existing HTML file
2. Modify the content
3. Update navigation links in all pages

## 🌐 Browser Support

- ✅ Chrome (latest)
- ✅ Firefox (latest)
- ✅ Safari (latest)
- ✅ Edge (latest)
- ✅ Mobile browsers

## 📱 Responsive Breakpoints

- **Desktop**: > 1200px
- **Tablet**: 768px - 1199px
- **Mobile**: < 768px

## 🔒 Security Features

- Content Security Policy headers
- XSS Protection
- Frame Options (clickjacking prevention)
- HTTPS enforcement (when deployed)

## 🚀 Performance

- **Size**: < 200 KB total
- **Load Time**: < 1s on fast connections
- **Lighthouse Score**: 95+ (Performance)
- **No Dependencies**: Pure HTML/CSS

## 📊 SEO Optimization

- ✅ Semantic HTML5
- ✅ Meta descriptions
- ✅ Responsive meta viewport
- ✅ Proper heading hierarchy
- ✅ Alt text ready for images

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see below for details:

```
MIT License

Copyright (c) 2024 Security Review

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

## 🔗 Useful Links

- [Vercel Documentation](https://vercel.com/docs)
- [Netlify Documentation](https://docs.netlify.com)
- [HTML Best Practices](https://github.com/hail2u/html-best-practices)
- [CSS Guidelines](https://cssguidelin.es)

## 📞 Support

If you have any questions or need help, please:

1. Check the [DEPLOYMENT-GUIDE.md](DEPLOYMENT-GUIDE.md)
2. Open an issue on GitHub
3. Contact via the website's contact form

## 🎉 Acknowledgments

- Design inspiration from modern cybersecurity websites
- Color palette optimized for accessibility
- Emoji icons from Unicode standard

---

**Made with ❤️ for cybersecurity awareness**

**⭐ If you find this useful, please star the repository!**
