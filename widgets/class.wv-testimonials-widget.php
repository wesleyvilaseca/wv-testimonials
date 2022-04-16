<?php

class WV_Testimonials_Widget extends WP_Widget
{
    public function __construct()
    {
        $widget_options = [
            'description' => __('Your most beloved testmonials', 'wv-testmonials')
        ];
        parent::__construct(
            'wv-testimonials',
            'WV Testmonials',
            $widget_options
        );

        add_action('widgets_init', function(){
            register_widget('WV_Testimonials_Widget');
        });
    }

    public function form($instance)
    {
    }

    public function widget( $args, $instance)
    {
    }

    public function update( $newinstance, $oldinstance)
    {
    }
}
