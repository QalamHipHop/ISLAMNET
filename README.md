# IslamNET - Islamic Social Network & Education Platform

**Version:** 1.2.0  
**Author:** QALAM  
**License:** GNU General Public License v2 or later  
**Repository:** https://github.com/QalamHipHop/ISLAMNET

## Overview

IslamNET is a comprehensive, professional WordPress theme designed specifically for the global Muslim community (Jamealslam / IslamRepublic). It provides a unified platform for social networking, educational content delivery, and community engagement. The theme seamlessly integrates BuddyPress for social features, LearnPress for educational content, and Elementor for flexible page building, all while maintaining strong support for RTL languages like Arabic and Persian.

## Key Features

### Social Networking
- **BuddyPress Integration:** Build vibrant communities with member profiles, activity streams, and direct messaging
- **Community Groups:** Create and manage topic-specific groups for discussions and collaboration
- **Member Directory:** Comprehensive member profiles with customizable information fields
- **Activity Streams:** Real-time updates on community activities and interactions

### Educational Platform
- **LearnPress LMS:** Full-featured learning management system for creating and delivering courses
- **Course Management:** Organize courses with lessons, quizzes, and assignments
- **Student Progress Tracking:** Monitor student advancement and completion rates
- **Certificate System:** Award certificates upon course completion

### Content Management
- **Elementor Page Builder:** Drag-and-drop interface for creating stunning pages without coding
- **Advanced Custom Fields:** Extend content types with custom fields and post types
- **Media Management:** rtMedia integration for rich media sharing within the community

### Community Features
- **Gamification:** GamiPress integration for badges, points, and leaderboards
- **Translation Support:** Loco Translate for multi-language support
- **E-commerce:** WooCommerce integration for selling courses, books, and products
- **Contact Forms:** Contact Form 7 for user inquiries and feedback

### Technical Features
- **RTL Support:** Full right-to-left language support for Arabic, Persian, and other RTL languages
- **Responsive Design:** Mobile-first approach ensuring perfect display on all devices
- **Performance Optimized:** WP Super Cache integration for fast loading times
- **SEO Ready:** Yoast SEO integration for search engine optimization
- **Accessibility:** WCAG compliant for inclusive user experience
- **Auto-Installer:** Merlin WP setup wizard with automatic plugin installation and demo content import

## Installation

### Method 1: Automatic Setup Wizard (Recommended)

1. **Upload the Theme:**
   - Download the IslamNET theme
   - Go to WordPress Admin → Appearance → Themes
   - Click "Add New" and upload the theme ZIP file
   - Click "Activate"

2. **Run Setup Wizard:**
   - After activation, the Merlin WP setup wizard will automatically launch
   - Follow the on-screen instructions:
     - Welcome screen
     - Plugin installation (required and recommended plugins)
     - Demo content import
     - Theme customization
     - Completion screen

3. **Complete Setup:**
   - The wizard will automatically install and activate all required plugins
   - Demo content will be imported to give you a starting point
   - Your site will be ready to customize

### Method 2: Manual Installation

1. **Upload the Theme:**
   - Extract the theme folder
   - Upload via FTP to `/wp-content/themes/`
   - Go to WordPress Admin → Appearance → Themes
   - Find IslamNET and click "Activate"

2. **Install Required Plugins:**
   - Go to Appearance → Install Plugins
   - Install and activate the following required plugins:
     - BuddyPress
     - Elementor
     - Advanced Custom Fields

3. **Install Recommended Plugins:**
   - LearnPress (for course management)
   - GamiPress (for gamification)
   - rtMedia (for media sharing)
   - WooCommerce (for e-commerce)
   - Contact Form 7 (for contact forms)
   - Yoast SEO (for SEO optimization)
   - WP Super Cache (for performance)

## System Requirements

- **WordPress:** 5.0 or higher
- **PHP:** 5.6 or higher (7.4+ recommended)
- **MySQL:** 5.6 or higher
- **Memory Limit:** 128MB minimum (256MB recommended)

## Required Plugins

The following plugins are required for full functionality:

| Plugin | Purpose | Repository |
|--------|---------|--------|
| BuddyPress | Social networking features | WordPress.org |
| Elementor | Page builder | WordPress.org |
| Advanced Custom Fields | Custom field management | WordPress.org |

## Recommended Plugins

The following plugins are recommended for enhanced functionality:

| Plugin | Purpose | Repository |
|--------|---------|--------|
| LearnPress | Learning management system | WordPress.org |
| GamiPress | Gamification and badges | WordPress.org |
| rtMedia | Media sharing and management | WordPress.org |
| WooCommerce | E-commerce functionality | WordPress.org |
| Contact Form 7 | Contact forms | WordPress.org |
| Yoast SEO | SEO optimization | WordPress.org |
| WP Super Cache | Performance optimization | WordPress.org |
| Loco Translate | Translation management | WordPress.org |

## Configuration

### After Installation

1. **Site Settings:**
   - Go to Settings → General and configure your site title and tagline
   - Set your site language and timezone

