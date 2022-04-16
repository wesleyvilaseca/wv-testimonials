<?php

if (!class_exists('WV_Testimonials_Post_Type')) {
    class WV_Testimonials_Post_Type
    {

        public function __construct()
        {
            add_action('init', [$this, 'create_post_type']);

            //campos personalisados
            add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
            add_action('save_post', [$this, 'save_post']);
        }

        public function create_post_type()
        {
            register_post_type(
                'wv-testimonials',
                [
                    'label'         => 'Testimonial',
                    'description'   => 'Testimonials',
                    'labels'        => [
                        'name'          => 'Testimonials',
                        'singular_name' => 'Testimonial'
                    ],
                    'public'            => true,
                    //page-attributes serve para adicionar hierarquia dos posts  
                    'supports'              => ['title', 'editor', 'thumbnail', /*'page-attributes'*/],
                    'hierarchical'          => false,
                    'show_ui'               => true,
                    'show_in_menu'          => true,
                    'menu_position'         => 5,
                    'show_in_admin_bar'     => true,
                    'show_in_nav_menus'     => true,
                    'can_export'            => true,
                    'has_archive'           => true, //this plugin will be archive theme file, in this case, a page
                    'exclude_from_search'   => false,
                    'publicly_queryable'    => true,
                    'show_in_rest'          => true,
                    'menu_icon'             => 'dashicons-testimonial'
                ]
            );
        }

        public function add_meta_boxes()
        {
            add_meta_box(
                'wv_testimonials_meta_box', //id metabox
                esc_html__('Testmonials Optios', 'wv_testimonials'), //title metabox
                [$this, 'add_inner_meta_boxes'], //callback content metaboxe
                'wv-testimonials', //screen where metabox it will show up
                'normal', //contexto,
                'high', //priority
            );
        }

        public function add_inner_meta_boxes($post)
        {
            require_once(WV_TESTIMONIALS_PATH . 'views/wv-testimonials_metabox.php');
        }

        public function save_post($post_id)
        {
            if ($_POST['wv_testimonials_nonce']) {
                if (!wp_verify_nonce($_POST['wv_testimonials_nonce'], 'wv_testimonials_nonce')) {
                    return;
                }
            }

            if (defined('DOING_AUTOSAVE') and DOING_AUTOSAVE) return;

            if (isset($_POST['post_type']) and $_POST['post_type'] == 'wv-testimonials') {
                if (!current_user_can('edit_page', $post_id)) return;
                if (!current_user_can('edit_post', $post_id)) return;
            }

            if (!isset($_POST['action']) and $_POST['action'] !== 'editpost') return;

            $old_ocupation = get_post_meta($post_id, 'wv_testimonials_occupation', true);
            $new_ocupation = $_POST['wv_testimonials_occupation'];

            $old_company = get_post_meta($post_id, 'wv_testimonials_company', true);
            $new_company = $_POST['wv_testimonials_company'];

            $old_url = get_post_meta($post_id, 'wv_testimonials_user_url', true);
            $new_url = $_POST['wv_testimonials_user_url'];

            if (empty($new_ocupation))
                update_post_meta($post_id, 'wv_testimonials_occupation', 'add some text');
            else
                update_post_meta($post_id, 'wv_testimonials_occupation', sanitize_text_field($new_ocupation), $old_ocupation);


            if (empty($new_company))
                update_post_meta($post_id, 'wv_testimonials_company', '#');
            else
                update_post_meta($post_id, 'wv_testimonials_company', sanitize_text_field($new_company), $old_company);

            if (empty($new_url))
                update_post_meta($post_id, 'wv_testimonials_user_url', '#');
            else
                update_post_meta($post_id, 'wv_testimonials_user_url', esc_url_raw($new_url), $old_url);
        }
    }
}
