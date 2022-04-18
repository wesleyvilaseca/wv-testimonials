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

        if (is_active_widget(false, false, $this->id_base)) add_action('wp_enqueue_scripts', [$this, 'enqueue']);
    }

    public function enqueue()
    {
        wp_enqueue_style(
            'wv-testimonials-style-css',
            WV_TESTIMONIALS_URL . 'assets/css/frontend.css',
            [],
            WV_TESTIMONIALS_VERSION,
            'all'
        );
    }

    public function form($instance)
    {
        require(WV_TESTIMONIALS_PATH . 'widgets/forms/testimonials/form.php');
    }

    public function widget($args, $instance)
    {
        require(WV_TESTIMONIALS_PATH . 'widgets/front/testimonials/front.php');
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