2. **BuddyPress Setup:**
   - Go to Settings → BuddyPress
   - Configure member profiles, groups, and activity settings
   - Create default pages for BuddyPress components

3. **LearnPress Setup (if using courses):**
   - Go to LearnPress → Settings
   - Configure course settings and student enrollment options

4. **Theme Customization:**
   - Go to Appearance → Customize
   - Customize colors, fonts, and layout
   - Upload your logo and header image

### Creating Content

1. **Create Pages:**
   - Go to Pages → Add New
   - Use Elementor to design your pages
   - Set page templates and options

2. **Create Posts:**
   - Go to Posts → Add New
   - Write your content and set featured images
   - Assign categories and tags

3. **Create Courses (if using LearnPress):**
   - Go to Courses → Add New
   - Create lessons and quizzes
   - Set course pricing and enrollment options

4. **Create Groups (if using BuddyPress):**
   - Go to BuddyPress → Groups
   - Create new groups for community discussions

## Customization

### Modifying Styles

The theme uses CSS for styling. To customize styles:

1. Edit `/assets/css/main.css` for custom CSS
2. For RTL languages, edit `/assets/css/rtl.css`
3. For BuddyPress, edit `/assets/css/buddypress-custom.css`

### Adding Custom Functionality

1. Create a child theme to preserve your customizations
2. Add custom code to the child theme's `functions.php`
3. Use hooks and filters provided by the theme

### Creating Custom Templates

1. Create custom template files in the theme directory
2. Use the existing template structure as a reference
3. Utilize template-parts for reusable components

## File Structure

```
islamnet/
├── assets/
│   ├── css/
│   │   ├── main.css
│   │   ├── rtl.css
│   │   └── buddypress-custom.css
│   ├── js/
│   │   └── main.js
│   └── images/
├── inc/
│   ├── setup/
│   │   └── class-islamnet-setup-wizard.php
│   ├── helpers/
│   │   ├── helper-functions.php
│   │   └── buddypress-integration.php
│   ├── widgets/
│   │   └── custom-widgets.php
│   ├── tgmpa/
│   │   └── class-tgm-plugin-activation.php
│   ├── Merlin/
│   │   └── (Merlin WP setup wizard files)
│   ├── customizer/
│   └── demo-content/
│       ├── content.xml
│       ├── widgets.wie
│       └── customizer.dat
├── template-parts/
│   ├── content/
│   ├── header/
│   └── footer/
├── 404.php
├── archive.php
├── footer.php
├── functions.php
├── header.php
├── index.php
├── single.php
├── style.css
├── rtl.css
├── install.php
└── README.md
```

## Troubleshooting

### Setup Wizard Not Appearing

- Clear your browser cache
- Check that Merlin WP files are properly installed in `/inc/Merlin/`
- Verify that `class-islamnet-setup-wizard.php` is being included in `functions.php`

### Plugins Not Installing

- Ensure your server has sufficient memory (256MB minimum)
- Check that file permissions allow plugin installation
- Verify that your WordPress installation is up to date

### BuddyPress Not Working

- Ensure BuddyPress pages are created (Settings → BuddyPress → Pages)
- Check that BuddyPress is activated
- Verify that the theme supports BuddyPress

### RTL Not Working

- Check that your WordPress language is set to an RTL language
- Verify that RTL CSS files are loaded
- Clear browser cache and WordPress cache

## Support & Documentation

For support, documentation, and updates, visit:
- **GitHub Repository:** https://github.com/QalamHipHop/ISLAMNET
- **Issues & Bug Reports:** https://github.com/QalamHipHop/ISLAMNET/issues

## Contributing

We welcome contributions to IslamNET! To contribute:

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## License

IslamNET is licensed under the GNU General Public License v2 or later. See the LICENSE file for details.

## Credits

IslamNET is built upon the solid foundation of the SocialV theme and incorporates best practices from the WordPress community. We extend our gratitude to all contributors and the open-source community.

## Changelog

### Version 1.2.0
- Added Merlin WP setup wizard for streamlined installation
- Enhanced plugin management with TGM Plugin Activation
- Improved theme structure and modularity
- Added automatic installer script
- Enhanced RTL support
- Added demo content framework
- Improved documentation and setup instructions
- Added support for multiple navigation menus
- Added custom logo and header support

### Version 1.1.0
- Initial release
- Basic theme structure
- BuddyPress integration
- Elementor support
- RTL language support

## Future Roadmap

- Custom Elementor widgets for IslamNET-specific components
- Advanced BuddyPress customization options
- LearnPress course templates and extensions
- Community marketplace integration
- Mobile app integration
- Advanced analytics and reporting
- Multi-site support
- Performance optimization enhancements
- Advanced user roles and permissions

---

**Thank you for choosing IslamNET! We hope it helps you build a thriving Islamic community online.**

Developed by [QalamHipHop](https://github.com/QalamHipHop). Based on the Jamealslam strategic plan.
