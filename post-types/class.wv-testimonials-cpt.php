<?php

if (!class_exists('WV_Testimonials_Post_Type')) {
    class WV_Testimonials_Post_Type
    {

        public function __construct()
        {
            add_action('init', [$this, 'create_post_type']);
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
    }
}
