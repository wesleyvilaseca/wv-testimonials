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

        add_action('widgets_init', function () {
            register_widget('WV_Testimonials_Widget');
        });
    }

    public function form($instance)
    {
        include(WV_TESTIMONIALS_PATH . 'widgets/forms/testimonials/form.php');
    }

    public function widget($args, $instance)
    {
    }

    public function update($newinstance, $oldinstance)
    {
        $instance   = $oldinstance;
        $instance['title']  = sanitize_text_field($newinstance['title']);
        $instance['number'] = (int) $newinstance['number'];
        $instance['image']  = !empty($newinstance['image']) ? 1 : 0;
        $instance['occupation']   = !empty($newinstance['occupation']) ? 1 : 0;
        $instance['company']    = !empty($newinstance['company']) ? 1 : 0;

        return $instance;
    }
}
