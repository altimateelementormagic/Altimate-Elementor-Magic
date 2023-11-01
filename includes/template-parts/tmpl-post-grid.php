<?php
use AEM_Addons_Elementor\classes\Helper;

$cat_position_over_image = 'default';
if ( 'yes' !== $settings['aem_post_grid_category_default_position'] ) :
    $cat_position_over_image = $settings['aem_post_grid_category_position_over_image'];
endif;

if( isset( $settings['aem_post_grid_equal_height'] ) ){
    $equalHeight = $settings['aem_post_grid_equal_height'];
} else {
    $equalHeight = ' ';
}
if( 'yes' != $settings['aem_post_grid_show_title_parmalink'] ){
    $parmalink = get_permalink();
    $style_par = '';
} else{
    $parmalink = '';
    $style_par = 'style= "pointer-events: none;"';
}

if( 'yes' == $settings['aem_post_grid_show_read_more_btn_new_tab'] ){
    $target = "_blank";
} else{
    $target = "_self";
}
?>

<article class="aem-post-grid-three aem-col <?php echo ('aem-filterable-post' === $settings['template_type'] ) ? ' aem-filterable-item ' . esc_attr( Helper::aem_get_categories_name_for_class()) : ' ' ;?>">
    <div class="aem-post-grid-container image-position-<?php echo esc_attr( $settings['aem_post_grid_image_align'] ); ?> aem-post-grid-equal-height-<?php echo esc_attr($equalHeight); ?>">
        <?php do_action('aem_post_grid_each_item_wrapper_before');
        if( 'yes' === $settings['aem_post_grid_show_image'] && has_post_thumbnail() ) : ?>
            <figure class="aem-post-grid-thumbnail">
                <a href="<?php echo esc_url( $parmalink ); ?>" <?php echo $style_par; ?>>
                    <?php the_post_thumbnail( $settings['post_grid_image_size_size'] ); ?>
                </a>
                
                <?php
                if( 'yes' === $settings['aem_post_grid_show_category'] && 'yes' !== $settings['aem_post_grid_category_default_position'] ) :
                    if('-top-right' === $settings['aem_post_grid_category_position_over_image']) : ?>
                        <ul class="aem-post-grid-category postion-top-right">
                            <?php Helper::aem_get_categories_for_post(); ?>
                        </ul>
                    <?php    
                    endif;
                endif;
                ?>
            </figure>
        <?php endif; ?>

        <div class="aem-post-grid-body">
            <?php    
            if( 'yes' === $settings['aem_post_grid_show_category'] && ( 'yes' === $settings['aem_post_grid_category_default_position'] || '-bottom-left' === $cat_position_over_image ) ) : ?>
                <ul class="aem-post-grid-category cat-pos<?php echo esc_attr( $cat_position_over_image ); ?>">
                    <?php Helper::aem_get_categories_for_post(); ?>
                </ul>
            <?php endif;

            if( 'post_data_middle' === $settings['aem_post_grid_post_data_position'] ) :
                if( 'yes' === $settings['aem_post_grid_show_user_avatar'] || 'yes' === $settings['aem_post_grid_show_user_name'] || 'yes' === $settings['aem_post_grid_show_date'] ) : ?>
                    <ul class="aem-post-data show-avatar-<?php echo esc_attr( $settings['aem_post_grid_show_user_avatar'] ); ?>">
                        <?php do_action('aem_post_grid_meta_before'); ?>
                        <?php
                        if( 'yes' === $settings['aem_post_grid_show_user_avatar'] || 'yes' === $settings['aem_post_grid_show_user_name'] ) : ?>
                            <li class="aem-author-avatar">
                            <?php
                                if('yes' === $settings['aem_post_grid_show_user_avatar']) :
                                    echo get_avatar( get_the_author_meta('email'), '40' );
                                endif;

                                if('yes' === $settings['aem_post_grid_show_user_name']) : ?>
                                    <span class="aem-post-grid-author">
                                    <?php
                                    echo ('yes' === $settings['aem_post_grid_show_user_name_tag']) ? esc_html($settings['aem_post_grid_user_name_tag']) : ''; ?>
                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="aem-post-grid-author-name"><?php echo get_the_author(); ?></a>
                                    </span>
                                <?php endif; ?>
                            </li>
                        <?php
                        endif;

                        if('yes' === $settings['aem_post_grid_show_date']) : ?>
                            <li class="aem-post-date">
                                <span>
                                    <?php echo ( 'yes' === $settings['aem_post_grid_show_date_tag'] ) ? esc_html( $settings['aem_post_grid_date_tag'] ) : '' ; ?>
                                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="aem-post-grid-author-date"><?php echo get_the_date(apply_filters( 'aem_post_grid_date_format', get_option( 'date_format' ) ) ); ?></a>
                                </span>                          
                            </li> 
                        <?php
                        endif;
                        do_action('aem_post_grid_meta_after');
                        ?>   
                    </ul>
                <?php     
                endif;
            endif;
            
            if('yes' === $settings['aem_post_grid_show_title']) :
                if('yes' === $settings['aem_post_grid_title_full']) : ?>
				
			<?php if ( $settings['aem_post_grid_title_tag'] !== '' ) { ?>
				
                    <<?php echo $settings['aem_post_grid_title_tag']; ?>>
					
			<?php } ?>
				
                        <a href="<?php echo esc_url( $parmalink ); ?>" <?php echo $style_par; ?> class="aem-post-grid-title"><?php echo get_the_title(); ?></a>
				
			<?php if ( $settings['aem_post_grid_title_tag'] !== '' ) { ?>
						
                    </<?php echo $settings['aem_post_grid_title_tag']; ?>>
					
			<?php } ?>
					
                <?php else : ?>
				
			<?php if ( $settings['aem_post_grid_title_tag'] !== '' ) { ?>
				
                    <<?php echo $settings['aem_post_grid_title_tag']; ?>>
					
			<?php } ?>
					
                        <a href="<?php echo esc_url( $parmalink ); ?>" <?php echo $style_par; ?> class="aem-post-grid-title"><?php echo wp_trim_words( get_the_title(), $settings['aem_grid_title_length'], '...' ); ?></a>
						
			<?php if ( $settings['aem_post_grid_title_tag'] !== '' ) { ?>
			
                    </<?php echo $settings['aem_post_grid_title_tag']; ?>>
					
			<?php } ?>
					
                <?php
                endif;
            endif;

            if( 'yes' === $settings['aem_post_grid_show_read_time'] || 'yes' === $settings['aem_post_grid_show_comment'] ) : ?>
                <ul class="aem-post-grid-time-comment">
                <?php 
                    if( 'yes' === $settings['aem_post_grid_show_read_time'] ) : ?>
                        <li class="aem-post-grid-read-time"><?php echo Helper::aem_reading_time( get_the_content() ); ?></li>
                    <?php
                    endif;

                    if( 'yes' === $settings['aem_post_grid_show_comment'] ) : ?>
                    <li>
                        <a class="aem-post-grid-comment" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number().get_comments_number_text( ' comment', ' comment', ' comments' ); ?></a>
                    </li>
                    <?php endif; ?>
                </ul>
            <?php 
            endif;
            
            do_action('aem_post_grid_excerpt_wrapper_before');
            if('yes' === $settings['aem_post_grid_show_excerpt']) : ?>
                <div class="aem-post-grid-description">
                    <?php echo wp_trim_words( get_the_excerpt(), $settings['aem_grid_excerpt_length'], '...' ); ?>
                </div>
            <?php
            endif;
            do_action('aem_post_grid_excerpt_wrapper_after');

            if( ! empty( $settings['aem_post_grid_read_more_btn_text'] ) && 'yes' === $settings[ 'aem_post_grid_show_read_more_btn' ] ) : ?>
                <div class="aem-post-footer"><a href="<?php echo esc_url( get_the_permalink() ); ?>" target=<?php echo $target; ?> class="read-more"><?php echo esc_html( $settings['aem_post_grid_read_more_btn_text'] ); ?></a></div>
            <?php
            endif;

            if( 'post_data_bottom' === $settings['aem_post_grid_post_data_position'] ) :
                if( 'yes' === $settings['aem_post_grid_show_user_avatar'] || 'yes' === $settings['aem_post_grid_show_user_name'] || 'yes' === $settings['aem_post_grid_show_date'] ) : ?>
                    <ul class="aem-post-data show-avatar-<?php echo esc_attr( $settings['aem_post_grid_show_user_avatar'] ); ?>">
                    <?php 
                        do_action('aem_post_grid_meta_before');
                        if( 'yes' === $settings['aem_post_grid_show_user_avatar'] || 'yes' === $settings['aem_post_grid_show_user_name'] ) : ?>
                            <li class="aem-author-avatar">
                            <?php 
                                if('yes' === $settings['aem_post_grid_show_user_avatar']) :
                                    echo get_avatar( get_the_author_meta('email'), '40' );
                                endif;

                                if('yes' === $settings['aem_post_grid_show_user_name']) : ?>
                                    <span class="aem-post-grid-author">
                                    <?php echo ('yes' === $settings['aem_post_grid_show_user_name_tag']) ? esc_html($settings['aem_post_grid_user_name_tag']) : '' ; ?>
                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="aem-post-grid-author-name"><?php echo get_the_author(); ?></a>
                                    </span>
                                <?php endif; ?>
                            </li>
                        <?php     
                        endif;

                        if('yes' === $settings['aem_post_grid_show_date']) : ?>
                            <li class="aem-post-date">
                                <span>
                                    <?php echo ( 'yes' === $settings['aem_post_grid_show_date_tag'] ) ? esc_html( $settings['aem_post_grid_date_tag'] ) : '' ; ?>
                                    <a href="<?php echo esc_url( get_permalink() ); ?>" class="aem-post-grid-author-date"><?php echo get_the_date(apply_filters( 'aem_post_grid_date_format', get_option( 'date_format' ) ) ); ?></a>
                                </span>                          
                            </li>
                        <?php    
                        endif;
                        do_action('aem_post_grid_meta_after'); ?>   
                    </ul>
                <?php    
                endif;
            endif; 
            ?>

        </div>
        <?php do_action('aem_post_grid_each_item_wrapper_after'); ?>
    </div>
</article>