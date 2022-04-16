<?php 
$meta = get_post_meta($post->ID);
?>
<input type="hidden" name="wv_testimonials_nonce" value="<?php echo wp_create_nonce("wv_testimonials_nonce") ?>">
<table class="form-table mv-testimonials-metabox"> 
    <tr>
        <th>
            <label for="wv_testimonials_occupation"><?php esc_html_e( 'User occupation', 'wv-testimonials' ); ?></label>
        </th>
        <td>
            <input 
                type="text" 
                name="wv_testimonials_occupation" 
                id="wv_testimonials_occupation" 
                class="regular-text occupation"
                value="<?php echo esc_html(@$meta['wv_testimonials_occupation'][0]) ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="wv_testimonials_company"><?php esc_html_e( 'User company', 'wv-testimonials' ); ?></label>
        </th>
        <td>
            <input 
                type="text" 
                name="wv_testimonials_company" 
                id="wv_testimonials_company" 
                class="regular-text company"
                value="<?php echo esc_html(@$meta['wv_testimonials_company'][0]) ?>"
            >
        </td>
    </tr>
    <tr>
        <th>
            <label for="wv_testimonials_user_url"><?php esc_html_e( 'User URL', 'wv-testimonials' ); ?></label>
        </th>
        <td>
            <input 
                type="url" 
                name="wv_testimonials_user_url" 
                id="wv_testimonials_user_url" 
                class="regular-text user-url"
                value="<?php echo esc_url(@$meta['wv_testimonials_user_url'][0]) ?>"
            >
        </td>
    </tr> 
</table>