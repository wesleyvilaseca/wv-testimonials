<?php
$title = isset($instance['title']) ? $instance['title'] : '';
$image = isset($instance['image']) ? (bool) $instance['image'] : false;
$number = isset($instance['number']) ? (int) $instance['number'] : 5;
$company = isset($instance['company']) ? (bool) $instance['company'] : true;
$occupation = isset($instance['occupation']) ? (bool) $instance['occupation'] : true;
?>

<p>
    <label for="<?php echo $this->get_field_id('title') ?>"><?php esc_html_e('Title', 'wv-testimonials') ?></label>
    <input type="text" class="widfat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo esc_attr($title) ?>">
</p>

<p>
    <label for="<?php echo $this->get_field_id('number') ?>"><?php esc_html_e('Number of testimonials to show', 'wv-testimonials') ?></label>
    <input type="number" class="tiny-text" id="<?php echo $this->get_field_id('number') ?>" name="<?php echo $this->get_field_name('number') ?>" value="<?php echo esc_attr($number) ?>" step="1" min="1" size="3">
</p>

<p>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('image') ?>" name="<?php echo $this->get_field_name('image') ?>" <?php checked($image) ?>>
    <label for="<?php echo $this->get_field_id('image') ?>"><?php esc_html_e('Display user image?', 'wv-testimonials') ?></label>
</p>

<p>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('occupation') ?>" name="<?php echo $this->get_field_name('occupation') ?>" <?php checked($occupation) ?>>
    <label for="<?php echo $this->get_field_id('occupation') ?>"><?php esc_html_e('Display occupation?', 'wv-testimonials') ?></label>
</p>

<p>
    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('company') ?>" name="<?php echo $this->get_field_name('company') ?>" <?php checked($company) ?>>
    <label for="<?php echo $this->get_field_id('company') ?>"><?php esc_html_e('Display company?', 'wv-testimonials') ?></label>
</p>