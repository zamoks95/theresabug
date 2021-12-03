<?php
/*
    Plugin Name: Argenta Shortcodes and Widgets
    Plugin URI: http://argenta.colabr.io/
    Description: Supercharge Argenta theme with pack of shortcodes, custom VC settings types and sidebar widgets
    Version: 2.1.3
    Author: colabrio
    Author URI: http://argenta.colabr.io/


    Copyright 2019 colabrio (email: team@colabr.io)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


$argenta_extra_get_theme = wp_get_theme();

if ( in_array( $argenta_extra_get_theme->get( 'TextDomain' ), array( 'argenta', 'argenta-child' ) ) ) {

    add_action( 'plugins_loaded', 'argenta_extra_load_plugin_textdomain' );

    function argenta_extra_load_plugin_textdomain() {
        load_plugin_textdomain( 'argenta_extra', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }


    add_action( 'vc_before_init', 'argenta_extra_vc_init_plugin' );

    function argenta_extra_vc_init_plugin() {
        $shortcodes_path  = plugin_dir_path( __FILE__ ) . 'shortcodes/';
        $helpers_path     = plugin_dir_path( __FILE__ ) . 'helpers/';
        $types_path       = plugin_dir_path( __FILE__ ) . 'types/';

        // Helpers
        require $helpers_path . 'parsing.php';
        require $helpers_path . 'filtering.php';
        require $helpers_path . 'google_fonts.php';

        // VC param types
        require $types_path . 'button.php';                         // Button settings
        require $types_path . 'choose_box.php';                     // Radio select with images
        require $types_path . 'check.php';                          // Pretty checkboxes
        require $types_path . 'columns.php';                        // Pretty columns
        require $types_path . 'divider.php';                        // Simple titled divider
        require $types_path . 'typography.php';                     // Powerfull typography module
        require $types_path . 'icon_selector.php';                  // Extended icon selector
        require $types_path . 'icon_picker.php';                    // Extended icon picker
        require $types_path . 'datetime.php';                       // JQuery datetime selector
        require $types_path . 'portfolio_types.php';                // Dropdown with portfolio categories
        require $types_path . 'post_types.php';                // Dropdown with portfolio categories

        // VC shortcodes
        require $shortcodes_path . 'accordion.php';                 // Accordion
        require $shortcodes_path . 'accordion_inner.php';           // Accordion inner tab
        require $shortcodes_path . 'banner_box.php';                // Banner box
        require $shortcodes_path . 'banner_box_group.php';          // Group of banner box elements with hover effect
        require $shortcodes_path . 'banner_box_inner.php';          // Banner box child of group
        require $shortcodes_path . 'button.php';                    // Button module
        require $shortcodes_path . 'chart_box.php';                 // Simple chart box
        require $shortcodes_path . 'contact_form.php';              // Contact Form 7 styled shortcode
        require $shortcodes_path . 'contacts_group.php';            // Group of contacts
        require $shortcodes_path . 'contact_inner.php';             // Contact row in contacts group (?)
        require $shortcodes_path . 'countdown_box.php';             // Countdown module
        require $shortcodes_path . 'counter_box.php';               // Numeric fact box
        require $shortcodes_path . 'gallery.php';                   // Popup gallery
        require $shortcodes_path . 'google_maps.php';               // Simple Google Map integration
        require $shortcodes_path . 'heading.php';                   // Powerfull heading module
        require $shortcodes_path . 'icon_box.php';                  // Icon, title, description, button...
        require $shortcodes_path . 'list_box.php';                  // Simple list with/-out marks
        require $shortcodes_path . 'instagram_feed.php';            // Instagram feed photos
        require $shortcodes_path . 'menu_list.php';                 // Extended list box for menu
        require $shortcodes_path . 'message_box.php';               // Simple module for messages like "Error!", "Succesfullyyyy!", "You are winner...."
        require $shortcodes_path . 'parallax.php';                  // Parallax block
        require $shortcodes_path . 'pricing_table.php';             // Pricing tarif box
        require $shortcodes_path . 'pricing_table_features.php';    // Features for pricing table
        require $shortcodes_path . 'progress_bar.php';              // Simple progress bar
        require $shortcodes_path . 'recent_posts.php';              // Grid with recent posts
        require $shortcodes_path . 'recent_projects.php';           // Most featured recent projects module with 2 view types
        require $shortcodes_path . 'slider.php';                    // Content slider
        require $shortcodes_path . 'slider_inner.php';              // Content slider inner
        require $shortcodes_path . 'social_bar.php';                // Social buttons
        require $shortcodes_path . 'split_box.php';                 // Cool item -- split view box
        require $shortcodes_path . 'split_box_inner.php';           // .. inner for deep split box location
        require $shortcodes_path . 'split_box_column.php';          // For 2 columns
        require $shortcodes_path . 'split_box_column_inner.php';    // .. and column inner
        require $shortcodes_path . 'split_screens.php';             // Split view screens
        require $shortcodes_path . 'split_screen.php';              // .. inner page
        require $shortcodes_path . 'split_screen_column_left.php';  // .. inner column
        require $shortcodes_path . 'split_screen_column_right.php'; // .. inner column
        require $shortcodes_path . 'subscribe.php';                 // Feedburner subscriber
        require $shortcodes_path . 'tabs.php';                      // Tabs module
        require $shortcodes_path . 'tabs_inner.php';                // Tab
        require $shortcodes_path . 'team_member.php';               // Team member
        require $shortcodes_path . 'team_members_group.php';        // Team members group with hover effect
        require $shortcodes_path . 'team_member_inner.php';         // Team member
        require $shortcodes_path . 'testimonial.php';               // Testimonial block
        require $shortcodes_path . 'text.php';                      // Text module
        require $shortcodes_path . 'video_module.php';              // Popup video module
    }


    add_action( 'widgets_init', 'argenta_extra_widgets_init_plugin' );

    function argenta_extra_widgets_init_plugin() {
        $shortcodes_path  = plugin_dir_path( __FILE__ ) . 'shortcodes/';
        $helpers_path     = plugin_dir_path( __FILE__ ) . 'helpers/';
        $types_path       = plugin_dir_path( __FILE__ ) . 'types/';
        $widgets_path     = plugin_dir_path( __FILE__ ) . 'widgets/';

        // Widgets
        require $widgets_path . 'widget-about-author.php';          // About author. Multicontext widget
        require $widgets_path . 'widget-contacts.php';              // Contacts block widget
        require $widgets_path . 'widget-login.php';                 // Login into Wordpress
        require $widgets_path . 'widget-logo.php';                  // Show logo in sidebar
        require $widgets_path . 'widget-menu.php';                  // Navigation widget
        require $widgets_path . 'widget-recent.php';                // Recent posts widget
        require $widgets_path . 'widget-socialbar-subscribe.php';   // ?
        require $widgets_path . 'widget-socialbar.php';             // Social bar icons with
        require $widgets_path . 'widget-subscribe.php';             // Subscribe by Feedburner feed
    }


    // ACF Argenta fields extention
    require plugin_dir_path( __FILE__ ) . 'acf_ext/acf-argenta-fields.php';

} else {
    add_action( 'admin_notices', 'argenta_extra_admin_notice' );

    function argenta_extra_admin_notice() {
?>
    <div class="notice notice-error">
        <p>
            <strong><?php esc_html_e( '"Argenta Shortcodes and Widgets" plugin is not supported by this theme', 'argenta_extra' ); ?></strong>
            <br>
            <?php esc_html_e( 'Please use this plugin with Argenta theme, or deactivate it.', 'argenta_extra' ); ?>
        </p>
    </div>
<?php
    }
}
