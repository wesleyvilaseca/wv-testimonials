<?php
$default_title = 'WV Testmonials';
$title = !empty($instance['title']) ? $instance['title'] : $default_title;
$number = !empty($instance['number']) ? $instance['number'] : 5;
$image = !empty($instance['image']) ? $instance['image'] : false;
$occupation = !empty($instance['occupation']) ? $instance['occupation'] : false;
$company = !empty($instance['company']) ? $instance['company'] : false;

echo $args['before_widget'];
echo $args['before_title'] . $title . $args['after_title'];

$testimonials = new WP_Query(
    [
        'post_type' => 'wv-testimonials',
        'posts_per_page' => $number,
        'post_status' => 'publish'
    ]
);
if ($testimonials->have_posts()) :
    while ($testimonials->have_posts()) :
        $testimonials->the_post();
        $url_meta = get_post_meta(get_the_ID(), 'wv_testimonials_user_url', true);
        $occupation_meta = get_post_meta(get_the_ID(), 'wv_testimonials_occupation', true);
        $company_meta = get_post_meta(get_the_ID(), 'wv_testimonials_company', true);
?>

        <div class="testimonial-item">
            <div class="title">
                <h3><?= the_title() ?></h3>
            </div>
            <div class="content">
                <?php
                if ($image) :
                ?>
                    <div class="thumb">
                        <?php
                        if (has_post_thumbnail()) :
                            the_post_thumbnail([70, 70]);
                        endif;
                        ?>
                    </div>
                <?php
                endif;
                ?>
                <?= the_content() ?>
            </div>
            <div class="meta">
                <?php if ($occupation) : ?>
                    <span class="occupation"> <?= esc_html($occupation_meta) ?></span>
                <?php endif ?>

                <?php if ($company) : ?>
                    <span class="occupation"> <a href="<?= esc_attr($url_meta) ?>"><?= esc_html($company_meta) ?></a></span>
                <?php endif ?>
            </div>
        </div>
<?php
    endwhile;
    wp_reset_postdata();
endif;
?>
<a href="<?= get_post_type_archive_link('wv-testimonials') ?>"><?= esc_html_e('Show More Testminials', 'wv-testimonials') ?></a>
<?php
echo $args['after_widget'];
?>