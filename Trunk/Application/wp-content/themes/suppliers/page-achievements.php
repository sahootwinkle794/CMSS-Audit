<?php
/**
 * Template Name: Achievements Template
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
	<section id="primary" class="content-area pb-60">		
		<div id="main" class="site-main">
			<div class="pt-60 pb-40">
			<div class="page-innertitle"><?php echo get_the_title(); ?></div>
			<div class="page-tagline"><?php echo get_field('tag_line'); ?></div>
			<?php

				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content/content', 'page' );

				endwhile;
			?>
			</div>       
            <div class="member-content">
				<div class="category-content">
					<div class="row justify-content-center wow fadeInRight" data-wow-delay="0.1s">
						<?php 
							$args = array(
								'post_type' => 'achievements',
								'posts_per_page' => 5,
								'post_status' => 'publish'
							);
							$loop = new WP_Query($args);						
							if($loop->have_posts()) {
								while($loop->have_posts()) : $loop->the_post();	
									$achievement_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');	
									$procurementcount = get_field('count');
						?>
						<div class="col-lg-2 col-md-2">
							<div class="block-featured">
								<img src="<?php echo $achievement_img_url;?>" alt="<?php the_title(); ?>" />
								
								<h4><?php the_title(); ?></h4>
								<?php if($procurementcount) { ?><span class="blink_me"><?php echo $procurementcount; ?></span><?php } else{ ?><a href="<?php the_permalink(); ?>" class="morebtn">View More</a><?php } ?>
							</div>
						</div>
						<?php  
							endwhile;
							}
						?>	
					</div>
				</div>
			</div>
			
		</div>
	</section>
</div>
<?php get_footer(); ?>