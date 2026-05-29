# IslamNET Project Development Plan

## 1. Goal
To transform the existing `IslamNET` WordPress theme into a comprehensive, feature-rich Islamic social networking and educational platform, leveraging the structural and functional patterns observed in the `SocialV` theme. This includes integrating a robust setup wizard, enhanced plugin management, and a modular theme structure, while preserving and expanding upon the theme's core Islamic focus. The final output will be a complete WordPress theme package with an automatic installer and essential plugins, ready for deployment.

## 2. Current State of IslamNET
The `IslamNET` theme currently provides a foundational structure for a WordPress theme, including basic template files (`header.php`, `footer.php`, `index.php`, `style.css`), asset management (`assets/css`), and an `inc` directory for helper functions, TGM Plugin Activation, and custom widgets. It already registers BuddyPress and Elementor as required plugins via TGM. The theme is designed with an Islamic focus, as indicated by its name and description in `style.css`.

## 3. Analysis of SocialV Pattern
The `SocialV` theme (`socialv.zip`) demonstrates a well-organized WordPress theme structure, with key features including:

*   **Modular `inc` Directory:** Contains various components for theme functionality (e.g., `Theme_Setup`, `TGM`, `Merlin`).
*   **Merlin WP Integration:** `SocialV` utilizes `Merlin WP` (found in `inc/Merlin`) as a setup wizard. This wizard guides users through initial theme configuration, plugin installation, and demo content import. The `Merlin` directory contains the core files for this wizard, including its classes, assets, and language files. The initialization of Merlin is typically handled within the `functions.php` or a dedicated `Theme_Setup` component, as observed in `inc/Theme_Setup/Component.php`.
*   **TGM Plugin Activation:** The theme uses `TGM Plugin Activation` (found in `inc/TGM`) to recommend and manage the installation of required and recommended plugins. `SocialV` lists several plugins, including `Advanced Custom Fields`, `Elementor`, `BuddyPress`, `MediaPress`, and custom `Iqonic` extensions, some of which are hosted externally.
*   **Asset Management:** Organized `assets` directory for CSS, JS, and images.
*   **Template Parts:** Use of `template-parts` for reusable components.

## 4. Proposed Enhancements for IslamNET
Based on the `SocialV` pattern, the `IslamNET` theme will be enhanced as follows:

### 4.1. Integration of a Setup Wizard (Merlin WP)
*   **Objective:** Implement a user-friendly setup wizard to streamline the theme installation and configuration process, similar to `SocialV`'s use of `Merlin WP`.
*   **Steps:**
    1.  Integrate the `Merlin WP` library into the `IslamNET` theme, likely within the `inc` directory (e.g., `inc/Merlin`).
    2.  Configure `Merlin WP` to guide users through:
        *   **Child Theme Creation (Optional):** Offer to create a child theme.
        *   **Plugin Installation:** Automatically install and activate essential plugins (BuddyPress, LearnPress, Elementor, etc.) using the existing TGM Plugin Activation setup.
        *   **Demo Content Import:** Provide an option to import demo content (pages, posts, menus, widgets) to quickly set up a functional site. This will require creating XML export files for demo content.
        *   **Theme Options Configuration:** Set up initial theme options (e.g., logo, color scheme, typography) if customizer options are developed.
    3.  Ensure the wizard's branding and messaging align with the `IslamNET` theme's identity.

### 4.2. Enhanced Plugin Management
*   **Objective:** Optimize the existing TGM Plugin Activation setup to recommend a comprehensive suite of plugins tailored for an Islamic social and educational platform.
*   **Steps:**
    1.  Review and update the list of required and recommended plugins in `islamnet_register_required_plugins` function within `functions.php`.
    2.  Include plugins relevant to:
        *   **Social Networking:** BuddyPress (already included), possibly extensions for groups, forums, and private messaging.
        *   **Learning Management:** LearnPress (already included), potentially add-ons for quizzes, courses, and certificates.
        *   **Page Building:** Elementor (already included), and potentially its Pro version or essential add-ons.
        *   **E-commerce (Optional):** WooCommerce (already included) for selling courses, books, or other Islamic products.
        *   **Gamification:** GamiPress (already included) for engagement.
        *   **Media Management:** rtMedia (already included) for media sharing within the community.
        *   **Translation:** Loco Translate (already included) for multi-language support.
        *   **SEO, Security, Performance:** Recommend standard plugins for these aspects.
    3.  Ensure that custom plugins (if any are developed for IslamNET) are also included in the TGM list.

