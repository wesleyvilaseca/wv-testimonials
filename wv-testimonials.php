<?php

/**
 * Plugin Name: WV Testimonials
 * Plugin URI: https://www.wordpress.org/wv-testimonials
 * Description: My plugin's description
 * Version: 1.0
 * Requires at least: 5.9
 * Requires PHP: 7.4
 * Author: Wesley Vila
 * Author URI: https://www.codevila.com.br
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wv-testimonials
 * Domain Path: /languages
 */
/*
this is a free software, I make during the courso of wordpress
 
You should have received a copy of the GNU General Public License
along with MV Testimonials. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('WV_Testimonials')) {

    class WV_Testimonials
    {

        public function __construct()
        {

            // Define constants used througout the plugin
            $this->define_constants();

            /**
             * custom post typo classes
             */
            require_once(WV_TESTIMONIALS_PATH . 'post-types/class.wv-testimonials-cpt.php');
            $WVTestmonialsPostType = new WV_Testimonials_Post_Type();

            /**
             * widgets classes
             */
            require_once(WV_TESTIMONIALS_PATH . 'widgets/class.wv-testimonials-widget.php');
            $WVTestmonialsPostType = new WV_Testimonials_Widget();

            add_filter('archive_template', [$this, 'load_custom_archive_template']);
            add_filter('single_template', [$this, 'load_custom_single_template']);
        }

        /**
         * Define Constants
         */
        public function define_constants()
        {
            // Path/URL to root of this plugin, with trailing slash.
            define('WV_TESTIMONIALS_PATH', plugin_dir_path(__FILE__));
            define('WV_TESTIMONIALS_URL', plugin_dir_url(__FILE__));
            define('WV_TESTIMONIALS_VERSION', '1.0.0');
            define('WV_TESTIMONIALS_OVERRIDE_PATH_DIR', get_stylesheet_directory() . '/wv-testimonials/');
        }

        public function load_custom_archive_template($tpl)
        {
            if (current_theme_supports('wv-testimonials'))
                if (is_post_type_archive('wv-testimonials')) $tpl = $this->get_template_part_location('archive-wv-testimonials.php');

            return $tpl;
        }

        public function load_custom_single_template($tpl)
        {
            if (current_theme_supports('wv-testimonials'))
                if (is_singular('wv-testimonials')) $tpl = $this->get_template_part_location('single-wv-testimonials.php');

            return $tpl;
        }

        public function get_template_part_location($file)
        {
            if (file_exists(WV_TESTIMONIALS_OVERRIDE_PATH_DIR . $file))
                $file = WV_TESTIMONIALS_OVERRIDE_PATH_DIR . $file;
            else
                $file = WV_TESTIMONIALS_PATH . 'views/templates/' . $file;

            return $file;
        }

        /**
         * Activate the plugin
         */
        public static function activate()
        {
            update_option('rewrite_rules', '');
        }

        /**
         * Deactivate the plugin
         */
        public static function deactivate()
        {
            unregister_post_type('wv-testimonials');
            flush_rewrite_rules();
        }

        /**
         * Uninstall the plugin
         */
        public static function uninstall()
        {
            delete_option('widget_wv-testimonials');

            $posts = get_posts(
                [
                    'post_type' => 'wv-testimonials',
                    'number' =>  -1,
                    'post_status' => 'any'
                ]
            );

            foreach ($posts as $post) {
                wp_delete_post($post->ID, true);
            }
        }
    }
}

if (class_exists('WV_Testimonials')) {
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('WV_Testimonials', 'activate'));
    register_deactivation_hook(__FILE__, array('WV_Testimonials', 'deactivate'));
    register_uninstall_hook(__FILE__, array('WV_Testimonials', 'uninstall'));

    $wv_testimonials = new WV_Testimonials();
}
