<?php
/**
 * Template Name: General Body Template
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>
<!-- Page Title Begin -->
    <section class="page-title-bg pt-80 pb-60" data-bg-img="<?php do_shortcode('[WP_HEADER_IMAGES]'); ?>">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2><?php echo get_the_title(); ?></h2>
                        <ul class="list-inline">
                            <li><a href="<?php bloginfo( 'url' ); ?>">Home</a></li>
                            <li><?php echo get_the_title(); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div class="container">
	<section id="primary" class="content-area pt-60 pb-60">		
		<div id="main" class="site-main">
		 <div class="page-innertitle"><?php echo get_the_title(); ?></div>
		 <?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'page' );

			endwhile; // End of the loop.
		?>
		          
            <div class="member-content">
			
			<div class="category-content" <?php $countrow = $term->count; if ($countrow <= 5){ echo "style='min-height: 405px;'"; } else{ echo "style='min-height: 780px;'"; }?>>
            <div class="row category-content-1"> 
				<?php
					$args = array('post_type' => 'whoiswho',
							'post_status' => 'publish',
							'posts_per_page' => '-1',
							'orderby'   => $cat_id,
							'order' => 'ASC',
							'tax_query' => array(
										array(
											'taxonomy' => 'whoiswho-category',
											'field' => 'slug',
											'terms' => 'general-body'
										),                                                  
									)
					);
					$rowcount = 1;
					$slug = $term->slug;
					$loop_news = new WP_Query($args);  
					if ( $loop_news->have_posts() ) :
					while ( $loop_news->have_posts() ) : $loop_news->the_post(); 
					if( have_rows('who_is_who_items') ): 
							while( have_rows('who_is_who_items') ): the_row(); 
								$name = get_sub_field('name');
								$designation = get_sub_field('designation');
								$member_image = get_sub_field('upload_photo');  
				?>				
					<div class="col-md-3 col-sm-3 col-xs-12 member-item text-center">
						<div class="bm-al-box"><figure>
						<?php if($member_image){ ?>
							<img alt="<?php echo $name; ?>" src="<?php echo $member_image;?>">
						<?php }else { ?>
							<img alt="<?php echo $name; ?>" src="<?php echo get_template_directory_uri();?>/assets/img/no-image.jpg">
						<?php } ?>
						</figure></div>
						<div class="col-about-info">
							<h3><?php echo $name; ?></h3>
								<!-- /* h5 replaced by h4 by trupti */ -->
							<h4><?php echo $designation; ?></h4>
						</div>
				
					</div>
				<?php endwhile;  endif;   endwhile; ?>  
					<?php else : ?>
					<p><?php _e( 'Sorry, No Members are Matched Your Criteria.' ); ?></p>
				<?php endif;  wp_reset_query(); ?>  
			</div>
            </div>
			</div>
			
		</div>
	</section>
</div>
<?php get_footer(); ?>