### 4.3. Modular Theme Structure Refinement
*   **Objective:** Organize theme files logically to improve maintainability and scalability.
*   **Steps:**
    1.  Further modularize the `inc` directory, creating subdirectories for distinct functionalities (e.g., `inc/setup`, `inc/customizer`, `inc/hooks`).
    2.  Ensure all theme-specific functions are properly namespaced or prefixed to avoid conflicts.
    3.  Organize `template-parts` into more granular components.

### 4.4. Islamic Content and Design Integration
*   **Objective:** Ensure all design elements, content, and functionalities reflect Islamic values and aesthetics.
*   **Steps:**
    1.  Develop default demo content (posts, pages, courses, groups) that is relevant to Islamic education, community, and lifestyle.
    2.  Design custom Elementor templates or blocks with Islamic-inspired layouts and typography.
    3.  Ensure RTL (Right-to-Left) language support is robust for Arabic and Persian content.

## 5. Development Steps (High-Level)
1.  **Integrate Merlin WP:** Copy `Merlin WP` files into `inc/Merlin` and initialize it in `functions.php` or a dedicated setup file.
2.  **Configure Merlin WP:** Define wizard steps, plugin lists, and demo content import settings.
3.  **Prepare Demo Content:** Create `content.xml`, `widgets.wie`, and `customizer.dat` files for demo import.
4.  **Update TGM Plugin List:** Refine the list of recommended plugins in `functions.php`.
5.  **Develop Core Theme Features:** Implement any missing core functionalities or design elements.
6.  **Testing:** Thoroughly test the setup wizard, plugin installation, and demo content import.
7.  **Documentation:** Create user-friendly documentation for theme installation and usage.

## 6. Prompt for Development

```
Based on the `SocialV` theme's structure and the `IslamNET` theme's current state, proceed with the following development tasks:

1.  **Integrate Merlin WP Setup Wizard:**
    *   Copy the `Merlin` directory from `/home/ubuntu/socialv_pattern/inc/Merlin` to `/home/ubuntu/ISLAMNET/inc/Merlin`.
    *   Create a new file `/home/ubuntu/ISLAMNET/inc/setup/class-islamnet-setup-wizard.php` to handle the initialization and configuration of Merlin WP. This file should be included in `functions.php`.
    *   In `class-islamnet-setup-wizard.php`, initialize Merlin WP, setting the `directory` to `inc/Merlin` and `merlin_url` to `islamnet-setup`. Define the wizard steps to include:
        *   Welcome screen.
        *   Child theme creation (optional).
        *   Plugin installation (using the existing TGM setup).
        *   Demo content import (referencing `content.xml`, `widgets.wie`, `customizer.dat` which will be created later).
        *   Theme options/customizer import.
        *   Finish screen.

2.  **Enhance TGM Plugin Activation:**
    *   Review the `islamnet_register_required_plugins` function in `/home/ubuntu/ISLAMNET/functions.php`.
    *   Ensure the list of plugins is comprehensive for an Islamic social and educational platform. Add any relevant plugins that `SocialV` uses (e.g., Advanced Custom Fields, MediaPress) if they are beneficial for IslamNET's goals, and ensure existing ones like BuddyPress, Elementor, LearnPress, GamiPress, rtMedia, Loco Translate, WooCommerce, and Contact Form 7 are correctly configured.
    *   For any custom plugins or premium plugins that might be required, ensure their `source` URLs are correctly specified if they are not available in the WordPress.org repository.

3.  **Prepare Placeholder Demo Content:**
    *   Create empty placeholder files for demo content in a new directory `/home/ubuntu/ISLAMNET/inc/demo-content/`:
        *   `content.xml` (for posts, pages, custom post types, etc.)
        *   `widgets.wie` (for widget settings)
        *   `customizer.dat` (for customizer settings)
    *   These files will be populated with actual demo content in a later phase.

4.  **Refine Theme Structure:**
    *   Create the `inc/setup` directory for the setup wizard class.
    *   Ensure all new files are properly included in `functions.php`.

After completing these steps, the `IslamNET` theme should have a functional setup wizard and an updated plugin management system, ready for further content and design development.
```
